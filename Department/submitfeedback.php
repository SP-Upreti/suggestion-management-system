<?php
include('../connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $feedback = $_POST['response'];
    $suggestion_id = $_POST['suggestion_id'];
    $sql = "SELECT feedback FROM feedback WHERE suggestion_id = '$suggestion_id'";
    $data = mysqli_query($conn, $sql);

    if (mysqli_num_rows($data) > 0) {
        echo "
            <script>
                alert('This suggestion is already responded');
            </script>
            ";
    } else {
        $query = "INSERT INTO feedback (suggestion_id, feedback) VALUES ('$suggestion_id', '$feedback')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "
            <script>
                alert('submitted');
            </script>
            ";
        } else {
            echo "Error: " . $query->error;
        }

    }
    echo "
    <script>
        window.location.href='./index.php';
    </script>
    ";
} 
else {
    echo "Form not submitted correctly";
}

?>
