<?php
include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

class DW_Minion_Textarea_Custom_Control extends WP_Customize_Control {

  public $type = 'textarea';
  public $statuses;
  public function __construct( $manager, $id, $args = array() ) {

  $this->statuses = array( '' => __( 'Default', 'dw-minion' ) );
    parent::__construct( $manager, $id, $args );
  }

  public function render_content() {
    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
      <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
        <?php echo esc_textarea( $this->value() ); ?>
      </textarea>
    </label>
    <?php
  }
}

class Layout_Picker_Custom_control extends WP_Customize_Control {

  public function render_content() {

  if ( empty( $this->choices ) ) return;

  $name = '_customize-radio-' . $this->id;

  ?>
  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
  <table style="margin-top: 10px; text-align: center; width: 100%;">
    <tr>
    <?php foreach ( $this->choices as $value => $label ) : ?>
    <?php 
      $checked = '';
      if($value == 0) $checked = 'checked';
    ?>
    <td>
      <label>
	  <img src="http://ecx.images-amazon.com/images/I/51CLPe6mN6L._SL110_.jpg" width="110" alt="Return to product information" height="62" border="0">
        <?php /*?><img src="<?php echo get_template_directory_uri(); ?>/inc/img/layout-<?php echo esc_attr( $value ); ?>.png" alt="<?php echo esc_attr( $value ); ?>" /><br />
		<?php */?>
        <input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); echo $checked ?> />
      </label>
    </td>
    <?php endforeach; ?>
    </tr>
  </table>
    <?php
  }
}

class Color_Picker_Custom_control extends WP_Customize_Control {

  public function render_content() {

    if ( empty( $this->choices ) ) return;
    $name = '_customize-radio-' . $this->id; ?>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <table style="margin-top: 10px; text-align: center; width: 100%;">
      <tr>
        <?php foreach ( $this->choices as $value => $label ) {
                $checked = '';
                if($value == 0) $checked = 'checked'; ?>
                <td>
                  <label>
                    <div style="width: 30px; height: 30px; margin: 0 auto; background: <?php echo esc_attr( $label )?> "></div><br />
                    <?php if($value == 0) $label = '' ?>
                    <input type="radio" value="<?php echo esc_attr( $label ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); echo $checked ?> />
                  </label>
                </td>
          <?php } ?>
      </tr>
    </table><?php

  }
}

class Aheadzen_Layout_Picker_Custom_control extends WP_Customize_Control {

  public function render_content() {

  if ( empty( $this->choices ) ) return;

  $name = $this->id;

  ?>
  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
  <table style="margin-top: 10px; text-align: center; width: 100%;">
    <tr>
    <?php foreach ( $this->choices as $value => $label ) : ?>
    <?php 
      $checked = '';
      if($value == 'fullwidth') $checked = 'checked';
    ?>
    <td>
      <label>
		<img src="<?php echo get_template_directory_uri(); ?>/inc/images/<?php echo esc_attr( $value ); ?>.jpg" alt="<?php echo esc_attr( $value ); ?>" /><br />
		<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); echo $checked ?> />
      </label>
    </td>
    <?php endforeach; ?>
    </tr>
  </table>
    <?php
  }
}

class Aheadzen_Paten_Picker_Custom_control extends WP_Customize_Control {

  public function render_content() {

  if ( empty( $this->choices ) ) return;

  $name = $this->id;

  ?>
  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
  <ul style="margin-top: 10px; text-align: center; width: 100%;">
    <?php foreach ( $this->choices as $label => $value ) : ?>
    <?php 
      $checked = '';
      if($value == 'pattern1') $checked = 'checked';
    ?>
    <li style="display:inline-block;">
      <label>
		<img style="width:30px; height:30px;" src="<?php echo get_template_directory_uri(); ?>/inc/images/patterns/<?php echo esc_attr( $value ); ?>.jpg" alt="<?php echo esc_attr( $value ); ?>" /><br />
		<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); echo $checked ?> />
      </label>
    </li>
    <?php endforeach; ?>
    </ul>
    <?php
  }
}

class Aheadzen_Color_Picker_Custom_control extends WP_Customize_Control {

