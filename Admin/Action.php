<?php
    include('../connection.php');


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteSuggestion'])) {
        $suggestion_id = $_POST['deletion_id'];

        $delete_query = $conn->prepare("DELETE FROM suggestion WHERE id = ?");
        $delete_query->bind_param("i", $suggestion_id);

        if ($delete_query->execute()) {
            echo "<script>window.location.href = 'Suggestion.php';</script>";
        } else {
            echo "<script>window.location.href = 'Suggestion.php'; alert('Deletion failed');</script>";
        }

        $delete_query->close();
    } else {
        echo "Failed!";
    }




    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUser'])) {
        $user_id = $_POST['user_id'];

        $delete_query = $conn->prepare("DELETE FROM users WHERE id = ?");
        $delete_query->bind_param("i", $user_id);

        if ($delete_query->execute()) {
            echo "
            <script>
            window.location.href = 'Users.php';
            </script>
            ";
        } else {
            echo "
            <script>
            window.location.href = 'Users.php';
            alert('Deletion failed');
            </script>
            ";
        }

        $delete_query->close();
    } else {
        echo "Failed !";
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $department = $_POST['department'];

        // Handle file upload
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $photo = file_get_contents($_FILES['photo']['tmp_name']);
        } else {
            $photo = null;
        }

        $sql = $conn->prepare("INSERT INTO users (name, email, passowrd, department, photo) VALUES (?, ?, ?, ?, ?)");
        $sql->bind_param("sssss", $name, $email, $password, $department, $photo);

        if ($sql->execute()) {
            echo "
            <script>
            window.location.href = 'Users.php';
            </script>
            ";
        } else {
            echo "
            <script>
            window.location.href = 'Users.php';
            </script>
            ";
        }

        $sql->close();
    }

?>
