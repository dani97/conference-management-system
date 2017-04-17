<?php
session_start();
include 'Database.php';
$_SESSION['allow'] = 'true';
class Authenticate
{

    public static function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }

    public static function login($useremail,$password)
    {

        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT * FROM users WHERE email = :useremail AND password = :password';
        $bindings = array(
            'useremail' => $useremail,
            'password'  => $password
        );
        $result = $db->select($queryString,$bindings);
        if ($result != false)
        {
             
            $_SESSION['username'] = $result[0]['name'];
            $_SESSION['emailid'] = $result[0]['email'];
            $_SESSION['phoneno'] = $result[0]['phoneno'];
            $_SESSION['college'] = $result[0]['college'];
			$_SESSION['type'] = "STUDENT";
            return isset($_SESSION['username']);
        }

        return false;
    }
	
	public static function ilogin($useremail,$password)
    {

        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT * FROM institution WHERE email = :useremail AND password = :password';
        $bindings = array(
            'useremail' => $useremail,
            'password'  => $password
        );
        $result = $db->select($queryString,$bindings);
        if ($result != false)
        {
             
            $_SESSION['insname'] = $result[0]['name'];
            $_SESSION['emailid'] = $result[0]['email'];
            $_SESSION['phoneno'] = $result[0]['phoneno'];
            $_SESSION['address'] = $result[0]['address'];
			$_SESSION['type'] = "INSTITUITION";
            return isset($_SESSION['insname']);
        }

        return false;
    }





    public static function redirect()
    {
        //redirect to the admin if the userType is admin else to student if the user type is user
        if (self::getUserType() === "STUDENT") {
            header('Location: http://'.$_SERVER['SERVER_NAME'].'/conference.com/student/index.php');
            exit(0);
            return;
        }
        else if (self::getUserType() === "INSTITUITION")
        {
            header('Location: http://'.$_SERVER['SERVER_NAME'].'/conference.com/institution/index.php');
            exit(0);
            return;
        }
		else if (self::getUserType() === "ADMIN")
        {
            header('Location: http://'.$_SERVER['SERVER_NAME'].'/conference.com/admin/index.php');
            exit(0);
            return;
        }
        else {
            header('Location: http://'.$_SERVER['SERVER_NAME'].'/conference.com/');
            exit(0);
            return;
        }
    }

    public static function getUserType()
        {
            return $_SESSION['type'];

        }
    public static function logout()
    {
        $serverURL = $_SERVER['SERVER_NAME'];
        session_start();
        session_destroy();
        $_SESSION = array();
        header('Location: http://'.$_SERVER['SERVER_NAME'].'/conference.com/');
        exit(0);
    }

    public static function areFieldsFilled($fields)
    {
        $flag = true;
        foreach($fields as $fieldItem)
        {
            if(!isset($fieldItem))
                $flag = false;

        }
        return $flag;
    }

    public static function preventUnauthorisedLogin()
    {
        //check whether the user is logged in or not,
        if (!self::isLoggedIn())
        {
            Authenticate::logout();
        }
//protects the student section
            //self::redirect();


    }




}