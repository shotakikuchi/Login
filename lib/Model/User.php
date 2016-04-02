<?php

namespace MyApp\Model;

class User extends \MyApp\Model
{
    /**
     * @param $values
     * @throws \MyApp\Exception\DupulicateEmail
     */
    public function create($values)
    {
        $stmt = $this->db->prepare("insert into users (email, password, created, modified) values (:email, :password, now(), now())");
        $res = $stmt->execute([
            ':email' => $values['email'],
            ':password' => password_hash($values['password'], PASSWORD_DEFAULT)
        ]);
        //emailはユニークキーなので重複しているとエラーが帰り$resがfalseになる。
        if ($res === false) {
            throw new \MyApp\Exception\DupulicateEmail();
        }
    }

    /**
     * @param $values
     * @return mixed
     * @throws \MyApp\Exception\DupulicateEmail
     * @throws \MyApp\Exception\UnmatchEmailOrPassword
     */
    public function login($values)
    {
        //passwordはhash化してDBに保存してあるので、ここではemailが一致するかで検索する。
        //hash化したpasswordとPOSTで渡されたpasswordを比べるのは下のほうにあるpassword_verifyメソッドで調べている。
        $stmt = $this->db->prepare("select * from users where email = :email");
        $res = $stmt->execute([
            ':email' => $values['email']
        ]);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');

        $user = $stmt->fetch();

        if (empty($user)) {
            throw new \MyApp\Exception\UnmatchEmailOrPassword();
        }

        //hash化したpasswordは以下のようにすれば元のpasswordと比較できる
        if (!password_verify($values['password'], $user->password)) {
            echo $values['password'];
            throw new \MyApp\Exception\UnmatchEmailOrPassword();
        }

        //emailはユニークキーなので重複しているとエラーが帰り$resがfalseになる。
        if ($res === false) {
            throw new \MyApp\Exception\DupulicateEmail();
        }
        return $user;
    }

    /**
     * @return array
     */
    public function findAll() {
        $stmt = $this->db->query("select * from users order by id");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        return $stmt->fetchAll();
    }
}
