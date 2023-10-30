<?php
// session_start();
// session_unset();
// session_destroy();
// header("Location: index.php");
// exit;

session_start();
if (isset($_GET['tab_closed']) && $_GET['tab_closed'] == "true") {
    session_unset();
    session_destroy();
    session_unset();
    session_destroy();
}
header("Location: index.php");
exit;

?>
