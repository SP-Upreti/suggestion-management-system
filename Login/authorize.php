<?php
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $email = $_POST['email'];
        $passowrd = $_POST['password'];

        $conn = mysqli_connect('localhost', 'root','','suggestion_management_system');
        $sql = "SELECT department,email FROM users WHERE email = '$email' AND passowrd = '$passowrd'";

        $data = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($data);
        if(mysqli_num_rows($data) == 0){
            echo "
            <script>
            window.location.href = 'index.html';
            alert('Invalid username/password 😐');
            </script>
            ";
        }
        else if($user['department'] != 'admin') {
            session_start();
            $_SESSION['email'] = $user['email'];
            echo "
              <script>
            window.location.href = '../Department';
            </script>
            ";
            
            // echo $user['department'];
            // echo "<a href='../Department?name=".$user['name']."&department=".$user['department'].">ok</a>";

        
        }
        else {
            session_start();
            $_SESSION['email'] = $user['email'];
            echo "
              <script>
            window.location.href = '../Admin';
            </script>
            ";
        }
    }
?>