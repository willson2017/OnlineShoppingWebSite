<?php
session_start();
if (isset($_SESSION['loginflag']) && ($_SESSION['loginflag'] == 1))
{
    $_SESSION['loginflag'] = 0;
    header("Location: ./index.php");
    session_destroy();
}
?>

