<html>
<head>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/animate-custom.css">
<title>User Panel | Horizon</title>
</head>
<body>

<?php
session_start();
include "../admin/koneksi.php";
include "../admin/tgl_indo.php";
include "viewuser.php";

if(isset($_SESSION['lvl'])){

	if($_SESSION['lvl']==0){
		$sql=mysql_query("SELECT * from user where idUser=$_SESSION[uid]");
		$fetch=mysql_fetch_array($sql);
	}
	elseif ($_SESSION['lvl']==1) {
		header('location:login');
	}	

switch ($_GET['page']) {
	case 'beranda':
		adside();
        statistik();
	break;
	
	case'berita':
		adside();
        formBerita();
	break;

	case'form-edit-berita':
		adside();
        editForm();
	break;
}
}else{
	header('location:login');
}
?>
    </body></html>