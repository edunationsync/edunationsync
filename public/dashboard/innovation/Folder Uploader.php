<?php session_start();
include 'Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_NOTICE);



	$category= $_POST['txtCategory'];
	$department= $_POST['txtDept'];
	$title= $_POST['txtTitle'];
	$author= $_POST['txtAuthor'];
	$supervisor= $_POST['txtSupervisor']; 
    $docid= $_POST['txtDocID'];
    $school= $_POST['txtSchool'];   
    $year= $_POST['txtYear'];  
    $publisher= $_POST['txtPublisher'];
    $abstract= $_POST['txtAbstract'];

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js">


<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" name="viewport" />
<link rel="shortcut icon" href="styles/images/nav.png" />
<link rel="apple-touch-icon" href="styles/images/school/logo.png" />
<meta name="Generator" content="Global Shining Technology 5.5" />
<link type="text/css" rel="stylesheet" media="screen" href="styles/css/reset.css" />
<link type="text/css" rel="stylesheet" media="screen" href="styles/css/base.css" />
<link type="text/css" rel="stylesheet" media="screen" href="styles/css/helper.css" />
<link type="text/css" rel="stylesheet" media="screen" href="styles/css/jquery-ui-1.8.15.custom.css" />
<link type="text/css" rel="stylesheet" media="screen" href="styles/css/style.css" />
<link type="text/css" rel="stylesheet" media="screen" href="styles/css/authority-control.css" />
<link type="text/css" rel="stylesheet" media="handheld" href="styles/css/handheld.css" />
<link type="text/css" rel="stylesheet" media="print" href="styles/css/print.css" />
<link type="text/css" rel="stylesheet" media="all" href="styles/css/media.css" />
<link type="application/opensearchdescription+xml" rel="search" href="style/xml/description.xml" title="Global Shining Technology" />

<script  type="text/javascript" src="styles/js/modernizr-1.7.min.js"> </script>
<title>KSCOEA Repository Home</title>
</head> <body >
<div  id="ds-main">
<div id="ds-header-wrapper">
<div class="clearfix" id="ds-header">
<a id="ds-header-logo-link" href="index.php">
<span id="ds-header-logo"> </span>
<span id="ds-header-logo-text">Institutional Repository<br/></span>
</a>
<h1  class="pagetitle visuallyhidden title">Document Upload Widget for <?php echo $_SESSION['school'];  ?></h1>
<div  id="ds-user-box">

</div>
</div>
</div>
<div  id="ds-trail-wrapper">
<ul id="ds-trail">
<p class="titleBox">Document Upload Widget for the school of <?php echo $_SESSION['school'];  ?></p>
</ul>
</div>
<div  class="hidden" id="no-js-warning-wrapper">
<div id="no-js-warning">
<div class="notice failure">JavaScript is disabled for your browser. Some features of this site may not work without it.</div>
</div>
</div>

<div id="ds-content-wrapper">
<div class="clearfix" id="ds-content">

<div id="ds-body">
<div id="file_news_div_news" class="ds-static-div primary">
<p class="ds-paragraph">
Upload materials such as  research projects, seminars, articles, books and many other digital assets for preervation and publication for the access of the general public.
</p>
</div>

