<!--
    Name/ID: Viet Hoang Pham 104506968
    Assignment 2
-->
<!DOCTYPE html>

<html lang = "en">
<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is dashboard page for manager of HPM" >
    <meta name="keywords" content="Dashboard page" >
    <!-- Developer of this page is Viet Hoang Pham -->
    <meta name="author" content="Viet Hoang Pham" >
    <title>HPM: Manager Dashboard</title>
    <!-- This css file styles manager website -->
    <link rel = "stylesheet" href = "styles/ManagerStyle.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel = "shortcut icon" href="images/favicon.png">
</head>
<body id = "MainBackground">
    <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
            // Remove all session variables
            session_unset();

            // Destroy the session
            session_destroy(); 
            // The users have to login again when logout 
        }

        if(!isset($_SESSION["authenticated"])){
            header("Location: login.php"); // Redirect to the login page if not authenticated.
            exit;
        }
        if(isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])){
            $currentName = $_SESSION["firstName"] . " " . $_SESSION["lastName"];
        } else {
            $currentName = "Unknown";
        }    

        // Disable error display and configure error reporting
        // error_reporting(0);
        // ini_set('display_errors', 0);
        $countNew = 0;
        $countCurrent = 0;
        $countFinal = 0;
        require_once("settings.php");
        try{
            $conn = mysqli_connect($host, $user, $pwd, $sql_db);

            if (!$conn) {
                throw new Exception('Database connection error: ' . mysqli_connect_error());
            }

            // Check if the username already exists in the database
            $sql_table = "eoi";

            $countSQL = "SELECT COUNT(Status) AS 'Count' FROM $sql_table WHERE Status = 'New'";
            $result = mysqli_query($conn, $countSQL);
            if (!$result) {
                // Redirect to an error page if there is a connection problem
                throw new Exception('Table query error: ' . mysqli_connect_error());
            } 
            while ($row = mysqli_fetch_assoc($result)) {
                $countNew = $row['Count'];
            }

            $countSQL = "SELECT COUNT(Status) AS 'Count' FROM $sql_table WHERE Status = 'Current'";
            $result = mysqli_query($conn, $countSQL);
            if (!$result) {
                // Redirect to an error page if there is a connection problem
                throw new Exception('Table query error: ' . mysqli_connect_error());
            } 
            while ($row = mysqli_fetch_assoc($result)) {
                $countCurrent = $row['Count'];
            }

            $countSQL = "SELECT COUNT(Status) AS 'Count' FROM $sql_table WHERE Status = 'Final'";
            $result = mysqli_query($conn, $countSQL);
            if (!$result) {
                // Redirect to an error page if there is a connection problem
                throw new Exception('Table query error: ' . mysqli_connect_error());
            } 
            while ($row = mysqli_fetch_assoc($result)) {
                $countFinal = $row['Count'];
            }
            mysqli_close($conn);
        }catch (Exception $e) {
            // Redirect to an error page if there is a connection problem
            header("location: errorPageForConnection.html");
        } 
    ?>
    <!--Developer: Viet Hoang Pham. This is Manager Navigation Menu code. You should add this at the start of <body> element-->
    <?php include_once 'managermenuandheader.inc';?>
    <!--End of Navigation Menu Code.-->
    <!-- SELECT COUNT(Status) AS 'New' FROM eoi;  -->
    <main>
        <div id = "Dashboard">
            <article id = "NewAppDashboard">
                <div>
                    <h2>New Application</h2>
                    <?php
                    echo "<p>$countNew</p>";
                    ?>
                </div>
                <span class = "dashboardicon"><i class = "fa fa-tasks"></i></span>
            </article>
            <article id = "CurrentAppDashboard">
                <div>
                    <h2>Current Application</h2>
                    <?php
                    echo "<p>$countCurrent</p>";
                    ?>
                </div>
                <span class = "dashboardicon"><i class = "fa fa-tasks"></i></span>
            </article>
            <article id = "FinalAppDashboard">
            <div>
                    <h2>Final Application</h2>
                    <?php
                    echo "<p>$countFinal</p>";
                    ?>
                </div>
                <span class = "dashboardicon"><i class = "fa fa-tasks"></i></span>
            </article>
        </div>
    </main>
</body>