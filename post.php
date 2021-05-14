<?php

if($_POST){
    $client_name    = "";
    $client_email   = "";
    $client_message = "";
    $email_body     = "<div>";

    if(isset($_POST['name'])){
        $client_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                            <label>
                                <b>Client Name:</b> 
                            </label>&nbsp;<span>".$client_name."</span>
                        </div>";
    
                            }  
                            
    if(isset($_POST['email'])) {
        $client_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $client_email = filter_var($client_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                             <label>
                                <b>Clients Email:</b></label>&nbsp;<span>".$client_email."</span>
                        </div>";
                                }
                                
    if(isset($_POST['message'])) {
        $client_message = htmlspecialchars($_POST['message']);
        $email_body .= "<div>
                          <label><b>Client Message:</b></label>
                               <div>".$client_message."</div>
                               </div>";
                                }


}


$recipient = "info@sintara.co.za";
$email_body .= "</div>";
$headers  = 'MIME-Version: 1.0' . "\r\n"
.'Content-type: text/html; charset=utf-8' . "\r\n"
.'From: ' . $client_email . "\r\n";
  
if(mail($recipient, $email_title, $email_body, $headers)) {
    echo "<p>Thank you for contacting us, $client_name. You will get a reply within 24 hours.</p>";
} else {
    echo '<p>We are sorry but the email did not go through.</p>';
}
  
