<?php 
session_start();
require_once('db-connect.php');

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $invoice_id = $_GET['id'];
    
    // Delete the invoice
    $delete_invoice_query = "DELETE FROM `invoices_tbl` WHERE `id` = $invoice_id";
    $delete_meta_query = "DELETE FROM `invoice_meta_tbl` WHERE `invoice_id` = $invoice_id";
    
    if($conn->query($delete_invoice_query) && $conn->query($delete_meta_query)){
        $_SESSION['flashdata'] = [
            'type' => 'success',
            'msg' => "Invoice has been deleted successfully!"
        ];
    } else {
        $_SESSION['flashdata'] = [
            'type' => 'danger',
            'msg' => "Failed to delete invoice!"
        ];
    }
} else {
    $_SESSION['flashdata'] = [
        'type' => 'danger',
        'msg' => "Invalid invoice ID!"
    ];
}

$conn->close();
header("Location: invoices.php");
exit;
?>
