<?php error_reporting(error_reporting() & ~E_NOTICE);
set_time_limit(4800);

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
            $Name="root",
            $Pass="",
            $Server="localhost",
            $dbass="gsdw_scratch_card";
            
    public static $Message,
            $Status,
            $Errors;
    
    public function Connect(){
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


//School Profile Module
class School extends dbass {

  public static function Login($school_id,$school_password){
      $query=mysqli_query(dbass::Connect(),"SELECT * from school_profile where school_id='$school_id' and  school_password='$school_password'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function IsExist($school_id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from school_profile where school_id='$school_id'");

      $res=mysqli_num_rows($query);
      if($res>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

  public static function ReadAllSchools(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from school_profile   order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  public static function ReadAllCards($school_id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where  school_id='$school_id'   order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }

  public static function ReadAvailableCards($school_id){
      $Cards=School::ReadAllCards($school_id);

      $news=array();
      foreach($Cards as $card)
      {
        $cardDetails=Card::ReadDetails($card);
        if(!($cardDetails['status']=="Used")){
          if(!in_array($card, $news)){
            array_push($news, $card);
          }
        }
      }
      
      
      return $news;
  }

  public static function ReadUsedCards($school_id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from cards where status='Used' and school_id='$school_id'   order by id ");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
      }
      
      return $news;
  }


  public static function Add($school_id,$school_title,$school_initial,$school_type,$school_logo,$school_password){  

    $query=mysqli_query(dbass::Connect(),"INSERT into school_profile(school_id,school_title,school_initial,school_type,school_logo,school_password) values('$school_id','$school_title','$school_initial','$school_type','$school_logo','$school_password')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }

    return $news;
  }

  public static function Update($id,$school_id,$school_title,$school_initial,$school_type,$school_logo,$school_password){
    
      $query=mysqli_query(dbass::Connect(),"UPDATE school_profile set `school_id`='$school_id', school_title='$school_title', school_initial='$school_initial', school_type='$school_type', school_logo='$school_logo', term='$term', school_password='$school_password' where id='$id'");
      if($query)
        $news=true;
      else
        $news=false;
    
      return $news;
  }

  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from school_profile where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['school_id']=$res['school_id'];
        $news['school_title']=$res['school_title'];
        $news['school_initial']=$res['school_initial'];
        $news['school_type']=$res['school_type'];
        $news['school_logo']=$res['school_logo'];
        $news['school_password']=$res['school_password'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }

  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from school_profile where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }

}

//Session Module
class Session{

  public static function ReadAllSessions(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from sessions");
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
      $query=mysqli_query(dbass::Connect(),"SELECT * from sessions");
      $news=array();
      while($res=mysqli_fetch_array($query))
      {
          if(!in_array($res['id'], $news)){
            array_push($news, $res['id']);
          }
      }
      
      return $news;
  }
  




  public static function ReadSessionDetails($session){
      $query=mysqli_query(dbass::Connect(),"SELECT * from sessions where session='$session'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['id']= $res['id'];
          $news['session']= $res['session'];
          $news['term']= $res['term'];
          $news['status']= $res['status'];
          $news['startdate']= $res['startdate'];
          $news['enddate']= $res['enddate'];
      }
      
      return $news;
  }

  public static function ReadSessionIdDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from sessions where id='$id'  ");
      
      while($res=mysqli_fetch_array($query))
      {
          $news['session']= $res['session'];
          $news['term']= $res['term'];
          $news['status']= $res['status'];
          $news['startdate']= $res['startdate'];
          $news['enddate']= $res['enddate'];
          $news['totaldays']= $res['totaldays'];
          $news['stotaldays']= $res['stotaldays'];
          $news['id']= $res['id'];
      }
      
      return $news;
  }

  public static function ReadCurrentSession(){
      $query=mysqli_query(dbass::Connect(),"SELECT * from sessions where status='Current' ");
      
      while($res=mysqli_fetch_array($query))
      {
        $news['session']=$res['session'];
        $news['term']=$res['term'];
        $news['status']=$res['status'];
      }
      
      return $news;
  }
}

