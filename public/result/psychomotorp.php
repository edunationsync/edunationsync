<?php session_start();
include '../Module.php';
$school_details=School::ReadSchoolDetails();
//if(!(isset($Class)))
  $Class=$_GET['classp'];
//if(!(isset($Session)))
  $Session=$_GET['sessionp'];
//if(!(isset($Term)))
  $Term=$_GET['termp'];

  $Subjects=Module::ReadClassSubjectsp($Class,$Session,$Term);

  if(!isset($_SESSION['lgina']))
  {
    header("location:../login.php");
  }

  $ss=Module::GetClassSessionp($Class);

  $Students=Module::ReadSessionStudentsp($ss,$Class);

  $subDetails=Module::ReadSubjectDetailsp($Subject);
  $sbjt=$subDetails['subject'];

  if(isset($_GET['btnSort']))
  {
      $Subject=$_GET['txtsubjectSort'];
      $Class=$_GET['txtclassSort'];
      $Session=$_GET['txtsessionSort'];
      $Term=$_GET['txttermSort'];
      
      $Students=Module::ReadResultStudentsp($Session,$Term,$Subject,$Class);
  }

      $subDetails=Module::ReadSubjectDetailsp($Subject);
      $sbjt=$subDetails['subject'];


  $current=Module::ReadCurrentSession();
  $session_details=Module::ReadSessionDetails($Session,$Term);

  if(strtolower($Session)==strtolower($current['session']) && strtolower($Term)==strtolower($current['term']))
  {
    $editStatus='true';
  }
  else
  {
    $editStatus='false';
  }

  $CA1Status=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"ca_1");
  $CA2Status=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"ca_2");
  $ExamStatus=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"exam");
?>

<!DOCTYPE html>
<html lang="en">

