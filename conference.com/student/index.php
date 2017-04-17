<?php
include 'student.php';
$rows = Student::showConference();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Conference.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Set black background color, white text and some padding */
	body{
	background:url(../Conference.jpg) no-repeat center fixed;
	background-size:cover;
	
	}
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="searchplace.html">Search by Place</a></li>
		<li><a href="searchinsti.html">Search by Institution</a></i>
      </ul>
      <form class="navbar-form navbar-right" role="search" action="search.php" method="post">
        <div class="form-group input-group">
          <input type="text" class="form-control" name="search" placeholder="Search..">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container text-center">
  <div class="row">
    <div class="col-sm-4 well">
      <div class="well">
        <p><a href="#"><?php echo $_SESSION['username']?></a></p>
        <img src="../assets/img/student.png" class="img-circle" height="65" width="65" alt="Avatar">
      </div>
      <div class="well">
        <p><a href="#">Profile</a></p>
        <p>
          <span class="label label-default"></span>
          <span class="label label-primary"><?php echo $_SESSION['emailid']?></span></br>
          <span class="label label-success"><?php echo $_SESSION['phoneno']?></span></br>
          <span class="label label-warning"><?php echo $_SESSION['college']?></span></br>

        </p>
      </div>
    </div>
    <div class="col-sm-8">
    
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default text-left">
            <div class="panel-body">
              <h1 style="font-style:oblique;font-family:'Trebuchet MS', Helvetica, sans-serif">CONFERENCE.com</h1>
            </div>
          </div>
        </div>
      </div>
      <?php 
	  if($rows)
	  foreach ($rows as $row)
	  {
      echo"<div class='row'>
        <div class='col-sm-12'>
          <div class='well'>
		  <a href='".$row['url']."'>
            <h3><strong> ".$row['name']."</strong></h3> <p> by ".$row['institution']." </p> <p>on ".$row['date']." at ".$row['city']."</a></br>
          </div>
        </div>
      </div>
    
	  }";
	  }
	  ?>
</div>
  </div>
</div>

<footer class="container-fluid text-center">
<ul class="pager">
  <?php 
  /*$db = DatabaseManager::getConnection();
 $sql = "SELECT COUNT(ID) AS total FROM conference";
$result =$db->select($sql);
$total_pages = ceil($row["total"] / $results_per_page);
for ($i=1; $i<=$total_pages; $i++) { 
    echo "<li><a href='index.php?page=".$i."'>".$i."</a><li> ";  
}; */
?>
</ul>
</footer>

</body>
</html>

