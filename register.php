<!--
    Name/ID: Viet Hoang Pham 104506968
    Assignment 2
-->
<!DOCTYPE html>

<html lang = "en">
<head>
    <meta charset = "utf-8" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is register page for manager of HPM" >
    <meta name = "keywords" content = "Register page" >
    <!-- Developer of this page is Viet Hoang Pham -->
    <meta name = "author" content = "Viet Hoang Pham" >
    <title>HPM: Manager Register</title>
    <!-- This css file styles manager website -->
    <link rel = "stylesheet" href = "styles/AuthenticationPageStyle.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel = "shortcut icon" href = "images/favicon.png">
</head>
<body>
    <?php
        $errMsgFirstName = "";
        $errMsgLastName = "";
        $errMsgUsername = "";
        $errMsgPassword = "";
        $successMsg = "";
        // Disable error display and configure error reporting
        error_reporting(0);
        ini_set('display_errors', 0);
        // Get the submitted username and password
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // This function sanitise data to remove leading and trailing spaces, backslashes and HTML control characters.
            function sanitise_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            // Validate each data and stores error messages
            if (isset($_POST["FirstName"])){
                $submittedFirstName = sanitise_input($_POST["FirstName"]);
                if ($submittedFirstName == ""){
                    $errMsgFirstName = "<p id = 'error'>You must enter your first name.</p>";
                }
                else if (!preg_match("/^[a-zA-Z\s]*$/",$submittedFirstName)){
                    $errMsgFirstName = "<p id = 'error'>Only alpha letters allowed in your first name.</p>";
                }
            }

            if (isset($_POST["LastName"])){
                $submittedLastName = sanitise_input($_POST["LastName"]);
                if ($submittedLastName == ""){
                    $errMsgLastName = "<p id = 'error'>You must enter your last name.</p>";
                }
                else if (!preg_match("/^[a-zA-Z\-\s]*$/",$submittedLastName)){
                    $errMsgLastName = "<p id = 'error'>Only alpha letters and hyphen allowed in your last name.</p>";
                }    
            } 
            
            if(isset($_POST["Username"])){
                $submittedUsername = sanitise_input($_POST["Username"]);
                if($submittedUsername == ""){
                    $errMsgUsername = "<p id = 'error'>You must enter a username.</p>";
                }
            }

            if (isset($_POST["Password"])){
                $submittedPassword = sanitise_input($_POST["Password"]);
                if ($submittedPassword == ""){
                    $errMsgPassword = "<p id = 'error'>You must enter your password.</p>";
                }
                // Password must be at least 8 characters long and contain an uppercase letter, a digit, and a special character (@, #, etc.). 
                else if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?=.*[a-zA-Z0-9]).{8,}$/", $submittedPassword)){
                    $errMsgPassword = "<p id = 'error'>Your password doesn't meet the requirements.</p>";
                }
            }

            require_once("settings.php");
            // "name": "ircmaxell/password-compat",
            // "description": "A compatibility library for the proposed simplified password hashing algorithm: https://wiki.php.net/rfc/password_hash",
            // "keywords": ["password", "hashing"],
            // "homepage": "https://github.com/ircmaxell/password_compat",
            // "license": "MIT",
            // "authors": [
            //     {
            //         "name": "Anthony Ferrara",
            //         "email": "ircmaxell@php.net",
            //         "homepage": "http://blog.ircmaxell.com"
            //     }
            // ],
            require_once("password_compat/lib/password.php");
            try{
                // Attempt to connect to the database
                $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                if (!$conn){
                    // Throw Exception if connection fail
                    throw new Exception('Database connection error: ' . mysqli_connect_error());
                }
                // Create users table if it is not existed in the database
                $sql_table = 'users';
                $checkTableSQL = "SHOW TABLES LIKE '$sql_table'";
                $result = mysqli_query($conn, $checkTableSQL);
                if (!$result || mysqli_num_rows($result) == 0) {
                    $createTableSQL = "
                        CREATE TABLE users (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            FirstName VARCHAR(50) NOT NULL,
                            LastName VARCHAR(50) NOT NULL,
                            Username VARCHAR(50) NOT NULL,
                            Password VARCHAR(255) NOT NULL
                        )";
                    if(!mysqli_query($conn, $createTableSQL)){
                        mysqli_close($conn);
                        throw new Exception('Table creation error: ' . mysqli_connect_error());
                    }
                }

                // Check if the username already exists in the database
                $sql_table = "users";
                $checkUsernameSQL = "SELECT Username FROM $sql_table WHERE Username = '$submittedUsername'";
                $result = mysqli_query($conn, $checkUsernameSQL);

                if (!$result) {
                    // Redirect to an error page if there is a connection problem
                    throw new Exception('Table query error: ' . mysqli_connect_error());
                } 

                if (mysqli_num_rows($result) > 0) {
                    // Username already exists
                    mysqli_close($conn);
                    $errMsgUsername = "<p id = 'error'>This username is already taken. Please try again.</p>";
                }

                if($errMsgFirstName == "" && $errMsgLastName == "" && $errMsgUsername == "" && $errMsgPassword == ""){
                    // Hash the passwords before storing them in the database
                    $hashedPassword = password_hash($submittedPassword, PASSWORD_DEFAULT);
                    $sql_table = "users";
                    $query = "insert into $sql_table (FirstName, LastName, Username, Password) values ('$submittedFirstName','$submittedLastName','$submittedUsername', '$hashedPassword')";
                    $result = mysqli_query($conn, $query);
                    if(!$result){
                        // Redirect to an error page if there is a connection problem
                        mysqli_close($conn);
                        // throw new Exception('Table query error: ' . mysqli_connect_error());
                    }else{
                        mysqli_close($conn);
                        $successMsg = "<p id = 'success'>Your account has been created!</p>";
                    }
                }
            }catch (Exception $e) {
                // Redirect to an error page if there is a connection problem
                header ("location: errorPageForConnection.html");
            }
        }        
    ?>
    <form method = "post" action = "register.php" novalidate = "novalidate">
        <p><a href = "index.php" id = "backHomeText">Home <i class = "fa fa-home"></i></a></p>
        <h1>Sign Up</h1>
        <?php
            if($successMsg != ""){
                echo $successMsg;
            }else if($errMsgFirstName != ""){
                echo $errMsgFirstName;
            }else if($errMsgLastName != ""){
                echo $errMsgLastName;
            }else if($errMsgUsername != ""){
                echo $errMsgUsername;
            }else if($errMsgPassword != ""){
                echo $errMsgPassword;
            }
        ?>
        <!-- Login form fields (username and password) go here -->
        <label for = "FirstName">First Name</label>
        <div class = "checked-input-container">
            <input type = "text" id = "FirstName" name = "FirstName" placeholder = "Enter your first name" pattern = "^[a-zA-Z\s]*$" maxlength = "50" required>
            <i class = "fa fa-user"></i>
        </div>
        <label for = "LastName">Last Name</label>
        <div class = "checked-input-container">
            <input type = "text" id = "LastName" name = "LastName" placeholder = "Enter your last name" maxlength = "50" pattern = "^[a-zA-Z\-\s]*$" required>
            <i class = "fa fa-user"></i>
        </div>
        <label for = "Username">Username</label>
        <div class = "checked-input-container">
            <input type = "text" id = "Username" name = "Username" placeholder = "Enter your username" maxlength = "50" required>
            <i class = "fa fa-user"></i>
        </div>
        <label for = "Password">Password</label>
        <div class = "checked-input-container">
            <!-- Password must be at least 8 characters long and contain an uppercase letter, a digit, and a special character (@, #, etc.). -->
            <input type = "Password" id = "Password" name = "Password" pattern = "^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?=.*[a-zA-Z0-9]).{8,}$" placeholder = "Enter your password" maxlength = "50" required>
            <i class = "fa fa-lock"></i>
        </div>
        <ul id = "passwordrulelist">
            <li>Password must be at least 8 characters long.</li>
            <li>Password must contain at least an uppercase</li>
            <li>Password must contain at least a number</li>
            <li>Password must contain a special character (@, #, ...)</li>
        </ul>
        <button type = "submit">Register</button>
        <p>Already have account? <a href = "login.php">Login now!</a></p>
    </form>
</body>
</html>
