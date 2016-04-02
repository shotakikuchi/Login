<?php
namespace MyApp\Controller;
//namespaceが MyAppの Controller classを継承する。

class Login extends \MyApp\Controller
{
    /**
     *
     */
    public function run()
    {
        //ログインしてたらHome画面に飛ばす
        if ($this->isLoggedIn()) {
            //login画面へ
            header("Location: " . _SITE_URL);
            exit;
        }
        //ポストされてきた内容を確認
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->postProcess();
        }
    }

    /**
     * @throws \MyApp\Exception\DupulicateEmail
     */
    protected function postProcess()
    {
        //validate
        try {
            $this->_validate();
        } catch (\MyApp\Exception\EmptyPost $e) {
            $this->setErrors('login', $e->getMessage());
        }
        $this->setValues('email', $_POST['email']);

        if ($this->hasError()) {
            return;
        } else {
            //create user

            try {
                $userModel = new \MyApp\Model\User();
                $user = $userModel->login([
                    'email' => $_POST['email'],
                    'password' => $_POST['password']
                ]);
            } catch (\MyApp\Exception\UnmatchEmailOrPassword $e) {
                $this->setErrors('login', $e->getMessage());
                return;
            }

            //login処理
            //セッションハイジャック対策
            session_regenerate_id(true);
            $_SESSION['me'] = $user;

            //redirect to home
            header('Location: ' . _SITE_URL);
            exit;
        }
    }

    /**
     * @throws \MyApp\Exception\EmptyPost
     */
    private function _validate()
    {
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            echo "Invalid token!!";
            exit;
        }

        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            echo "Invalid form!!";
            exit;
        }

        if ($_POST['email'] === "" || $_POST['password'] === "") {
            throw new \MyApp\Exception\EmptyPost();
        }
    }
}

?>