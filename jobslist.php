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
        function sanitise_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

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

        require_once("settings.php");
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

        $sql_table = "jobs";
        $checkTableSQL = "SHOW TABLES LIKE '$sql_table'";
        $result = mysqli_query($conn, $checkTableSQL);
        if (!$result || mysqli_num_rows($result) == 0) {
            $createTableSQL = "
            CREATE TABLE `jobs` (
                `JobID` int(11) NOT NULL AUTO_INCREMENT,
                `JobRefNum` varchar(5) NOT NULL,
                `JobTitle` varchar(30) NOT NULL,
                `JobDesc` varchar(80) NOT NULL,
                `JobSalary` varchar(30) NOT NULL,
                `JobRepTo` varchar(30) NOT NULL,
                `JobResp` varchar(300) NOT NULL,
                `JobReq` varchar(300) NOT NULL, 
                PRIMARY KEY (`JobID`)
                )";
            if(!mysqli_query($conn, $createTableSQL)){
                throw new Exception('Table creation error: ' . mysqli_connect_error());
            }
            $resp = 'Architect, develop, and maintain high-quality software solutions.\nCollaborate with multidisciplinary teams to define project specifications.';
            $req = sanitise_input("Bachelor's degree in Computer Science, Software Engineering, or related field.\nProficiency in languages like Java, C++, or Python.\n3+ years of professional software development experience.");
            $query = "insert into $sql_table (JobRefNum, JobTitle, JobDesc, JobSalary, JobRepTo, JobResp, JobReq) 
            values ('00001', 'Software Developer', 'Design, code, and maintain software applications to drive innovation.', 
            '$70,000 - $100,000', 'Lead Software Developer','$resp', '$req')";
            
            $result = mysqli_query($conn, $query);
            
            $desc = sanitise_input("Manage and maintain the organization's network infrastructure and security.");
            $resp = sanitise_input("Design, implement, and manage network configurations and architecture.\nMonitor network performance and ensure efficient operation.\nIdentify and resolve network issues, both hardware and software.");
            $req = sanitise_input("Bachelor's degree in Computer Science or related field.\nProficiency in Java and Python programming.\n2+ years of software development experience.");
            $query = "insert into $sql_table (JobRefNum, JobTitle, JobDesc, JobSalary, JobRepTo, JobResp, JobReq) 
            values ('00010', 'Network Administrator', '$desc', '$70,000 - $90,000', 'IT Manager','$resp', '$req')";
            $result = mysqli_query($conn, $query);

            if(!$result){
                mysqli_close($conn);
                echo '
                    <div id = "errorMessage">
                        <h1>500</h1>
                        <h2>Something goes wrong</h2>
                        <p>It seems like there are some problems in the application recording process.</p>
                        <p>Please try again. Apologies.</p>
                        <a href = "processJob.php">Back To Apply</a>
                    </div>
                    ';
            }
        }


        $sql_query = "";
        $sql_table = "jobs";
        $currentID = 'unactive';
        $currentApplicants = 'unactive';
        $currentSalary = 'unactive';
        if($_SERVER["REQUEST_METHOD"] != "POST"){
            $sql_query = "SELECT * FROM $sql_table";
            $currentID = 'activeASC';
            $_SESSION["currentSort"] = "sortID";
            $_SESSION["sortOrder"] = "ASC";
        } else {
            if (isset($_POST["sortID"])) {
                // Sort by ID, toggle ascending and descending order
                if(isset($_SESSION["currentSort"]) && $_SESSION["currentSort"] == "sortID" && $_SESSION["sortOrder"] == "ASC"){
                    $sql_query = "SELECT * FROM $sql_table ORDER BY EOInumber DESC";
                    $currentID = 'activeDESC';
                    $_SESSION["currentSort"] = "sortID";
                    $_SESSION["sortOrder"] = "DESC";
                } else {
                    $sql_query = "SELECT * FROM $sql_table ORDER BY EOInumber ASC";
                    $currentID = 'activeASC';
                    $_SESSION["currentSort"] = "sortID";
                    $_SESSION["sortOrder"] = "ASC";
                }
            }
            else if (isset($_POST["sortName"])){
                if(isset($_SESSION["currentSort"]) && $_SESSION["currentSort"] == "sortName" && $_SESSION["sortOrder"] == "ASC"){
                    $sql_query = "SELECT * FROM $sql_table ORDER BY EOInumber DESC";
                    $currentApplicants = 'activeDESC';
                    $_SESSION["currentSort"] = "sortName";
                    $_SESSION["sortOrder"] = "DESC";
                } else {
                    $sql_query = "SELECT * FROM $sql_table ORDER BY EOInumber ASC";
                    $currentApplicants  = 'activeASC';
                    $_SESSION["currentSort"] = "sortName";
                    $_SESSION["sortOrder"] = "ASC";
                }
            }
            else if (isset($_POST["sortSalary"])){
                if(isset($_SESSION["currentSort"]) && $_SESSION["currentSort"] == "sortSalary" && $_SESSION["sortOrder"] == "ASC"){
                    $sql_query = "SELECT * FROM $sql_table ORDER BY EOInumber DESC";
                    $currentSalary = 'activeDESC';
                    $_SESSION["currentSort"] = "sortSalary";
                    $_SESSION["sortOrder"] = "DESC";
                } else {
                    $sql_query = "SELECT * FROM $sql_table ORDER BY EOInumber ASC";
                    $currentSalary = 'activeASC';
                    $_SESSION["currentSort"] = "sortSalary";
                    $_SESSION["sortOrder"] = "ASC";
                }
            }
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
                    <?php 
                    echo "
                    <th><button type = 'submit' name = 'sortID' id = $currentID>ID <i class = 'fa fa-sort'></i></button></th>
                    <th><button type = 'submit' name = 'sortName' id = $currentApplicants>Jobs <i class = 'fa fa-sort'></i></button></th>
                    <th><button type = 'submit' name = 'sortSalary' id = $currentSalary>Salary <i class = 'fa fa-sort'></i></button></th>
                    <th>More</th>"
                    ?>
                    <th>Delete</th> 
                </tr>
                <?php 
                    require_once("settings.php");
                    try{
                        // Attempt to connect to the database
                        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                        if (!$conn){
                            // Throw Exception if connection fail
                            throw new Exception('Database connection error: ' . mysqli_connect_error());
                        }
                        $result = mysqli_query($conn, $sql_query);
                        if (!$result) {
                            // Redirect to an error page if there is a connection problem
                            throw new Exception('Table query error: ' . mysqli_connect_error());
                        }

                        while ($row = mysqli_fetch_assoc($result)) {
                            $JobID = $row['JobID'];
                            $JobRefNum = $row['JobRefNum'];
                            $JobTitle = $row['JobTitle'];
                            $JobSalary = $row['JobSalary'];
                            echo"
                            <tr>
                                <td class = 'mainTextName'> $JobID </td>
                                <td>
                                    <p class = 'mainTextName'>$JobTitle</p>
                                    <p class = 'subText'>$JobRefNum</p>
                                </td>
                                <td>$JobSalary</td>
                                <td class = 'editContainer'><a href = 'edit.php?id=$JobID'><span class = 'editButton'><i class = 'fa fa-edit'></i></span><p>'</p></a></td>
                                <td class = 'deleteContainer'><a href = 'delete.php?id=$JobID'><span class = 'deleteButton'><i class = 'fa fa-trash'></i></span><p>'</p></a></td>
                            </tr>
                            ";
                        }
                        mysqli_close($conn);
                    }catch(Exception $e) {
                        // Redirect to an error page if there is a connection problem
                        header ("location: errorPageForConnection.html");
                    }
                ?>
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
