<?php 
include '../Module.php';
$school_details=School::ReadSchoolDetails();

$reg_no=$_GET['reg_no'];
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['class'];


if(Module::DeleteAnalysisResultp($reg_no,$session,$term,$class)){
	echo "removed";
}
else{
	echo "not removed";
}

$totalstudentsubject=Module::CountStudentSubjectsp($reg_no,$class,$session,$term);

$ca1=Analysis::ExtractCA1Summary($reg_no,$class,$session,$term);
$ca2=Analysis::ExtractCA2Summary($reg_no,$class,$session,$term);
$ca3=Analysis::ExtractCA3Summary($reg_no,$class,$session,$term);
$exam=Analysis::ExtractExamSummary($reg_no,$class,$session,$term);
$overall=Analysis::ExtractOverallSummary($reg_no,$class,$session,$term);
    
if(Analysis::SaveAnalysisp($reg_no,$class,$session,$term,$ca1['total'],$ca1['average'],$ca1['grade'],$ca1['remark'],$ca2['total'],$ca2['average'],$ca2['grade'],$ca2['remark'],$ca3['total'],$ca3['average'],$ca3['grade'],$ca3['remark'],$exam['total'],$exam['average'],$exam['grade'],$exam['remark'],$overall['total'],$overall['average'],$overall['grade'],$overall['remark'],$totalstudentsubject)){

	echo $totalstudentsubject. " | ".$reg_no." Successful";
}
else{	
	echo $reg_no." Update Failed";
}
?>