<?php
include 'includes/Authenticate.php';


if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
	{
		if($_POST['userType']=="student")
		{
		$status = '';
		$name = htmlspecialchars(trim($_POST['name']));
		$emailid = htmlspecialchars(trim($_POST['email']));
		$password = htmlspecialchars(trim($_POST['password']));
		$college = htmlspecialchars(trim($_POST['college']));
		$phoneno = htmlspecialchars(trim($_POST['phoneno']));
		$dob = htmlspecialchars(trim($_POST['dob']));
		$type=htmlspecialchars(trim($_POST['userType']));

		$fields = array($name,$emailid,$password,$college,$phoneno,$dob);
        }
		if($_POST['userType']=="institution")
		{
			$status = '';
		$name = htmlspecialchars(trim($_POST['insName']));
		$emailid = htmlspecialchars(trim($_POST['email']));
		$password = htmlspecialchars(trim($_POST['password']));
		$address = htmlspecialchars(trim($_POST['address']));
		$phoneno = htmlspecialchars(trim($_POST['phoneno']));
		$type=htmlspecialchars(trim($_POST['userType']));
		$fields = array($name,$emailid,$password,$address,$phoneno);
		}
		if (Authenticate::areFieldsFilled($fields,$type))
		{
				$isRegistrationSuccessful =User::register($fields,$type);
                
				if ($isRegistrationSuccessful === DatabaseManager::PRIMARY_KEY_VIOLATED)
					$status = "Email Id already Exists!";
				elseif ($isRegistrationSuccessful === DatabaseManager::INSERT_SUCCESS)
				{
					if (Authenticate::login($emailid,$password))
						Authenticate::redirect();
				}

				else
					$status =$isRegistrationSuccessful;
			
		}
		else
		   $status = 'Please fill up the form correctly!';
		
	}
class User
{
    public static function register($fields,$type)
    {
        $db = DatabaseManager::getConnection();
		if($type=="student")
		{
          $query = 'INSERT into users(name,email,phoneno,college,password,dob) VALUES(:name,:email,:phoneno,:college,:password,:dob)';
		  $bindings = array(

            'name' => $fields[0],
            'email' => $fields[1],
            'college' => $fields[3],
            'phoneno' => $fields[4],
            'dob' => $fields[5],
            'password' => $fields[2]

        );
		}
	    if($type=="institution")
		{
			$query = 'INSERT into institution(name,email,phoneno,address,password) VALUES(:name,:email,:phone,:address,:password)';
			$bindings = array(
				'name' => $fields[0],
				'email' => $fields[1],
				'password' => $fields[2],
				'address' => $fields[3],
				'phone' => $fields[4]
			);
		}
        

        return  $db->insert($query,$bindings);
    }
}

?>