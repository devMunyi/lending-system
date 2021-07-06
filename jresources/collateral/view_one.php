<?php
session_start();
include_once("../../php_functions/functions.php");
include_once("../../configs/conn.inc");

$col_id = $_POST['col_id'];

echo "<table class='table table-bordered'>";
if ($col_id > 0) {
    $t = fetchonerow('o_collateral', "uid=" . decurl($col_id), "*");
    $customer_id = $t['customer_id'];
    $category = $t['category'];
    $category_name = fetchrow('o_asset_categories', "uid='$category'", "name");
    $title = $t['title'];
    $description = $t['description'];
    $money_value = $t['money_value'];
    $document_scan_address = $t['document_scan_address'];
    $doc_reference_no = $t['doc_reference_no'];
    $filling_reference_no = $t['filling_reference_no'];
    $added_date = $t['added_date'];
    // $added_by = $t['added_by'];

    echo "<tr><td>Title</td><td class='font-bold'>$title</td></tr>";
    echo "<tr><td>Description</td><td class='font-bold'>$description</td></tr>";
    echo "<tr><td>Category</td><td class='font-bold'>$category_name</td></tr>";
    echo "<tr><td>Money Value</td><td class='font-bold'>" . money($money_value) . "</td></tr>";
    echo "<tr><td>Digital File Number</td><td class='font-bold'>$document_scan_address</td></tr>";
    echo "<tr><td>Document Ref Number</td><td class='font-bold'>$doc_reference_no</td></tr>";
    echo "<tr><td>Filling Reference Number</td><td class='font-bold'>$filling_reference_no</td></tr>";
    echo "<tr><td>Added Date</td><td class='font-bold'>$added_date</td></tr>";
    //echo "<tr><td>Added Date</td><td class='font-bold'>$added_date</td></tr>";


} else {
    die(errormes("Referee invalid"));
    exit();
}
echo "</table>";