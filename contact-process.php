<?php

extract($_POST);

if (isset($_POST['support'])) {
	$response = array( 
    'status' => 0, 
    'message' => 'Failed to Send Message, Please try again!' 
);
	$from = $email; 
$to = 'info@africneibor.com'; 
$fromName = $name; 
 
$subject = $topic; 
 
$htmlContent = ' 
    <html> 
    <head> 
        <title>Hello AFRICNEIBOR</title> 
    </head> 
    <body> 
        
        <div style="border:1px solid gray"> 
        <div style="width:100%; background-color:grey">
        <img src="https://africneibor.com/logo.png" width="150" height="130" />
        </div>
        <div style="padding:10px 5px 5px 10px;">
        '.$message.'<br><strong>Phone Number:</strong>'.$phone.'
        </div>
        </div>
        
         </body> 
    </html>'; 
 
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
$headers .= 'Cc: '.$email . "\r\n"; 
$headers .= 'Bcc: '.$email . "\r\n"; 
 
// Send email 
if(mail($to, $subject, $htmlContent, $headers)){
$response["status"] = 1; 
			$response["message"] = "We recieved your Message!, you will recieve our reply within 24hrs.";	
}
else{
$response["message"] = "There was an Error sending us a message. Please try again!";		
}



	 echo json_encode($response);
}

?>