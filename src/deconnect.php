<?php
// filepath: /c:/laragon/www/private/src/deconnect.php

session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the dashboard
header("Location: ../index.php");
exit();
?>