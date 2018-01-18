<?php
include("cek_session.php");
//ini dirubah utk lihat status github
if($_SESSION['jabatan']!="Master Admin"){
	header("location:logout.php");		
}
include("koneksi.php");
$hasil_submit="";
if(isset($_POST['tambah_admin'])){
	if(isset($_POST['user']) && isset($_POST['pass'])){
		if(trim($_POST['user'])!=""){
			if(trim($_POST['pass'])){
				$user=trim(mysql_real_escape_string($_POST['user']));
				$pass=md5($_POST['pass']);
				$query="insert into tbl_admin values('$user','$pass','Admin')";
				if(mysql_query($query)){
					mkdir("daftar_admin/".$user);
					$hasil_submit="Data Admin baru berhasil ditambah";
				}else{
					$hasil_submit="Oops,ada kesalahan. Pastikan ID Admin belum ada sebelumnya";
				}
			}else{
				$hasil_submit="Masukkan Password";
			}
		}else{
			$hasil_submit="Masukkan ID Admin";
		}
	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Retail Excellence Indonesia</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="shortcut icon" href="images/icon_web_re.png" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <!--<h1><a href="index.html">PHILIPS<span class="logo_colour"> Report</span></a></h1>
          <h2>Info Segala Macam Transaksi Philips</h2>-->
        </div>
      </div>
      <nav>
        <div id="menu_container">
          <?php include("menu.inc"); ?>
        </div>
      </nav>
    </header>
    <div id="scroll_bawah">
      <input type="image" src="images/down.png" onClick="initAnimateScrollBawah();" />
    </div>
    <div id="site_content"><h2>Selamat Datang Master Admin</h2>
    <br />
    <?php
	echo "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\" class=\"table_khusus\">
      <tr class=\"tr_khusus\">
      <td class=\"td_khusus\">No.</td><td class=\"td_khusus\">ID Admin</td><td class=\"td_khusus\">Jabatan</td><td class=\"td_khusus\">Edit Password</td><td class=\"td_khusus\">Konfirmasi Password</td><td colspan=\"2\" class=\"td_khusus\">Keterangan</td>
      </tr>";
	  $no=1;
	  $query="select user_id,jabatan from tbl_admin";
	  $ambil=mysql_query($query)or die(mysql_error());
	  while($hs=mysql_fetch_array($ambil)){
		echo "<tr class=\"tr_khusus\">";
		echo "<td class=\"td_khusus\">".$no."</td>";;
		echo "<td class=\"td_khusus\" id=\"td_id_admin_$no\">".$hs['user_id']."</td>";
		echo "<td class=\"td_khusus\">".$hs['jabatan']."</td>";
		echo "<td class=\"td_khusus\"><input type=\"password\" name=\"pass_admin_$no\" id=\"pass_admin_$no\" size=\"30\" /></td>";
		echo "<td class=\"td_khusus\"><input type=\"password\" name=\"pass_confirm_admin_$no\" id=\"pass_confirm_admin_$no\" size=\"30\" /></td>";
		if($hs['jabatan']!="Master Admin"){
			echo "<td class=\"td_khusus\"><input type=\"button\" name=\"btn_edit_pass_admin_$no\" id=\"btn_edit_pass_admin_$no\" value=\"Edit\" onclick=\"editPassAdmin($no);\" /></td>";
			echo "<td class=\"td_khusus\"><input type=\"button\" name=\"btn_hapus_admin_$no\" id=\"btn_hapus_admin_$no\" value=\"Hapus\" onclick=\"hapusAdmin('$hs[user_id]');\" /></td>";
		}else{
			echo "<td class=\"td_khusus\" colspan=\"2\"><input type=\"button\" name=\"btn_edit_pass_admin_$no\" id=\"btn_edit_pass_admin_$no\" value=\"Edit\" onclick=\"editPassAdmin($no);\" style=\"width:100px;\" /></td>";
		}
		echo "</tr>";
		echo "</tr>";
		$no++;
	  }
      echo "</table><br /><br /><br />
    <input type=\"button\" value=\"HAPUS SEMUA DATA REPORT\" onClick=\"hapusTransaksi();\" /><br /><br />* Tombol : HAPUS SEMUA DATA REPORT.<br />
1. Digunakan untuk menghapus data report dari server. <br />
2. Tombol ini disarankan untuk digunakan setiap 3 atau 4 bulan sekali menghapus data report yang lampau yang tentunya telah di download oleh web Admin bentuk file dokumen  XLS (softcopynya) ke hardisk masing masing admin. <br />
3. Tombol ini bertujuan untuk tidak memberikan beban memory terlalu banyak ke server untuk membaca data yang sudah lampau. <br />
4. INGAT! dan HATI HATI! hanya dilakukan setelah dipastikan semua data file softcopy dokumen XLS telah selesai download terlebih dahulu oleh admin. 
    <br /><br /><br /><span id=\"s_load\"></span>";
	?>
    <br />
      <h2>Form Tambah Admin</h2>
      <form method="post" action="home.php">
      <table border="0" cellpadding="1" cellspacing="1" class="table_khusus">
      <tr class="tr_khusus">
      <td class="td_khusus">ID Admin</td><td class="td_khusus"><input type="text" name="user" id="user" size="30" class="input_teks" /></td>
      </tr>
      <tr class="tr_khusus">
      <td class="td_khusus">Password</td><td class="td_khusus"><input type="password" name="pass" size="30" class="input_teks" /></td>
      </tr>
      <tr class="tr_khusus">
      <td class="td_khusus">&nbsp;</td><td class="td_khusus"><input type="submit" name="tambah_admin" value="Tambah" /></td>
      </tr>
      </table>
      </form><h3><?php echo $hasil_submit; ?></h3>
      <div id="sidebar_container"></div>
      <!--<div class="content">
     
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/home.png" alt="home" /><h1 style="margin: 15px 0 0 0;">Welcome to the CSS3_two template</h1>
        <p>This simple, fixed width website template is released under a <a href="http://creativecommons.org/licenses/by/3.0">Creative Commons Attribution 3.0 Licence</a>. This means you are free to download and use it for personal and commercial projects. However, you <strong>must leave the 'design from css3templates.co.uk' link in the footer of the template</strong>.</p>
        <p>This template is written entirely in <strong>HTML5</strong> and <strong>CSS3</strong>.</p>
        <p>You can view more free CSS3 web templates <a href="http://www.css3templates.co.uk">here</a>.</p>
        <p>This template is a fully documented 5 page website, with an <a href="examples.html">examples</a> page that gives examples of all the styles available with this design. There is also a working PHP contact form on the contact page.</p>
        <p></p>
        <img style="float: left; vertical-align: middle; margin: 0 10px 0 0;" src="images/browser.png" alt="browser" /><h1 style="margin: 15px 0 0 0;">Browser Compatibility</h1>
        <p>This template has been tested in the following browsers:</p>
        <ul>
          <li>Internet Explorer 8</li>
          <li>Internet Explorer 7</li>
          <li>FireFox 10</li>
          <li>Google Chrome 17</li>
          <li>Safari 4</li>
        </ul>
      </div>-->
    </div>
     <div id="scroll">
      <a title="Scroll to the top" class="top" href="#"><img src="images/top.png" alt="top" /></a>
    </div>
    <footer>
      <p><!--<a href="index.html">Home</a> | <a href="examples.html">Examples</a> | <a href="page.html">A Page</a> | <a href="another_page.html">Another Page</a> | <a href="contact.php">Contact Us</a>--></p>
      <p><!--Copyright &copy; CSS3_two | <a href="http://www.css3templates.co.uk">design from css3templates.co.uk</a>--></p>
    </footer>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/animate_scroll_bawah.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
    });
	function hapusTransaksi(){
		if(confirm("Apa Anda yakin ingin menghapus semua data transaksi dan mereset kembali?")){
			var s=document.getElementById("s_load");
			s.innerHTML="<img src='images/loading2.gif' />";
			var xmlhttp;
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
  				xmlhttp=new XMLHttpRequest();
  			}else{// code for IE6, IE5
  				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
			xmlhttp.onreadystatechange=function(){
  				if (xmlhttp.readyState==4 && xmlhttp.status==200){
    				s.innerHTML="Semua Transaksi telah dihapus";
    			}
  			}
			xmlhttp.open("GET","hapus_transaksi.php",true);
			xmlhttp.send();
		}
	}
	function hapusAdmin(user){
		if(confirm("Apa Anda yakin ingin menghapus admin ini?")){
			document.location.href='hapus_admin.php?user='+user;
		}
	}
	function editPassAdmin(no){
		var id_adm=document.getElementById("td_id_admin_"+no).innerHTML;
		var pw=document.getElementById("pass_admin_"+no).value;
		var cpw=document.getElementById("pass_confirm_admin_"+no).value;
		if(pw.trim().length>0){
			if(cpw.trim().length>0){
				if(pw==cpw){
					if(confirm("Apa Anda yakin ingin update password untuk admin ini?")){
						var s=document.getElementById("s_load");
						s.innerHTML="<img src='images/loading2.gif' />";
						var xmlhttp;
						if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
  							xmlhttp=new XMLHttpRequest();
  						}else{// code for IE6, IE5
  							xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  						}
						xmlhttp.onreadystatechange=function(){
  							if (xmlhttp.readyState==4 && xmlhttp.status==200){
    							if(xmlhttp.responseText.trim().length>0){
									s.innerHTML=xmlhttp.responseText;
								}
    						}
  						}
						xmlhttp.open("GET","edit_pass_admin.php?user="+id_adm+"&pass="+pw,true);
						xmlhttp.send();
					}
				}else{
					alert("Konfirmasi password tidak sama");
				}
			}else{
				alert("Konfirmasi password baru yang ingin diubah");
			}
		}else{
			alert("Masukkan password baru yang ingin diubah");
		}
	}
  </script>
</body>
</html>
