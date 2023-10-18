<?php
function confirmationEmail($firstName, $lastName)
{
    $body = '
            <!DOCTYPE html>
            <html lang = "en">
                <head>
                    <style>
                        *{
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                            position: relative;
                        }
                        body {
                            font-family: Arial, sans-serif;
                        }
                        body > div{
                            background-color: #eefafe;
                        }
                        #emaillogo{
                            background-color: #333;
                            padding: 10px;
                            text-align: center;
                        }
                        img{
                            margin: auto;
                            width: 100px;
                        }
                        hr{
                            width: 100%;
                        }
                        h1 {
                            margin-top: 40px;
                            color: #005494;
                            font-size: 36px;
                            text-align: center;
                            text-decoration: underline;
                        }
                        #emailbody{
                            margin-top: 50px;
                            padding: 0 20px;
                        }
                        p {
                            font-size: 16px;
                            line-height: 2;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div>
                        <div id = "emaillogo">
                            <img src = "cid:image1">
                        </div>
                        <h1>Confirmation Email</h1>
                            
                        <div id = "emailbody">
                            <p>
                                Dear <span style = "color: #0078d3; font-weight: bold;">' . $firstName . ' ' . $lastName . '</span>,
                            </p>
                            <br>
                            <p>
                                Thank you for applying to <span style = "color: #0078d3; font-weight: bold;">the HPM Company</span>.
                            </p>
                            <p>
                                We\'d like to inform you that we have received your application.
                                Our team is currently reviewing all applications and we are planning to schedule interviews. 
                            </p>
                            <p>    You will receive an email from our team within the next <span style = "color: #f22800; font-weight: bold;">3 working days</span>. 
                                In any case, we will keep you updated on your application status.
                            </p>
                            <br>
                            <p>
                                Best regards,
                            </p>
                            <p>
                                HPM Company.
                            </p>
                        </div>
                    </div>
                </body>
            </html>';
    return $body;
}
function interviewEmail($firstName, $lastName, $job, $doi)
{
    $body = '
            <!DOCTYPE html>
            <html lang = "en">
                <head>
                    <style>
                        *{
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                            position: relative;
                        }
                        body {
                            font-family: Arial, sans-serif;
                        }
                        body > div{
                            background-color: #eefafe;
                        }
                        #emaillogo{
                            background-color: #333;
                            padding: 10px;
                            text-align: center;
                        }
                        img{
                            margin: auto;
                            width: 100px;
                        }
                        hr{
                            width: 100%;
                        }
                        h1 {
                            margin-top: 40px;
                            color: #005494;
                            font-size: 36px;
                            text-align: center;
                            text-decoration: underline;
                        }
                        #emailbody{
                            margin-top: 50px;
                            padding: 0 20px;
                        }
                        p {
                            font-size: 16px;
                            line-height: 2;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div>
                        <div id = "emaillogo">
                            <img src = "cid:image1">
                        </div>
                        <h1>Interview Email</h1>
                            
                        <div id = "emailbody">
                            <p>
                                Dear <span style = "color: #0078d3; font-weight: bold;">' . $firstName . ' ' . $lastName . '</span>,
                            </p>
                            <br>
                            <p>
                                Thank you for your application to the <span style = "color: #f22800; font-weight: bold;">' . $job . '</span> position at <span style = "color: #0078d3; font-weight: bold;">the HPM Company</span>.
                            </p>
                            <p>
                                We would like to invite you to interview for the role with <span style = "color: #0078d3; font-weight: bold;">Mr. Viet Hoang Pham</span>, the HPM Company founder. 
                                The interview will last 10 minutes in total.
                            </p>
                            <p> 
                                Here\'s the date our manager has scheduled for this interview: <span style = "color: #f22800; font-weight: bold;">' . $doi . '</span>
                            </p>
                            <p>
                                Please reply to this email or contact us immediately if you are not available in this session.
                            </p>
                            <br>
                            <p>
                                Best regards,
                            </p>
                            <p>
                                HPM Company.
                            </p>
                        </div>
                    </div>
                </body>
            </html>';
    return $body;
}
function rejectionEmail($firstName, $lastName, $job)
{
    $body = '
            <!DOCTYPE html>
            <html lang = "en">
                <head>
                    <style>
                        *{
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                            position: relative;
                        }
                        body {
                            font-family: Arial, sans-serif;
                        }
                        body > div{
                            background-color: #eefafe;
                        }
                        #emaillogo{
                            background-color: #333;
                            padding: 10px;
                            text-align: center;
                        }
                        img{
                            margin: auto;
                            width: 100px;
                        }
                        hr{
                            width: 100%;
                        }
                        h1 {
                            margin-top: 40px;
                            color: #005494;
                            font-size: 36px;
                            text-align: center;
                            text-decoration: underline;
                        }
                        #emailbody{
                            margin-top: 50px;
                            padding: 0 20px;
                        }
                        p {
                            font-size: 16px;
                            line-height: 2;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div>
                        <div id = "emaillogo">
                            <img src = "cid:image1">
                        </div>
                        <h1>Rejection Email</h1>
                            
                        <div id = "emailbody">
                            <p>
                                Dear <span style = "color: #0078d3; font-weight: bold;">' . $firstName . ' ' . $lastName . '</span>,
                            </p>
                            <br>
                            <p>
                                We appreciate your interest in working as a <span style = "color: #f22800; font-weight: bold;">' . $job . '</span> for <span style = "color: #0078d3; font-weight: bold;">the HPM Company</span>.
                            </p>
                            <p>
                                After careful consideration, we decided to move forward with another candidate, but we would like to thank you for taking the time interviewing with our team,
                                and allowing the opportunity to learn more about your accomplishments and skills.
                            </p>
                            <br>
                            <p> 
                                We wish you luck in your future professional endeavors.
                            </p>
                            <p>
                                Best regards,
                            </p>
                            <p>
                                HPM Company.
                            </p>
                        </div>
                    </div>
                </body>
            </html>';
    return $body;
}

