<?php
/**
 * NMM_Walker_Nav — Custom nav walker with dropdown support and has-dropdown class.
 */

defined( 'ABSPATH' ) || exit;

class NMM_Walker_Nav extends Walker_Nav_Menu {

    /**
     * Start the element output (list item).
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes, true );

        if ( $has_children ) {
            $classes[] = 'has-dropdown';
        }

        // current page
        if ( in_array( 'current-menu-item', $classes, true ) ) {
            $classes[] = 'active';
        }

        $class_str = implode( ' ', array_filter( array_map( 'sanitize_html_class', $classes ) ) );

        $output .= '<li class="' . esc_attr( $class_str ) . '">';

        // Link attributes
        $atts           = [];
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '#';

        if ( $has_children && 0 === $depth ) {
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        $attrs = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $attrs .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $output .= '<a' . $attrs . '>';
        $output .= esc_html( $item->title );
        if ( $has_children && 0 === $depth ) {
            $output .= ' <i class="fas fa-chevron-down fa-xs" aria-hidden="true" style="opacity:.6;transition:transform .25s ease;"></i>';
        }
        $output .= '</a>';
    }

    /**
     * Start sub-menu (dropdown).
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="dropdown" role="menu">';
    }

    /**
     * End sub-menu.
     */
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    /**
     * End list item.
     */
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
