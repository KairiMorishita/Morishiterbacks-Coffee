<?php
if(isset($_GET["code"])){
	$code = $_GET["code"];
}else{
	header("Location: goodslist.php");
	exit;
}

//==============================================================================
//■データベース情報を設定
//==============================================================================
$dsn = 'mysql:dbname=morishiterbacks;host=localhost;charset=utf8';

$user = 'root';  //ユーザー名
$password = '';  //パスワード

//==============================================================================
//■try(正常処理)
//==============================================================================
try{
	//PDOオブジェクトの作成
	$dbh = new PDO($dsn, $user, $password);

//==============================================================================
//■エラーの表示内容を指定
//　setAttribute：データベースハンドルの属性を設定
//　PDO::ATTR_ERRMODE　エラーレポート
//　PDO::ERRMODE_EXCEPTION　DB操作中に問題が発生した場合、その内容を受け取る
//　PDO::ERRMODE_SILENT: エラーコードのみ受け取る
//==============================================================================
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//==============================================================================
//■SQL命令
//　実行するSQL命令を変数に代入
//==============================================================================
	$sql = "select * from goods where code=:code";

//==============================================================================
//■SQL命令の実行の準備
//==============================================================================
	$stmt = $dbh->prepare($sql);

//==============================================================================
//■変数のあてはめを設定
//　値が文字列の場合　$stmt -> bindValue(':名前' , 値が代入されている変数名 , PDO::PARAM_STR);
//　値が数値の場合　　$stmt -> bindValue(':名前' , 値が代入されている変数名 , PDO::PARAM_INT);
//==============================================================================
$stmt -> bindValue(':code' , $code , PDO::PARAM_STR);

//==============================================================================
//■SQL命令の実行
//==============================================================================
	$stmt->execute();

//==============================================================================
//■データ抽出の場合、以下の処理を行う
//　　抽出結果を保存するために、配列（$data）を用意　$data = array();
//　　抽出結果がなくなるまで、1件ずつ連想配列形式でデータを取得
//==============================================================================
	$data = array();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$data[] = $row;
	}

//==============================================================================
//■抽出結果件数を取得
//==============================================================================
	$count = $stmt->rowCount();

//==============================================================================
//■エラー発生時（例外処理）
//　PDOException $e  $eにエラー内容を格納
//　echo($e->getMessage());　例外メッセージを取得してエラーを表示
//　die()　処理を停止
//==============================================================================
}catch (PDOException $e){
	echo($e->getMessage());
	die();
}
?>

		<!--ページごと-->
		<link rel="stylesheet" href="css/goods_detail.css">

		<?php include('header.php'); ?>

<body>

<div id="container" class="clearfix">
<div id="left">
	<nav id="lnav">
		<ul>
			<li><a href="goodslist.php">すべて</a></li>
			<li><a href="goodslist.php?cate=1">コーヒーマシン・器具</a></li>
			<li><a href="goodslist.php?cate=2">コーヒー豆</a></li>
			<li><a href="goodslist.php?cate=3">マグカップ</a></li>
		</ul>
	</nav>
</div>

<div id="right">
		<main>
		<h2>商品詳細</h2>
		<div class="product clearfix">
		<?php foreach($data as $row){ ?>
			<img src="images/<?php echo $row["picture"] ?>">

		<form method="get" action="cart.php">
			<table>
				<!--
				<tr>
					<th>商品コード</th>
					<td><?php echo $row["code"] ?></td>
				</tr>
				-->
				<tr>
					<th>商品名</th>
					<td><?php echo $row["hinmei"] ?></td>
				</tr>
				<tr>
					<th>販売価格</th>
					<td><?php echo $row["price"] ?>円</td>
				</tr>
				<tr>
					<th>商品説明</th>
					<td><?php echo $row["description"] ?></td>
				</tr>
				<tr>
					<th>数量</th>
					<td><input type="text" name="suu" value="1"></td>
				</tr>

			</table>

			<div class="btn">
				<button type="submit">
					<img src="images/cartin.png" alt=""カートに入れる>
				</button>
			</div>
				<input type="hidden" name="code" value="<?php echo $row["code"]; ?>">
				<input type="hidden" name="hinmei" value="<?php echo $row["hinmei"]; ?>">
				<input type="hidden" name="price" value="<?php echo $row["price"]; ?>">
			</form>

			<?php } ?>
		</div>

		</main>

		</div>
</div><!-- containerの終わり -->

		<?php include('footer.php'); ?>


</body>
</html>
