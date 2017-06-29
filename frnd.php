<?php
	session_start();
	include_once 'dbconnect.php';
	// type=0 -> friend request sent; type=1 -> friend request accepted; type=2 ->blocked
	function frndlist($uname){
		$query="SELECT userB FROM friends where userA='$uname' AND type=1";
		$res=mysql_query($query);
		$count=mysql_num_rows($res);
		$frnds=array();
		while($row=mysql_fetch_assoc($res)){
			array_push($frnds,$row['userB']);
		}
		$query="SELECT userA FROM friends where userB='$uname' AND type=1";
		$res=mysql_query($query);
		$count=mysql_num_rows($res);
		while($row=mysql_fetch_assoc($res)){
			array_push($frnds,$row['userA']);
		}
		$frnds=array_unique($frnds);
		return $frnds;
	}
	function frndsugg($uname){
		$frnds=frndlist($uname);
		$frndssuggest=array();
		foreach($frnds as $fr){
			$temp=frndlist($fr);
			$temp=array_diff($temp,$frndssuggest);
			$frndssuggest=array_merge($frndssuggest,$temp);
		}
		$frndssuggest=array_diff($frndssuggest,array($uname));
		if(count($frndssuggest)>15){
			return $frndssuggest;
		}else{
			$query="SELECT hometown FROM members WHERE userName='$uname'";
			$res=mysql_query($query);
			$qtemp=mysql_fetch_assoc($res);
			$qtemp=$qtemp['hometown'];
			$query="SELECT userName FROM members WHERE hometown='$qtemp' AND userName<>'$uname'";
			$res=mysql_query($query);
			if($res){
				while($row=mysql_fetch_assoc($res) and count($frndssuggest)<=15){		
					if(in_array($row['userName'],$frndssuggest)==false and in_array($row['userName'],$frnds)==false){
						array_push($frndssuggest, $row['userName']);
					}
				}
			}
		}
		return $frndssuggest;
	}
	// type=0 -> friend request sent; type=1 -> friend request accepted; type=2 ->blocked
	//uname=user sending request; unamec=user getting request;
	function friendcheck($uname, $unamec){
		$query="SELECT type FROM friends WHERE (userA='$uname' AND userB='$unamec') OR (userB='$uname' AND userA='$unamec')";
		$res=mysql_query($query);
		if(mysql_num_rows($res)==1){
			$row=mysql_fetch_assoc($res);
			return $row['type'];
		}else if(mysql_num_rows($res)==0){
			return -1;
		}
	}
	//uname=user sending request; unamec=user getting request;
	function friendrequest_send($uname, $unamec){
		$query="INSERT INTO friends (userA, userB, type, actionUser) VALUES ('$uname', '$unamec', '0', '$uname')";
		$res=mysql_query($query);
		if($res){
			return 'Friend Request Sent';
		}else{
			return 'Something went Wrong';
		}
	}
	//uname=person who is getting friend request;
	function friendrequest_show($uname){
		$query="SELECT userA FROM friends WHERE userB='$uname' AND type=0";
		$res=mysql_query($query);
		$friendreq=array();
		if($res){
			while($row=mysql_fetch_assoc($res)){
				array_push($friendreq,$row['userA']);
			}
		}
		return $friendreq;
	}
	//uname=the action user;  unameact=the user action taken on;  
	//$act= is an integer referncing which type of action taken (1->accept, 2->block, 3->reject);
	function friendrequest_action($uname, $unameact, $act){
		if($act==1 or $act==2){
			$query="UPDATE friends SET type='$act', actionUser='$uname' WHERE userB='$uname' AND userA='$unameact'";
			$res=mysql_query($query);
		}else if($act==3){
			$query="DELETE FROM friends WHERE userB='$uname' AND userA='$unameact'";
			$res=mysql_query($query);
		}
	}
	friendrequest_action('kavya','rakshit',1);
?>