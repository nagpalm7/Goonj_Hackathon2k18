<?php
require '../html/PHPMailer/PHPMailerAutoload.php';

function mail_send($id,$content)
{
$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'noreplydig@gmail.com';
$mail->Password = 'password_here';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('noreplydig@gmail.com', 'Design And Innovation Group');
$mail->addAddress($id);   // Add a recipient

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = $content;

$mail->Subject = 'Design And Innovation Group';
$mail->Body    = $bodyContent;




if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;

echo "Error: Contact Administrator";
}

}
// Initialize variables to null.

$titleError ="";
$messageError ="";
$linkError ="";
$success="";

//On submitting form below function will execute

if(isset($_POST['submit'])){

   if (empty($_POST["title"])) {
     $titleError = "Title is required";
   } else {
     $title = test_input($_POST["title"]);
     // check name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$title))
     {
       $titleError = "Only letters and white space allowed";
     }
   }

   if (empty($_POST["message"])) {
     $messageError = "Message is required";
   } else {
     $message = test_input($_POST["message"]);

     }


   if (empty($_POST["link"])) {
     $linkError = "Link is required";
   } else {
     $link = test_input($_POST["link"]);
     // check address syntax is valid or not(this regular expression also allows dashes in the URL)
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) {
       $linkError = "Invalid URL";
     }
     else {
        $success="Form has been submtted successfully";
     }
   }

$con=mysqli_connect("localhost","root","root","UTECHNOS");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "INSERT INTO link (title, message, link)
VALUES ('$title', '$message', '$link' )";
$con->query($sql);
mysqli_commit($con);
$maiHtml = '<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Notification</title>
  </head>
  <body style="min-width:100%">
    <div style="border:4px solid grey;padding:10px 10px 10px 10px">
      <div style="border:4px solid #c6c9ce;">
        <div style="padding:40px 40px 40px 40px">
        <h1 align="center">'.$title.'</h1>
          <p>'.$message.'.</p>
          <p style="text-align:center;padding-top:20px;">'.$link.'</p>
        </div>
      </div>
    </div>
  </body>
</html>
';

mail_send('nagpalm7@gmail.com',$maiHtml);
mail_send('pareksha.manchanda@gmail.com',$maiHtml);

/// $_SESSION['hehe']=$myjson;

}



function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="Description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" id="nav">
  <div class="container-fluid">
<div class="navabar-header">
<a class="navbar-brand" href="http://puchd.ac.in/">
       <span> <img alt="Brand" width="50px" height="50px" src="http://physics.puchd.ac.in/events/nssp/nssp2017/includes/pu-logo-trans.png">       PANJAB UNIVERSITY</span>
      </a>
</div>

  </div>
</nav>

    <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="/dashboard">
                        DASHBOARD
                    </a>
                </li>
                <li>
                    <a href="note.php">NOTIFICATIONS</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->


        <div>
                         <a href="#menu-toggle" class="btn btn-default " id="menu-toggle">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                         </a>
         </div>
        <!-- /#page-content-wrapper -->

  </div>
    <!-- /#wrapper -->
    <div>
      <form method = "post" class="width" action ="note.php">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="title" class="form-control textbox" id="title" placeholder="Title" name="title"><span class="error"><?php echo $titleError;?></span>
  </div>
  <div class="form-group">
    <label for="message">Description</label>
    <textarea class="form-control textbox" rows="4" placeholder="Message" name="message"></textarea><span class="error"><?php echo $messageError;?></span>
  </div>
  <div class="form-group">
    <label for="link">Link</label>
    <input type="Text" class="form-control textbox" id="link" placeholder="Link" name="link"><span class="error"><?php echo $linkError;?></span>
  </div>
  <div class="row-container">
  <div class="row">
      <label class="container checks">CSE
       <input type="checkbox" id="inlineCheckbox1" value="eee">
       <span class="checkmark"></span>
     </label>
   <label class="container checks">ECE
     <input type="checkbox" id="inlineCheckbox2">
     <span class="checkmark"></span>
   </label>
   <label class="container checks">EEE
     <input type="checkbox" id="inlineCheckbox3">
     <span class="checkmark"></span>
   </label>
 </div>
 <div class="row">
   <label class="container checks">MECH
     <input type="checkbox" id="inlineCheckbox4">
     <span class="checkmark"></span>
   </label>
   <label class="container checks">IT
    <input type="checkbox" id="inlineCheckbox1">
    <span class="checkmark"></span>
  </label>
  <label class="container checks">BIO-TECH
    <input type="checkbox" id="inlineCheckbox2">
    <span class="checkmark"></span>
  </label>
</div>
</div>
<button type="submit" name="submit" value="submit" class="btn btn-primary text-uppercase" >Submit</button>
</div>
<br>



    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>



</body>

</html>
