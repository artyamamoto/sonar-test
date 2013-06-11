<?php
header("Content-Type: text/html; Charset=UTF8");
echo 'aaa';
echo '<style>
body ,table,tr,th,td {
	font-size: 12px;
}
pre {
	background: #ccc;
	color:		#000;
	padding:	12px;
	margin:		12px;	
}
pre.error {
	background: #f00;
	color: white;
}
</style>';
function h($s) {
	return htmlspecialchars($s,ENT_QUOTES);
}
function _die($s) {
	printf('<pre class="error">%s</pre>', h($s));
}

echo '<table border="1">';
foreach(explode(" ","HTTP_X_FORWARDED_FOR HTTP_X_FORWARDED_PORT HTTP_X_FORWARDED_PROTO SERVER_NAME SERVER_ADDR SERVER_PORT REMOTE_ADDR RDS_HOSTNAME RDS_USERNAME RDS_PASSWORD RDS_DB_NAME RDS_PORT") as $_key) {
	printf('<tr><th>%s</th><td>%s</td></tr>',
		$_key, $_SERVER[$_key]);
}
echo '</table>';
//pr($_SERVER);

$db_dsns = array(
	array(
		sprintf("mysql:host=%s; dbname=", $_SERVER["RDS_HOSTNAME"], $_SERVER["RDS_DB_NAME"],$_SERVER["RDS_PORT"]),
		$_SERVER["RDS_USERNAME"], $_SERVER["RDS_PASSWORD"] , 
	),
);
pr("DB");
foreach($db_dsns as $dns) {
	try {
		pr($dns[0]);
		
		$pdo = new PDO($dns[0],$dns[1],$dns[2]);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$stmt = $pdo->query("SHOW MASTER STATUS;");
		while($r = $stmt->fetch()) {
			pr($r);
		}
	} catch(Exception $e) {
		_die($e->getMessage());
	}
}

?>
