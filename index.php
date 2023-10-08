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
    <meta name = "description" content = "This is the homepage of the HPM Company">
    <meta name = "keywords" content = "homepage">
    <!--The Developer of this page is Viet Hoang Pham.--> 
    <meta name = "author" content = "Viet Hoang Pham">
    <title>HPM: Homepage</title>
    <!-- This .inc file includes all css locations for each resolution of devices -->
    <?php include_once 'cssfiles.inc';?>
    <!-- Website small icon -->
    <link rel = "shortcut icon" href="images/favicon.png">
</head>
<body id = "MainBackground">   
    <!--Developer: Viet Hoang Pham. This is Navigation Menu code. You should add this at the start of <body> element-->
    <?php include_once 'header.inc';?>
    <!--End of Navigation Menu Code.-->

    <!--Developer: Viet Hoang Pham. Scroll Up Button-->
    <?php include_once 'scrollupbutton.inc';?>
    <!-- End of Scroll up Button -->

    <!--The picture is downloaded from https://www.jll.fi/fi/trendit-ja-tutkimukset/tyopaikka/bringing-privacy-to-the-open-plan-office
        Designed by Viet Hoang Pham
    -->
    <!-- Header of Index Page -->
    <main>
        <section id = "IndexHeaderPage">
            <!-- Dividing into different container based on contents -->
            <header>
                <h1>HPM Company</h1>
                <h2>The world's leading technology company in manufacturing.</h2>
                <p>Innovation and creativity requires people from a wide range of backgrounds. We're always seeking for ambitious talents to join our team.</p>
                <div id = "YoutubeLink">
                    <a href = "https://youtu.be/pqaZKxT5mbs">Assignment 1</a>
                    <a href = "https://youtu.be/pqaZKxT5mbs">Assignment 2</a>
                </div>
            </header>  
            <div>
                <!-- Separating into two separate containers -->
                <article id = "Enhancement1">
                    <h3>Who are we?</h3>
                    <p>Officially founded in 2023 in Australia, HPM has rapidly expanded to 5 nations with 400,000 members and collaborated with a host of significant investors.</p>
                </article>
                <article>
                    <h3>Our Vision</h3>
                    <p>Becomes a dominant technology manufacturer, empowering every person on the planet to achieve more with our cutting-edge and reliable devices.</p>
                </article>
            </div>
        </section>
        
        <!--Body Code-->

        <section id = UpperBodyIndex>
            <header>
                <h2 id = "Enhancement2">Explore Career</h2>
            </header>
            <hr>
            <!-- Explore Career-->
            <div>
                <!-- Separating into three different containers -->
                <a href = "jobs.php">
                    <h3>JOBS</h3>
                    <p>Don't know where to start? Have a look at available jobs now!</p>
                </a>
                <a href = "about.php">
                    <h3>ABOUT</h3>
                    <p>Want to know more about us? Discover your future family!</p>
                </a>
                <a href = "apply.php">
                    <h3>APPLY NOW</h3>
                    <p>Want to be a part of our family? Apply to HPM entreprise now!</p>
                </a>
            </div>
        </section>

        <!-- Checkbox Animation -->
        <div id = "BodyIndex">
            <input type = "checkbox" id = "AnimationBodyIndex"> 
            <!-- Using checkbox to making animation -->
            <header>
                <label for = "AnimationBodyIndex">
                    <span id = "BodyIndexHeader">
                        Values <span class = "EmHeadingIndex"> & </span> Missions 
                    </span>
                    <span class = "UlineIndex">Find out more</span>
                </label> 
            </header>
            <!-- Values and Missions of HPM -->
            <div id = "ContainerBodyIndex">
                <!-- Group the header and paragraph into containers to style easier -->
                <article>
                    <h3>Audacious</h3>
                    <p>We don't hesitate to defy established norms.</p>
                    <hr>
                </article>
                <article>
                    <h3>Impact-driven</h3>
                    <p>We place a high value on real-world applications and implications.</p>
                    <hr>
                </article>
                <article>
                    <h3>Continuous Learning</h3>
                    <p>We are dedicated to endless progress and evolution.</p>
                    <hr>
                </article>
                <article>
                    <h3>Diversity and Inclusion</h3>
                    <p>We are committed to celebrating the diversity around us.</p>
                    <hr>
                </article>
            </div>
        </div>
            
        <section id = "LowerBodyIndex">
            <header>
                <h2>In Collaboration</h2>
            </header>
            <hr>
            <!-- Combine these elements to a container -->
            <!--The logo company of www.microsoft.com, www.lenovo.com, www.asus.com, www.dell.com, www.intel.com-->
            <div id = "Collaboration">
                <a href = "https://www.microsoft.com/"><img src = "images/Microsoft.png" alt = "Microsoft Logo"></a>
                <a href = "https://www.lenovo.com/"><img src = "images/Lenovo.png" alt = "Lenovo Logo"></a>
                <a href = "https://www.asus.com/"><img src = "images/Asus.png" alt = "Asus Logo"></a>
                <a href = "https://www.dell.com/"><img src = "images/Dell.png" alt = "Dell Logo"></a>
                <a href = "https://www.intel.com/"><img src = "images/Intel.png" alt = "Intel Logo"></a>
            </div>
            <!--Map: https://favpng.com/png_view/asean-east-asia-blank-map-united-states-world-map-png/XZwH2Akw
                Designed by: Viet Hoang Pham
            -->
            <div id = "LocationIndex">
                <!-- Combine these elements to a container to style it vertically -->
                <section>
                    <header>
                        <h2>Where we are</h2>
                    </header>
                    <p>HPM currently operates in Australia, Vietnam, Thailand, India, and Bangladesh.</p>
                    <!-- Combine these elements to a container to style it horizontally -->
                    <div>
                        <!-- Since these are unreal, I direct it all to Swinburne University of Technology homepage -->
                        <a href = "https://www.swinburne.edu.au/">
                            <img src = "images/Australia.png" alt = "Australia flag">
                            <img src = "images/Vietnam.png" alt = "Vietnam flag">
                            <img src = "images/Thailand.png" alt = "Thailand flag">
                            <img src = "images/India.png" alt = "India flag">
                            <img src = "images/Bangladesh.png" alt = "Bangladesh flag">
                        </a>
                    </div>
                </section>
                <img src = "images/Location_without_flag.png" alt = "Company Location">
            </div>
        </section>
    </main>
    <!-- Developer: Viet Hoang Pham. This is the HTML Codes of Footer -->
    <?php include_once 'footer.inc';?>
</body>
</html>
