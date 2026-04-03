<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Sends a verification email to a new user.
 * * @param string $toEmail The recipient's email address
 * @param string $token The unique verification token
 * @return bool True if sent, false otherwise
 */
function sendVerificationEmail($toEmail, $token) {
    $mail = new PHPMailer(true);

    try {
        // --- Server Settings ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        // Hardcoded as per your request, though usually loaded via $_ENV
        $mail->Username   = 'info.cafe.pau@gmail.com'; 
        $mail->Password   = 'zeif oaku hcnx judn'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        // --- Recipients ---
        $mail->setFrom('info.cafe.pau@gmail.com', 'Info-Café Pau');
        $mail->addAddress($toEmail);

        // --- Content ---
        $mail->isHTML(true);
        $mail->Subject = 'Confirmez votre inscription - Info-Café';
        
        // Dynamic link to your index.php verification route
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $verifyUrl = $protocol . "://" . $host . "/index.php?page=verify&token=" . $token;

        $mail->Body = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <h2 style='color: #2563eb;'>Bienvenue chez Info-Café !</h2>
                <p>Merci de vous être inscrit. Pour activer votre compte et accéder à nos services, merci de cliquer sur le bouton ci-dessous :</p>
                <div style='margin: 30px 0;'>
                    <a href='{$verifyUrl}' style='background-color: #2563eb; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;'>
                        Vérifier mon compte
                    </a>
                </div>
                <p>Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :</p>
                <p><a href='{$verifyUrl}'>{$verifyUrl}</a></p>
                <hr style='border: 0; border-top: 1px solid #eee; margin-top: 30px;'>
                <p style='font-size: 12px; color: #888;'>Ceci est un message automatique, merci de ne pas y répondre.</p>
            </div>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // In production, log $mail->ErrorInfo
        return false;
    }
}