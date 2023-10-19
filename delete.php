<!--
    Name/ID: Viet Hoang Pham 104506968
    Assignment 2
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name = "description" content = "Delete Record" />
    <meta name = "keywords" content = "Delete Record" />
    <meta name = "author" content = "Viet Hoang Pham" >
    <title>HPM: Delete Record</title>
    <link rel = "stylesheet" href = "styles/style.css">
    <link rel = "stylesheet" href = "styles/ErrorMessage.css">
</head>
<?php
    session_start();

    if(!isset($_SESSION["authenticated"])){
        header("Location: login.php"); // Redirect to the login page if not authenticated.
        exit;
    }

    // This function sanitise data to remove leading and trailing spaces, backslashes and HTML control characters.
    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_GET['id'])) {
        $id = sanitise_input($_GET['id']);

        require_once("settings.php");
        try{
            // Attempt to connect to the database
            $conn = mysqli_connect($host, $user, $pwd, $sql_db);

            if (!$conn){
                // Throw Exception if connection fail
                throw new Exception('Database connection error: ' . mysqli_connect_error());
            }
            $sql_table = "eoi";
            $sql_column = "EOInumber";
            $query = "DELETE FROM $sql_table WHERE $sql_column = $id";

            $result = mysqli_query($conn, $query);
            if(!$result){
                echo '
                <div id = "errorMessage">
                    <h1>500</h1>
                    <h2>Something goes wrong</h2>
                    <p>It seems like there are some problems in the application recording process.</p>
                    <p>Please try again. Apologies.</p>
                    <a href = "manage.php">Back To Manage</a>
                </div>
                ';
            }else{
                echo "
                <div id = 'successMessage'>
                    <h1>Success!</h1>
                    <h2>You have succesfully delete the record</h2>
                    <h3>Your deleted record EOI number is <span style = 'color: #f22800; font-weight: bold;'>#$id</span></h3>
                    <a href = 'manage.php'>Back To Manage</a>
                </div>";
            }
            mysqli_close($conn);
        }catch(Exception $e) {
            // Redirect to an error page if there is a connection problem
            header ("location: errorPageForConnection.html");
        }
    } else {
        header("Location: manage.php");
    }    
?>
