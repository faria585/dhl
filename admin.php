<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// your other code below
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO shipments (tracking_number, sender_name, receiver_name, origin, destination, status, estimated_delivery, shipment_date, history)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss",
        $_POST['tracking_number'],
        $_POST['sender_name'],
        $_POST['receiver_name'],
        $_POST['origin'],
        $_POST['destination'],
        $_POST['status'],
        $_POST['estimated_delivery'],
        $_POST['shipment_date'],
        $_POST['history']
    );
    $stmt->execute();
    echo "<script>alert('Shipment Added'); window.location.href='admin.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel | DHL Clone</title>
    <style>
        body { background: #f2f2f2; font-family: sans-serif; padding: 40px; }
        form {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        input, textarea, select {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background: #d71a28;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form method="post">
        <h2>Add New Shipment</h2>
        <input name="tracking_number" placeholder="Tracking Number" required>
        <input name="sender_name" placeholder="Sender Name">
        <input name="receiver_name" placeholder="Receiver Name">
        <input name="origin" placeholder="Origin">
        <input name="destination" placeholder="Destination">
        <input name="status" placeholder="Status (In Transit, Delivered, etc)">
        <input name="estimated_delivery" type="date">
        <input name="shipment_date" type="date">
        <textarea name="history" placeholder="Shipment History (optional)"></textarea>
        <button type="submit">Add Shipment</button>
    </form>
</body>
</html>
