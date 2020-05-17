<?php

/**
 * The Footer Sidebars in the Footer Section
 *
 */



if ( is_active_sidebar( 'sidebar-footer-1' ) ) :?>
	<div class="widget col-sm col-lg">
		<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
	</div>
<?php    
endif;

if ( is_active_sidebar( 'sidebar-footer-2' ) ) :?>
	<div class="widget col-sm col-lg">
		<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
	</div>
<?php 
endif;

if ( is_active_sidebar( 'sidebar-footer-3' ) ) :?>
	<div class="widget col-sm col-lg">
<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
	</div>
<?php 
    endif;
?>