  public function render_content() {

  if ( empty( $this->choices ) ) return;

  $name = $this->id;

  ?>
  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
  <ul style="margin-top: 10px; text-align: center; width: 100%;">
    <?php foreach ( $this->choices as $label => $value ) : ?>
    <?php 
      $checked = '';
      if($value == 'blue') $checked = 'checked';
    ?>
    <li style="display:inline-block;">
      <label>
		<img style="width:30px; height:30px;" src="<?php echo get_template_directory_uri(); ?>/inc/images/style-picker/<?php echo esc_attr( $value ); ?>.jpg" alt="<?php echo esc_attr( $value ); ?>" /><br />
		<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); echo $checked ?> />
      </label>
    </li>
    <?php endforeach; ?>
    </ul>
    <?php
  }
}

function dw_minion_customize_register( $wp_customize ) {

  // GENERAL SETTINGS --------------------------------------------------------------------------------------
  $wp_customize->add_section('dw_minion_general', array(
    'title'    => __('Layout Settings', 'dw-minion'),
    'priority' => 9,
  ));
  
  
	$wp_customize->add_setting('aheadzen_layout', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
	));
	$wp_customize->add_control( new Aheadzen_Layout_Picker_Custom_control($wp_customize, 'aheadzen_layout', array(
    'label' => __('Choose your layout', 'dw-minion'),
    'section' => 'dw_minion_general',
    'settings' => 'aheadzen_layout',
    'choices'    => array(
      'fullwidth' => 'Full Width',
      'boxed' => 'Boxed',
    ),
  )));
  
  $aheadzen_layout = get_option('aheadzen_layout');
  if($aheadzen_layout=='boxed'){
	  $wp_customize->add_setting('aheadzen_pattern', array(
			'capability'     => 'edit_theme_options',
			'type'           => 'option',
		));
		$wp_customize->add_control( new Aheadzen_Paten_Picker_Custom_control($wp_customize, 'aheadzen_pattern', array(
		'label' => __('Patterns for Boxed Layout', 'dw-minion'),
		'section' => 'dw_minion_general',
		'settings' => 'aheadzen_pattern',
		'choices'    => array('pattern1','pattern2','pattern3','pattern4','pattern5','pattern6','pattern7','pattern8','pattern9','pattern10','pattern11','pattern12','pattern13','pattern14','pattern15'),
	  )));
	  
	 
	 $wp_customize->add_setting('aheadzen_bg_color', array(
		'default'        => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
	  ));
	  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_color', array(
		'label'        => __( 'Background Color for Boxed Layout', 'dw-minion' ),
		'section'    => 'dw_minion_general',
		'settings'   => 'aheadzen_bg_color',
	  )));
  }
?>
  <?php /*?>
  // SITE LAYOUT --------------------------------------------------------------------------------------
  $wp_customize->add_section('dw_minion_layout', array(
    'title'    => __('Site Alignment', 'dw-minion'),
    'priority' => 10,
  ));

  $wp_customize->add_setting('dw_minion_theme_options[layout]', array(
    'capability' => 'edit_theme_options',
    'type' => 'option'
  ));

  $wp_customize->add_control( new Layout_Picker_Custom_control($wp_customize, 'layout', array(
    'label' => __('Align Left/Center', 'dw-minion'),
    'section' => 'dw_minion_layout',
    'settings' => 'dw_minion_theme_options[layout]',
    'choices' => array('left', 'center')
  )));
<?php */?>
<?php
  // SITE INFO & FAVICON --------------------------------------------------------------------------------------
