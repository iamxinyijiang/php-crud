<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunnyspot Accommodation</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="welcome-message">

        <div class="welcome-message-items">
            <?php
            session_start();
            if (isset($_SESSION['userName'])) {
                $firstName = $_SESSION['firstName'];
                echo "Welcome, $firstName! <a href='logout.php'>Log out</a>";
            } else {
                echo "You are not logged in. <a href='login.php' target='blank'>Log in</a>";
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

    <section>
        <?php
        // Include the db.php file for database connection
        require_once "db.php";

        // Retrieve cabin information from the database
        // Query the database for cabin information
        $query = "SELECT * FROM Cabin";
        $result = $conn->query($query);

        // Display cabin information dynamically
        if ($result->num_rows > 0) {
            // Loop through each row of the result set
            while ($row = $result->fetch_assoc()) {
                echo '<article>';
                echo '<img src="' . $row['photo'] . '" alt="' . $row['cabinType'] . '">';
                echo '<h2>' . $row['cabinType'] . '</h2>';
                echo '<p><span>Details: </span>' . $row['cabinDescription'] . '</p>';
                echo '<p><span>Price per night: </span>$' . $row['pricePerNight'] . '</p>';
                echo '<p><span>Price per week: </span>$' . $row['pricePerWeek'] . '</p>';
                echo '</article>';
            }
        } else {
            echo 'No cabins found.';
        }

        // Close the database connection
        $conn->close();
        ?>
    </section>
    <footer>
        <p><a href="adminMenu.php" target="blank">Admin Menu</a></p>
        <p>&copy; 2023 SunnySpot Accommodation</p>
    </footer>
</body>

</html>