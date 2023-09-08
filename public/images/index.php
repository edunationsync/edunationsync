<?php
include '../Module.php';

				$filesss=School::ReadSlideGraphics("slideimages/");

foreach($filesss as $Dir)
{
	$count+=1;
	echo $count. ": ";
	echo $Dir;

	?>

	<img src="<?php echo 'slideimages/'.$Dir ?>"><br/><br/><br/>

	<?php	
}

?>