<?php
require('admin/auth.php');
?>
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
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="adminMenu.php">Admin Menu</a></li>
        <li>Delete Cabin</li>
    </ul>
    <section class="non-index">
        <div>
            <h2>Select a Cabin to Delete:</h2><br>
            <form class="delete-cabin-form" action="deleteCabin.php" method="post">
                <?php
                // Include the db.php file for database connection
                require_once "db.php";

                // Retrieve cabin information from the database
                // Query the database for cabin information
                $query = "SELECT * FROM cabin";
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
                $query = "SELECT * FROM cabin WHERE cabinID = $cabinID";
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
        <p></p><a href="adminMenu.php">Return to Admin Menu</a></p>
        <p>&copy; 2023 SunnySpot Accommodation</p>
    </footer>
</body>

</html>