/*  $wp_customize->add_setting('dw_minion_theme_options[about]', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new DW_Minion_Textarea_Custom_Control($wp_customize, 'about', array(
    'label'      => __('About', 'dw-minion'),
    'section'    => 'title_tagline',
    'settings'   => 'dw_minion_theme_options[about]',
  )));
  
  $wp_customize->add_setting('dw_minion_theme_options[logo]', array(
    'capability' => 'edit_theme_options',
    'type' => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
    'label' => __('Site Logo', 'dw-minion'),
    'section' => 'title_tagline',
    'settings' => 'dw_minion_theme_options[logo]',
  )));
 
  $wp_customize->add_setting('dw_minion_theme_options[header_display]', array(
    'default'        => 'site_title',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( 'header_display', array(
    'settings' => 'dw_minion_theme_options[header_display]',
    'label'   => 'Display as',
    'section' => 'title_tagline',
    'type'    => 'select',
    'choices'    => array(
      'site_title' => 'Site Title',
      'site_logo' => 'Site Logo',
    ),
  ));
   */
  $wp_customize->add_setting('aheadzen_favicon', array(
    'capability' => 'edit_theme_options',
    'type' => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'aheadzen_favicon', array(
    'label' => __('Site Favicon', 'dw-minion'),
    'section' => 'title_tagline',
    'settings' => 'aheadzen_favicon',
  )));
  ?>
<?php /*?>
  // SOCIAL LINKS --------------------------------------------------------------------------------------
  $wp_customize->add_section('dw_minion_social_links', array(
    'title'    => __('Social Links', 'dw-minion'),
    'priority' => 108,
  ));
  $wp_customize->add_setting('dw_minion_theme_options[facebook]', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control('facebook', array(
    'label'      => __('Facebook', 'dw-minion'),
    'section'    => 'dw_minion_social_links',
    'settings'   => 'dw_minion_theme_options[facebook]',
  ));
  $wp_customize->add_setting('dw_minion_theme_options[twitter]', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control('twitter', array(
    'label'      => __('Twitter', 'dw-minion'),
    'section'    => 'dw_minion_social_links',
    'settings'   => 'dw_minion_theme_options[twitter]',
  ));
  $wp_customize->add_setting('dw_minion_theme_options[google_plus]', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control('google_plus', array(
    'label'      => __('Google+', 'dw-minion'),
    'section'    => 'dw_minion_social_links',
    'settings'   => 'dw_minion_theme_options[google_plus]',
  ));
  $wp_customize->add_setting('dw_minion_theme_options[youtube]', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control('youtube', array(
    'label'      => __('YouTube', 'dw-minion'),
    'section'    => 'dw_minion_social_links',
    'settings'   => 'dw_minion_theme_options[youtube]',
  ));
  $wp_customize->add_setting('dw_minion_theme_options[linkedin]', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control('linkedin', array(
    'label'      => __('LinkedIn', 'dw-minion'),
    'section'    => 'dw_minion_social_links',
    'settings'   => 'dw_minion_theme_options[linkedin]',
  ));

  // LEFT SIDEBAR COLOR --------------------------------------------------------------------------------------
  $wp_customize->add_section('dw_minion_leftbar', array(
    'title'    => __('Left Sidebar Color', 'dw-minion'),
    'priority' => 109,
  ));
  $wp_customize->add_setting('dw_minion_theme_options[leftbar_bgcolor]', array(
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
    'default'        => '#222222'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'leftbar_bgcolor', array(
    'label'        => __( 'Background Color', 'dw-minion' ),
    'section'    => 'dw_minion_leftbar',
    'settings'   => 'dw_minion_theme_options[leftbar_bgcolor]',
  )));
  $wp_customize->add_setting('dw_minion_theme_options[leftbar_bghovercolor]', array(
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
    'default'        => '#111111'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'leftbar_bghovercolor', array(
    'label'        => __( 'Background Hover Color', 'dw-minion' ),
    'section'    => 'dw_minion_leftbar',
    'settings'   => 'dw_minion_theme_options[leftbar_bghovercolor]',
  )));
  $wp_customize->add_setting('dw_minion_theme_options[leftbar_color]', array(
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
    'default'        => '#444444'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'leftbar_color', array(
    'label'        => __( 'Text Color', 'dw-minion' ),
    'section'    => 'dw_minion_leftbar',
    'settings'   => 'dw_minion_theme_options[leftbar_color]',
  )));
  $wp_customize->add_setting('dw_minion_theme_options[leftbar_hovercolor]', array(
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
    'default'        => '#ffffff'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'leftbar_hovercolor', array(
    'label'        => __( 'Text Hover Color', 'dw-minion' ),
    'section'    => 'dw_minion_leftbar',
    'settings'   => 'dw_minion_theme_options[leftbar_hovercolor]',
  )));
  $wp_customize->add_setting('dw_minion_theme_options[leftbar_bordercolor]', array(
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
    'default'        => '#333333'
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'leftbar_bordercolor', array(
    'label'        => __( 'Border Color', 'dw-minion' ),
    'section'    => 'dw_minion_leftbar',
    'settings'   => 'dw_minion_theme_options[leftbar_bordercolor]',
  )));
<?php */?>

