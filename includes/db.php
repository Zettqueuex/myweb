<?php
$servername = "localhost";
// เปลี่ยน 'your_username' และ 'your_password' เป็นข้อมูลจริง
$username = "root"; // หรือชื่อผู้ใช้ที่คุณใช้
$password = ""; // โดยทั่วไปสำหรับ XAMPP รหัสผ่านจะว่างเปล่า
$dbname = "phakaphop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
