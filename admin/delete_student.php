<?php
include "header.php";
include('../db_connection.php');
$db = new DB_FUNCTIONS();
$id = $_GET["id"];
$delete_student = $db ->delete_student($id);
$db ->redirect_to("student.php");
?>