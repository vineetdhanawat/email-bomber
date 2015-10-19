<?php


	function validate_form_items()
	{
	
	   $form_items = array(
		   
			"emailto" => array(
						   "regex" =>
							"/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/",
						   "error" => "Please enter your valid email-to address",
						   ),
			"emailfrom" => array(
						   "regex" =>
							"/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/",
						   "error" => "Please enter your valid email-from address",
						   ),
			"subject"  => array(
						   "regex" => "/^([a-zA-Z0-9 '-]+)$/",
						   "error" => "Subject appears to be in inproper format",
						   ),			   
		   "message" => array(
						   "regex" => "/^([a-zA-Z0-9 '-]+)$/",
						   "error" => "Your message contains invaid characters",
						   ),
			"countn" => array(
						   "regex" => "/^([0-9]+)$/",
						   "error" => "Please enter count in Integers",
						   ),			   
	   );

	   $errors = array();

	   foreach($form_items as $item_name => $item_props)
	   {
		   if (!preg_match($item_props["regex"], trim($_POST[$item_name])))
		   {
				   $errors[] = $item_props["error"];
		   }
	   }

	   return $errors;
	}
	
	function email($emailfrom, $emailto, $subject, $message, $countn)
	{
		$headers = "From: ".$emailfrom."\r\n";
		$headers .= "Reply-To: ".$emailfrom."\r\n";
		$headers .= "Return-Path: ".$emailfrom."\r\n";
		$headers .= "Content-Type: text/html";
		$additional_parameters = "-f"." ".$emailfrom;
		if($countn==1)
		{
			if (mail($emailto,$subject,$message,$headers,$additional_parameters) ) {
				echo "Your Mail has been sent";
			} else {
				echo "Your message could not be sent at this time. Please try again.";
			}
		}
		else
		{	
			$length = 5;
			for ($q = 0; $q < $countn; $q++)
			{
				$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$string = "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";    
				for ($p = 0; $p < $length; $p++)
				$string .= $chars[mt_rand(0, strlen($chars))] . $chars[mt_rand(0, strlen($chars))] . $chars[mt_rand(0, strlen($chars))] . $chars[mt_rand(0, strlen($chars))] . " ";
				$emailid = $chars[mt_rand(0, strlen($chars))] . $chars[mt_rand(0, strlen($chars))] . $chars[mt_rand(0, strlen($chars))] . $chars[mt_rand(0, strlen($chars))] . "@gmail.com";
				$spam = $message . $string;
				$headers = "From: ".$emailid."\r\n";
				$headers .= "Reply-To: ".$emailid."\r\n";
				$headers .= "Return-Path: ".$emailid."\r\n";
				$headers .= "Content-Type: text/html";
				$additional_parameters = "-f"." ".$emailfrom;
				mail($emailto,$subject,$spam,$headers,$additional_parameters);
			}
			echo "Your Spam Mails have been sent";
		}
	}

	function print_error($errors)
	{
		foreach($errors as $error)
		{
			echo $error."<br>";
		}
	}
	
	function form_process()
	{	
		global $to, $subject;

		$errors = validate_form_items();
		
		if(count($errors) == 0)
		{
			$errors [] = email($_POST["emailfrom"], $_POST["emailto"], $_POST["subject"], $_POST["message"], $_POST["countn"]);
		}
		
		print_error($errors);
	}
	
	form_process();

?>








