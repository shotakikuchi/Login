<?php

require_once(__DIR__ . "/../config/config.php");
if($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        echo "Invalid token!!";
        exit;
    }
    $_SESSION['me'] = [];

    //phpではSESSIONの管理にCOOKIEを使うのでCOOKIEも削除する
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(), "", time() - 86400, "/");
    }
    session_destroy();

    header("Location:"._SITE_URL);
}
?>

