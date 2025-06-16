<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP default
$dbname = "customer_orders_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f4f4;
            font-size: 46px; /* Updated font size for body items */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            color: #063775;
            font-size: 46px;
            text-transform: uppercase;
            margin: 0;
        }
        .header img {
            height: 100px; /* Adjust logo size */
            width: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #063775;
            color: white;
            font-size: 46px;
        }
        th.qty-header {
            width: 100px;
        }
        tr:hover {background-color: #f1f1f1;}
        .status {
            padding: 6px 12px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            display: inline-block;
        }
        .status-shipped { background-color: green; }
        .status-processing { background-color: orange; }
        .status-complete { background-color: blue; }
        .status-cancelled { background-color: red; }

        .buttons {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            font-size: 36px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            background-color: #063775;
            color: white;
            transition: background-color 0.3s;
        }
        .buttons button:hover {
            background-color: #0450a1;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>CUSTOMER ORDERS</h1>
        <img src="https://machinery.lk/wp-content/uploads/2024/11/URH-Main-Logo.png" alt="Logo">
    </div>

    <table>
        <thead>
            <tr>
                <th>CS ID</th>
                <th class="qty-header">Qty</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['cs_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['qty']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td><span class='status ";

                // Apply correct color class
                if (strtolower($row['status']) == 'shipped') {
                    echo "status-shipped";
                } elseif (strtolower($row['status']) == 'processing') {
                    echo "status-processing";
                } elseif (strtolower($row['status']) == 'complete') {
                    echo "status-complete";
                } elseif (strtolower($row['status']) == 'cancelled') {
                    echo "status-cancelled";
                }

                echo "'>" . htmlspecialchars($row['status']) . "</span></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }

        $conn->close(); // close db connection
        ?>
        </tbody>
    </table>

    <div class="buttons">
        <button onclick="location.reload()">Refresh</button>
        <button onclick="alert('Next page function coming soon!')">Next Page</button>
    </div>

</body>
</html>
