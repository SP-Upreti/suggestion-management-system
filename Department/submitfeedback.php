<?php
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $feedback = $_POST['response'];
    $suggestion_id = $_POST['suggestion_id'];

    // Check if the suggestion has already been responded to
    $stmt = $conn->prepare("SELECT feedback FROM feedback WHERE suggestion_id = ?");
    $stmt->bind_param("i", $suggestion_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "
            <script>
                alert('This suggestion is already responded');
                window.location.href='./index.php';
            </script>
        ";
    } else {
        // Insert feedback
        $stmt = $conn->prepare("INSERT INTO feedback (suggestion_id, feedback) VALUES (?, ?)");
        $stmt->bind_param("is", $suggestion_id, $feedback);
        $result = $stmt->execute();

        if ($result) {
            // Update the suggestion as responded
            $stmt = $conn->prepare("UPDATE suggestion SET responded = 1 WHERE id = ?");
            $stmt->bind_param("i", $suggestion_id);
            $result = $stmt->execute();

            if ($result) {
                echo "
                    <script>
                        alert('Feedback submitted successfully');
                        window.location.href='./index.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Error updating suggestion: " . $stmt->error . "');
                        window.location.href='./index.php';
                    </script>
                ";
            }
        } else {
            echo "
                <script>
                    alert('Error submitting feedback: " . $stmt->error . "');
                    window.location.href='./index.php';
                </script>
            ";
        }
    }
    $stmt->close();
} else {
    echo "
        <script>
            alert('Form not submitted correctly');
            window.location.href='./index.php';
        </script>
    ";
}
$conn->close();
?>
