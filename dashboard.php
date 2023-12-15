<?php
session_start();
print_r($_SESSION); //to know
if(isset($_SESSION["username"])){ //if he enters after log in
$pagetitle = "dashboard";
include"init.php";
//creatingsqlhere (); once fo sure
$numUsers = 6; // Number Of Latest Users

		$latestUsers = getLatest("*", "users", "UserID", $numUsers); // Latest Users Array

		$numItems = 6; // Number Of Latest Items

		//$latestItems = getLatest("*", 'items', 'Item_ID', $numItems); // Latest Items Array

		$numComments = 4;

?>
<div class="container home-stats text-center">
	<h1> Dashboard <h1>
		<div class="row">
			<div class ="col-lg-3 col-sm-12">
				<div class="stat st-members" data="total">
					total members 
					<span> <a href="members.php" ><?php echo countItems ( "userid" , "users" ) ?> </a> </span>
				</div> </div>
				<div class ="col-lg-3 col-sm-12">
				<div class="stat st-pending"  data="total">
					pending members 
					<span> <a href="members.php?do=manage&page=Pending">
										<?php echo checkItem("RegStatus", "users", 0) ?>
									</a></span>
				</div> </div>
<div class ="col-lg-3 col-sm-12">
				<div class="stat st-items"  data="total">
					total items
					<span> 600 </span>
				</div> </div>
				<div class ="col-lg-3 col-sm-12">
				<div class="stat st-comments"  data="total">
					total comments
					<span> 500 </span>
				</div> </div>
			</div> </div>
			<div class="container latest">
				<div class="row">
					<div class ="col-sm-6">
						<div class="card">
							<div class="card-title">
 <i class="fa fa-users "></i>  lastest  <?php echo $numUsers ?> registered users </div>
 <div class="card-body" >  	<ul class="list-unstyled latest-users">
								<?php
									if (! empty($latestUsers)) {
										foreach ($latestUsers as $user) {
											echo '<li>';
												echo $user['username'];
												echo '<a href="members.php?do=edit&id=' . $user['userId'] . '">';
													echo '<span class="btn btn-success mx-sm-2 ">';
														echo '<i class="fa fa-edit"></i> Edit';
													
														if ($user['regStatus'] == 0) {
															echo "<a 
																	href='members.php?do=Activate&id=" . $user['userId'] . "' 
																	class='btn btn-info float-end  activate'>
																	<i class='fa fa-check'></i> Activate</a>";
														}
														echo '</span>';
												echo '</a>';
											echo '</li>';
										}
									} else {
										echo 'There\'s No Members To Show';
									}
								?>
								</ul></div>
</div>
</div>
<div class ="col-sm-6">
						<div class="card">
							<div class="card-title">
 <i class="fa fa-tag "></i>  lastest items </div>
 <div class="card-body" > test </div>
</div>
</div>
</div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Panel Heading</div>
  <div class="panel-body">Panel Content</div>
   <div class="panel-footer">
             <button class="btn btn-success">test</button>
           </div>   
</div>


<?php
 include $tbl . "footer.php"; 



}

else{
   // if he enters from differnt browser by writting the href without logging in
	header("location:index.php"); 
	exist();
}