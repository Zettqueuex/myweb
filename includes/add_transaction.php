<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_date = $_POST['transaction_date'];
    $note = $_POST['note'];
    $income = $_POST['income'] ?: 0; // หากไม่ระบุให้เป็น 0
    $expense = $_POST['expense'] ?: 0; // หากไม่ระบุให้เป็น 0

    $sql = "INSERT INTO transactions (transaction_date, note, income, expense) VALUES ('$transaction_date', '$note', $income, $expense)";
    if ($conn->query($sql) === TRUE) {
        header('Location: ../index.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
