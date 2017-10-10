<script type="text/javascript">
	var search_url = '<?php echo home_url(); ?>/api/v1/';
</script>
<script id="workshops_template" type="x-underscore">
	<?php echo file_get_contents(dirname(__FILE__) . '/templates/workshops.underscore'); ?>
</script>


<div class="container" id="workshops_container"></div>
