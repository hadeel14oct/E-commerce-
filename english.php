<?php
function lang ($phrase){
	static $lang = array (
		'queen' => 'hadeel',
		'hardwork' => 'hadoosh ',
		'cat' => 'categories ');

	 return $lang[$phrase];//before nav and header in initi
} 