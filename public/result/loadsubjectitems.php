<?php session_start();
include '../Module.php';
$school_details=School::ReadSchoolDetails();
$classs=$_GET['classs'];

$clss=substr($classs, 0,9);
$subjects=array();
$Sessions=Module::ReadCurrentSession();
$session=$Sessions['session'];
$term=$Sessions['term'];
$staff=$_SESSION['userid'];
foreach(Module::ReadClassSubjectsp($classs) as $subject)
{
	if(strtolower($_SESSION['user_type'])==strtolower("Admin"))
	{
		echo "<option> $subject</option>";
	}
	elseif(Module::IsClassAllocatedToStaffp($staff,$classs,$session,$term))
	{
		echo "<option> $subject</option>";
	}
	elseif(Module::IsSubjectAllocatedToStaffp($staff,$classs,$session,$term,$subject))
	{
		echo "<option> $subject</option>";
	}

	
}
?> 

<?php
/*
			if($_SESSION['user_type']=="Admin"||$_SESSION['user_type']=="admin")
			{
				foreach(Module::ReadClassSubjectsp($classs) as $subject)
				{
					?>
					<option title="<?php echo strtoupper($subject); ?>"><?php echo strtoupper($subject); ?></option>
					<?php
				}
			}
			elseif(Module::IsClassAllocatedToStaffp($staff,$classs,$session,$term))
			{
				foreach(Module::ReadClassSubjectsp($classs) as $subject)
				{
					?>
					<option title="<?php echo strtoupper($subject); ?>"><?php echo strtoupper($subject); ?></option>
					<?php
				}
			}
			else
			{
				if(Module::IsSubjectAllocatedToStaffp($staff,$class,$session,$term))
				{
					foreach(Module::ReadClassSubjectsp($classs) as $subject)
					{
						?>
						<option title="<?php echo strtoupper($subject); ?>"><?php echo strtoupper($subject); ?></option>
						<?php
					}
				}

			}	 */		
	       ?>  