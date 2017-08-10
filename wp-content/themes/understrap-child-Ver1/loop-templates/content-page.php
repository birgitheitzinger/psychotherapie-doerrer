<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

$perspclass="";
//Check for parent page
if ( is_page() && $post->post_parent && !in_array($post->ID,no_childpages()) )$perspclass=" three_fourth";
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->
 <div class="page-header-img">
	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
 </div>
	<div class="entry-content <?php echo $perspclass;?>">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>
	<?php persp_childpage_navi(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
