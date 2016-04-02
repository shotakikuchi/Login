<?php
namespace MyApp\Exception;
/**
 * Created by PhpStorm.
 * User: kikuchishota
 * Date: 2016/02/11
 * Time: 21:58
 */
class InvalidPassword extends \Exception{
    protected $message = "Invalid Password";
}