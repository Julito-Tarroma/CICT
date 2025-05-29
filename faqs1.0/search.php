<?php
include "connection.php";

if (isset($_GET['query'])) {
    $search = $_GET['query'];
    $sql = "SELECT * FROM faqs WHERE question LIKE '%$search%' OR answer LIKE '%$search%'";
    $result = $conn->query($sql);

    $faqs = [];
    while ($row = $result->fetch_assoc()) {
        $faqs[] = $row;
    }

    echo json_encode($faqs);
}
?>
