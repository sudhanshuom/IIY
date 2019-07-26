<?php if($user==""){$user= $_REQUEST["ses"]; $ses=$user;}
$dbfound=0;

date_default_timezone_set("Asia/Calcutta");
		$helpno="HelpLine No. 01651-255478";
		
			$hostname = 'localhost';
			$username = 'shoping7888';
			$password = 'IXmnLAL1NvMm';
			$dbb='shopinguytuy46546546546';
			
			$login_name='mtfort';
			$news_color='#ffffff';
			$facebook='https://facebook.com';
			$twitter='https://twitter.com';
			$youtube='https://youtube.com';
			$appnm='https://play.google.com/store/apps/details?id=aouji.edu.mtfort';
			$adminbg="#2b4f3b";



			try {
				GLOBAL $dbh;
			   $dbh = new PDO("mysql:host=$hostname;dbname=$dbb", $username, $password);
//			require_once"fun.php";
			define("GOOGLE_API_KEY", "AIzaSyBt9xzRIlSPe8SDJfjpUGqq--ToGr1L4LI");
			
			}
			catch(PDOException $e)
				{
				echo "Error: ".$e->getMessage();
				}

 

?>