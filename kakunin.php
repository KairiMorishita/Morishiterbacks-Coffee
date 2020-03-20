<?php
//セッション利用の宣言
session_start();

//セッションに保存したデータの取り出し
$name    = $_SESSION["name"];
$furi    = $_SESSION["furi"];
$email   = $_SESSION["email"];
$tel     = $_SESSION["tel"];
$naiyou  = $_SESSION["naiyou"];
$comment = $_SESSION["comment"];
?>

	<!--ページごと-->
	<link rel="stylesheet" href="css/contact.css">

	<?php include('header.php'); ?>


	<body>
	<div id="wrapper">

		<main>
    <div class="contactimg">
      <img src="images/contact.png">
		</div>

			<h2>お問い合わせフォーム（確認画面）</h2>
			<div>
				<form  method="post" action="soushin.php">
				<table>
				<tr>
					<th>名前&nbsp;</th>
					<td><?php echo $name ; ?></td>
				</tr>
				<tr>
					<th>ふりがな&nbsp;</th>
					<td><?php echo $furi; ?></td>
				</tr>
				<tr>
					<th>メールアドレス&nbsp;</th>
					<td><?php echo $email; ?></td>
				</tr>
				<tr>
					<th>電話番号&nbsp;</th>
					<td><?php echo $tel; ?></td>
				</tr>
				<tr>
					<th>お問い合わせ種別&nbsp;</th>
					<td>
						<?php
								if($naiyou === "1"){
										echo "メニューについて";
										}elseif($naiyou === "2"){
										echo "お店やサービスについて";
										}elseif($naiyou === "3"){
										echo "社員の募集について";
										}elseif($naiyou === "4"){
										echo "アルバイトの募集について";
										}elseif($naiyou === "5"){
										echo "このサイトについて";
										}elseif($naiyou === "6"){
										echo "ご意見ご要望";
										}
							?>
					</td>
				</tr>
				<tr>
					<th>お問い合わせ内容&nbsp;</th>
					<td><?php echo nl2br($comment); ?></td>
				</tr>
			</table>
		    <a href="contact.php?henkou=yes">入力内容を変更する</a>
				<input type="submit" name="kakutei" value="入力内容を送信する">
				<input type="submit" name="cancel" value="キャンセル">
			</form>
			</div>
			</main>

	<?php include('footer.php'); ?>

</div>
</body>
</html>
