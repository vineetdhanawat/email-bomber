<html>
	<title>Email Bomber Script</title>
	<head>
	<style>
		#errors
		{
			font-size:14px;
			font-weight:normal;
			margin:10px;
			padding:10px;
		}
	</style>

	<script type="text/javascript" src="prototype.js"></script>
	<script type="text/javascript">

	function sendRequest() {

		new Ajax.Request("send-mail.php", {
			   method: 'post',
			   postBody: "emailto="+$F("emailto")+"&subject="+$F("subject")+"&emailfrom="+$F("emailfrom")+"&message="+$F("message")+"&countn="+$F("countn"),
			   onComplete: showResponse

		});
	}

	function showResponse(req)
	{
	   $('errors').style.borderStyle= "solid";
	   
	   var res=/been sent/;
	  
	   if(req.responseText.match(res))
	   {
		$('errors').style.borderColor= "green";
		$('errors').style.color="green";
	   }else{
		$('errors').style.borderColor= "red";
		$('errors').style.color="red";
	   }
	   
	   $('errors').style.borderSize= "1px";
	   $('errors').innerHTML=  req.responseText;
	}

	</script>
	</head>

	<body><center>
	   <form id="test" method="post" onsubmit="return false;">
		<table border="0">
			   <tr>
				   <td colspan="2">

					   <div id="errors">
					   </div>

				   </td>
			   </tr>

			   <tr>
				   <td colspan="2">

					  <font size="+2"><b>Email Bomber Script</b></font>

				   </td>
			   </tr>

				<tr>
				   <td>
						<b>Email To:</b>
				   </td>
				   <td>
						<input type="text" name="emailto" id="emailto" size="55">
				   </td>
			   </tr>
			   
			   <tr>
				   <td>
						<b>Subject</b>
				   </td>
				   <td>
						<input type="text" name="subject" id="subject" size="55">
				   </td>
			   </tr>
			   
			   <tr>
				   <td>
						<b>Count</b>
				   </td>
				   <td>
						<input type="text" name="countn" id="countn" size="10" value="1">
				   </td>

			   </tr>
			   <tr>
				   <td>
						<b>Email From:</b>
				   </td>
				   <td>
						<input type="text" name="emailfrom" id="emailfrom" size="55">
				   </td>
			   </tr>

			   <tr>
				   <td>
						<b>Message:</b> 
				   </td>
			   </tr>
			   <tr>
				   <td colspan="2">
						<textarea name="message" id="message" cols="55" rows="10"></textarea>
				   </td>
			   </tr>
			   <tr>
				   <td colspan="2" align="right">
						<input type="submit" value="submit" name="submit" onClick="javascript: sendRequest();">
				   </td>
			   </tr>
		</table>
		</form></center>
	</body>
</html>