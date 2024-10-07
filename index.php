<?php
include 'includes/db.php';

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM transactions ORDER BY transaction_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการรายรับรายจ่าย</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h1>ระบบจัดการรายรับรายจ่าย</h1>
        
        <form action="includes/add_transaction.php" method="POST">
            <input type="date" name="transaction_date" required>
            <input type="text" name="note" placeholder="หมายเหตุ" required>
            <input type="number" name="income" placeholder="รายรับ" step="0.01" min="0">
            <input type="number" name="expense" placeholder="รายจ่าย" step="0.01" min="0">
            <button type="submit">บันทึก</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>วันที่</th>
                    <th>หมายเหตุ</th>
                    <th>รายรับ</th>
                    <th>รายจ่าย</th>
                    <th>ยอดคงเหลือ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $balance = $row['income'] - $row['expense'];
                        echo "<tr>
                                <td>{$row['transaction_date']}</td>
                                <td>{$row['note']}</td>
                                <td>{$row['income']}</td>
                                <td>{$row['expense']}</td>
                                <td>$balance</td>
                                <td>
                                    <a href='includes/edit_transaction.php?id={$row['id']}'>แก้ไข</a>
                                    <button class='delete-button' data-id='{$row['id']}'>ลบ</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>ไม่มีข้อมูล</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ทำการลบรายการ
                        window.location.href = 'includes/delete_transaction.php?id=' + itemId;
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
