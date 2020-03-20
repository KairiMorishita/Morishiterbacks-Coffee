<?php
//セッション利用の宣言
session_start();

//初期値設定
$name = "";
$addr = "";
$siharai = "";
$mail = "";


//エラーメッセージ用
$name_err = "";
$addr_err = "";
$siharai_err = "";
$mail_err = "";


//エラーフラグ　0:なし　1:あり
$errflg = 0;

//POSTされた時値を取得
if($_SERVER['REQUEST_METHOD'] === "POST"){
	$name = htmlspecialchars($_POST["name"],ENT_QUOTES,"UTF-8");
	$addr = htmlspecialchars($_POST["addr"],ENT_QUOTES,"UTF-8");
	$siharai = htmlspecialchars($_POST["siharai"],ENT_QUOTES,"UTF-8");
	$mail = htmlspecialchars($_POST["mail"],ENT_QUOTES,"UTF-8");


//全角・半角の変換
$name = mb_convert_kana($name,"KV","UTF-8");
$addr = mb_convert_kana($addr,"KV","UTF-8");
$siharai = mb_convert_kana($siharai,"KV","UTF-8");
$mail = mb_convert_kana($mail,"KV","UTF-8");

//エラーチェック
if(mb_strlen($name)===0){
	$name_err = '<p class="error">※名前を入力して下さい</p>';
	$errflg = 1;
}

if(mb_strlen($addr)===0){
	$addr_err = '<p class="error">※住所を入力して下さい</p>';
	$errflg = 1;
}

if($siharai===""){
	$siharai_err = '<p class="error">※支払方法を選択して下さい</p>';
	$errflg = 1;
}

if(mb_strlen($mail)===0){
	$mail_err = '<p class="error">※メールアドレスを入力して下さい</p>';
	$errflg = 1;
}


	if($errflg === 0){
		$_SESSION["name"] = $name;
		$_SESSION["addr"] = $addr;
		$_SESSION["siharai"] = $siharai;
		$_SESSION["mail"] = $mail;


		header("Location: regi_kakunin.php");
		exit;
	}

}
?>

		<!--ページごと-->
		<link rel="stylesheet" href="css/regi.css">

		<?php include('header.php'); ?>

<body>
<div id="container">
	<main>
	<h2>購入者情報入力</h2>
	<form method="post" action="regi.php">
		<table>
			<tr>
				<th>名前</th>
				<td>
					<input type="text" name="name" value="">
						<?php echo $name_err; ?>
				</td>
			</tr>
			<tr>
				<th>住所</th>
				<td>
					<input type="text" name="addr" value="">
						<?php echo $addr_err; ?>
				</td>
			</tr>
			<tr>
				<th>お支払方法</th>
				<td>
					<select name="siharai">
							<option value=""<?php if($siharai === ""){ echo " selected"; } ?>>下記支払方法から選択してください</option>
								<option value="1"<?php if($siharai === "1"){ echo " selected"; } ?>>クレジットカード</option>
								<option value="2"<?php if($siharai === "2"){ echo " selected"; } ?>>代金引き替え</option>
								<option value="3"<?php if($siharai === "3"){ echo " selected"; } ?>>口座振替（自動引き落とし）</option>
								<option value="4"<?php if($siharai === "4"){ echo " selected"; } ?>>コンビニ決済</option>
					</select>
						<?php echo $siharai_err; ?>
				</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td>
					<input type="text" name="mail" value="">
						<?php echo $mail_err; ?>
				</td>
			</tr>

		</table>
	<div class="btn">
		<button type="submit">
			<img src="images/regi_kakunin.png" alt="内容を確認する">
		</button>
	</div>
	</form>
	</main>
</div>

		<?php include('footer.php'); ?>


</body>
</html>
