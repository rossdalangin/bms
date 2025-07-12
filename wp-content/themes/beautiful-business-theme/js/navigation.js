/**
 * File navigation.js.
 *
 * Handles toggling the mobile navigation menu.
 */
( function() {
    const siteNavigation = document.getElementById( 'site-navigation' );

    // Return early if the navigation doesn't exist.
    if ( ! siteNavigation ) {
        return;
    }

    const button = siteNavigation.getElementsByTagName( 'button' )[0];

    // Return early if the button doesn't exist.
    if ( 'undefined' === typeof button ) {
        return;
    }

    const menu = siteNavigation.getElementsByTagName( 'ul' )[0];

    // Hide menu if it's empty and return early.
    if ( 'undefined' === typeof menu ) {
        button.style.display = 'none';
        return;
    }

    if ( ! menu.classList.contains( 'nav-menu' ) ) {
        menu.classList.add( 'nav-menu' );
    }

    // Toggle the .nav-open class and the aria-expanded value when the button is clicked.
    button.addEventListener( 'click', function() {
        siteNavigation.classList.toggle( 'nav-open' );

        if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
            button.setAttribute( 'aria-expanded', 'false' );
        } else {
            button.setAttribute( 'aria-expanded', 'true' );
        }
    } );

    // We could add more JS here for handling dropdowns on mobile, focus trapping, etc.
    // For now, this handles the main toggle.

} )();
