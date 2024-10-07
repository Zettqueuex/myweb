<?php
function calculateTotals($conn) {
    $totalIncome = 0;
    $totalExpense = 0;

    $result = $conn->query("SELECT * FROM transactions");
    while ($row = $result->fetch_assoc()) {
        if ($row['type'] == 'income') {
            $totalIncome += $row['amount'];
        } else {
            $totalExpense += $row['amount'];
        }
    }

    $balance = $totalIncome - $totalExpense;
    return [$totalIncome, $totalExpense, $balance];
}
?>
