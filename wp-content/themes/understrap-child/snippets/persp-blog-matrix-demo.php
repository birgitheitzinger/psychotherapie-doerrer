<?php $class='section posts'; $pamount=3; ?>

<div class="<?php echo $class;?>">
	<div class="container">
		<div class="row">
			<?php for ($i=0; $i < $pamount; $i++) { ?>
			<div class="col-md-4">
				<a href="%content" class="post-item">
					<!-- <img src="http://via.placeholder.com/330x215"> -->
					%content
					<h3 class="post-title">%content</h3>
				</a>
			</div>
			<?php } ?>
        </div>
			<a href="%content" class="bottom-link">
				%content
				<i class="ion-android-arrow-forward"></i>
        	</a>
      </div>
</div>
