<?php
/**
 * Template Name: Front Page Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Repubblika
 */

get_header();

global $paged;
if ( ! isset( $paged ) || ! $paged ) {
	$paged = 1;
}

$fw = get_field( 'full_width' );
$opt = get_fields( 'options' );
$numOfPosts = $opt[ 'num_of_posts' ];

$c = Timber::get_context();
$c[ 'flex' ] = get_fields();
$c[ 'fullwidth' ] = $fw;
$c[ 'options' ] = get_fields( 'options' );

//$numOfStickies = count( get_option( 'sticky_posts' ) );
//$numOfPosts = 9 - $numOfStickies;
// WP_Query arguments
$args =	[
			'post_type'				=> array( 'post' ),
			'post_status'			=> array( 'publish' ),
			'ignore_sticky_posts'	=> 1,
			'posts_per_page'		=> $numOfPosts,
			'paged'					=> $paged,
		];


$c[ 'posts' ] = new Timber\PostQuery( $args );

$sticky_posts = get_option( 'sticky_posts' );

if ( $sticky_posts && $paged === 1 ) {
	$args =	[
				'post_type'				=> array( 'post' ),
				'post_status'			=> array( 'publish' ),
				'post__in'				=> $sticky_posts,
				'ignore_sticky_posts'	=> 1,
				'posts_per_page'		=> -1,
			];
	$c[ 'stickies' ] = new Timber\PostQuery( $args );
}

$c[ 'post' ] = new TimberPost();

$c[ 'sidebar' ] = Timber::get_sidebar( 'sidebar.php' );

/**
 * Add Events
 */

$now = date('Y-m-d H:i:s');

$args =	[
			'post_type'				=>	array( 'event' ),
			'post_status'			=>	array( 'publish' ),
			'ignore_sticky_posts'	=>	1,
			'posts_per_page'		=>	4,
			'order'					=>	'ASC',
			'orderby'				=>	'meta_value',
			'meta_key'				=>	'start_date',
			'meta_type'				=>	'DATE',
			'meta_query'			=> 	[
											//'relation'	=> 'AND',
											/*[
												'key'		=> 'start_date',
												'value'		=> $now,
												'compare'	=> '<=',
												'type'		=> 'DATETIME',
											],*/
											[
												'key'		=> 'end_date',
												'value'		=> $now,
												'compare'	=> '>=',
												'type'		=> 'DATETIME',
											]
										],
		];
$c[ 'events' ] = new Timber\PostQuery( $args );
// END EVENTS

/**
 * [$latestFrom description]
 * @var [type]
 */
$latestFrom		= $opt['get_latest_video_from'];
$youTubeAPIkey	= $opt['youtube_api_key'];

if ( $latestFrom == 'channel' ) {
	// LATEST CHANNEL VIDEO
	$channelID = $opt['channel_id'];

	$videoURL =		"https://www.googleapis.com/youtube/v3/search?";
	$videoURL .=	"part=snippet&";
	$videoURL .=	"channelId={$channelID}&";
	$videoURL .=	"maxResults=1&";
	$videoURL .=	"order=date&";
	$videoURL .=	"&key={$youTubeAPIkey}";
	$json = file_get_contents( $videoURL );
	$obj = json_decode( $json );

	foreach ( $obj->items as $key => $value ) {
		$videoID = $value->id->videoId;
	}
} else {
	// LATEST PLAYLIST VIDEO
	$playlistID = $opt['playlist_id'];

	$videoURL =		"https://www.googleapis.com/youtube/v3/playlistItems?";
	$videoURL .=	"part=contentDetails";
	$videoURL .=	"&maxResults=1";
	$videoURL .=	"&playlistId={$playlistID}";
	$videoURL .=	"&key={$youTubeAPIkey}";
	$json = file_get_contents( $videoURL );
	$obj = json_decode( $json );

	foreach ( $obj->items as $key => $value ) {
		$videoID = $value->contentDetails->videoId;
	}
}

$c['videoID'] = $videoID;


Timber::render( 'pages/front-page.twig', $c );

get_footer();
