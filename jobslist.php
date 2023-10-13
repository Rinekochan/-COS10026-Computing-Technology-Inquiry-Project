<!--
    Name/ID: Viet Hoang Pham 104506968, Siradanai Inchansuk 104860428
    Assignment 2
-->
<!DOCTYPE html>

<html lang = "en">
<head>
    <meta charset = "utf-8" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is jobslist page of HPM" >
    <meta name = "keywords" content = "Jobs List page" >
    <!-- Developer of this page is Siradanai Inchansuk, Viet Hoang Pham -->
    <meta name = "author" content = "Siradanai Inchansuk, Viet Hoang Pham" >
    <title>HPM: Jobs List</title>
    <!-- This css file styles manager website -->
    <link rel = "stylesheet" href = "styles/ManagerStyle.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel = "shortcut icon" href = "images/favicon.png">
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

    <!--Developer: Viet Hoang Pham. This is Manager Navigation Menu and Header code. You should add this at the start of <body> element-->
    <?php include_once 'managermenuandheader.inc';?>
    <!--End of Navigation Menu Code.-->
    
    <main>
        <form method = "POST" action = "jobslist.php" id = "mainform">
            <div id = "serverquery">
                <a href = "addjobs.php">Add Jobs</a>
            </div>
            <table>
                <tr id = "tableheader">
                    <th><button type = "submit" name = "sortID">ID <i class = "fa fa-sort"></i></button></th>
                    <th><button type = "submit" name = "sortName">Jobs <i class = "fa fa-sort"></i></button></th>
                    <th><button type = "submit" name = "sortSalary">Salary <i class = "fa fa-sort"></i></button></th>
                    <th>More</th>
                    <th>Delete</th>
                </tr>
                <tr>
                    <td class = 'mainTextName'> #1 </td>
                    <td>
                        <p class = 'mainTextName'>Software Developer</p>
                        <p class = 'subText'>00001</p>
                    </td>
                    <td>$70,000 - $100,000</td>
                    <td><span class = 'editButton'><i class = 'fa fa-edit'></i></span></td>
                    <td class = 'deleteButton'><span class = 'deleteButton'><i class = 'fa fa-trash'></i></span></td>
                </tr>
                <tr>
                    <td class = 'mainTextName'> #2 </td>
                    <td>
                        <p class = 'mainTextName'>Network Administrator</p>
                        <p class = 'subText'>00010</p>
                    </td>
                    <td>$70,000 - $90,000</td>
                    <td><span class = 'editButton'><i class = 'fa fa-edit'></i></span></td>
                    <td class = 'deleteButton'><span class = 'deleteButton'><i class = 'fa fa-trash'></i></span></td>
                </tr>
                <tr>
                    <td class = 'mainTextName'> #3 </td>
                    <td>
                        <p class = 'mainTextName'>Cyber Security Analyst</p>
                        <p class = 'subText'>00011</p>
                    </td>
                    <td>$70,000 - $90,000</td>
                    <td><span class = 'editButton'><i class = 'fa fa-edit'></i></span></td>
                    <td class = 'deleteButton'><span class = 'deleteButton'><i class = 'fa fa-trash'></i></span></td>
                </tr>
                <tr>
                    <td class = 'mainTextName'> #4 </td>
                    <td>
                        <p class = 'mainTextName'>IT Project Manager</p>
                        <p class = 'subText'>00100</p>
                    </td>
                    <td>$80,000 - $100,000</td>
                    <td><span class = 'editButton'><i class = 'fa fa-edit'></i></span></td>
                    <td class = 'deleteButton'><span class = 'deleteButton'><i class = 'fa fa-trash'></i></span></td>
                </tr>
                <tr>
                    <td class = 'mainTextName'> #5 </td>
                    <td>
                        <p class = 'mainTextName'>Data Analyst</p>
                        <p class = 'subText'>00101</p>
                    </td>
                    <td>$50,000 - $70,000</td>
                    <td><span class = 'editButton'><i class = 'fa fa-edit'></i></span></td>
                    <td class = 'deleteButton'><span class = 'deleteButton'><i class = 'fa fa-trash'></i></span></td>
                </tr>
            </table>
            <!-- Pagination of the manage page -->
            <div id = "pagination">
                <a href = "">First</a>
                <a href = "">Previous</a>
                <a href = "" id = "currentPage">1</a>
                <a href = "">2</a>
                <a href = "">3</a>
                <a href = "">4</a>
                <a href = "">...</a>
                <a href = "">Next</a>
                <a href = "">Last</a>
            </div>
        </form>
    </main>
</body>