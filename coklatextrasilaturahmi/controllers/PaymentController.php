<?php
// TicketController.php

include('phpqrcode/qrlib.php');  // Menyertakan library QR Code

class TicketController {
    // Fungsi untuk memproses pembayaran dan mengirimkan QR Code
    public function processPayment($status_pembayaran, $ticketId, $userEmail) {
        // Cek jika status pembayaran sudah 'paid'
        if ($status_pembayaran === 'paid') {
            // Generate QR Code berdasarkan data tiket
            $fileName = 'uploads/qrcodes/' . md5($ticketId) . '.png';
            QRcode::png($ticketId, $fileName);  // Generate QR code berdasarkan ticket ID

            // Kirim email ke pengguna dengan QR Code
            $this->sendQRCodeEmail($userEmail, $fileName);
        }
    }

    // Fungsi untuk mengirimkan email dengan QR Code sebagai lampiran
    private function sendQRCodeEmail($to, $filePath) {
        $subject = "Your Event QR Code";
        $message = "Thank you for your payment. Please find your QR code attached for event check-in.";

        $headers = 'From: no-reply@yourdomain.com' . "\r\n" .
                   'Reply-To: no-reply@yourdomain.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();
        
        // Baca QR Code yang dihasilkan
        $fileData = file_get_contents($filePath);
        $fileName = basename($filePath);
        $fileType = mime_content_type($filePath);

        // Encode file data untuk attachment
        $encodedFile = chunk_split(base64_encode($fileData));

        // Buat header tambahan untuk attachment
        $boundary = md5(time());
        $headers .= "\r\nMIME-Version: 1.0\r\n" .
                    "Content-Type: multipart/mixed; boundary=\"$boundary\"";

        $emailBody = "--$boundary\r\n" .
                     "Content-Type: text/plain; charset=ISO-8859-1\r\n" .
                     "Content-Transfer-Encoding: 7bit\r\n\r\n" .
                     $message . "\r\n\r\n" .
                     "--$boundary\r\n" .
                     "Content-Type: $fileType; name=\"$fileName\"\r\n" .
                     "Content-Transfer-Encoding: base64\r\n" .
                     "Content-Disposition: attachment; filename=\"$fileName\"\r\n\r\n" .
                     $encodedFile . "\r\n\r\n" .
                     "--$boundary--";

        // Kirim email
        mail($to, $subject, $emailBody, $headers);
    }
}
