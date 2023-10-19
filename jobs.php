<!--
    Name/ID: Humayra Jahan 104757245
    Assignment 1
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is the Jobs Description Page of the HPM Company">
    <meta name = "keywords" content = "JobsDescription">
    <!--The Developer of this page is Humayra Jahan.--> 
    <meta name = "author" content = "Humayra Jahan">
    <title>HPM: Job Vacancy and Careers</title>
    <!-- This .inc file includes all css locations for each resolution of devices -->
    <?php include_once 'cssfiles.inc';?>
    <link rel = "shortcut icon" href="images/favicon.png">
</head>
<body id = "MainBackground">
    <!--Developer: Viet Hoang Pham. This is Navigation Menu code. You should add this at the start of <body> element-->
    <?php include_once 'header.inc';?>
    <!--End of Navigation Menu Code.-->

    <!--Developer: Viet Hoang Pham. Scroll Up Button-->
    <?php include_once 'scrollupbutton.inc';?>
    <!-- End of Scroll up Button -->
    
    <?php 
        function sanitise_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
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
        }
    ?>
    <!--Developer: Humayra Jahan. This is the Jobs page.-->
    <main>
        <h1 id = "HeaderJob">Job Vacancy and Careers</h1>
        <section id = "JobsBody">
            <header>
                <h2>Why Join Our Team?</h2>
                <p>At our company, we're committed to fostering a culture of innovation and collaboration.</p>
            </header>
            <aside>
                <p><em><strong>"Join us to reshape industries and create a smarter future. <br>Pioneering Tomorrow's Tech, Today."</strong></em></p>
            </aside>
            <h2>Current Job Openings</h2>
            <!-- Set a container for Software Developer desription -->  
            <?php 
                require_once("settings.php");
                try{
                    // Attempt to connect to the database
                    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                    if (!$conn){
                        // Throw Exception if connection fail
                        throw new Exception('Database connection error: ' . mysqli_connect_error());
                    }
                    $sql_table = "jobs";
                    $sql_query = "SELECT * FROM $sql_table";
                    $result = mysqli_query($conn, $sql_query);
                    if (!$result) {
                        // Redirect to an error page if there is a connection problem
                        throw new Exception('Table query error: ' . mysqli_connect_error());
                    }
                    $rowcount = mysqli_num_rows($result);
                    if ($rowcount < 1){
                        echo "<p>There are currently no jobs vacant </p>";
                        echo "<p>Please check back again at a later time </p>";
                        echo "<p>If you believe this is a mistake, please contact 104506968@student.swin.edu.au</p>";
                    }
                    else{
                        while ($row = mysqli_fetch_assoc($result)) {
                            $JobID = $row['JobID'];
                            $JobRefNum = $row['JobRefNum'];
                            $JobTitle = $row['JobTitle'];
                            $JobDesc = $row['JobDesc'];
                            $JobSalary = $row['JobSalary'];
                            $JobRepTo = $row['JobRepTo'];
                            $JobResp = $row['JobResp'];
                            $JobReq = $row['JobReq'];
                            $lines1 = explode("\n", $JobResp);
                            $lines2 = explode("\n", $JobReq);
                            echo "
                            <section class = 'job-listing'>
                                <h3>$JobTitle</h3>          
                                <p>Join our team as a $JobTitle</p>
                                <h4>Position Description:</h4>
                                <table>
                                    <tr>
                                        <th>Reference Number</th>
                                        <td>$JobRefNum</td>
                                    </tr>
                                    <!-- Jobs Brief Description -->
                                    <tr>
                                        <th>Brief Description</th>
                                        <td>$JobDesc</td>
                                    </tr>
                                    <!-- Jobs Salary Range -->
                                    <tr>
                                        <th>Salary Range</th>
                                        <td>$JobSalary per year</td>
                                    </tr>
                                    <!-- Person that successful applicant report to -->
                                    <tr>
                                        <th>Reporting to</th>
                                        <td>$JobRepTo</td>
                                    </tr>
                                    <!-- Jobs Key Responsibilities -->
                                    <tr>
                                        <th>Key Responsibilities</th>
                                        <td>
                                            <ol>";
                                            foreach($lines1 as $line){
                                                echo '<li>' . $line . '</li>';
                                            }
                                            echo "
                                            </ol> 
                                        </td>
                                    </tr>
                                    <!-- Jobs Requirements -->
                                    <tr>
                                        <th>Required</th>
                                        <td>
                                            <ul>";
                                            foreach($lines2 as $line){
                                                echo '<li>' . $line . '</li>';
                                            }
                                            echo "
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                                <a href='apply.html' class='apply-button'> Apply Now </a>
                            </section>
                            ";
                        }
                    }
                }catch(Exception $e) {
                    // Redirect to an error page if there is a connection problem
                    header ("location: errorPageForConnection.html");
                }
            ?>
        </section>
    </main>
    <!-- Developer: Viet Hoang Pham. This is the HTML Codes of Footer -->
    <?php include_once 'footer.inc';?>
</body>
</html>
