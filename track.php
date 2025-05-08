<?php
include 'db.php';

// Get tracking number from the URL
$tracking = $_GET['track'] ?? ''; // If not set, it will be empty

// Prepare the SQL query to find the shipment
$sql = "SELECT * FROM shipments WHERE tracking_number = ?";
$stmt = $conn->prepare($sql);

// Bind the tracking number to the query
$stmt->bind_param("s", $tracking);
$stmt->execute();
$result = $stmt->get_result();

// Check if we have a valid result
$shipment = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Shipment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }
        .box {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #d71a28;
        }
        .status {
            font-size: 20px;
            color: #555;
        }
        .error {
            text-align: center;
            color: red;
            font-size: 20px;
        }
    </style>
</head>
<body>

    <div class="box">
        <?php if ($shipment): ?>
            <h2>Tracking Number: <?= htmlspecialchars($shipment['tracking_number']) ?></h2>
            <p><strong>Status:</strong> <?= htmlspecialchars($shipment['status']) ?></p>
            <p><strong>Sender:</strong> <?= htmlspecialchars($shipment['sender_name']) ?></p>
            <p><strong>Receiver:</strong> <?= htmlspecialchars($shipment['receiver_name']) ?></p>
            <p><strong>From:</strong> <?= htmlspecialchars($shipment['origin']) ?></p>
            <p><strong>To:</strong> <?= htmlspecialchars($shipment['destination']) ?></p>
            <p><strong>Estimated Delivery:</strong> <?= htmlspecialchars($shipment['estimated_delivery']) ?></p>
            <p><strong>Shipment Date:</strong> <?= htmlspecialchars($shipment['shipment_date']) ?></p>
            <p><strong>History:</strong> <br><?= nl2br(htmlspecialchars($shipment['history'])) ?></p>
        <?php else: ?>
            <div class="error">No shipment found for this tracking number.</div>
        <?php endif; ?>
    </div>

</body>
</html>
