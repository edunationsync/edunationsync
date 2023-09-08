<?php 
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
 ?>
<!DOCTYPE html>
<html>

<?php
$scards=Module::ReadAllScratchCards();
?>
<head>
	<title>Scratch Card Explorer</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>

	<?php
	foreach($scards as $id)
	{
		$scardDetails=Module::ReadCardDetails($id);
		$status=strtolower($scardDetails['status']);
		
		if(!($status=="used"))
		{
			?>
			<div class="card" style="width:400px; float: left; margin: 10px 10px 10px 10px;">
			  <img class="card-img-top" src="images/scard_design.jpg" alt="Card image">
			  <div class="card-img-overlay" style="margin-top: 60px">
			    <h4 class="card-title" style="font-size: 15px; font-weight: bolder">PIN:  <?php echo $scardDetails['pin']; ?> </h4>
			    <p class="card-text" style="font-size: 15px; font-weight: bolder">SERIAL: <?php echo $scardDetails['serial']; ?></p>
			  </div>
			</div>
			<?php			
		}
	}
	?>

	

</body>
</html>