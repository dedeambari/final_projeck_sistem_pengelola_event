<?php
// EmailNotification.php
class EmailNotification {
    public static function send($to, $subject, $message) {
        mail($to, $subject, $message);
    }
}
