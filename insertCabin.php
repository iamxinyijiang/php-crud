<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Insert Cabin</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
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
            <h2>Add a New Cabin</h2>
            <form class= "insert-form"action="processInsertCabin.php" method="POST" enctype="multipart/form-data">
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
        <a href="adminMenu.php">Return to Admin Panel</a>
        <p>&copy; 2023 SunnySpot Accommodation</p>
    </footer>
</body>

</html>