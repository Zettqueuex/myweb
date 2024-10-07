<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM transactions WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_date = $_POST['transaction_date'];
    $note = $_POST['note'];
    $income = $_POST['income'] ?: 0; // หากไม่ระบุให้เป็น 0
    $expense = $_POST['expense'] ?: 0; // หากไม่ระบุให้เป็น 0

    $sql = "UPDATE transactions SET transaction_date = '$transaction_date', note = '$note', income = $income, expense = $expense WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: ../index.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- เพิ่มการตอบสนอง -->
    <title>แก้ไขรายการ</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>แก้ไขรายการ</h1>
        <form action="" method="POST">
            <input type="date" name="transaction_date" value="<?php echo $row['transaction_date']; ?>" required>
            <input type="text" name="note" value="<?php echo $row['note']; ?>" required>
            <input type="number" name="income" value="<?php echo $row['income']; ?>" placeholder="รายรับ" step="0.01">
            <input type="number" name="expense" value="<?php echo $row['expense']; ?>" placeholder="รายจ่าย" step="0.01">
            <button type="submit">บันทึก</button>
        </form>
    </div>

    <style>
        /* เพิ่มสไตล์ CSS ที่จะทำให้ฟอร์มดูเหมือนหน้า index */
        body {
            font-family: 'Kanit', sans-serif; /* ใช้ฟอนต์ที่ต้องการ */
            background-color: #f4f4f4; /* สีพื้นหลัง */
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px; /* ขนาดสูงสุดของฟอร์ม */
            margin: auto;
            background: white; /* สีพื้นหลังของฟอร์ม */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column; /* จัดแนวฟอร์มในแนวตั้ง */
        }

        input {
            margin-bottom: 15px; /* ระยะห่างระหว่าง input */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #3085d6; /* สีปุ่ม */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #267bbd; /* สีเมื่อ hover ปุ่ม */
        }

        @media (max-width: 600px) {
            .container {
                width: 90%; /* ปรับขนาดฟอร์มให้เต็มความกว้างของหน้าจอ */
            }
        }
    </style>
</body>
</html>

<?php
$conn->close();
?>
