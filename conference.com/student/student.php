<?php
include '../includes/Authenticate.php';
class Student
{
	public function showConference()
	{
		if(Authenticate::getUserType()==="STUDENT")
		{
			$db = DatabaseManager::getConnection();
				$queryString = "select * from conference order by date asc";
			$s = $db->select($queryString);
			if($s==false)
				$status="No results";
			else
				$status="Results found";
		}
		else
		{
			$status = "Illegal Access";
			Authenticate::redirect();
		}
		return $s;
	}
	
	public function sortbyCity($fields)
	{
		if(Authenticate::getUserType()==="STUDENT")
		{
			$db = DatabaseManager::getConnection();
			$queryString = "select * from conference where city like '%:city%' by date asc";
			$bindings = array(
				'city' => $fields
			);
			$s = $db->select($queryString,$bindings);
			if($s==false)
				$status="No results";
			else
				$status="Results found";
		}
		else
		{
			$status = "Illegal Access";
			Authenticate::redirect();
		}
		return $s;
			
	}
	
	public function sortbyInstitute($fields)
	{
		if(Authenticate::getUserType()==="STUDENT")
		{
			$db = DatabaseManager::getConnection();
			$queryString = "select * from conference where institution like '%:institute%' by date asc";
			$bindings = array(
				'institute' => $field
			);
			$s = $db->select($queryString,$bindings);
			if($s==false)
				$status="No results";
			else
				$status="Results found";
		}
		else
		{
			$status = "Illegal Access";
			Authenticate::redirect();
		}
		return $s;
			
	}
}
?>