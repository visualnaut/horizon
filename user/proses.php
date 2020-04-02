<?php
session_start();
include"../admin/koneksi.php";
function ginject($data){
		$f=mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $f;}
switch ($_GET['page']) {

case'simpanBerita':
	$judul=ginject($_POST['judulBerita']);
	$kategori=ginject($_POST['kategori']);
	$isi=ginject($_POST['berita']);
	$penulis = $_POST['penulis'];

   if(isset($_FILES['foto'])){
	$lokasi_file	= $_FILES['foto']['tmp_name'];
	$dir			= "../foto/artikel/";
	$nama_file		= $_FILES['foto']['name'];
	
	move_uploaded_file($lokasi_file,$dir.$nama_file);}
    else {$nama_file = "default.jpg";}

	$sql="insert into post (idKategori,idUser,judulBerita,berita,cdate,foto)values
	('$kategori','$penulis','$judul','$isi',now(),'$nama_file')";
	/*$qSimpan =*/ 
	mysql_query($sql) or die(mysql_error());
	header('location:berita');
	//var_dump($qSimpan);
break;

case'editBerita':
	$judul=ginject($_POST['judulBerita']);
	$kategori=ginject($_POST['kategori']);
	$isi=ginject($_POST['berita']);

	$lokasi_file	= $_FILES['foto']['tmp_name'];
	$dir			= "../foto/artikel/";
	$nama_file		= $_FILES['foto']['name'];
	
	//upload file
	move_uploaded_file($lokasi_file,$dir.$nama_file);

	$sqlBerita = "update post set
	judulBerita='$judul', idKategori='$kategori', berita='$isi', mdate=now(), status = 0
	where idBerita='$_POST[idBerita]' ";

	mysql_query($sqlBerita) or die(mysql_error());

	if(!empty($nama_file)){
		$foto=mysql_fetch_array(mysql_query("select * from post where idBerita='$_POST[idBerita]' "));
		if($foto['foto'] != "default.jpg"){
	       unlink("../foto/artikel/$foto[foto]");}

		mysql_query("update post set foto='".mysql_real_escape_string($nama_file)."' where 
		idBerita ='".mysql_real_escape_string($_POST['idBerita'])."'");
	}
	header('location:berita');
break;

case'hapusBerita':
	$gambar=mysql_fetch_array(mysql_query("select * from post where idBerita='$_GET[id]' "));
	mysql_query("delete from post where idBerita='$_GET[id]' ") or die(mysql_error());
	if($gambar['foto'] != "default.jpg"){
	unlink("../foto/artikel/$gambar[foto]");}
	header('location:berita');
break;

}
?>