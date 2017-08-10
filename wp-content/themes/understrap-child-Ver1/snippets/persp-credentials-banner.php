<?php $class='section credentials'; if(!$pamount)$pamount=1; ?>

<div class="<?php echo $class;?>">
  <div class="row banner_credentials margin-0">
    <div class="col-lg-4 col-md-5 col-sm-12  col-xs-12 banner_credentials__description_txt">
      <h1 class="flush-top flush-bottom">%content</h1>
      <p class="flush-bottom">%content</p>
      <a href="%content" class=" btn btn-icon btn-icon-right btn-default btn_banner">
        <i class="fa fa-angle-right" aria-hidden="true"></i>Alle Referenzen
      </a>
    </div>
    <div class="col-lg-8 col-md-7 col-sm-12 col-12 credential_img">
      <?php for ($i=0; $i < $pamount; $i++) { ?>
        <?php if($i <= 5){ ?><div class="col-lg-3 col-md-4 col-sm-6 col-6"><?php } ?>
        <?php if($i >= 6 && $i <9){ ?><div class="col-lg-3 col-md-4 hidden-sm-down"><?php } ?>
        <?php if($i >= 9){ ?><div class="col-lg-3 hidden-md-down"><?php } ?> 
          <div class="credential_item">
            %content
          </div>
        </div>
      <?php } ?>
    </div>
  </div> <!--/row-->
</div>


  
