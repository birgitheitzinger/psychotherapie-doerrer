<?php $class='section header'; //if(!$pamount)$pamount=3; ?>

<header class="<?php echo $class;?>">
  <div class="row">
    <div class="col-md-12">
      <div class="landingpage_slider">
      <?php for ($i=0; $i < $pamount; $i++) { ?>
        <div><img src="%content"></div>
      <?php } ?>
      </div>
    </div>
  </div>
</header>