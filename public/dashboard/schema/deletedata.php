<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$table_name=$_GET['table_name'];
$table_schema=$_GET['table_schema'];
$tableData=$_GET['id'];

if(Tables::DeleteTableData($table_name,$tableData))
{
  header("location:index.php?table_name=".$table_name);
}

?>