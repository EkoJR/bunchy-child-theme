<?php
// Prevent direct script access
if ( !defined( 'ABSPATH' ) )
	die ( 'No direct script access allowed' );

/**
* Child Theme Setup
* 
* Always use child theme if you want to make some custom modifications. 
* This way theme updates will be a lot easier.
*/
function bunchy_child_setup() {}

add_action( 'wp_footer', 'add_my_footer_textLink' );

function add_my_footer_textLink() {
	?>
	<div style="text-align: center;">
	  <a href="https://jobnewsusa.com">Find Local Jobs</a>
	</div>  
	<?php
}

// Use this to modify the incoming votes to the Votes Db.
// TODO - Add Date_Voted. Currently only records the post date.
function snax_mod_vote_added( $vote_arr ) {
	
}
add_action('snax_vote_added', 'snax_mod_vote_added');
//do_action( 'snax_vote_added', $vote_arr )