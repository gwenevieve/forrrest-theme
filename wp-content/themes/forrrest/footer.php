<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package forrrest
 */

?>

		</div><!-- #content -->
		<footer id="colophon" class="site-footer">
		<div class="site-info">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'Footer menu',
				'container_class' => 'footer_menu',
			) );
			?>
			<div class="author-info">
			<span>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'forrrest' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'forrrest' ), 'WordPress' );
				?>
			</a>
			</span>
			<span class="sep"> | 
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'forrrest' ), 'forrrest', '<a href="https://www.mariefelton.com">marie felton</a>' );
				?>
				</span>
				</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</div><!-- .page-container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
