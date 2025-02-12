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
    <link rel="stylesheet" href="assets/css/analytics.css"><!-- Link to external CSS -->
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
            <div class="chart-title2">Religion</div>
                <div class="col-sm-12">
                <div class="chart2size">
  
                    <div class="chart-container2">
        <canvas id="sexChart"></canvas>
    </div>
    </div>


                </div>
            </div>
        </div>

    </main>
    <script>
        // Fetch data from the backend PHP script
        async function fetchSexChartData() {
            try {
                const response = await fetch('religion_function.php'); // Adjust to the correct PHP file URL
                const data = await response.json();
                return data;
            } catch (error) {
                console.error("Error fetching chart data:", error);
                return null;
            }
        }

        // Initialize and render the chart
        async function initSexChart() {
            const chartData = await fetchSexChartData();

            if (chartData) {
                const ctx = document.getElementById('sexChart').getContext('2d');

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: chartData.labels,
                        datasets: chartData.datasets,
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                            }
                        }
                    }
                });
            }
        }

        // Render the chart when the page loads
        initSexChart();
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 <script>
     AOS.init();
 </script>
    <?php include './components/footer.php'; ?>  
    </body>

</html>
