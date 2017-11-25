(function($) {
	$.fn.streffect = function(option){

		// パラメータとデフォルト値のマージ
		var defaults = {
			class: 'streffect-container',
			effect: 'delay',
			interval: 100,
			wait: 0,
			trigger: null
		};
		var options = $.extend(defaults,option);

		// 初期処理
		var self = this;
		self.addClass(options.class);
		self.addClass(options.effect);

		var str = self.text().trim().split('');
		var html = '';
		var nbsp = String.fromCharCode( 160 );
		for (i=0; i<str.length; i++) {
			chr = (str[i] !== ' ') ? str[i] : nbsp;
			html += '<span>' + chr + '</span>';
		}

		self.html(html);

		// エフェクト定義
		var applyEffect = function(target) {
			target.css('visibility', 'visible');
			target.find('span').each(function(i) {
				$(this).delay(i*options.interval+options.wait).queue(function() {
					$(this).addClass('effect').dequeue();
				});
			});
		}

		// 処理実行
		if (options.trigger === 'scroll') {
			// 画面内に入ってきたらエフェクト実行
			$(window).on('load scroll', function() {
				var pos = $(window).scrollTop() + $(window).height();
				if (pos > self.offset().top) {
					applyEffect(self);
				}
			});
		} else {
			applyEffect(self);
		}

		//メソッドチェーンに対応するためthisを返す
		return(this);
	};

})(jQuery);