<div  id="aspect_artifactbrowser_CommunityBrowser_div_comunity-browser" class="ds-static-div primary">
<?php
if(isset($_POST['btnUpload']))
{
 
    $ID=Document::GenerateId($category,$author,$department,$title);

	$path = "materials/";
    $path = $path . $ID.".pdf";
    if(move_uploaded_file($_FILES['txtFile']['tmp_name'], $path)) 
    {      
      $file_name=$path;

      if(Document::IsDocument($file_name))
      {
        $msg="Document Already Uploaded, if you want to re-upload it, remove the existing one first.";
      }
      else
      {
        Document::SaveDetails($file_name,$title,$author,$supervisor,$category,$department,$school,$year,$publisher,$abstract);
        $msg="Document was Uploaded Successfully";
      }
    } 
    else
    {
        $msg="Document Upload was not successful, Try again";
    }
?>
<h1 class="ds-div-head">Document Preview</h1>
<div style="background-color: green; padding: 10px 10px 10px 10px; width: 945px" > 
	
	<table>
		<tr><td colspan="2" style="background-color: red; font-weight: bolder; color: white; text-align: center; padding: 10px 10px 10px 10px"><?php  echo $msg; ?></td></tr>
		<tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document ID</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php 
        $authorNames=explode(' ', $author);

        //$count=count($authorNames);
        foreach($authorNames as $name)
        {
            $count++;

            if($count==1)
            {
                $fName=$name;
            }
            else
            {
                $fNam=$fNam.substr($name, 0,1)." ";
            }

            
            //echo "$name  $Na <br/><br/>";
        }
        echo $ID; 


        ?></td></tr>
		<tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document Title</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo $title; ?></td></tr>
		<tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document Author</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo $author; ?></td></tr>
        <tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document Citation</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo Document::Citation($author,$year,$publisher,$title); ?></td></tr>
		<tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document Supervisor</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo $supervisor; ?></td></tr>
		<tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document Category</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo $category; ?></td></tr>
		
        <tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document School</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo $school; ?></td></tr>


        <tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document Department</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo $department; ?></td></tr>
        <tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document Description</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo $description; ?></td></tr>
        <tr><td style="background:#FFF url('../images/option-bar.png') repeat-x left top; font-weight: bolder; padding: 10px 10px 10px 10px">Document Abstract</td><td style="background-color: white; width: 100%; font-weight: bolder; padding: 10px 10px 10px 10px"><?php echo $abstract; ?></td></tr>
		<tr><td colspan="2" style="background:#FFF url('../images/option-bar.png') repeat-x left top; text-align: center; font-weight: bolder; padding: 10px 10px 10px 10px">Document Content</td></tr>
	</table>
	
	<iframe src="preview.php?file=<?php echo $file_name;?>" style="height:700px; width:100%;" focus></iframe>	

<?php

}
?>

</div>
<br/><br/>
<h1 class="ds-div-head"><center>Material Upload Form</center></h1>
<form class="upload-page" method="post" enctype="multipart/form-data">
	<table>
		<?php
        if($_SESSION['login']=='admin')
        {            
        ?>
        <tr><td>School</td><td>
            <select id="txtSchool" name="txtSchool">
                <option>Select</option>
                <option>Arts and Social Science</option>
                <option>Education</option>
                <option>Vocational and Technical Education</option>
                <option>Sciences</option>
            </select>
        </td></tr>
        <?php 
        }
        else
        {
            ?>
            <input type="hidden" id="txtSchool" name="txtSchool" value="Arts and Social Science" >
            <?php

        }

        ?>
		
        <tr><td>Department</td><td><input type="text" id="txtDept" name="txtDept" placeholder="Enter Department. e.g. Computer Science"></td></tr>
        <tr><td>Cateogy</td><td> 
        <select id="txtCategory" name="txtCategory">
            <option>Select</option>
            <option>Article</option>
            <option>Book</option>
            <option>Project</option>
            <option>Seminar</option>
        </select></td></tr>     
		<tr><td>File</td><td><input type="file" id="txtFile" name="txtFile"></td></tr>
		<tr><td>Title</td><td><input type="text" id="txtTitle" name="txtTitle" placeholder="Title without quotation marks"></td></tr>
		<tr><td>Author</td><td><input type="text" id="txtAuthor" name="txtAuthor" placeholder="Seperate multiple authors with semicolons"></td></tr>
        <tr><td>Supervisor</td><td><input type="text" id="txtSupervisor" name="txtSupervisor" placeholder="Full Names. e.g. Dauglas Kehinde Ajagbe"></td></tr>
        <tr><td>Publisher</td><td><input type="text" id="txtPublisher" name="txtPublisher" placeholder="Pub. Company;State;Country.(e.g. Idenyi Pres;Kogi;Nigeria"></td></tr>
        <tr><td>Year</td><td><input type="text" id="txtYear" name="txtYear" placeholder="e.g. 2018"></td></tr>
        <tr><td colspan="2">Abstract</td></tr>
        <tr><td colspan="2"><textarea id="txtAbstract" name="txtAbstract" cols="50" rows="10" placeholder="The abstract should be copied from the document and pasted here"></textarea></td></tr>
		<tr><td></td><td><input type="reset" value="Clear">    <input type="submit" value="Upload" name="btnUpload" id="btnUpload"></td></tr>
	</table>
</form>
</div>
</div>
</div>
</div>
<div id="ds-footer-wrapper">
<div id="ds-footer">
<div id="ds-footer-left" />
<div id="ds-footer-right">
<span class="theme-by">Theme by </span>
<a id="ds-footer-logo-link" href="../atmire.com/index.php" target="_blank" title="@mire NV">
<span id="ds-footer-logo"> </span>
</a>
</div>
<div id="ds-footer-links">
<a href="contact.php">Contact Us</a> | <a  href="feedback.php">Send Feedback</a>
</div>

</div>
</div>
</div>



</body>

</html>

