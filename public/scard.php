<?php

include 'Module.php';
$school_details=School::ReadSchoolDetails();
$CurrentSession=Module::ReadCurrentSession();
$Session=$CurrentSession['session'];
$Term=$_GET['term'];

  if(isset($_POST['btnGenerate']))
  {
    $number=$_POST['txtNo'];
    
      
      $last= Module::GetLastCard();
      for ($i=$number; $i >0 ; $i--) { 
        
        $pin=Module::GeneratePin();
        
        $serial=$school_details['school_keycode'].$last++;
        
        Module::AddCard($pin,$serial);
      }
  }
     

  $scards=Module::ReadAllScratchCards();



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >


<head> 
    <link rel="icon" type="image/png" href="../images/school/favicon.png"/>

<style type="text/css">
    hd{
      font-size: 24px;
    }
    hd1{
      font-size: 19px;
    }

    body 
    {
      background-color: lightblue;
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
    tbody{
      font-size: 25px;
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
      padding-bottom: 4%;
      margin-left: auto;
      margin-right: auto;
      height: 700px;
      width: 842;
      page-break-after: always;
    }
    input[type=text],select
    {
      margin: 0px 0px 0px 0px;
      border: 1px solid white;
      width: 100%;
      height: 100%;
      text-align: left;
      font-size: 20px;
      padding: 0px 0px 0px 0px;
      border: none;
    }
    input[type=number]
    {
      margin: 0px 0px 0px 0px;
      border: 1px solid black;
      width: 100%;
      height: 100%;
      text-align: left;
      font-size: 20px;
      padding: 0px 0px 0px 0px;
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

    input[type=text]:focus
    {
      font-weight: bolder;
      background-color: lightblue;
      color: black;
      border-color: lightblue;
    }


    #msgContainer
    {
      background-color: lightblue;
      padding: 15px 15px 15px 15px;
      color: red;
      font-weight: bolder;
      border: 1px solid white;
      text-align: center;
      font-size: 12px;
      position: fixed;
    }

    </style>
    <script type="text/javascript">

      function savecard(id,serial,pin,status,user,session,term)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("msgContainer").innerHTML = "Loading...";
          }
        };
        xmlhttp.open("GET", "savecard.php?id="+id+"&serial="+serial+"&pin="+pin+"&status="+status+"&user="+user+"&session="+session+"&term="+term
          , true);
        xmlhttp.send();
      }

      function deletecard(id)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("msgContainer").innerHTML = this.responseText;
            HideThis('row'+id);
          }
          else
          {
            document.getElementById("msgContainer").innerHTML = "Loading...";
          }
        };
        xmlhttp.open("GET", "deletecard.php?id="+id
          , true);
        xmlhttp.send();
      }

      function HideThis(id)
      {
        var row=document.getElementById(id);
        row.style.display="none";
      }

      function generatepins(number,session)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("msgContainer").innerHTML = "Loading...";
          }
        };
        xmlhttp.open("GET", "generatepins.php?number="+number+"&session="+session
          , true);
        xmlhttp.send();
      }
    </script>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Dubai Care School, Ankpa, Kogi State, Nigeria" />
<title><?php echo $school_details['school_name'];?> Scratch Cards</title>

</head>

<body  >
  <center><div id='msgContainer'><?php echo $msg;
    ?></div></center>
