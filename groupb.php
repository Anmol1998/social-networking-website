<?php
	include_once 'dbconnect.php';

	function generate_gid(){
		return sprintf('%04x%04x%04x%04x',mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff));
	}
	function group_create($uname,$gname,$gmember){
		//uname = user who created group; gname=group name; $gmember=array of group members
		$flag=0;
		do{
			$gid=generate_gid();
			$query="SELECT group_id FROM groups WHERE group_id='$gid'";
			$res=mysql_query($query);
			if(mysql_num_rows($res)==0){
				$flag=1;
			}
		}while($flag==0);
		array_push($gmember,$uname);
		$gmembers=implode(';',$gmember); //string of members
		$query="INSERT INTO groups(group_id,group_name,group_members,group_admin) VALUES ('$gid','$gname','$gmembers','$uname')";
		$res=mysql_query($query);
		if($res){
			foreach($gmember as $temp){
				$query="SELECT groups FROM members WHERE userName='$temp'";
				$res=mysql_query($query);
				if($res){
					$result=mysql_fetch_assoc($res);
					$result=$result['groups'];
					$result=explode(';',$result);
					array_push($result,$gid);
					$result=implode(';',$result);
					$query="UPDATE members SET groups='$result' WHERE userName='$temp'";
					$res=mysql_query($query);
				}
			}
			header('Location: groups.php');
		}else{
			return 'Something went Wrong';
		}
	}
	function group_addmember($gid,$uname,$gmember){
		//gid=group id; uname=user adding members; $gmember=array of members added;
		$query="SELECT * FROM groups WHERE group_id='$gid'";
		$res=mysql_query($query);
		if(mysql_num_rows($res)==1){
			$row=mysql_fetch_assoc($res);
			if($row['group_admin']==$uname){
				$gmembers=$row['group_members'];
				$gmembers=explode(';',$gmembers);
				$gmembers=array_unique(array_merge($gmembers,$gmember));
				$gmembers=implode(';',$gmembers);
				$query="UPDATE groups SET group_members='$gmembers' WHERE group_id='$gid'";
				$res=mysql_query($query);
				if($res){
					foreach($gmember as $temp){
						$query="SELECT groups FROM members WHERE userName='$temp'";
						$res=mysql_query($query);
						if($res){
							$result=mysql_fetch_assoc($res);
							$result=$result['groups'];
							$result=explode(';',$result);
							array_push($result,$gid);
							$result=implode(';',$result);
							$query="UPDATE members SET groups='$result' WHERE userName='$temp'";
							$res=mysql_query($query);
						}
					}
					header('Location: groupdetails.php');
				}else{
					return 'Something went Wrong';
				}
			}
		}else{
			return 'Something went Worng. Try Again later';
		}
	}
	function group_delete($gid,$uname){
		//$gid=group id; $uname=deleting persons name;
		$query="SELECT * FROM groups WHERE group_id='$gid'";
		$res=mysql_query($query);
		if(mysql_num_rows($res)==1){
			$row=mysql_fetch_assoc($res);
			if($row['group_admin']==$uname){
				$gmembers=$row['group_members'];
				$gmembers=explode(';',$gmembers);
				foreach($gmembers as $temp){
					$query="SELECT groups FROM members WHERE userName='$temp'";
					$res=mysql_query($query);
					if($res){
						$result=mysql_fetch_assoc($res);
						$result=$result['groups'];
						$result=explode(';',$result);
						$result=array_diff($result,array($gid));
						$result=implode(';',$result);
						$query="UPDATE members SET groups='$result' WHERE userName='$temp'";
						$res=mysql_query($query);
					}
				}
				$query="DELETE FROM groups WHERE group_id='$gid'";
				$res=mysql_query($query);
				if($res){
					header('Location: groups.php');
				}else{
					return "Something Went Wrong. Please Try Again Later...";
				}
			}else{
				return "You are not authorized";
			}
		}else{
			return 'Something went Worng. Try Again later';
		}
	}
	function group_leave($gid,$uname){
		//$gid=group id; $uname=user wanted to leave
		$query="SELECT * FROM groups WHERE group_id='$gid'";
		$res=mysql_query($query);
		if(mysql_num_rows($res)==1){
			$row=mysql_fetch_assoc($res);
			if($row['group_admin']!= $uname){
				$gmembers=$row['group_members'];
				$gmembers=explode(';', $gmembers);
				$gmembers=array_diff($gmembers, array($uname));
				$gmembers=implode(';',$gmembers);
				$query="UPDATE groups SET group_members='$gmembers' WHERE group_id='$gid'";
				$res=mysql_query($query);
				if($res){
					$query="SELECT groups FROM members WHERE userName='$uname'";
					$res=mysql_query($query);
					if($res){
						$row=mysql_fetch_assoc($res);
						$grps=$row['groups'];
						$grps=explode(';',$grps);
						$grps=array_diff($grps, array($gid));
						$grps=implode(';',$grps);
						$query="UPDATE members SET groups='$grps' WHERE userName='$uname'";
						$res=mysql_query($query);
						if($res){
							header('Location: groups.php');
						}else{
							return 'Something went Wrong';
						}
					}else{
						return 'Something went Wrong..';
					}
				}else{
					return "Something went Wrong";
				}
			}else{
				return 'You are Admin. You Cannot Leave';
			}
		}else{
			return 'Something went Wrong.';
		}
	}	
	function group_remove($gid,$uname,$gmember){
		//$gid=group id; $uname=admin user; $gmember= array of members to remove;
		$query="SELECT * FROM groups WHERE group_id='$gid'";
		$res=mysql_query($query);
		if(mysql_num_rows($res)==1){
			$row=mysql_fetch_assoc($res);
			if($row['group_admin']== $uname){
				$gmembers=$row['group_members'];
				$gmembers=explode(';', $gmembers);
				$gmembers=array_diff($gmembers, $gmember);
				$gmembers=implode(';',$gmembers);
				$query="UPDATE groups SET group_members='$gmembers' WHERE group_id='$gid'";
				$res=mysql_query($query);
				if($res){
					foreach($gmember as $fr){
						$query="SELECT groups FROM members WHERE userName='$fr'";
						$res=mysql_query($query);
						if($res){
							$row=mysql_fetch_assoc($res);
							$grps=$row['groups'];
							$grps=explode(';',$grps);
							$grps=array_diff($grps, array($gid));
							$grps=implode(';',$grps);
							$query="UPDATE members SET groups='$grps' WHERE userName='$fr'";
							$res=mysql_query($query);
							if($res){
								header('Location: groupdetails.php');
							}else{
								return 'Something went Wrong';
							}
						}else{
							return 'Something went Wrong..';
						}
					}
				}else{
					return "Something went Wrong";
				}
			}else{
				return 'You are not Admin.';
			}
		}else{
			return 'Something went Wrong.';
		}
	}
	function group_show($uname){ //show groups of a member
		$query="SELECT groups FROM members WHERE userName='$uname'";
		$res=mysql_query($query);
		$row=mysql_fetch_assoc($res);
		return array_diff(explode(';',$row['groups']),array(''));
	}
	function show_members($gid){
		$query="SELECT group_members FROM groups WHERE group_id='$gid'";
		$res=mysql_query($query);
		$result=mysql_fetch_assoc($res);
		return explode(';',$result['group_members']);
	}
?>