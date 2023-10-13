<!--
    Name/ID: Viet Hoang Pham 104506968, Siradanai Inchansuk 104860428
    Assignment 2
-->
<!DOCTYPE html>

<html lang = "en">
<head>
    <meta charset = "utf-8" >
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <meta name = "description" content = "This is the HTML for the Add Jobs page" >
    <meta name = "keywords" content = "Add Jobs page" >
    <!-- Developer of this page is Pham Viet Hoang, Siradanai Inchansuk -->
    <meta name = "author" content = "Pham Viet Hoang, Siradanai Inchansuk" >
    <title>HPM: Add Jobs</title>
    <!-- This .inc file includes all css locations for each resolution of devices -->
    <?php include 'cssfiles.inc';?>
    <link rel = "shortcut icon" href = "images/favicon.png">
</head>

<body id  =  "ApplyMainBackground">
<?php
    session_start();

    if(!isset($_SESSION["authenticated"])){
        header("Location: login.php"); // Redirect to the login page if not authenticated.
        exit;
    }
?>
    <form method = "post" action = "addjobs.php" novalidate = "novalidate" id = "addjobs">
        <section class = "center">
            <br>
            <header>
                <h1 id = "HeaderApply">Add Jobs Form</h1>
            </header>
            <fieldset class = "blueApply">
                <legend>Jobs Details</legend>
            <!-- Reference Number Text Input -->
            <div class = "formBox">
                <label for = "ReferenceNumber">Reference number</label>
                <input type = "text" id = "ReferenceNumber" name = "ReferenceNumber" maxlength = "5" pattern = "[a-zA-Z0-9]{5}" placeholder = "Enter Reference number (e.g 10001)" required = "required"> 
                <span></span>
            </div>
            <!-- Job Title Text Input -->
            <div class = "formBox">
                <label for = "JobTitle">Title</label>
                <input type = "text" id = "JobTitle" name = "JobTitle" required = "required" maxlength = "30" pattern = "[A-Za-z\s]{1,30}" placeholder = "Enter job title">
                <span></span>
            </div>
            <!-- Job Description Text Input -->
            <div class = "formBox">
                <label for = "Description">Description</label>
                <input type = "text" id = "Description" name = "Description" required = "required" maxlength = "50" pattern = "[A-Za-z\s]{1,50}" placeholder = "Enter job description">
                <span></span>
            </div>
            <!-- Salary Text Input -->
            <div class = "formBox">
                <label for = "Salary">Salary</label>
                <input type = "text" id = "Salary" name = "Salary" required = "required" maxlength = "30" pattern = "[A-Za-z\s]{1,30}" placeholder = "Enter job salary">
                <span></span>
            </div>
            <!-- Reported to Text Input -->
            <div class = "formBox">
                <label for = "Reported">Reported to</label>
                <input type = "text" id = "Reported" name = "Reported" required = "required" maxlength = "30" pattern = "[A-Za-z\s]{1,30}" placeholder = "Enter person to report to">
                <span></span>
            </div>
            <!-- Responsibilities Textarea Input -->
            <div class = "formBox">
                <label for = "Responsibilities">Responsibilities</label>
                <textarea id = "Responsibilities" name = "Responsibilities" rows = "5" cols = "40" placeholder = "Write job responsibilities here..."></textarea>
            </div>
            <!-- Requirements Textarea Input -->
            <div class = "formBox">
                <label for = "Requirements">Requirements</label>
                <textarea id = "Requirements" name = "Requirements" rows = "5" cols = "40" placeholder = "Write job requirements here..."></textarea>
            </div>
            </fieldset>
            <button type = "submit" class = "btnApply">Submit</button>
            <button type = "reset" class = "btnApply">Reset</button>
        </section>
    </form>
</body>
