<?php
$hasil="";
if(isset($_POST['user']) && isset($_POST['pass'])){
	include("koneksi.php");
	$user=mysql_real_escape_string($_POST['user']);
	$pass=md5(mysql_real_escape_string($_POST['pass']));
	$user=trim($user);
	$query="select user_id,jabatan from tbl_admin where user_id='$user' and pass='$pass'";
	$cek=mysql_query($query);
	if(mysql_num_rows($cek)==1){
		while($hs=mysql_fetch_array($cek)){
			$user_id=$hs['user_id'];
			$jabatan=$hs['jabatan'];
			/*$fp=fopen("list_barang_da.txt","w+");
			$data_barang="";
			$query="select kategori from tbl_list_barang_da";
			$ambil=mysql_query($query);
			while($hs=mysql_fetch_array($ambil)){
				$data_barang.=$hs['kategori']."#";
			}
			$data_barang=substr($data_barang,0,strlen($data_barang)-1);
			fwrite($fp,$data_barang,strlen($data_barang));
			fclose($fp);*/
			session_start();
			$_SESSION['user']=$user_id;
			$_SESSION['pass']=$pass;
			$_SESSION['jabatan']=$jabatan;
			if($_SESSION['jabatan']=="Master Admin"){
				header("location:home.php");
			}else{
				header("location:store.php");
			}
		}
	}else{
		$hasil="User ID atau Password Salah";
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
          <h2>Info Segala Macam Transaksi Philips</h2>--></div>
      </div>
      <nav>
        <div id="menu_container"><!--
          <ul class="sf-menu" id="nav">
            <li><a href="index.html">Home</a></li>
            <li><a href="examples.html">Examples</a></li>
            <li><a href="page.html">A Page</a></li>
            <li><a href="another_page.html">Another Page</a></li>
            <li><a href="#">Example Drop Down</a>
              <ul>
                <li><a href="#">Drop Down One</a></li>
                <li><a href="#">Drop Down Two</a>
                  <ul>
                    <li><a href="#">Sub Drop Down One</a></li>
                    <li><a href="#">Sub Drop Down Two</a></li>
                    <li><a href="#">Sub Drop Down Three</a></li>
                    <li><a href="#">Sub Drop Down Four</a></li>
                    <li><a href="#">Sub Drop Down Five</a></li>
                  </ul>
                </li>
                <li><a href="#">Drop Down Three</a></li>
                <li><a href="#">Drop Down Four</a></li>
                <li><a href="#">Drop Down Five</a></li>
              </ul>
            </li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>--></div>
      </nav>
    </header>
    <div id="site_content"><!--
      <div id="sidebar_container">
        <img class="paperclip" src="images/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <h3>Latest News</h3>
          <h4>New Website Launched</h4>
          <h5>January 1st, 2012</h5>
          <p>2012 sees the redesign of our website. Take a look around and let us know what you think.<br /><a href="#">Read more</a></p>
        </div>
        <img class="paperclip" src="images/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <h3>Useful Links</h3>
          <ul>
            <li><a href="#">First Link</a></li>
            <li><a href="#">Another Link</a></li>
            <li><a href="#">And Another</a></li>
            <li><a href="#">Last One</a></li>
          </ul>
        </div>
        <img class="paperclip" src="images/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <h3>More Useful Links</h3>
          <ul>
            <li><a href="#">First Link</a></li>
            <li><a href="#">Another Link</a></li>
            <li><a href="#">And Another</a></li>
            <li><a href="#">Last One</a></li>
          </ul>
        </div>
      </div>-->
      <div class="content">
      <h1 style="margin: 15px 0 0 0; text-align:center;">Silahkan Login</h1>
      <div align="center">
      <?php
			echo "<h2>$hasil</h2>";
	  ?>
      <form method="post" action="index.php">
      <table border="0" cellpadding="3" cellspacing="3" class="table_khusus" style="margin-bottom:40px;">
      <tr class="tr_khusus">
      <td class="td_khusus">ID Admin</td><td class="td_khusus"><input type="text" name="user" size="30" /></td>
      </tr>
      <tr class="tr_khusus">
      <td class="td_khusus">Password</td><td class="td_khusus"><input type="password" name="pass" size="30" /></td>
      </tr>
      <tr class="tr_khusus">
      <td class="td_khusus">&nbsp;</td><td class="td_khusus"><input type="submit" name="login" value="Login" /></td>
      </tr>
      </table></form></div><br /><br />
      <!--
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
        </ul>-->
      </div>
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
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
      $('.top').click(function() {$('html, body').animate({scrollTop:0}, 'fast'); return false;});
    });
  </script>
</body>
</html>