<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Suggestion</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        width: 100vw;
        box-sizing: border-box;
        overflow-x: hidden;
        height: 100%;
        /* padding-bottom: 3rem; */

    }

    .screen-container {
        height: 100vh;
        width: 100vw;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    input,
    textarea,
    select,
    option {
        width: 220px;
        padding: 0.4rem;
        font-size: 1rem;
        margin-top: 5px;
        border: none;
        resize: none;
        border-bottom: 2px solid;
    }

    label {
        font-size: 1.3rem;
    }

    h2 {
        font-size: 2rem;
        text-align: center;
        width: 100%;
    }

    textarea {
        width: 95%;
    }

    .p-4 {
        padding: 4rem;
    }

    form {
        width: max-content;
        border-radius: 15px;
        overflow: hidden;
        backdrop-filter: blur(16px);
        padding: 4rem 2rem !important;
        /* border: 2px solid; */
        backdrop-filter: blur(12px);
        /* height: 500px; */
        overflow: hidden !important;
        padding: 20px !important;
        padding-bottom: 50px !important;
    }

    .img {
        display: flex;
        justify-content: center;
    }

    .img img {
        height: 430px;
    }

    ::placeholder,
    #default {
        color: rgba(131, 131, 131, 0.756) !important;
    }

    .card h4 {
        border: none;
        font-weight: 500;
    }
</style>

<?php
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $name  = $_POST['name'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $suggestion = $_POST['message'];

        // $public = isset($_POST['public'])?true:false;


        
        include('connection.php');

        $sql = "INSERT INTO suggestion (name,department,email,suggestion) VALUES ('$name','$department','$email','$suggestion')";

        $query = mysqli_query($conn, $sql);

        if($query){
            echo "
            <script>
                alert('Submitted Sucessfully');
            </script>
            ";
        }
    }
?>


<body class="">
    <?php
    include("HomeNav.php");
    ?>
    
    <div class="screen-container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="blur flex gap-2 flex-col" method='post' onsubmit="return validateForm()">
            <div class="">
                <div class="flex mb-3">
                    <h2>Suggestion</h2>
                </div>
            </div>
            <div class="flex gap-2">
                <div class="img">
                    <img src="./assets/complain2.png" alt="">
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex gap-1">
                        <div class="flex flex-col gap-1">
                            <div class="flex gap- flex-col">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="full name" minlength="5" required>
                            </div>
                            <div class="flex gap- flex-col">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div class="flex gap- flex-col">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" id="phone" placeholder="98xxxxxxxx" minlength="10"
                                    maxlength="10" required>
                            </div>
                            <div class="flex flex-col">
                                <label for="department">Department</label>
                                <select name="department" id="department" required>
                                    <option value="" disabled selected style='color:blue;'><span id="default">select</span>
                                    </option>
                                    <option value="account">Account Department</option>
                                    <option value="cleaning">Cleaning Department</option>
                                    <option value="maintenance">Maintenance Department</option>
                                    <option value="security">Security Department</option>
                                    <option value="it">IT Department</option>
                                    <option value="hr">Human Resources</option>
                                    <option value="administration">Administration</option>
                                    <option value="student-affairs">Student Affairs</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="message">Suggestion</label>
                        <textarea name="message" id="message" rows="6" placeholder="write here..." minlength="100"
                            required></textarea>
                    </div>
                    <!-- <div class="flex gap-1">
                        <input type="checkbox" id="public" name="public" style="width: auto;">
                        <label for="public" style="font-size: 1rem;font-weight: 400;">make my suggestion public</label>
                    </div> -->
                    <div class="flex">
                        <button class="primaryButton" name='submit'>submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="p-4">
        <h2 class="" style="text-align: left;">Recent Suggestions</h2>
        
       <?php
            include('connection.php');
            $sql = "SELECT name, suggestion, department FROM suggestion ";
            $data = mysqli_query($conn, $sql);
            
            while ($row = mysqli_fetch_assoc($data)){
?>
            <div class="card">
                <h3><?php echo $row['name']; ?></h3>
                <h4><?php echo $row['suggestion'];  ?></h4>
                <span><?php echo $row['department'];  ?></span>
            </div>

<?php
            }
       ?>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var namePattern = /^[A-Za-z\s]+$/;
            var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!namePattern.test(name)) {
                alert('Name should contain alphabets only');
                return false;
            }
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
