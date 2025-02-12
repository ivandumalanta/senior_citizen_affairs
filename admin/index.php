<?php
include '.././database/db_connection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT last_name, first_name, middle_name, osca_id, 
               TIMESTAMPDIFF(YEAR, birth_day, CURDATE()) AS age 
        FROM users 
        ORDER BY birth_day DESC 
        LIMIT 5";

$result = $conn->query($sql);

$recentApplicants = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recentApplicants[] = $row;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>


    <nav class="sidebar">
        <?php include '.././components/admin-nav.php'; ?>
    </nav>
    <div class="main-content">
        <h2><b>Analytical Overview</b></h2>
        <div class="container">
            <div class="row ">
                <div class="formbox">
                    <div class="col-sm-3">
                        <div class="boxform ">
                            <i class="bi bi-suit-heart-fill"> <span>4.2</span></i>
                            Ratings
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="boxform ">
                            <i class="bi bi-person-lines-fill"> <span>123</span></i>

                            New Applicants
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="boxform ">
                            <i class="bi bi-send-fill"> <span>50</span></i>

                            Distributed Id's
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="boxform ">
                            <i class="bi bi-emoji-smile"> <span>121</span></i>

                            Happy Clients
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="table-container">
                        <h3>Recent Applicants</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Age</th>
                                        <th>ID No</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentApplicants as $applicant): ?>
                                        <tr>
                                            <td><?= $applicant['last_name'] . ', ' . $applicant['first_name'] . ' ' . $applicant['middle_name']; ?></td>
                                            <td><?= $applicant['age']; ?></td>
                                            <td><?= $applicant['osca_id']; ?></td>
                                            <td>New</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                 <div class="chart-container">
                    <h2>Ratings</h2>
                    <div class="filter-container">
                        <select id="filter" class="form-control" style="width: 200px; display: inline-block;">
                            <option value="year">Year</option>
                            <option value="month">Month</option>
                            <option value="today">Today</option>
                        </select>
                    </div>
                    <canvas id="ratingsChart"></canvas>
                    
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('ratingsChart').getContext('2d');
            var filterSelect = document.getElementById('filter');

            function fetchData(filter) {
                fetch('fetch_data.php?filter=' + filter)
                    .then(response => response.json())
                    .then(data => {
                        updateChart(data.labels, data.femaleRatings, data.maleRatings);
                    });
            }

            function updateChart(labels, femaleData, maleData) {
                ratingsChart.data.labels = labels;
                ratingsChart.data.datasets[0].data = femaleData;
                ratingsChart.data.datasets[1].data = maleData;
                ratingsChart.update();
            }

            var ratingsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                            label: 'Female',
                            data: [],
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Male',
                            data: [],
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            filterSelect.addEventListener('change', function() {
                fetchData(this.value);
            });

            fetchData(filterSelect.value);
        });
    </script>

</body>

</html>