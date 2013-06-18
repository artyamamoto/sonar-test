<?php
// phpunit-skelgen --bootstrap tests/bootstrap.php --test -- Ab_Utils_String "$(pwd)/src/lib/library/Ab/Utils/String" Ab_Utils_StringTest "$(pwd)/tests/Ab_Utils_StringTest.php"


if (!is_array($argv) && count($argv) <= 2) 
	die("class is required.\n");
array_shift($argv);

$pwd = dirname(__FILE__);
$class = array_shift($argv);
$path = str_replace("/","_", $class);
$cmd = sprintf("phpunit-skelgen --bootstrap %s/tests/bootstrap.php --test -- %s %s/src/lib/library/%s %sTest %s/tests/%sTest.php\n" ,
				$pwd, $class, $pwd,$path, $class, $pwd,$class);
echo $cmd;
