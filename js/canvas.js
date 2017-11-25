/*
 * ヘッダー画像が指定されなかった場合の初期背景を生成する
 */

/*
 * 背景クラス
 */
function Background(id) {
	this.background = document.getElementById(id);
	this.bgCtx;
	this.circles;
	this.color = {};

	/*
	 * 初期化
	 */
	this.init = function(size, color) {
		// 色指定がない場合はランダム
		var c_random = false;
		if (typeof color === 'undefined') {
			c_random = true;
		}

		// 必要なオブジェクトを準備
		if(this.background.getContext) { // 描画環境が整ったら実行
			this.bgCtx = this.background.getContext('2d'); // 2Dの描画ツールをbgCtx変数に取得
			this.circles = new Array(size); // circle配列を作成
			for(i = 0; i < this.circles.length; i++) {
				var x = Math.random() * this.background.width;
				var y = Math.random() * this.background.height;
				var r = Math.random() * (this.background.height/7);
				var dir_x = Math.random() * 1 - 0.5;
				var dir_y = Math.random() * 1 - 0.5;
				var opacity = Math.random() * 0.5;
				if (c_random === true) {
					color = {};
					color.hue = Math.random() * 360;
					color.saturation = 70;
					color.luminance = Math.random() * 50 + 50;
				}
				this.circles[i] = new Circle(x, y, dir_x, dir_y, r, opacity, color);
			}
		}
	}

	/*
	 * 更新
	 */
	this.update = function() {
		for (i = 0; i < this.circles.length; i++) { // 図形を配列の長さ分だけ描画する
			this.circles[i].update(this.background.width, this.background.height);
		}
	}

	/*
	 * 描画
	 */
	this.draw = function() {
		this.bgCtx.clearRect(0, 0, this.background.width, this.background.height); // キャンバスをクリア
		for (i = 0; i < this.circles.length; i++) { // 図形を配列の長さ分だけ描画する
			this.circles[i].draw(this.bgCtx); // 四角形を描画する
		}
	}

}

/*
 * 円クラス
 */
function Circle(x, y, dir_x, dir_y, radius, opacity, color) {
	this.x = x;				// X軸座標
	this.y = y;				// Y軸座標
	this.radius = radius;	// 半径
	this.opacity = opacity;	// 透明度
	this.color = color;		// 色
	this.dir_x = dir_x;		// x方向の移動距離
	this.dir_y = dir_y;		// y方向の移動距離

	/*
	 * 更新
	 */
	this.update = function(width, height) {
		this.x += this.dir_x;
		this.y += this.dir_y;

		// 画面範囲外になったら反対側に移動
		if (this.x + this.radius < 0) {
			this.x = width + this.radius;
		} else if (this.x - this.radius > width) {
			this.x = -1 * this.radius;
		}
		if (this.y + this.radius < 0) {
			this.y = height + this.radius;
		} else if (this.y - this.radius > height) {
			this.y = -1 * this.radius;
		}
	}

	/*
	 * 描画
	 */
	this.draw = function(ctx) {
		ctx.beginPath();
		var grad = ctx.createRadialGradient(this.x,this.y,0,this.x,this.y,this.radius);
		grad.addColorStop(0, "hsla(" + this.color.hue + "," + this.color.saturation + "%," + this.color.luminance + "%," + this.opacity + ")");
		grad.addColorStop(0.8, "hsla(" + this.color.hue + "," + this.color.saturation + "%," + this.color.luminance + "%," + this.opacity + ")");
		grad.addColorStop(1, "hsla(" + this.color.hue + "," + this.color.saturation + "%," + this.color.luminance + "%,0)");
		ctx.fillStyle = grad;
		ctx.arc(this.x, this.y, this.radius, 0, Math.PI*2, false);
		ctx.fill();
	};

}

/*
 * 初期処理
 */
jQuery(document).ready(function($) {
	var background = new Background('header-canvas');

	// 画面ロード時
	$(window).on('load', function() {
		// canvasがあったら処理
		if ($('#header-canvas').length) {
			// canvasの大きさ指定
			$('#header-canvas').attr({
				'width': $('#header').width(),
				'height': $('#header').height()
			});

			// 描画
			background.init(30, get_color(color_scheme));
			var interval = setInterval(function() {
				background.update();
				background.draw();
			}, 1000/30);
		}
	});

	// 画面リサイズ時
	$(window).on('resize', function() {
		if ($('#header-canvas').length) {
			// canvasの大きさ指定
			$('#header-canvas').attr({
				'width': $('#header').width(),
				'height': $('#header').height()
			});
		}
	});

	/*
	 * 配色設定値からcolorを取得
	 */
	function get_color(color_scheme) {
		var color = {};
		switch (color_scheme) {
		case 'color-blue' :
			color.hue = 196;
			color.saturation = 60;
			color.luminance = 70;
			break;
		case 'color-light' :
			color.hue = 0;
			color.saturation = 0;
			color.luminance = 60;
			break;
		case 'color-coffee' :
			color.hue = 27;
			color.saturation = 31;
			color.luminance = 78;
			break;
		case 'color-ectoplasm' :
			color.hue = 70;
			color.saturation = 62;
			color.luminance = 71;
			break;
		case 'color-midnight' :
			color.hue = 3;
			color.saturation = 70;
			color.luminance = 88;
			break;
		case 'color-ocean' :
			color.hue = 124;
			color.saturation = 15;
			color.luminance = 72;
			break;
		case 'color-sunrise' :
			color.hue = 26;
			color.saturation = 73;
			color.luminance = 86;
			break;
		default :
			color.hue = 194;
			color.saturation = 100;
			color.luminance = 82;
			break;
		}

		return color;
	}
});
