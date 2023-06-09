<!DOCTYPE html>
<html>

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
        <div style="display:flex;flex-direction:column;">
            <h2>Administrative Menu</h2>
            <nav>
                <ul>
                    <li><button class="button" onclick="window.location.href='insertCabin.php'">Insert a New
                            Cabin</button></li>
                    <li><button class="button" onclick="window.location.href='updateCabin.php'">Update a
                            Cabin</button></li>
                    <li><button class="button" onclick="window.location.href='deleteCabin.php'">Delete a
                            Cabin</button></li>
                </ul>
            </nav>
        </div>
    </section>
    <footer>
        <a href="index.php">Return to Home</a>
        <p>&copy; 2023 SunnySpot Accommodation</p>
    </footer>
</body>

</html>