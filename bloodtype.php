<?php

// Include the database connection file
include './database/db_connection.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior citizen affairs</title>
    <link rel="stylesheet" href="assets/css/styleHome.css">
    <link rel="stylesheet" href="assets/css/analytics.css">  <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>

<body>
   
    <nav class="navbar">
        <?php include './components/nav.php'; ?>
    </nav>

    <main class="heromain">
        <div class="container" data-aos="fade-up">
            <div class="row">
            <div class="chart-title2">Blood Type</div>
                <div class="col-sm-12">

             
                <div class="chart2size">
        <div class="chart-container">
            <canvas id="memberStatusChart"></canvas>
        </div>
        </div>
                </div>
            </div>
        </div>

    </main>
    <script>
        // Function to fetch data from the PHP backend
        async function fetchChartData() {
            try {
                const response = await fetch('bloodtype_function.php'); // PHP script URL
                const data = await response.json();
                return data;
            } catch (error) {
                console.error("Error fetching chart data:", error);
                return null;
            }
        }

        // Initialize the chart
        async function initChart() {
            const chartData = await fetchChartData();

            if (chartData) {
                // Get the context of the canvas
                const ctx = document.getElementById('memberStatusChart').getContext('2d');

                // Create the chart
                new Chart(ctx, {
                    type: 'line',
                    data: chartData, // Use the fetched data
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Ratings'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false // Hide the dataset label from the graph
                            }
                        }
                    }
                });
            }
        }

        // Call the initChart function when the page loads
        initChart();
    </script>
     <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 <script>
     AOS.init();
 </script>


    <?php include './components/footer.php'; ?>  
    </body>

</html>