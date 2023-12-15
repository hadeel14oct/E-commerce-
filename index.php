<?php
session_start();
$nonavbar ='' ;
$pagetitle = "login";
print_r($_SESSION);
if(isset($_SESSION["username"])){
	header ("location: dashboard.php");
	
}

include"init.php";

 include $tbl . "header.php"; 
 if($_SERVER['REQUEST_METHOD'] =='POST'){
 	$usrname = $_POST['user'];
 	$passwor = $_POST['pass'];
 	$hashedPass = sha1($passwor);
 	$stmt = $con->prepare("SELECT userId, username , password from users where username = ? and password = ? and groupId = 1  limit 1 ");
$stmt -> execute (array($usrname,$hashedPass));
$row = $stmt->fetch();
$count = $stmt -> rowCount();
echo $count ;
if ($count > 0 ){
	//print_r($row); row array has all database abt this user 
	$_SESSION["username"] = $row["username"] ;
	$_SESSION["id"] = $row["userId"] ;//registerd both
header ("location: dashboard.php");
	exite();
	
}
}

  
 ?>
 <div class="h">
 	<i class=" slide-in-right ms-3 fa-solid fa-hashtag fa-2xl"></i>

 <i class="fa-solid fa-h" ></i>
 </div>
 
 <form class ="login" action="<?php echo $_SERVER['PHP_SELF'] ?> " method="post" >
 	<i class="fa-solid fa-hashtag fa-2xl"></i>
 	<i class="fa-solid fa-h" width="70px" height="50px"></i>
 	<h4 class="text-center"> Admins log <h4>

 	<input class="form-control input-lg" type ="text" name="user" placeholder="username" autocomplete="off"/>
 	<input  class="form-control " type ="password" name="pass" placeholder="password" autocomplete="new-password"/>
 	<input  class="btn btn-primary btn-block w-100" type ="submit" value="login" />
 </form>

<?php include $tbl . "footer.php"; ?>
    