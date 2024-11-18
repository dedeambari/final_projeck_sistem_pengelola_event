<?php
// logging.php
function logMessage($message) {
    $logFile = 'app.log';
    file_put_contents($logFile, date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL, FILE_APPEND);
}
