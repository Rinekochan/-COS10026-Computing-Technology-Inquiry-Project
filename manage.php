<!--
    Name/ID: Viet Hoang Pham 104506968, Humayra Jahan 104757245
    Viet Hoang Pham is responsible for dashboard page, login/register page and front-end of manage page
    Humayra Jahan is responsible for back-end of manage page 
    Assignment 2
-->
<!DOCTYPE html>

<html lang = "en">
<head>
    <meta charset = "utf-8" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is management page of HPM" >
    <meta name = "keywords" content = "Management page" >
    <!-- Developer of this page is Viet Hoang Pham, Humayra Jahan -->
    <meta name = "author" content = "Viet Hoang Pham, Humayra Jahan" >
    <title>HPM: Management</title>
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
        <form method = "POST" action = "manage.php" id = "mainform">
            <div id = "serverquery">
                <div id = "deleteJobReference">
                    <label for = "delete">Job Reference</label>
                    <select id = "delete" name = "JobRefNum">
                        <option value = "null">Choose</option>
                        <option value = "00001">00001</option>
                        <option value = "00010">00010</option>
                        <option value = "00011">00011</option>
                        <option value = "00100">00100</option>
                        <option value = "00101">00101</option>
                    </select>
                    <button type = "submit" name = "deleteJobRefNum">Remove Records</button>
                </div>
                <div id = "searchQuery">
                    <label for = "search">Field</label>
                    <select id = "search" name = "JobRefNum">
                        <option value = "all">All</option>
                        <option value = "jobrefnum">Job Reference</option>
                        <option value = "firstname">First Name</option>
                        <option value = "lastname">Last Name</option>
                        <option value = "fullname">Full Name</option>
                        <option value = "status">Status</option>
                    </select>
                    <label for = "searchquery">Search</label>
                    <input type = "text" id = "searchquery" name = "searchquery" placeholder = "Search...">
                    <button type = "submit" name = "search">Search</button>
                </div>
            </div>
            <table>
                <tr id = "tableheader">
                    <th><button type = "submit" name = "sortID">ID <i class = "fa fa-sort"></i></button></th>
                    <th><button type = "submit" name = "sortName">Applicants <i class = "fa fa-sort"></i></button></th>
                    <th><button type = "submit" name = "sortAge">Age <i class = "fa fa-sort"></i></button></th>
                    <th><button type = "submit" name = "sortJob">Preferred Job <i class = "fa fa-sort"></i></button></th>
                    <th><button type = "submit" name = "sortAdd">Address <i class = "fa fa-sort"></i></button></th>
                    <th><button type = "submit" name = "sortStatus">Status <i class = "fa fa-sort"></i></button></th>
                    <th>More</th>
                    <th>Delete</th>
                </tr>
                <tr>
                    <td class = "mainTextName">#1</td>
                    <td>
                        <p class = "mainTextName">Viet Hoang Pham <i class = "fa fa-mars"></i></p>
                        <p class = "subText">banana@gmail.com - 0123456789</p>
                    </td>
                    <td>18</td>
                    <td>
                        <p class = "mainText">IT Project Manager</p>
                        <p class = "subText">00100</p>
                    </td>
                    <td>
                        <p class = "mainText">5 Ohio Drive</p>
                        <p class = "subText">CBD, VIC, 3100</p>
                    </td>
                    <td><span class = "statusNew">New</span></td>
                    <td><span class = "editButton"><i class = "fa fa-edit"></i></span></td>
                    <td class = "deleteButton"><span class = "deleteButton"><i class = "fa fa-trash"></i></span></td>
                </tr>
                <tr>
                    <td class = "mainTextName">#2</td>
                    <td>
                        <p class = "mainTextName">Siradanai Inchansuk <i class = "fa fa-mars"></i></p>
                        <p class = "subText">banana@gmail.com - 0123456789</p>
                    </td>
                    <td>19</td>
                    <td>
                        <p class = "mainText">Software Developer</p>
                        <p class = "subText">00001</p>
                    </td>
                    <td>
                        <p class = "mainText">6 Ohio Drive</p>
                        <p class = "subText">CBD, VIC, 3100</p>
                    </td>
                    <td><span class = "statusFinal">Final</span></td>
                    <td><span class = "editButton"><i class = "fa fa-edit"></i></span></td>
                    <td><span class = "deleteButton"><i class = "fa fa-trash"></i></span></td>
                </tr>
                <tr>
                    <td class = "mainTextName">#3</td>
                    <td>
                        <p class = "mainTextName">Someone <i class = "fa fa-question-circle"></i></p>
                        <p class = "subText">banana@gmail.com - 0123456789</p>
                    </td>
                    <td>56</td>
                    <td>
                        <p class = "mainText">Network Administrator</p>
                        <p class = "subText">00010</p>
                    </td>
                    <td>
                        <p class = "mainText">7 Ohio Drive</p>
                        <p class = "subText">CBD, VIC, 3100</p>
                    </td>
                    <td><span class = "statusCurrent">Current</span></td>
                    <td><span class = "editButton"><i class = "fa fa-edit"></i></span></td>   
                    <td><span class = "deleteButton"><i class = "fa fa-trash"></i></span></td>
                </tr>
                    <td class = "mainTextName">#4</td>
                    <td>
                        <p class = "mainTextName">Viet Hoang Pham <i class = "fa fa-mars"></i></p>
                        <p class = "subText">banana@gmail.com - 0123456789</p>
                    </td>
                    <td>18</td>
                    <td>
                        <p class = "mainText">IT Project Manager</p>
                        <p class = "subText">00100</p>
                    </td>
                    <td>
                        <p class = "mainText">5 Ohio Drive</p>
                        <p class = "subText">CBD, VIC, 3100</p>
                    </td>
                    <td><span class = "statusNew">New</span></td>
                    <td><span class = "editButton"><i class = "fa fa-edit"></i></span></td>
                    <td class = "deleteButton"><span class = "deleteButton"><i class = "fa fa-trash"></i></span></td>
                </tr>
                <tr>
                    <td class = "mainTextName">#5</td>
                    <td>
                        <p class = "mainTextName">Siradanai Inchansuk <i class = "fa fa-mars"></i></p>
                        <p class = "subText">banana@gmail.com - 0123456789</p>
                    </td>
                    <td>19</td>
                    <td>
                        <p class = "mainText">Data Analyst</p>
                        <p class = "subText">00101</p>
                    </td>
                    <td>
                        <p class = "mainText">6 Ohio Drive</p>
                        <p class = "subText">CBD, VIC, 3100</p>
                    </td>
                    <td><span class = "statusFinal">Final</span></td>
                    <td><span class = "editButton"><i class = "fa fa-edit"></i></span></td>
                    <td><span class = "deleteButton"><i class = "fa fa-trash"></i></span></td>
                </tr>
                <tr>
                    <td class = "mainTextName">#6</td>
                    <td>
                        <p class = "mainTextName">Humayra Jahan <i class = "fa fa-venus"></i></p>
                        <p class = "subText">banana@gmail.com - 0123456789</p>
                    </td>
                    <td>18</td>
                    <td>
                        <p class = "mainText">Cyber Security Analyst</p>
                        <p class = "subText">00011</p>
                    </td>
                    <td>
                        <p class = "mainText">124 Station Street</p>
                        <p class = "subText">Box Hill, VIC, 3169</p>
                    </td>
                    <td><span class = "statusCurrent">Current</span></td>
                    <td><span class = "editButton"><i class = "fa fa-edit"></i></span></td>   
                    <td><span class = "deleteButton"><i class = "fa fa-trash"></i></span></td>
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