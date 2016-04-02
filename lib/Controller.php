<?php
namespace MyApp;

class Controller
{

    private $_errors;

    private $_values;

    public function __construct()
    {
        if(!isset($_SESSION['token'])){
            //32桁の推測されにくい文字列を作成
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
        }
        //phpデフォルトのクラス 宣言することなくいきなりnewして使うことができる特殊なオブジェクト
        $this->_errors = new \stdClass();
        $this->_values = new \stdClass();
    }

    protected function setValues($key, $value)
    {
        $this->_values->$key = $value;
    }

    public function getValues()
    {
        return $this->_values;
    }

    protected function setErrors($key, $value)
    {
        $this->_errors->$key = $value;
    }

    public function getErrors($key)
    {
        return isset($this->_errors->$key) ? $this->_errors->$key : "";
    }

    protected function hasError()
    {
        return !empty(get_object_vars($this->_errors));
    }

    protected function isLoggedIn()
    {
        return isset($_SESSION['me']) && !empty($_SESSION['me']);
    }

    public function me(){
        return $this->isLoggedIn() ? $_SESSION['me'] : null;
    }
}

?>