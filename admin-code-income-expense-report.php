<?php
require "dbconfig.php";
require "component.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected fruit value from the form
    $selectedValue = $_POST['selectedValue'];
    $bill_no = $_POST['bill_no'];

    // Update the table with the selected fruit value
    $updateQuery = "UPDATE bill SET status = '$selectedValue' WHERE bill_id = '$bill_no'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        // Database update successful, perform any additional actions or display a success message
        echo "Database update successful. Bill Status updated to: " . $selectedValue; 
        
        if (isset($_SESSION['id'])) {
            // Get the user information before destroying the session
            $userId = $_SESSION['id'];
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];
            $action = "Bill Cancel - $stbNo";
        
            // Call the function to insert user activity log
            logUserActivity($userId, $username, $role, $action);
        }
    
        ?>
        <center><img src="assets/green-thumbs-up.svg" alt="green-thumbs-up" width="512px" height="512px"></center>
        <?php
    } else {
        // Database update failed, handle the error
        echo "Error updating the database.";
        ?>
        <center><img src="assets/red-thumbs-down.svg" alt="green-thumbs-up" width="512px" height="512px"></center>
        <?php
    }
} else {
    // Redirect the user to the form page if accessed directly without submitting the form
    header("Location: admin-bill-cancel.php");
    exit();
}

// Redirect function
function redirect($url)
{
    echo "<script>
            setTimeout(function(){
                window.location.href = '$url';
            }, 1000);
        </script>";
}

// Usage example
// $url = "http://localhost/ctv/bill-last5-print.php"; 
$url = "admin-bill-cancel.php"; // Replace with your desired URL
redirect($url);
?>
