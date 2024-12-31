<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti sesuai dengan username database Anda
$password = ""; // Ganti sesuai dengan password database Anda
$database = "db_portofolio"; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

// Gunakan prepared statement untuk mencegah SQL injection
$stmt = $conn->prepare("INSERT INTO contacts (nama, email, pesan) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $pesan);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil disimpan!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.history.back();</script>";
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
