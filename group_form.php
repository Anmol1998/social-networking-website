<?php
	session_start();
	require_once 'frnd.php';
	require_once 'groupb.php';
	$uname=$_SESSION['userName'];
	$friends=frndlist($uname);
	if(isset($_POST['create'])){
		$gname=$_POST['grp_name'];
		$gmembers=$_POST['mem_list'];
		if(count($gmembers)>2){
			group_create($uname, $gname, $gmembers);
		}
	}
?>
<html>
<head>
<title>Form</title>
</head>
<!--Initialising css folders-->
<link rel="stylesheet" href="cssr/materialize.css">
<!--Initialising javascript folders-->
<script type="text/javascript" src="js1/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js1/materialize2.js"></script>
<!--Initialising icon font-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<body>
<nav>
    <div class="nav-wrapper black">
      <div style="margin-left:20px"><a href="#" class="brand-logo">LNO2</a></div>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="home.php">Home</a></li>
      </ul>
    </div>
  </nav>
<div class="container">
<div class="row">
   <div class="col ">
		<h3>Group Name</h3>
	</div>
</div>
<div class="row">
    <form class="col s12" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="row">
			<div class="input-field col s8">
				<i class="material-icons prefix">supervisor_account</i>
				<input id="grp_name" type="text" class="validate" name="grp_name">
				<label for="grp_name">Group Name</label>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h3>Select Friends</h3>
			</div>
		</div>
		<?php 
			$i=0;
			foreach($friends as $fr){
				$query="SELECT firstname, lastname FROM members WHERE userName='$fr'";
				$res=mysql_query($query);
				$row=mysql_fetch_assoc($res);
				if($i%4==0){
					echo '<div class="row">';
				}
				if($i%4==0){
					echo '
						<div class="card col s2 m2 l2">
							<input type="checkbox" id="'.$i.'" name="mem_list[]" value="'.$fr.'"/>
							<label for="'.$i.'">'.$row["firstname"].' '.$row["lastname"].'</label>
						</div>';
				}else{
					echo '
						<div class="card col s2 m2 l2 offset-s1 offset-m1 offset-l1">
							<input type="checkbox" id="'.$i.'" name="mem_list[]" value="'.$fr.'"/>
							<label for="'.$i.'">'.$row["firstname"].' '.$row["lastname"].'</label>
						</div>';
				}
				$i=$i+1;
				if($i%4==0){
					echo '</div>';
				}
			}
			if($i%4!=0){
				echo '</div>';
			}
		?>
		<div class="row">
			<button class="btn waves-effect waves-light black col s4 offset-s4" id="create" type="submit" name="create">Create</button>
		</div>
	</form>
</div>
</div>
<footer class="page-footer black">
    <div class="container">
        <div class="row" style="margin-bottom: 0">
            <p class="grey-text text-lighten-4 center">Developed and Created by</p>
			<p class="grey-text text-lighten-4 center">Indian Society for Technical Education - VITU Chapter</p>
        </div>
    </div>
</footer>
</body>

<script>
$('#textarea1').val('New Text');
  $('#textarea1').trigger('autoresize');
</script>
<script>
 $(document).ready(function() {
    $('select').material_select();
  });
</script>
<script>
 $('select').material_select('destroy');
 </script>
</html>