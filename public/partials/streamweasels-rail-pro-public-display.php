<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.streamweasels.com
 * @since      1.0.0
 *
 * @package    Streamweasels_Rail_Pro
 * @subpackage Streamweasels_Rail_Pro/public/partials
 */
?>
<?php
$options            = get_option('swti_options');
$layout             = ( isset( $args['layout'] ) ? $args['layout'] : $options['swti_layout'] ); 
if (sti_fs()->can_use_premium_code()) {
    $tileLayout         = ( isset( $args['tile-layout'] ) ? $args['tile-layout'] : $options['swti_tile_layout'] );
    $hoverEffect        = ( isset( $args['hover-effect'] ) ? $args['hover-effect'] : $options['swti_hover_effect'] );
    $logoImage          = ( isset( $options['swti_logo_image'] ) && !empty( $options['swti_logo_image'] ) ? $options['swti_logo_image'] : '' );
    $title 				= ( isset( $args['title'] ) ? $args['title'] : $options['swti_title'] );
    $subtitle 			= ( isset( $args['subtitle'] ) ? $args['subtitle'] : $options['swti_subtitle'] );
    $embedChat          = ( isset( $args['embed-chat'] ) ? $args['embed-chat'] : $options['swti_embed_chat'] );
    $embedTitlePosition = ( isset( $args['title-position'] ) ? $args['title-position'] : $options['swti_embed_title_position'] );
    $showTitleTop       = ($embedTitlePosition == 'top' ? '<div class="cp-streamweasels__title"></div>' : '');
    $showTitleBottom    = ($embedTitlePosition == 'bottom' ? '<div class="cp-streamweasels__title"></div>' : '');
    $maxWidth           = ( isset( $args['max-width'] ) ? $args['max-width'] : $options['swti_max_width'] );
    $headerMarkup       = '';
    if ($logoImage || $title || $subtitle) {
        $headerMarkup =	'<div class="cp-streamweasels__rail-header">'.
                            ($logoImage ? '<div class="cp-streamweasels__rail-header-image"><img src="'.$logoImage.'"></div>' : '').'
                            <div class="cp-streamweasels__rail-header-title">'.
                                ($title ? '<span class="cp-streamweasels__rail-header-title--line-1">'.$title.'</span>' : '').
                                ($subtitle ? '<span class="cp-streamweasels__rail-header-title--line-2">'.$subtitle.'</span>' : '').'
                            </div>
                        </div>';
    }
} else {
    $tileLayout         = 'detailed';
    $hoverEffect        = 'play';
    $logoImage          = '';
    $title 				= '';
    $subtitle 			= '';
    $embedChat          = 0;
    $embedTitlePosition = '';
    $showTitleTop       = '';
    $showTitleBottom    = '';
    $maxWidth           = '1440';
    $headerMarkup       = '';
}

echo    '<div class="cp-streamweasels cp-streamweasels--'.$uuid.' cp-streamweasels--'.$layout.'" data-uuid="'.$uuid.'">
            <div class="cp-streamweasels__inner" style="'.(($maxWidth !== 'none') ? 'max-width:'.$maxWidth.'px' : '').'">
                '.$showTitleTop.'
                <div class="cp-streamweasels__player cp-streamweasels__player--'.($embedChat ? 'video-with-chat' : 'video').'"></div>
                '.$showTitleBottom.'
                '.$headerMarkup.'
                <div class="cp-streamweasels__loader">
                    <div class="spinner-item"></div>
                    <div class="spinner-item"></div>
                    <div class="spinner-item"></div>
                    <div class="spinner-item"></div>
                    <div class="spinner-item"></div>
                </div>
                <div class="cp-streamweasels__offline-wrapper"></div>
                <div class="cp-streamweasels__streams cp-streamweasels__streams--'.$tileLayout.' cp-streamweasels__streams--hover-'.$hoverEffect.'"></div>
            </div>
        </div>';
