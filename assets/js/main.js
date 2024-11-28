!(function ($) {
	"use strict";

	/* Toggle submenu align */
	function CleaniraSubmenuAuto() {
		if ($('.bt-site-header .bt-container').length > 0) {
			var container = $('.bt-site-header .bt-container'),
				containerInfo = { left: container.offset().left, width: container.innerWidth() },
				contLeftPos = containerInfo.left,
				contRightPos = containerInfo.left + containerInfo.width;

			$('.children, .sub-menu').each(function () {
				var submenuInfo = { left: $(this).offset().left, width: $(this).innerWidth() },
					smLeftPos = submenuInfo.left,
					smRightPos = submenuInfo.left + submenuInfo.width;

				if (smLeftPos <= contLeftPos) {
					$(this).addClass('bt-align-left');
				}

				if (smRightPos >= contRightPos) {
					$(this).addClass('bt-align-right');
				}

			});
		}
	}

	/* Toggle menu mobile */
	function CleaniraToggleMenuMobile() {
		$('.bt-site-header .bt-menu-toggle').on('click', function (e) {
			e.preventDefault();

			if ($(this).hasClass('bt-menu-open')) {
				$(this).addClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').addClass('bt-is-active');
			} else {
				$('.bt-menu-open').removeClass('bt-is-hidden');
				$('.bt-site-header .bt-primary-menu').removeClass('bt-is-active');
			}
		});
	}

	/* Toggle sub menu mobile */
	function CleaniraToggleSubMenuMobile() {
		var hasChildren = $('.bt-site-header .page_item_has_children, .bt-site-header .menu-item-has-children');

		hasChildren.each(function () {
			var $btnToggle = $('<div class="bt-toggle-icon"></div>');

			$(this).append($btnToggle);

			$btnToggle.on('click', function (e) {
				e.preventDefault();
				$(this).toggleClass('bt-is-active');
				$(this).parent().children('ul').toggle();
			});
		});
	}

	/* Orbit effect */
	function CleaniraOrbitEffect() {
		if ($('.bt-orbit-enable').length > 0) {
			var html = '<div class="bt-orbit-effect">' +
				'<div class="bt-orbit-wrap">' +
				'<div class="bt-orbit red"><span></span></div>' +
				'<div class="bt-orbit blue"><span></span></div>' +
				'<div class="bt-orbit yellow"><span></span></div>' +
				'<div class="bt-orbit purple"><span></span></div>' +
				'<div class="bt-orbit green"><span></span></div>' +
				'</div>' +
				'</div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Cursor effect */
	function CleaniraCursorEffect() {
		if ($('.bt-bg-pattern-enable').length > 0) {
			var html = '<div class="bt-bg-pattern-effect"></div>';

			$('.bt-site-main').append(html);
		}
	}

	/* Buble effect */
	function CleaniraBubleEffect() {
		if ($('.bt-bg-buble-enable').length > 0) {
			var html = '<div class="bt-bg-buble-effect">' +
				'<div class="bt-bubles-beblow"></div>' +
				'<div class="bt-bubles-above"></div>'
			'</div>';

			$('.bt-social-mcn-ss').append(html);

			for (let i = 0; i < 40; i++) {
				$('.bt-bubles-beblow').append('<span class="buble"></span>');
				$('.bt-bubles-above').append('<span class="buble"></span>');
			}
		}
	}
	/* Shop */
	function CleaniraShop() {
		if ($('.single-product').length > 0) {
			$('.woocommerce-product-zoom__image').zoom();

			$('.woocommerce-product-gallery__slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				arrows: false,
				asNavFor: '.woocommerce-product-gallery__slider-nav',
				prevArrow: '<button type=\"button\" class=\"slick-prev\">Prev</button>',
				nextArrow: '<button type=\"button\" class=\"slick-next\">Next</button>'
			});
			$('.woocommerce-product-gallery__slider-nav').slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				focusOnSelect: true,
				asNavFor: '.woocommerce-product-gallery__slider'
			});
		}
		if ($('.quantity input').length > 0) {
			/* Plus Qty */
			$(document).on('click', '.qty-plus', function () {
				var parent = $(this).parent();
				$('input.qty', parent).val(parseInt($('input.qty', parent).val()) + 1);
				$('input.qty', parent).trigger('change');
			});
			/* Minus Qty */
			$(document).on('click', '.qty-minus', function () {
				var parent = $(this).parent();
				if (parseInt($('input.qty', parent).val()) > 1) {
					$('input.qty', parent).val(parseInt($('input.qty', parent).val()) - 1);
					$('input.qty', parent).trigger('change');
				}
			});
		}

	}

	/* Units custom */
	function CleaniraUnitsCustom() {
		if ($('.wp-block-search__button').length > 0) {
			$('.wp-block-search__button svg').replaceWith('<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">' +
				'<g clip-path="url(#clip0_19_3488)">' +
				'<path d="M24.408 21.3828L18.6603 15.6347C19.6369 14.08 20.2037 12.2424 20.2037 10.2703C20.2037 4.69102 15.6807 0.168701 10.1016 0.168701C4.52253 0.168701 0 4.69102 0 10.2703C0 15.8498 4.52232 20.3717 10.1016 20.3717C12.2478 20.3717 14.2356 19.7007 15.8714 18.5606L21.5506 24.2403C21.9453 24.6345 22.4626 24.8309 22.9793 24.8309C23.4966 24.8309 24.0133 24.6345 24.4086 24.2403C25.1972 23.4509 25.1972 22.1721 24.408 21.3828ZM10.1016 17.0989C6.33066 17.0989 3.27341 14.0419 3.27341 10.2707C3.27341 6.49957 6.33066 3.44232 10.1016 3.44232C13.8728 3.44232 16.9298 6.49957 16.9298 10.2707C16.9298 14.0419 13.8728 17.0989 10.1016 17.0989Z" fill="white"/>' +
				'</g>' +
				'<defs>' +
				'<clipPath id="clip0_19_3488">' +
				'<rect width="25" height="25" fill="white"/>' +
				'</clipPath>' +
				'</defs>' +
				'</svg>');
		}
		if ($('.bt-post--content').length > 0) {
			var quoteIcon = '<span class="bt-quote-icon"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">' +
				'<path d="M0 37.4881H15.252L10.257 47.7223V52.548L28.188 37.4881V9.30005H0L0 37.4881Z" fill="#C2A74E"/>' +
				'<path d="M36.9893 14.6172V37.488H49.3637L45.3101 45.792V49.7058L59.8583 37.488V14.6172H36.9893Z" fill="#C2A74E"/>' +
				'</svg></span>';
			$('.bt-post--content blockquote').append(quoteIcon);

			var ulIcon = '<span class="bt-ul-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">' +
				'<path d="M2.74902 8.33377C2.43837 8.33464 2.13431 8.42344 1.87202 8.58991C1.60973 8.75638 1.39993 8.99371 1.26689 9.27444C1.13386 9.55517 1.08302 9.86783 1.12027 10.1762C1.15751 10.4847 1.28132 10.7762 1.47736 11.0172L5.65647 16.1366C5.80548 16.3216 5.99648 16.4684 6.21361 16.5648C6.43074 16.6612 6.66774 16.7044 6.90491 16.6908C7.41216 16.6635 7.87013 16.3922 8.16211 15.946L16.8432 1.96516C16.8446 1.96284 16.8461 1.96052 16.8476 1.95824C16.9291 1.83317 16.9027 1.58532 16.7345 1.42962C16.6884 1.38687 16.6339 1.35402 16.5745 1.3331C16.5152 1.31218 16.4522 1.30363 16.3894 1.30799C16.3266 1.31235 16.2654 1.32951 16.2095 1.35842C16.1535 1.38734 16.1042 1.42739 16.0643 1.47611C16.0612 1.47994 16.058 1.48372 16.0547 1.48743L7.2997 11.3793C7.26639 11.4169 7.22592 11.4476 7.18067 11.4694C7.13541 11.4913 7.08625 11.504 7.03606 11.5067C6.98587 11.5094 6.93564 11.5021 6.88828 11.4852C6.84093 11.4684 6.7974 11.4423 6.76022 11.4084L3.8546 8.76431C3.55283 8.48768 3.1584 8.33408 2.74902 8.33377Z" fill="#C2A74E"/>' +
				'</svg></span>';
			$('.bt-post--content ul li').append(ulIcon);
		}
		if ($('.single-product').length > 0) {
			var Iconstock = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none"><path d="M2.74902 9.20047C2.43837 9.20134 2.13431 9.29014 1.87202 9.45661C1.60973 9.62308 1.39993 9.86041 1.26689 10.1411C1.13386 10.4219 1.08302 10.7345 1.12027 11.0429C1.15751 11.3514 1.28132 11.6429 1.47736 11.8839L5.65647 17.0033C5.80548 17.1883 5.99648 17.3351 6.21361 17.4315C6.43074 17.5279 6.66774 17.5711 6.90491 17.5575C7.41216 17.5302 7.87013 17.2589 8.16211 16.8127L16.8432 2.83186C16.8446 2.82954 16.8461 2.82722 16.8476 2.82493C16.9291 2.69987 16.9027 2.45202 16.7345 2.29632C16.6884 2.25357 16.6339 2.22072 16.5745 2.1998C16.5152 2.17888 16.4522 2.17033 16.3894 2.17469C16.3266 2.17904 16.2654 2.19621 16.2095 2.22512C16.1535 2.25403 16.1042 2.29409 16.0643 2.34281C16.0612 2.34664 16.058 2.35042 16.0547 2.35413L7.2997 12.246C7.26639 12.2836 7.22592 12.3143 7.18067 12.3361C7.13541 12.358 7.08625 12.3707 7.03606 12.3734C6.98587 12.3761 6.93564 12.3688 6.88828 12.3519C6.84093 12.3351 6.7974 12.309 6.76022 12.2751L3.8546 9.63101C3.55283 9.35438 3.1584 9.20078 2.74902 9.20047Z" fill="#C2A74E"/></svg>';
			$('.single-product p.stock.in-stock span').append(Iconstock);

			var ulIcon = '<span class="bt-ul-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">' +
				'<path d="M2.74902 8.33377C2.43837 8.33464 2.13431 8.42344 1.87202 8.58991C1.60973 8.75638 1.39993 8.99371 1.26689 9.27444C1.13386 9.55517 1.08302 9.86783 1.12027 10.1762C1.15751 10.4847 1.28132 10.7762 1.47736 11.0172L5.65647 16.1366C5.80548 16.3216 5.99648 16.4684 6.21361 16.5648C6.43074 16.6612 6.66774 16.7044 6.90491 16.6908C7.41216 16.6635 7.87013 16.3922 8.16211 15.946L16.8432 1.96516C16.8446 1.96284 16.8461 1.96052 16.8476 1.95824C16.9291 1.83317 16.9027 1.58532 16.7345 1.42962C16.6884 1.38687 16.6339 1.35402 16.5745 1.3331C16.5152 1.31218 16.4522 1.30363 16.3894 1.30799C16.3266 1.31235 16.2654 1.32951 16.2095 1.35842C16.1535 1.38734 16.1042 1.42739 16.0643 1.47611C16.0612 1.47994 16.058 1.48372 16.0547 1.48743L7.2997 11.3793C7.26639 11.4169 7.22592 11.4476 7.18067 11.4694C7.13541 11.4913 7.08625 11.504 7.03606 11.5067C6.98587 11.5094 6.93564 11.5021 6.88828 11.4852C6.84093 11.4684 6.7974 11.4423 6.76022 11.4084L3.8546 8.76431C3.55283 8.48768 3.1584 8.33408 2.74902 8.33377Z" fill="#C2A74E"/>' +
				'</svg></span>';
			$('.woocommerce-Tabs-panel--description ul li').append(ulIcon);
		}

	}
	/* Checkbox Custom Newsletter */
	function CleaniraCheckboxCustom() {
		const $itemcheckbox = $('.tnp-privacy-field .tnp-privacy')
		if (!$itemcheckbox.length) return;
		const $divcheckbox = '<div class="checkmark"></div>';
		$itemcheckbox.parent().append($divcheckbox);

		if ($('.bt-newsletter-no-privacy').length > 0) {
			var privacyCheckbox = $('.bt-newsletter-no-privacy input.tnp-privacy');
			if (privacyCheckbox.length > 0 && !privacyCheckbox.prop('checked')) {
				privacyCheckbox.prop('checked', true);
			}
		}
	}
	/* Border Top arch */
	function CleaniraBorderTop() {
		var elements = document.querySelectorAll('.bt-border-top-arch');
		if (window.innerWidth >= 768) {
			elements.forEach(function (element) {
				var width = element.offsetWidth;
				var borderRadius = width / 2 + 'px';
				element.style.borderTopLeftRadius = borderRadius;
				element.style.borderTopRightRadius = borderRadius;
			});
		} else {
			elements.forEach(function (element) {
				element.style.borderTopLeftRadius = '';
				element.style.borderTopRightRadius = '';
			});
		}
	};
	/* animation Text */
	function CleaniraAnimateText(selector, delayFactor = 0.05) {
		const $text = $(selector);
		const textContent = $text.text();
		$text.empty();

		let letterIndex = 0;

		textContent.split(" ").forEach((word) => {
			const $wordSpan = $("<span>").addClass("bt-word");

			word.split("").forEach((char) => {
				const $charSpan = $("<span>").addClass("bt-letter").text(char);
				$charSpan.css("animation-delay", `${letterIndex * delayFactor}s`);
				$wordSpan.append($charSpan);
				letterIndex++;
			});

			$text.append($wordSpan).append(" ");
		});
	}
	/* Validation form comment */
	function ChambeshiCommentValidation() {
		if ($('#bt_comment_form').length) {
			jQuery('#bt_comment_form').validate({
				rules: {
					author: {
						required: true,
						minlength: 2
					},
					email: {
						required: true,
						email: true
					},
					comment: {
						required: true,
						minlength: 20
					}
				},
				errorElement: "div",
				errorPlacement: function (error, element) {
					element.after(error);
				}
			});
		}
	}
	function CleaniraCheckVisibilityText() {
		$('.elementor-widget-heading .elementor-heading-title').each(function () {
			const $this = $(this);
			if (!$this.is('h1, h2, h3, h4, h5, h6')) {
				return;
			}
			$this.parent().parent().addClass('bt-fade-animation');
			const windowHeight = $(window).height();
			const elementTop = $this.offset().top;
			const elementBottom = elementTop + $this.outerHeight();

			if (elementTop < $(window).scrollTop() + windowHeight && elementBottom > $(window).scrollTop()) {
				if (!$this.hasClass('bt-animated')) {
					let delayFactor = 0.05;
					const settings = $this.parent().parent().data('settings');

					if (settings && settings._animation_delay) {
						delayFactor = parseFloat(settings._animation_delay) || delayFactor;
					}
					if (settings && settings._animation == 'fadeInRight') {
						$this.addClass('bt-animated bt-animation-right');
						CleaniraAnimateText(this, delayFactor);
					} else if (settings && settings._animation == 'fadeInLeft') {
						$this.addClass('bt-animated bt-animation-left');
						CleaniraAnimateText(this, delayFactor);
					} else if (settings && settings._animation == 'fadeInUp') {
						$this.addClass('bt-animated bt-animation-up');
						CleaniraAnimateText(this, delayFactor);
					} else if (settings && settings._animation == 'fadeInDown') {
						$this.addClass('bt-animated bt-animation-down');
						CleaniraAnimateText(this, delayFactor);
					}
				}
			}
		});
		$('.bt-text-animation').each(function () {
			const $this = $(this);
			const windowHeight = $(window).height();
			const elementTop = $this.offset().top;
			const elementBottom = elementTop + $this.outerHeight();

			if (elementTop < $(window).scrollTop() + windowHeight && elementBottom > $(window).scrollTop()) {
				if (!$this.hasClass('bt-animated')) {
					let delayFactor = 0.05;
					$this.addClass('bt-animated bt-animation-right');
					CleaniraAnimateText(this, delayFactor);
				}
			}
		});
	}
	/* Set cookie */
	function setCookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		let expires = "expires=" + d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	/* Get cookie */
	function getCookie(cname) {
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for (let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	/* Product wishlist */
	function CleaniraProductWishlist() {
		if ($('.bt-product-wishlist-btn').length > 0) {
			$(document).on('click', '.bt-product-wishlist-btn', function (e) {
				e.preventDefault();

				var post_id = $(this).data('id').toString(),
					wishlist_cookie = getCookie('productwishlistcookie');

				if (wishlist_cookie == '') {
					setCookie('productwishlistcookie', post_id, 7);
					$(this).addClass('added');
					$('.bt-productwishlistcookie').val(post_id);
				} else {
					var wishlist_arr = wishlist_cookie.split(',');

					if (wishlist_arr.includes(post_id)) {
						window.location.href = '/products-wishlist/';
					} else {
						setCookie('productwishlistcookie', wishlist_cookie + ',' + post_id, 7);
						$(this).addClass('added');
						$('.bt-productwishlistcookie').val(wishlist_cookie + ',' + post_id);
					}
				}
			});
		}

		if ($('.elementor-widget-bt-product-wishlist').length > 0) {
			$(document).on('click', '.bt-product-remove-wishlist', function (e) {
				e.preventDefault();
				$(this).addClass('deleting');
				var product_id = $(this).data('id').toString(),
					wishlist_str = $('.bt-productwishlistcookie').val(),
					wishlist_arr = wishlist_str.split(','),
					index = wishlist_arr.indexOf(product_id);

				if (index > -1) {
					wishlist_arr.splice(index, 1);
				}

				wishlist_str = wishlist_arr.toString();
				$('.bt-productwishlistcookie').val(wishlist_str);
				setCookie('productwishlistcookie', wishlist_str, 7);
				$('.bt-products-wishlist-form').submit();
			});

			// Ajax wishlist
			$('.bt-products-wishlist-form').submit(function () {
				var param_ajax = {
					action: 'cleanira_products_wishlist',
					productwishlistcookie: $('.bt-productwishlistcookie').val()
				};

				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: AJ_Options.ajax_url,
					data: param_ajax,
					context: this,
					beforeSend: function () {
						$('.bt-table--body').addClass('loading');
					},
					success: function (response) {
						if (response.success) {
							setTimeout(function () {
								$('.bt-product-list').html(response.data['items']).fadeIn('slow');
								$('.bt-table--body').removeClass('loading');
							}, 500);

						} else {
							console.log('error');
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log('The following error occured: ' + textStatus, errorThrown);
					}
				});

				return false;
			});
		}
	}
	/* Product compare */
	function CleaniraProductCompare() {
		if ($('.bt-product-compare-btn').length > 0) {
			$(document).on('click', '.bt-product-compare-btn', function (e) {
				e.preventDefault();

				var post_id = $(this).data('id').toString(),
					compare_cookie = getCookie('productcomparecookie');

				if (compare_cookie == '') {
					setCookie('productcomparecookie', post_id, 7);
					$(this).addClass('added');
				} else {
					var compare_arr = compare_cookie.split(',');
					if (!compare_arr.includes(post_id)) {
						setCookie('productcomparecookie', compare_cookie + ',' + post_id, 7);
						$(this).addClass('added');
					}
				}
				var param_ajax = {
					action: 'cleanira_products_compare',
				};
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: AJ_Options.ajax_url,
					data: param_ajax,
					beforeSend: function () {
						
					},
					success: function (response) {
						if (response.success) {
							setTimeout(function () {
								$('body').append('<div class="bt-popup-compare"><div class="bt-compare-overlay"></div><div class="bt-compare-body"><div class="bt-loading-wave"></div><div class="bt-compare-close"></div><div class="bt-compare-load"></div></div></div>').fadeIn('slow');
								$('.bt-compare-body').addClass('show');
								$('.bt-popup-compare .bt-compare-load').html(response.data['product']).fadeIn('slow');
							}, 100);
						} else {
							console.log('error');
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log('The following error occured: ' + textStatus, errorThrown);
					}
				});
			});
			$(document).on('click', '.bt-popup-compare .bt-compare-overlay', function () {
				$('.bt-popup-compare').remove();
			});
			$(document).on('click', '.bt-popup-compare .bt-compare-close', function () {
				$('.bt-popup-compare').remove();
			});
			$(document).on('click', '.bt-product-add-compare .bt-cover-image', function () {
				$('.bt-compare-body').removeClass('show');
				setTimeout(function () {
					$('.bt-popup-compare').remove();
				}, 300);

			});

		}
		$(document).on('click', '.bt-remove-item', function (e) {
			e.preventDefault();
			var compare_cookie = getCookie('productcomparecookie');
			var product_id = $(this).data('id').toString(),
				compare_arr = compare_cookie.split(','),
				index = compare_arr.indexOf(product_id);

			if (index > -1) {
				compare_arr.splice(index, 1);
			}
			setCookie('productcomparecookie', compare_arr, 7);
			$('.bt-product-compare-btn[data-id="' + product_id + '"]').removeClass('added');
			var param_ajax = {
				action: 'cleanira_products_compare',
			};
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: AJ_Options.ajax_url,
				data: param_ajax,
				beforeSend: function () {
					$('.bt-compare-body').addClass('loading');
				},
				success: function (response) {
					if (response.success) {
						if (response.data['product'] && response.data['product'].trim() !== "") {
							setTimeout(function () {
								$('.bt-popup-compare .bt-compare-load').html(response.data['product']).fadeIn('slow');
								$('.bt-compare-body').removeClass('loading');
							}, 500);

						} else {
							$('.bt-popup-compare').remove();
						}
					} else {
						console.log('error');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log('The following error occured: ' + textStatus, errorThrown);
				}
			});
		});
	}
	function CleaniraProductsFilter() {
		if (!$('body').hasClass('post-type-archive-product')) {
			return;
		}

		// Search by keywords
		$('.bt-product-filter-form .bt-field-type-search input').on('keyup', function (e) {
			if (e.key === 'Enter' || e.keyCode === 13) {
				$('.bt-product-filter-form .bt-product-current-page').val('');
				$('.bt-product-filter-form').submit();
			}
		});

		$('.bt-product-filter-form  .bt-field-type-search a').on('click', function (e) {
			e.preventDefault();
			$('.bt-product-filter-form .bt-product-current-page').val('');
			$('.bt-product-filter-form').submit();
		});

		//Sort order
		$('.bt-product-sort-block select').select2({
			dropdownParent: $('.bt-product-sort-block'),
			minimumResultsForSearch: Infinity
		});
		$('.bt-product-sort-block select').on('change', function () {
			var sort_val = $(this).val();

			$('.bt-product-filter-form .bt-product-sort-order').val(sort_val);
			$('.bt-product-filter-form').submit();
		});


		// Pagination
		$('.bt-product-pagination-wrap').on('click', '.bt-product-pagination a', function (e) {
			e.preventDefault();

			var current_page = $(this).data('page');

			if (1 < current_page) {
				$('.bt-product-filter-form .bt-product-current-page').val(current_page);
			} else {
				$('.bt-product-filter-form .bt-product-current-page').val('');
			}

			$('.bt-product-filter-form').submit();
		});

		// Filter Slider
		if ($('#bt-price-slider').length > 0) {
			const priceSlider = document.getElementById('bt-price-slider');

			var rangeMin = $('#bt-price-slider').data('range-min'),
				rangeMax = $('#bt-price-slider').data('range-max'),
				startMin = $('#bt-price-slider').data('start-min'),
				startMax = $('#bt-price-slider').data('start-max');
			noUiSlider.create(priceSlider, {
				start: [startMin, startMax],
				connect: true,
				range: {
					'min': rangeMin,
					'max': rangeMax
				},
				step: 1
			});

			const minPriceValue = $('#bt-min-price');
			const maxPriceValue = $('#bt-max-price');
			let timeout;
			priceSlider.noUiSlider.on('change', function (values, handle) {
				minPriceValue.val(parseInt(values[0]));
				maxPriceValue.val(parseInt(values[1]));
				$('.bt-product-filter-form .bt-product-current-page').val('');
				$('.bt-product-filter-form').submit();
			});
			minPriceValue.on('input', function () {
				clearTimeout(timeout);
				timeout = setTimeout(function () {
					let minValue = parseInt(minPriceValue.val());
					const maxValue = parseInt(maxPriceValue.val());

					if (!isNaN(minValue)) {
						if (minValue > maxValue) {
							minValue = maxValue;
							minPriceValue.val(minValue);
						} else if (minValue < rangeMin) {
							minValue = rangeMin;
							minPriceValue.val(minValue);
						}
						priceSlider.noUiSlider.set([minValue, null]);
						if (!isNaN(maxValue)) {
							$('.bt-product-filter-form .bt-product-current-page').val('');
							$('.bt-product-filter-form').submit();
						} else {
							maxPriceValue.val(rangeMax);
							$('.bt-product-filter-form .bt-product-current-page').val('');
							$('.bt-product-filter-form').submit();
						}
					}
				}, 500);
			});

			maxPriceValue.on('input', function () {
				clearTimeout(timeout);
				timeout = setTimeout(function () {
					const minValue = parseInt(minPriceValue.val());
					let maxValue = parseInt(maxPriceValue.val());

					if (!isNaN(maxValue)) {
						if (maxValue < minValue) {
							maxValue = minValue;
							maxPriceValue.val(maxValue);
						} else if (maxValue > rangeMax) {
							maxValue = rangeMax;
							maxPriceValue.val(maxValue);
						}
						priceSlider.noUiSlider.set([null, maxValue]);
						if (!isNaN(minValue)) {
							$('.bt-product-filter-form .bt-product-current-page').val('');
							$('.bt-product-filter-form').submit();
						} else {
							minPriceValue.val(rangeMin);
							$('.bt-product-filter-form .bt-product-current-page').val('');
							$('.bt-product-filter-form').submit();
						}
					}
				}, 500);
			});
		}

		//Filter single tax
		if ($('.bt-field-type-radio').length > 0) {
			$('.bt-field-type-radio input').on('change', function () {
				$('.bt-product-filter-form .bt-product-current-page').val('');
				$('.bt-product-filter-form').submit();
			});
		}

		//Filter multiple tax
		if ($('.bt-field-type-multi').length > 0) {
			$('.bt-field-type-multi a').on('click', function (e) {
				e.preventDefault();

				if ($(this).parent().hasClass('checked')) {
					$(this).parent().removeClass('checked');
				} else {
					$(this).parent().addClass('checked');
				}

				var value_arr = [];

				$(this).parents('.bt-form-field').find('.bt-field-item').each(function () {
					if ($(this).hasClass('checked')) {
						value_arr.push($(this).children().data('slug'));
					}
				});

				$(this).parents('.bt-form-field').find('input').val(value_arr.toString());
				$('.bt-product-filter-form .bt-product-current-page').val('');
				$('.bt-product-filter-form').submit();
			});
		}
		//Filter rating
		if ($('.bt-field-type-rating ').length > 0) {
			$('.bt-field-type-rating input').on('change', function () {
				$('.bt-product-filter-form .bt-product-current-page').val('');
				$('.bt-product-filter-form').submit();
			});
		}
		// Filter reset
		if (window.location.href.includes('?')) {
			$('.bt-product-filter-form .bt-reset-btn').removeClass('disable');
		}

		$('.bt-product-filter-form .bt-reset-btn').on('click', function (e) {
			e.preventDefault();

			if ($(this).hasClass('disable')) {
				return;
			}

			window.history.replaceState(null, null, window.location.pathname);
			$('.bt-product-filter-form input').not('[type="radio"]').val('');
			$('.bt-product-filter-form input[type="radio"]').prop('checked', false);
			$('.bt-product-filter-form .bt-field-item').removeClass('checked');
			$('.bt-product-filter-form select').select2().val('').trigger('change');
			$(this).addClass('disable')

			$('.bt-product-filter-form').submit();
		});

		// Ajax filter
		$('.bt-product-filter-form').submit(function () {
			var param_str = '',
				param_out = [],
				param_in = $(this).serialize().split('&');

			var param_ajax = {
				action: 'cleanira_products_filter',
			};

			param_in.forEach(function (param) {
				var param_key = param.split('=')[0],
					param_val = param.split('=')[1];

				if ('' !== param_val) {
					param_out.push(param);
					param_ajax[param_key] = param_val.replace(/%2C/g, ',');
				}
			});

			if (0 < param_out.length) {
				param_str = param_out.join('&');
			}

			if ('' !== param_str) {
				window.history.replaceState(null, null, `?${param_str}`);
				$(this).find('.bt-reset-btn').removeClass('disable');
			} else {
				window.history.replaceState(null, null, window.location.pathname);
				$(this).find('bt-reset-btn').addClass('disable');
			}

			// console.log(param_ajax);

			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: AJ_Options.ajax_url,
				data: param_ajax,
				context: this,
				beforeSend: function () {
					document.querySelector('.bt-filter-scroll-pos').scrollIntoView({
						behavior: 'smooth'
					});

					$('.bt-product-layout').addClass('loading');
					$('.bt-product-layout .woocommerce-loop-products').fadeOut('fast');
					$('.bt-product-pagination-wrap').fadeOut('fast');
				},
				success: function (response) {
					console.log(response);
					if (response.success) {

						setTimeout(function () {
							$('.bt-results-count').html(response.data['results']).fadeIn('slow');
							$('.bt-product-layout .woocommerce-loop-products').html(response.data['items']).fadeIn('slow');
							$('.bt-product-pagination-wrap').html(response.data['pagination']).fadeIn('slow');
							$('.bt-product-layout').removeClass('loading');
						}, 500);
					} else {
						console.log('error');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log('The following error occured: ' + textStatus, errorThrown);
				}
			});

			return false;
		});
	}
	/* Product sidebar toggle */
	function CleaniraProductSidebarToggle() {
		if ($('.bt-product-sidebar-toggle').length > 0) {
			$('.bt-product-sidebar-toggle').on('click', function () {
				$(this).parents('.bt-main-content').find('.bt-products-sidebar').addClass('active');
			});
			$('.bt-sidebar-overlay').on('click', function () {
				$(this).parents('.bt-main-content').find('.bt-products-sidebar').removeClass('active');
			});
			$('.bt-form-button .bt-close-btn').on('click', function (e) {
				e.preventDefault();
				$(this).parents('.bt-main-content').find('.bt-products-sidebar').removeClass('active');
			});
		}
	}
	jQuery(document).ready(function ($) {
		CleaniraSubmenuAuto();
		CleaniraToggleMenuMobile();
		CleaniraToggleSubMenuMobile();
		CleaniraOrbitEffect();
		CleaniraCursorEffect();
		CleaniraBubleEffect();
		CleaniraShop();
		// CleaniraUnitsCustom();
		CleaniraCheckboxCustom();
		CleaniraBorderTop();
		CleaniraCheckVisibilityText();
		ChambeshiCommentValidation();
		//	CleaniraCreatePriceSilder();
		CleaniraProductCompare();
		CleaniraProductWishlist();
		CleaniraProductsFilter();
		CleaniraProductSidebarToggle();
	});

	jQuery(window).on('resize', function () {
		CleaniraSubmenuAuto();
		CleaniraBorderTop();
	});

	jQuery(window).on('scroll', function () {
		CleaniraCheckVisibilityText();
	});
	// jQuery('form #bt-min-price').on('change keyup', function (e) {
	// 	e.preventDefault();
	// 	CleaniraLoopProductsFilterAjax();
	// });

	// jQuery('form #bt-max-price').on('change keyup', function (e) {
	// 	e.preventDefault();
	// 	CleaniraLoopProductsFilterAjax();
	// });
})(jQuery);
