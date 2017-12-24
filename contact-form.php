<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Send email via SMTP server in PHP</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    </head>
    <body>
        <div id="main">
            <div class="container">
                <h2>Send Email via SMTP Server in PHP</h2>
                <hr/>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h3 class="page-header text-center">Contact Form Example</h3>
                        <form action="contact-form.php" class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Your name" name="name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Your email" name="email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="human" class="col-sm-2 control-label">Subject</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Subject : " name="subject"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="col-sm-2 control-label">Message</label>

                                <div class="col-sm-10">
                                    <textarea rows="4" cols="50" class="form-control"
                                              placeholder="Enter Your Message..." name="message"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" class="btn btn-primary" value="Send" name="send"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require "phpmailer/PHPMailer.php";
        require "phpmailer/OAuth.php";
        require "phpmailer/SMTP.php";
        require "phpmailer/POP3.php";
        require "phpmailer/Exception.php";
        if (isset($_POST['send'])) {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $mail = new phpmailer\phpmailer\PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'ssl://mail.adam-marsh.com:465';
            $mail->SMTPAuth = true;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Username = 'am@adam-marsh.com';
            $mail->Password = '#9794Coralrd';
            $mail->setFrom($email, $name);
            $mail->addReplyTo($email, $name);
            $mail->addAddress('am@adam-marsh.com');
            $mail->Subject = $subject;
            $mail->msgHTML($message);
            // $mail->SMTPDebug = 2;
            if (!$mail->send()) {
                $error = "Mailer Error: " . $mail->ErrorInfo;
                ?>
                <script>alert('<?php echo $error ?>');</script><?php
            } else {
                echo '<script>alert("Message sent!");</script>';
            }
        }
        ?>
    </body>
</html>

