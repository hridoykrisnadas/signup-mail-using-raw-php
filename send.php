<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\EXCEPTION;

    require 'phpMailer/src/Exception.php';
    require 'phpMailer/src/PHPMailer.php';
    require 'phpMailer/src/SMTP.php';

    if(isset($_POST["send"])){

        $name = $_POST['name'];
        $mobile_no = $_POST['mobile_no'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // $path = __DIR__ . 'upload/' . $_FILES['resume']['name'];
        // move_uploaded_file($_FILES['resume']['tmp_name'], $path);

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = ' ';
        $mail->SMTPAuth = true;
        $mail->Username = ' ';
        $mail->Password = ' ';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom(' ', 'Krisna');

        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->WordWrap = 50;

        $mail->Subject = $subject;

        $customBody = '
        <html>
            <head>
                <title>Custom Email</title>
            </head>
            <body>
                <h1>Hello,</h1>
                <p>This is a custom email body.</p>
                <p>You can include HTML content, images, links, and more.</p>
                <p>Best Regards</p>
                </br>
                <p>{{name}}</p>
                <p>{{mobile_no}}</p>
            </body>
        </html>';

        $customBody = str_replace('{{name}}', $name, $customBody);
        $customBody = str_replace('{{mobile_no}}', $mobile_no, $customBody);


        $message = $_POST['message'] . "\n\nBest Regards\n" . $_POST['name'] . "\n" . $_POST['mobile_no'];
        $mail->Body = $customBody;
        $mail->AddAttachment($_FILES['resume']['tmp_name'], $name . '.pdf');

        
        $mail->send();

        echo "
        <script>
            alert('Sent Successfully');
            window.location = 'home.php';
        </script>
        ";
    }
?>