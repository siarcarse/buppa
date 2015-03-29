<?php

include '../../libs/db.class.php';
$db = NEW DB();

$sql = "SELECT users.id, (employee.name || ' ' || employee.lastname) AS name, employee.rut FROM users LEFT JOIN employee ON employee.id=users.employee WHERE role=6 AND employee.name IS NOT NULL";
$data = $db->doSql($sql);
do {
    $doctors['data'][] = array($data['id'], $data['name'], $data['rut'], $data['id']);
} while ($data = pg_fetch_assoc($db->actualResults));
echo json_encode($doctors);
?>