<!--
    Name/ID: Viet Hoang Pham 104506968
    Viet Hoang Pham is responsible for dashboard page, login/register page and front-end of manage page
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
    ?>
    <!--Developer: Viet Hoang Pham. This is Manager Navigation Menu code. You should add this at the start of <body> element-->
    <?php include_once 'managermenuandheader.inc';?>
    <!--End of Navigation Menu Code.-->

    <main>
        <div id = "Dashboard">
            <article id = "NewAppDashboard">
                <div>
                    <h2>New Application</h2>
                    <p>2</p>
                </div>
                <span class = "dashboardicon"><i class = "fa fa-tasks"></i></span>
            </article>
            <article id = "CurrentAppDashboard">
                <div>
                    <h2>Current Application</h2>
                    <p>2</p>
                </div>
                <span class = "dashboardicon"><i class = "fa fa-tasks"></i></span>
            </article>
            <article id = "FinalAppDashboard">
            <div>
                    <h2>Final Application</h2>
                    <p>2</p>
                </div>
                <span class = "dashboardicon"><i class = "fa fa-tasks"></i></span>
            </article>
        </div>
    </main>
</body>