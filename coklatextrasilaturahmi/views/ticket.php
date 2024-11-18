<?php
// payment.php
include('phpqrcode/qrlib.php');  // Menyertakan library QR Code
include('TicketController.php');  // Mengimpor controller jika diperlukan

// Simulasi status pembayaran
$status_pembayaran = 'paid';
$ticketId = 'ticket123';
$userEmail = 'user@example.com';

// Inisialisasi controller dan kirimkan QR Code jika sudah dibayar
$ticketController = new TicketController();
$ticketController->processPayment($status_pembayaran, $ticketId, $userEmail);
