<?php
require "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
 header("Location: form_mahasiswa.php");
 exit;
}
$nim = trim($_POST["nim"] ?? "");
$nama = trim($_POST["nama"] ?? "");
$program_studi = trim($_POST["program_studi"] ?? "");
$email = trim($_POST["email"] ?? "");
if (
 $nim === "" ||
 $nama === "" ||
 $program_studi === "" ||
 $email === ""
) {
 die("Semua field wajib diisi.");
}
$stmt = $conn->prepare(
 "INSERT INTO mahasiswa
 (nim, nama, program_studi, email)
 VALUES (?, ?, ?, ?)"
);
$stmt->bind_param(
 "ssss",
 $nim,
 $nama,
 $program_studi,
 $email
);
$stmt->execute();
$stmt->close();
$conn->close();
header("Location: data_mahasiswa.php?status=sukses");
exit;
?>
