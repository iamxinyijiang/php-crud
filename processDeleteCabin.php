<?php
// Include the db.php file for database connection
require_once "db.php";

// Check if the cabin ID is provided in the POST request
if (isset($_POST['cabinID'])) {
    $cabinID = $_POST['cabinID'];

    // Get the cabin photo filename from the database
    $query = "SELECT photo FROM Cabin WHERE cabinID = $cabinID";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $photo = $row['photo'];

        // Delete the cabin from the database
        $deleteQuery = "DELETE FROM Cabin WHERE cabinID = $cabinID";

        if ($conn->query($deleteQuery) === TRUE) {
            echo "Cabin deleted successfully!";

            // Delete the cabin photo unless it is named "testCabin.jpg"
            if ($photo !== 'images/testCabin.jpg') {
                if (file_exists($photo)) {
                    unlink($photo);
                    echo "Cabin photo deleted.";
                }
            }
        } else {
            echo "Error deleting cabin: " . $conn->error;
        }
    } else {
        echo "Cabin not found.";
    }
} else {
    echo "Cabin ID not provided.";
}

// Close the database connection
$conn->close();
?>
