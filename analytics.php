<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior citizen affairs</title>
    <link rel="stylesheet" href="assets/css/styleHome.css">
    <link rel="stylesheet" href="assets/css/analytics.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <nav class="navbar">
        <?php include './components/nav.php'; ?>
    </nav>

    <main id="analytics">
    <div class="masthead" >
        <div class="container ">
            <h1 class="text-center"><b>Analytics</b></h1>
            <div class="row formanalytics">
                <div class="col-sm-4 ">
                    <button class="analyticsbutton spacingtop">
                        <a href="Status.php" class="linkbutton">Status</a>
                    </button>
                    <button class="analyticsbutton spacingtop">
                        <a href="Class.php" class="linkbutton">Classification</a>
                    </button>
                    <button class="analyticsbutton spacingtop">
                        <a href="sex.php" class="linkbutton">Sex</a>
                    </button>
                    <button class="analyticsbutton spacingtop">
                        <a href="civilstatus.php" class="linkbutton">Civil Status</a>
                    </button>
                </div>
                <div class="col-sm-4">
                    <button class="analyticsbutton spacingtop">
                        <a href="bloodtype.php" class="linkbutton">Blood Type</a>
                    </button>

                    <button class="analyticsbutton spacingtop">
                        <a href="religion.php" class="linkbutton">Religion</a>
                    </button>
                    <button class="analyticsbutton spacingtop">
                        <a href="educational.php" class="linkbutton">Educational Attainment</a>
                    </button>
                    <button class="analyticsbutton spacingtop">
                        <a href="employment.php" class="linkbutton">Employment Status</a>
                    </button>
                </div>
            </div>

        </div>
<br>
    </main>
    <br>
    <br>
    <br>
    <br>
    <?php include './components/footer.php'; ?>  
</body>

</html>