<?php
/**
 * Mockdraft custom post type functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */

/**
 * Create mockdrafts cpt
 */
function wsdev_mockdrafts_cpt() {
    register_post_type( 'mockdrafts',
        array(
            'labels' => array(
                'name' => __( 'Mock Drafts' ),
                'singular_name' => __( 'Mock Draft' ),
                'add_new' => __( 'Add New Mock Draft' ),
                'add_new_item' => __( 'Add New Mock Draft' ),
                'edit_item' => __( 'Edit Mock Draft' ),
                'new_item' => __( 'Add New Mock Draft' ),
                'view_item' => __( 'View Mock Draft' ),
                'search_items' => __( 'Search Mock Drafts' ),
                'not_found' => __( 'No mock drafts found' ),
                'not_found_in_trash' => __( 'No mock drafts found in trash' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'comments'),
            'taxonomies' => array('category'),
            'capability_type' => 'post',
            'rewrite'         => array(
					'slug'		 	=> '',
					'with_front'	=> true
				),
            'menu_position' => 8,
            'register_meta_box_cb' => 'wsdev_add_mockdraft_metaboxes'
        )
    );
}

/**
 * Mockdraft metaboxes
 */
function wsdev_add_mockdraft_metaboxes() {
    add_meta_box('wsdev_mockdraft_metabox', 'Mock Draft', 'wsdev_mockdraft_metabox', 'mockdrafts', 'normal', 'high');

}
 
function wsdev_mockdraft_metabox() {
    global $post;
 
    echo '<input type="hidden" name="mockdraft_meta_noncename" id="mockdraft_meta_noncename" value="' .
    wp_create_nonce( 'mockdraft_meta_nonce' ) . '" />';
 
	$original_post = $post;

	$mock = get_post_meta($post->ID, '_mock', true);

	$teams = mock_team_select();
	$players = mock_player_select('2015');
	$order = get_draft_order();

	?>
	<h3>Round 1</h3>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Pick</th>
				<th>Team</th>
				<th>Selection</th>
				<th>Analysis</th>
			</tr>
		</thead>
		<tbody>
			<?php
				for ( $i = 1; $i < 33; $i++ ) {
					$round_num = 1;
					echo '<tr style="vertical-align: top;"><td style="max-width: 15px;">';
					echo $i;
					echo '</td><td style="max-width: 200px;">';
					echo '<select name="mock['.$round_num.']['.$i.'][team]">';
					echo '<option value="">&nbsp;</option>';
					foreach ( $teams as $team => $value ) {

						if ($mock) {
							if ( $mock[$round_num][$i]['team'] == $value ) {
								echo '<option value="'.$value.'" selected>'.$team.'</option>';
							}
							else {
								echo '<option value="'.$value.'">'.$team.'</option>';
							}
						}

						else {

							if ( $order[$i] == $value ) {
								echo '<option value="'.$value.'" selected>'.$team.'</option>';
							}
							else {
								echo '<option value="'.$value.'">'.$team.'</option>';
							}
							
						}

					}
					echo '</select></td>';
					echo '<td style="max-width: 300px;">';
					echo '<select name="mock['.$round_num.']['.$i.'][player]">';
					echo '<option value="">&nbsp;</option>';
					foreach ( $players as $player ) {

						if ($mock) {
							if ( $mock[$round_num][$i]['player'] == $player['ID'] ) {
								echo '<option value="'.$player['ID'].'" selected>'.$player['name'].' - '.$player['position'].' - '.$player['school'].'</option>';
							}
							else {
								echo '<option value="'.$player['ID'].'">'.$player['name'].' - '.$player['position'].' - '.$player['school'].'</option>';
							}
						}

						else {
							echo '<option value="'.$player['ID'].'">'.$player['name'].' - '.$player['position'].' - '.$player['school'].'</option>';
						}
						
						
					}
					echo '</td>';
					if ($mock) {
						echo '<td style="width: 300px;"><textarea style="width: 100%;" rows="3" name="mock['.$round_num.']['.$i.'][analysis]">'.$mock[$round_num][$i]['analysis'].'</textarea>';
					}
					else {
						echo '<td style="width: 300px;"><textarea style="width: 100%;" rows="3" name="mock['.$round_num.']['.$i.'][analysis]"></textarea>';
					}
					
					echo '</td></tr>';
				}

				$post = $original_post;
			?>
			
		</tbody>
	</table>

	<?php

}

function wsdev_save_mockdraft_meta($post_ID, $post) {

	$slug = 'mockdrafts';
	
	if ( $slug != $_POST['post_type'] ) {
        return;
    }
  
  	$nonce = null;
  	if ( $_POST['mockdraft_meta_noncename'] ) {
  		$nonce = $_POST['mockdraft_meta_noncename'];
  	}
	
    if ( !wp_verify_nonce( $nonce, 'mockdraft_meta_nonce' )) {
    	return $post->ID;
    }
 
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    $mockdraft_post_id = $post->ID;

	$mockdraft_meta['_mock'] = $_POST['mock'];
   
    foreach ($mockdraft_meta as $key => $value) { 
        if( $post->post_type == 'revision' ) return; 
        //$value = implode(',', (array)$value); 
        if(get_post_meta($post->ID, $key, FALSE)) { 
            update_post_meta($post->ID, $key, $value);
        } else { 
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); 
    }

}

/**
 * Display a player select list for Mock Draft CPT 
 */
function mock_player_select($class) {
	
	// let's get the players now and save them in an array

	$players = array();

	$args = array(
					'post_type' => 'player',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC',
					'meta_key' => '_draft_class',
					'meta_value' => $class,
					'meta_compare' => '>='
			);
	$prospects = new WP_Query($args);

	while ( $prospects->have_posts() ) : $prospects->the_post();

		$player = array('ID' => get_the_ID(),
						'name' => get_the_title(),
						'position' => get_post_meta( get_the_ID(), '_position', true),
						'school' => get_post_meta( get_the_ID(), '_school', true) );
		array_push($players, $player);
	
	endwhile;
	wp_reset_query();
	wp_reset_postdata();

	return $players;

}

/**
 * Display a team select list for Mock Draft CPT 
 */
function mock_team_select() {
	
	$teams = array(
				'Arizona Cardinals' => 'ARI',
				'Atlanta Falcons' => 'ATL',
				'Baltimore Ravens' => 'BAL',
				'Buffalo Bills' => 'BUF',
				'Carolina Panthers' => 'CAR',
				'Chicago Bears' => 'CHI',
				'Cincinnati Bengals' => 'CIN',
				'Cleveland Browns' => 'CLE',
				'Dallas Cowboys' => 'DAL',
				'Denver Broncos' => 'DEN',
				'Detroit Lions' => 'DET',
				'Green Bay Packers' => 'GB',
				'Houston Texans' => 'HOU',
				'Indianapolis Colts' => 'IND',
				'Jacksonville Jaguars' => 'JAX',
				'Kansas City Chiefs' => 'KC',
				'Miami Dolphins' => 'MIA',
				'Minnesota Vikings' => 'MIN',
				'New England Patriots' => 'NE',
				'New Orleans Saints' => 'NO',
				'New York Jets' => 'NYJ',
				'New York Giants' => 'NYG',
				'Oakland Raiders' => 'OAK',
				'Philadelphia Eagles' => 'PHI',
				'Pittsburgh Steelers' => 'PIT',
				'San Diego Chargers' => 'SD',
				'San Francisco 49ers' => 'SF',
				'Seattle Seahwawks' => 'SEA',
				'St. Louis Rams' => 'STL',
				'Tampa Bay Buccaneers' => 'TB',
				'Tennessee Titans' => 'TEN',
				'Washington Redskins' => 'WAS' 
			);

	return $teams;

}

/**
 * Display latest player video
 */
function get_latest_player_video($player_id) {

	$args = array( 'post_type' => 'video',
					'posts_per_page' => 1,
					'order' => 'DSC',
					'orderby' => 'date',
					'meta_key' => '_video_prospect',
					'meta_value' => $player_id );

	$video = new WP_Query($args);

	while ( $video->have_posts() ) : $video->the_post();
		$video_post_id = get_the_ID();
		$video_id = get_post_meta( $video_post_id, '_video_id', true );
	endwhile;
	wp_reset_query();
	wp_reset_postdata();

	return $video_id;
}

/**
 * Get team logo image src
 */
function get_team_logo($team) {

	switch($team) {

		case 'ARI':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/cardinals.gif';
			break;
		case 'ATL':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/falcons.gif';
			break;
		case 'BAL':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/ravens.gif';
			break;
		case 'BUF':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/bills.gif';
			break;
		case 'CAR':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/panthers.gif';
			break;
		case 'CHI':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/bears.gif';
			break;
		case 'CIN':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/bengals.gif';
			break;
		case 'CLE':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/browns.gif';
			break;
		case 'DAL':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/cowboys.gif';
			break;
		case 'DEN':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/broncos.gif';
			break;
		case 'DET':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/lions.gif';
			break;
		case 'GB':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/packers.gif';
			break;
		case 'HOU':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/texans.gif';
			break;
		case 'IND':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/colts.gif';
			break;
		case 'JAX':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/jaguars.gif';
			break;
		case 'KC':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/chiefs.gif';
			break;
		case 'MIA':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/dolphins.gif';
			break;
		case 'MIN':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/vikings.gif';
			break;
		case 'NE':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/patriots.gif';
			break;
		case 'NO':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/saints.gif';
			break;
		case 'NYJ':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/jets.gif';
			break;
		case 'NYG':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/giants.gif';
			break;
		case 'OAK':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/raiders.gif';
			break;
		case 'PHI':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/eagles.gif';
			break;
		case 'PIT':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/steelers.gif';
			break;
		case 'SD':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/chargers.gif';
			break;
		case 'SF':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/49ers.gif';
			break;
		case 'SEA':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/seahawks.gif';
			break;
		case 'STL':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/rams.gif';
			break;
		case 'TB':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/bucs.gif';
			break;
		case 'TEN':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/titans.gif';
			break;
		case 'WAS':
			return 'http://www.draftbreakdown.com/wp-content/uploads/2011/01/redskins.gif';
			break;
		default:
			return '';
	}

}

/**
 * Get current draft order
 */
function get_draft_order() {
	$order = array( '1' => 'OAK',
					'2' => 'JAX',
					'3' => 'TEN',
					'4' => 'CLE',
					'5' => 'NYJ',
					'6' => 'WAS',
					'7' => 'TB',
					'8' => 'STL',
					'9' => 'MIN',
					'10' => 'MIA',
					'11' => 'DET',
					'12' => 'CLE',
					'13' => 'SD',
					'14' => 'NYG',
					'15' => 'HOU',
					'16' => 'DAL',
					'17' => 'CIN',
					'18' => 'ATL',
					'19' => 'ARI',
					'20' => 'CAR',
					'21' => 'BAL',
					'22' => 'PIT',
					'23' => 'PHI',
					'24' => 'NO',
					'25' => 'KC',
					'26' => 'IND',
					'27' => 'CHI',
					'28' => 'GB',
					'29' => 'SF',
					'30' => 'NE',
					'31' => 'DEN',
					'32' => 'SEA');
	return $order;
}

/******************* FIX THIS SECTION ************************/
/**
 * Mockdraft Comments
 */
function custom_mockdraft_comments($comment, $args, $depth) {
    $isByAuthor = false;
    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }
   $GLOBALS['comment'] = $comment; ?>

   <li <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" <?php if($isByAuthor){ echo 'class="author"';}?>>
         <div class="pull-right media-object">
            <?php echo get_avatar( $comment->comment_author_email, 52 ); ?>
            <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="icon-share" title="Reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?><a href="<?php bloginfo('url'); ?>/comment-editor/?comment_ID=<?php comment_ID(); ?>"><i class="icon-edit" title="Edit"></i></a>
         </div>
         <div class="media-body">
            <div class="comment-meta">
               <span class="comment-author vcard media-heading"><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> </span> &bull; <?php printf(__('%1$s, at %2$s'), get_comment_date(),  get_comment_time()) ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
            <?php endif; ?>
            <?php comment_text() ?>
         </div>
     </div><!-- #comment-ID -->
    </li>
	<?php
}
