/* Scroll to Top */
$(document).ready(function() {
	$(".totop").hide();
	$(function() {
		$(window).scroll(function() {
			if ($(this).scrollTop() > 400) {
				$('.totop').slideDown();
			} else {
				$('.totop').slideUp();
			}
		});
		$('.totop a').click(function (e) {
			e.preventDefault();
			$('body,html').animate({scrollTop: 0}, 500);
		});
	});
});

/* Transform all the system selects into custom ones with JS */
$("select").select2({dropdownCssClass: 'dropdown-inverse'});
