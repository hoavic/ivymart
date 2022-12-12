<?php

if (class_exists('WP_Customize_Control'))
{
  /**
  * Class to create a custom multiselect dropdown control
  */
  class Countries_Dropdown_Custom_control extends WP_Customize_Control
  {
    /**
    * Render the content on the theme customizer page
    */
    public $type = 'multiple-select';

    public function render_content() {

      if ( empty( $this->choices ) )
        return;
      ?>
        <label id="cat_nav">
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
          <span class="customize-control-description">Giữ CTRL + Nhấp chuột vào danh mục muốn chọn. (Tối đa 5 danh mục)</span>
          <select name='ckb[]' id="ckb" <?php $this->link(); ?> multiple="multiple" size="10">
            <?php
               foreach ( $this->choices as $value => $label ) {
                 $selected = '';
                   echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
               }
            ?>
          </select>
        </label>
        <script type="text/javascript"> 
/*           function chkcontrol(j) {
            var total=0;
            for(var i=0; i < document.form1.ckb.length; i++)
            {
              if(document.form1.ckb[i].selected)
                total =total +1;
            }
              
            if(total > 4){
              alert("Tối đa chỉ chọn 5 Danh mục!") 
              document.form1.ckb[j].selected= false ;
              return false;
            }

          } */
          jQuery(document).ready(function($) {

            var last_valid_selection = null;

            $('#ckb').change(function(event) {

                if ($(this).val().length > 5) {

                  $(this).val(last_valid_selection);
                } else {
                  last_valid_selection = $(this).val();
                }
            });
          });
        </script>
      <?php 
    }
  }
}