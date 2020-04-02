<?php function adside() { 
$sql=mysql_query("SELECT * from user where idUser=$_SESSION[uid]");
$npublish = mysql_num_rows(mysql_query("select * from post where status = 0"));
$data=mysql_fetch_array($sql);
?>

        <aside id='adminside'>
            <div class='miniinfo'>
                <img src='foto/logo.png' />
                <p>Welcome, <?php echo"$data[username]" ?> </p>
            </div>
            <ul>
                <a href='beranda'><li><i class="fa fa-home fa-fw"></i> Beranda</li></a>
                <a href='adminpanel'><li><i class="fa fa-bar-chart-o fa-fw"></i> Statistik </li></a>
                <a href='berita-admin'><li><i class="fa fa-inbox fa-fw"></i> Manage Postingan <?php if($npublish != 0){echo"<span>$npublish</span>";} ?></li></a>
                <a href='komentar'><li><i class="fa fa-comments fa-fw"></i> Manage Komentar</li></a>
                <a href='pengguna'><li><i class="fa fa-users fa-fw"></i> Manage User</li></a>
                <a href='proses-logout'><li><i class="fa fa-sign-out fa-fw"></i> Logout</li></a>
            </ul>
        </aside>
<?php };

function statistik() { ?>

<section id='adminwrapper'>
            <?php 
            $posttoday = mysql_num_rows(mysql_query('select * from post where cdate = CURDATE()'));
            $posttotal = mysql_num_rows(mysql_query("select * from post"));
            $komentoday = mysql_num_rows(mysql_query('select * from komentar where tgl_komen = CURDATE()'));
            $komentotal = mysql_num_rows(mysql_query("select * from komentar"));
            ?>
            <div class='container solidshadow'>
                <h1>Statistik</h1>
            </div>
            
            <div class='container solidshadow'>
            <h1 class='titlebox'>Post</h1>
                <div class='box'>
                <h2>Postingan Hari Ini</h2>
                <span><?php echo"$posttoday"; ?></span>
                </div>
                <div class='box'>
                <h2>Total Postingan</h2>
                <span><?php echo"$posttotal"; ?></span>
                </div>
                <div class='detailbox'>
                <h1>Terbaru</h1>
                    <ul>
                        <?php 
                        $query = mysql_query("SELECT * FROM post INNER JOIN kategori ON kategori.idKategori = post.idKategori INNER JOIN user ON user.idUser = 
                        post.idUser WHERE post.status = 1 order by idBerita DESC limit 10");
                        while($data = mysql_fetch_array($query)){
                        $tgl=tgl_indo($data['cdate']);
                        echo"<li>$data[judulBerita] <a href='form-edit-admin-$data[idBerita]' title='Edit'><i class='fa fa-edit'></i></a>
                        <span>$tgl // $data[username] // $data[namaKategori]</span></li>";
                        }
                        ?>
                        <li><a href='berita-admin'>Manage Postingan</a></li>
                    </ul>
                </div>
            </div>
    
            <div class='container solidshadow'>
            <h1 class='titlebox'>Komentar</h1>
                <div class='box'>
                <h2>Komentar Hari Ini</h2>
                <span><?php echo"$komentoday"; ?></span>
                </div>
                <div class='box'>
                <h2>Total Komentar</h2>
                <span><?php echo"$komentotal"; ?></span>
                </div>
                <div class='detailbox'>
                <h1>Terbaru</h1>
                    <ul>
                        <?php 
                        $query = mysql_query("SELECT * FROM komentar INNER JOIN post ON komentar.idBerita = post.idBerita order by idKomentar DESC limit 10");
                        while($data = mysql_fetch_array($query)){
                        $tgl=tgl_indo($data['tgl_komen']);
                        echo"<li>$data[komentar] <a href='hapus-komen-$data[idKomentar]' title='Hapus'><i class='fa fa-times-circle'></i></a>
                        <span>$tgl // $data[nama] // $data[email]</span></li>";
                        }
                        ?>
                        <li><a href=''>Manage Komentar</a></li>
                    </ul>
                </div>
            </div>
        
        </section>


<?php };
function formBerita() { 
echo"<section id='adminwrapper'>
            <div class='container solidshadow'>
                <h1>New Post</h1>
            </div>
            <div class='container solidshadow'>
            <form method='post' action='simpan-berita-admin' enctype='multipart/form-data'>
                    <label>Judul Artikel</label>
                    <input type='text' name='judulBerita' required>
                    <label>Kategori Artikel</label>
                    <select name='kategori'>";
                    $qkat=mysql_query("select * from kategori") or die(mysql_error());
				    while($tkat=mysql_fetch_array($qkat)){
					echo"<option value='$tkat[idKategori]'>$tkat[namaKategori]</option>";
				    }
                    echo"</select><label>Isi Artikel</label>
                    <textarea name='berita' required></textarea>
                    <input type='hidden' name='penulis' value='$_SESSION[uid]'>
                    <label>Photo</label>
                    <input type='file' accept='image/*' name='foto' />
                <input type='submit' value='Simpan' />
            </form>
            </div>";

			$qberita=mysql_query("select * from post order by idBerita DESC") or die(mysql_error());
			echo"<div class='container solidshadow'>
                <h1>List Post</h1>
            </div>
			<div class='container solidshadow'>
            <table>
            <tr><th>Judul Berita</th><th>Kategori</th><th>Tanggal Post</th><th>Status</th><th colspan='2'>Aksi</th></tr>";
			while($tberita=mysql_fetch_array($qberita)){
				$kat=mysql_fetch_array(mysql_query("select * from kategori where idKategori='$tberita[idKategori]' "));
					if($tberita['status']==0){
						$status="Draft";
						$toogle="<i class='fa fa-check' title='Publish'></i>";
					}else if($tberita['status']==1){
						$status="Publish";
						$toogle="<i class='fa fa-ban' title='Draft'></i>";
					}
					$tgl=tgl_indo($tberita['cdate']);
				echo"
				<tr>
					<td><a href='form-edit-admin-$tberita[idBerita]'>$tberita[judulBerita]</a></td>
					<td>$kat[namaKategori]</td>
					<td>$tgl</td>
					<td>$status</td>
					<td>
						<a href='toogle-$tberita[idBerita]'>$toogle</a></td>
						<td><a href='hapus-Badmin-$tberita[idBerita]' title='Hapus'><i class='fa fa-times-circle'></i></a>
					</td>
				</tr>";
			}
			echo"
				</table></div>
			";
} ?>
        </section>
<?php 
    function editForm() {
        
        $QBerita=mysql_query("select * from post where idBerita='$_GET[id]' ");
		$TBerita=mysql_fetch_array($QBerita);
		//ambil nama kategori
		$kat=mysql_fetch_array(mysql_query("select * from kategori where idKategori='$TBerita[idKategori]' "));
		//ambil Status
		if($TBerita['status']==0){
			$status="Draf";
		}else if($TBerita['status']==1){
			$status="Publish";
		}
		echo"
        <section id='adminwrapper'>
            <div class='container solidshadow'>
                <h1>Edit Post</h1>
            </div>
            <div class='container solidshadow'>
			<form method='post' action='edit-berita-admin' enctype='multipart/form-data'>
				<input type='hidden' name='idBerita' value='$TBerita[idBerita]'>
				<label>Judul Artikel</label>
                <input type='text' name='judulBerita' value='$TBerita[judulBerita]'><br>
				<label>Pilih Kategori : $kat[namaKategori]</label>
                <select name='kategori'>";
				$qkat=mysql_query("select * from kategori") or die(mysql_error());
				while($tkat=mysql_fetch_array($qkat)){
				echo"<option value='$tkat[idKategori]'>$tkat[namaKategori]</option>";
				}
		      echo"</select>
            <label>Isi Berita</label><textarea name='berita'>$TBerita[berita]</textarea><br>
			<label>Status : $status</label>
				<select name='status'>
					<option value='0'>Draft</option>
					<option value='1'>Publish</option>
				</select><br>
			<label>Foto</label>
            <img class='editimg' src='foto/artikel/$TBerita[foto]'> <br> <input type='file' name='foto'><br>
			<input type='submit' value='Edit'>
			</form>
            </div>
            </section>";?>

<?php }; function listkomen() {     
?>

<section id='adminwrapper'>
    <div class='container solidshadow'>
        <h1>List Komentar</h1>
    </div>
    <?php 
                                       
   $query = mysql_query("SELECT * FROM komentar INNER JOIN post ON komentar.idBerita = post.idBerita order by idKomentar DESC");
    while($data=mysql_fetch_array($query)){
        $tgl=tgl_indo($data['cdate']);
    echo"<div class='komen solidshadow'>
                <h4>$data[nama] // $data[email] <a href='hapus-komen-$data[idKomentar]' title='Hapus'><i class='fa fa-times-circle'></i></a></h4>
                <h5>$data[judulBerita] // $tgl</h5>
                <p>$data[komentar]</p>
            </div>";}
        ?>
</section>
<?php } function listuser() {
        echo"
    <section id='adminwrapper'>
    <div class='container solidshadow'>
        <h1>List Users</h1>
    </div>";
$Quser = mysql_query("select * from user where level != 1") or die(mysql_error());
if(mysql_num_rows($Quser) != 0){
	echo"
    <div class='container solidshadow'>
    <table>
	<tr><th>No</th><th>Nama</th><th>Email</th><th>Total Postingan</th><th>Postingan Terakhir</th><th>Action</th></tr>";
	$i=1;
	while($Tuser=mysql_fetch_array($Quser)){
        $tpost = mysql_num_rows(mysql_query("select * from post where idUser = '$Tuser[idUser]'"));
        $date = mysql_fetch_array(mysql_query("select cdate from post where idUser = '$Tuser[idUser]' order by idBerita DESC limit 1"));
        
        if($tpost != 0 ){$tgl=tgl_indo($date['cdate']);}else {$tgl = "Belum ada postingan";}
		echo"<tr>
			<td>$i</td>
			<td>$Tuser[username]</td>
			<td>$Tuser[email]</td>
			<td>$tpost</td>
			<td>$tgl</td>
			<td><a href='hapus-user-$Tuser[idUser]'>Hapus</a></td>
		</tr>";
		$i++;
	}
	echo"</table>
    </div>";}else { 
    echo"<div class='container solidshadow'>
        <h2>Tidak ada user terdaftar :(</h2>
    </div>";}
?>


</section>

<?php } ?>