<!--
    Name/ID: Viet Hoang Pham 104506968
    Assignment 2
-->
<!DOCTYPE html>

<html lang = "en">
<head>
    <meta charset = "utf-8" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is edit page of HPM" >
    <meta name = "keywords" content = "Edit page" >
    <!-- Developer of this page is Viet Hoang Pham, Humayra Jahan -->
    <meta name = "author" content = "Viet Hoang Pham" >
    <title>HPM: Edit</title>
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
        $sql_query = "";
        $sql_table = "eoi";
        $sql_column = "EOInumber";

        // This function sanitise data to remove leading and trailing spaces, backslashes and HTML control characters.
        function sanitise_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $notification = "";
        if(isset($_POST["reject"]) || isset($_POST["interview"]) || isset($_POST["accept"])){
            $id = sanitise_input($_GET['id']);
            require_once("settings.php");
            try{
                // Attempt to connect to the database
                $conn = mysqli_connect($host, $user, $pwd, $sql_db);
                if (!$conn){
                    // Throw Exception if connection fail
                    throw new Exception('Database connection error: ' . mysqli_connect_error());
                }
            }catch(Exception $e) {
                    // Redirect to an error page if there is a connection problem
                    header ("location: errorPageForConnection.html");
            }
            $sql_query = "SELECT * FROM $sql_table WHERE $sql_column = $id";
            $result = mysqli_query($conn, $sql_query);

            if(!$result){
                header ("Location: manage.php");
            }else{
                $check_row = mysqli_num_rows($result);
                if($check_row != 0){
                    while ($row = mysqli_fetch_assoc($result)) {
                        $firstName = $row['FirstName'];
                        $lastName = $row['LastName'];
                        $reference = $row['JobRefNum'];
                        if($reference == "00001") $jobTitle = "Software Developer";
                        elseif($reference == "00010") $jobTitle = "Network Administrator";
                        elseif($reference == "00011") $jobTitle = "Cyber Security Analyst";
                        elseif($reference == "00100") $jobTitle = "IT Project Manager";
                        elseif($reference == "00101") $jobTitle = "Data Analyst";
                        $email = $row['Email'];
                    }
                }
            }
            include 'phpmailer/PHPMailerAutoload.php';
            // Setting up mail connection by using PHPMailer library 
            /**
             * PHP Version 5
             * @package PHPMailer
             * @link https://github.com/PHPMailer/PHPMailer/
             * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
             * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
             * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
             * @author Brent R. Matzelle (original founder)
             * @copyright 2012 - 2014 Marcus Bointon
             * @copyright 2010 - 2012 Jim Jagielski
             * @copyright 2004 - 2009 Andy Prevost
             * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
             * @note This program is distributed in the hope that it will be useful - WITHOUT
             * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
             * FITNESS FOR A PARTICULAR PURPOSE.
             */
            $mail = new PHPMailer;

            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'hpminquiry@gmail.com';                     //SMTP username
            $mail->Password   = 'igdmzvjikrdjqyey';                               //SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 25;                      //587 25               
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            // Attach an image
            $mail->addAttachment('images/Logo_name_horizontal.png');
            //Recipients
            $mail->setFrom('hpminquiry@gmail.com', 'HPM HR Department');
            $mail->addAddress($email, 'End user');
            $mail->isHTML(true);                                  // Set email format to HTML
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //Content
            // Send the reject/interview/accept email
            require_once "emailTemplate.php";
            $mail->Subject = 'New update of your application process at the HPM Company';
        }
        if(isset($_POST["reject"])){
            // Update the record to final status
            $sql_query = "UPDATE $sql_table SET Status = 'Final' WHERE $sql_column = $id";
            $result = mysqli_query($conn, $sql_query);

            if(!$result){
                header ("Location: manage.php");
            }
            mysqli_close($conn);
            $mail->Body = rejectionEmail($firstName, $lastName, $jobTitle);
            $mail->addEmbeddedImage('images/Logo_name_horizontal.png', 'image1');
            $mail->send();
            $notification = "<h3 id = 'notification'>A rejection email has been sent to applicant, the status is now Final</h3>";
        }else if(isset($_POST["interview"])){
            // Update the record to current status
            $sql_query = "UPDATE $sql_table SET Status = 'Current' WHERE $sql_column = $id";
            $result = mysqli_query($conn, $sql_query);

            if(!$result){
                header ("Location: manage.php");
            }
            if(isset($_POST["DOI"])){
                $doi = $_POST["DOI"];
                $dateTimeObj = new DateTime($doi);
                $formattedDateTime = $dateTimeObj->format('Y-m-d H:i');
            } 
            else $doi = "Unknown";
            mysqli_close($conn);
            $mail->Body = interviewEmail($firstName, $lastName, $jobTitle, $formattedDateTime);
            $mail->addEmbeddedImage('images/Logo_name_horizontal.png', 'image1');
            $mail->send();
            $notification = "<h3 id = 'notification'>An interview email has been sent to applicant, the status is now Current</h3>";
        }else if(isset($_POST["accept"])){
            // Update the record to final status
            $sql_query = "UPDATE $sql_table SET Status = 'Final' WHERE $sql_column = $id";
            $result = mysqli_query($conn, $sql_query);

            if(!$result){
                header ("Location: manage.php");
            }
            mysqli_close($conn);
            $mail->Body = acceptEmail($firstName, $lastName, $jobTitle);
            $mail->addEmbeddedImage('images/Logo_name_horizontal.png', 'image1');
            $mail->send();
            $notification = "<h3 id = 'notification'>An acceptance email has been sent to applicant, the status is now Final</h3>";
        }   
    ?>

    <!--Developer: Viet Hoang Pham. This is Manager Navigation Menu and Header code. You should add this at the start of <body> element-->
    <?php include_once 'managermenuandheader.inc';?>
    <!--End of Navigation Menu Code.-->

    <main>
        <form method = "POST" action = "" id = "mainform">

            <?php
            if(isset($_GET['id'])){
                $id = sanitise_input($_GET['id']);

                require_once("settings.php");
                try{
                    // Attempt to connect to the database
                    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                    if (!$conn){
                        // Throw Exception if connection fail
                        throw new Exception('Database connection error: ' . mysqli_connect_error());
                    }
                    $sql_query = "SELECT * FROM $sql_table WHERE $sql_column = $id";
                    $result = mysqli_query($conn, $sql_query);
                    $check_row = mysqli_num_rows($result);

                    if(!$result){
                        header ("Location: manage.php");
                    }else{
                        if($check_row != 0){
                            while ($row = mysqli_fetch_assoc($result)) {
                            $EOInumber = $row['EOInumber'];

                            $fullName = $row['FirstName'] . " " . $row['LastName'];
                            $gender = $row['Gender'];
                            if($gender == "male") $gender = "Male";
                            elseif($gender == "female") $gender = "Female";
                            else $gender = "Unknown";

                            $dob = $row['DateOfBirth'];
                            $age = date_diff(date_create($dob), date_create('now'))->y;

                            $streetAddress = $row['StreetAddress'];
                            $addressInfo = $row['SuburbOrTown'] . ", " . $row['State'] . ", " . $row['PostCode'];
                            
                            $email = $row['Email'];
                            // This block of code is convert the format of phone number to the format of "0123 456 789" consistently
                            $originalPhoneNumber = $row['PhoneNumber'];
                            $unformattedPhoneNumber = str_replace(' ', '', $originalPhoneNumber);
                            $phoneNumber = substr($unformattedPhoneNumber, 0, 4) . ' ' . substr($unformattedPhoneNumber, 4, 3) . ' ' . substr($unformattedPhoneNumber, 7);
                            
                            $degreeLevel = $row['DegreeLevel'];
                            if($degreeLevel == "None") $degreeLevel = "Unknown";
                            else if ($degreeLevel == "BA") $degreeLevel = "Bachelor of ";
                            else if ($degreeLevel == "MSc") $degreeLevel = "Master of";
                            else  $degreeLevel = "PhD in";

                            $degreeCourse = $row['Degree']; 
                            if ($degreeCourse == "CS") $degreeCourse = "Computer Science";
                            else if ($degreeCourse == "Software") $degreeCourse = "Software Engineer";
                            else if ($degreeCourse == "Information Technology") $degreeCourse = "Information Technology";
                            else if ($degreeCourse == "Security") $degreeCourse = "Cyber Security";
                            else $degreeCourse = "Unknown";
                            
                            $degree = "";
                            if($degreeLevel == "Unknown" || $degreeCourse == "Unknown") $degree = "Unknown";
                            else $degree = $degreeLevel . $degreeCourse;

                            $experience = $row['Experience'];
                            if($experience == "none") $experience = "No";
                            else $experience .= " years";

                            $reference = $row['JobRefNum'];
                            if($reference == "00001") $jobTitle = "Software Developer";
                            elseif($reference == "00010") $jobTitle = "Network Administrator";
                            elseif($reference == "00011") $jobTitle = "Cyber Security Analyst";
                            elseif($reference == "00100") $jobTitle = "IT Project Manager";
                            elseif($reference == "00101") $jobTitle = "Data Analyst";
                            
                        
                            $skills = rtrim($row['Skills'], ", ");
                            if($skills == null) $skills = "Unknown";

                            $skillsDescription = $row['SkillsDescription'];
                            if($skillsDescription == null) $skillsDescription = "None";

                            $status = $row['Status'];
                            if ($status == "New") $statusColor = 'statusNew';
                            elseif ($status == "Current") $statusColor = 'statusCurrent';
                            else $statusColor = 'statusFinal';


                            echo "<h1 id = 'editHeader'>EOI Number: #$EOInumber</h1>
                                  <h2><span class = $statusColor>$status</span></h2>";
                            if($notification != '') echo $notification;
                            echo "
                                <fieldset id = 'applicantDetails'>
                                    <legend>Applicant Details</legend>
                                    <div class = 'applicantBox'>
                                        <p><span class = 'applicantHeader'>Full Name:</span> $fullName</p>
                                        <p><span class = 'applicantHeader'>Gender:</span> $gender</p>
                                    </div>
                                    <div class = 'applicantBox'>
                                        <p><span class = 'applicantHeader'>Date of Birth (Y-M-D):</span> $dob</p>
                                        <p><span class = 'applicantHeader'>Age:</span> $age</p>
                                    </div>
                                    <div class = 'applicantBox'>
                                        <p><span class = 'applicantHeader'>Address:</span> $streetAddress</p>
                                        <p><span class = 'applicantHeader'>Suburb/State:</span> $addressInfo</p>
                                    </div>
                                    <div class = 'applicantBox'>
                                        <p><span class = 'applicantHeader'>Email:</span> $email</p>
                                        <p><span class = 'applicantHeader'>Phone:</span> $phoneNumber</p>
                                    </div>
                                    <div class = 'applicantBox'>
                                        <p><span class = 'applicantHeader'>Degree:</span> $degree</p>
                                        <p><span class = 'applicantHeader'>Experience:</span> $experience</p>
                                    </div>
                                    <div class = 'applicantBox'>
                                        <p><span class = 'applicantHeader'>Skills:</span> $skills</p>
                                        <p><span class = 'applicantHeader'>Preferred Job:</span> $jobTitle ($reference)</p>
                                    </div>
                                    <p><span class = 'applicantHeader'>Others Skills:</span> $skillsDescription</p>
                                    </fieldset>
                                ";
                            }
                        }else{
                            mysqli_close($conn);
                            header("Location: manage.php");
                        } 
                    }
                    mysqli_close($conn);
                }catch(Exception $e) {
                    // Redirect to an error page if there is a connection problem
                    header ("location: errorPageForConnection.html");
                }
            }else{
                header("Location: manage.php");
            }
            ?>
            <fieldset id = 'interviewPlan'>
                <legend>Schedule an Interview</legend>
                <div class = 'interviewBox'>
                    <label for = 'DOI'>Date of Interview</label>
                    <input type = 'datetime-local' id = 'DOI' name = 'DOI'>
                    <span></span>
                </div>
            </fieldset>
            <div id = 'editquery'>
                <a href = "manage.php">Back</a>
                <button type = 'submit' name = 'reject' id = 'reject' >Reject Applicant</button>  
                <button type = 'submit' name = 'interview' id = 'interview'>Send Interview Email</button>
                <button type = 'submit' name = 'accept' id = 'accept' >Accept Applicant</button>
            </div>
        </form>

                
    </main>";
</body>



    