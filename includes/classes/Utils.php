<?php

namespace PolyPlugins\Speedy_Search;

class Utils {

  /**
   * Get speedy search options
   *
   * @return array $options The speedy search options
   */
  public static function get_options() {
    $options = get_option('speedy_search_settings_polyplugins');

    return $options;
  }
  
  /**
   * Get speedy search option from options array
   *
   * @param  string $option The option to retrieve from options
   * @return mixed  $option The retrieved option value
   */
  public static function get_option($option) {
    $options = self::get_options();
    $option  = isset($options[$option]) ? $options[$option] : false;

    return $option;
  }
  
  /**
   * Update an option
   *
   * @param  string $option The option name
   * @param  mixed  $value  The option value
   * @return void
   */
  public static function update_option($option, $value) {
    $options          = self::get_options();
    $options[$option] = $value;

    update_option('speedy_search_settings_polyplugins', $options);
  }

  /**
   * Get speedy search indexes
   *
   * @return array $options The speedy search indexes options
   */
  public static function get_indexes() {
    $options = get_option('speedy_search_indexes_polyplugins');

    return $options ? $options : array();
  }
  
  /**
   * Get speedy search index from options array
   *
   * @param  string $option The option to retrieve from options
   * @return mixed  $option The retrieved option value
   */
  public static function get_index($option) {
    $options = self::get_indexes();
    $option  = isset($options[$option]) ? $options[$option] : false;

    return $option;
  }
  
  /**
   * Update an index
   *
   * @param  string $index  The index name
   * @param  string $option The option name
   * @param  mixed  $value  The option value
   * @return void
   */
  public static function update_index($index, $option, $value) {
    $options                  = self::get_indexes();
    $options[$index][$option] = $value;

    update_option('speedy_search_indexes_polyplugins', $options);
  }
  
  /**
   * Checks for any missing extensions
   *
   * @return mixed $is_missing_extension Array of missing extensions or false
   */
  public static function is_missing_extensions() {
    $missing_extensions = array();

    $extensions = array(
      'pdo_sqlite',
      'PDO',
      'mbstring'
    );

    foreach ($extensions as $extension) {
      if (!extension_loaded($extension)) {
        $missing_extensions[] = $extension;
      }
    }

    $is_missing_extensions = $missing_extensions ? $missing_extensions : false;

    return $is_missing_extensions;
  }

  /**
   * Convert Hex color to RGBA
   *
   * @param  mixed $hex
   * @param  mixed $alpha
   * @return void
   */
  public static function hex_to_rgba($hex, $alpha = null) {
    // Remove the '#' if present
    $hex = ltrim($hex, '#');
    
    // Get the red, green, and blue values
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // If alpha is provided, return rgba format, otherwise return rgb
    if ($alpha !== null) {
      if ($alpha > 1) {
        $alpha = $alpha / 100; // Convert percentage to decimal
      }

      return "rgba($r, $g, $b, $alpha)";
    } else {
      return "rgb($r, $g, $b)";
    }
  }

}