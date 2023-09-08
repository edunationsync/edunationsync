<?php
set_time_limit(120000);

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
  

//Message Class Start
class Message extends dbass {

  public static function IsExist($id)
  {
    $query=mysqli_query(dbass::Connect(),"SELECT * from message where id='$id'");
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

  public static function Send($sender,$reciever,$body,$type){
    
    $query=mysqli_query(dbass::Connect(),"INSERT into message(sender,reciever,body,type,status) values('$sender','$reciever','$body','$type','unread')");
    if($query){
      $news=true;
    }
    else{
      $news=false;
    }
    return $news;
  }


  public static function Update($id,$sender,$reciever,$body,$type)
  {
     $query=mysqli_query(dbass::Connect(),"UPDATE message set sender='$sender',reciever='$reciever',body='$body',type='$type',status='unread'  where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function MarkAsRead($id)
  {
     $query=mysqli_query(dbass::Connect(),"UPDATE message set status='read'  where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function MarkAllTypeAsRead($email,$type)
  {
     $query=mysqli_query(dbass::Connect(),"UPDATE message set status='read' where reciever='$email' and type='$type' ");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function Delete($id){
      $query=mysqli_query(dbass::Connect(),"DELETE from message where id='$id'");

      if($query>0)
      {
          $rs=True;
      }
      
      return $rs;
  }


  public static function ReadAll($email){
    $query=mysqli_query(dbass::Connect(),"SELECT * from message where reciever='$email' or sender='$email'  order by id desc");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    }
    return $news;
  }


  public static function ReadAllRecieved($email){
    $query=mysqli_query(dbass::Connect(),"SELECT * from message where reciever='$email' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    }        
    return $news;
  }


  public static function ReadAllSent($email){
    $query=mysqli_query(dbass::Connect(),"SELECT * from message where sender='$email' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    }        
    return $news;
  }

  public static function ReadAllUnreadMessages($email){

    $query=mysqli_query(dbass::Connect(),"SELECT * from message where type='message' and reciever='$email' and status='unread' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    } 
    return $news;
  }

  public static function ReadAllUnreadAlerts($email){
    $query=mysqli_query(dbass::Connect(),"SELECT * from message where type='alert' and  reciever='$email' and status='unread' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    }        
    return $news;
  }


  public static function ReadAllRead($email){
    $query=mysqli_query(dbass::Connect(),"SELECT * from message where reciever='$email' and status='read' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    }        
    return $news;
  }


  public static function ReadAllDraft($email){
    $query=mysqli_query(dbass::Connect(),"SELECT * from message where status='draft' ");
    $news=array();
    while($res=mysqli_fetch_array($query))
    {
        if(!in_array($res['id'], $news)){
          array_push($news, $res['id']);
        }
    }        
    return $news;
  }

  public static function ReadDetails($id){
      $query=mysqli_query(dbass::Connect(),"SELECT * from message where id='$id'");
      while($res=mysqli_fetch_array($query))
      {
        $news['id']=$res['id'];
        $news['reciever']=$res['reciever'];
        $news['sender']=$res['sender'];
        $news['body']=$res['body'];
        $news['type']=$res['type'];
        $news['status']=$res['status'];
        $news['timestamp']=$res['timestamp'];
      }
      
      return $news;
  }
}
//Messages Class Stop
?>