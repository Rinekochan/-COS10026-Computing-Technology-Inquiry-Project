<!--
    Name/ID: Siradanai Inchansuk 104860428, Viet Hoang Pham 104506968
    Assignment 2
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Processing EOI" />
    <meta name="keywords" content="PHP, MySql" />
    <meta name="author" content="Siradanai Inchansuk, Viet Hoang Pham" >
    <title>HPM: Processing Application</title>
    <link rel = "stylesheet" href = "styles/style.css">
    <link rel = "stylesheet" href = "styles/ErrorMessage.css">
</head>
<body>
<?php
    // The users mustn't access this page directly through URL
    if (!isset($_POST["ReferenceNumber"])){
        header ("location: apply.php");
    }
    include 'phpmailer/PHPMailerAutoload.php';
    // This function sanitise data to remove leading and trailing spaces, backslashes and HTML control characters.
    function sanitise_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // This class and function checks for valid postcode for Australia states.
    class State{
        public $name;
        public $postcodeStart;
        public $postcodeEnd;
        function __construct($name, $postcodeStart, $postcodeEnd){
            $this->name = $name;
            $this->postcodeStart= $postcodeStart;
            $this->postcodeEnd = $postcodeEnd;
        }
        public function inRange($number) {
            foreach ($this->postcodeStart as $index => $start) {
                $end = $this->postcodeEnd[$index];
                if ($number >= $start && $number <= $end) {
                    return true;
                }
            }
            return false;
        }
    }

    // These variables define the range of valid postcode for each Australia states.
    $state1 = new State("NSW", array(1000,2000,2619,2921), array(1999,2599,2899,2999));
    $state2 = new State("ACT", array(200,2600,2900), array(299,2618,2920));
    $state3 = new State("VIC", array(3000,8000), array(3999,8999));
    $state4 = new State("QLD", array(4000,9000), array(4999,9999));
    $state5 = new State("SA", array(5000,5800), array(5799, 5999));
    $state6 = new State("WA", array(6000,6800), array(6797, 6999));
    $state7 = new State("TAS", array(7000, 7800), array(7799, 7999));
    $state8 = new State("NT", array(800, 900), array(899, 999));
    $states = array($state1, $state2, $state3, $state4, $state5, $state6, $state7, $state8);

    // Disable error display and configure error reporting
    error_reporting(0);
    ini_set('display_errors', 0);
    
    // Setting up database connection (show error page if failed)
    require_once("settings.php");
    try{
        // Attempt to connect to the database
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn){
            // Throw Exception if connection fail
            throw new Exception('Database connection error: ' . mysqli_connect_error());
        }
        else{
            // Create eoi table if it is not existed in the database
            $sql_table = 'eoi';
            $checkTableSQL = "SHOW TABLES LIKE '$sql_table'";
            $result = mysqli_query($conn, $checkTableSQL);
            if (!$result || mysqli_num_rows($result) == 0) {
                $createTableSQL = "
                    CREATE TABLE `eoi` (
                        `EOInumber` int(11) NOT NULL AUTO_INCREMENT,
                        `JobRefNum` varchar(5) NOT NULL,
                        `FirstName` varchar(20) NOT NULL,
                        `LastName` varchar(20) NOT NULL,
                        `DateOfBirth` date NOT NULL,
                        `Gender` varchar(6) NOT NULL,
                        `StreetAddress` varchar(40) NOT NULL,
                        `SuburbOrTown` varchar(40) NOT NULL,
                        `State` varchar(3) NOT NULL,
                        `PostCode` varchar(4) NOT NULL,
                        `Email` varchar(50) NOT NULL,
                        `PhoneNumber` varchar(50) NOT NULL,
                        `DegreeLevel` varchar(4) NOT NULL,
                        `Degree` varchar(30) NOT NULL,
                        `Experience` varchar(30) NOT NULL,
                        `Skills` varchar(40) NOT NULL,
                        `SkillsDescription` varchar(40) NOT NULL,
                        `Status` varchar(20) NOT NULL,
                        PRIMARY KEY (`EOInumber`)
                    )";
                if(!mysqli_query($conn, $createTableSQL)){
                    throw new Exception('Table creation error: ' . mysqli_connect_error());
                }
            }
            // Validate each data and stores error messages
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
            if (isset($_POST["FirstName"])){
                $firstName = sanitise_input($_POST["FirstName"]);
                if ($firstName == ""){
                    $errMsg .= "<p>You must enter your first name.</p>";
                }
                else if (!preg_match("/^[a-zA-Z]*$/",$firstName)){
                    $errMsg .= "<p>Only alpha letters allowed in your first name.</p>";
                }
            }
            if (isset($_POST["LastName"])){
                $lastName = sanitise_input($_POST["LastName"]);
                if ($lastName == ""){
                    $errMsg .= "<p>You must enter your last name</p>";
                }
                else if (!preg_match("/^[a-zA-Z]*$/",$lastName)){
                    $errMsg .= "<p>Only alpha letters allowed in your last name.</p>";
                }    
            } 
            if (isset($_POST["DOB"])){
                $dob = date('Y-m-d', strtotime($_POST['DOB']));
                $age = date_diff(date_create($dob), date_create('now'))->y;
                if ($age < 15 || $age > 80){
                    $errMsg .= "<p>Your age must be between 15 - 80.</p>";
                }
            }
            if (isset($_POST["Sex"])){
                $gender = sanitise_input($_POST["Sex"]);
            }
            if (isset($_POST["StreetAddress"])){
                $streetAddress = sanitise_input($_POST["StreetAddress"]);
                if ($streetAddress == ""){
                    $errMsg .= "<p>You must enter your street address</p>";
                }
                else if (strlen($streetAddress) > 40){
                    $errMsg .= "<p>Your street address details is too long</p>";
                }
            }
            if (isset($_POST["Suburb"])){
                $suburb = sanitise_input($_POST["Suburb"]);
                if ($suburb == ""){
                    $errMsg .= "<p>You must enter your Suburb/Town</p>";
                }
                else if (strlen($streetAddress) > 40){
                    $errMsg .= "<p>Your Suburb/Town details is too long</p>";
                }
            }
            if (isset($_POST["State"])){
                $state_input = sanitise_input($_POST["State"]);
            }
            if (isset($_POST["Postcode"])){
                $postcode = sanitise_input($_POST["Postcode"]);
                if ($postcode == ""){
                    $errMsg .= "<p>You must enter your postcode</p>";
                }
                else if (strlen($postcode) > 4){
                    $errMsg .= "<p>Your postcode is too long</p>";
                }
                else{
                    settype($postcode, 'integer');
                    foreach ($states as $state){
                        if ($state->name == $state_input){
                            if (!($state->inRange($postcode))) {
                                $errMsg .= "<p> $postcode is not within the postcode ranges of {$state->name}. </p>";
                            } 
                        }
                    }
                }
            }
            if (isset($_POST["Email"])){
                $email = sanitise_input($_POST["Email"]);
                if ($email == ""){
                    $errMsg .= "<p>You must enter a email</p>";
                }
                else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errMsg .= "<p>Your email is not in a valid format</p>";
                }
            }
            if (isset($_POST["PhoneNumber"])){
                $phone = sanitise_input($_POST["PhoneNumber"]);
                if ($phone == ""){
                    $errMsg .= "<p>You must enter a phone number</p>";
                }
                else if (!preg_match("/[^0-9]/",$lastName)){
                    $errMsg .= "<p>Your phone number cannot contain alpha letters</p>";
                }
                else if (strlen($phone) < 8 || strlen($phone) > 12){
                    $errMsg .= "<p>Your phone number has to be between 8 - 12 numbers</p>";
                }
            }
            $degreeLevel = sanitise_input($_POST["DegreeLevel"]);
            $degree =  sanitise_input($_POST["Degree"]);
            $experience = sanitise_input($_POST["Years"]);
            $technical = $_POST["TechnicalSkills"];
            $description = sanitise_input($_POST["Description"]);
            $skills = "";
            foreach ($technical as $value) {
                $skills = $skills . $value . ", ";
                #echo "$value ";
            }
            #echo"</p>";
            #echo "<p>Description: $description </p>";
            // Display validation errors of application forms
            if ($errMsg != ""){
                echo '
                <div id = "errorMessage">
                    <h1>Oops!</h1>
                    <h2>There are some errors in your application form.</h2>
                    ' . $errMsg . '
                    <a href = "apply.php">Back To Apply</a>
                </div>';
            }
            // Insert data to the eoi table
            else{
                $sql_table="eoi";
                $query = "insert into $sql_table (JobRefNum, FirstName, LastName, DateOfBirth, Gender, StreetAddress
                ,SuburbOrTown, State, Postcode, Email, PhoneNumber, DegreeLevel, Degree, Experience, Skills, SkillsDescription, Status) 
                values ('$reference', '$firstName', '$lastName', '$dob', '$gender', '$streetAddress','$suburb','$state_input'
                , '$postcode', '$email', '$phone', '$degreeLevel', '$degree', '$experience', '$skills', '$description', 'New')";
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
                            <a href = "apply.php">Back To Apply</a>
                        </div>
                        ';
                }
                else{
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
                    // Send the confirmation email
                    require_once "emailTemplate.php";
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Thank you for your application at the HPM Company';
                    $mail->Body = confirmationEmail($firstName, $lastName);
                    $mail->AltBody = 'Dear ' . $firstName . ' ' . $lastName . ',
                        Thank you for applying to the HPM Company.
                        We\'d like to inform you that we have received your application.
                        Our team is currently reviewing all applications and we are planning to schedule interviews. 
                        You will receive an email from our team within the next 3 working days. 
                        In any case, we will keep you updated on your application status.';
                    // Third Party Code PHPMailer Acknowledgement: https://github.com/PHPMailer/PHPMailer
                    // Display success page for the users and ask them to check their email for confirmation
                    $mail->addEmbeddedImage('images/Logo_name_horizontal.png', 'image1');

                    $last_id = mysqli_insert_id($conn);
                    mysqli_close($conn);
                    $mail->send();
                    echo "
                    <div id = 'successMessage'>
                        <h1>Success!</h1>
                        <h2>Your application form has been successfully recorded.</h2>
                        <h3>Your EOI Number is <span style = 'color: #f22800; font-weight: bold;'>#$last_id</span>, and your email address is <span style = 'color: #f22800; font-weight: bold;'>$email</span></h3>
                        <p>A confirmation email has been sent to your email address.</p>
                        <p>If you don't see the email, please check your spam folder or verify your submitted email address.</p>
                        <p>If the issue stills persist, please contact hpminquiry@gmail.com.</p>
                        <a href = 'apply.php'>Back To Apply</a>
                    </div>
                    ";
                    // // Show error page if the email failed to send
                    // else{
                    //     echo '
                    //     <div id = "errorMessage">
                    //         <h1>503</h1>
                    //         <h2>Email unsuccessfully sent</h2>
                    //         <p>It seems like there are some problems whilst sending the email.</p>
                    //         <p>Please verify whether email is valid or not then resubmit the form</p>
                    //         <a href = "apply.php">Back To Apply</a>
                    //     </div>
                    //     ';
                    // }
                }
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
            <a href = "apply.php">Back To Apply</a>
        </div>';
    }
?>
</body>
</html>
