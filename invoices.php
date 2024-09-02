<?php 
session_start();
require_once('db-connect.php');

// Fetch all invoices from the database
$query = "SELECT * FROM `invoices_tbl`";
$result = $conn->query($query);

if(!$result){
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table, th, td {
            border: none;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #009879;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        tr {
            border-bottom: 1px solid #dddddd;
        }

        tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .delete-btn {
            background-color: #ff4d4d;
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: #ff1a1a;
        }

        /* Popup Modal */
        #popup-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #popup-modal-content {
            background-color: #fff;
            padding: 20px;
            position: relative;
            border-radius: 8px;
            max-width: 90%;
            max-height: 90%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            overflow: auto;
        }

        #close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.3s;
        }

        #close-modal:hover {
            color: #000;
        }

        #invoice-image {
            max-width: 100%;
            max-height: 80vh;
        }
    </style>
</head>
<body>
    <h1>Invoices</h1>
    <table>
        <thead>
            <tr>
                <th>Invoice Code</th>
                <th>Customer</th>
                <th>Cashier</th>
                <th>Total Amount</th>
                <th>Discount Percentage</th>
                <th>Discount Amount</th>
                <th>Tendered Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr class="invoice-row" data-invoice-id="<?php echo $row['id']; ?>">
                    <td><?php echo $row['invoice_code']; ?></td>
                    <td><?php echo $row['customer']; ?></td>
                    <td><?php echo $row['cashier']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>
                    <td><?php echo $row['discount_percentage']; ?></td>
                    <td><?php echo $row['discount_amount']; ?></td>
                    <td><?php echo $row['tendered_amount']; ?></td>
                    <td>
                        <button class="delete-btn" data-invoice-id="<?php echo $row['id']; ?>">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Popup Modal -->
    <div id="popup-modal">
        <div id="popup-modal-content">
            <span id="close-modal">&times;</span>
            <img id="invoice-image" src="" alt="Invoice Image">
        </div>
    </div>

    <script>
        // JavaScript to handle row click and show popup
        document.querySelectorAll('.invoice-row').forEach(row => {
            row.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-btn')) return; // Skip if delete button is clicked
                
                var invoiceId = this.getAttribute('data-invoice-id');
                // Fetch invoice image via AJAX or set directly if path is known
                var invoiceImageSrc = 'path/to/invoice/images/' + invoiceId + '.jpg'; // Adjust path as necessary
                document.getElementById('invoice-image').src = invoiceImageSrc;
                document.getElementById('popup-modal').style.display = 'flex';
            });
        });

        // JavaScript to handle delete button click
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent triggering the row click event
                var invoiceId = this.getAttribute('data-invoice-id');
                
                if (confirm("Are you sure you want to delete this invoice?")) {
                    window.location.href = 'delete-invoice.php?id=' + invoiceId;
                }
            });
        });

        // Close modal when close button is clicked
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('popup-modal').style.display = 'none';
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
