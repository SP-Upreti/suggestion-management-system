<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if(!$_SESSION['email']){
    echo "
    <script>
        window.location.href = '../Login';
    </script>
    ";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../Style.css">
    <link rel="stylesheet" href="index.css">
    <title>Users</title>
</head>

<body>

    <?php
    include('./Navbar.php');
    include('../connection.php');

// Fetching suggestion data
$suggestion_query = $conn->prepare("SELECT id, name, email, department, suggestion FROM suggestion");
$suggestion_query->execute();
$suggestion_data = $suggestion_query->get_result();
    ?>

<div class="main-content" id="suggestion">
        <div class="mt-5" >
            <h2 style='margin-bottom:1rem !important;font-size:2rem;'>Suggestion's List</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Suggestion</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $suggestion_data->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['department']); ?></td>
                    <td style='width:300px'>
                        <textarea name="" id="" rows='5' style='resize:none;width:100%;border:none;outline:none ' readonly>
                        <?php echo htmlspecialchars($row['suggestion']); ?>
                        </textarea>
                    </td>
                    <td>
                        <form method="post" action="Action.php">
                            <input type="hidden" name="deletion_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name='deleteSuggestion' class="button"  style='padding:8px 32px'>Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</body>

</html>