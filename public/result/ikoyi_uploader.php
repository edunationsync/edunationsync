<?php 
include '../Module.php';
$school_details=School::ReadSchoolDetails();

if(isset($_POST['btnRestore']))
{
	if(is_uploaded_file($_FILES['ikoyi_data']['tmp_name'])){

		echo "<br/>New File Uploaded<br/>";
		$filename=$_FILES['ikoyi_data']['tmp_name'];
		$fil=file_get_contents($_FILES['ikoyi_data']['tmp_name']);

		$file=fopen("pstudents.txt", 'w');
		fwrite($file, $fil);
		fclose($file);

	}
	else
	{
		echo "Backup File not selected";
	}
}
?>

<br/>
<a href="?status=old">Restore Previous Backup</a>
<form method="POST" action="?status=upload" enctype="multipart/form-data">
	<h4>Upload Ikoyi Result File</h4>
	<input type="text" name="Class" placeholder="Class">
	<input type="text" name="Session" placeholder="Session">
	<input type="text" name="Term" placeholder="Term">
	<input type="text" name="NextBegins" placeholder="Next Term Begins">
	<input type="file" name="ikoyi_data" id="ikoyi_data">
	<input type="submit" name="btnRestore" id="btnRestore" value="Restore Data">
</form>


<?php 
$headings="";
$body="";

//Extract Headings and Body
if($_GET['status']=='old' ||$_GET['status']=='upload')
{
	$lines=explode('NextBegins', $fil);

	foreach($lines as $line)
	{
		$headings=$lines[0];
		$body=$lines[1];
	}
}

//Extract Subjects from the table

//Seperate Preliminaries from Subject Catigories
$headingData=explode("ATTENDANCE", $headings);
$headingData=explode("AFFECTIVE", $headingData[1]);

$headingData=explode(',',$headingData[0]);

$subCount=1;
//$headingData[0];
//echo count($headingData);
$ExtractedSubjects=array();
foreach($headingData as $heading_data)
{
	if(strlen($headingData[$subCount])>3)
	{
		array_push($ExtractedSubjects, $headingData[$subCount]);
	}
	
	$subCount+=9;
}



/**Score Extraction complete and waiting for linkage with subjects*/
$next_term_begins=$_POST['NextBegins'];
$session=$_POST['Session'];

//Split Students Seperately
$resultInfos=explode($next_term_begins, $body);
foreach($resultInfos as $resultInfo)
{
	//Seperate Result Details from Result Scores
	$resultDetails=explode($session, $resultInfo);
	$resultDetails[1]=substr($resultDetails[1], 4);

	//Extract result Details into arrays
	$resultData=explode(",", $resultDetails[0]);
	$student=$resultData[0];

	//Extract resultScores into arrays
	$resultScores=str_replace(",,,,,,,,,,,", ",,", $resultDetails[1]);

	//echo $resultDetails[1]."<hr/>".$resultScores;
	//$resultScores=explode(",,,,,,,,,,,", $resultDetails[1]);
	
	//echo $student;

	//Seperate the Scores into subjects
	$subjectScores=explode(",,",$resultScores);
	$subcountt=0;
	foreach($subjectScores as $subjectscore)
	{
		//echo $ExtractedSubjects[$subcountt];

		$scores=explode(",", $subjectscore);
		
		$scoreData['student']=$student;
		$scoreData['subject']=$ExtractedSubjects[$subcountt];
		$scoreData['ca1']=$scores[0];
		$scoreData['ca2']=$scores[1];
		$scoreData['ca3']=$scores[2];
		$scoreData['exam']=$scores[3];

		echo Module::IdentifyStudent($scoreData['student'])['reg_no'];

		echo "Student: ".$scoreData['student']."______";
		echo "Subject: ".$scoreData['subject']."______";
		echo "CA1: ".$scoreData['ca1']."______";
		echo "CA2: ".$scoreData['ca2']."______";
		echo "CA3: ".$scoreData['ca3']."______";
		echo "EXAM: ".$scoreData['exam']."<br/>";
		$subcountt++;
	}	

	echo "<hr/>";
}

?>