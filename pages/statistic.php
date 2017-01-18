<?php

function ShowContent() {
	echo '
	
	<h2 align="center">Статистика</h2>
		

	';
};

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

echo $_SESSION['USER_ID'];

$aaa = new Stat();
$aaa->db('SELECT * FROM statdata WHERE userid = '.$_SESSION['USER_ID'].' ORDER BY date DESC');

echo '<pre>';
print_r($aaa->result[1]);
echo '</pre>';


?>


