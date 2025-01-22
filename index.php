 <?php
        include './database/db_connection.php';
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior citizen affairs</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <nav class="navbar">
        <?php include './components/nav.php'; ?>
    </nav>

    <main>
        <section id="home">
            <div class="container-fluid homeimage">
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
                                <img src="https://www.oscaportal.com/banner/62906394.png" alt="Slide 1" style="width:100%;">
                                <div class="carousel-caption">

                                </div>
                            </div>
                            <div class="item">
                                <img src="https://www.oscaportal.com/banner/62290555.png" alt="Slide 2" style="width:100%;">
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
                    <div class="col-sm-2 calendarbody text-center">
                    <span><b id="current-year"></b></span>
                        <br>
                        <a href="#" data-toggle="modal" data-target="#calendarModal" onclick="showToday()">
                            <img src="https://jk2ws3.axshare.com/gsc/JK2WS3/7d/72/d7/7d72d709bc3b4c8cb808bfd8757274b5/images/home/u27.svg?pageId=72106482-35bb-4343-a7ce-8978a29e3df2"
                                alt="Calendar Icon"
                                style="width: 50px; height: 50px; cursor: pointer;">
                        </a>
                        <div id="calendarModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Calendar</h4>
                        <div id="calendar"></div>
                    </div>
                    <div class="modal-body">
                    <div class="current-day" id="current-day"></div>
                        <div id="calendarContainer" style="text-align: center;">
                            <!-- Calendar will render here -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
                    </div>
                    <div class="col-sm-4">
                        <p class="font16"> <img src="https://jk2ws3.axshare.com/gsc/JK2WS3/7d/72/d7/7d72d709bc3b4c8cb808bfd8757274b5/images/home/u22.svg?pageId=72106482-35bb-4343-a7ce-8978a29e3df2" alt="">
                         <b>List of News</b></p>

                        <p><br>
                            Salceda eyes separate PhilHealth insurance fund for seniors
                            <br>
                            BY Dexter Barro II
                            <br>
                            Apr 2, 2024 09:13 PM
                        </p>
                        <p>At a glance

                            House Committee on Ways and Means Chairman Albay 2nd district Rep. Joey Salceda says he is exploring the prospect of a separate insurance fund under the Philippine Health Insurance Corp. (PhilHealth) to address the healthcare financing gap of senior citizens.</p>
                        <hr>
                        </div>
                    <div class="col-sm-6 text-center buttonspacing">
                    <a href="./register.php">
                        <button type="submit" class="registerbutton">Register</button>
                      </a>
                        <a href="#">
                        <button type="submit" class="verifybuttton">Verify Here!</button>
                        </a>
                    </div>

                    
                </div>
            </div>
        </section>
    </main>

    <script src="assets/js/script.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
</body>

</html>