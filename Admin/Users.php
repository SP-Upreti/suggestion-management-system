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

    // Fetching user data
    $user_query = $conn->prepare("SELECT id, name, email, passowrd, department, photo FROM users");
    $user_query->execute();
    $user_data = $user_query->get_result();

  

    ?>
    <style>
        .gap {
            gap:5px !important;
            margin-bottom:5px
        }
        .formBtn {
            border:none;
            padding:5px 12px;
            margin-top: 0.7rem;
            background-color: rgba(47, 108, 250, 0.797);
            color:white;
            cursor: pointer;
        }
    </style>

    <div class="main-content" id="users">
        <div class="flex mt-5">
            <div class="button">
                <button onclick="showAddUserForm()">Add User</button>
            </div>
        </div>
        <div class="mt-5">
            <h2>User's List</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Department</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $user_data->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['passowrd']); ?></td>
                    <td><?php echo htmlspecialchars($row['department']); ?></td>
                    <td class='imgBox'><img src="data:image/jpeg;base64,<?php echo base64_encode($row['photo']); ?>" alt="photo"  /></td>
                    <td>
                        <form method="post" action="Action.php">
                            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="button" name='deleteUser' style='padding:8px 32px'>Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- Add User Form -->
    <div class='userform' id="addUserForm" style="display:none;">
        <div class="container">
        <h2>Add User</h2>
        <form method="post" action="Action.php" enctype="multipart/form-data">
            
                    <div class="flex flex-col gap">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    </div>

                    <div class="flex flex-col gap">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            </div>

            <div class="flex flex-col gap">
            <label for="password">Password:</label>
           <input type="password" id="password" name="password" required>
           </div>
           <div class="flex flex-col gap">
           <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>
            </div>
         <div class="flex flex-col gap">
         <label for="photo">Photo:</label>
         <input type="file" id="photo" name="photo" accept="image/*" required>
         </div>
            <div class="flex gap" style='margin-top:10px'>
            <button type="submit" name='addUser' class='formBtn'>Add User</button>
            <button type="button" class='formBtn' onclick="hideAddUserForm()">Cancel</button>
            </div>
        </form>
        </div>
    </div>

    <script>
        function showAddUserForm() {
            document.getElementById('addUserForm').style.display = 'flex';
        }

        function hideAddUserForm() {
            document.getElementById('addUserForm').style.display = 'none';
        }
    </script>
</body>

</html>
