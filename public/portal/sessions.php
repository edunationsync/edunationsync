<?php
include '../Module.php';
$student=$_GET['student'];
?>
<select id="txtsession" name="txtsession" required>

<?php
foreach(Module::ReadStudentSessionsp($student) as $session)
{
  echo "<option>".strtoupper($session)."</option>";
}
?>
</select>