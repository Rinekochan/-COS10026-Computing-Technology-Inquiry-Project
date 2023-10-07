<?php 
    echo'
        <footer>
        <!-- Combine these elements to a container and style it to the left-->
        <div>
            <a href = "index.php"><img src = "images/Logo_name_horizontal.png" alt = "Company Logo: HPM"></a>
            <hr>
            <!-- Combine these circles to a container -->
            <div id = "LinkListIndex">
                <!-- Since these are unreal, I direct it all to Swinburne University of Technology homepage -->
                <a href = "https://www.swinburne.edu.au/">
                    <img src = "images/Australia.png" alt = "Australia flag">
                    <img src = "images/Vietnam.png" alt = "Vietnam flag">
                    <img src = "images/Thailand.png" alt = "Thailand flag">
                    <img src = "images/India.png" alt = "India flag">
                    <img src = "images/Bangladesh.png" alt = "Bangladesh flag">
                </a>
            </div>
            <!-- HPM Brief Description in the footer -->
            <p>Originating in Australia in 2023, HPM has rapidly expanded across five countries. 
                More than a company, HPM fosters a dynamic community of forward-thinking minds, united by a passion for pushing technological boundaries. 
                Through collaboration and innovation, we lead the charge in revolutionizing industries.
                <br> <br> 
                At HPM, we don\t just predict the future – we define it, making us the pioneers of technology\s evolution.</p>
            <!-- The horizontal line only appear if the user is using a phone -->
            <hr class = "ResponsiveDivideFooter">
        </div>

        <!-- Small navigation in the footer -->
        <div>
            <!-- Diving the right container to three to style it -->
            <div id = "FooterNavigationLinks">
                <div>
                    <h3>Company</h3>
                    <a href = "about.php">About us</a>
                    <a href = "enhancements.php">Enhancements</a>
                </div>
                <div>
                    <h3>Informations</h3>
                    <a href = "jobs.php">Jobs</a>
                    <a href = "apply.php">Apply</a>
                </div>
            </div>
            <!-- The horizontal line only appear if the user is using a phone -->
            <hr class = "ResponsiveDivideFooter">
            <div id = "ContactLink">
                <h3>Contact: <a href = "mailto:104506968@student.swin.edu.au">104506968@student.swin.edu.au</a></h3>
            </div>
        </div>
        </footer>';
?>