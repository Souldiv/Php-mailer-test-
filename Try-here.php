<?php

require 'PHPMailer-master/PHPMailerAutoload.php';
$error="";$successMessage="";$flag=0;
if ($_POST) {

        if (!$_POST["Email"]) {
            $error .= "An email address is required.<br>";
           }
        if (!$_POST["text"]) {
            $error .= "The content field is required.<br>";
            }
        if (!$_POST["subject"]) {
            $error .= "The subject is required.<br>";
            }

        if ($_POST['Email'] && filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL) === false) {
            $error .= "The email address is invalid.<br>";
            }
        if ($error != "") {
            $error = '<div class="alert alert-danger" role="alert"><p>There were error(s) in your form:</p>' . $error . '</div>';
          }
          else{
                $email=$_POST['Email'];
                $text=$_POST['text'];
                $subject=$_POST['subject'];
                  $mail = new PHPMailer;
                  $mail->isSMTP();                            // Set mailer to use SMTP
                  $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
                  $mail->SMTPAuth = true;                     // Enable SMTP authentication
                  $mail->Username = '';          // SMTP username
                  $mail->Password = ''; // SMTP password
                  $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
                  $mail->Port = 587;                          // TCP port to connect to

                  $mail->setFrom('row@gmail.com', 'usersxl');
                  $mail->addReplyTo('ipsum@lorem.com', 'Robust');
                  $mail->addAddress($email);   // Add a recipient
                  $mail->addCC('test');
                  $mail->addBCC('alrightttt');
                  $mail->addAttachment(''); //Add an attachment like an image

                  $mail->isHTML(true);  // Set email format to HTML

                  $bodyContent="<h1>Writting an email</h1>";
                  $bodyContent.=$text.'   <p> Thanks for contacting us! </p>';
                  $mail->Subject = $subject;
                  $mail->Body    = $bodyContent;
                if(!$mail->send()) {
                     $error = '<div class="alert alert-danger" role="alert"><p><strong>Your message couldn\'t be sent - please try again later</div>';
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;
                  } else {
                    $successMessage = '<div class="alert alert-success" role="alert">Your message was sent, we\'ll get back to you ASAP!</div>';
                  }
                }
}
?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
     <style type="text/css">
       div{
         margin:30px;
       }
       h1{
         margin-left:25px;
       }
       .hidden{
         display: none;
       }
       .btn{
         margin-left: 30px;
       }
     </style>
   </head>
   <body>
     <div class="container">
     <h1>Send an Email!</h1>
     <div class="alert alert-success hidden" id="succ" role="alert">
   <strong>Well done!</strong> You successfully sent your Email!
 </div>
 <div id="err"><?php echo $error.$successMessage; ?></div>
 <div class="alert alert-danger hidden" id="wron" role="alert">
   <strong>Oh snap!</strong> Change a few things up and try submitting again.
 </div>
 <form method="post">
   <div class="form-group">
     <label for="Email">Email address</label>
     <input name="Email" type="email"id="Email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
   </div>
   <div class="form-group">
     <label for="subject">Subject</label>
     <input name="subject" type="text" class="form-control" aria-describedby="emailHelp">
   </div>
   <div class="form-group">
     <label for="Text">What would you like to ask us?</label>
     <textarea name="text" class="form-control" rows="3"></textarea>
   </div>
   <input class="btn btn-primary" type="submit" value="Submit">
 </form>
 </div>
     <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
     <script type="text/javascript">
     var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
     $("form").submit(function(){
       counter=0;
       var email=$("#Email").val();
     if(!email.match(re))
       counter++;
     if (!$.trim($("TextArea").val()))
       counter++;
     if(counter>0 && $("#wron:visible").length==0)
         {
           $("#wron").toggle();
         return false;
       }
     else if(counter==0){
       if($("#succ:visible").length==0)
       $("#succ").toggle();
       if($("#wron:visible").length!=0)
       $("#wron").toggle();
       return true;
     }

    });
     </script>
   </body>
 </html>
