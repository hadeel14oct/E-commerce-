<?php//for cat all fun del ins add edit update
$do ="";
$do =isset($_GET["do"])? $_GET["do"]:"manage" ;//no do in href


if($do=="manage"){
echo "welcom youre in manage catgories page";
echo '<a href="page.php?do=add">add new category  </a> ';
}
else if($do=="add"){

}
//else if($do=="add"){
//	}
else if($do=="insert"){
}

else {
		echo "error no page with that name";
	}