<head> 
    <link rel="icon" type="image/png" href="../images/school/favicon.png"/>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $Class.' Ratings for '.$Term.' Term '.$Session; ?></title>
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../dashboard/css/sb-admin.css" rel="stylesheet">

  <style type="text/css">
    select{
      width: 98%;
    }
  </style>

  <style type="text/css">
    /* The snackbar - position it at the bottom and in the middle of the screen */
    #snackbar {
      visibility: hidden; /* Hidden by default. Visible on click */
      min-width: 250px; /* Set a default minimum width */
      margin-left: -125px; /* Divide value of min-width by 2 */
      background-color: #333; /* Black background color */
      color: #fff; /* White text color */
      text-align: center; /* Centered text */
      border-radius: 2px; /* Rounded borders */
      padding: 16px; /* Padding */
      position: fixed; /* Sit on top of the screen */
      z-index: 1; /* Add a z-index if needed */
      left: 50%; /* Center the snackbar */
      bottom: 30px; /* 30px from the bottom */
    }

    /* Show the snackbar when clicking on a button (class added with JavaScript) */
    #snackbar.show {
      visibility: visible; /* Show the snackbar */
      /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
      However, delay the fade out process for 2.5 seconds */
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    /* Animations to fade the snackbar in and out */
    @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }

    .navmenu{
      padding: 4px 4px 4px 4px;
      background: white;
      color: black;
    }
    .navmenu a{
      border: 1px groove black;
      text-decoration: none;
      text-transform: uppercase;
      text-decoration: none;
      padding: 5px 5px 5px 5px;
      margin: 5px 5px 5px 5px;
      background: lightgreen;
    }

    .navmenu a:hover{
      background: lightblue;
    }
  </style>

  
  <script type="text/javascript">

      function SpeakOut(text)
      {

        if(document.getElementById('verifier').checked)
        {
          if(text==="")
          {
            text="Nothing";
          }

          var msg=new SpeechSynthesisUtterance(text);
          msg.volume=10.0;
          msg.lang='en-US';
          msg.volume=1;
          msg.rate=1;
          msg.pitch=0;
          window.speechSynthesis.speak(msg);
        }
        else
        {
        }
      }

      function Toast(message) {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");
        x.innerHTML=message;

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }

      function checkkey(event)
      {
        if(event.key=="Enter")
        {
          document.getElementById('msgContainer').innerHTML="Pressing Enter key will create a new line which is not necessary for result processing. <br/>Use Backspace key to clear every new lines to continue.";
          alert('Pressing Enter key is not allowed. \n Press Back space to clear that new line to continue ');
        }
        
      }


      function saverating(regno,session,term,attendance,attentiveness,neatness,politeness,relationship,curiosity,honesty,help_others,punctuality,leadership,emotional_stability,attitude_to_work)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            Toast(this.responseText);
          }
          else
          {
            Toast("Loading...");
          }
        };
        xmlhttp.open("GET", "saveratingsp.php?regno="+regno+
          "&session="+session+
          "&term="+term+
          "&attendance="+attendance+
          "&attentiveness="+attentiveness+
          "&neatness="+neatness+
          "&politeness="+politeness+
          "&relationship="+relationship+
          "&curiosity="+curiosity+
          "&honesty="+honesty+
          "&help_others="+help_others+
          "&punctuality="+punctuality+
          "&leadership="+leadership+
          "&emotional_stability="+emotional_stability+
          "&attitude_to_work="+attitude_to_work
          , true);
        xmlhttp.send();
      }

      function exportTableToExcel(tableID, filename = ''){
          var downloadLink;
          var dataType = 'application/vnd.ms-excel';
          var tableSelect = document.getElementById(tableID);
          var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
          
          // Specify file name
          filename = filename?filename+'.xls':document.title+'.xls';
          
          // Create download link element
          downloadLink = document.createElement("a");
          
          document.body.appendChild(downloadLink);
          
          if(navigator.msSaveOrOpenBlob){
              var blob = new Blob(['\ufeff', tableHTML], {
                  type: dataType
              });
              navigator.msSaveOrOpenBlob( blob, filename);
          }else{
              // Create a link to the file
              downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
          
              // Setting the file name
              downloadLink.download = filename;
              
              //triggering the function
              downloadLink.click();
          }
      }

      function toggleMenu(btn,menu)
      {

        if(document.getElementById(menu).style.display=='none')
        {
          document.getElementById(menu).style.display='block';
          document.getElementById(btn).innerHTML='Hide Menu';
        }
        else
        {          
          document.getElementById(menu).style.display='none';
          document.getElementById(btn).innerHTML='Show Menu';
        }
      }

  </script>
  <style type="text/css">
      hd{
        font-size: 24px;
      }
      hd1{
        font-size: 19px;
      }

      body 
      {
        background-color: white;
      }
      .bheader{
        color: black;
        font-family: times new roman;
        text-align: center;
        font-size: 25px;
      }
      thead{
        font-weight: bolder;
        text-align: center;
        font-size: 20px;
      }
      tr:hover{
        background-color: white;
      }
      tbody{
        font-size: 16px;
      }
      tbody .data{
        text-align: center;
      }
      td{
        padding-right: 0.2%;
        border: 1px solid black;
      }
      .content 
      {
        background-color: white;
        padding-left: 3%;
        padding-right: 3%;
        margin-left: auto;
        margin-right: auto;
        min-height: 700px;
        page-break-after: always;
      }
      input[type=text]
      {
        background-color: transparent;
        margin: 0px 0px 0px 0px;
        border: 1px solid white;
        width: 100%;
        height: 100%;
        text-align: center;
        font-size: 20px;
        border: none;
      }
      
      input[type="submit"]
      {
        background-color: blue;
        color: white;
        padding: 3px 3px 3px 3px;
      }
      input[type="submit"]:hover
      {
        background-color: lightblue;
        color: black;
      }

      form{
        float: left;
      }

      td:focus
      {
        font-weight: bolder;
        background-color: lightblue;
        color: black;
        border-color: lightblue;
      }


      button{
        background-color: blue;
        color: white;
        font-weight: bolder;
      }
      button:hover{
        background-color: lightblue;
        color: black;
        font-weight: bolder;
      }

      #msgContainer1
      {
        
        padding: 15px 15px 15px 15px;
        color: yellow;
        font-weight: bolder;
        text-align: center;
        font-size: 12px;
        overflow: left;
        background: #4F3611;
        min-height: 120px;
      }
    </style>
</head>

