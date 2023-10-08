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
?>