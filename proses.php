<?php
// Include file koneksi
include 'submit-form.php'; // Pastikan file ini berisi koneksi database dengan variabel $conn

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pesan = trim($_POST['pesan']);

    // Validasi data
    if (!empty($nama) && !empty($email) && !empty($pesan)) {
        // Validasi format email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Persiapkan statement untuk mencegah SQL Injection
            $stmt = $conn->prepare("INSERT INTO pesan (nama, email, pesan) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param('sss', $nama, $email, $pesan);

                // Eksekusi statement
                if ($stmt->execute()) {
                    echo "Pesan berhasil dikirim!";
                } else {
                    echo "Gagal mengirim pesan: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Gagal mempersiapkan query: " . $conn->error;
            }
        } else {
            echo "Format email tidak valid!";
        }
    } else {
        echo "Mohon isi semua data!";
    }
} else {
    echo "Metode request tidak valid!";
}

// Tutup koneksi
$conn->close();
?>
