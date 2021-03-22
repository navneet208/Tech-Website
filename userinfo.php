<?php

$con = mysqli_connect('localhost', 'root');

if($con){
	echo "Connection successful";
}
else{
	echo "No Connection";
}

mysqli_select_db($con, 'techuserdata');

$name = $_POST['name'];
$email = $_POST['email'];
$comments = $_POST['comments'];


$query = " insert into techdata (name, email, comments) values('$name', '$email', '$comments') ";
//echo "$query";
mysqli_query($con, $query );


$to = 'tech.hack208@gmail.com';
$subject = 'Received Comment from Tech Hack';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: '.$email.'<'.$email.'>' . "\r\n".'Reply-To: '.$email."\r\n" . 'X-Mailer: PHP/' . phpversion();
$comments = '<!doctype html>
			<html lang="en">
			<head>
				<meta charset="UTF-8">
				<meta name="viewport"
					  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
				<meta http-equiv="X-UA-Compatible" content="ie=edge">
				<title>Document</title>
			</head>
			<body>
			<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">'.$message.'</span>
				<div class="container">
                 '.$comments.'<br/>
                    Regards<br/>
                  '.$email.'
				</div>
			</body>
			</html>';

$result = @mail($to, $subject, $comments, $headers);

echo '<script>alert("Email sent successfully !")</script>';
echo '<script>window.location.href="index.php";</script>';

//redirecting to index.php again..
header('location:index.php');
?>