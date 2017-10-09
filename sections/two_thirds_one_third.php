<?php $image =  get_sub_field('one_third_image'); ?>
<?php $image_position = get_sub_field('image_position'); ?> 
<?php  $classes = ($image_position == 'right') ?  [ 'col-sm-8 col-sm-text-right', 'col-sm-4' ]  :  [ 'col-sm-8 col-sm-push-4', 'col-sm-4 col-sm-pull-8' ]  ; ?> 

<div class="container">
	<div class="row">


		<div class="<?php echo $classes[0]; ?>">
		<?php echo get_sub_field('two_thirds_content'); ?>
		</div>


		<div class="<?php echo $classes[1]; ?>">
		<div class="one_third_image"><img src="<?php echo $image['url']; ?>"  alt="" /></div>
		</div>

	</div> <!-- END OF ROW -->

</div><!--  END OF CONTAINER -->
