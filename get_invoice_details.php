<?php
require_once('db-connect.php');

if(isset($_GET['invoice_id'])) {
    $invoice_id = $_GET['invoice_id'];

    // Fetch invoice details
    $invoiceQuery = "SELECT * FROM invoices_tbl WHERE id = ?";
    $stmt = $conn->prepare($invoiceQuery);
    $stmt->bind_param('i', $invoice_id);
    $stmt->execute();
    $invoiceResult = $stmt->get_result()->fetch_assoc();

    // Fetch invoice items
    $itemsQuery = "SELECT * FROM invoice_meta_tbl WHERE invoice_id = ?";
    $stmt = $conn->prepare($itemsQuery);
    $stmt->bind_param('i', $invoice_id);
    $stmt->execute();
    $itemsResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Combine the invoice and items data
    $invoiceDetails = $invoiceResult;
    $invoiceDetails['items'] = $itemsResult;

    // Return as JSON
    echo json_encode($invoiceDetails);
}
?>
