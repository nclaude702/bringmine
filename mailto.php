<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Autoload PHPMailer classes

// After updating the record and confirming "Found" status
$stmt = mysqli_prepare($con, "SELECT * FROM `lostfound` WHERE `propert_number` = ?");
mysqli_stmt_bind_param($stmt, "s", $propert_number);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Fetch the record
    $record = mysqli_fetch_assoc($result);
    $lost_found_status = $record['lost_found_status'];

    if ($lost_found_status === "Found") {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ndaclaude701@gmail.com'; // Replace with your email
            $mail->Password   = 'Claude12@'; // Use environment variables for better security
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('ndaclaude701@gmail.com', 'Lost and Found');
            $mail->addAddress($record['nclaude701@gmail.com']); // Replace `lost_email` with the correct column for recipient email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Lost Property Found!';
            $mail->Body    = "
                <p>Dear {$record['lost_names']},</p>
                <p>We are pleased to inform you that your lost property has been found:</p>
                <ul>
                    <li><strong>Property Name:</strong> {$record['lost_property_name']}</li>
                    <li><strong>Property Number:</strong> {$record['propert_number']}</li>
                </ul>
                <p>Thank you for using our Lost and Found service.</p>
                <p>Best regards,</p>
                <p>The Lost and Found Team</p>
            ";

            $mail->AltBody = "Dear {$record['lost_names']}, Your lost property ({$record['lost_property_name']}) with number {$record['propert_number']} has been found. Thank you for using our Lost and Found service.";

            $mail->send();
            echo "<script>alert('Notification sent successfully!'); window.location='../lost.php';</script>";
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            echo "<script>alert('Failed to send notification email. Please try again later.'); window.location='../lost.php';</script>";
        }
    }
}
?>

