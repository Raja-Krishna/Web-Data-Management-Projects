<?php session_start();
$dbh = new PDO("mysql:host=127.0.0.1:3306;dbname=board","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
if(isset($_GET["logout"])) {
session_destroy();
header("Location:login.php");
}
if(!isset($_SESSION['usern'])){
  header("Location:login.php");
}

?>



<html>

<head>
    <title>Message Board</title>
</head>

<body>

<div class="">
  <h1>Message Board</h1>
  <form class="" action="board.php" method="get">
    <input type="text" name="logout" value="1" hidden>
    <input type="submit" name="" value="logout">
  </form>
</div>

    <form method="get" name="myform" id='msg'>
        <textarea name="message" style="width: 350px; height: 150px; padding: 2px"></textarea><br><br>
        <input type="submit" value="Submit" name="submit" />
    </form>

    <style>
        textarea {
            border-radius: 2%;
        }
        table, th, td {
            border-collapse: collapse;
   border: 1px solid black;
}

        input {
            background-color: #4CAF50;
            color: white;
            padding: 7px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 12px;
        }

      #msg {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            padding: 45px;
            float: left;
            width: 40%;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.24);
            border-radius: 8px;
        }

        p{
            float: right;
            width: 60%;
            border-color: blue;
            background-color: black;
            color: white;
        }
    </style>
 <table>

     <tbody>
       <th>ID</th>
       <th>REPLYTO</th>
       <th>POSTEDBY</th>
       <th>FULLNAME</th>
       <th>DATETIME</th>
       <th>MESSAGE</th>
<?php
if(isset($_GET['message'])){
  $message = $_GET['message'];
try {
//print_r($dbh);
$dbh->beginTransaction();


  $usernm = $_SESSION['usern'];
 //$date = date('Y-m-d H:i:s');
  // users ( username, password, fullname, email )
  //posts ( id, replyto, postedby, datetime, message )
  $uniq = uniqid();
if (isset($_GET['reply'])) {
  $reply=$_GET['reply'];
  $dbh->exec("insert into posts values('$uniq','$reply','$usernm',now(),'$message')")
        or die(print_r($dbh->errorInfo(), true));
  $dbh->commit();
}
else {
  $dbh->exec("insert into posts values('$uniq',NULL,'$usernm',now(),'$message')")
        or die(print_r($dbh->errorInfo(), true));
  $dbh->commit();
}

$stmt = $dbh->prepare("select * from posts order by datetime DESC");
$stmt->execute();
//$row = $stmt->fetch();
      foreach($stmt as $row) {
  $stmt1 = $dbh->prepare("select fullname from users where username='".$row['postedby']."'");
  $stmt1->execute()
    or die(print_r($dbh->errorInfo(), true));
  foreach($stmt1 as $row1) {
    $fullName = $row1[0];
  }

echo "<tr>";
  echo "<td>".$row['id']."</td>";
  if (is_null($row['replyto'])) {
    echo "<td></td>";
  }
  else {
  echo "<td>".$row['replyto']."</td>";
  }
echo "<td>".$row['postedby']."</td>";
echo "<td>".$fullName."</td>";

    echo "<td>".$row['datetime']."</td>";
echo "<td>".$row['message']."</td>";
echo "<td><button  name='reply' form='msg' formaction='board.php' value='".$row['id']."'>Reply</a></td>" ;
echo "</tr>";
}


}
catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();}

    }

//        users ( username, password, fullname, email )
//posts ( id, replyto, postedby, datetime, message )

//        if (isset($_POST['msgsubmit'])){
//    	$query = ("select * from posts where id='"$row['id']"' postedby='"$row['postedby']"' and message='"$row['message']"'");
//    $stmt = $dbh->prepare($query);
//	$stmt->execute();
//	$ud = $stmt->fetchAll();
//	echo "<tr>";
//	echo "<td>".$ud[username]."</td>";
//	echo "<td>".$ud[message]."</td>";
//	echo "<td>".$ud[id]."</td>";
//	echo "</tr>";
$stmt = $dbh->prepare("select * from posts order by datetime DESC");
$stmt->execute();
//$row = $stmt->fetch();
      foreach($stmt as $row) {
  $stmt1 = $dbh->prepare("select fullname from users where username='".$row['postedby']."'");
  $stmt1->execute()
    or die(print_r($dbh->errorInfo(), true));
  foreach($stmt1 as $row1) {
    $fullName = $row1[0];
  }

echo "<tr>";
  echo "<td>".$row['id']."</td>";
  if (is_null($row['replyto'])) {
    echo "<td></td>";
  }
  else {
  echo "<td>".$row['replyto']."</td>";
  }
echo "<td>".$row['postedby']."</td>";
echo "<td>".$fullName."</td>";

    echo "<td>".$row['datetime']."</td>";
echo "<td>".$row['message']."</td>";
echo "<td><button  name='reply' form='msg' formaction='board.php' value='".$row['id']."'>Reply</a></td>" ;
echo "</tr>";
}




     ?>
     </tbody>
    </table>

</body>

</html>
