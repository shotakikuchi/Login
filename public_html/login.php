<?php
//ログイン
require_once(__DIR__ . "/../config/config.php");

//MyAppは全体の名前空間 , ControllerやModelはその下のサブ名前空間
$app = new MyApp\Controller\Login();
//ユーザー一覧の情報を取ってくる
$app->run();

//echo "login screen";
//exit;
?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="container">
    <form action="" method="post" id="login">
        <p>
            <input type="text" name="email" placeholder="email"
                   value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ""; ?>">
        </p>
        <p>
            <input type="password" name="password" placeholder="password">
        </p>
        <p class="err"><?= h($app->getErrors('login')); ?></p>
        <div class="btn" onclick="document.getElementById('login').submit();">Log in</div>

        <p class="fs12"><a href="./signup.php">Sign Up</a></p>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
</div>

</body>
</html>