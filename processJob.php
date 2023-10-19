<!--
    Name/ID: Siradanai Inchansuk 104860428
    Assignment 2
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Processing New Job" />
    <meta name="keywords" content="PHP, MySql" />
    <meta name="author" content="Siradanai Inchansuk" >
    <title>HPM: Processing Application</title>
    <link rel = "stylesheet" href = "styles/style.css">
    <link rel = "stylesheet" href = "styles/ErrorMessage.css">
</head>
<body>
<?php
    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if (!isset($_POST["ReferenceNumber"])){
        header ("location: addjobs.php");
    }
    
    require_once("settings.php");
    try{
        // Attempt to connect to the database
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn){
            // Throw Exception if connection fail
            throw new Exception('Database connection error: ' . mysqli_connect_error());
        }
        $sql_table = 'jobs';
        $checkTableSQL = "SHOW TABLES LIKE '$sql_table'";
        $result = mysqli_query($conn, $checkTableSQL);
        if (!$result || mysqli_num_rows($result) == 0) {
            $createTableSQL = "
            CREATE TABLE `jobs` (
                `JobID` int(11) NOT NULL AUTO_INCREMENT,
                `JobRefNum` varchar(5) NOT NULL,
                `JobTitle` varchar(30) NOT NULL,
                `JobDesc` varchar(50) NOT NULL,
                `JobSalary` varchar(30) NOT NULL,
                `JobRepTo` varchar(30) NOT NULL,
                `JobResp` varchar(300) NOT NULL,
                `JobReq` varchar(300) NOT NULL,
                PRIMARY KEY (`JobID`)
                )";
            $query = "insert into $sql_table (JobRefNum, JobTitle, JobDesc, JobSalary, JobRepTo, JobResp, JobReq) 
            values ('00001', 'Software Developer', 'Design, code, and maintain software applications to drive innovation.', 
            '$70,000 - $100,000', 'Lead Software Developer','Architect, develop, and maintain high-quality software solutions.\n
            Collaborate with multidisciplinary teams to define project specifications.', 'Bachelor's degree in Computer Science, Software Engineering, or related field.
            \n Proficiency in languages like Java, C++, or Python. \n 3+ years of professional software development experience.')";
            $result = mysqli_query($conn, $query);
            if(!mysqli_query($conn, $createTableSQL)){
                throw new Exception('Table creation error: ' . mysqli_connect_error());
            }
        }
        $errMsg = "";
        if (isset($_POST["ReferenceNumber"])){
            $reference = sanitise_input($_POST["ReferenceNumber"]);
            if ($reference == ""){
                $errMsg .= "<p>You must enter a reference number.</p>";
            }
            else if (!preg_match("/^[a-zA-Z0-9]*$/", $reference)){
                $errMsg .= "<p>Only alphanumeric characters allowed in reference</p>";
            }
            else if (strlen($reference) != 5){
                $errMsg .= "<p>You must enter a reference of 5 characters</p>";
            }
        }
        if (isset($_POST["JobTitle"])){
            $title = sanitise_input($_POST["JobTitle"]);
            if ($title == ""){
                $errMsg .= "<p>You must enter a job title. </p>";
            }
            else if (!preg_match("/^[a-zA-Z\s]*$/", $title)){
                $errMsg .= "<p>The job title must only contain alpha characters </p>";
            }
        }
        if (isset($_POST["Description"])){
            $description = sanitise_input($_POST["Description"]);
            if ($description == ""){
                $errMsg .= "<p>You must enter a job description. </p>";
            }
        }
        if (isset($_POST["Salary"])){
            $salary = sanitise_input($_POST["Salary"]);
            if ($salary == ""){
                $errMsg .= "<p>You must enter a salary for the job </p>";
            }
        }
        if (isset($_POST["Reported"])){
            $reportTo = sanitise_input($_POST["Reported"]);
            if ($reportTo == ""){
                $errMsg .= "<p>You must enter a person to report to for this job </p>";
            }
        }
        if (isset($_POST["Responsibilities"])){
            $responsibilities = sanitise_input($_POST["Responsibilities"]);
            if ($reportTo == ""){
                $errMsg .= "<p>You must enter a job responsibility </p>";
            }
        }
        if (isset($_POST["Requirements"])){
            $requirements = sanitise_input($_POST["Requirements"]);
            if ($reportTo == ""){
                $errMsg .= "<p>You must enter a job requirement </p>";
            }
        }
        if ($errMsg != ""){
            echo '
            <div id = "errorMessage">
                <h1>Oops!</h1>
                <h2>There are some errors in your application form.</h2>
                ' . $errMsg . '
                <a href = "apply.php">Back To Apply</a>
            </div>';
        }
        else{
            $sql_table="jobs";
            $query = "insert into $sql_table (JobRefNum, JobTitle, JobDesc, JobSalary, JobRepTo, JobResp, JobReq) 
            values ('$reference', '$title', '$description', '$salary', '$reportTo','$responsibilities', '$requirements')";
            $result = mysqli_query($conn, $query);
            // Display error page if something is wrong with the query
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
            else{
                $last_id = mysqli_insert_id($conn);
                mysqli_close($conn);
                echo "
                <div id = 'successMessage'>
                    <h1>Success!</h1>
                    <h2>The Job ID is <span style = 'color: #f22800; font-weight: bold;'>#$last_id</span></h2>
                    <h2>The Job $title has been successfully added to the Database</h2>
                    <p>It should now appear on the jobs page</p>
                    <a href = 'manage.php'>Back To Manage</a>
                </div>
                ";
            }
        }
    }catch (Exception $e) {
        // Handle the exception: display a user-friendly message
        echo '
        <div id = "errorMessage">
            <h1>500</h1>
            <h2>Connection Error</h2>
            <p>It seems like there are some problems about the connection.</p>
            <p>Please try again. Apologies.</p>
            <a href = "addjobs.php">Back To Apply</a>
        </div>';
    }
?>