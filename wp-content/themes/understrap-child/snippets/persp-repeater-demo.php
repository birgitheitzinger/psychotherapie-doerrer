<?php
$class='section faq';
if(!$pamount)$pamount=2;
?>

<div class="<?php echo $class;?>">
<div class="container">
  <h2 class="flush-top">Häufig gestellte Fragen</h2>
  <div class="custom-accordion">
    <?php for ($i=0; $i < $pamount; $i++) { $j=($i+1); ?>

    <div class="panel panel-default">
      <div class="panel-heading" role="tab" id="heading-<?php echo $j;?>">
        <h3 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $j;?>" aria-expanded="true" aria-controls="collapse<?php echo $j;?>">
            %content
            <i class="ion-ios-arrow-down"></i>
          </a>
        </h3>
      </div>
      <div id="collapse<?php echo $j;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $j;?>">
        <div class="panel-body">
            %content

        </div>
      </div>
    </div> <!-- panel panel-default -->
    <?php } ?>

  </div> <!-- custom accordion -->
</div> <!-- container -->
</div><!-- section-->

<?php
