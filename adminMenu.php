<?php
require('admin/auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<div class="welcome-message">
        
        <div class="welcome-message-items">
            <?php
            if (isset($_SESSION['userName'])) {
                $firstName = $_SESSION['firstName'];
                echo "Welcome, $firstName! <a href='admin/logout.php'>Log out</a>";} 
            ?>
        </div>
    </div>

<head>
    <meta charset="UTF-8">
    <title>Administrative Menu</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="images/accommodation.png" alt="Accommodation">
        </a>
        <a href="index.php">
            <h1>SunnySpot Accommodation</h1>
        </a>
    </header>
    <section class="non-index">
        <div>
            <h2>Administrative Menu</h2>
            <nav>
                <ul>
                    <li><button class="button" onclick="window.location.href='insertCabin.php'">Insert a New Cabin</button></li>
                    <li><button class="button" onclick="window.location.href='updateCabin.php'">Update a Cabin</button></li>
                    <li><button class="button" onclick="window.location.href='deleteCabin.php'">Delete a Cabin</button></li>
                    <li><button class="button" onclick="window.location.href='allCabins.php'">View All Cabins</button></li>
                </ul>
            </nav>
        </div>
    </section>
    <footer>
        <p><a href="index.php">Return to Home</a></p>
        <p>&copy; 2023 SunnySpot Accommodation</p>
    </footer>
</body>

</html>
