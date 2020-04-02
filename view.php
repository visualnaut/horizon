<?php error_reporting(0); function navigasi() {
?>
<div class='fixer'>
    <nav>
            <ul>
                <a href='beranda' title='Horizon'><li class='logo'></li></a>
                <a href='login'><li class='login'>
                    <?php
                    if(!empty($_SESSION['uid'])){
                        
                        $data=mysql_fetch_array(mysql_query("select username from user where idUser = '$_SESSION[uid]'"));
                        echo"$data[username]";} else {echo"Masuk";}
                    ?>
                </li></a>
            </ul>
        </nav>
        <nav class='main'>
            <ul>
                <a href='kategori-1'><li><i class="fa fa-globe fa-lg"></i> Insight</li></a>
                <a href='kategori-3'><li><i class="fa fa-magic fa-lg"></i> Creative</li></a>
                <a href='kategori-2'><li><i class="fa fa-rocket fa-lg"></i> Technology</li></a>
                <a href='kategori-4'><li><i class="fa fa-heart"></i> Inspiration</li></a>
                <li class='search'><form method="post" action="search">
                        <input type='search' name='search' placeholder='kata kunci' required />
                        <input type='submit' value='Cari' />
                    </form>
                </li>
            </ul>
        </nav>
</div>
<?php }; function kategoriview() { 
?>
    
        <section id='wrapper' style='margin-top:115px'>
            <?php
            if($_GET['id'] == NULL){$_GET['id'] = 1;}
            $data = mysql_fetch_array(mysql_query("select * from kategori where idKategori = '$_GET[id]'"));
            echo"<h1 class='wrapheader'>$data[namaKategori]</h1>";
            ?>
            <section id='columns'>
            <?php
                       
            $sql=mysql_query("SELECT * FROM post inner join kategori on kategori.idKategori = post.idKategori inner join user on user.idUser=post.idUser where post.idKategori = '$_GET[id]' order by idBerita DESC");
	        
            while($fetch=mysql_fetch_array($sql)){
            $tgl=tgl_indo($fetch['cdate']);
                       
            echo"<section class='post2 solidshadow'>
                <div class='imgbox' style='background:url(foto/artikel/$fetch[foto])'>
                <div class='categorytag'>";
                       
                    if($fetch['idKategori'] == 1)   
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-globe fa-2x'></i></a></div>";
                    else if ($fetch['idKategori'] == 2)
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-rocket fa-2x'></i></a></div>";
                    else if ($fetch['idKategori'] == 3) 
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-magic fa-2x'></i></a></div>";
                    else if ($fetch['idKategori'] == 4) 
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-heart fa-2x'></i></a></div>";
                    
                    $fetch['berita'] = strip_tags($fetch['berita']);
                    if (strlen($fetch['berita']) > 500) {
                    // truncate string
                    $stringCut = substr($fetch['berita'], 0, 580);
                    // make sure it ends in a word so assassinate doesn't become ass...
                    $fetch['berita'] = substr($stringCut, 0, strrpos($stringCut, ' '))."..."; 
                    }
                    
                    echo"</i></a></div>
                </div>
                <article>
                        <hgroup>
                        <a href='hit-".$fetch['idBerita']."'><h1>$fetch[judulBerita]</h1></a>
                        <h3>$tgl <span>// $fetch[username]</span></h3>    
                        </hgroup>
                        <pre>$fetch[berita]</pre>
                    </article>
                    <a href='hit-$fetch[idBerita]'><h5>Baca Selengkapnya</h5></a>
                    <div class='footpost'><li>Komentar $tkom <i class='fa fa-comment fa-fw'></i></li>
                    <li>Dilihat $fetch[hits] <i class='fa fa-eye fa-fw'></i></li></div>
            </section>";
            }
            ?>
        </section>
            </section>


<?php }; function home() { ?>
<header>
    <div class="slider">
      <div class="page_container">
       <div class='featured'></div>
        <div id="immersive_slider">
           <?php $sql=mysql_query("SELECT * FROM post inner join kategori on kategori.idKategori = post.idKategori inner join user on user.idUser=post.idUser where status=1 order by hits DESC limit 2, 5");
            while($data=mysql_fetch_array($sql)){
                 $data['berita'] = strip_tags($data['berita']);
                    if (strlen($data['berita']) > 500) {
                    // truncate string
                    $stringCut = substr($data['berita'], 0, 270);
                    // make sure it ends in a word so assassinate doesn't become ass...
                    $data['berita'] = substr($stringCut, 0, strrpos($stringCut, ' '))."... <br /><a href='hit-$data[idBerita]'>Baca Selengkapnya</a>"; 
                    }
          echo"<div class='slide'>
            <div class='content'>
              <h2><a href='hit-$data[idBerita]' target='_blank'>$data[judulBerita]</a></h2>
              <p>$data[berita]</p>
            </div>
            <div class='image'>
              <a href='hit-$data[idBerita]' target='_blank'>
                <img src='foto/artikel/$data[foto]' class='slideimg'>
              </a>
            </div>
          </div>";
            }
            ?>
          <a href="#" class="is-prev"><i class='fa fa-chevron-circle-left'></i></a>
          <a href="#" class="is-next"><i class='fa fa-chevron-circle-right'></i></a>
        </div>
      </div>
  	</div>
    </header>

        <section id='wrapper'>
        <?php 
            $sql=mysql_query("SELECT * FROM post inner join kategori on kategori.idKategori = post.idKategori inner join user on user.idUser=post.idUser where status=1 order by hits DESC Limit 1");
	        $fetch=mysql_fetch_array($sql);
            $tgl=tgl_indo($fetch['cdate']);
            
            echo"<section class='bigpost solidshadow'>
                    <div class='imgbox' style='background:url(foto/artikel/$fetch[foto])'>
                    <div class='categorytag'><a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'>";
                       
                    if($fetch['idKategori'] == 1)   
                    echo"<i class='fa fa-globe fa-2x'></i>";
                    else if ($fetch['idKategori'] == 2)
                    echo"<i class='fa fa-rocket fa-2x'></i>";
                    else if ($fetch['idKategori'] == 3) 
                    echo"<i class='fa fa-magic fa-2x'></i>";
                    else if ($fetch['idKategori'] == 4) 
                    echo"<i class='fa fa-heart fa-2x'></i>";
                    
                    $fetch['berita'] = strip_tags($fetch['berita']);
                    if (strlen($fetch['berita']) > 500) {
                    // truncate string
                    $stringCut = substr($fetch['berita'], 0, 500);
                    // make sure it ends in a word so assassinate doesn't become ass...
                    $fetch['berita'] = substr($stringCut, 0, strrpos($stringCut, ' '))."... <br /><a href='hit-$fetch[idBerita]'>Baca Selengkapnya</a>"; 
                    }
                    
                    echo"
                    </a></div></div>
                    <article>
                        <hgroup>
                        <a href='hit-".$fetch['idBerita']."'><h1>$fetch[judulBerita]</h1></a>
                        <h3>$tgl <span>//$fetch[username]</span></h3>    
                        </hgroup>
                        <pre>$fetch[berita]</pre>

                    </article>
            </section>";
                            
            ?>
            <h1 class='wrapheader'>Post Terbaru</h1>
            <section id='columns'>
            <?php
                       
            $sql=mysql_query("SELECT * FROM post inner join kategori on kategori.idKategori = post.idKategori inner join user on user.idUser=post.idUser where status=1 order by idBerita DESC");
	        
            while($fetch=mysql_fetch_array($sql)){
            $tgl=tgl_indo($fetch['cdate']);
            $tkom =mysql_num_rows(mysql_query("select * from komentar where idBerita = '$fetch[idBerita]'"));
                       
            echo"<section class='post2 solidshadow'>
                <div class='imgbox' style='background:url(foto/artikel/$fetch[foto])'>
                <div class='categorytag'>";
                       
                    if($fetch['idKategori'] == 1)   
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-globe fa-2x'></i></a></div>";
                    else if ($fetch['idKategori'] == 2)
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-rocket fa-2x'></i></a></div>";
                    else if ($fetch['idKategori'] == 3) 
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-magic fa-2x'></i></a></div>";
                    else if ($fetch['idKategori'] == 4) 
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-heart fa-2x'></i></a></div>";
                    
                    $fetch['berita'] = strip_tags($fetch['berita']);
                    if (strlen($fetch['berita']) > 500) {
                    // truncate string
                    $stringCut = substr($fetch['berita'], 0, 580);
                    // make sure it ends in a word so assassinate doesn't become ass...
                    $fetch['berita'] = substr($stringCut, 0, strrpos($stringCut, ' '))."..."; 
                    }
                    $link = "http:/". $_SERVER['REQUEST_URI'];
                    echo"</i></a></div>
                </div>
                <article>
                        <hgroup>
                        <a href='hit-".$fetch['idBerita']."'><h1>$fetch[judulBerita]</h1></a>
                        <h3>$tgl <span>//$fetch[username]</span></h3>    
                        </hgroup>
                        <pre>$fetch[berita]</pre>
                    </article>
                    <a href='hit-$fetch[idBerita]'><h5>Baca Selengkapnya</h5></a>
                    <div class='footpost'><li>Komentar $tkom <i class='fa fa-comment fa-fw'></i></li>
                    <li>Dilihat $fetch[hits] <i class='fa fa-eye fa-fw'></i></li></div>
            </section>";
            }
            ?>

            </section>
        </section>
<?php }; function detailberita() { 

    $sql=mysql_query("SELECT * FROM post inner join kategori on kategori.idKategori = post.idKategori inner join user on user.idUser=post.idUser where idBerita='$_GET[id]' AND status=1");
    $data = mysql_num_rows($sql);
    if($data != 0) {
	$fetch=mysql_fetch_array($sql);
	$tgl=tgl_indo($fetch['cdate']);
    
	echo "<section id='wrapper' class='detailwrap' style='margin-top:95px'>
            <div class='detailimg solidshadow'>
                <img src='foto/artikel/$fetch[foto]' />
                <div class='overlay'>
                    <div class='categorytag' style='bottom:50px'>";
                       
                    if($fetch['idKategori'] == 1)   
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-globe fa-2x'></i>";
                    else if ($fetch['idKategori'] == 2)
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-rocket fa-2x'></i>";
                    else if ($fetch['idKategori'] == 3) 
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-magic fa-2x'></i>";
                    else if ($fetch['idKategori'] == 4) 
                    echo"<a href='kategori-$fetch[idKategori]' title='$fetch[namaKategori]'><i class='fa fa-heart fa-2x'></i>";
                    
                    echo"
                    </a></div>
                    <div class='infodetail'>
                        <h1>$fetch[judulBerita]</h1>
                        <h3>$tgl // $fetch[username]</h3>
                    </div>
                </div>
            </div>
            <article class='artdetail solidshadow'>
                <aside class='bacajuga'>
                    <h2>TERBARU</h2>
                    <ul>";
                        $sql=mysql_query("SELECT * FROM post inner join kategori on kategori.idKategori = post.idKategori inner join user on user.idUser=post.idUser where status = 1 order by idBerita DESC limit 5");
                        while($data = mysql_fetch_array($sql)){
                        echo"<a href='hit-$data[idBerita]'><li>$data[judulBerita]</li></a>";}
                    echo"</ul>
                    
                    <h2>TERPOPULER</h2>
                    <ul>";
                        $sql=mysql_query("SELECT * FROM post inner join kategori on kategori.idKategori = post.idKategori inner join user on user.idUser=post.idUser where status = 1 order by hits DESC limit 5");
                        while($data = mysql_fetch_array($sql)){
                        echo"<a href='detailberita-$data[idBerita]'><li>$data[judulBerita]</li></a>";}
                    echo"</ul>
                    </ul>
                </aside>
                <div class='detberita'>
                <pre>$fetch[berita]</pre>             
            </div>
            </article>
            <h1 class='wrapheader'>Komentar</h1>";
        
        
	echo"
    <div class='formkomen solidshadow'>
    <h2>Tulis Komentar</h2>
    <form method='post' action='simpan-komen'>
	<input type='hidden' value='$fetch[idBerita]' name='id_berita'>
	";
	
	if(!empty($_SESSION['uid']))
	{
		$sql=mysql_query("SELECT * FROM user where idUser=$_SESSION[uid]");
		$fetch=mysql_fetch_array($sql);
		echo"<b>$fetch[username]</b>&nbsp;<input type='hidden' name='nama' value='$fetch[username]'>
		<br><b>$fetch[email]</b>&nbsp;<input type='hidden' name='email' value='$fetch[email]'>
		";
	}
	elseif (empty($_SESSION['uid'])) {	

		echo"<input type='text' name='nama' required placeholder='Your name here..'>";	
		echo"<input type='text' name='email' id='email' onkeyup='ValidateEmail(); return false;' required placeholder='Your email here..'>
			<br><span id='alert'></span>";
	}
	

	echo"<br>Please comment politely<br><textarea name='komen'></textarea>";
	echo"<input type='submit' value='Post The Comment'>
		</form>
        </div>
        <div class='komenwrap'>";
        
        $q = mysql_query("select * from komentar where idBerita = '$_GET[id]' order by idKomentar DESC");
        if(mysql_num_rows($q) != 0){
        while($data = mysql_fetch_array($q)){
            $tgl=tgl_indo($data['tgl_komen']);
            echo"<div class='komen solidshadow'>
                <h4>$data[nama] // $data[email]</h4>
                <h5>$tgl</h5>
                <p>$data[komentar]</p>
            </div>";}
        }
        else {echo"<div class='komen solidshadow'>
                <h2> Belum Ada Komentar </h2>
                <span>Jadi Yang Pertama Komentari Post Ini !</span>
            </div>";}
        
        echo"</div>
    </section>";
    } else { notfound(); }
	?>
        
<?php }; function notfound() { ?>

<div class='notfound animated bounceIn' style='margin-top:115px'>
</div>

<?php }; function viewsignup() {?>
<section class="signwrap solidshadow animated bounceIn">
    <?php if($_GET['error'] == 1){echo"<div class='errorsign solidshadow'>Password tidak sama !</div>";} ?>
    <div class='signcard'>
		  <form method='post' action='simpan-user'>
			<label>Username</label>
            <input type='text' maxlenght='10' name='username' required>
			<label>Password</label>
            <input type='password' name='password' maxlenght='10' id='pass1' required>
			<label>Re-Password</label>
            <input type='password' name='passcheck' maxlenght='10' id='pass2' onkeyup='checkPass(); return false;' required>
            <br><span id='pesan'></span><br>
			<label>Email</label>
            <input type='email' name='email' id='email' onkeyup='ValidateEmail(); return false;' required>
            <br><span id='alert'></span><br>
			<br /><input type='submit' value='Sign Up' id='check'>
		</form>
    </div>
    <div class='imglogo'>
    </div>
    <a href='beranda'><h5 style='display:inline'>Kembali ke halaman utama</h5></a>
    </section>
<?php } function footer() { ?>
<footer>
    <section class='footwrap'>
        <div class='footcontent'>
        <h1>Temukan kami</h1>
            <ul>
                <a href='#'><li><i class="fa fa-facebook fa-fw"></i> Facebook</li></a>
                <a href='#'><li><i class="fa fa-twitter fa-fw"></i> Twitter</li></a>
                <a href='#'><li><i class="fa fa-pinterest fa-fw"></i> Pinterest</li></a>
                <a href='#'><li><i class="fa fa-instagram fa-fw"></i> Instagram</li></a>
            </ul>
        </div>
        <div class='footcontent' style='width:670px;'>
        <a href='profil'><h1>Profil Sekolah</h1></a>
            <p>
            SMK Negeri 1 Cimahi terletak di kawasan Industri,  yang dapat dijangkau dengan mudah dari berbagai sudut kota Cimahi, baik dari atau ke Kota Bandung, Kabupaten Bandung Barat dan Jakarta, serta dapat dengan mudah diakses oleh industri sehingga dapat memberikan dukungan dengan baik untuk kepentingan program pembelajaran yang dilakukan di sekolah maupun di Dunia Usaha/Dunia Industri dalam pelaksanaan Praktek Kerja Industri.
            </p>
        </div>
    </section>
    <div class='footnote'>© 2013 Horizon ( Rekayasa Perangkat Lunak <a href='http://www.smkn1-cmi.sch.id/' target='_blank'>SMKN 1 Cimahi</a> )</div>
</footer>            
    <script type="text/javascript">
  	  $(document).ready( function() {
  	    $("#immersive_slider").immersive_slider({
  	      container: ".slider", autoStart: 35000, pagination: false
  	    });
  	  });
        </script>
           <script type="text/javascript">
$(function () {
			$.scrollUp({
		        scrollName: 'scrollUp', // Element ID
		        scrollDistance: 900, // Distance from top/bottom before showing element (px)
		        scrollFrom: 'top', // 'top' or 'bottom'
		        scrollSpeed: 800, // Speed back to top (ms)
		        easingType: 'easeInOutCubic', // Scroll to top easing (see http://easings.net/)
		        animation: 'slide', // Fade, slide, none
		        animationInSpeed: 300, // Animation in speed (ms)
		        animationOutSpeed: 300, // Animation out speed (ms)
		        scrollImg: true, // Set true to use image
		        zIndex: 2147483647 // Z-Index for the overlay
			});
		});
</script>
            
<?php } function profil() { ?>

http://fontawesome.io/
http://jquery.com/
http://markgoodyear.com/2013/01/scrollup-jquery-plugin/
https://daneden.me/animate/
https://github.com/peachananr/immersive-slider

<?php } ?>
<script type="text/javascript">
			function checkPass(){
			    var pass1 = document.getElementById('pass1');
			    var pass2 = document.getElementById('pass2');

			    var message = document.getElementById('pesan');
			    
			    var goodColor = "#66cc66";
			    var badColor = "#ff6666";
			    
			    if(pass1.value == pass2.value){
			        pass2.style.backgroundColor = goodColor;
			        message.style.color = goodColor;
			        message.innerHTML = "Passwords Match!"
			    }
                else{
			        pass2.style.backgroundColor = badColor;
			        message.style.color = badColor;
			        message.innerHTML = "Passwords Do Not Match!"
                }
			}
			function ValidateEmail(){  
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				var ambilEmail = document.getElementById('email');
				var alert = document.getElementById('alert');

				var goodColor = "#66cc66";
			    var badColor = "#ff6666";

				if(ambilEmail.value.match(mailformat)){  
					ambilEmail.style.backgroundColor = goodColor;
					alert.style.color = goodColor;
					alert.innerHTML = "Email Valid"  
				}else{  
					ambilEmail.style.backgroundColor = badColor;
					alert.style.color = badColor;
					alert.innerHTML = "Email Not Valid"  
				}  
			}
</script>
