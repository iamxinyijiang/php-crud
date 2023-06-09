<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $cabinType = trim($_POST["cabinType"]);
    $cabinDescription = trim($_POST['cabinDescription']);
    $pricePerNight = floatval($_POST["pricePerNight"]);
    $pricePerWeek = floatval($_POST["pricePerWeek"]);

    // Validate the image file
    $photo = $_FILES["photo"];
    $photoError = $photo["error"];

    // Check if an image is uploaded
    if ($photoError === UPLOAD_ERR_NO_FILE) {
        // No image uploaded, set a default image
        $photoPath = "images/testCabin.jpg";
    } else {
        // Check if the uploaded file is a valid image
        if (is_uploaded_file($photo["tmp_name"]) && getimagesize($photo["tmp_name"])) {
            // Check the file size
            if ($photo["size"] <= 200 * 1024) { // 200KB size limit
                // Check the file name length
                $filename = basename($photo["name"]);
                if (strlen($filename) <= 50) { // 50 characters limit
                    // Move the uploaded image to a desired location
                    $photoPath = "images/" . $filename;
                    move_uploaded_file($photo["tmp_name"], $photoPath);
                } else {
                    // Invalid file name length
                    die("The file name is too long. Please choose a shorter file name.");
                }
            } else {
                // Invalid image file size
                die("The image file size exceeds the limit of 200KB.");
            }
        } else {
            // Invalid image file
            die("Invalid image file. Please upload a valid image.");
        }
    }

    // Validate the price per night and price per week
    if ($pricePerNight <= 0 || $pricePerWeek > ($pricePerNight * 5)) {
        die("Invalid price values. Please enter a positive price per night and make sure the price per week is not more than 5 times the price per night.");
    }

    // Include the db.php file for database connection
    require_once "db.php";

    // Prepare the SQL statement for inserting data into the cabin table
    $sql = "INSERT INTO Cabin (cabinType, photo, cabinDescription, pricePerNight, pricePerWeek) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the SQL statement
    $stmt->bind_param("sssdd", $cabinType, $photoPath, $cabinDescription, $pricePerNight, $pricePerWeek);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Success message
        echo "Cabin inserted successfully!";
    } else {
        // Error message
        echo "Error inserting cabin: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>