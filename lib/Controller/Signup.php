<?php
    namespace MyApp\Controller;
    //namespaceが MyAppの Controller classを継承する。

    class Signup extends \MyApp\Controller {

        public function run() {
            //ログインしていなければログイン画面に飛ばす
            if($this->isLoggedIn()) {
                //login画面へ
                header("Location: " . _SITE_URL);
                exit;
            }
            //ポストされてきた内容を確認
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->postProcess();
            }
        }

        protected function postProcess(){
            //validate
            try{
                $this->_validate();
            }catch(\MyApp\Exception\InvalidEmail $e){
                //echo $e->getMessage();
                //exit;
                $this->setErrors('email',$e->getMessage());
            }catch(\MyApp\Exception\InvalidPassword $e){
//                echo $e->getMessage();
//                exit;
                $this->setErrors('password',$e->getMessage());
            }

            $this->setValues('email',$_POST['email']);

            if($this->hasError()){
                return;
            }else{
                //create user

                //同じE-mailが登録された場合を想定してtry,catchで囲む。エラーが出た場合は DupulicateEmailインスタンスを作成。
                try{
                    $userModel = new \MyApp\Model\User();
                    $userModel->create([
                        'email' => $_POST['email'],
                        'password' => $_POST['password']
                    ]);
                }catch(\MyApp\Exception\DupulicateEmail $e){
                    $this->setErrors('email',$e->getMessage());
                    return;
                }

                //redirect to login
                header('Location: ' . _SITE_URL . "/login.php");
                exit;
            }
        }

        private function _validate(){
            if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
                echo "Invalid token!!";
                exit;
            }

            //渡ってきた内容がemailかどうかを判定してくれる。
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                throw new \MyApp\Exception\InvalidEmail();
            }

            //passwordは英数小文字から始まるもののみ受け付ける。
            if (!preg_match('/\A[a-zA-Z0-9]+\z/',$_POST['password'])){
                throw new \MyApp\Exception\InvalidPassword();
            }
        }
    }
?>