<?php
// AdminMiddleware.php
class AdminMiddleware {
    public function handle() {
        if ($_SESSION['role'] !== 'admin') {
            header('Location: home.php');
            exit();
        }
    }
}
