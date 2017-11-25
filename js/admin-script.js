/*
 * 管理画面用スクリプト
 */

/*
 * DOM読み込み時
 */
jQuery(document).ready(function($) {

	// 広告設定表示切替
	$('#ads_hide').change(function() {
		if ($(this).prop('checked')) {
			$('#ads_code_custom')
			.prop('readonly', true)
			.css('opacity', 0.5);
		} else {
			$('#ads_code_custom')
			.prop('readonly', false)
			.css('opacity', 1);
		}
	});

	// fbログイン
	$('#facebook_connect').on('click', function(e) {
		var w_size=800;
		var h_size=600;
		var l_position=Number((window.screen.width-w_size)/2);
		var t_position=Number((window.screen.height-h_size)/2);
		// ログインウィンドウを開く
		var loc = 'https://something-25.com/auth/fb_login.php?callback=' + fb_callback + '&hostname=' + wp_hostname;
		var win = window.open(loc, 'fb_login', 'width='+w_size+', height='+h_size+', left='+l_position+', top='+t_position);
		// 1000ms毎にウィンドウが閉じられたかを確認
		var interval = 0;
		interval = setInterval(function() {
			if (win.closed) {
				clearInterval(interval);
				console.log('window close');
				setFacebookUser();
				$('#submit').trigger('click');
			}
		},1000);

		return false;
	});

	// fbログアウト
	$('#facebook_disconnect').on('click', function() {
		var w_size=800;
		var h_size=600;
		var l_position=Number((window.screen.width-w_size)/2);
		var t_position=Number((window.screen.height-h_size)/2);
		// ログアウトウィンドウを開く
		var loc = 'https://something-25.com/auth/fb_logout.php?callback=' + fb_logout + '&hostname=' + wp_hostname;
		var win = window.open(loc, 'fb_logout', 'width='+w_size+', height='+h_size+', left='+l_position+', top='+t_position);
		// 1000ms毎にウィンドウが閉じられたかを確認
		var interval = 0;
		interval = setInterval(function() {
			if (win.closed) {
				clearInterval(interval);
				console.log('window close');
				clearFacebookUser();
				$('#submit').trigger('click');
			}
		},1000);

		return false;
	});

	// fb情報消去
	function clearFacebookUser() {
		console.log('clear fb user');
		$('#ad_facebook_id').val('');
		$('#ad_facebook_name').val('');
		// $('#ad-settings-block').addClass('disabled');
	}

	// fb情報設定
	function setFacebookUser() {
		console.log('get fb user');
		var fbid = $.cookie('fbid');
		var name = $.cookie('fbname');
		$('#ad_facebook_id').val(fbid);
		$('#ad_facebook_name').val(name);
		// $('#ad-settings-block').removeClass('disabled');
	}
});
