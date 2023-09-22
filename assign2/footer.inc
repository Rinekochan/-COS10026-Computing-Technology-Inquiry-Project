<?php 
    echo'<footer>';
    echo'<!-- Combine these elements to a container and style it to the left-->';
    echo'<div>';
    echo    '<a href = "index.php"><img src = "images/Logo_name_horizontal.png" alt = "Company Logo: HPM"></a>';
    echo    '<hr>';
    echo    '<!-- Combine these circles to a container -->';
    echo    '<div id = "LinkListIndex">';
    echo        '<!-- Since these are unreal, I direct it all to Swinburne University of Technology homepage -->';
    echo        '<a href = "https://www.swinburne.edu.au/">';
    echo            '<img src = "images/Australia.png" alt = "Australia flag">';
    echo            '<img src = "images/Vietnam.png" alt = "Vietnam flag">';
    echo            '<img src = "images/Thailand.png" alt = "Thailand flag">';
    echo            '<img src = "images/India.png" alt = "India flag">';
    echo            '<img src = "images/Bangladesh.png" alt = "Bangladesh flag">';
    echo        '</a>';
    echo    '</div>';
    echo    '<!-- HPM Brief Description in the footer -->';
    echo    '<p>Originating in Australia in 2023, HPM has rapidly expanded across five countries. 
               More than a company, HPM fosters a dynamic community of forward-thinking minds, united by a passion for pushing technological boundaries. 
               Through collaboration and innovation, we lead the charge in revolutionizing industries.
               <br> <br> 
               At HPM, we don\'t just predict the future – we define it, making us the pioneers of technology\'s evolution.</p>';
    echo    '<!-- The horizontal line only appear if the user is using a phone -->';
    echo    '<hr class = "ResponsiveDivideFooter">';
    echo'</div>';

    echo'<!-- Small navigation in the footer -->';
    echo'<div>';
    echo    '<!-- Diving the right container to three to style it -->';
    echo    '<div id = "FooterNavigationLinks">';
    echo        '<div>';
    echo            '<h3>Company</h3>';
    echo            '<a href = "about.php">About us</a>';
    echo            '<a href = "enhancements.php">Enhancements</a>';
    echo        '</div>';
    echo        '<div>';
    echo            '<h3>Informations</h3>';
    echo            '<a href = "jobs.php">Jobs</a>';
    echo            '<a href = "apply.php">Apply</a>';
    echo        '</div>';
    echo    '</div>';
    echo    '<!-- The horizontal line only appear if the user is using a phone -->';
    echo    '<hr class = "ResponsiveDivideFooter">';
    echo    '<div id = "ContactLink">';
    echo        '<h3>Contact: <a href = "mailto:104506968@student.swin.edu.au">104506968@student.swin.edu.au</a></h3>';
    echo    '</div>';
    echo'</div>';
    echo'</footer>';
?>