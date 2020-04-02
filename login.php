<html>
<head>
<title>Horizon Login</title>
<meta charset='utf-8' />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate-custom.css">
</head>

<?php
session_start();
if(isset($_SESSION['uid'])){
	if($_SESSION['lvl']==1){
	header('location:adminpanel');
	}
	else if($_SESSION['lvl']==0){
	header('location:userpanel');
	}
}
include('admin/koneksi.php');

//untuk validasi jikalau username/pass kosong
if(isset($_POST['LOGIN'])){
	$pass=md5($_POST['password']);
	$cek=mysql_query("select * from user where username='$_POST[username]' AND password='$pass'") or die(mysql_error()) ;
	
	if(mysql_num_rows($cek) > 0) {
		$row=mysql_fetch_array($cek);
			$uid=$row['idUser'];
			$_SESSION['uid']=$uid;
			$lvl=$row['level'];
			$_SESSION['lvl']=$lvl;

		if ($_SESSION['lvl']==0) {
			header('location:userpanel');
		}
		else if($_SESSION['lvl']==1){
			header('location:adminpanel');
			}
	}
	else {
	?>
		<script>
			alert("Username atau Password salah!");
			top.location="login";
		</script>
	<?php
	}
}
?>
<body style="background:url(foto/line.png) #e5e5e5">

<div class='loginwrap animated bounceIn'>
    <div class='logincard solidshadow' style='background:#222'>
        <img src='foto/logo.png' />
    </div>
    
    <div class='logincard solidshadow'>
	<form method='post' action=''>
        <h1>Masuk</h1>
        <label>Username</label>
        <input type='text' name='username' maxlength='10' placeholder="" required>
        <label>Password</label>
        <input type='password' name='password' maxlength='10' placeholder="" required>
        <input type='submit' value='Login' name='LOGIN'>
	</form>
    </div>
    <div class='logincard solidshadow'>
        Belum punya akun? <a href='signup'>Daftar sekarang!</a>
    </div>
    <a href='beranda'>Kembali ke halaman utama.</a>
</div>

