<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname = 'Erika';
    $lname = 'Garcias';
    $email = $_POST['email'];
    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        // MailChimp API credentials
        /*$apiKey = 'InsertMailChimpAPIKey';
        $listID = 'InsertMailChimpListID';*/
        $apiKey = '9d1ba5754d8ca621b44ea617f8a6a332-us16';
        $listID = '44fa68b7f4';
        
        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
        
        // member information
        $json = json_encode([
            'email_address' => $email,
            'status'        => 'subscribed',
            /*'merge_fields'  => [
                'FNAME'     => $fname,
                'LNAME'     => $lname
            ]*/
        ]);
        
        // send a HTTP POST request with curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // store the status message based on response code
        if ($httpCode == 200) {
            $jsondata["info"] = array(
      			'message' => "You have successfully subscribed.",
      			'type' => "ok"
    		);
			header('Content-type: application/json; charset=utf-8');
  			echo json_encode($jsondata);
        } else {
            switch ($httpCode) {
                case 214:
                    $jsondata["info"] = array(
                        'message' => "Oops! You are already subscribed",
                        'type' => "bad"
                    );
                    header('Content-type: application/json; charset=utf-8');
                    echo json_encode($jsondata);
                    break;
                default:
                    $jsondata["info"] = array(
                        'message' => "Oops! Some problem occurred, please try again.",
                        'type' => "bad"
                    );
                    header('Content-type: application/json; charset=utf-8');
                    echo json_encode($jsondata);
                    break;
            }
        }
    }else{
        $jsondata["info"] = array(
            'message' => "Oops! Please enter valid email address.",
            'type' => "bad"
        );
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata);
    }
}else{
    $jsondata["info"] = array(
      	'message' => "Oops! Submition problem. Please try again later",
      	'type' => "bad"
    );
	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata);
}

