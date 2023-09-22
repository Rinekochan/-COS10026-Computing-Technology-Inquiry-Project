<?php

    echo'<input type = "checkbox" id = "HamburgerMenuBar">';
    echo'<div>';
    echo    '<!--This is the company logo. The logo is designed by Viet Hoang Pham.-->';
    echo    '<a href = "index.php"><img src = "./images/Logo_name.png" alt = "Company Logo"> </a>';
    echo    '<label for = "HamburgerMenuBar">';
    echo        '<span class = "content">\'</span>';
    echo        '<span class = "Line TopLine"></span>';
    echo        '<span class = "Line MiddleLine"></span>';
    echo        '<span class = "Line BottomLine"></span>';
    echo    '</label> ';
    echo'</div>';
    echo'<nav>';
    echo    '<ul>';
    echo        '<!--class:active indicate the website the user currently visits -->';
                $request_uri = $_SERVER['REQUEST_URI'];
                
                if($request_uri == '/assign2/index.php'){
        echo        '<li><a href = "index.php" id = "active">Home</a></li>';
                } else {
        echo        '<li><a href = "index.php">Home</a></li>';
                }
                if($request_uri == '/assign2/jobs.php'){
        echo        '<li><a href = "jobs.php" id = "active">Jobs</a></li>';
                } else {
        echo        '<li><a href = "jobs.php">Jobs</a></li>';                
                }
                if($request_uri == '/assign2/apply.php'){
        echo        '<li><a href = "apply.php" id = "active">Apply</a></li>';
                } else {
        echo        '<li><a href = "apply.php">Apply</a></li>';
                }
                if($request_uri == '/assign2/about.php'){
        echo        '<li><a href = "about.php" id = "active">About</a></li>';
                } else {
        echo        '<li><a href = "about.php">About</a></li>';            
                }
                if($request_uri == '/assign2/enhancements.php'){
        echo        '<li><a href = "enhancements.php" id = "active">Enhancements</a></li>';
                } else { 
        echo        '<li><a href = "enhancements.php">Enhancements</a></li>';
                }
    echo        '<li><a href = "mailto:104506968@student.swin.edu.au">Contact</a></li>';
    echo    '</ul>';
    echo'</nav>';
?>