<?php
//hook into the init action and call create_book_taxonomies when it fires
  
add_action( 'init', 'create_subjects_hierarchical_taxonomy', 0 );
  
//create a custom taxonomy name it subjects for your posts
  
function create_subjects_hierarchical_taxonomy() {
  
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
  
  $labels = array(
    'name' => _x( 'Thương hiệu', 'thuong_hieu' ),
    'singular_name' => _x( 'Thương hiệu', 'thuong_hieu' ),
    'search_items' =>  __( 'Tìm Thương hiệu' ),
    'all_items' => __( 'Tất cả Thương hiệu' ),
    'parent_item' => __( 'Thương hiệu Cha' ),
    'parent_item_colon' => __( 'Thương hiệu Cha:' ),
    'edit_item' => __( 'Sửa Thương hiệu' ), 
    'update_item' => __( 'Cập nhật Thương hiệu' ),
    'add_new_item' => __( 'Tạo Thương hiệu mới' ),
    'new_item_name' => __( 'Thêm Tên Thương hiệu' ),
    'menu_name' => __( 'Thương Hiệu' ),
  );    
  
// Now register the taxonomy
  register_taxonomy('thuong_hieu',array('product'), array(
    'hierarchical' => true,
    'labels' => $labels,

    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => false,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'thuong_hieu' ),
  ));
  
}


?>
