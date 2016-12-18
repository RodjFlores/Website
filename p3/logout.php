<?php
	include_once 'dbconfig.php';

	session_destroy();
    unset($_SESSION['user_session']);

    $user->redirect('index.php');
?>