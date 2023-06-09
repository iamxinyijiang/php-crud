<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Cabin</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="images/accommodation.png" alt="Accommodation"> </a>
        <a href="index.php">
            <h1>SunnySpot Accommodation</h1>
        </a>
    </header>

    <section class="non-index">
        <div>
            <h2>Select a Cabin to Delete:</h2><br>
            <form class="delete-cabin-form" action="deleteCabin.php" method="post">
                <?php
                // Include the db.php file for database connection
                require_once "db.php";

                // Retrieve cabin information from the database
                // Query the database for cabin information
                $query = "SELECT * FROM Cabin";
                $result = $conn->query($query);

                // Display cabin dropdown list dynamically
                if ($result->num_rows > 0) {
                    echo '<select class="delete-cabin-select" name="cabinID">';
                    echo '<option value="" selected disabled>Select a Cabin to Delete</option>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['cabinID'] . '">' . $row['cabinType'] . '</option>';
                    }
                    echo '</select>';
                    echo '<input type="submit" value="Select">';
                } else {
                    echo 'No cabins found.';
                }
                ?>
            </form>

            <?php
            // Check if the cabin ID is provided in the POST request
            if (isset($_POST['cabinID'])) {
                $cabinID = $_POST['cabinID'];

                // Retrieve cabin information from the database
                // Query the database for cabin information
                $query = "SELECT * FROM Cabin WHERE cabinID = $cabinID";
                $result = $conn->query($query);

                // Display cabin information dynamically
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<form class="delete-cabin-details" action="processDeleteCabin.php" method="post" enctype="multipart/form-data" >';
                    echo '<input type="hidden" name="cabinID" value="' . $row['cabinID'] . '">';
                    echo '<label for="cabinType">Cabin Type:</label>';
                    echo '<input type="text" name="cabinType" value="' . $row['cabinType'] . '" readonly>';
                    echo '<label for="cabinDescription">Cabin Description:</label>';
                    echo '<textarea name="cabinDescription" rows="5" readonly>' . $row['cabinDescription'] . '</textarea>';
                    echo '<label for="pricePerNight">Price per Night:</label>';
                    echo '<input type="text" name="pricePerNight" value="' . $row['pricePerNight'] . '" readonly>';
                    echo '<label for="pricePerWeek">Price per Week:</label>';
                    echo '<input type="text" name="pricePerWeek" value="' . $row['pricePerWeek'] . '" readonly>';
                    echo '<label for="currentPhoto">Current Photo:</label>';
                    echo '<img class="current-photo" src="' . $row['photo'] . '" alt="Current Photo">';
                    echo '<input class="delete-cabin-button" type="submit" value="Delete Cabin">';
                    echo '</form>';
                } else {
                    echo 'No cabin found with the selected ID.';
                }
            }

            // Close the database connection
            $conn->close();
            ?>

        </div>

    </section>

    <footer>
        <a href="adminMenu.php">Return to Admin Panel</a>
        <p>&copy; 2023 SunnySpot Accommodation</p>
    </footer>
</body>

</html>