<?php
  // STYLE SELECTOR --------------------------------------------------------------------------------------
  $wp_customize->add_section('aheadzen_skin', array(
    'title'    => __('Style Selector', 'dw-minion'),
    'priority' => 10,
  ));
  $wp_customize->add_setting('aheadzen_skin', array(
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new Aheadzen_Color_Picker_Custom_control($wp_customize, 'select-color', array(
    'label' => __('Color Schemes', 'dw-minion'),
    'section' => 'aheadzen_skin',
    'settings' => 'aheadzen_skin',
    'choices' => array('blue', 'chocolate', 'coral', 'cyan', 'eggplant', 'electricblue', 'ferngreen', 'gold', 'green', 'grey', 'khaki', 'ocean', 'orange', 'palebrown', 'pink', 'purple', 'raspberry', 'red', 'skyblue', 'slateblue')
  )));
  
  
   // Custom STYLE SELECTOR --------------------------------------------------------------------------------------
  $wp_customize->add_section('aheadzen_custom', array(
    'title'    => __('Customize Style Selector', 'dw-minion'),
    'priority' => 10,
  ));
  
  $wp_customize->add_setting('aheadzen_logo_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_logo_color', array(
    'label'        => __( 'Logo Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_logo_color',
	'priority' => 13, 
)));
  $wp_customize->add_setting('aheadzen_heading_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_heading_color', array(
    'label'        => __( 'Title Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_heading_color',
	'priority' => 14, 
  )));
  
   $wp_customize->add_setting('aheadzen_subheading_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_subheading_color', array(
    'label'        => __( 'Sub Title Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_subheading_color',
	'priority' => 15, 
  )));
  
  $wp_customize->add_setting('aheadzen_link_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_link_color', array(
    'label'        => __( 'Link Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_link_color',
	'priority' => 16, 
  )));
  
  $wp_customize->add_setting('aheadzen_menulink_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_menulink_color', array(
    'label'        => __( 'Menu Link Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_menulink_color',
	'priority' => 17, 
  )));
	
$wp_customize->add_setting('aheadzen_headerbg_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_headerbg_color', array(
    'label'        => __( 'Header Background Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_headerbg_color',
	'priority' => 18, 
  )));
  
  $wp_customize->add_setting('aheadzen_headerborder_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_headerborder_color', array(
    'label'        => __( 'Header Bottom Border Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_headerborder_color',
	'priority' => 19, 
  )));
  
  $wp_customize->add_setting('aheadzen_footer_heading_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  
   $wp_customize->add_setting('aheadzen_maintitle_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_1maintitle_color', array(
    'label'        => __( 'Section Title Text Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_maintitle_color',
	'priority' => 20, 
  )));
  
  $wp_customize->add_setting('aheadzen_mainbg_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_mainbg_color', array(
    'label'        => __( 'Section Title Background Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_mainbg_color',
	'priority' => 21, 
  )));
  
  $wp_customize->add_setting('aheadzen_mainshadow_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_mainshadow_color', array(
    'label'        => __( 'Section Title Background Shadow Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_mainshadow_color',
	'priority' => 22, 
  )));  
  
   $wp_customize->add_setting('aheadzen_maintitle_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_1maintitle_color', array(
    'label'        => __( 'Section Title Text Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_maintitle_color',
	'priority' => 23, 
  )));
  
  $wp_customize->add_setting('aheadzen_mainbg_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_mainbg_color', array(
    'label'        => __( 'Section Title Background Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_mainbg_color',
	'priority' => 24, 
  )));
  
  $wp_customize->add_setting('aheadzen_mainshadow_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_mainshadow_color', array(
    'label'        => __( 'Section Title Background Shadow Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_mainshadow_color',
	'priority' => 25, 
  )));
  
  
  $wp_customize->add_setting('aheadzen_buttonbg_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_buttonbg_color', array(
    'label'        => __( 'Button Background Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_buttonbg_color',
	'priority' => 26, 
  )));
  
  $wp_customize->add_setting('aheadzen_buttontext_color', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_buttontext_color', array(
    'label'        => __( 'Button Text Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_buttontext_color',
	'priority' => 27, 
  )));
  
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'aheadzen_footer_heading_color', array(
    'label'        => __( 'Footer Title Color', 'dw-minion' ),
    'section'    => 'aheadzen_custom',
    'settings'   => 'aheadzen_footer_heading_color',
	'priority' => 115, 
  )));

