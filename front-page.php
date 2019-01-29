<?php
/**
 * Homepage Template.
 */

add_filter( 'genesis_attr_site-inner', 'be_site_inner_attr' );
/**
 * Adds attributes from 'entry', since this replaces the main entry.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/full-width-landing-pages-in-genesis/
 *
 * @param array $attributes Existing attributes.
 * @return array Amended attributes.
 */
function be_site_inner_attr( $attributes ) {

    // Add a class of 'full' for styling this .site-inner differently.
    $attributes['class'] .= ' front-page';

    // Add an id of 'genesis-content' for accessible skip links.
    $attributes['id'] = 'genesis-content';

    // Add the attributes from .entry, since this replaces the main entry.
    $attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );

    return $attributes;

}

// Displays header.
get_header();

// Displays front-page widget areas.
for ( $i = 1; $i <= 5; $i++ ) {
    genesis_widget_area( "front-page-{$i}", array(
        'before' => '<div class="front-page-' . $i . ' widget-area"><div class="wrap">',
        'after'  => '</div></div>',
    ) );
}

// Displays Footer.
get_footer();