function acceptEmail($firstName, $lastName, $job)
{
    $body = '
            <!DOCTYPE html>
            <html lang = "en">
                <head>
                    <style>
                        *{
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                            position: relative;
                        }
                        body {
                            font-family: Arial, sans-serif;
                        }
                        body > div{
                            background-color: #eefafe;
                        }
                        #emaillogo{
                            background-color: #333;
                            padding: 10px;
                            text-align: center;
                        }
                        img{
                            margin: auto;
                            width: 100px;
                        }
                        hr{
                            width: 100%;
                        }
                        h1 {
                            margin-top: 40px;
                            color: #005494;
                            font-size: 36px;
                            text-align: center;
                            text-decoration: underline;
                        }
                        #emailbody{
                            margin-top: 50px;
                            padding: 0 20px;
                        }
                        p {
                            font-size: 16px;
                            line-height: 2;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <div>
                        <div id = "emaillogo">
                            <img src = "cid:image1">
                        </div>
                        <h1>Acceptance Email</h1>
                            
                        <div id = "emailbody">
                            <p>
                                Dear <span style = "color: #0078d3; font-weight: bold;">' . $firstName . ' ' . $lastName . '</span>,
                            </p>
                            <br>
                            <p>
                                Thank you for attending an interview for the <span style = "color: #f22800; font-weight: bold;">' . $job . '</span> position at <span style = "color: #0078d3; font-weight: bold;"> the HPM Company</span>.
                            </p>
                            <p>
                                We\'ve finished conducting interviews and are delighted to say that we feel you are the best candidate for the position and would like to offer you the role. 
                            </p>
                            <p> 
                                Please reply to this email or contact us by the next <span style = "color: #f22800; font-weight: bold;">1 week</span> if you would like to accept this position.  
                            </p>
                            <br>
                            <p>
                                Best regards,
                            </p>
                            <p>
                                HPM Company.
                            </p>
                        </div>
                    </div>
                </body>
            </html>';
    return $body;
}
?>