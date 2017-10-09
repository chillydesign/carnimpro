<ul class="bxslider">


	<?php while ( have_rows('slides') ) : the_row() ; ?>


		<?php $image =  get_sub_field('image'); ?>
		<?php $slide_content =  get_sub_field('slide_content'); ?>

		<li  class="slide_photo_background" style="background-image: url(<?php echo $image['url']; ?>);" >
			 <div class="slide_content"><?php echo $slide_content; ?></div>
		</li>
	<?php endwhile; ?>


</ul>	