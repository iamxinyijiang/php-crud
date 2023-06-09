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
    <header> <img src="images/accommodation.png" alt="Accommodation">
        <h1>Sunnyspot Accommodation</h1>
    </header>

    <section class="non-index">
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
                echo '<h2>' . $row['cabinType'] . '</h2>';
                echo '<img src="' . $row['photo'] . '" alt="' . $row['cabinType'] . '">';
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
        <a href="adminMenu.php">Admin</a>
        <p>&copy; 2023 SunnySpot Accommodation</p>
    </footer>
</body>

</html>