<body id="page-top">


  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php"><img src="../images/school/favicon.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>


    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="../student_almanac.php">
      <div class="input-group">
        <input type="text" name="src" id="src" class="form-control" value="<?php echo $_GET['src']; ?>" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"><?php if(count($NewAlerts)>0){ echo $NewAlerts;} elseif(count($NewAlerts)>9){echo "9+";} ?></i>

        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewAlerts)>0)
            {
              foreach($NewAlerts as $Alerts)
              {
                $alertDetails=Message::ReadDetails($Alerts);
                ?>
                <a href="../../dashboard/messages.php?id=<?php echo $alertDetails['id']; ?>" title="Sent By: <?php echo $alertDetails['sender']; ?>"><div><?php echo $alertDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="../../dashboard/messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"><?php if(count($NewMessages)>0){ echo $NewMessages;} elseif(count($NewMessages)>9){echo "9+";} ?></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewMessages)>0)
            {
              foreach($NewMessages as $Msg)
              {
                $msgDetails=Message::ReadDetails($Msg);
                ?>
                <a href="../../dashboard/messages.php?id=<?php echo $msgDetails['id']; ?>" title="Sent By: <?php echo $msgDetails['sender']; ?>"><div><?php echo $msgDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="../../dashboard/messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
      <li class="nav-item dropdown no-arrow">
        
          <?php
          if($_SESSION['lgina'])
          {
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 20px; height: 20px; border-radius: 100%;"></a><div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="../../dashboard/users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="../../dashboard/users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="../../dashboard/users/viewstaffprofile.php"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
            <?php
          }
          else
          {
            ?>          
            <i class="fas fa-user-circle fa-fw"></i>
            <?php
          }
          ?>
        
        
      </li>
    </ul>

  </nav>

  <div id="wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()">Back</a>
          </li>
          <div style="padding-left: 25px">
            <a href="../dashboard">Dashboard</a> | <a href="../dashboard/users/allstudents.php?txtclassp=<?php echo $Class; ?>" target="_blank">Students</a> | <a href="attendance.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>" target="_blank">Attendance</a> | <a href="positions.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>" target="_blank">Positions</a> | <a href="master_sheet/master_sheetp.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">Master Sheet</a> | <a href="master_sheet/master_sheet_ca1.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">CA1 Master</a> | <a href="master_sheet/master_sheet_ca2.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">CA2 Master</a> | <a href="master_sheet/master_sheet_exam.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>" target="_blank">Exam Master</a> | <a href="../portal/allresultsfull.php?prclass=<?php echo $Class; ?>&prsession=<?php echo $Session; ?>" target="_blank">Result Sheets</a> | <a href="../portal/student_resultp.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" target="_blank">Individual Updater</a> | <a href="result_summary.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>" target="_blank">Term Summary</a> | <a href="session_subject_analysis.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>" target="_blank">Session Subject Summary</a> | <a href="session_subject_analysis.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>">Subject Analysis</a>
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px">
            <a href="ca_sheet/ca_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>">All CA Sheets</a> | <a href="ca_sheet/ca_post_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>"> All Post CA Sheets</a> | <a href="ca_sheet/ca_score_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>" title="Print All CA Score Sheet for this class">All Score Sheets</a> | <a href="ca_sheet/ca_blank_sheetp.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>&txtsubjectp=<?php echo $Subject; ?>" title="Open Blank CA Sheet">Blank Sheet</a> | <a href="ca_sheet/ca_blank_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>" title="Open All Blank CA Sheets for this class.">All Blank Sheets</a> | <a href="term_sub_result_summary.php?txtsession=<?php echo $Session; ?>&txtclass=<?php echo $Class; ?>&txtterm=<?php echo $Term; ?>" title="Term Sub Analysis">Term Sub Analysis</a>
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px; background: black; padding: 10px 10px 10px 10px; font-size: 12px;">
            <?php
            $Sessions_s=Module::ReadAllSessions();

            foreach($Sessions_s as $Session_s)
            {
              if($Session_s ==$Session)
              {
                ?>
                <a href="?sessionp=<?php echo $Session_s; ?>&termp=<?php echo $Term ?>&classp=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $Session_s; ?></a>
                <?php
              }
              else
              {
                ?>
                <a href="?sessionp=<?php echo $Session_s; ?>&termp=<?php echo $Term ?>&classp=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $Session_s; ?></a>
                <?php                
              }
            }
            ?>
            
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px; background: black; padding: 10px 10px 10px 10px; font-size: 12px;">
            <?php
            $Terms=array("First","Second","Third");

            foreach($Terms as $Term_s)
            {
              if($Term ==$Term_s)
              {
                ?>
                <a href="?sessionp=<?php echo $Session; ?>&termp=<?php echo $Term_s ?>&classp=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $Term_s; ?></a>
                <?php
              }
              else
              {
                ?>
                <a href="?sessionp=<?php echo $Session; ?>&termp=<?php echo $Term_s ?>&classp=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $Term_s; ?></a>
                <?php                
              }
            }
            ?>            
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px; background: black; padding: 10px 10px 10px 10px; font-size: 12px;">
            <?php
            $Classesss=Module::ReadAllClassesp();

            foreach($Classesss as $classes_s)
            {
              if($Class ==$classes_s)
              {
                ?>
                <a href="?sessionp=<?php echo $Session; ?>&termp=<?php echo $Term ?>&classp=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $classes_s; ?></a>
                <?php
              }
              else
              {
                ?>
                <a href="?sessionp=<?php echo $Session; ?>&termp=<?php echo $Term ?>&classp=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $classes_s; ?></a>
                <?php                
              }
            }


            ?>
            
          </div>
        </ol><!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <form method="POST" action="">
              <input type="hidden" name="sessionp" value="<?php echo $Session; ?>">
              <input type="hidden" name="termp"  value="<?php echo $Term; ?>">
              <input type="hidden" name="classp"  value="<?php echo $Class; ?>">
              <input type="submit" name="btnReGenerate" value="Generate Ratings">
            </form>
          </li>
          <li class="breadcrumb-item">
            <a href="psychomotor_printp.php?sessionp=<?php echo $Session; ?>&termp=<?php echo $Term ?>&classp=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;">Print Preview</a>
          </li>
          <div style="padding-left: 25px">
            <span id="entryMsg" name="entryMsg" style="font-style: italic; background: pink; color: black; padding: 5px 5px 5px 5px;">Status</span></div>
        </ol>
        <!-- Icon Cards-->
       
        <!--CA Sheet Content start-->
        <div class="content" id="content" style="padding:20px 20px 20px 20px">
          <header>
            <b>
            <div class="bheader"><center ><b ><hd><?php echo strtoupper($Class);  ?> PSYCHOMOTOR RATING</hd></b><br/>
              <hd1>FOR <?php echo strtoupper($Term); ?> TERM <?php echo $Session; ?></center></div></b>
          </header>

          <table cellspacing="0" width="100%">
    <thead><tr><td  width="40px" valign='top'>REG. NO.</td><td style="width:270px;"  valign='top'>NAME</td><td  valign='top'>ATTENDANCE</td><td  valign='top'>ATTENTIVE</td><td  valign='top'>NEAT</td><td  valign='top'>POLITE</td><td  valign='top'>RELATION</td><td  valign='top'>CURIOSITY</td><td  valign='top'>HONESTY</td><td  valign='top'>HELP</td><td  valign='top'>PUNCT</td><td  valign='top'>LEAD</td><td  valign='top'>EMOT STAB</td><td  valign='top'>ATTIT</td></tr></thead>
    <tbody>
      <?php
      $count=0;
        foreach($Students as $RegNo)
        {
          $count++;
          $studentDetails=Module::ReadStudentDetailsp($RegNo);
          $Student=$studentDetails['names'];
          echo "<tr/><td>$RegNo</td><td>$Student</td>";
          
          if(!(Module::IsStudentDomainExistp($RegNo,$Session,$Term)))
          {
            $psychData=Module::GeneratePsychomotor($session_details['tdays']);

            if(Module::AddDomainp($RegNo,$Session,$Term,$psychData['attendance'],$psychData['attentiveness'],$psychData['neatness'],$psychData['politeness'],$psychData['relationship'],$psychData['curiosity'],$psychData['honesty'],$psychData['help_others'],$psychData['punctuality'],$psychData['leadership'],$psychData['emotional_stability'],$psychData['attitude_to_work']))
            {
              $msg=$RegNo."'s' Domain was Generated";
            }
            else
            {
              $msg=$RegNo."'s' Domain was not Generated";
            }

            $attendance=$psychData['attendance'];
            $attentiveness=$psychData['attentiveness'];
            $neatness=$psychData['neatness'];
            $politeness=$psychData['politeness'];
            $relationship=$psychData['relationship'];
            $curiosity=$psychData['curiosity'];
            $honesty=$psychData['honesty'];
            $help_others=$psychData['help_others'];
            $punctuality=$psychData['punctuality'];
            $leadership=$psychData['leadership'];
            $emotional_stability=$psychData['emotional_stability'];
            $attitude_to_work=$psychData['attitude_to_work'];

          }
          elseif(isset($_POST['btnReGenerate']))
          {
            $psychData=Module::GeneratePsychomotor($session_details['tdays']);

            if(Module::UpdateDomainp($RegNo,$Session,$Term,$psychData['attendance'],$psychData['attentiveness'],$psychData['neatness'],$psychData['politeness'],$psychData['relationship'],$psychData['curiosity'],$psychData['honesty'],$psychData['help_others'],$psychData['punctuality'],$psychData['leadership'],$psychData['emotional_stability'],$psychData['attitude_to_work']))
            {
              $msg=$RegNo."'s' Domain was Re-Generated";
            }
            else
            {
              $msg=$RegNo."'s' Domain was Not Re-Generated";
            }


            $attendance=$psychData['attendance'];
            $attentiveness=$psychData['attentiveness'];
            $neatness=$psychData['neatness'];
            $politeness=$psychData['politeness'];
            $relationship=$psychData['relationship'];
            $curiosity=$psychData['curiosity'];
            $honesty=$psychData['honesty'];
            $help_others=$psychData['help_others'];
            $punctuality=$psychData['punctuality'];
            $leadership=$psychData['leadership'];
            $emotional_stability=$psychData['emotional_stability'];
            $attitude_to_work=$psychData['attitude_to_work'];
          }
          else
          {
            $resultData=Module::ReadDomainDetailsp($RegNo,$Session,$Term);
            $attendance=$resultData['attendance'];
            $attentiveness=$resultData['attentiveness'];
            $neatness=$resultData['neatness'];
            $politeness=$resultData['politeness'];
            $relationship=$resultData['relationship'];
            $curiosity=$resultData['curiosity'];
            $honesty=$resultData['honesty'];
            $help_others=$resultData['help_others'];
            $punctuality=$resultData['punctuality'];
            $leadership=$resultData['leadership'];
            $emotional_stability=$resultData['emotional_stability'];
            $attitude_to_work=$resultData['attitude_to_work'];
          }
            ?>
              <td><input type="text" value="<?php echo $attendance;  ?>"  id="<?php echo $count;  ?>attendance"  onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)"  ></td>

              <td><input type="text" value="<?php echo $attentiveness;  ?>"  id="<?php echo $count;  ?>attentiveness"  onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)"  ></td>


                <td><input type="text" value="<?php echo $neatness;  ?>" id="<?php echo $count;  ?>neatness" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)"></td>
             

              <td><input type="text" id="<?php echo $count;  ?>politeness" value="<?php echo $politeness;  ?>"  onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)" >
              </td>
              
              <td><input value="<?php echo $relationship; ?>" type="text" id="<?php echo $count;  ?>relationship" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)">
              </td>
              
              <td><input 
                value="<?php echo $curiosity;  ?>" 
                type="text" id="<?php echo $count;  ?>curiosity" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)">
              </td>
              
              <td><input value="<?php echo $honesty; ?>" type="text" id="<?php echo $count;  ?>honesty" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)">
              </td>


              <td><input 
                value="<?php echo $help_others; ?>" 
                type="text" id="<?php echo $count;  ?>help_others" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)">
              </td>


              <td><input 
                value="<?php echo $punctuality; ?>" 
                type="text" id="<?php echo $count;  ?>punctuality" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)">
              </td>


              <td><input 
                value="<?php echo $leadership; ?>" 
                type="text" id="<?php echo $count;  ?>leadership" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)">
              </td>


              <td><input 
                value="<?php echo $emotional_stability; ?>" 
                type="text" id="<?php echo $count;  ?>emotional_stability" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)">
              </td>


              <td><input 
                value="<?php echo $attitude_to_work; ?>" 
                type="text" id="<?php echo $count;  ?>attitude_to_work" onkeyup="saverating('<?php echo $RegNo; ?>',
                 '<?php echo $Session; ?>',
                 '<?php echo $Term; ?>',
                 document.getElementById('<?php echo $count."attendance"; ?>').value,
                 document.getElementById('<?php echo $count."attentiveness"; ?>').value,
                 document.getElementById('<?php echo $count."neatness"; ?>').value,
                 document.getElementById('<?php echo $count."politeness"; ?>').value,
                 document.getElementById('<?php echo $count."relationship"; ?>').value,
                 document.getElementById('<?php echo $count."curiosity"; ?>').value,
                 document.getElementById('<?php echo $count."honesty"; ?>').value,
                 document.getElementById('<?php echo $count."help_others"; ?>').value,
                 document.getElementById('<?php echo $count."punctuality"; ?>').value,
                 document.getElementById('<?php echo $count."leadership"; ?>').value,
                 document.getElementById('<?php echo $count."emotional_stability"; ?>').value,
                 document.getElementById('<?php echo $count."attitude_to_work"; ?>').value)">
              </td>

            <?php
        }

      ?>
    </tbody>
    <tfoot></tfoot>
  </table>
        </div>
        <!--CA Sheet Content ends-->
      
    </div>
    <!-- /.content-wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="../dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../dashboard/vendor/chart.js/Chart.min.js"></script>
  <script src="../dashboard/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../dashboard/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../dashboard/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../dashboard/js/demo/datatables-demo1.js"></script>


  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <div id="preloader" style="display: none">
    <div id="loader"></div>
  </div>

<!-- The actual snackbar -->
<div id="snackbar"></div>
<script src="../js/attracta.js"></script>
</body>

</html>
