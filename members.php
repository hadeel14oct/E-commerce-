<?php 
$pagetitle ="members" ;//all func for memb
session_start();//this page knows abt login
if(isset($_SESSION["username"])){ // ask it if thers is a log in or by write the href only
include"init.php";// must in every page

$do =isset($_GET["do"])? $_GET["do"]:"manage" ;//no do in href


if($do=="manage"){ 
	$query = '';

			if (isset($_GET['page']) && $_GET['page'] == 'Pending') {

				$query = 'AND regStatus = 0';

			}
	$stmt = $con->prepare("SELECT * from users where  groupId != 1 $query ORDER BY UserID DESC ");
	$stmt -> execute ();
$row = $stmt->fetchAll();
?>
	<h1 class ="text-center">manage  members </h1>
	<div class="container">
					<div class="table-responsive">
					<table class ="table-bordered text-center table main-table">
					<tr>
					<td> ID</td>
					<td> USERNAME</td>	
					<td> EMAIL</td>	
					<td>REGISTERD DAY </td>	
					<td>CONTROL </td>	
					</tr>
					<?php 
foreach ($row as $r){
	echo "<tr>";
	echo "<td>" . $r["userId"] . "</td>" ;
	echo "<td>" . $r["username"] . "</td>" ;
	echo "<td>" . $r["email"] . "</td>" ;
	echo "<td>" .$r['date']."</td>" ;

	echo "<td>";?>
	<a class='btn btn-success' href="?do=edit&id= <?php echo $r['userId']?> "> <i class="fa fa-edit"></i> edit </a>
	<a class='btn btn-danger confirm' href="?do=delete&id=<?php echo $r['userId']?> "> <i class="fa fa-close"></i> delete </a>

		<?php echo "</td>"; 	
//above i tried to mix the html inside  php by dod concat and it didnt work hadeel
	echo "<tr>";}?>			
</table>
</div>
	<i class="fa fa-plus"></i>
	<a href="members.php?do=add" class="btn btn-primary " >   <i class="fa fa-plus"></i>                       add new member </a> 
	<i class="fa fa-plus"></i>
</div>
<?php }
else if($do=="edit"){ 
	$userid =isset($_GET["id"]) && is_numeric($_GET["id"])? intval($_GET["id"]):0;
$stmt = $con->prepare("SELECT * from users where userId = ?  limit 1 ");
$stmt -> execute (array($userid));
$row = $stmt->fetch();
$count = $stmt -> rowCount();

if ($count > 0 ){
	
?>
	<h1 class ="text-center">edit  member </h1>
	<div class="container">
		<form class="form-horizontal" action="?do=update" method="post">  
<input type="hidden" name="userid" value="<?php echo $row["userId"] ?>" />
			<div class="form-group form-group-lg"> 
				<label class="col-sm-2 control-label"> username </label>
				<div class="col-sm-10 col-md-4 da">
					<input type="text" name="username" class="form-control" value="<?php echo $row['username']?>" autocomplete="off " required="required"/>
				</div> </div>
				<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label">password</label>
				<div class="col-sm-10">
<input type="hidden" name="oldpassword"  value="<?php echo $row['password']?>" />
					<input type="password" name="newpassword" autocomplete ="new-password"class="form-control" />
				</div> </div> 
<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label"> Email </label>
				<div class="col-sm-10 da">
					<input type="email" name="email"  required="required" value="<?php echo $row['email']?>" class="form-control" />
				</div> </div>

					
				<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" name="save" class="btn btn-primary btn-lg" />
				</div> </div>


</form>
</div>
 
<?php }
else {
	$err= "there is no such id so its failed successfully";
 redirecthome ($err , "back");

	
}
}
else if($do=="update"){
	echo "<h1 class ='text-center'> Update Member </h1>";
 if($_SERVER['REQUEST_METHOD'] =='POST'){
 	$username = $_POST['username'];
 	$email = $_POST['email'];
 	$id = $_POST['userid'];
 	$pass="";
if(empty($_POST['newpassword'])){
	$pass= $_POST['oldpassword'];
}else{
	$pass=sha1($_POST['newpassword']);}

echo '<div class="container" >';
$formerrors = array();
if (empty($username)){
	$formerrors[]= '<div class="alert alert-danger">username cant be <strong>empty</strong></div>';
}
if(strlen($username) < 4){
	$formerrors[]=  '<div class="alert alert-danger">too short</div>';

}
if (empty($email)){
	$formerrors[]= '<div class="alert alert-danger"> email cant be empty</div>';
}
foreach($formerrors as $error ){
	echo $error ."<br/>";
	$err ="";
 redirecthome ($err , "back");

}
echo "</div>";

if(empty($formerrors)){

$stmt = $con->prepare("UPDATE users set username = ? , email = ? ,password =? where userId = ?  limit 1 ");
$stmt -> execute (array($username, $email ,$pass , $id ));

$count = $stmt -> rowCount();

$err= '<div class="alert alert-success">' .$count . " record updated </div>" ;
 redirecthome ($err , "back");

}
	}

else {
$err= "you bitch came without filling a form";
 redirecthome ($err , "back");
}
}


else if($do=="add"){

?>
	<h1 class ="text-center" style=" color:#FFCC70"
>add new  member </h1>
	<div class="container">
		<form class="form-horizontal" action="?do=insert" method="post">  
			<div class="form-group form-group-lg"> 
				<label class="col-sm-2 control-label">username</label>
				<div class="col-sm-10 col-md-4 da">
					<input type="text" name="username" class="form-control" placeholder="enter yours $shits"  autocomplete="off " required="required"/>
				</div> </div>
				<div class="form-group form-group-lg ">
				<label class="col-sm-2 control-label">password</label>
				<div class="col-sm-10 da">
					<input type="password" required="required" name="newpassword" placeholder="enter yours $shits"  autocomplete ="new-password"class="password form-control" />
					<i class="show-pas fa fa-eye fa-2x"> </i>
				</div> </div> 
<div class="form-group form-group-lg">
				<label class="col-sm-2 control-label"> Email </label>
				<div class="col-sm-10 da">
					<input type="email" name="email"  placeholder="enter yours $shits"  required="required"  class="form-control" />
				</div> </div>

					
				<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" value="save" class="btn btn-primary btn-lg" />
				</div> </div>


</form>
</div>
 
<?php }



//else if($do=="add"){
//	}
else if($do=="insert"){
echo "<h1 class ='text-center'> insert Member </h1>";
 if($_SERVER['REQUEST_METHOD'] =='POST'){
 	$username = $_POST['username'];
 	$email = $_POST['email'];
	$pass=$_POST['newpassword'];

	$hpass=sha1($_POST['newpassword']);

echo '<div class="container" >';
$formerrors = array();
if (empty($username)){
	$formerrors[]= 'username cant be <strong>empty</strong>';
}
if(strlen($username) < 4){
	$formerrors[]=  'too short';

}
if (empty($email)){
	$formerrors[]= ' email cant be empty';
}
if (empty($pass)){
	$formerrors[]= ' pass cant be empty';
}
foreach($formerrors as $error ){
	echo "<div class='alert alert-danger'>" .$error.'</div>' ."<br/>";
	$err="";
 redirecthome ($err , "back");

}
echo "</div>";

if(empty($formerrors)){
$check =  checkitem ( "username" , "users" , $username);
if ($check == 1) {
	$err= "sorry this user is exist ";
 redirecthome ($err , "back");

}
else{

$stmt = $con->prepare("INSERT INTO users( username , email  ,password, date ) values(:us , :em, :pa, now()) ");
$stmt -> execute (array('us' => $username, 'em' =>$email ,'pa' =>$hpass  ));

$count = $stmt -> rowCount();

$err= '<div class="alert alert-success">' .$count . " record inserted </div>" ;
 redirecthome ($err , "back");

}
	}}

else {
$str = "you bitch came without filling a form";
  redirecthome($str ,"m", 2);
}
}


else if($do=="delete"){
$userid =isset($_GET["id"]) && is_numeric($_GET["id"])? intval($_GET["id"]):0;

//$stmt = $con->prepare("SELECT * from users where userId = ?  limit 1 ");
$check =  checkitem ( "userId" , "users" , $userid);

//$stmt -> execute (array($userid));
//$row = $stmt->fetch();
//$count = $stmt -> rowCount();

if ($check > 0 ){
	$stmt = $con->prepare("DELETE from users WHERE userId = :us ");
	$stmt -> execute (array(":us" =>  $userid));
// blindpara didnt work
$err= '<div class="alert alert-success">' .$check . " record deleted </div>" ;
 redirecthome ($err , "back");


}
else {
$err='<div class="alert alert-danger"> "this id  not exist already" </div>';
 redirecthome ($err , "back");

}
}
 elseif ($do == 'Activate') {

			echo "<h1 class='text-center'>Activate Member</h1>";
			echo "<div class='container'>";

				// Check If Get Request userid Is Numeric & Get The Integer Value Of It

				$userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('userid', 'users', $userid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("UPDATE users SET regStatus = 1 WHERE UserID = ?");

					$stmt->execute(array($userid));

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

					redirectHome($theMsg);

				} else {

					$theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		}










include $tbl . "footer.php"; 



}

else{
   // if he enters from differnt browser by writting the href without logging in
	header("location:index.php"); 
	exist();
}