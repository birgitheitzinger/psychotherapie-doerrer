<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'loop-templates/content', 'single' );
					ob_start();
						echo "<h1 class='event_title flush-bottom'>".get_the_title()."</h1>";
							echo "<div class='single-event_info_wrapper'>
											<div>
												<h3 class='single-event_info_labels'>Leitung: </h3>
												<p class='single-event_info'>". get_field("termin_leitung")."</p><br/>";
							echo "<h3 class='single-event_info_labels'>Datum:</h3>
										<p class='single-event_info'> ".strip_tags(get_field("termin_zeit_start"))."</p><br/>";//. date("d.m.Y",strtotime(get_field("termin_datum_start")))."";
							// echo " <br/>bis ". date("d.m.Y",strtotime(get_field("termin_datum_ende")))."</p><br/>";

							//echo "<h3 class='single-event_info_labels'>Zeit:</h3>";
							//echo "<div class='single-event_info'>";
							//	echo get_field("termin_zeit_start")."";
							//echo "</div><br/>";
							// echo get_field("termin_zeit_ende")."</p><br/>";


							echo "<h3 class='single-event_info_labels'>Ort: </h3><span class='single-event_info'> ".get_field("termin_ort")."</span>
									</div>
									<div>
										<img src='http://persp.dbkldp.com/wp-content/themes/understrap-child/img/OeFS_Zertifikat.png' alt='OeFS Zertifikat'>
									</div>
							</div>";
							echo "<br/>".get_field("termin_inhalt")." ";

							if ( shortcode_exists( 'ptermin-formular' ) ){
							echo do_shortcode('[ptermin-formular]'); //standard gravity form, shortcode can be de-activated via backend
							}

							$oneevent=ob_get_contents();
						  ob_end_clean();

						//output event col
						global $post; $i=get_the_post_thumbnail( $post->ID, 'large' );
						if($i)	echo  '<div class="page-header-img">'.$i. '</div>';
						echo do_shortcode('[three_fifth]'.$oneevent.'[/three_fifth]');

						//decide on termin category
						$catfrompost="kategorie-xyz";

						$eventsidebar= do_shortcode('[persp-alle-termine cat="'.$catfrompost.'"]');

						echo do_shortcode('[two_fifth_last]'.$eventsidebar.'[/two_fifth_last]');

					?>

						<?php understrap_post_nav(); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
