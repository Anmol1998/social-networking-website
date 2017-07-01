<?php
	include_once 'dbconnect.php';
	include_once 'groupb.php';
	include_once 'frnd.php';
	function generate_pid(){
		return sprintf('%04x%04x%04x%04x',mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff));
	}
	function post_create($uname,$caption,$img,$bold,$grps){
		//uname = user who created post; $caption=caption of post; $img=posted image; $grps=groups to share with;
		$flag=0;
		do{
			$pid=generate_pid();
			$query="SELECT group_id FROM groups WHERE group_id='$gid'";
			$res=mysql_query($query);
			if(mysql_num_rows($res)==0){
				$flag=1;
			}
		}while($flag==0);
		$grps=implode(';',$grps); //string of groups
		if($bold=='on'){
			$bold=1;
		}else{
			$bold=0;
		}
		$query="INSERT INTO posts(id,postperson,postgroups,image,caption,bold) VALUES ('$pid','$uname','$grps','$img','$caption','$bold')";
		$res=mysql_query($query);
		if($res){
			header('Location: groups.php');
		}else{
			return 'Something went Wrong';
		}
	}
	function post_show($uname){
		$grps=group_show($uname);
		$postsav=array();//posts available to user
		$query='SELECT id,postgroups FROM posts';
		$res=mysql_query($query);
		if($res){
			while($row=mysql_fetch_assoc($res)){
				$result=explode(';', $row['postgroups']);
				if(count(array_intersect($grps,$result))>0){
					array_push($postsav,$row['id']);
				}
			}
			return $postsav;
		}else{
			return "Something went Wrong..";
		}
	}
?>