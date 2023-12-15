<?php
function gettitle(){
	global $pagetitle;
	if(isset($pagetitle)){
		echo $pagetitle;
	}else{
		echo "hadeel";
	}
}
function redirecthome ( $error ='' , $url = null , $sec = 3){//you  can write a specific url
	if ($url === null){
		$url='index.php';
		$link ="home page";
	}
	else {
		if(ISSET($_SERVER['HTTP_REFERER'])&& $_SERVER['HTTP_REFERER'] !==''){
				$url = $_SERVER['HTTP_REFERER'];
		$link ="previous page";
		}
	
	else {
		$url='index.php';
		$link ="home page";}
		}//may not error
	echo '<div class="alert ">'. $error .'</div>';
	echo '<div class="alert alert-info"> you will be directed to '.$link.' after'. $sec .'seconds </div>';//he didnt put dods
header("refresh:$sec;url=$url");
exit();
}

function checkitem ($select , $from , $value){
	global $con ;
	$stm = $con->prepare("SELECT $select from $from  where $select = ?");
	$stm -> execute (array($value));
		$count = $stm -> rowCount();
		return $count;


}
function countItems ($items , $table){
	global $con;
	$stm2 = $con->prepare("SELECT COUNT($items) from $table ");
		$stm2 ->  execute();
		return 		$stm2 ->  fetchColumn();
}
function getLatest($select, $table, $order, $limit = 5) {

		global $con;

		$getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

		$getStmt->execute();

		$rows = $getStmt->fetchAll();

		return $rows;

	}
	function creatingsqlhere () {
		global $con;

		$Stmt = $con->prepare(
	"CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT '0',
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$Stmt->execute();
$count = $Stmt -> rowCount();
		echo $count;
}

//-- Dumping data for table `items`


/*INSERT INTO `items` (`Item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`, `tags`) VALUES
(14, 'Speaker', 'Very Good Speaker', '$10', '2016-05-09', 'China', '', '1', 0, 1, 9, 28, ''),
(15, 'Yeti Blue Mic', 'Very Good Microphone Very Good Microphone', '$108', '2016-05-09', 'USA', '', '1', 0, 1, 9, 28, ''),
(16, 'iPhone 6s', 'Apple iPhone 6s', '$300', '2016-05-09', 'USA', '', '2', 0, 1, 10, 24, ''),
(17, 'Magic Mouse', 'Apple Magic Mouse', '$150', '2016-05-09', 'USA', '', '1', 0, 1, 9, 24, ''),
(18, 'Network Cable', 'Cat 9 Network Cable', '$100', '2016-05-09', 'USA', '', '1', 0, 1, 9, 25, ''),
(19, 'Game', 'Test Game For Item', '120', '2016-06-17', 'USA', '', '2', 0, 1, 9, 30, ''),
(20, 'iPhone 6s', 'iPhone 6s Very Cool Phone', '1500', '2016-06-17', 'USA', '', '2', 0, 1, 10, 30, ''),
(21, 'Hammer', 'A Very Good Iron Hammer', '30', '2016-06-17', 'China', '', '3', 0, 1, 12, 30, ''),
(22, 'Good Box', 'Nice Hand Made Box', '40', '2016-06-17', 'Egypt', '', '1', 0, 1, 8, 30, ''),
(23, 'Test Item', 'This Is Test Item To Test Approve Status', '100', '2016-06-17', 'Japan', '', '3', 0, 1, 8, 30, ''),
(24, 'Testing Item', 'Testing Description Testing Description', '120', '2016-06-17', 'Korea', '', '3', 0, 0, 10, 30, ''),
(25, 'Osama', 'Osama Osama Elzero Elzero', '100', '2016-06-17', 'Egypt', '', '3', 0, 1, 10, 30, ''),
(26, '12121212', '33333333333', '33333', '2016-06-17', '333333', '', '2', 0, 1, 11, 30, ''),
(27, 'My Item', 'My New Description', '12', '2016-06-17', 'Saudi Arabia', '', '1', 0, 1, 10, 30, 'Test, Discount, Elzero'),
(28, 'Wooden Game', 'A Good Wooden game', '100', '2016-07-25', 'Egypt', '', '1', 0, 1, 8, 30, 'Elzero, Hand, Discount, Gurantee'),
(29, 'Diablo III', 'Good Playstation 4 Game', '70', '2016-07-25', 'USA', '', '1', 0, 1, 17, 30, 'RPG, Online, Game'),
(30, 'Ys Oath In Felghana', 'A Good Ps Game', '100', '2016-07-25', 'Japan', '', '1', 0, 1, 17, 30, 'Online, RPG, Game');

//-- --------------------------------------------------------*/

