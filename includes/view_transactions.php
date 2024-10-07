<?php
include('db.php');

$sql = "SELECT * FROM transactions ORDER BY transaction_date DESC";
$result = $conn->query($sql);
?>

<table>
    <thead>
        <tr>
            <th>วันเดือนปี</th>
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
                echo "<tr>
                        <td>{$row['transaction_date']}</td>
                        <td>{$row['note']}</td>
                        <td>{$row['income']}</td>
                        <td>{$row['expense']}</td>
                        <td>{$row['balance']}</td>
                        <td>
                            <a href='edit_transaction.php?id={$row['id']}'>แก้ไข</a>
                            <a href='delete_transaction.php?id={$row['id']}' onclick='return confirm(\"คุณแน่ใจว่าจะลบรายการนี้?\");'>ลบ</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>ไม่มีข้อมูล</td></tr>";
        }
        ?>
    </tbody>
</table>
