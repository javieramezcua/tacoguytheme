<?php

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			$url = get_site_url() . '/404';

			if ( get_field( 'external_link' ) ) {
			    $url = get_field( 'external_link' );
			}

		    wp_redirect( $url );
			exit;
		}
	}
