<?php

function ShowContent()
{
    echo '
	
	<h2 align="center">Профиль</h2>
		

	';
    echo $_SESSION['USER_ID'] . '<br>' .
        $_SESSION['USER_LOGIN'] . '<br>' .
        $_SESSION['USER_NAME'] . '<br>' .
        $_SESSION['USER_DATEREG'] . '<br>' .
        $_SESSION['USER_EMAIL'] . '<br>' .
        $_SESSION['USER_RANK'] . '<br>'.
        $_SESSION['USER_BYEAR'].'<br>';
};

include ROOTDIR.'/layers/head.php';
include ROOTDIR.'/layers/footer.php';
new Reg;

?>


