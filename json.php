<?php
require_once('db.php');
$db = new MyDB();

$result = $db->query('SELECT suburb, postcode, state FROM data');

$data = array();

while ($row = $result->fetchArray())
{
  $data[] = array('suburb' => $row['suburb'], 'postcode' => $row['postcode'], 'state' => $row['state']);
}
echo json_encode($data);
?>
