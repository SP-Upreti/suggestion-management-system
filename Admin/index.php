<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$email = "";
if(!$_SESSION['email']){
    echo "
    <script>
        window.location.href = '../Login';
    </script>
    ";
}
else {
    $email = $_SESSION['email'];
}
include('../connection.php');
$sql1 = "SELECT name, department,photo FROM users WHERE email = '$email'";
$admin_data = mysqli_query($conn, $sql1);

$admin_row = mysqli_fetch_assoc($admin_data);


// Fetching user data
$user_query = $conn->prepare("SELECT id, name, email, passowrd, department, photo FROM users");
$user_query->execute();
$user_data = $user_query->get_result();

// Fetching suggestion data
$suggestion_query = $conn->prepare("SELECT id, name, email, department, suggestion FROM suggestion");
$suggestion_query->execute();
$suggestion_data = $suggestion_query->get_result();


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUser'])){
    $id = $_POST['user_id'];
    $sql = "DELETE FROM users WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    if($query){
    echo "
    <script>
    alert('deleted');
    </script>
    ";
    }
}




?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="index.css">
    <style>
      
        .userform {
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            padding:1rem;
        }
    </style>
</head>

<body>
    <?php
    include('Navbar.php');
    ?>

    <div class="main-content" id="dashboard">

        <div class="" style='margin-bottom:2rem;border-bottom:1px solid;padding-bottom:10px'>
            <div class="large-circle">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($admin_row['photo']); ?>" alt="photo">
            </div>
            <h2 style=''><?php echo $admin_row['name']; ?></h2>
        </div>

        <div class="flex">
            <div>
                <header>
                    <h1>Users</h1>
                </header>
                <a href="./Users.php">
                <section class="user-details flex space-between">
                    <h2>Total Users</h2>
                    <h2><?php echo $user_data->num_rows; ?></h2>
                </section>
                </a>
            </div>
            <div>
                <header>
                    <h1>Suggestions</h1>
                </header>
                <a href="./Suggestion.php">
                <div class="user-details flex space-between">
                    <h2>Total Suggestions</h2>
                    <h2><?php echo $suggestion_data->num_rows; ?></h2>
                </div>
                </a>
            </div>
        </div>
        
    </div>

  

   

 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        function showSection(sectionId) {
            var sections = document.querySelectorAll('.main-content');
            sections.forEach(function(section) {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
</body>

</html>
