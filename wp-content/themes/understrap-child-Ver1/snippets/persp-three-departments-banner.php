<?php $class='section posts'; if(!$pamount)$pamount=3; ?>

<div class="<?php echo $class;?>">
    <div class="wrapper_three_departments">
        <div class="row">
        <?php for ($i=0; $i < $pamount; $i++) { ?>
            <div class="text-center departments_item col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <a href="%content" class="banner_department">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-8 col-8 banner_department_label">
                    <div class="banner_department_label_inner">
                        <p class="flush-top flush-bottom">%content</p>
                        <h3 class="post-title flush-top flush-bottom">%content</h3>
                    </div>
                </div>
        
                <div class="text-center col-xl-12 col-lg-12 col-md-12 col-sm-4 col-4 banner_department_symbol">
                    <img src="%content" class="symbol_department">
                </div>
                <div class="banner_department_line hidden-md-up"></div>
                </a>
            </div>
        <?php } ?>
        </div>
    </div>
</div>