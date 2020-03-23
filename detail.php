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
$dbname = getenv('DB_DATABASE');
$dbhost = getenv('DB_HOST');
$dbusername = getenv('DB_USERNAME');
$dbpassword = getenv('DB_PASSWORD');

$dsn = 'mysql:dbname='.$dbname.';host='.$dbhost.';charset=utf8';

$user = $dbusername;  //ユーザー名
$password = $dbpassword;  //パスワード

$options = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
);

//==============================================================================
//■try(正常処理)
//==============================================================================
try{
	//PDOオブジェクトの作成
	$dbh = new PDO($dsn, $user, $password, $options);

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
	$sql = "select * from menues where code=:code";

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
		<link rel="stylesheet" href="css/detail.css">


<body>

<?php include('header.php'); ?>


<div id="container" class="clearfix">
<div id="left">
	<nav id="lnav">
		<ul>
			<li><a href="menues.php">すべて</a></li>
			<li><a href="menues.php?cate=1">フード</a></li>
			<li><a href="menues.php?cate=2">デザート</a></li>
			<li><a href="menues.php?cate=3">ドリンク</a></li>
		</ul>
	</nav>
</div>

<div id="right">
		<main>
		<h2>メニュー詳細</h2>
		<div class="product clearfix">
		<?php foreach($data as $row){ ?>
			<img src="images/<?php echo $row["picture"] ?>">
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
			</table>

			<?php } ?>
		</div>

		</main>

		</div>
</div><!-- containerの終わり -->

		<?php include('footer.php'); ?>


</body>
</html>
