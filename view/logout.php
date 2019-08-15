<?php

	session_start();
    if (isset($_SESSION['user_id'])) {

    	session_destroy();
    	unset($_SESSION['user_id']);
    	header("Location: viewLogin.php");

    }

?>