<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>DHL | Track Your Shipment</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #d71a28, #f5f5f5);
            color: #333;
        }
        .container {
            max-width: 500px;
            margin: 10% auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #d71a28;
            margin-bottom: 30px;
        }
        input {
            width: 80%;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
        }
        button {
            padding: 12px 30px;
            font-size: 16px;
            color: white;
            background-color: #d71a28;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #b3121e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Track Your Shipment</h1>
        <input type="text" id="trackInput" placeholder="Enter Tracking Number">
        <br>
        <button onclick="redirectToTrack()">Track Shipment</button>
    </div>

    <script>
        function redirectToTrack() {
            let trackingNumber = document.getElementById("trackInput").value;
            if (trackingNumber.trim() === "") {
                alert("Please enter a tracking number.");
                return;
            }
            window.location.href = "track.php?track=" + encodeURIComponent(trackingNumber);
        }
    </script>
</body>
</html>
