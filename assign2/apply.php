<!--
    Name/ID: Siradanai Inchansuk 104860428
    Assignment 1
-->
<!DOCTYPE html>

<html lang = "en">
<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is the HTML for the apply page" >
    <meta name="keywords" content="Apply page" >
    <!-- Developer of this page is Siradanai Inchansuk -->
    <meta name="author" content="Siradanai Inchansuk" >
    <title>HPM: Application Form</title>
    <!-- This .inc file includes all css locations for each resolution of devices -->
    <?php include 'cssfiles.inc';?>
    <link rel = "shortcut icon" href="images/favicon.png">
</head>
<body id = "ApplyMainBackground">
    <!--Developer: Viet Hoang Pham. This is Navigation Menu code. You should add this at the start of <body> element-->
    <?php include 'header.inc';?>
    <!--End of Navigation Menu Code.-->

    <!--Developer: Viet Hoang Pham. Scroll Up Button-->
    <?php include 'scrollupbutton.inc';?>
    <!-- End of Scroll up Button -->
    
    <!--Developer: Siradanai Inchansuk. This is Application Form HTML Codes -->
    <form method="post" action="http://mercury.swin.edu.au/it000000/formtest.php">
        <section class="center">
            <br>
            <header>
                <h1 id="HeaderApply">Application Form</h1>
            </header>
            <fieldset class="purpleApply">
                <legend>Reference and Personal Details</legend>
            <!-- Reference Number Text Input -->
            <div class="formBox">
                <label for="ReferenceNumber">Reference number</label>
                <input type="text" id="ReferenceNumber" name="ReferenceNumber" maxlength="5" pattern="[a-zA-Z0-9]{5}" placeholder="Enter Reference number (e.g 10001)" required="required"> 
                <span></span>
            </div>
            <!-- First Name Text Input -->
            <div class="formBox">
                <label for="FirstName">First name</label>
                <input type="text" id="FirstName" name="FirstName" required="required" maxlength="20" pattern="[A-Za-z\s]{1,20}" placeholder="Enter your first name">
                <span></span>
            </div>
            <!-- Last Name Text Input -->
            <div class="formBox">
                <label for="LastName">Last name</label>
                <input type="text" id="LastName" name="LastName" required="required" maxlength="20" pattern="[A-Za-z\s]{1,20}" placeholder="Enter your last name">
                <span></span>
            </div>
            <!-- Date Of Birth Text Input -->
            <div class="formBox">
                <label for="DOB">Date of Birth</label>
                <input type="date" id="DOB" name="DOB"  required>
                <span></span>
            </div>
            <!-- Gender Radio Buttons Input -->
            <p id="radioApply">
                <label>Gender</label>
                <label for="male">Male</label>
                <input type="radio" id="male" name="Sex" value="male" required="required" checked="checked"> 
                <label for="female">Female</label>
                <input type="radio" id="female" name="Sex" value="female">
                <label for="other">Others</label>
                <input type="radio" id="other" name="Sex" value="other">
            </p>
            </fieldset>
            <br>
            <fieldset class="blueApply">
                <legend>Address</legend>
                <!-- Street Address Text Input -->
                <div class="formBox">
                    <label for="StreetAddress">Street Address</label>
                    <input type="text" id="StreetAddress" name="StreetAddress" required="required" maxlength="40" pattern="[A-Za-z0-9\s]{1,40}" placeholder="Enter Street Address">
                    <span></span>
                </div>
                <!-- Suburb/Town Text Input -->
                <div class="formBox">
                    <label for="Suburb">Suburb/Town</label>
                    <input type="text" id="Suburb" name="Suburb/Town" required="required" pattern="[A-Za-z0-9\s]{1,40}" placeholder="Enter Suburb/Town">
                    <span></span>
                </div>
                <!-- State Selection -->
                <div class="formBox">
                    <label for="char">State</label>
                    <select id="char" name="State">
                        <option value="VIC">VIC</option>
                        <option value="NSW">NSW</option>
                        <option value="QLD">QLD</option>
                        <option value="NT">NT</option>
                        <option value="WA">WA</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="ACT">ACT</option>
                    </select>
                </div>
                <!-- Postcode Text Input -->
                <div class="formBox">
                    <label for="postcode">Postcode</label>
                    <input type="text" id="postcode" name="Postal" required="required" maxlength="4" pattern="[0-9]{4}" placeholder="Postal Code">
                    <span></span>
                </div>
            </fieldset>
            <br>
            <fieldset class="greenApply">
                <legend>Personal Contact Information</legend>
                <!-- Email Text Input -->
                <div class="formBox">
                    <label for="Email">Email Address</label>
                    <input type="email" id="Email" name="Email" required="required" placeholder="Enter Email">
                    <span></span>
                </div>
                <!-- Phone Number Text Input -->
                <div class="formBox">
                    <label for="PhoneNumber">Phone Number</label>
                    <input type="text" id="PhoneNumber" name="PhoneNumber" required="required" pattern="[0-9\s]{8,12}" placeholder="Enter Phone number">
                    <span></span>
                </div>
            </fieldset>
            <br>
            <fieldset class="redApply">
                <legend>Skills list</legend>
                <br>
                <!-- Degree Level Selection -->
                <div class="formBox">
                    <label for="Degreelevel" id="formBoxLabelDegLevel">Degree Level</label>
                    <select id="Degreelevel" name="Degreelevel">
                        <option value="None">No degree</option>
                        <option value="BA">BA</option>
                        <option value="MSc">MSc</option>
                        <option value="PhD">PhD</option>
                    </select>
                </div>
                <!-- Degree Selection -->
                <div class="formBox">
                    <label for="Degree" id="formBoxLabelDeg">Degree</label>
                    <select id="Degree" name="Degree">
                        <option value="None">No degree</option>
                        <option value="CS">Computer Science</option>
                        <option value="Software">Software Engineer</option>
                        <option value="Information">Information Technology</option>
                        <option value="Security">Cyber Security</option>
                        <option value="Relevant">Others</option>
                    </select>
                </div>
                <!-- Experience Selection -->
                <div class="formBox">
                    <label for="Years" id="formBoxLabelExperience">Experience</label>
                    <select id="Years" name="Years">
                        <option value="none">No prior revelant experience</option>
                        <option value="1-2">1-2 years of experience</option>
                        <option value="2-5">2-5 years of experience</option>
                        <option value="5-10">5-10 years of experience</option>
                        <option value="10+">10+ years of experience</option>
                    </select>
                </div>
                <!-- Social Skills Checkboxes -->
                <div class="checkboxApply">
                    <div class="bold">
                        <label>Social Skills</label>
                    </div>
                    <label for="Communications">Communications</label> 
                    <input type="checkbox" id="Communications" name="SocialSkills[]" value="Communications" checked="checked">
                    <label for="Leadership">Leadership</label> 
                    <input type="checkbox" id="Leadership" name="SocialSkills[]" value="Leadership">
                    <label for="Teamwork">Teamwork</label> 
                    <input type="checkbox" id="Teamwork" name="SocialSkills[]" value="Teamwork">
                </div>
                <br>
                <!-- Technical Skills Checkboxes -->
                <div class="checkboxApply">
                    <div class="bold">
                        <label>Technical Skills</label>
                    </div>
                    <label for="Python">Python</label> 
                    <input type="checkbox" id="Python" name="TechnicalSkills[]" value="Python" checked="checked">
                    <label for="Java">Java</label> 
                    <input type="checkbox" id="Java" name="TechnicalSkills[]" value="Java">
                    <label for="cpp">C++</label> 
                    <input type="checkbox" id="cpp" name="TechnicalSkills[]" value="C++">
                    <label for="HTML">HTML</label> 
                    <input type="checkbox" id="HTML" name="TechnicalSkills[]" value="HTML">
                    <label for="CSS">CSS</label> 
                    <input type="checkbox" id="CSS" name="TechnicalSkills[]" value="CSS">
                    <label for="JavaScript">JavaScript</label> 
                    <input type="checkbox" id="JavaScript" name="TechnicalSkills[]" value="JavaScript">
                    <label for="R">R</label> 
                    <input type="checkbox" id="R" name="TechnicalSkills[]" value="R">
                    <br>
                    <label for="PHP">PHP</label> 
                    <input type="checkbox" id="PHP" name="TechnicalSkills[]" value="PHP">
                    <label for="SQL">MySQL</label> 
                    <input type="checkbox" id="SQL" name="TechnicalSkills[]" value="SQL">
                </div>
                <!-- Description Textarea Input -->
                <div class="formBox">
                    <label for="Description">Other Skills</label>
                    <textarea id="Description" name="Description" rows="4" cols="40" placeholder="Write your additional skills here..."></textarea>
                </div>
            </fieldset>
            <button type="submit" class="btnApply">Submit</button>
            <button type="reset" class="btnApply">Reset</button>
        </section>
        <br><br><br><br><br><br><br><br>
    </form>
</body>