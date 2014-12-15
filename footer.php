<?php
/**
 * footer.php
 *
 * Includes closing of main content, footer content and closing of <body> & <html>
 *
 * @package Earl
 */
?>

		</div><!-- #main_content -->
	</div><!--#wrap-->
	<footer>
		<div class="site-info">
			<p class="copyright">&copy; <?php echo date( "Y" ); echo " "; bloginfo( 'name' ); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<!-- Begin comScore Tag -->
	<script type="text/javascript">
	    document.write(unescape("%3Cscript src='" + (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js' %3E%3C/script%3E"));
	</script>

	<script type="text/javascript">
	  COMSCORE.beacon({
	    c1:2,
	    c2:"6035210",
	    c3:"",
	    c4:"www.draftbreakdown.com",
	    c5:"",
	    c6:"",
	    c15:""
	  });
	</script>
	<noscript>
	  <img src="http://b.scorecardresearch.com/b?c1=2&c2=6035210&c3=&c4=www.draftbreakdown.com&c5=&c6=&c15=&cv=1.3&cj=1" style="display:none" width="0" height="0" alt="" />
	</noscript>
<!-- End comScore Tag -->
</body>
</html>
