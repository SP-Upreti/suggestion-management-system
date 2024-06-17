<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="index.css">
    <style>
        .main-content {
            display: none;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Admin Panel</h2>
        </div>
        <ul class="sidebar-menu">
            <li onclick="showSection('dashboard')">Dashboard</li>
            <li onclick="showSection('users')">Users</li>
            <li onclick="showSection('suggestion')">Suggestions</li>
        </ul>
    </div>

    <div class="main-content" id="dashboard">
        <div class="flex">
            <div>
                <header>
                    <h1>Users</h1>
                </header>
                <section class="user-details flex space-between">
                    <h2>Total Users</h2>
                    <h2>22</h2>
                </section>
            </div>
            <div>
                <header>
                    <h1>Suggestions</h1>
                </header>
                <div class="user-details flex space-between">
                    <h2>Total Suggestions</h2>
                    <h2>94</h2>
                </div>
            </div>
            <div>
                <header>
                    <h1>Feedback</h1>
                </header>
                <div class="user-details flex space-between">
                    <h2>Total Feedbacks</h2>
                    <h2>94</h2>
                </div>
            </div>
        </div>
        <section>
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        </section>
    </div>

    <div class="main-content" id="users">
        <div class="flex mt-5">
            <div class="button">
                <button>Add Users</button>
            </div>
            <div class="button">
                <button>Delete User</button>
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
                </tr>
                <tr>
                    <td>Surendra Upreti</td>
                    <td>Surendraupreti441@gmail.com</td>
                    <td>#@jhdgyjeed</td>
                    <td>IT Support</td>
                    <td><img src="" alt="photo"/></td>
                </tr>
                <tr>
                    <td>Yaskar Jung</td>
                    <td>yaskar142@gmail.com</td>
                    <td>#@kwhdudeu</td>
                    <td>Maintenance</td>
                    <td><img src="" alt="photo"/></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="main-content" id="suggestion">
        <div class="mt-5">
            <h2>Suggestion's List</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Suggestion</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>Surendra Upreti</td>
                    <td>9812345678</td>
                    <td>#@jhdgyjeed</td>
                    <td>IT Support</td>
                    <td style='width:300px'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste assumenda deserunt illum officiis autem eum numquam id, ullam similique distinctio!</td>
                    <td><div class="button"><button style='padding:8px 32px'>Delete</button></div></td>
                </tr>
                <tr>
                    <td>Yaskar Jung</td>
                    <td>9812345678</td>
                    <td>#@kwhdudeu</td>
                    <td>Maintenance</td>
                    <td style='width:300px'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ex necessitatibus corporis unde, voluptatum consectetur quae accusamus est delectus earum quasi vitae quia praesentium. Ex.</td>
                    <td><div class="button"><button style='padding:8px 32px'>Delete</button></div></td>
                </tr>
            </table>
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

        // Initially show the dashboard
        showSection('dashboard');

        const xValues = ["Accounting", "Maintenance", "Human Resource", "Security", "Administration"];
        const yValues = [55, 49, 44, 24, 30, 30];
        const barColors = ["red", "green", "blue", "orange", "brown"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "Total suggestions in departments"
                }
            }
        });
    </script>
</body>

</html>
