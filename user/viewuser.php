<?php function adside() { 
$sql=mysql_query("SELECT * from user where idUser=$_SESSION[uid]");
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
                <a href='berita'><li><i class="fa fa-inbox fa-fw"></i> Manage Postingan</li></a>
                <a href='proses-logout'><li><i class="fa fa-sign-out fa-fw"></i> Logout</li></a>
            </ul>
        </aside>
<?php };

function statistik() { ?>

<section id='adminwrapper'>
            <?php 
            $posttoday = mysql_num_rows(mysql_query("select * from post where cdate = CURDATE() and idUser = '$_SESSION[uid]'"));
            $posttotal = mysql_num_rows(mysql_query("select * from post where idUser = '$_SESSION[uid]'"));
            ?>
            <div class='container solidshadow'>
                <h1>Statistik</h1>
            </div>
            
            <div class='container solidshadow'>
            <h1 class='titlebox'>Postingan Anda</h1>
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
                        post.idUser WHERE post.idUser='$_SESSION[uid]' order by idBerita DESC limit 10");
                        while($data = mysql_fetch_array($query)){
                        $tgl=tgl_indo($data['cdate']);
                        echo"<li>$data[judulBerita] <a href='form-edit-berita-$data[idBerita]' title='Edit'><i class='fa fa-edit'></i></a>
                        <span>$tgl // $data[namaKategori]"; if($data['status'] == 1){echo"<label style='color:#49e845'>Published</label>";}else{echo"<label style='color:#ff4351'>Belum Dipublish</label>";} echo"</span></li>";
                        }
                        ?>
                        <li><a href='berita'>Manage Postingan</a></li>
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
            <form method='post' action='simpan-berita' enctype='multipart/form-data'>
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

			$qberita=mysql_query("select * from post where idUser = '$_SESSION[uid]' order by idBerita DESC") or die(mysql_error());
			echo"<div class='container solidshadow'>
                <h1>List Post</h1>
            </div>
			<div class='container solidshadow'>
            <table>
            <tr><th>Judul Berita</th><th>Kategori</th><th>Tanggal Post</th><th>Status</th></tr>";
			while($tberita=mysql_fetch_array($qberita)){
				$kat=mysql_fetch_array(mysql_query("select * from kategori where idKategori='$tberita[idKategori]' "));
					if($tberita['status']==0){
						$status="Draft";
					}else if($tberita['status']==1){
						$status="Published";
					}
					$tgl=tgl_indo($tberita['cdate']);
				echo"
				<tr>
					<td><a href='form-edit-berita-$tberita[idBerita]'>$tberita[judulBerita]</a></td>
					<td>$kat[namaKategori]</td>
					<td>$tgl</td>
					<td>$status</td>
				</tr>";
			}
			echo"
				</table></div>
        </section>";
    
} function editForm() {

$QBerita=mysql_query("select * from post where idBerita='$_GET[id]' ");
		$TBerita=mysql_fetch_array($QBerita);
		//ambil nama kategori
		$kat=mysql_fetch_array(mysql_query("select * from kategori where idKategori='$TBerita[idKategori]' "));
		echo"
        <section id='adminwrapper'>
            <div class='container solidshadow'>
                <h1>Edit Post</h1>
            </div>
            <div class='container solidshadow'>
			<form method='post' action='edit-berita' enctype='multipart/form-data'>
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
			<label>Foto</label>
            <img class='editimg' src='foto/artikel/$TBerita[foto]'>
            <input type='file' accept='image/*' name='foto'>
			<input type='submit' value='Edit'>
			</form>
            </div>
            </section>"; }?>