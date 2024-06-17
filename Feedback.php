<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Feedback</title>
</head>
<style>
    body {
        padding: 2rem 4rem;
        box-sizing: border-box;
        overflow-x: hidden;
        height: 100%;
        /* margin-bottom: 10rem !important; */
    }
.card {
    display:flex;
    flex-direction:column;
    gap:.7rem;
}
    input {
        padding: 8px 17px;
        font-size: 1.1rem;
        border-radius: 12px;
        border: 2px solid rgba(194, 194, 196, 0.797);
    }
</style>

<body>
    <a href="index.html">
        <button class="homeNav">Home</button>
    </a>
    <div class="p-4 mb-1">
        <h2>Feedbacks</h2>
    </div>
    <form action="" class="mb-3">
        <input type="text" placeholder="Suggestion ID" minlength="5" required>
        <button class="primaryButton"><span>search</span><span><i class="fa fa-search"></i></span></button>
    </form>
    <h3>Public feedbacks</h3>
    <?php  
         include('connection.php');

         include('connection.php');

         // Adjust the JOIN condition based on the actual field names you have
         $sql = "SELECT s.name, s.suggestion, s.department, f.feedback 
                 FROM suggestion s
                 INNER JOIN feedback f ON s.id = f.suggestion_id
                 WHERE s.public = '1'";

         $result = mysqli_query($conn, $sql);
     
         $suggestions = [];
     
         while ($row = mysqli_fetch_assoc($result)) {
             $suggestions[] = $row;
         }
    ?>
    <div class="">
    <?php foreach ($suggestions as $suggestion): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($suggestion['name']); ?></h3>
                <p><?php echo htmlspecialchars($suggestion['suggestion']); ?></p>
                <h4>Feedback</h4>
                <p><?php echo htmlspecialchars($suggestion['feedback']); ?></p>
                <p ><span><?php echo htmlspecialchars($suggestion['department']); ?></span>
                </p>
            </div>
        <?php endforeach; ?>
        
    </div>
</body>

</html>