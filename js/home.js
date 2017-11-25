/*
 * home用js
 */
jQuery(document).ready(function($) {
	var entries;

	// 最初のpickupはwide
	var odd = $('section.pickups .pickup').size() % 2;
	if (0 < odd) {
		$('section.pickups .pickup:first').addClass('wide');
	}

	// サイドバー開閉時に
	// swiper更新
	$('#gnav .menu-btn').on('click', 'a', function() {
		setTimeout(function() {
			entries.update();
		}, 300);
		return false;
	});

	// swiper生成
	$(window).on('load', function() {
		var args = {
			direction: 'horizontal',
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			scrollbar: '.swiper-scrollbar',
			// preventClicks: false,
			grabCursor: true,
			slidesPerView: 'auto'
		};
		entries = new Swiper('.posts .swiper-container', args);
	});

});
