<?php
//デバック表示
define("_DEBUG_MODE",false);

//1にしておくと、ブラウザのほうにエラーを表示してくれる。
ini_set("display", 1);

//データベース接続ユーザー名
define("_DB_USER","dbuser");

//データベース接続パスワード
define("_DB_PASS","password");

//データベースホスト名
define("_DB_HOST","localhost");

//データベース名
define("_DB_NAME","sampledb");

//データベースの種類
define("_DB_TYPE","mysql");

//データソースネーム
define("_DSN",_DB_TYPE .":host="._DB_HOST .";dbname=". _DB_NAME.";charset=utf8");
// "_DSN" -> "mysql:host=localhost;dbname=sampledb;charset=utf8"

//サイトURL
define("_SITE_URL", "http://" . $_SERVER['HTTP_HOST']);

require_once (__DIR__."/../lib/functions.php");
require_once (__DIR__."/autoload.php");

session_start();