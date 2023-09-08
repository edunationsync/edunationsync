<?php session_start();

include '../Module.php';
$school_details=School::ReadSchoolDetails();
$staff=$_SESSION['userid'];
$classs=$_GET['classs'];
$Sessions=Module::ReadCurrentSession();
$session=$Sessions['session'];
$term=$Sessions['term'];

?>
	<div class="form-label-group">
	    <select name="txtsubjectp" id="txtsubjectp" class="form-control" placeholder="Session" required="required">
	      <?php

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

			}			
	       ?>               
	    </select>
	</div>
