<!--
    Name/ID: Viet Hoang Pham 104506968
    Assignment 2
-->
<!DOCTYPE html>

<html lang = "en">
<head>
    <meta charset = "utf-8" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is login page for manager of HPM" >
    <meta name = "keywords" content = "Login page" >
    <!-- Developer of this page is Viet Hoang Pham -->
    <meta name = "author" content = "Viet Hoang Pham" >
    <title>HPM: Manager Login</title>
    <!-- This css file styles manager website -->
    <link rel = "stylesheet" href = "styles/AuthenticationPageStyle.css">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel = "shortcut icon" href="images/favicon.png">
</head>
<body>
    <?php
        session_start();

        if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] == true) {
            header("Location: dashboard.php"); // Redirect to the manage page if already authenticated.
            exit;
        }
        // Define maximum login attempts and lockout duration
        $maxLoginAttempts = 3;
        $lockoutDuration = 60; // (1 minute) lockout duration

        $errMsg = "";
        $block = false;
        // Disable error display and configure error reporting
        error_reporting(0);
        ini_set('display_errors', 0);
        if(isset($_SESSION['lockoutTime']) && $_SESSION['lockoutTime'] <= time()){
            // Remove all session variables
            session_unset();
        }

        if(isset($_SESSION['lockoutTime']) && $_SESSION['lockoutTime'] > time()){
            $errMsg = "<p id = 'error'>Too many login attempts. Please wait 1 minute.</p>";
            $block = true;
        }

        // Get the submitted username and password
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !$block) {
            // This function sanitise data to remove leading and trailing spaces, backslashes and HTML control characters.
            function sanitise_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $submittedUsername = sanitise_input($_POST["Username"]);
            $submittedPassword = sanitise_input($_POST["Password"]);

            require_once("settings.php");
            try{
                $conn = mysqli_connect($host, $user, $pwd, $sql_db);

                if (!$conn) {
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

                // Execute a SELECT query to retrive the user's data
                $sql_table = "users";
                $checkUserSQL = "SELECT * FROM $sql_table WHERE username = '$submittedUsername'";
                $result = mysqli_query($conn, $checkUserSQL);

                if (!$result) {
                    // Redirect to an error page if there is a connection problem
                    throw new Exception('Table query error: ' . mysqli_connect_error());
                }

                if(mysqli_num_rows($result) == 1){
                    // User found, retrieve data
                    $checkingPassword = md5($submittedPassword);
                    $userRow = mysqli_fetch_assoc($result);
                    // Verify submitted password with hashed password
                    if ($checkingPassword === $userRow["Password"]) {
                        // Authentication successful, set session variables on and redirect to manager page
                        mysqli_close($conn);
                        $_SESSION["authenticated"] = true;
                        $_SESSION["firstName"] = $userRow["FirstName"];
                        $_SESSION["lastName"] = $userRow["LastName"];
                        header("location: dashboard.php");
                        exit;
                    } else {
                        $errMsg = "<p id = 'error'>Wrong username or password. Please try again.</p>";

                        // Invalid login
                        if (!isset($_SESSION['attempts'])) {
                            $_SESSION['attempts'] = 1;
                        } else {
                            $_SESSION['attempts'] += 1;
                        }
                        
                        // Check if the maximum login attempts have been reached
                        if ($_SESSION['attempts'] >= $maxLoginAttempts) {
                            $_SESSION['lockoutTime'] = time() + $lockoutDuration;
                        }

                        mysqli_close($conn);
                    }
                } else {
                    $errMsg = "<p id = 'error'>Username not found. Please check your username.</p>";

                    // Invalid login
                    if (!isset($_SESSION['attempts'])) {
                        $_SESSION['attempts'] = 1;
                    } else {
                        $_SESSION['attempts'] += 1;
                    }

                    // Check if the maximum login attempts have been reached
                    if ($_SESSION['attempts'] >= $maxLoginAttempts) {
                        $_SESSION['lockoutTime'] = time() + $lockoutDuration;
                    }

                    mysqli_close($conn);
                }
            }catch (Exception $e) {
                // Redirect to an error page if there is a connection problem
                header("location: errorPageForConnection.html");
            } 
        }
    ?>
    <form method = "post" action = "login.php">
        <p><a href = "index.php" id = "backHomeText">Home <i class = "fa fa-home"></i></a></p>
        <h1>Login</h1>
        <?php
            if($errMsg != ""){
                echo $errMsg;
            }
        ?>
        <!-- Login form fields (username and password) go here -->
        <label for = "Username">Username</label>
        <div class = "input-container">
            <input type = "text" id = "Username" name = "Username" placeholder = "Enter your username" required>
            <i class = "fa fa-user"></i>
        </div>
        <label for = "Password">Password</label>
        <div class = "input-container">
            <input type = "password" id = "Password" name = "Password" placeholder = "Enter your password" required>
            <i class = "fa fa-lock"></i>
        </div>
        <button type = "submit">Login</button>
        <p><a href = "register.php">Create new account</a></p>
    </form>
</body>
</html>
