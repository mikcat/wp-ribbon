<?php
/*
 * Plugin options page
 */

class WPRIBBONSettingsPage {

  /**
   * Holds the values to be used in the fields callbacks
   */
  private $options;

  /**
   * Start up
   */
  public function __construct() {
    $this->options = get_option('wpribbon-settings');
    add_action('admin_menu', array($this, 'add_plugin_page'));
    add_action('admin_init', array($this, 'page_init'));
  }

  /**
   * Add options page
   */
  public function add_plugin_page() {
    // This page will be under "Settings"
    add_options_page(
        'WP Ribbon Options', 'WP Ribbon', 'manage_options', 'wp-ribbon-admin', array($this, 'create_admin_page')
    );
  }

  /**
   * Options page callback
   */
  public function create_admin_page() {
    // Set class property
    ?>
    <div class="wrap">
      <h1>WP Ribbon Settings</h1>
      <form method="post" action="options.php">
        <?php
        // This prints out all hidden setting fields
        settings_fields('wpribbon-settings-group');
        do_settings_sections('wp-ribbon-admin');
        submit_button();
        ?>
      </form>
    </div>
    <?php
  }

  /**
   * Register and add settings
   */
  public function page_init() {
    register_setting(
        'wpribbon-settings-group', // Option group
        'wpribbon-settings', // Option name
        array('sanitize_callback' => array($this, 'sanitize')) // Sanitize
    );

    add_settings_section(
        'wp_ribbon_config', // ID
        'Settings', // Title
        array($this, 'print_wp_ribbon_config_section_info'), // Callback
        'wp-ribbon-admin' // Page
    );

    add_settings_field(
        'enabled', // ID
        'Enabled', // Title
        array($this, 'checkbox_callback'), // Callback
        'wp-ribbon-admin', // Page
        'wp_ribbon_config', // Section
        array('field_name' => 'enabled', 'field_label' => 'Enabled')
    );

    add_settings_field(
        'link_url', // ID
        'Link Url', // Title
        array($this, 'input_text_callback'), // Callback
        'wp-ribbon-admin', // Page
        'wp_ribbon_config', // Section
        array('field_name' => 'link_url', 'field_type' => 'url')
    );

    add_settings_field(
        'title', // ID
        'Ribbon title', // Title
        array($this, 'input_text_callback'), // Callback
        'wp-ribbon-admin', // Page
        'wp_ribbon_config', // Section
        array('field_name' => 'title', 'field_type' => 'text')
    );

    add_settings_field(
        'fill', // ID
        'Fill color', // Title
        array($this, 'input_text_callback'), // Callback
        'wp-ribbon-admin', // Page
        'wp_ribbon_config', // Section
        array('field_name' => 'fill', 'field_type' => 'text')
    );

    add_settings_field(
        'width', // ID
        'Width', // Title
        array($this, 'input_text_callback'), // Callback
        'wp-ribbon-admin', // Page
        'wp_ribbon_config', // Section
        array('field_name' => 'width', 'field_type' => 'text', 'default' => '150px')
    );

    add_settings_field(
        'height', // ID
        'Height', // Title
        array($this, 'input_text_callback'), // Callback
        'wp-ribbon-admin', // Page
        'wp_ribbon_config', // Section
        array('field_name' => 'height', 'field_type' => 'text', 'default' => '150px')
    );

    add_settings_field(
        'position', // ID
        'Position', // Title
        array($this, 'input_text_callback'), // Callback
        'wp-ribbon-admin', // Page
        'wp_ribbon_config', // Section
        array('field_name' => 'position', 'field_type' => 'text')
    );
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function sanitize($input) {
    $new_input = array();
    if (isset($input['enabled'])) {
      $new_input['enabled'] = 1;
    }
    else {
      $new_input['enabled'] = 0;
    }

    if (isset($input['link_url'])) {
      $new_input['link_url'] = sanitize_text_field($input['link_url']);
    }

    if (isset($input['title'])) {
      $new_input['title'] = sanitize_text_field($input['title']);
    }

    if (isset($input['fill'])) {
      $new_input['fill'] = sanitize_text_field($input['fill']);
    }

    if (isset($input['width'])) {
      $new_input['width'] = sanitize_text_field($input['width']);
    }

    if (isset($input['height'])) {
      $new_input['height'] = sanitize_text_field($input['height']);
    }

    if (isset($input['position'])) {
      $new_input['position'] = sanitize_text_field($input['position']);
    }

    return $new_input;
  }

  public function print_wp_ribbon_config_section_info() {
    print 'Configure ribbon';
  }

  public function checkbox_callback($args) {
    $field_name = $args['field_name'];
    $field_label = $args['field_label'];
    $format = '<label><input type="checkbox" id="%s" name="wpribbon-settings[%s]" value="1" %s> %s</label>';

    printf($format, $field_name, $field_name, $this->options[$field_name] ? 'checked="checked"' : '', $field_label);
  }

  /**
   * Get the settings option array and print one of its values
   */
  public function input_text_callback($args) {
    $field_name = $args['field_name'];
    $field_type = $args['field_type'];
    $default = isset($args['default']) ? $args['default'] : '';
    $format = '<input type="%s" id="%s" name="wpribbon-settings[%s]" value="%s">';
    printf($format, $field_type, $field_name, $field_name, isset($this->options[$field_name]) ? esc_attr($this->options[$field_name]) : $default);
  }

}

if (is_admin()) {
  $WPRIBBONSettingsPage = new WPRIBBONSettingsPage();
}