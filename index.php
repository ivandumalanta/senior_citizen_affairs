<?php
include './database/db_connection.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior citizen affairs</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
</head>
<body>
    <nav class="navbar">
        <?php include './components/nav.php'; ?>
    </nav>

    <main>
        <section id="home">
          <div class="news">
            <div class="sub-head">
                list of news
            </div>
          </div>
          <div class="buttons">
          <button><a href="register.php">
                Register Now 
            </a></button>
            <button><a href="register.php">
                Verify Here    
            </a></button>
          </div>
            
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>
