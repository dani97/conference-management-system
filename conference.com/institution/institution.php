<?php
include '../includes/Authenticate.php';
class Institution
{
	public function addConference($fields)
	{
		if(Authenticate::getUserType()==="INSTITUITION")
		{
			$db = DatabaseManager::getConnection();
			$queryString = "insert into conference (name,city,date,url,comments,institution) values(:name,:venue,:date,:url,:comments,:institution)";
			$bindings = array(
            'name'=>$fields[0],
			'venue'=>$fields[1],
			'date'=>$fields[2],
			'url'=>$fields[3],
			'comments'=>$fields[4],
			'institution'=>$_SESSION['insname']
            );
			$s=$db->insert($queryString,$bindings);
			if($s)
				$status="conference added successfully";
			else
				$status="Problem in adding Conference";
		}
		else
		{
			$status = "Illegal Access";
			Authenticate::redirect();
		}
		return $status;
		
	}
	
	public function deleteConference($field,$field1)
	{
		if(Authenticate::getUserType()==="INSTITUITION")
		{
			$db = DatabaseManager::getConnection();
				$queryString = "delete from conference where id=:id";
			$bindings = array(
				'id'=> $field
				);
			$s = $db->delete($queryString,$bindings);
			if($s)
				$status="conference deleted successfully";
			else
				$status="Problem in deleting Conference";
		}
		else
		{
			$status = "Illegal Access";
			Authenticate::redirect();
		}
		return $status;
	}
	public function showConference($fields,$fields1)
	{
		if(Authenticate::getUserType()==="INSTITUITION")
		{
			$db = DatabaseManager::getConnection();
				$queryString = "select * from conference where institution=:institution order by date asc ";
			$bindings = array(
				'institution' => $_SESSION['insname']
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