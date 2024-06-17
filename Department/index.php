<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo "<script>window.location.href = '../Login/';</script>";
    exit;
}

if (isset($_POST['logout'])) {
    $_SESSION['email'] = null;
    session_destroy();
    echo "<script>window.location.href = '../Login/';</script>";
    exit;
}

include('../connection.php');
$mail = $_SESSION['email'];
$query = $conn->prepare("SELECT * FROM users WHERE email = ?");
$query->bind_param("s", $mail);
$query->execute();
$data = $query->get_result();
$row = $data->fetch_assoc();

$name = $row['name'];
$department = $row['department'];
$photo = $row['photo'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style.css">
    <script src="https://kit.fontawesome.com/e9ffc8e955.js" crossorigin="anonymous"></script>
    <title>Department Admin</title>
</head>

<style>
    body {
        overflow-x: hidden;
    }

    .circle {
        height: 50px;
        width: 50px;
        overflow: hidden;
        border-radius: 100%;
        background-color: black;
    }

    .p {
        padding: 1rem 2rem !important;
    }

    .primaryButton {
        height: 40px;
    }

    .btn-sm {
        font-size: 0.9rem;
        height: 25px;
        padding: 0px 10px;
        font-weight: 500;
        background-color: rgba(47, 108, 250);
    }

    input {
        padding: 7px 17px;
        font-size: 1.1rem;
        border-radius: 12px;
        border: 2px solid rgba(194, 194, 196, 0.797);
    }

    .root {
        padding: 2rem !important;
    }

    .feedback {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 999;
        background-color: rgba(47, 108, 250, 0.5);
        height: 100vh;
        width: 100vw;
        justify-content: center;
        align-items: center;
    }

    .card-lg {
        width: 50rem;
        padding: 1rem 2rem;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    textarea {
        padding: 8px;
        resize: none;
    }
</style>

<body>
    <div class="flex justify-between p">
        <div class="flex items-center gap-1">
            <div class="circle">
                <img src="../assets/user.jpg" alt="User Photo" style="width:100%;">
            </div>
            <div class="flex flex-col">
                <h2 class="lineheight"><?php echo htmlspecialchars($name); ?></h2>
                <p style="font-size: 12px;"><?php echo htmlspecialchars($department); ?> Department</p>
            </div>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <button class="primaryButton" name="logout">Logout</button>
        </form>
    </div>

    <div class="root">
        <form action="" class="mb-3">
            <input type="text" placeholder="Suggestion ID" minlength="5" required>
            <button class="primaryButton"><span>Search</span><span><i class="fa fa-search"></i></span></button>
        </form>

        <h2>Suggestions</h2>
        <?php
        $sql = $conn->prepare("SELECT id, name, suggestion, department FROM suggestion WHERE department = ?");
        $sql->bind_param("s", $department);
        $sql->execute();
        $data = $sql->get_result();
        while ($row = $data->fetch_assoc()) {
        ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <h4><?php echo htmlspecialchars($row['suggestion']); ?></h4>
                <p class='flex justify-between items-center'>
                    <span><?php echo htmlspecialchars($row['department']); ?></span>
                    <button class='primaryButton btn-sm' onclick='handleClick(event)'>Respond</button>
                </p>
            </div>
            <div class='feedback'>
                <form action="submitfeedback.php" method='post'>
                    <div class="card-lg">
                        <p style='text-align:right;cursor:pointer;'><span onclick='handleClose(event)'><i class="fa fa-close"></i></span></p>
                        <h3><?php echo htmlspecialchars($row['name']); ?>'s Suggestion</h3>
                        <textarea rows='5' readonly><?php echo htmlspecialchars($row['suggestion']); ?></textarea>
                        <textarea placeholder="Your response" name='response' rows='5' minlength='50' required></textarea>
                        <input type="hidden" value="<?php echo htmlspecialchars($row['id']); ?>" name='suggestion_id'>
                        <button class='primaryButton' name='submit'>Submit</button>
                    </div>
                </form>
            </div>
        <?php
        }
        ?>
    </div>

    <script>
        const handleClick = (event) => {
            event.preventDefault();
            const button = event.target;
            const form = button.closest('.card').nextElementSibling;
            form.style.display = 'flex';
        }

        const handleClose = (event) => {
            const button = event.target.closest('.fa-close').parentElement;
            const form = button.closest('.feedback');
            form.style.display = 'none';
        }
    </script>
</body>

</html>
