<?php 
if ($count == 0):
	$nav="candidate__prev";
else:
	$nav="candidate__next";
endif;
?>


<div class="col s12" onclick="window.open('<?php echo the_permalink(  ); ?>','_blank')">
	<div class="<?php echo $nav; ?>" style="background-image: url( <?php echo the_post_thumbnail_url('medium'); ?> );">
		<div class="candidate__navigation__content">
			<p class="navigation__title"><?php echo the_title(); ?></p>
		</div>
	</div>
</div>