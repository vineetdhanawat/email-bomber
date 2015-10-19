# Email bomber script
Most basic version written in PHP.

## Hiding via server details
Using the -f parameter in mail function hides the via server name details
![Sample](email.jpg "via server details displayed on GMail")

		$additional_parameters = "-f"." ".$emailfrom;
		
That also changes Received-SPF: pass to Received-SPF: softfail which can be fixed by setting an SPF record for the domain and enabling DKIM

Reference http://stackoverflow.com/questions/8236312/how-to-remove-via-and-server-name-when-sending-mails-with-php

## SPAM Bot
When count>1, script send emails using random From: addresses with random 20 chars appended at end of emails to avoid duplication

## License

MIT: http://vineetdhanawat.mit-license.org/