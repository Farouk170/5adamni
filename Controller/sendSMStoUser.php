<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

function sendMessage($recipient, $sender, $name, $code, $date) {
    $sid = "YOUR_SID";
    $token = "YOUR_TOKEN";

    // Ensure the recipient number includes the +216 country code
    if (substr($recipient, 0, 1) !== '+') {
        $recipient = '+216' . $recipient;
    } elseif (substr($recipient, 0, 4) !== '+216') {
        $recipient = '+216' . substr($recipient, 1);
    }

    $client = new Client($sid, $token);

    try {
        $message = $client->messages->create(
            $recipient, // to
            [
                'from' => $sender,
                'body' => "Bienvenue Mr.$name,\n" .
                "Vous avez essayé de réinitialiser le mot de passe de votre compte 5adamni, le $date.\n" .
                "Pour pouvoir réinitialiser votre mot de passe, veuillez utiliser ce code: $code\n"
            ]
        );

        if ($message->sid) {
            echo '<script>alert("Message sent!");</script>';
        } else {
            echo '<script>alert("Message not sent!");</script>';
        }
    } catch (Exception $e) {
        // Check for specific Twilio error codes related to unverified numbers
        if (strpos($e->getMessage(), 'unverified') !== false) {
            echo '<script>alert("Error: The number ' . $recipient . ' is unverified. Trial accounts cannot send messages to unverified numbers; verify the number at twilio.com/user/account/phone-numbers/verified, or purchase a Twilio number to send messages to unverified numbers.");</script>';
        } else {
            echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
        }
    }
}
?>
