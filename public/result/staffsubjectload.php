<?php
include '../Module.php';
$school_details=School::ReadSchoolDetails();
$staff=$_GET['staff'];
$session=$_GET['session'];
$term=$_GET['term'];
$classs=$_GET['classs'];

?>

<label for="txtclass">Subjects</label><br/>
<select name="txtsubject" id="txtsubject" required>

<?php
foreach(Module::ReadStaffAllocationSubjectsByClass($staff,$session,$term,$classs) as $subject)
{
  echo "<option>".strtoupper($subject)."</option>";
}
?>
</select>