<?php
    //ログインをしていたらユーザーの一覧を表示
    require_once (__DIR__ . "/../config/config.php");

    //MyAppは全体の名前空間 , ControllerやModelはその下のサブ名前空間
    $app = new MyApp\Controller\Index();
    //ユーザー一覧の情報を取ってくる
    $app->run();

?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>HOME</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="container">
    <form action="logout.php" method="post" id="logout">
        <?= h($app->me()->email); ?>
<!--        taguchi@gmail.com-->
        <input type="submit" value="Logout">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <h1>User <span class="fs12"><?= count($app->getValues()->users); ?></span></h1>
    <ul>
        <?php foreach($app->getValues()->users as $user): ?>
        <li> <?= h($user->email); ?></li>
        <?php endforeach; ?>
    </ul>

</div>

</body>
</html>
