<?php
/**
 * header.php
 *
 * Includes <head> section, start of <body> and primary navigation
 *
 * @package Earl
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/img/favicon.ico">
		<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/img/apple-touch-icon.png">
		<?php wp_head(); ?>
		<!-- html5.js -->
			<!--[if lt IE 9]>
				<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->	
			
				<!-- respond.js -->
			<!--[if lt IE 9]>
			          <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
			<![endif]-->	

		<script type="text/javascript">

	      	var _gaq = _gaq || [];
	      	_gaq.push(['_setAccount', 'UA-30936458-1']);
	      	_gaq.push(['_trackPageview']);

	      	(function() {
		        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	      	})();

	    </script>

	    <!-- New USA Today Ad Script -->

	    <script type='text/javascript'>
		    (function() {
			    var useSSL = 'https:' == document.location.protocol;
			    var src = (useSSL ? 'https:' : 'http:') +
			    '//www.googletagservices.com/tag/js/gpt.js';
			    document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
		    })();
	    </script>
	    <script type='text/javascript'>
	    	googletag.pubads().enableSyncRendering();
	    </script>

	    <!-- Taboola Ad Script -->
	    <script type="text/javascript">
		  	window._taboola = window._taboola || [];
		  	_taboola.push({home:'auto'});
		  	!function (e, f, u) {
		    	e.async = 1;
		    	e.src = u;
		    	f.parentNode.insertBefore(e, f);
		  	}(document.createElement('script'),
		  	document.getElementsByTagName('script')[0],
		  	'http://cdn.taboola.com/libtrc/draftbreakdown/loader.js');
		</script>
	</head>

	<body <?php body_class(); ?>>

		<?php
			// user logged in check
			$header_logged_in = is_user_logged_in();
			$header_current_user = wp_get_current_user();
		?>
		<div id="wrap">
			<!-- navigation -->
			<nav id="primary-nav" class="navbar navbar-inverse" role="navigation">
	  			<div class="container">
	    			<div class="navbar-header">
	      				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav-collapse">
		        			<span class="sr-only">Toggle navigation</span>
					        <i class="fa fa-navicon" style="color: white; font-size: 24px;"></i>
	      				</button>
	      				<a class="navbar-brand" href="<?php bloginfo('url'); ?>">
	      					<img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/logo3.png" />
	      				</a>
	    			</div>
	    			<?php if ( !is_page(251970) ) { 
	    				?>
	    			<div class="collapse navbar-collapse" id="primary-nav-collapse">
	      				<ul class="nav navbar-nav navbar-right">
					        <li class="dropdown">
	          					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Videos <span class="caret"></span></a>
	          					<ul class="dropdown-menu" role="menu">
						            <li><a href="<?php bloginfo('url'); ?>/video">Latest Videos</a></li>
						            <li><a href="<?php bloginfo('url'); ?>/players">Prospects List</a></li>
						            <li><a href="<?php bloginfo('url'); ?>/scoutingnotes">Scouting Notes</a></li>
	          					</ul>
	        				</li>
					        <li class="dropdown">
	          					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Analysis <span class="caret"></span></a>
	          					<ul class="dropdown-menu" role="menu">
						            <li><a href="<?php bloginfo('url'); ?>/category/articles">Articles</a></li>
						            <li><a href="<?php bloginfo('url'); ?>/category/scoutingreports">Scouting Reports</a></li>
						            <li><a href="<?php bloginfo('url'); ?>/category/all-star-games">All-Star Games</a></li>
						            <li><a href="<?php bloginfo('url'); ?>/category/scouting-combine">Scouting Combine</a></li>
						            <!-- <li><a href="<?php bloginfo('url'); ?>/category/podcasts">Podcasts</a></li> -->
						            <li><a href="<?php bloginfo('url'); ?>/category/draft-guide">Draft Guide</a></li>
	          					</ul>
	        				</li>
	        				<li><a href="<?php bloginfo('url'); ?>/category/rankings">Rankings</a></li>
					        <li><a href="<?php bloginfo('url'); ?>/mockdrafts">Mock Drafts</a></li>
					        <li><a href="<?php bloginfo('url'); ?>/category/news">Draft News</a></li>
					        <li><a href="<?php bloginfo('url'); ?>/about">About</a></li>
					        <li><a href="<?php bloginfo('url'); ?>/contact">Contact</a></li>
					        <li class="dropdown">
	          					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i></a>
	          					<ul class="dropdown-menu" role="menu">
	          						<?php
	          							if ( $header_logged_in ) {
	          								?>
	          								<li><a href="<?php bloginfo('url'); ?>/member-settings/?username=<?php echo $header_current_user->user_login; ?>">Member Settings</a></li>
						            		<li><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
						            		<?php
	          							}
	          							else {
	          								?>
	          								<li><a data-target="#loginModal" data-toggle="modal" href="">Login</a></li>
						            		<li><a href="<?php bloginfo('url'); ?>/join">Join</a></li>
						            		<?php
	          							}
	          						?>
	          					</ul>
	        				</li>
					        <li class="visible-xs visible-sm social-links">
					        	<div class="nav-icon-container">
					        		<a href="http://www.twitter.com/draftbreakdown">
					        			<span class="fa-stack fa-lg">
  											<i class="fa fa-square fa-stack-2x twitter-background"></i>
  											<i class="fa fa-twitter fa-stack-1x twitter-bird"></i>
										</span>
					        		</a>
					        	</div>
					        	<div class="nav-icon-container">
					        		<a href="http://www.facebook.com/draftbreakdown">
					        			<span class="fa-stack fa-lg">
  											<i class="fa fa-square fa-stack-2x facebook-background"></i>
  											<i class="fa fa-facebook fa-stack-1x facebook-f"></i>
										</span>
					        		</a>
					        	</div>
					        	<div class="nav-icon-container">
					        		<a href="<?php bloginfo('url'); ?>/contact">
					        			<span class="fa-stack fa-lg">
  											<i class="fa fa-square fa-stack-2x mail-background"></i>
  											<i class="fa fa-envelope-o fa-stack-1x mail-logo"></i>
										</span>
					        		</a>
					        	</div>
					        	<div class="nav-icon-container">
					        		<a href="<?php bloginfo('url'); ?>/feed">
					        			<span class="fa-stack fa-lg">
  											<i class="fa fa-square fa-stack-2x rss-background"></i>
  											<i class="fa fa-rss fa-stack-1x rss-logo"></i>
										</span>
					        		</a>
					        	</div>
					        </li>
	      				</ul>
	    			</div><!-- /.navbar-collapse -->
	    			<?php 
	    				// end if (!is_poge('edit-notes'))
	    				}
	    			?>
	  			</div><!-- /.container-fluid -->
			</nav>	
			<!-- start content area -->
			<div id="main-content" class="container">	