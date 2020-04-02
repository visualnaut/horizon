-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2013 at 09:30 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `horizon`
--
CREATE DATABASE IF NOT EXISTS `horizon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `horizon`;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `idKategori` int(3) NOT NULL AUTO_INCREMENT,
  `namaKategori` varchar(20) NOT NULL,
  PRIMARY KEY (`idKategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idKategori`, `namaKategori`) VALUES
(1, 'Insight'),
(2, 'Technology'),
(3, 'Creative'),
(4, 'Inspiration');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `idKomentar` int(6) NOT NULL AUTO_INCREMENT,
  `idBerita` int(6) NOT NULL,
  `komentar` varchar(100) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tgl_komen` date NOT NULL,
  PRIMARY KEY (`idKomentar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idKomentar`, `idBerita`, `komentar`, `nama`, `email`, `tgl_komen`) VALUES
(1, 2, 'good', 'John', 'kersa@mail.com', '2013-12-10'),
(4, 3, 'wow !!', 'anonim', 'monster@inc', '2013-12-10'),
(5, 5, 'komentar baru ', 'admin', 'wahyu@gmail.com', '2013-12-11'),
(6, 5, 'test komen', 'admin', 'wahyu@gmail.com', '2013-12-11'),
(7, 3, 'komen lagi', 'admin', 'wahyu@gmail.com', '2013-12-11'),
(8, 6, 'banyak komen', 'admin', 'wahyu@gmail.com', '2013-12-11'),
(9, 1, 'pertamax gan', 'admin', 'wahyu@gmail.com', '2013-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `idBerita` int(6) NOT NULL AUTO_INCREMENT,
  `idKategori` int(3) NOT NULL,
  `idUser` int(11) NOT NULL,
  `judulBerita` varchar(150) NOT NULL,
  `berita` text NOT NULL,
  `cdate` date NOT NULL,
  `mdate` date NOT NULL,
  `hits` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`idBerita`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`idBerita`, `idKategori`, `idUser`, `judulBerita`, `berita`, `cdate`, `mdate`, `hits`, `status`, `foto`) VALUES