if( ! function_exists('dw_get_gfonts') ) {
function dw_get_gfonts(){
$fontsSeraliazed = wp_remote_fopen( get_template_directory_uri() . '/inc/font/gfonts_v2.txt' );
$fontArray = unserialize( $fontsSeraliazed );
return $fontArray->items;
}
}
  // FONT SELECTOR --------------------------------------------------------------------------------------
  $fonts = dw_get_gfonts();
  $newarray = array();
  $newarray[] = '';
  if($fonts){
	  foreach ($fonts as $index => $font) {
		foreach ($font->files as $key => $value) {
		  $newarray[$font->family . ':dw:' . $value ] = $font->family . ' - ' . $key;
		}
	  }
  }
  $wp_customize->add_section('dw_minion_typo', array(
    'title'    => __('Font Selector', 'dw-minion'),
    'priority' => 111,
  ));
  $wp_customize->add_setting('aheadzen_heading_font', array(
    'default'        => 'Roboto Slab:dw:http://themes.googleusercontent.com/static/fonts/robotoslab/v2/3__ulTNA7unv0UtplybPiqCWcynf_cDxXwCLxiixG1c.ttf',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( 'aheadzen_heading_font', array(
    'settings' => 'aheadzen_heading_font',
    'label'   => __('Select headding font', 'dw-minion'),
    'section' => 'dw_minion_typo',
    'type'    => 'select',
    'choices'    => $newarray
  ));
  $wp_customize->add_setting('aheadzen_body_font', array(
    'default'        => 'Roboto:dw:http://themes.googleusercontent.com/static/fonts/roboto/v9/W5F8_SL0XFawnjxHGsZjJA.ttf',
    'capability'     => 'edit_theme_options',
    'type'           => 'option',
  ));
  $wp_customize->add_control( 'aheadzen_body_font', array(
    'settings' => 'aheadzen_body_font',
    'label'   => __('Select body font', 'dw-minion'),
    'section' => 'dw_minion_typo',
    'type'    => 'select',
    'choices'    => $newarray
  ));


  // CUSTOM CODE --------------------------------------------------------------------------------------
  $wp_customize->add_section('dw_minion_custom_code', array(
    'title'    => __('Custom Code', 'dw-minion'),
    'priority' => 200,
  ));
  $wp_customize->add_setting('aheadzen_header_code', array(
      'default' => '',
      'capability' => 'edit_theme_options',
      'type' => 'option',
  ));
  $wp_customize->add_control( new DW_Minion_Textarea_Custom_Control($wp_customize, 'aheadzen_header_code', array(
    'label'    => __('Header Code (Meta tags, CSS, etc ...)', 'dw-minion'),
    'section'  => 'dw_minion_custom_code',
    'settings' => 'aheadzen_header_code',
  )));
  $wp_customize->add_setting('aheadzen_footer_code', array(
    'default' => '',
    'capability' => 'edit_theme_options',
    'type' => 'option',
  ));
  $wp_customize->add_control( new DW_Minion_Textarea_Custom_Control($wp_customize, 'aheadzen_footer_code', array(
    'label'    => __('Footer Code (Analytics, etc ...)', 'dw-minion'),
    'section'  => 'dw_minion_custom_code',
    'settings' => 'aheadzen_footer_code'
  )));
}
add_action( 'customize_register', 'dw_minion_customize_register' );