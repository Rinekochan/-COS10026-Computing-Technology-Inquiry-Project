<!--
    Name/ID: Viet Hoang Pham 104506968
    Assignment 1
-->
<!DOCTYPE html>

<html lang = "en">
<!--Please note that most of images using in this website including the logo, background images, ... are designed by Viet Hoang Pham.
    Please notify the owner before use.
-->
<head>
    <meta charset = "UTF-8" >
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "This is the Enhancement Page of the HPM team">
    <meta name = "keywords" content = "enhancementpage">
    <!--The Developer of this page is Viet Hoang Pham.--> 
    <meta name = "author" content = "Viet Hoang Pham">
    <title>HPM: Enhancements</title>
    <!-- This .inc file includes all css locations for each resolution of devices -->
    <?php include 'cssfiles.inc';?>
    <link rel = "shortcut icon" href="images/favicon.png">
</head>
<body id = "EnhancementImgIndex">   
    <!--Developer: Viet Hoang Pham. This is Navigation Menu code. You should add this at the start of <body> element-->
    <?php include 'header.inc';?>
    <!--End of Navigation Menu Code.-->
    
    <!--Developer: Viet Hoang Pham. Scroll Up Button-->
    <?php include 'scrollupbutton.inc';?>
    <!-- End of Scroll up Button -->
    <!--End of Navigation Menu Code.-->
    <main>
        <div id = "EnhancementHeader">
            <input type = "checkbox" id = "AnimationEnhancementHeader">
            <label for = "AnimationEnhancementHeader">
                <span class = "EnhancementClick">Explore Now!</span>
            </label> 
            <!-- Using a div container to group the boxs -->
            <div id = "FirstEnhancementColumn">
                <!-- Developer of this Enhancement: Viet Hoang Pham -->
                <a href = "index.html#Enhancement2">
                    <h2>Typewriter Animation</h2>
                    <p>Developer: Viet Hoang Pham</p>
                    <hr>
                    <h3>Creating text that simulates the typing animation.</h3>
                    <p>The animation, achieved with <strong>@keyframes</strong>, adding more visual appeal compared to basic CSS.</p>
                </a>
                <!-- Developer of this Enhancement: Viet Hoang Pham -->
                <a href = "enhancements.html">
                    <h2>Glow Text Animation</h2>
                    <p>Developer: Viet Hoang Pham</p>
                    <hr>
                    <h3>Creating text that has a vivid radiance surrounding it.</h3>
                    <p>The animation, achieved with <strong>@keyframes</strong>, adding more visual appeal compared to basic CSS.</p>
                </a>
                <!-- Developer of this Enhancement: Viet Hoang Pham -->
                <a href = "index.html#BodyIndex">
                    <h2>Checkbox Tricks</h2>
                    <p>Developer: Viet Hoang Pham</p>
                    <hr>
                    <h3>Checkboxes can toggle between unchecked and checked states.</h3>    
                    <p>By using ":checked" pseudo-elements and sibling combinators, elements could be <strong>styled differently</strong> in each state, adding interactivity that goes beyond basic CSS styling.</p>
                </a>
            </div>
            <div id = "SecondEnhancementColumn">
                <!-- Developer of this Enhancement: Viet Hoang Pham -->
                <a href = "#">
                    <h2>Hamburger Menu Bar (for Tablets, Phones)</h2>
                    <p>Developer: Viet Hoang Pham</p>
                    <hr>
                    <h3>Display Hamburger Menu Bar on Tablets and Phones resolutions.</h3>
                    <p>It is achieved by utilizing <strong>Checkbox Tricks</strong>, adding interactivity that goes beyond basic CSS styling.</p>
                </a>
                <!-- Developer of this Enhancement: Viet Hoang Pham -->
                <a href = "#">
                    <h2>Responsive Website Design</h2>
                    <p>Developer: Viet Hoang Pham</p>
                    <hr>
                    <h3>Specific styles for different screen sizes: Tablets, Phones.</h3>
                    <p>Create separate CSS layouts with <strong>@media queries</strong> specifying 'min-width' and 'max-width' values, which provides more accessibility for a broader audience than basic CSS can offers.</p>
                </a> 
                <!-- Developer of this Enhancement: Siradanai Inchansuk -->
                <a href = "apply.html#ReferenceNumber">
                    <h2>Valid, Invalid and Focus Pseudo Elements</h2>
                    <p>Developer: Siradanai Inchansuk</p>
                    <hr>
                    <h3>Valid, Invalid and Focus will notify the users with valid or invalid informations.</h3>
                    <p>Showing a red highlight and content: "✖" if <strong>the information providing is invalid and vice versa</strong>, enhacing accessibility which goes beyond the basic requirements.</p>
                </a>
            </div>
        </div>
    </main>
</body>