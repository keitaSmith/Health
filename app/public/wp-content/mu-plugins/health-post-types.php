<?php
function health_post_types (){
    register_post_type('help',array(
        'public' => true,
        'supports' => array('title', 'editor','excerpt'),
            'labels'=>array(
        'name' => "How You Can Help",
        'add_new_item'=>'Add New Help Post',
        'edit_item'=>'Edit Help Post',
        'singular_name' => 'Help Post',
        'all_items' => 'All Help Posts'
            ),
        'menu_icon'=>'dashicons-heart'
    ));
}
add_action('init','health_post_types');
?>