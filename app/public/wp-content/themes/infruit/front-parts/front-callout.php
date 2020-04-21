<?php
$infruit_hidecallout = get_theme_mod('hide_callout', false); 
$infruit_callout_title = get_theme_mod('callout_title');
$infruit_callout_text = get_theme_mod('callout_text','Contact US');
$infruit_callout_link = get_theme_mod('callout_btn_link');

if($infruit_hidecallout == ''){     
?>
<?php if(get_theme_mod('callout_title')) : ?>
<section class="p-same dark-colaud">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="colud-content">
                    <h2 class="tag-line"><?php echo esc_html($infruit_callout_title);?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <?php if($infruit_callout_text!=="" && $infruit_callout_link!=="") : ?>
                <div class="colaud-btn text-right">
                     <a class="default-btn" href="<?php echo esc_url($infruit_callout_link ); ?>" target="_blank">
                        <?php echo esc_html($infruit_callout_text);?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php 
endif; } ?>

<!-- Callout Ends  -->