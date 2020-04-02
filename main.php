<html>
    <head>
        <?php

session_start();
include"admin/koneksi.php";
include"admin/tgl_indo.php";
include"view.php";

        switch ($_GET['page']) {
        case'beranda':
        echo"<title>Horizon</title>";
        break;
        case'show_berita_full':
        if($_GET['id'] != NULL){
        $title = mysql_fetch_array(mysql_query("select judulBerita from post where idBerita=$_GET[id]"));    
        echo"<title>$title[judulBerita] | Horizon</title>";}
        else {echo"<title>Berita Tidak Ditemukan | Horizon</title>";}
        break;
        case'kategori':
        if($_GET['id'] == NULL){$_GET['id'] = 1;}
        $title = mysql_fetch_array(mysql_query("select * from kategori where idKategori=$_GET[id]"));    
        echo"<title>$title[namaKategori] | Horizon</title>";
        break;
        case'formSignUp':
            echo"<title>Silahkan Daftar | Horizon</title>";
            break;
        case'search':
            echo"<title>$_POST[search] | Pencarian</title>";
            break;
        case'profil':
            echo"<title>Profil Sekolah SMKN 1 Cimahi</title>";
            break;
            
        } ?>
<meta charset='utf-8' />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/animate-custom.css">
        
<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
     
<link id="scrollUpTheme" rel="stylesheet" href="css/image.css">
<script type="text/javascript" src="js/jquery.scrollUp.min.js"></script>
        
<script type="text/javascript" src="js/jquery.immersive-slider.js"></script>
<link href='css/immersive-slider.css' rel='stylesheet' type='text/css'>
</head>
    <body>
    
<?php
switch ($_GET['page']) {
	case'beranda';
        navigasi();
        home();
        footer();
	break;


	case'formSignUp':
	viewsignup();
	break;


	case 'search':
    navigasi();
    echo"<section id='wrapper' style='margin-top:110px; padding-bottom:20px'>";
	function ginject($data){
		$f=mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $f;}
        if(!isset($_POST['search'])) {echo"<h1 class='wrapheader'>Pencarian Tidak Ditemukan</h1>";} else {
		$search=ginject($_POST['search']);
		$sql=mysql_query("SELECT * FROM post INNER JOIN kategori ON kategori.idKategori = post.idKategori INNER JOIN user ON user.idUser = 
        post.idUser WHERE berita LIKE '%$search%' OR judulBerita LIKE '%$search%' AND post.status = 1 order by idBerita DESC") or die(mysql_error());
        if(mysql_num_rows($sql) != 0){
        echo"<h1 class='wrapheader'>Hasil Pencarian</h1>";
		while($fetch=mysql_fetch_array($sql)){
        $tgl=tgl_indo($fetch['cdate']);
        $fetch['berita'] = strip_tags($fetch['berita']);
        if (strlen($fetch['berita']) > 500) {
        // truncate string
        $stringCut = substr($fetch['berita'], 0, 200);
        // make sure it ends in a word so assassinate doesn't become ass...
        $fetch['berita'] = substr($stringCut, 0, strrpos($stringCut, ' ')). " ... <br /><a href='#'>Baca Selengkapnya</a>"; 
                    }
        echo "<div class='searchres solidshadow'>
        <div class='img' style='background:url(foto/artikel/$fetch[foto])'>
        <div class='categorytag'><a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'>";
                       
                    if($fetch['idKategori'] == 1)   
                    echo"<i class='fa fa-globe fa-2x'></i>";
                    else if ($fetch['idKategori'] == 2)
                    echo"<i class='fa fa-rocket fa-2x'></i>";
                    else if ($fetch['idKategori'] == 3) 
                    echo"<i class='fa fa-magic fa-2x'></i>";
                    else if ($fetch['idKategori'] == 4) 
                    echo"<i class='fa fa-heart fa-2x'></i>";
            
        echo"</a></div></div>
		<h3><a href='hit-$fetch[idBerita]'>$fetch[judulBerita]</a></h3>
        <label>$tgl // $fetch[username]</label>
        <p>$fetch[berita]</p>
        <div class='footpost' style='left:170px'><li>Komentar $tkom <i class='fa fa-comment fa-fw'></i></li>
        <li>Dilihat $fetch[hits] <i class='fa fa-eye fa-fw'></i></li></div>
        </div>";
        }} else {echo"<h1 class='wrapheader'>Pencarian Tidak Ditemukan</h1>";}
        echo"</section>";}
		break;


	case'show_berita_full':
    navigasi();
    detailberita();
	break;
    
    case'kategori':
    navigasi();
    kategoriview();
    footer();
	break;
    
    case'profil':
    navigasi();
    profil();
	break;

	case 'hit':
		// dari link berita di sekilas dikesiniin, terus ntar di redirect da

		$id=$_GET['id'];
		$search=mysql_query("SELECT * FROM post WHERE idBerita='$id'");
		$num=mysql_num_rows($search);
		if ($num==0) {
		header('location:beranda');
		}
		else{
		mysql_query("update post set hits=hits+1 where idBerita='$id'");
		header('location:detailberita-'.$id);
		}

	break;

	case 'simpanKomen':
	function ginject($data){
		$f=mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $f;
	}
		$id_berita=$_POST['id_berita'];
		$email=$_POST['email'];
		$nama=ginject($_POST['nama']);
		$komen=ginject($_POST['komen']);

		mysql_query("insert into komentar(idBerita,komentar,nama,email, tgl_komen) values('$id_berita','$komen','$nama','$email', now())") or die(mysql_error());
        header('location:detailberita-'.$id_berita);
		break;

    
	case'simpanUser':
	function ginject($data){
	$f=mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $f;
	}

	$username = ginject($_POST['username']);
    if($_POST['password'] == $_POST['passcheck']){
    $password = md5($_POST['password']);
    } else {
    header('location:error-1');
    }
	$email = $_POST['email'];
	$jk = $_POST['jk'];

	$sql_cari=mysql_query("select * from user where username='$username'");
	$num=mysql_num_rows($sql_cari);

	if ($num>0) {
		?>
		<script>
			alert("Maaf username telah dipakai");
			top.location="signup";
		</script>
	<?php
}
	else{
	$SqlSimpan="insert into user(username,password,email) values ('$username','$password','$email')";
	$QSimpan = mysql_query($SqlSimpan) or die(mysql_error());
	//header('location:beranda');
	?>
		<script>
			alert("Selamat Anda Sudah Terdaftar, Silahkan Login");
			top.location="beranda";
		</script>
	<?php
}
	break;
}
?>
    </body>
    </html>