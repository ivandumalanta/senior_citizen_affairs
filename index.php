<?php
include './database/db_connection.php';

$sql_headline = "SELECT * FROM news WHERE headline = 1 ORDER BY news_date ASC";

$sql_latest = "SELECT * FROM news ORDER BY news_date DESC";

try {

    $stmt_headline = $pdo->query($sql_headline);
    $headline_news = $stmt_headline->fetchAll(PDO::FETCH_ASSOC);

    $stmt_latest = $pdo->query($sql_latest);
    $latest_news = $stmt_latest->fetchAll(PDO::FETCH_ASSOC); // Fetch all the latest news
} catch (PDOException $e) {
    die("Error executing query: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior citizen affairs</title>
    <link rel="stylesheet" href="assets/css/styleHome.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>
<style>
    .btn-container {
    display: flex;
    flex-direction: row;
    justify-content: center;
    gap: 10px; /* Adds space between buttons */
}

.btn-container a {
    text-decoration: none;
}

</style>
<body>
    <nav class="navbar">
        <?php include './components/nav.php'; ?>
    </nav>

    <main class="heromain">
        <section id="home">
            <div class="container-fluid homeimage" data-aos="fade-up">
                <div class="row">

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                            <li data-target="#myCarousel" data-slide-to="5"></li>
                            <li data-target="#myCarousel" data-slide-to="6"></li>
                            <li data-target="#myCarousel" data-slide-to="7"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="./assets/images/bg1.jpg" alt="Slide 1" style="width:100%;">
                                <div class="carousel-caption">

                                </div>
                            </div>
                            <div class="item">
                                <img src="./assets/./images/bg2.jpg" alt="Slide 2" style="width:100%;">
                                <div class="carousel-caption">

                                </div>
                            </div>
                            <div class="item">
                                <img src="https://www.oscaportal.com/banner/20285482.png" alt="Slide 3" style="width:100%;">
                                <div class="carousel-caption">

                                </div>
                            </div>
                            <div class="item">
                                <img src="https://www.oscaportal.com/banner/58299799.png" alt="Slide 4" style="width:100%;">
                                <div class="carousel-caption">

                                </div>
                            </div>
                            <div class="item">
                                <img src="https://www.oscaportal.com/banner/76116437.png" alt="Slide 5" style="width:100%;">
                                <div class="carousel-caption">

                                </div>
                            </div>

                        </div>

                        <!-- Left and right controls -->


                    </div>
                </div>
            </div>

        </section>
        <section id="newslist">
        <div class="container-fluid spacingtop">
        <div class="row">
            <div class="col-sm-2 calendarbody text-center" data-aos="fade-left">
                <span><b id="current-year"></b></span>
                <br>
                <a href="#" data-toggle="modal" data-target="#calendarModal" onclick="showToday()">
                    <img src="https://jk2ws3.axshare.com/gsc/JK2WS3/7d/72/d7/7d72d709bc3b4c8cb808bfd8757274b5/images/home/u27.svg?pageId=72106482-35bb-4343-a7ce-8978a29e3df2"
                        alt="Calendar Icon"
                        style="width: 50px; height: 50px; cursor: pointer;">
                </a>
            </div>
            <div class="col-sm-4" data-aos="fade-left">
                <p class="font16"> <img src="https://jk2ws3.axshare.com/gsc/JK2WS3/7d/72/d7/7d72d709bc3b4c8cb808bfd8757274b5/images/home/u22.svg?pageId=72106482-35bb-4343-a7ce-8978a29e3df2" alt="">
                    <b>List of News</b></p>
                <!-- News Navigation Tabs -->
                <div class="news-tabs">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="#" id="headline-tab">Headline</a></li>
                        <li><a href="#" id="latest-tab">Latest</a></li>
                    </ul>
                </div>

                <!-- News Content Area -->
                <div id="news-content">
                    <!-- Default content for Headline -->
                    <div id="headline-content">
                        <?php foreach($headline_news as $row): 
                            $news_date = strtotime($row['news_date']);
                            $formatted_date = ($news_date) ? date('F j, Y', $news_date) : 'Invalid Date';
                        ?>
                        <p><br>
                            <?php echo $row['title']; ?>
                            <br>
                            BY <?php echo $row['author']; ?>
                            <br>
                            <?php echo $formatted_date ?>
                        </p>
                        <p><?php echo $row['content']; ?></p><hr>
                        <?php endforeach ?>
                    </div>

                    <!-- Latest news (this can be dynamically updated later using AJAX) -->
                    <div id="latest-content" style="display: none;">
                        <!-- Fetch latest news dynamically or show predefined latest news -->
                        <ol style="display: flex; flex-direction: column; gap: 10px;">
                        <?php foreach ($latest_news as $row): ?>
                            <li>
                                <a href="view_news.php?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>">
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>

                        </ol>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 text-center buttonspacing" data-aos="fade-left">
                <a href="./register.php">
                    <button type="submit" class="registerbutton">Register</button>
                </a>
                <a href="./verify.php">
                    <button type="submit" class="verifybuttton">Verify Here!</button>
                </a>
            </div>                    
        </div>
    </div>
        </section>
    </main>

    <script src="assets/js/script.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // jQuery to switch between Headline and Latest news
        $(document).ready(function() {
            $('#headline-tab').click(function(e) {
                e.preventDefault();
                $('#headline-content').show();
                $('#latest-content').hide();
                $(this).parent().addClass('active');
                $('#latest-tab').parent().removeClass('active');
            });

            $('#latest-tab').click(function(e) {
                e.preventDefault();
                $('#latest-content').show();
                $('#headline-content').hide();
                $(this).parent().addClass('active');
                $('#headline-tab').parent().removeClass('active');
            });
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <?php include './components/footer.php'; ?>

</body>




</html>