<?php
    namespace MyApp\Controller;

    //namespaceが MyAppの Controller classを継承する。
    class Index extends \MyApp\Controller {

        public function run() {
            //ログインしていなければログイン画面に飛ばす
            if(!$this->isLoggedIn()) {
                //login画面へ
                header("Location: " . _SITE_URL . "/login.php");
                exit;
            }
            //ログイン済みなので、ユーザー情報を取得
            // get users info
            $userModel = new \MyApp\Model\User();
            $this->setValues('users', $userModel->findAll());
        }
    }
?>