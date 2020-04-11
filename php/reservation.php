<?php


	// Proccess at only POST metheod
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
	    // name of sender
	    $name = strip_tags(trim($_POST["name"]));    
	    // Email of sender
	    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
	   	// Phone of sender
		$phone = strip_tags(trim($_POST['phone']));
	   	// Hour of sender
		$hour = strip_tags(trim($_POST['hour']));
	   	// Date of sender
		$date = strip_tags(trim($_POST['date']));
	   	// Guest of sender
		$guest = strip_tags(trim($_POST['guest']));
	   	// Guest of sender
		$message = strip_tags(trim($_POST['message']));


		// Your email where this email will be sent
    	//$your_email = "example@example.com";
        $your_email = $email;

    	//Your site name for identify  
    	//$your_site_name = "Example";
        $your_site_name = $name;

    	// Build email subject
    	$email_subject = "[{$your_site_name}] New Message by {$name}";

    	// Build Email Content
    	$email_content = "Name: {$name}\n";
    	$email_content .= "Email: {$email}\n";
    	$email_content .= "Phone: {$phone}\n";
    	$email_content .= "Guest: {$guest}\n";
    	$email_content .= "Date: {$date}\n";
    	$email_content .= "Hour: {$hour}\n";
		if(!empty($message)) {
			$email_content .= "Message: {$message}\n";
		}

    	// Build email headers
    	$email_headers = "From: {$name} <{$email}>";

    	// Send email
    	$send_email = mail($your_email, $email_subject, $email_content, $email_headers);

    	// Check email sent or not
	    if($send_email){
			//$jsondata["success"] = true;
    		$jsondata["info"] = array(
      			'message' => "Thank You! Your message has been sent.",
      			'type' => "success"
    		);
			header('Content-type: application/json; charset=utf-8');
  			echo json_encode($jsondata);

	    } else {
			//$jsondata["success"] = true;
    		$jsondata["info"] = array(
      			'message' => "Oops! we couldn't send your message. Please try again later",
      			'type' => "danger"
    		);
			header('Content-type: application/json; charset=utf-8');
  			echo json_encode($jsondata);
	    }
	}else{
		//$jsondata["success"] = true;
    	$jsondata["info"] = array(
      		'message' => "Oops! Submition problem. Please try again later",
      		'type' => "danger"
    	);
		header('Content-type: application/json; charset=utf-8');
  		echo json_encode($jsondata);
	}  	
?>