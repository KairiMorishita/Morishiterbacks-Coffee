<?php
//変数の初期化
$cate = "";
$catename = "";

//カテゴリが送信された場合
if(isset($_GET["cate"])){
	$cate = (int)$_GET["cate"];
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
	$sql = "select * from goods";
	$catename = "全て";

	if($cate === 1){
		$sql = " select * from goods where category = 1";
		$catename = "コーヒーマシン・器具";
	}elseif($cate === 2){
		$sql = "select * from goods where category = 2";
		$catename = "コーヒー豆";
	}elseif($cate === 3){
		$sql = "select * from goods where category = 3";
		$catename = "マグカップ";
	}

//==============================================================================
//■SQL命令の実行の準備
//==============================================================================
	$stmt = $dbh->prepare($sql);

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
		<link rel="stylesheet" href="css/goodslist.css">

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
	<h2>取扱商品一覧</h2>
			<p><?php echo $catename; ?>（商品数：<?php echo $count; ?>件）</p>

		<div class="wrapper clearfix">
		<?php foreach($data as $row){ ?>
		<a href="goods_detail.php?code=<?php echo $row["code"]; ?>">
			<div class="productbox">
				<img src="images/<?php echo $row["picture"]; ?>" alt=""><br>
				<!-- <?php echo $row ["code"]?><br> -->
				<span><?php echo $row ["hinmei"]?></span><br>
				<?php echo $row["price"]?>円（税込み）<br>
			</div>
		</a>
			<?php } ?>
		</div>
		</main>
		</div>
</div><!-- containerの終わり -->

	</main>

		<?php include('footer.php'); ?>

</div>
</body>
</html>