<div class="content">
  <header>
    <a href="../admin/"><center><b class="bheader"><b ><hd>DUBAI CARE SCHOOL</hd></b><br/>
      <hd1> SCRATCH CARD SUBSCRIPTION PLATFORM</hd1> <br/></b></center></a>
  </header>

  
  <table cellspacing="0" width="100%">
    <thead><tr><td valign='top'></td><td valign='top'>ID</td><td valign='top'>SERIAL</td><td   valign='top'>PIN</td><td   valign='top'>STATUS</td><td   valign='top'>USER</td><td   valign='top'>SESSION</td><td   valign='top'>TERM</td></tr></thead>
    <tbody>
      <?php
      $count=0;
      foreach($scards as $serial)
      { 
        $subjectDetails=Module::ReadCardDetails($serial);
        $serial=$subjectDetails['serial'];
        $id=$subjectDetails['id'];
        $pin=$subjectDetails['pin'];
        $status=$subjectDetails['status'];
        $user=$subjectDetails['user'];
        $session=$subjectDetails['session'];
        $term=$subjectDetails['term'];


        ?>
        <tr id="row<?php echo $id; ?>" ><td><button onclick="deletecard('<?php echo $id;  ?>');"><img src='delete.png' width='20px' height='20px'></button></td>
        <td><center><?php echo $id; ?></center></td>

        <td>
          <input type="text" value="<?php echo $serial;  ?>"  id="<?php echo $id;  ?>seria"  
            onkeyup="savecard('<?php echo $id; ?>',
              document.getElementById('<?php echo $id;?>seria').value,
              document.getElementById('<?php echo $id;?>pi').value,
              document.getElementById('<?php echo $id;?>statu').value,
              document.getElementById('<?php echo $id;?>use').value,
              document.getElementById('<?php echo $id;?>sessio').value,
              document.getElementById('<?php echo $id;?>ter').value)"  
          >
        </td>

        <td>
          <input type="text" value="<?php echo $pin;  ?>"  id="<?php echo $id;  ?>pi"  
            onkeyup="savecard('<?php echo $id; ?>',
              document.getElementById('<?php echo $id;?>seria').value,
              document.getElementById('<?php echo $id;?>pi').value,
              document.getElementById('<?php echo $id;?>statu').value,
              document.getElementById('<?php echo $id;?>use').value,
              document.getElementById('<?php echo $id;?>sessio').value,
              document.getElementById('<?php echo $id;?>ter').value)"  
          >
        </td>

        <td>
          <input type="text" value="<?php echo $status;  ?>"  id="<?php echo $id;  ?>statu"  
            onkeyup="savecard('<?php echo $id; ?>',
              document.getElementById('<?php echo $id;?>seria').value,
              document.getElementById('<?php echo $id;?>pi').value,
              document.getElementById('<?php echo $id;?>statu').value,
              document.getElementById('<?php echo $id;?>use').value,
              document.getElementById('<?php echo $id;?>sessio').value,
              document.getElementById('<?php echo $id;?>ter').value)"  
          >
        </td>

        <td>
          <input type="text" value="<?php echo $user;  ?>"  id="<?php echo $id;  ?>use"  
            onkeyup="savecard('<?php echo $id; ?>',
              document.getElementById('<?php echo $id;?>seria').value,
              document.getElementById('<?php echo $id;?>pi').value,
              document.getElementById('<?php echo $id;?>statu').value,
              document.getElementById('<?php echo $id;?>use').value,
              document.getElementById('<?php echo $id;?>sessio').value,
              document.getElementById('<?php echo $id;?>ter').value)"  
          >
        </td>

        <td>
          <input type="text" value="<?php echo $session;  ?>"  id="<?php echo $id;  ?>sessio"  
            onkeyup="savecard('<?php echo $id; ?>',
              document.getElementById('<?php echo $id;?>seria').value,
              document.getElementById('<?php echo $id;?>pi').value,
              document.getElementById('<?php echo $id;?>statu').value,
              document.getElementById('<?php echo $id;?>use').value,
              document.getElementById('<?php echo $id;?>sessio').value,
              document.getElementById('<?php echo $id;?>ter').value)"  
          >
        </td>

        <td>
          <input type="text" value="<?php echo $term;  ?>"  id="<?php echo $id;  ?>ter"  
            onkeyup="savecard('<?php echo $id; ?>',
              document.getElementById('<?php echo $id;?>seria').value,
              document.getElementById('<?php echo $id;?>pi').value,
              document.getElementById('<?php echo $id;?>statu').value,
              document.getElementById('<?php echo $id;?>use').value,
              document.getElementById('<?php echo $id;?>sessio').value,
              document.getElementById('<?php echo $id;?>ter').value)"  
          >
        </td>

        <?php       
      }
      ?>
          <tr><td colspan="9" ><form method="POST" action=""><button style="float: right;"  name="btnGenerate" id="btnGenerate" type="submit" ><img src="generate.png"></button><div style="float: right; height: 35px; width: 200px"><label for="txtNo" ><input  type="number" name="txtNo" id="txtNo"></div></form></td></tr>

        
    </tbody>
    <tfoot></tfoot>
  </table>
  <footer></footer>
</div>

</body>
</html>
