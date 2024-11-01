<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['total_bill'])) {
    $_SESSION['total_bill'] = (float) $_POST['total_bill']; // Save total in session
    echo "Total saved";
} else {
    echo "Failed to save total";
}
?>