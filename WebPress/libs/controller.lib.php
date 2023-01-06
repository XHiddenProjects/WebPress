<?php
session_start();
?>
<html>
<head>
<title>Admin Controller</title>
<style>
.platform{
	position:absolute;
	top:50%;
	left:50%;
	transform:translate(-50%,-50%);
	border:2px solid gray;
	width:30%;
	height:50%;
}
input[type="password"]{
	width:100%;
	border-radius:15px;	
	outline:none;
	padding:5px;
	border:1px solid black;
}
input[type="password"]:focus{
	border:5px solid cyan;
}
button{
	font-size:32px;
	border-radius:15px;
	margin-top:15px;
	width:100%;
	outline:none;
	border:none;
	cursor:pointer;
	transition:background-color 0.3s;
}
button:hover{
	background-color:gray;
}

</style>
</head>
<body>

<div class="platform">
<center>
<h1>Admin Controller</h1>
<form method="post">
<label>Enter Key:</label> <input type="password" name="accessKey"/>
<br/>
<button type="submit" name="accessQuery">Access</button>
</form>
<?php
if(isset($_POST['accessQuery'])){
	$getPsw = $_POST['accessKey'];
	if($getPsw===null||$getPsw===''){
		echo '<span style="color:red;">You must have a access key!</span>';
		return false;
	}
	$getKey = json_decode(file_get_contents('../api/KEYS.json'), true);
	if(base64_encode($getPsw)===base64_encode(md5($getKey['key']))){
	$get = json_decode(file_get_contents('../data/users/users.dat.json'), true);
	$info = (!isset($_SESSION['user'])||$_SESSION['user']!==@reset($get)['username'] ? true : false);
	$_SESSION['user'] = (!isset($_SESSION['user'])||$_SESSION['user']!==@reset($get)['username'] ? @reset($get)['username'] : $_SESSION['user']);
	echo $info ? '<span style="color:green;">Welcome you have now have admin control!</span>' : '<span style="color:red;">Failed to gain admin control!</span>';
	}else{
		echo '<span style="color:red;">Invalid Access Key!</span>'; 
	}
}
?>
</center>
</div>
</body>
</html>