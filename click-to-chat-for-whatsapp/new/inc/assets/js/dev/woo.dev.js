
/**
 * Click to Chat - WooCommerce Integration
 *
 * 'Like Add to Cart' layout: styles the WhatsApp buttons (style 1, 8) like the theme's cart
 * buttons on single product and shop pages, then shows them. They render hidden (display:none),
 * so they don't flash unstyled.
 *
 * Buttons added later - AJAX filters, load more, infinite scroll, block-theme pagination -
 * are handled the same way as they appear (MutationObserver). Clicks need nothing here:
 * app.js delegates them from document.
 *
 * @package Click to Chat
 * @since 3.8
 * Loads only when an enabled WooCommerce placement uses the cart layout -
 * the WooCommerce check in HT_CTC_Scripts::register_scripts().
 * Plain JS: uses neither jQuery nor app.js.
 */
( function htCtcWooModule () {

	const PLACE_SELECTOR = '.ctc_woo_place';

	// Buttons already handled - an AJAX script that moves a node re-adds it; don't redo it.
	const processedPlaces = new WeakSet();

	function initWoo () {
		processPlaces( document.querySelectorAll( PLACE_SELECTOR ) );
		watchForNewPlaces();
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', initWoo );
	} else {
		initWoo();
	}

	/**
	 * Styles, then shows, each button not handled yet.
	 * Showing never depends on the styling: a button with no cart button to copy from
	 * (out of stock product, a shop page with no cart buttons) is shown as it is.
	 *
	 * @param {Iterable<HTMLElement>} places .ctc_woo_place elements.
	 */
	function processPlaces ( places ) {
		const pendingPlaces = Array.from( places )
			.filter( ( place ) => ! processedPlaces.has( place ) );

		if ( ! pendingPlaces.length ) {
			return;
		}

		const singleCartButton = document.querySelector( '.single_add_to_cart_button' );

		// '.button.add_to_cart_button' (from Astra) first: a bare '.add_to_cart_button' can match a 'bag' icon sharing the class.
		const shopCartButton =
			document.querySelector( '.button.add_to_cart_button' ) ||
			document.querySelector( '.add_to_cart_button' );

		pendingPlaces.forEach( ( place ) => {
			processedPlaces.add( place );

			try {
				styleLikeCart( place, singleCartButton, shopCartButton );
			} catch ( error ) {
				console.error( 'Error styling cart layout:', error );
			}

			// .ctc_woo_schedule buttons are left to PRO business hours (pro.js).
			if ( ! place.classList.contains( 'ctc_woo_schedule' ) ) {
				place.style.display = place.getAttribute( 'data-dt' ) || 'block';
			}
		} );
	}

	/**
	 * Runs processPlaces() on buttons inserted after load.
	 *
	 * Started only where buttons can turn up: a page that already has one, or a WooCommerce
	 * page (body class) - woo.js is enqueued site-wide, and most pages need no observer.
	 */
	function watchForNewPlaces () {
		if ( typeof MutationObserver === 'undefined' || ! document.body ) {
			return;
		}

		const body = document.body;
		const isWooPage = body.classList.contains( 'woocommerce' ) || body.classList.contains( 'woocommerce-page' );
		if ( ! isWooPage && ! document.querySelector( PLACE_SELECTOR ) ) {
			return;
		}

		const observer = new MutationObserver( ( mutations ) => {
			const addedPlaces = [];

			mutations.forEach( ( mutation ) => {
				mutation.addedNodes.forEach( ( node ) => {
					if ( 1 !== node.nodeType ) {
						return;
					}

					if ( node.matches( PLACE_SELECTOR ) ) {
						addedPlaces.push( node );
					} else if ( node.firstElementChild ) {
						addedPlaces.push( ...node.querySelectorAll( PLACE_SELECTOR ) );
					}
				} );
			} );

			if ( addedPlaces.length ) {
				processPlaces( addedPlaces );
			}
		} );

		observer.observe( body, { childList: true, subtree: true } );
	}

	/**
	 * .ctc_woo_single_cart_layout: the button on the single product page (position from settings).
	 * .ctc_woo_shop_cart_layout: buttons in the shop/archive grid, or related products on a single page.
	 *
	 * @param {HTMLElement} place .ctc_woo_place element.
	 * @param {?HTMLElement} singleCartButton
	 * @param {?HTMLElement} shopCartButton
	 */
	function styleLikeCart ( place, singleCartButton, shopCartButton ) {
		let cartButton = null;

		if ( place.classList.contains( 'ctc_woo_single_cart_layout' ) ) {
			cartButton = singleCartButton;
		} else if ( place.classList.contains( 'ctc_woo_shop_cart_layout' ) ) {
			cartButton = shopCartButton;
		}

		if ( ! cartButton ) {
			return;
		}

		place.querySelectorAll( '.s1_btn' )
			.forEach( ( button ) => applyS1Styling( button, cartButton ) );
		place.querySelectorAll( '.s_8' )
			.forEach( ( button ) => applyS8Styling( button, cartButton ) );
	}

	/**
	 * Style 1: copies the cart button's look onto the WhatsApp button.
	 *
	 * @param {HTMLElement} targetButton - The WhatsApp button.
	 * @param {HTMLElement} cartButton - The cart button to copy from.
	 */
	function applyS1Styling ( targetButton, cartButton ) {
		copyCartButtonLook( cartButton, targetButton );

		// Read back what the button now computes to, before the layout properties below.
		const targetStyle = window.getComputedStyle( targetButton );

		Object.assign( targetButton.style, {
			display: 'inline-flex',
			width: 'fit-content',
			alignItems: 'center',
			color: targetStyle.color,
			backgroundColor: targetStyle.backgroundColor,
		} );
	}

	/**
	 * Style 8: matches the cart button's size, font and corners (keeps its own colors).
	 *
	 * @param {HTMLElement} targetButton - The WhatsApp button.
	 * @param {HTMLElement} cartButton - The cart button to match.
	 */
	function applyS8Styling ( targetButton, cartButton ) {
		const cartStyle = window.getComputedStyle( cartButton );

		Object.assign( targetButton.style, {
			minHeight: cartStyle.minHeight,
			fontSize: cartStyle.fontSize,
			fontWeight: cartStyle.fontWeight,
			letterSpacing: cartStyle.letterSpacing,
			borderRadius: cartStyle.borderRadius,
			width: 'fit-content',
		} );
	}

	/**
	 * Copies a few computed styles - only the ones that make it look like the cart button.
	 * (Copying every computed property is expensive and drags in layout the button must not take.)
	 *
	 * @param {HTMLElement} cartButton   - The cart button.
	 * @param {HTMLElement} targetButton - The WhatsApp button.
	 */
	function copyCartButtonLook ( cartButton, targetButton ) {
		const cartStyle = window.getComputedStyle( cartButton );

		[
			'color',
			'background-color',
			'border-radius',
			'border',
			'padding',
			'font-size',
			'font-weight',
		].forEach( ( property ) => {
			targetButton.style.setProperty(
				property,
				cartStyle.getPropertyValue( property ),
				cartStyle.getPropertyPriority( property ),
			);
		} );
	}
} )();
