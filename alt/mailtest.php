<?php
	echo "hi";
	
	$header = 'From: wunschliste@matthias-deborah.ch' . "\r\n" .
    'Reply-To: mattuke@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	mail("fankiflo@gmail.com", "Mailtest", "Hi auch!", $header);
?>
	