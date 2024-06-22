<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Feedback</title>
    <style>
        body {
            padding: 2rem 4rem;
            box-sizing: border-box;
            overflow-x: hidden;
            height: 100%;
        }

        .card {
            display: flex;
            flex-direction: column;
            gap: .7rem;
            padding: 1rem;
            border: 1px solid rgba(194, 194, 196, 0.797);
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        input {
            padding: 8px 17px;
            font-size: 1.1rem;
            border-radius: 12px;
            border: 2px solid rgba(194, 194, 196, 0.797);
        }

        .homeNav, .primaryButton {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 12px;
            cursor: pointer;
        }

        .homeNav {
            background-color: #007bff;
            color: white;
            margin-bottom: 1rem;
        }

        .primaryButton {
            background-color: #28a745;
            color: white;
        }

        .primaryButton span {
            display: inline-block;
            vertical-align: middle;
        }

        .primaryButton i {
            margin-left: 8px;
        }
    </style>
</head>

<body>
    <?php
    include('HomeNav.php');
    ?>
    <div class="p-4 mb-1">
        <h2>Feedbacks</h2>
    </div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mb-2">
        <input type="text" name="suggestion_id" placeholder="Suggestion ID" minlength="1" required>
        <button class="primaryButton" name="search">
            <span>search</span><span><i class="fa fa-search"></i></span>
        </button>
    </form>

    <div class="mb-1">
        <?php
        include('connection.php');
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
            $suggestion_id = mysqli_real_escape_string($conn, $_POST['suggestion_id']);
            $sql = "SELECT s.name, s.suggestion, s.department, f.feedback 
                    FROM suggestion s
                    LEFT JOIN feedback f ON s.id = f.suggestion_id
                    WHERE s.id = '$suggestion_id'";
            $query = mysqli_query($conn, $sql);

            if ($query && mysqli_num_rows($query) > 0) {
                echo "<p style='color:green'> Search Result</p>";
                $result = mysqli_fetch_assoc($query);
                echo "<div class='card'>";
                echo "<h3>" . htmlspecialchars($result['name']) . "</h3>";
                echo "<p>" . htmlspecialchars($result['suggestion']) . "</p>";
                echo "<h4>Feedback</h4>";
                $response = '';
                if($result['feedback'] == ""){
                    $response = "Not responded";
                }
                else {
                    $response = $result['feedback'];
                }
                echo "<p>" . $response . "</p>";
                echo "<p><span>" . htmlspecialchars($result['department']) . "</span></p>";
                echo "</div>";
            } else {
                echo "<p>No Suggestion found</p>";
            }
        }
        ?>
    </div>

    <h3 style='border-bottom:1px solid;width:fit-content; margin-bottom:1rem;' class='mb-2'>Recent feedbacks</h3>
    <?php  
        $sql = "SELECT s.name, s.suggestion, s.department, f.feedback 
                FROM suggestion s
                INNER JOIN feedback f ON s.id = f.suggestion_id
                WHERE s.responded = 1";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            echo "<p>No feedbacks..</p>";
        } else {
            $suggestions = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $suggestions[] = $row;
            }
        }
    ?>
    <div class="">
        <?php if (!empty($suggestions)): ?>
            <?php foreach ($suggestions as $suggestion): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($suggestion['name']); ?></h3>
                    <p><?php echo htmlspecialchars($suggestion['suggestion']); ?></p>
                    <h4>Feedback</h4>
                    <p><?php echo htmlspecialchars($suggestion['feedback']); ?></p>
                    <p><span><?php echo htmlspecialchars($suggestion['department']); ?></span></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>
