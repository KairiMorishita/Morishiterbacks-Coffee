//配列の定義
let topg = ["images/slide1.jpg",
						"images/slide3.png",
						"images/slide2.png",
						"images/slide4.jpg",
						"images/slide5.jpg",];


//変数の定義
let current = 0;

//スライドショー
function anime1(){
	current++;
	if(current >= 5){
	current = 0;
	}
	document.getElementById("topgazou").src = topg[current];

	setTimeout('anime1()',1500);  //再帰関数
}

//スライドショーの開始
function animestart(){
	setTimeout('anime1()',1500);
}
