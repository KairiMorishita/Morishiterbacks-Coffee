<?php
session_start();

$flg = 0; //0:初期値　１：キャンセル　２：確定



if($_SERVER['REQUEST_METHOD']==='POST'){
	if(isset($_POST["cancel"])){
	$flg = 1;
	$_SESSION = array();
	$session_name = session_name();
	if (isset($_COOKIE[$session_name]) === TRUE){
		setcookie($session_name, '', time() - 3600,'/');
	}

	session_destroy();
	}elseif(isset($_POST["kakutei"])){
	$flg = 2;


//セッションに保存されているデータを変数に代入
	$name = $_SESSION["name"];
	$furi = $_SESSION["furi"];
	$email = $_SESSION["email"];
	$tel = $_SESSION["tel"];
	$naiyou = $_SESSION["naiyou"];
	$comment = $_SESSION["comment"];

	$comment = str_replace(array("\n\n","\r","\h"),'',$comment);

	//$foods = implode("to",$food);

	//受信した日付と時間
	$hiduke = date("Y/m/d.H.i.s");

	//入力データを一つにまとめる
	$data="";
	$data .= $hiduke . ",";
	$data .= $name   . ",";
	$data .= $furi   . ",";
	$data .= $email   . ",";
	$data .= $tel   . ",";
	$data .= $naiyou   . ",";
	$data .= $comment   . "\n";

	$file = @fopen('data.csv','a') or die('data.csvファイルオープン');
	flock($file,LOCK_EX);
	fwrite($file,$data);
	flock($file,LOCK_UN);
	fclose($file);

	$_SESSION = array();
	$session_name = session_name();
	if (isset($_COOKIE[$session_name]) === TRUE){
		setcookie($session_name, '', time() - 3600,'/');
}

session_destroy();
	}
}
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title><?php
		if($flg === 1){
			echo "キャンセル";
		}elseif($flg === 2){
			echo "確定";
		}
		?></title>
		<!--リセット-->
		<link rel="stylesheet" href="css/reset.css">

		<!--ページごと-->
		<link rel="stylesheet" href="css/soushin.css">
	</head>

			<?php include('header.php'); ?>

	<body>
	<div id="wrapper">

		<main>
				<h2>
				<?php
			if($flg === 1){
				echo "キャンセル";
			}elseif($flg === 2){
				echo "確定";
			}
			?></h2>
			<?php if($flg === 1){ ?>
				<p>キャンセルしました。</p>
			<?php }elseif($flg === 2){ ?>
				<p>お問い合わせいただきありがとうございました。</p>
			<?php } ?>
		</main>
</div>

		<?php include('footer.php'); ?>

</body>
</html>
