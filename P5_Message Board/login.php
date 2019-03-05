<?php  session_start();?>




<html>
<title>Login Page</title>

<body>

    <div id="lll">
        <h1><u>LOGIN PAGE</u></h1>
        <form method="post">
           <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password">
            <input type="submit" value="Login" name="dont" />
        </form>
    </div>

</body>

</html>
<style>
    body {
        background-color: #4CAF50;
    }

    input[type=text],
    input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 6px;
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 50px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    div {
        padding-left: 500px;
        padding-right: 500px;

    }

    form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        border-radius: 8px;
    }

    h1 {

        text-align: center;
        vertical-align: middle;
        padding-top: 10%;
        color: white;
        font-family:cursive;
    }
</style>
 <?php 

error_reporting(E_ALL);
ini_set('display_errors','On');
if(isset($_POST["dont"])){
try {
  $dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  $dbh->beginTransaction();
    
        $dbh->exec('delete from users where username="smith"');
  $dbh->exec('insert into users values("smith","' . md5("mypass") . '","John Smith","smith@cse.uta.edu")')
        or die(print_r($dbh->errorInfo(), true));
  $dbh->commit();
    
    
    $_SESSION['usern'] = $_POST['username'];
$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $dbh->prepare("select * from users where username='".$username."' and password='".md5($password)."'");
$stmt->execute();
      $row = $stmt->fetch();
      $md5pass = md5($password);
      $tabpass = $row['password'];
    
    
    
    //print_r($row);
      
      if($md5pass == $tabpass){
          echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";
           header("location:board.php");
      }
    
 
    else{
         header("location:login.php");
      echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
  
}
}
catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
}
?>