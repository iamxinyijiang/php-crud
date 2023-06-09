<?php
require('admin/auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insert Cabin</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="welcome-message">

        <div class="welcome-message-items">
            <?php
            if (isset($_SESSION['userName'])) {
                $firstName = $_SESSION['firstName'];
                echo "Welcome, $firstName! <a href='admin/logout.php'>Log out</a>";
            } else {
                echo "You are not logged in. <a href='admin/login.php'>Log in</a>";
            }
            ?>
        </div>
    </div>
    <header>
        <a href="index.php">
            <img src="images/accommodation.png" alt="Accommodation"> </a>
        <a href="index.php">
            <h1>SunnySpot Accommodation</h1>
        </a>
    </header>


    <section class="non-index">
        <div>
            <h2>Add a New Cabin</h2>
            <form class="insert-form" action="processInsertCabin.php" method="POST" enctype="multipart/form-data">
                <label for="cabinType">Cabin Name:</label>
                <input type="text" id="cabinType" name="cabinType" required><br>

                <label for="cabinDescription">Cabin Description:</label>
                <textarea type="text" id="cabinDescription" name="cabinDescription" rows="5" required></textarea><br>

                <label for="photo">Cabin Photo:</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg, image/png"><br>

                <label for="pricePerNight">Price per Night:</label>
                <input type="number" id="pricePerNight" name="pricePerNight" min="0" step="0.01" required><br>

                <label for="pricePerWeek">Price per Week:</label>
                <input type="number" id="pricePerWeek" name="pricePerWeek" min="0" step="0.01" required><br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </section>
    <footer>
        <p></p><a href="adminMenu.php">Return to Admin Menu</a></p>
        <p>&copy; 2023 SunnySpot Accommodation</p>
    </footer>
</body>

</html>