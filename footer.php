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
		<div class="site-info container">
			<p class="copyright">&copy; <?php echo date( "Y" ); echo " "; bloginfo( 'name' ); ?>, LLC.</p>
			<p class="disclaimer">Draft Breakdown is independently owned and operated and the comments, analysis, scouting reports, or any other information found on this site is soley the opinion of the Draft Breakdown staff. All visitors are requited to adhere to the <a href="/terms-of-use">Terms of Use</a>, <a href="/privacy-policy">Privacy Policy</a> and <a href="/anti-spam-policy">Anti-Spam Policy</a> detailed on this site. For the full disclaimer (including video content disclaimer), please go to our <a href="/disclaimer">Disclaimer</a> page. Partner of USA Today Sports Digital Properties.</p>
		</div><!-- .site-info -->

		<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
			  		<div class="modal-header">
				    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				    	<h3 id="loginLabel" class="modal-title">Member Login</h3>
			  		</div>
			  		<div class="modal-body">
			    		<?php login_with_ajax(); ?>
			  		</div>
			  		<div class="modal-footer">
			    		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
			  		</div>
			  	</div>
			</div>
		</div>
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

	<!-- Taboola -->
	<script type="text/javascript">
	  window._taboola = window._taboola || [];
	  _taboola.push({flush: true});
	</script>

</body>
</html>
