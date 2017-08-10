<?php $class='quotes_landingpage_slider'; if(!$pamount)$pamount=1; ?>

<div class="<?php echo $class;?>">
	<?php for ($i=0; $i < $pamount; $i++) { ?>
		<div class="quotes_landingpage">
            <p class="flush-top">%content</p>
            <p class="author">%content</p>
		</div>
    <?php } ?>
</div>