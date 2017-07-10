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
	function check_emoji($pid, $uname){
		$query="SELECT * FROM posts WHERE id='$pid'";
		$res=mysql_query($query);
		if($res){
			$row=mysql_fetch_assoc($res);
			if(in_array($uname,explode(';',$row['like']))){
				return 'like';
			}else if(in_array($uname,explode(';',$row['love']))){
				return 'love';
			}else if(in_array($uname,explode(';',$row['haha']))){
				return 'haha';
			}else if(in_array($uname,explode(';',$row['wow']))){
				return 'wow';
			}else if(in_array($uname,explode(';',$row['sad']))){
				return 'sad';
			}else if(in_array($uname,explode(';',$row['angry']))){
				return 'angry';
			}else{
				return '';
			}
		}
	}
	function update_reaction($pid,$uname,$value){
		$query="SELECT * FROM posts WHERE id='$pid'";
		$res=mysql_query($query);
		$row=mysql_fetch_assoc($res);
		
		if(in_array($uname,explode(';',$row['reactions'])) and $value==''){
			$emoji=check_emoji($pid,$uname);
			$row[$emoji]=implode(';',array_diff(explode(';',$row[$emoji]),array($uname)));
			$x=implode(';',array_diff(explode(';',$row[$emoji]),array($uname)));
			$query="UPDATE posts SET posts.$emoji='$row[$emoji]', reactions='$x' WHERE id='$pid'";
			$res=mysql_query($query);
			if($res){
				return "Reaction Updated";
			}else{
				return "Something went Wrong";
			}
		}else if(in_array($uname,explode(';',$row['reactions'])) and $value!=''){
			$emoji=check_emoji($pid,$uname);
			$row[$emoji]=implode(';',array_diff(explode(';',$row[$emoji]),array($uname)));
			$x=explode(';',$row[$value]);
			array_push($x,$uname);
			$row[$value]=implode(';',$x);
			$query="UPDATE posts SET posts.$emoji='$row[$emoji]', posts.$value='$row[$value]' WHERE id='$pid'";
			$res=mysql_query($query);
			if($res){
				return "Reaction Updated";
			}else{
				return "Something went Wrong";
			}
		}else{
			$x=explode(';',$row[$value]);
			array_push($x,$uname);
			$row[$value]=implode(';',$x);
			$x=explode(';',$row['reactions']);
			array_push($x,$uname);
			$x=implode(';',$x);
			$query="UPDATE posts SET posts.$value='$row[$value]', reactions='$x' WHERE id='$pid'";
			$res=mysql_query($query);
			if($res){
				return "Reaction Updated";
			}else{
				return "Something went Wrong";
			}
		}
	}
?>
