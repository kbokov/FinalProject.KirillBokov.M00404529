<?php 
if(isset($_POST['submit'])){
    $to = "sallivann@inbox.ru"; // this is company's address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "VE staff - holiday requst";
    $subject2 = "Copy of your submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    
    }
?>

<!DOCTYPE html>
<head>
<title>Holiday request/manager's contact</title>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"    content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
    
    <title>Village East Staff Membersite</title>

    <link rel="shortcut icon" href="assets/images/gt_favicon.png">
    
    <!-- Bootstrap itself -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles -->
    <link rel="stylesheet" href="assets/css/magister.css">

    <!-- Fonts -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>
</head>
<body>

<form action="" method="post">
Emoloyess First name: <input type="text" name="first_name"><br>
Emoloyess Last Name: <input type="text" name="last_name"><br>
Emoloyess Email: <input type="text" name="email"><br>
Holiday request:<br><textarea rows="5" name="message" cols="30"></textarea><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html> 