<?php
include '../Module.php';
$school_details=School::ReadSchoolDetails();
$score=$_GET['score'];


$scoreDetails=Grades::ReadScoreDetails($score);

echo $scoreDetails['grade_symbol'].":".$scoreDetails['grade_unit'].":".$scoreDetails['grade_remark_sub'];
?>