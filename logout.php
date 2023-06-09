<?php
session_start();

// Destroy all session variables
session_destroy();

// Redirect back to the previous page
header("Location:index.php ");
exit();
?>