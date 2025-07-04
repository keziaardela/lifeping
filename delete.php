<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php';
include 'reminder.php';

$database = new Database();
$db = $database->getConnection();

$reminder = new Reminder($db);

$id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan.');
$reminder->id = $id;

if ($reminder->delete()) {
    echo "<script>alert('Reminder berhasil dihapus!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus reminder!'); window.location='index.php';</script>";
}
?>
