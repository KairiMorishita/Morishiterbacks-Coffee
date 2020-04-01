<?php
//セッション利用の宣言
session_start();

//変数の初期化
$name = "";
$furi = "";
$email = "";
$tel = "";
$naiyou = "";
$comment = "";

//配列の初期化
//配列の定義

//エラーメッセージ用
$name_err = "";
$furi_err = "";
$email_err = "";
$tel_err = "";
$naiyou_err = "";
$comment_err = "";

$errflg = 0;

//データの受け取り

//POSTされた時
if($_SERVER['REQUEST_METHOD']==='POST'){
	$name = htmlspecialchars($_POST["name"],ENT_QUOTES,'UTF-8');
	$furi = htmlspecialchars($_POST["furi"],ENT_QUOTES,'UTF-8');
	$email = htmlspecialchars($_POST["email"],ENT_QUOTES,'UTF-8');
	$tel = htmlspecialchars($_POST["tel"],ENT_QUOTES,'UTF-8');
	$naiyou = htmlspecialchars($_POST["naiyou"],ENT_QUOTES,'UTF-8');
	$comment = htmlspecialchars($_POST["comment"],ENT_QUOTES,'UTF-8');

	//全角・半角の変換
	$name = mb_convert_kana($name,'k','UTF-8');
	$comment = mb_convert_kana($comment,'h','UTF-8');

//エラーチェック

//名前（テキストボックス）
if(mb_strlen($name) === 0){
	$name_err = '<p class="error">※名前を入力して下さい。</p>';
	$errflg = 1;
}

//ふりがな（テキストボックス）
if(mb_strlen($furi) === 0){
	$furi_err = '<p class="error">※フリガナを入力して下さい。</p>';
	$errflg = 1;
}

//メールアドレス（テキストボックス）
if(mb_strlen($email) === 0){
	$email_err = '<p class="error">※メールアドレスを入力して下さい。</p>';
	$errflg = 1;
}

//電話番号（テキストボックス）
if(mb_strlen($tel) === 0){
	$tel_err = '<p class="error">※電話番号を入力して下さい。</p>';
	$errflg = 1;
}


//お問い合わせ種別（セレクトメニュー）
if($naiyou === ""){
	$naiyou_err = '<p class="error">※お問い合わせ内容を選択して下さい</p>';
	$errflg = 1;
}


//お問い合わせ内容（テキストエリア）
if(mb_strlen($comment) === 0){
	$comment_err = '<p class="error">※お問い合わせ内容を入力して下さい。</p>';
	$errflg = 1;
}

//エラーが無い場合、kakunin.phpへジャンプする
if($errflg === 0){
	$_SESSION["name"]    = $name;
	$_SESSION["furi"]      = $furi;
	$_SESSION["email"] = $email;
	$_SESSION["tel"]    = $tel;
	$_SESSION["naiyou"]  = $naiyou;
	$_SESSION["comment"] = $comment;

	header("Location: kakunin.php");
	exit;
}
}

//データの修正
if(isset($_GET["henkou"])){
	$name    = $_SESSION["name"];
	$furi      = $_SESSION["furi"];
	$email = $_SESSION["email"];
	$tel    = $_SESSION["tel"];
	$naiyou  = $_SESSION["naiyou"];
	$comment = $_SESSION["comment"];
}


//エラーの有無
$errflg = 0;     //0なし　１あり

?>

		<!--ページごと-->
		<link rel="stylesheet" href="css/contact.css">

		<?php include('header.php'); ?>


		<main>
    <div class="contactimg">
      <img src="images/contact.png">
		</div>

			<h2>お問い合わせフォーム（入力画面）</h2>
			<div>
				<form method="post" action="contact.php">
				<table>
				<tr>
					<th>名前&nbsp;<span class="hissu">必須</span></th>
					<td>
						<input type="text" name="name" placeholder="山田太郎" autofocus value="<?php echo $name; ?>">
						<?php echo $name_err; ?>
					</td>
				</tr>
				<tr>
					<th>ふりがな&nbsp;<span class="hissu">必須</span></th>
					<td>
						<input type="text" name="furi" placeholder="やまだたろう" value="<?php echo $furi; ?>">
					  <?php echo $furi_err; ?>
					</td>
				</tr>
				<tr>
					<th>メールアドレス&nbsp;<span class="hissu">必須</span></th>
					<td>
						<input type="text" name="email" placeholder="※morishiterbacks@example.com" value="<?php echo $email; ?>">
					  <?php echo $email_err; ?>
					</td>
				</tr>
				<tr>
					<th>電話番号&nbsp;<span class="hissu">必須</span></th>
					<td>
						<input type="text" name="tel" placeholder="※000-1234-5678" value="<?php echo $tel; ?>">
					  <?php echo $tel_err; ?>
					</td>
				</tr>
				<tr>
					<th>お問い合わせ種別&nbsp;<span class="hissu">必須</span></th>
					<td>
						<select name="naiyou">
							<option value=""<?php if($naiyou === ""){ echo " selected"; } ?>>選択してください</option>
							<optgroup label="下記内容からお選び下さい">
								<option value="1"<?php if($naiyou === "1"){ echo " selected"; } ?>>メニューについて</option>
								<option value="2"<?php if($naiyou === "2"){ echo " selected"; } ?>>お店やサービスについて</option>
								<option value="3"<?php if($naiyou === "3"){ echo " selected"; } ?>>社員の募集について</option>
								<option value="4"<?php if($naiyou === "4"){ echo " selected"; } ?>>アルバイトの募集について</option>
								<option value="5"<?php if($naiyou === "5"){ echo " selected"; } ?>>このサイトについて</option>
								<option value="6"<?php if($naiyou === "6"){ echo " selected"; } ?>>ご意見ご要望</option>
							</optgroup>
						</select>
						<?php echo $naiyou_err; ?>
					</td>
				</tr>
				<tr>
					<th>お問い合わせ内容&nbsp;<span class="hissu">必須</span></th>
					<td><textarea name="comment" placeholder="お店のWi-Fiの環境を改善してほしい。" value="<?php echo $comment; ?>"></textarea>
					<?php echo $comment_err; ?>
				</tr>
			</table>

			<button type="submit">
				<img src="images/regi_kakunin.png" alt="内容を確認する">
			</button>
			</form>
			</div>
		</main>

		<?php include('footer.php'); ?>

</div>
</body>
</html>
