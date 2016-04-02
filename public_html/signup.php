<?php
//ログイン
require_once(__DIR__ . "/../config/config.php");

//MyAppは全体の名前空間 , ControllerやModelはその下のサブ名前空間
$app = new MyApp\Controller\Signup();
//ユーザー一覧の情報を取ってくる
$app->run();
?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>SignUp</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="container">
    <form action="" method="post" id="signup">
        <p>
            <input type="text" name="email" placeholder="email"
                   value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ""; ?>">
        </p>

        <p class="err"><?= h($app->getErrors('email')); ?></p>

        <p>
            <input type="password" name="password" placeholder="password">
        </p>

        <p class="err"><?= h($app->getErrors('password')); ?></p>

        <div class="btn" onclick="document.getElementById('signup').submit();">登録</div>
        <p class="fs12">
            <a href="login.php">login</a>
        </p>

        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">

    </form>
</div>

</body>
</html>