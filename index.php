<?php
session_start();

	require_once("perpage.php");	
	require_once("dbcontroller.php");
	$db_handle = new DBController();
	
	$username = "";
	
	$queryCondition = "";
	if(!empty($_POST["search"])) {
		foreach($_POST["search"] as $k=>$v){
			if(!empty($v)) {

				$queryCases = array("username");
				if(in_array($k,$queryCases)) {
					if(!empty($queryCondition)) {
						$queryCondition .= " AND ";
					} else {
						$queryCondition .= " WHERE ";
					}
				}
				switch($k) {
					case "username":
						$username = $v;
						$queryCondition .= "username LIKE '" . $v . "%'";
						break;
				}
			}
		}
	}
	$orderby = " ORDER BY id asc"; 
	if (!empty($_POST["uAsc"])) {
		$_SESSION['ordered']  = " ORDER BY username asc"; 
	}
	else if (!empty($_POST["uDesc"])) {
		$_SESSION['ordered'] = " ORDER BY username desc"; 
	}
	else if (!empty($_POST["eAsc"])) {
		$_SESSION['ordered'] = " ORDER BY email asc"; 
	}
	else if (!empty($_POST["eDesc"])) {
		$_SESSION['ordered'] = " ORDER BY email desc"; 
	}
	else if (!empty($_POST["sAsc"])) {
		$_SESSION['ordered'] = " ORDER BY status asc"; 
	}
	else if (!empty($_POST["sDesc"])) {
		$_SESSION['ordered'] = " ORDER BY status desc"; 
	}
	
	if ( isset( $_SESSION['ordered'] ) ) {
        $orderby =   $_SESSION['ordered'];
	 }


	$sql = "SELECT * FROM toy " . $queryCondition;
	$href = 'index.php';					
		
	$perPage = 3; 
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	$start = ($page-1)*$perPage;
	if($start < 0) $start = 0;
		
	$query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
	$result = $db_handle->runQuery($query);
	
	if(!empty($result)) {
		$result["perpage"] = showperpage($sql, $perPage, $href);
	}
?>
<html>
	<head>
	<title></title>
<link href="styles.css" type="text/css" rel="stylesheet" />

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<style>

</style>
	</head>
	<body>
		
	<nav class="navbar navbar-expand-lg navbar-light bg-primary">
	  <a class="navbar-brand" href="index.php">List Tasks</a>
	 
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="nav navbar-nav ml-auto">
	      <li class="nav-item active">
	      	<?php
	      	    if ( isset( $_SESSION['user'] ) ) { ?>
                   <a class="nav-link" href="loqout.php" style="color: white">Log Out</a>
	      	    <?php   
            } else { ?>
            	<a class="nav-link" href="login.php" style="color: white">Login</a>
            <?php }
	      	?>
	        
	      </li>
	    </ul>
	</div>
	</nav>

    <div id="toys-grid">      
			<form name="frmSearch" method="post" action="index.php">

            <div class="container">   
            	<div style="text-align:right;margin:20px 0px 10px;">
		            <a id="btnAddAction" href="add.php">Add New</a>
		       </div>
            	<div class="">
            		<div class="search-box">
			          <p>
			          	<input type="text" placeholder="Username" name="search[username]" class="demoInputBox" value="<?php echo $username; ?>"	/>
				       <input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='index.php'"></p>
			        </div> 
            	</div>
			
			  <table class="table table-striped" cellpadding="10" cellspacing="1">
			    <thead>
			      <tr>
			        <th>Username <input type="submit" value="asc" name="uAsc" class="btn btn-primary">
			        	         <input type="submit" value="desc" name="uDesc" class="btn btn-success"></th>
		            <th>Email    <input type="submit" value="asc" name="eAsc" class="btn btn-primary">
			        	         <input type="submit" value="desc" name="eDesc" class="btn btn-success"></th>          
		            <th>Text</th>
					<th>Status   <input type="submit" value="asc" name="uAsc" class="btn btn-primary">
			        	         <input type="submit" value="desc" name="uDesc" class="btn btn-success"></th>
					<?php
	      	         if ( isset( $_SESSION['user'] ) ) { 
                         echo "<th>Action</th>";
	      	         } ?>
	      	    	 
	      	        
			      </tr>
			    </thead>
			    <tbody>
					<?php
					if(!empty($result)) {
						foreach($result as $k=>$v) {
						  if(is_numeric($k)) {
					?>
                    <tr>
						<td><?php echo $result[$k]["username"]; ?></td>
	                     <td><?php echo $result[$k]["email"]; ?></td>
						<td><?php echo $result[$k]["text"]; ?></td>
						<td style="color: green"><?php echo $result[$k]["status"]; ?>
							<?php echo $result[$k]["changed"]; ?>
						</td> 
					<?php
	      	         if ( isset( $_SESSION['user'] ) ) { ?>
                        <td>
                        	<input id="cb" type="checkbox" onchange="window.location.href='confirm.php?action=delete&id=<?php echo $result[$k]["id"]; ?>'">
						   <a class="btnEditAction" href="edit.php?id=<?php echo $result[$k]["id"]; ?>">Edit</a> 
						   <a class="btnDeleteAction" href="delete.php?action=delete&id=<?php echo $result[$k]["id"]; ?>">Delete</a>
						</td>
	      	        <?php } ?>

					</tr>
					<?php
						  }
					   }
                    }
					if(isset($result["perpage"])) {
					?>
					<tr>
					<td colspan="2" align=right> <?php echo $result["perpage"]; ?></td>
					</tr>
					<?php } ?>
				<tbody>
			  </table>
			</div>





			</form>	
		</div>
	</body>
</html>