<?php if( function_exists('have_rows') ) : ?>
<?php if( have_rows('sections') ) : while ( have_rows('sections') ) : the_row(); ?>

	<?php $row_layout =  get_row_layout();    ?>

	<section  class="section  section_<?php echo $row_layout; ?>">

		<?php  get_template_part(  'sections/' . $row_layout   ); ?>

	</section>

<?php endwhile; endif; ?>


<?php endif; ?>
