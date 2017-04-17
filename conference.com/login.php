<?php 

include 'includes/Authenticate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' )
{

	
	if (!empty($_POST['email']) && !empty($_POST['password']))
	{
		$useremail = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);
		$type = htmlspecialchars($_POST['userType']);
		echo $type;
			//validate user and password from the database
			if($type=="student")
					if(Authenticate::login($useremail,$password))
					{
						Authenticate::redirect();
						unset($status);
					}
				
					else
					{
						$status = 'Invalid Login Credentials !';
					}
			if($type=="institution")
				if(Authenticate::ilogin($useremail,$password))
					{
						Authenticate::redirect();
						unset($status);
					}
				
					else
					{
						$status= 'Invalid Login Credentials ' ;
					}
				


	}
	else
		//the user has submitted empty form .Notify :Empty Form Submitted
	$status = 'Empty Form Submitted!';
}

?>
