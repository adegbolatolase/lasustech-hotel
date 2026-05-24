<?php

include('connectDB.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!$dbConnection) {
        die('Could not connect to Lasustech Hotel database');
    } else {
        // Get user inputs and sanitize them
        $name = mysqli_real_escape_string($dbConnection, $_POST['name']);
        $review = mysqli_real_escape_string($dbConnection, $_POST['review']);

        // Use prepared statement to insert data
        $insertQuery = "INSERT INTO UserReviews (name, review) VALUES (?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($dbConnection, $insertQuery);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ss", $name, $review);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                header("Location: modal.html");
                exit();
            } else {
                die('Could not execute sql query.');
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            die('Could not prepare sql statement.');
        }
    }

    // Close the database connection
    mysqli_close($dbConnection);
}
?>