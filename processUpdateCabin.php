<?php
// Include the db.php file for database connection
require_once "db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the cabin ID is provided
    if (isset($_POST['cabinID'])) {
        $cabinID = $_POST['cabinID'];

        // Retrieve the existing cabin details from the database
        $query = "SELECT * FROM cabin WHERE cabinID = $cabinID";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cabinType = trim($_POST['cabinType']);
            $cabinDescription = trim($_POST['cabinDescription']);
            $pricePerNight = floatval($_POST['pricePerNight']);
            $pricePerWeek = floatval($_POST['pricePerWeek']);

            // Check if a new photo is uploaded
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photo = $_FILES['photo'];
                $photoError = $photo['error'];

                // Check if an image is uploaded
                if ($photoError === UPLOAD_ERR_NO_FILE) {
                    // No image uploaded, keep the existing photo
                    $photoPath = ($row['photo'] !== "images/testCabin.jpg") ? $row['photo'] : "image/testCabin.jpg";
                } else {
                    // Check if the uploaded file is a valid image
                    if (is_uploaded_file($photo['tmp_name']) && getimagesize($photo['tmp_name'])) {
                        // Check the file size
                        if ($photo['size'] <= 200 * 1024) { // 200KB size limit
                            // Check the file name length
                            $filename = basename($photo['name']);
                            if (strlen($filename) <= 50) { // 50 characters limit
                                // Move the uploaded image to a desired location
                                $targetDir = "images/";
                                $targetFile = $targetDir . $filename;
                                move_uploaded_file($photo['tmp_name'], $targetFile);
                                $photoPath = "images/" . $filename;

                                // Delete the old photo file if it exists and it's not the default image
                                if ($row['photo'] !== "images/testCabin.jpg" && file_exists($row['photo'])) {
                                    unlink($row['photo']);
                                }
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
            } else {
                // Keep the existing photo if no new photo is uploaded
                $photoPath = ($row['photo'] !== "testCabin.jpg") ? $row['photo'] : "testCabin.jpg";
            }

            // Validate the price per night and price per week
            if ($pricePerNight <= 0 || $pricePerWeek > ($pricePerNight * 5)) {
                die("Invalid price values. Please enter a positive price per night and make sure the price per week is not more than 5 times the price per night.");
            }

            // Update the cabin details in the database
            $updateQuery = "UPDATE Cabin SET cabinType=?, cabinDescription=?, pricePerNight=?, pricePerWeek=?, photo=? WHERE cabinID=?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ssddsi", $cabinType, $cabinDescription, $pricePerNight, $pricePerWeek, $photoPath, $cabinID);

            if ($stmt->execute()) {
                echo "Cabin details updated successfully!";
            } else {
                echo "Error updating cabin details: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

// Close the database connection
$conn->close();
?>