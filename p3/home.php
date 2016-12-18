<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

//change pic
if(isset($_POST['btn-pic']))
{
 $uname = $userRow['user_name'];
 $uurl = $_POST['txt_url'];
 
  
 if($user->cPic($uname,$uurl))
 {
  $user->redirect('home.php');
 }
 else
 {
  $error = "Wrong Details !";
 } 
}

//change name
if(isset($_POST['btn-name']))
{
 $uname = $userRow['user_name'];
 $uname2 = $_POST['txt_name2'];

 $stmt2 =  $DB_con->prepare("SELECT user_name FROM users WHERE user_name=:uname2");
         $stmt2->execute(array(':uname2'=>$uname2));
         $row=$stmt2->fetch(PDO::FETCH_ASSOC);
 

 if($row['user_name']==$uname2) 
 {
       $error2 = "Username taken!";
 } 
 else
 {
 	if($user->cName($uname,$uname2))
  	{
    	$user->redirect('home.php');
  	}
 	else
  	{
  		$error2 = "Wrong Details !";
  	} 
 } 
}


//change email
//for some reason validate email is not letting valid emails in.
if(isset($_POST['btn-email']))
{
 $uname = $userRow['user_name'];
 $uemail = trim($_POST['txt_email']);

  $stmt2 =  $DB_con->prepare("SELECT user_email FROM users WHERE user_email=:uemail");
         $stmt2->execute(array(':uemail'=>$uemail));
         $row=$stmt2->fetch(PDO::FETCH_ASSOC);
 
 if($row['user_email']==$uemail) 
 {
            $error3 = "Email Taken!";
 } 

 else{
    if(!filter_var($uemail, FILTER_VALIDATE_EMAIL))
    {
      $error3 = 'Please enter a valid email address !';
    }
    else
    {
      if($user->cEmail($uname,$uemail))
      {
      $user->redirect('home.php');
      }
      else
      {
      $error = "Wrong Details !";
      } 
    } 
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>welcome - <?php print($userRow['user_email']); ?></title>
</head>

<body>

<div class="header">
 <div class="left">
     <label>- User Profile -</label>
    </div>
    <div class="right">
     <label><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></label>
    </div>

</div>
<div class="content">


<?php 
$cname = $userRow['user_name'];
print("Username: ".$userRow['user_name']);
echo "<br>";
print("Email: ".$userRow['user_email']);
echo "<br>";
$image=$userRow['url'];
echo '<img src="'.$image.'"style=width:525px;height:475px;><br>';

 ?>

 <div class="container">
     <div class="form-container">
        <form method="post">
            
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> 
                  </div>
                  <?php
            }
            ?>
           
            
            <div class="form-group">
             <input type="text" class="form-control" name="txt_url" placeholder="Image URL" required/>
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-pic" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;Change Pic
                </button>
            </div>           
        </form>
       </div>
</div>

 <div class="container">
     <div class="form-container">
        <form method="post">
            
            <?php
            if(isset($error2))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error2; ?> 
                  </div>
                  <?php
            }
            ?>
           
            
            <div class="form-group">
             <input type="text" class="form-control" name="txt_name2" placeholder="Change Name" required/>
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-name" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;Change Username
                </button>
            </div>           
        </form>
       </div>
</div>
 <div class="container">
     <div class="form-container">
        <form method="post">
            
            <?php
            if(isset($error3))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error3; ?> 
                  </div>
                  <?php
            }
            ?>
           
            
            <div class="form-group">
             <input type="text" class="form-control" name="txt_email" placeholder="Change Email" required/>
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-email" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;Change Email
                </button>
            </div>           
        </form>
       </div>
</div>



</div>
</body>
</html>