(1, 2, 1, 'Ini Kapal Terbesar di Dunia', 'TEMPO.CO, Seoul - Kapal terbesar di dunia baru saja berlayar di lepas pantai Korea Selatan. Prelude, berukuran panjang 1.601 kaki (487,9 meter), 150 kaki (45,7 meter) lebih panjang dari Empire State Building. Dimiliki oleh Shell, kapal itu telah mendapat julukan sebagai obyek terbesar yang mengapung.\r\n\r\nKapal berwarna merah terang itu memiliki bobot 600 ribu ton dan lebar 243 kaki (74 meter), menurut Wired. Pembangunan Prelude, yang memiliki tiga mesin berkekuatan 20.100 tenaga kuda, membutuhkan satu tahun penuh. \r\n\r\nBagaimana rencana Shell menggunakan kapal raksasa itu? Kapal ini akan menjadi fasilitas gas alam cair terapung, di mana gas alam akan dipanen dari dalam laut, diproses di kapal, dan dipindahkan ke kapal pengangkut yang menunggu di laut. Wired melaporkan, Prelude akan memproduksi 3,9 juta ton gas alam cair setiap tahun.\r\n\r\nFasilitas mengambang ini akan mengambil beberapa strain produksi gas dari lingkungannya, ujar Shell dalam sebuah rilis. "Ini juga menghindari dampak lingkungan dari membangun dan mengoperasikan kilang di darat, termasuk meletakkan pipa ke pantai dan membangun infrastruktur lainnya."\r\n\r\nKarena Prelude begitu besar, ia akan membutuhkan sistem katrol dan tuas untuk membawanya berlayar. Meskipun mobile, kapal akan lebih sering tetap diam. Tujuan pertama Prelude adalah lepas pantai Australia Barat, di mana ia akan berlabuh selama 25 tahun.\r\n\r\nBertanggung jawab untuk 175 kolam gas alam seukuran kolam renang olimpiade, kapal ini telah menmasang sistem keamanan untuk mengatasi masalah cuaca. Sebuah menara setinggi Patung Liberty telah dibangun untuk menjalankan Prelude, memastikan stabilitas bahkan selama badai Kategori 5. Kapal memiliki sistem mooring yang mampu menyerap kekuatan angin.\r\n\r\nSementara Prelude akan memulai perjalanan ke Australia pada 2017, Shell sudah mengerjakan desain kapal yang lebih besar, menurut Reuters.\r\n\r\nShell tidak mengungkapkan berapa biaya pembuatan kapal itu, tetapi analis industri mengatakan kepada Reuters bahwa harganya antara US$ 10,8 miliar dan US$ 12,6 miliar.', '2013-12-02', '0000-00-00', 23, 1, 'post1.jpg'),
(2, 1, 1, 'Otak Pria dan Wanita Ternyata Berbeda', 'TEMPO.CO, Philadephia - Para ilmuwan telah menemukan perbedaan besar antara otak laki-laki dan perempuan. Otak perempuan terprogram menjadi lebih baik untuk melakukan banyak tugas secara simultan. Sedangkan otak pria, lebih baik dalam berkonsentrasi pada tugas-tugas komplek yang tunggal. Seperti membaca peta atau memasak makanan.\r\n\r\nPara ilmuwan tersebut memindai 949 otak laki-laki dan perempuan muda. Mereka menggunakan sistem pencitraan difusi MRI untuk memetakan hubungan antara bagian-bagian dalam otak.\r\n\r\nDalam penelitian itu, ditemukan bahwa wanita memiliki hubungan yang jauh lebih baik antara sisi kiri dan kanan otak. Sedangkan pria, aktivitas otak lebih intens pada bagian individu otak, terutama cerebellum yang mengontrol keterampilan motorik.\r\n\r\nPria juga memiliki hubungan yang lebih baik antara bagian depan dan belakang otak. Ini memberi mereka kemampuan yang lebih baik untuk memahami informasi dan menggunakannya segera guna melaksanakan tugas-tugas kompleks. Maka mafhum ketika pria lebih cepat dalam hal belajar berenang maupun parkir mobil. Sementara perempuan memiliki kemampuan lebih baik mengingat wajah seseorang atau mengingat di mana seseorang telah ditemui.\r\n\r\nHasil penelitian ini, tampaknya bisa menjadi pendukung teori larisnya buku psikologi populer berjudul Man From Mars, Women From Venus. "Penelitian ini menunjukkan bahwa jika perempuan dan laki-laki diberi tugas yang melibatkan dua aktivitas untuk berpikir logis dan intuitif, maka perempuan akan lebih baik melakukannya," kata Dr Ragini Verma, peneliti dari University of Pennsylvania.\r\n\r\nSebaliknya, otak pria justru lebih baik dengan aktivitas instan yang harus dilakukan sekarang juga. Sebab, otak bagian depan-belakang lebih intens terhubung.\r\n\r\nDAILYMAIL | LIVESCIENCE | ISMI WAHID', '2013-12-03', '0000-00-00', 39, 1, 'post2.jpg'),
(3, 2, 1, 'Globe Digital Mampu Prediksi Gempa', 'TEMPO.CO, Depok- Peneliti asal Jepang, Takemura Shinichi, menciptakan globe digital yang disebut Tangible Earth yang mampu memprediksi terjadinya bencana di suatu daerah tertentu. Bola dunia digital itu memprediksi masa depan bumi dengan melihat data-data kejadian sebelumnya.\r\n\r\nKemarin, Tangible Earth diperkenalkan di Balai Sidang Universitas Indonesia kepada ratusan mahasiswa dan perwakilan pengamat lingkungan dari enam negara di Asia, yaitu Indonesia, Cina, Jepang, Malaysia, Thailand, dan Vietnam. "Tangible Earth merupakan sebuah bola dunia yang menampilkan kondisi bumi secara visual yang dioperasikan dengan sentuhan tangan," kata Takemura di Balai Sidang UI, Depok, Senin, 25 November 2013.\r\n\r\nSeminar yang bertajuk Feel and Change The World With Your Hands itu merupakan acara pembuka dalam acara Forum Lingkungan Hidup. Menurut Takemura, Tangible Earth yang berukuran 1/10 juta dari ukuran aktual bumi dapat dioperasikan dengan sentuhan tangan. Alat ini dapat digunakan untuk mengamati kondisi bumi secara waktu nyata. Namun, globe harus tersambung dengan Internet.\r\n\r\nSebagai contoh, jika seseorang ingin melihat kondisi Kalimantan dalam kepulauan di Indonesia, orang itu tinggal meletakkan telapak tangan di atas sambil sedikit mendorongny. Bola bening itu akan bergerak. Kalau kepulauan di Indonesia sudah ditemukan, putaran langsung dihentikan dengan mengangkat telapak tangan. Lalu, titik fokus tinggal ditekan ke pulau yang diinginkan. "Bisa di-zoom in, tapi harus tersambung Internet," kata dia.\r\n\r\nDalam alat ini terdapat data dinamika bumi, mulai dari simulasi pemanasan global, cuaca, bencana alam seperti tsunami, hingga pergerakan angin topan. Alat ini juga diklaim dapat mendeteksi dinamika bumi dari berbagai sudut pandang, seperti perkembangan bumi pada 10 tahun ke depan. \r\n\r\n"Kondisi pemanasan global pada 10 tahun ke depan," katanya. Selain 60 jenis data yang telah terprogram sebelumnya, alat ini dapat menerima data baru sesuai dengan perkembangan yang baru.\r\n\r\nMenurut Takemura, kelak dia akan mengembangkan alat itu. Tidak saja untuk melihat keadaan bumi, tetapi juga fenomena sosial ekonomi seperti persebaran penduduk, kepadatan penduduk, konsumsi energi, dan lainnya. "Rencana pengembangan, bukan saja kondisi bumi, tapi demografi seperti kondisi sosial dan penyebaran uang," kata Takemura.\r\n\r\nNantinya, Tangible Earth juga akan dapat digunakan untuk mengetahui bunyi dari berbagai belahan dunia dan dapat disambungkan dengan mikrofon di lokasi tersebut. Dengan begitu, bunyi di tempat tersebut, seperti suara serangga atau burung, dapat terdengar.\r\n\r\nGeneral Manager Human Resources Division IT Division AEON, Sudarmadi Salim, mengatakan bahwa pihaknya telah memasang 1 unit Tangible Earth di AEON Mall Lake Town, Jepang. Alat tersebut telah digunakan untuk berbagai kegiatan terkait dengan penangamanan masalah lingkungan di dunia."Di dunia ini baru ada 20 unit Tangible Earth yang telah dipasang," katanya. Sebanyak 20 unit yang telah terpasang di antaranya berlokasi di kantor PBB, Dubai, New York, Denmark, dan lainnya.\r\n\r\nSudarmadi mengatakan, peralatan tersebut mulai dirintis pada 1997 dan dirilis pada 2002. "Sekarang ini versi terbaru Tangible Earth yang sudah disempurnakan dari sebelumnya," katanya. Menurut dia, belum ada yang memasang peralatan senilai US $ 40 ribu itu di Asia Tenggara.\r\n\r\nRektor UI, Muhammad Anis, mengatakan bahwa UI mendukung berbagai kegiatan yang dapat memicu kesadaran mahasiswa mengenai masalah lingkungan. Dengan mengetahui Tangible Earth, kata dia, mahasiswa akan dapat menambah pemahamannya mengenai pemanfaatan alat teknologi tinggi. "Sebagai bagian dari ilmu pengetahuan," kata Anis.\r\n\r\nILHAM TIRTA', '2013-12-09', '2013-12-11', 24, 1, 'post3.jpg'),
(5, 4, 1, 'Obama: Mandela Menginspirasi Jutaan Orang', 'WASHINGTON - Presiden Barack Obama mengatakan bahwa Nelson Mandela telah menginspirasi jutaan orang di seluruh dunia, termasuk Obama. Dia menilai Mandela seseorang yang bekerja untuk kebebasan, keadilan, dan demokrasi.\r\n\r\n"Dia tidak lagi milik kami. Dia telah dimakan usia (wafat)," kata Obama sedikit emosional saat berbicara di Gedung Putih, seperti dilansir dari Reuters, Jumat (6/12/2013).\r\n\r\nDia menggambarkan Mandela sebagai salah satu manusia paling berpengaruh, berani, dan berjiwa besar di muka bumi ini. Presiden memberikan pidatonya kurang dari satu jam setelah adanya pengumuman kematian mantan pemimpin Afrika Selatan itu.\r\n\r\nObama mengingat dirinya pertama kali terlibat dalam politik dalam sebuah protes melawan apartheid di Afrika Selatan. Obama mengatakan dia telah mempelajari tulisan-tulisan Mandela sepanjang karirnya di pemerintahan.\r\n\r\n"Seperti lainnya di seluruh dunia, saya tidak dapat sepenuhnya membayangkan hidup saya tanpa seorang panutan seperti Nelson Mandela," kata presiden keturunan Afrika-Amerika itu.\r\n\r\n"Dan selama saya hidup, saya akan melakukan apa yang saya bisa pelajari darinya."\r\n\r\nSelama perayaan Hanukkah pada Kamis 5 Desember 2013 malam di Gedung Putih, Obama memuji Mandela sebagai seorang "raksasa moral" yang membuka mata dunia bahwa penindasan dapat berakhir dan keadilan bisa menang.', '2013-12-11', '0000-00-00', 58, 1, 'postz.jpg'),
(6, 3, 1, 'Cara Kreatif Punya "Nightstand" di Kamar Tidur!', 'KOMPAS.com - Menukar furnitur standar dengan barang-barang pengganti berfungsi serupa mampu memberikan karakter dalam kamar tidur. Coba perhatikan isi kamar tidur Anda dan perhatikan mana barang-barang yang Anda butuhkan dan gunakan hanya karena kebiasaan. \r\n\r\nContoh mudahnya adalah rangka tempat tidur. Anda butuh tidur di atas kasur, namun tidak harus menggunakan rangka tempat tidur. Hal serupa bisa Anda aplikasikan pada nightstand. \r\n\r\nAnda tentu membutuhkan bidang permukaan datar di sisi tempat tidur untuk meletakkan jam, lampu, dan buku, namun Anda tidak harus menggunakan meja. Beberapa alternatif berikut ini mungkin bisa Anda terapkan di rumah. \r\n\r\nKoper tua \r\n\r\nPertama, tumpuklah beberapa koper tua hingga ketinggiannya tidak jauh dari permukaan kasur. Anda membutuhkan sekitar tiga koper. Tanpa rangka tempat tidur, Anda mungkin hanya membutuhkan satu atau dua koper tua. \r\n\r\nAgar tampak menarik, cobalah memberikan variasi pada tumpukan koper-koper tersebut dalam penataannya. Misalnya, letakkan koper dengan bentuk terbesar di paling bawah, kemudian tumpuk dengan koper sedang, dan koper yang lebih kecil. Jadikan tumpukan koper tersebut sebagai nighstand atau meja di sisi tempat tidur Anda.\r\n\r\nKursi unik \r\n\r\nSelain koper sebagai nightstand, Anda juga bisa menggunakan kursi unik. Desainer Annie dari Annilygreen, seperti dikutip dalam Casa Sugar, menggunakan dua kursi ekstra sebagai nightstand. Annie menggunakan kursi dengan sandaran. Namun, Anda juga bisa menggunakan kursi tanpa sandaran (stool) yang terbuat dari kayu.\r\n\r\nPeti bekas \r\n\r\nIde dari Jacquelyn (Lark & Linen) lain lagi. Jacquelyn menggunakan peti-peti kosong bekas tempat penyimpanan botol anggur sebagai nightstand. Dia menggunakan tiga peti kecil dengan gurat-gurat kayu. Peti-peti ini mampu menjadi nightstand yang cantik di kamar tidur bernuansa cerah.\r\n\r\nSelamat mencoba!', '2013-12-11', '0000-00-00', 10, 1, 'nightstand.jpg'),
(7, 1, 1, 'Penelitian: Anak Muda Kini Memorinya Lebih Cetek', 'TEMPO.CO, New York - Lupa hari ulang tahun si dia atau nama aktor dalam film terakhir yang Anda tonton? Tenang, Anda tak sendiri. \r\n\r\nKetergantungan manusia modern pada Internet untuk mengecek sebuah fakta dan informasi dasar lainnya telah mengakibatkan tingkat pertumbuhan lupa, menurut para ilmuwan. Internet, kata mereka, bahkan telah mengganti fungsi teman atau orang yang Anda cintai ketika kita ingin menandai apa yang harus dikerjakan besok atau lusa, seperti harus mendatangi undangan dan sebagainya. \r\n\r\nMenulis dalam jurnal Scientific American, psikolog Daniel Wegner dan Adrian Ward dari Universitas Harvard memperingatkan bahwa individu yang percaya fakta mengesankan mereka disimpan secara online jauh lebih buruk dalam ingatan. "Penelitian kami menunjukkan bahwa kita memperlakukan Internet seperti mitra memori transaktif manusia atau orang, di mana kita biasanya berbagi tentang informasi pribadi," kata Wegner. \r\n\r\nTimnya menemukan bahwa banyak orang sekarang melihat mesin pencari Internet seperti Google dan lainnya sebagai perpanjangan kecerdasan mereka sendiri daripada alat terpisah.\r\n\r\nInternet, dalam arti lain, juga tidak seperti mitra memori transaktif manusia, kata dia. Internet tahu lebih banyak dan dapat menghasilkan informasi lebih cepat. Hampir semua informasi saat ini sudah tersedia melalui pencarian Internet. "Internet bukan hanya mengambil tempat orang lain sebagai sumber eksternal memori, tapi juga dari kemampuan kognitif kita sendiri," katanya. "Kami menyebutnya efek Google."\r\n\r\nDalam serangkaian tes, peneliti menemukan bahwa peserta lebih cenderung untuk mengingat informasi jika mereka percaya telah terhapus. Mereka yang berpikir memori itu disimpan di komputer akan lebih pelupa, bahkan jika mereka secara eksplisit diminta untuk menyimpan informasi itu dalam pikirannya. "Kita sekarang jauh lebih buruk dalam mengingat fakta-fakta yang kita tahu yang tersedia secara online," katanya. \r\n\r\nNamun, dalam eksperimen lain, tim meminta mahasiswa Harvard untuk menjawab pertanyaan-pertanyaan trivia dengan atau tanpa menggunakan Google, dan kemudian meminta mereka untuk menilai kecerdasan mereka sendiri. Mereka menemukan orang-orang memilih untuk menggunakan Internet memiliki pandangan yang jauh lebih tinggi dari kekuatan otak mereka sendiri, bahkan dibandingkan dengan individu yang mendapat pertanyaan yang sama dengan hanya menggunakan pengetahuan mereka sendiri. "Hasil ini mengisyaratkan bahwa peningkatan kognitif diri setelah menggunakan Google adalah umpan balik positif langsung," katanya.', '2013-12-11', '0000-00-00', 7, 1, 'default.jpg'),
(8, 1, 1, 'Bumi Lain Bertebaran di Sekitar Planet Kita', 'TEMPO.CO, San Fransisco - Sebuah studi menemukan Bima Sakti penuh dengan miliaran planet seukuran Bumi mengorbit pada satu bintang seperti matahari kita. Planet-planet seukuran Bumi itu berada di zona Goldilocks, zona yang disebut-sebut tidak terlalu panas dan tidak terlalu dingin bagi kehidupan.\r\n\r\nPara astronom menggunakan data NASA menghitung untuk pertama kalinya bahwa di galaksi kita sendiri, setidaknya ada 8,8 miliar bintang dengan planet seukuran Bumi di zona dengan suhu layak huni.\r\n\r\nStudi ini diterbitkan dalam jurnal Proceeding of National Academy of Science.\r\n\r\nLangkah selanjutnya, para ilmuwan mengatakan, adalah untuk mencari atmosfer di planet ini dengan teleskop yang berkemampuan lebih. Menurut Geoff Marcy, salah satu peneliti dari University of California di Berkeley, hal ini untuk mencari petunjuk lebih lanjut tentang kondisi planet dan apakah cocok sebagai tempat bermukim manusia.\r\n\r\nTemuan ini juga menimbulkan pertanyaan tentang apakah hanya Bumi atau ada di antara planet-planet itu yang juga dihuni makhluk hidup. "Jika kita tidak sendirian, mengapa ada keheningan memekakkan telinga di galaksi Bima Sakti kita?" katanya. \r\n\r\nTeleskop Kepler memantau 42 ribu bintang, dan mengonfirmasi hanya sebagian kecil dari galaksi kita dengan planet seperti Bumi di luar sana. Para ilmuwan kemudian mengekstrapolasi angka itu ke seluruh galaksi, yang memiliki ratusan miliar bintang.\r\n\r\nUntuk pertama kalinya, para ilmuwan menghitung jumlah planet seperti matahari yang memiliki planet mirip Bumi. Mereka menghasilkan angka 22 persen, dengan margin of error kurang lebih 8 poin persentase. Ilmuwan Kepler, Natalie Batalha, mengatakan angka ini bukan angka final, karena masih banyak data angka yang bisa diolah. \r\n\r\nAda sekitar 200 miliar bintang di galaksi kita, dengan 40 miliar dari mereka seperti matahari kita, kata Marcy. Salah satu peneliti menempatkan jumlah bintang seperti matahari mendekati angka 50 miliar, yang berarti akan ada setidaknya 11 miliar planet seperti planet kita.\r\n\r\nBerdasarkan estimasi, planet serupa Bumi yang paling dekat yang ada di zona suhu huni dan lingkaran bintang mirip matahari mungkin berjarak 70 triliun mil dari Bumi, katanya.\r\n\r\nSebuah studi sebelumnya menemukan bahwa 15 persen dari kumpulan bintang raksasa memiliki planet seukuran Bumi yang berada di zona tidak terlalu panas dan tidak terlalu dingin, sedangkan ilmuwan Kepler mengidentifikasi hanya 10 planet seukuran Bumi yang juga mengelilingi bintang seperti Matahari dan berada di zona layak huni, yang disebut Kepler 69-c.', '2013-12-11', '2013-12-11', 4, 1, 'default.jpg'),
(10, 3, 1, 'Industri Kreatif Tumbuh Tujuh Persen', 'TEMPO.CO, Jakarta - Direktur Jenderal Industri Kecil dan Menengah Kementerian Perindustrian, Euis Saedah, menyatakan industri kreatif meningkat 7 persen setiap tahunnya. "Industri ini termasuk yang mendorong pertumbuhan ekonomi Indonesia tiap tahunnya," ujar dia dalam sambutan pembukaan pameran Sumatera Barat Food and Craft VI di Plasa Pameran Kementerian Perindustrian, Jakarta, hari ini, Selasa, 18 Juni 2013.\r\n\r\n\r\nEuis menjelaskan, subsektor fesyen dan kerajinan merupakan subsektor yang dominan memberikan kontribusi ekonomi. "Baik itu nilai tambah, tenaga kerja, jumlah unit usaha, dan ekspor," katanya.\r\n\r\n\r\nKedua subsektor tersebut menyumbang nilai ekspor hingga mencapai rata-rata US$ 13 miliar per tahun dalam beberapa tahun ini. Nilai tambah keduanya pun, menurutnya, memiliki rata-rata yang cukup tinggi. Hingga awal tahun ini, subsektor fesyen berkonstribusi sebesar 44,3 persen dari total sektor industir kreatif, sementara kerajinan memiliki kontribusi sebesar 24,8 persen.\r\n\r\n\r\nTerkait penyerapan tenaga kerja, Euis menambahkan, industri fesyen dan kerajinan memiliki kontribusi yang cukup besar. "51,7 persen untuk fesyen dan 35,7 persen untuk subsektor kerajinan," ujar dia.\r\n\r\n\r\nMaka dari itu, para pemerintah daerah diminta untuk membina yang bertujuan untuk meningkatkan daya saing produk industri, khususnya kerajinan, fesyen, dan pangan. "Juga dapat memfasilitasi mereka agar bisa tumbuh pesat di pasar global yang kompetitif."\r\n\r\n\r\nHari ini, Selasa, 18 Juni 2013 hingga 21 Juni 2013, Kementerian Perindustrian menggelar pameran yang bertajuk "Sumatera Barat Food and Craft VI". Pada acara ini dipamerkan berbagai macam hasil produksi IKM asal Sumatera Barat yang didominasi oleh kerajinan sandang dan pangan.', '2013-12-11', '0000-00-00', 2, 1, 'default.jpg'),
(11, 4, 4, 'Demi Anak 5 Tahun Pasien Kanker, San Francisco Jadi Gotham City', 'Liputan6.com, San Francisco : Dalam sehari, jalanan kota San Francisco, Amerika Serikat berubah menjadi Gotham City -- kotanya tokoh superhero Batman. Lebih dari 7.000 orang berpartisipasi, pihak kepolisian mengerahkan pasukan, bahkan Presiden AS Barack Obama melibatkan diri.\r\n\r\nSemua itu demi mewujudkan impian seorang pasien kanker berusia 5 tahun. Ia ingin jadi pahlawan super Batman. Mengharukan.\r\n\r\nMiles Scott -- nama bocah itu-- awalnya tak mengira bakal dapat kejutan. Ia dalam perjalanan untuk mendapatkan kostum Batman mini -- agar ia bisa berpakaian seperti pahlawan kesayangannya.\r\n\r\nNamun, tiba-tiba terdengar siaran dari anggota Kepala Kepolisian San Fransisco, Greg Suhr. Permintaan tolong pada &#039;Batkid&#039;. Pesan itu untuk Miles.\r\n\r\nMiles lantas menjelma jadi pahlawan cilik, melawan musuh bebuyutannya, Penguin dan Riddler. Mengendarai &#039;Batmobiles&#039; -- yang aslinya Lamborghini hitam yang ditempeli stiker, yang dikawal polisi, kehadirannya dielu-elukan warga.\r\n\r\nMiles &#039;si Batkid&#039; juga menyelamatkan seorang gadis yang ada dalam kesulitan yang terikat. Ia juga menggagalkan aksi perampokan di distrik ekonomi lokal.\r\n\r\nTak hanya itu, Batkid juga melakukan perjalanan ke AT &amp; T Park untuk menyelamatkan maskot tim bisbol kesayangan San Francisco, Giant. Dengan melucuti bom yang dipasang musuh bebuyutan Batman, Penguin.\r\n\r\nTentu saja semua itu hanya pura-pura. Namun, mereka yang berpartisipasi berusaha bersunggung-sungguh. Demi bocah Miles yang tabah: polisi ikut-ikutan menangkap Riddler. Departemen Kehakiman bahkan menyiapkan dakwaan untuk Riddler dan Penguin.\r\n\r\nMenjelang hari berakhir, giliran Walikota San Francisco, Ed Lee memberikan kunci kota kepada Miles.\r\n\r\nBahkan Presiden Amerika Serikat, Barack Obama memuji pahlawan cilik itu dari video yang direkam dari Gedung Putih. &quot;Bagus Miles! Kau telah menyelamatkan Gotham.&quot;\r\n\r\nPerjuangan Berat Lawan Kanker\r\n\r\nMake-A-Wish Foundation, yang menyelenggarakan acara tersebut menerima permohonan lebih dari 10 ribu orang. Untuk Miles yang menjalani perawatan kanker selama beberapa tahun. Kini kondisinya relatif membaik.\r\n\r\nDi kehidupan nyata, Miles telah mengalahkan musuh yang bahkan lebih kejam dari seteru Batman. Ia pulih dari leukemia, yang dideritanya sejak usia 18 bulan.\r\n\r\nIbunya, Natalie mengatakan, menjadi Batkid adalah perayaan selesainya pengobatan sang putra. &quot;Ini adalah lembaran baru bagi keluarga kami dan berakhirnya masa 3 tahun menyuntikkan obat berbahaya di tubuh anak kami,&quot; kata dia, seperti dimuat BBC, 15 November 2013.\r\n\r\nSementara ayahnya, Nick Scott berterimakasih pada yayasan amal dan siapapun yang amat berjasa pada anaknya.\r\n\r\n&quot;Semua dokter, perawat, dan semua orangtua yang menghadapi perjuangan yang sama seperti yang kami alami,&quot; kata dia kepada KGO-TV.\r\n\r\nBagaimana dengan Miles? Si Batkid tak berkomentar pada media. Ia tampak lelah usai beraksi, tapi dengan senyum gembira di bibirnya. Impiannya jadi kenyataan. (Ein)', '2013-12-11', '2013-12-12', 5, 1, 'batman-cilik-131116-b.jpg'),
(18, 1, 1, 'Bahasa Inggris Dihapus, Lembaga Pendidikan Senang, Kok Bisa?', 'REPUBLIKA.CO.ID, DEPOK--Kementerian Pendidikan dan Kebudayaan (Kemendikbud) berencana meniadakan mata pelajaran Bahasa Inggris untuk kurikulum Sekolah Dasar (SD). Rencana itu  disambut baik oleh para pengelola dan staf di tempat kursus Bahasa Inggris, meski mereka mengatakan langkah itu tidaklah tepat.\r\n\r\nSalah satunya adalah Lembaga Pendidikan Indonesia Amerika (LPIA) di Jalan Margonda, Depok. Menurut kordinator Bahasa Inggris LPIA, Putu Widiasastra, penghapusan pelajaran Bahasa Inggris memang tidak tepat karena anak-anak perlu mempelajari bahasa dunia ini sejak dini. Selain itu, Bahasa Inggris sudah menjadi kebutuhan bagi siswa, bahkan untuk siswa sekolah dasar. \r\n\r\n&quot;Sebagai pengajar, penghapusan Bahasa Inggris untuk siswa SD itu disayangkan,&quot; ungkapnya. \r\n\r\nMeskipun begitu, ia juga mengaku menyambut dengan baik apabila wacana tersebut memang dilaksanakan. Pasalnya, jika wacana tersebut memang dilaksanakan, maka akan mempengaruhi jumlah siswa yang mendaftar di lembaga tersebut yang dinilai akan semakin meningkat. \r\n\r\nSastra mengakui, dihapusnya mata pelajaran Bahasa Inggris di sekolah dasar akan berdampak pada banyaknya siswa yang akan belajar di lembaga pendidikan Bahasa Inggris. Menuru dia itu dikarenakan orang tua siswa sudah menyadari pentingnya pembelajaran Bahasa Inggris sejak dini.\r\n\r\n&quot;Kalau sebagai pengajar di lembaga, saya menyambut dengan baik karena siswa yang mendaftar kemungkinan lebih banyak meskipun jumlahnya tidak akan drastis,&quot; kata Sastra. \r\n\r\nIa menambahkan pentingnya Bahasa Inggris bagi siswa untuk dipelajari karena pelajaran ini merupakan bahasa internasional. &quot;Jika ingin maju, Bahasa Inggris penting untuk dipelajari,&quot; tambahnya.  \r\n\r\nSementara itu, Ryan, siswa kelas lima sekolah dasar, mengaku meskipun ia sudah mendapatkan pelajaran Bahasa Inggris di sekolahnya, ia juga masih mengikuti kursus privat Bahasa Inggris. &quot;Saya juga belajar les bahasa Inggris di rumah, disuruh mama,&quot; katanya.', '2013-12-12', '0000-00-00', 2, 1, 'default.jpg'),
(19, 1, 1, 'Pelajar Indonesia terburuk soal matematika dan ilmu pengetahuan', 'Merdeka.com - Organisation for Economic Co-operation and Development (OECD) merilis hasil survei yang menggunakan metode Programme for International Student Assessment (PISA). Dari pelajar di 65 negara/kota yang disurvei, pelajar Indonesia berada di peringkat kedua terbawah dalam pelajaran matematika dan sains.\r\n\r\nSurvei yang baru dirilis OECD, lembaga yang bermarkas di Paris itu, merupakan survei yang dilakukan pada tahun 2012 dengan melibatkan 510.000 siswa usia 15 tahun. Survei dilakukan dengan menggunakan kuesioner pilihan berganda dengan sistem komputer.\r\n\r\nUntuk matematika, skor rata-rata 65 negara/kota yang disurvei ditetapkan OECD sebesar 494. Sementara skor pelajar Indonesia rata-rata hanya mencapai 375 dan unggul tipis atas Peru yang berada di peringkat buncit dengan skor 368.\r\n\r\nBandingkan dengan skor rata-rata yang diperoleh pelajar Thailand yang berada di peringkat 50 yang mencapai 427 dan Malaysia di peringkat 52 dengan angka 421.\r\n\r\nDalam kategori ini, peringkat 5 besar diperoleh pelajar dari Shanghai (China), Singapura, Hong Kong, Taiwan, dan Korea Selatan.\r\n\r\nKemudian untuk skor PISA untuk kategori sains, pelajar Indonesia yang disurvei juga berada di peringkat 64. Dengan skor rata-rata yang ditetapkan OECD sebesar 501, pelajar Indonesia cuma mendapat skor 382.\r\n\r\nKementerian Pendidikan Nasional mengakui survei PISA ini. Bahkan Indonesia mulai sepenuhnya berpartisipasi sejak tahun 2000. Pada tahun 2000 sebanyak 41 negara berpartisipasi sebagai peserta sedangkan pada tahun 2003 menurun menjadi 40 negara dan pada tahun 2006 melonjak menjadi 57 negara hingga kemudian di tahun 2012 menjadi 65 negara/kota peserta.\r\n\r\nTujuan PISA adalah untuk mengukur prestasi literasi membaca, matematika, dan sains siswa sekolah berusia 15 tahun di negara-negara peserta. Di tahun 2012, survei menambahkan kategori problem solving dan financial literacy.\r\n\r\nSeperti ditulis dalam situs resmi Kemendiknas, manfaat survei PISA bagi Indonesia adalah untuk mengetahui posisi prestasi literasi siswa Indonesia bila dibandingkan dengan prestasi literasi siswa di negara lain dan faktor-faktor yang mempengaruhinya. Oleh karena itu, hasil studi ini diharapkan dapat digunakan sebagai masukan dalam perumusan kebijakan untuk peningkatan mutu pendidikan.\r\n\r\nUntuk kategori matematika, hal-hal yang diukur adalah: Mengidentifikasikan dan memahami serta menggunakan dasar-dasar matematika yang diperlukan seseorang dalam menghadapi kehidupan sehari-hari.\r\n\r\nSedangkan untuk sains: Menggunakan pengetahuan dan mengidentifikasi masalah untuk memahami fakta-fakta dan membuat keputusan tentang alam serta perubahan yang terjadi pada lingkungan', '2013-12-12', '2013-12-12', 0, 1, 'pelajar-indonesia-terburuk-soal-matematika-dan-ilmu-pengetahuan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `level` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `username`, `password`, `email`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@mail.com', '1'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'webdiver@gmail.com', '0'),
(4, 'wahyu', '32c9e71e866ecdbc93e497482aa6779f', 'wahyu@mail.com', '0'),
(5, 'adith', '81dc9bdb52d04dc20036dbd8313ed055', 'adith@mail.com', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
