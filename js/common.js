/*
 * 共通s
 */
var headerHeight;
var windowHeight;
var touchable = ("ontouchstart" in document) ? true : false;
var v_click = (touchable) ? 'touchstart' : 'click';

jQuery(document).ready(function($) {
	/*
	 * 初回処理
	 */
	onResizeContainer();	// サイズ設定
	resetGNav();			// Gnavi設定
	autoToggleSidebar();	// サイドバー設定
	objectFitImages();		// object-fit対応

	// サイドバーカスタムスクロール
	$('#side').mCustomScrollbar({
		theme: 'minimal',
	});

	// タイトルエフェクト
	$('#header .page-title').streffect({
		wait: 1000
	});
	if (!$('body').hasClass('single')) {	// 投稿ページ以外
		$('#header .description').streffect({
			effect: 'typewriter',
		});
	}

	// サイドバー開閉
	$('#gnav .menu-btn').on('click', 'a', function() {
		if ($('#contents').hasClass('side-close')) {
			$('#contents').removeClass('side-close');
			$('html,body').animate( {scrollTop: $('#contents').offset().top-49 }, 500, 'swing' );
		} else {
			$('#contents').addClass('side-close');
		}
		return false;
	});

	/*
	 * グローバルメニュー開閉
	 */
	// トップメニューホバー時
	// サブメニューエリアを開く
	$('#gnav .menu-item-has-children').on({
		'mouseenter' : function() {
			var title = $(this).children('a').clone(false);
			var html = $(this).children('.sub-menu').html();
			$('#gnav-open .title').html('').append(title);
			$('#gnav-open .main-menu').html(html);
			$('#gnav-open').fadeIn('fast');
			return false;
		},
	});
	$('#gnav .menu-item:not(.menu-item-has-children)').on({
		'mouseenter' : function() {
			$('#gnav-open').fadeOut('fast', function() {
				$(this).children('.title').html('');
				$(this).children('.main-menu').html('');
			});
//			$('#gnav-open .title').html('');
//			$('#gnav-open .main-menu').html('');
		},
	});

	// サブメニューホバー解除時
	// サブメニューエリアを閉じる
	$('#gnav-open').on({
		'mouseleave' : function() {
//			$(this).children('.title').html('');
//			$(this).children('.main-menu').html('');
			$(this).fadeOut('fast', function() {
				$(this).children('.title').html('');
				$(this).children('.main-menu').html('');
			});
		},
	});

	// サイドバーのグローバルメニュー開閉
	$('#side .widget.main-menu .menu-item.menu-item-has-children > a').on('click', function(event) {
		var parent = $(this).parent();
		if (!parent.hasClass('children-open')) {
			parent.addClass('children-open');
			$(this).next().slideToggle('fast');
			return false;
		}
		return true;
	});

	// 外部リンクは別ウィンドウに
	$('a').each(function() {
		href = $(this).attr('href');
		if (href.indexOf(home_url, 0) === -1) {
			$(this).attr('target', '_blank');
		} else if (href.indexOf(admin_url, 0) === -1) {
			$(this).addClass('local-link');
		}
	});

	// #のみリンクは無効
//	 $('a[href=#]').click(function() {
//	 	return false;
//	 });

	/*
	 * スクロール時の処理
	 */
	$(window).scroll(function() {
		var pos = $(window).scrollTop();

		// ヘッダー固定
		resetGNav(pos);

		// ヘッダー画像のパララックス
		scalex = (pos <= 200) ? 1-pos/200 : 0;
		// $('#header .header-bg.has-image').css({
		$('#header .header-bg').css({
			'transform' : 'translate3d(0,' + (pos/1.5) + 'px,0)',
			'filter' : 'blur(' + pos/20 + 'px)'
		})
		$('#header .wrap').css({
			'filter' : 'blur(' + pos/10 + 'px)'
		})

		// ふわっと表示
		showDelay(pos);
	});

	$(window).on('load', function() {
	});

	/*
	 * ウィンドウリサイズの時
	 */
	$(window).on('load resize', function() {
		var pos = $(window).scrollTop();
		var width = $(window).width();

		// リサイズ設定
		onResizeContainer();

		// ヘッダー固定
		resetGNav(pos);

		// ふわっと表示
		showDelay(pos);

		// 画面幅によってサイドバーを開閉
		autoToggleSidebar(width);

		// load完了
		$('body').addClass('loaded');
	});

	/*
	 * gnavi設定
	 */
	function resetGNav(pos) {
		if (typeof pos === 'undefined') {
			pos = $(window).scrollTop();
		}
		if (pos >= (headerHeight-50)) {
			$('#gnav').addClass('header-fixed');
			$('#gnav-open').addClass('header-fixed');
		} else {
			$('#gnav').removeClass('header-fixed');
//			$('#gnav').css('top', headerHeight-50);
			$('#gnav-open').removeClass('header-fixed');
//			$('#gnav + #gnav-open').css('top', headerHeight);
		}
	}

	/*
	 * ふわっと表示
	 */
	function showDelay(pos) {
		pos += (windowHeight * 0.9);
		$('.slidein.hidden').each(function() {
			if (pos > $(this).offset().top) {
				$(this).removeClass('hidden');
			}
		});
	}

	/*
	 * サイドバー自動開閉
	 */
	function autoToggleSidebar(width) {
		if (typeof width === 'undefined') {
			width = $(window).width();
		}
		if ((width > 768) && $('#side').hasClass('auto-toggle')) {
			if (width > 960) {
				$('#contents').removeClass('side-close');
			} else {
				$('#contents').addClass('side-close');
			}
		}
	}

	/*
	 * リサイズ設定
	 */
	function onResizeContainer(width) {
		if (typeof width === 'undefined') {
			width = $(window).width();
		}
		windowHeight = $(window).height();
		headerHeight = $('#header').outerHeight();

		// #contentsの高さを最低限画面の高さに
		$('#contents').css('min-height', windowHeight - headerHeight);

		// var width = $(window).width();
		if (width > 768) {
			$('body').addClass('device-pc').removeClass('device-sp');
		} else {
			$('body').addClass('device-sp').removeClass('device-pc');
		}
	}
});

