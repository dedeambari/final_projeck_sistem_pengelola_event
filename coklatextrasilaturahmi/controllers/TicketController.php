<?php
// TicketController.php
include('phpqrcode/qrlib.php');
include('config/email.php');  // Pastikan Anda menyertakan fungsi email yang telah disiapkan

class TicketController {
    public function buyTicket($ticketId, $userEmail, $status_pembayaran) {
        // Misalnya status pembayaran diperbarui melalui webhook atau setelah verifikasi
        if ($status_pembayaran === 'paid') {
            // Generate QR Code berdasarkan data tiket
            $fileName = 'uploads/qrcodes/' . md5($ticketId) . '.png';
            QRcode::png($ticketId, $fileName); // Generate QR code berdasarkan ticket ID

            // Kirim email ke pengguna dengan QR Code
            $this->sendQRCodeEmail($userEmail, $fileName);
        }
    }

    private function sendQRCodeEmail($userEmail, $fileName) {
        $subject = 'Your Ticket QR Code';
        $message = 'Attached is your ticket QR code. Please use it for entry.';
        
        // Kirim email dengan file QR Code sebagai lampiran
        mail($userEmail, $subject, $message, "From: no-reply@yourdomain.com\r\nContent-Type: multipart/mixed; boundary=\"boundary\"\r\n--boundary\r\nContent-Type: text/plain\r\n\r\n" . $message . "\r\n--boundary\r\nContent-Type: image/png; name=\"qrcode.png\"\r\nContent-Disposition: attachment; filename=\"qrcode.png\"\r\nContent-Transfer-Encoding: base64\r\n\r\n" . base64_encode(file_get_contents($fileName)) . "\r\n--boundary--");
    }
}
?>
