<?php
include_once 'config/connection.php';



$select = $connectionPDO->query("SELECT activity FROM cnae");
while($row = $select->fetchAll(PDO::FETCH_ASSOC)) {
    $response[] = array("value" => $row['activity'], "label" => $row['activity']);
}
echo json_encode($response);


