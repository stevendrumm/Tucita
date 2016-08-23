<?php
	session_start();
	unset($_SESSION['usuario']);
	unset($_SESSION['contrasena']);
	session_destroy();
?>
<script>alert('Has salido.');window.location='../index.php';</script>