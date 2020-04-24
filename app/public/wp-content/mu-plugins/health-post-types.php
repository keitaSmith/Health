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

register_post_type('delivery',array(
    'public' => true,
    'has_archive' => false,
    'supports' => array('title', 'editor','excerpt'),
        'labels'=>array(
    'name' => "Food Delivery Services",
    'add_new_item'=>'Add New Food Delivery Service',
    'edit_item'=>'Edit Delivery Service',
    'singular_name' => 'Food Delivery Service',
    'all_items' => 'All Food Delivery Services'
        ),
    'menu_icon'=>'dashicons-carrot'
));
}
add_action('init','health_post_types');
?>