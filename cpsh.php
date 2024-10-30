<?php
/*
Plugin Name: Code Prettify Syntax Highlighter
Plugin URI: http://www.sooource.net/code-prettify-syntax-highlighter
Description: This plugin adds the ability to highlight the code in the tags <pre> using "Google-code-prettify" Library.
Version: 1.0
Author: TrueFalse
Author URI: http://www.sooource.net
License: GPLv2 or later
Text Domain: cpsh
Domain Path: /languages
*/

/* Регистрация действий и крючков: */
add_action("wp_enqueue_scripts", "cpsh_enqueue_scripts");
add_action('admin_init', 'cpsh_admin_init');
register_uninstall_hook(__FILE__, 'cpsh_deinstall');

/* Загрузка строк переводов: */
load_plugin_textdomain('cpsh', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');

function cpsh_enqueue_scripts() {
  // Если установлен флажок замены тегов <pre> в цитате и содержимом записи при показе:
  $parameters = get_option('cpsh_options');
  if ($parameters['cpsh_default_style']==1) {
    add_action('the_content', 'cpsh_replace_pre');
    add_action('the_excerpt', 'cpsh_replace_pre');
  }

  // Подключение JQuery и скрипта "Google Code Prettify":
  wp_register_script('google-code-prettify', plugins_url('google-code-prettify/prettify.js', __FILE__));
  wp_register_script('google-code-prettify-init', plugins_url('google-code-prettify/prettify.init.js', __FILE__ ));
  wp_enqueue_script('jquery');
  wp_enqueue_script('google-code-prettify');
  wp_enqueue_script('google-code-prettify-init');

  // Логика подключения файла со стилями "Google Code Prettify":
  if ( empty($parameters['cpsh_style_url']) )
    wp_register_style('google-code-prettify', plugins_url('google-code-prettify/prettify.css', __FILE__));
  else
    wp_register_style('google-code-prettify', $parameters['cpsh_style_url']);
  wp_enqueue_style('google-code-prettify');
}

/* Инициализация: регистрация настроек и обратных вызовов: */
function cpsh_admin_init() {
  // Регистрация настроек плагина:
  add_settings_section('cpsh_settings', __('Highlighting code with «google-code-prettify»:', 'cpsh'), 'cpsh_section_callback', 'writing');
  add_settings_field('cpsh_style-url', __('URL style to highlight the code (<code>&lt;pre&gt;</code>)', 'cpsh'), 'cpsh_style_callback', 'writing', 'cpsh_settings');
  add_settings_field('cpsh_default-style', __('Additional actions', 'cpsh'), 'cpsh_default_style_callback', 'writing', 'cpsh_settings');
  add_settings_field('cpsh_presave-replace', null, 'cpsh_presave_replace_callback', 'writing', 'cpsh_settings');
  register_setting('writing', 'cpsh_options');

  // Если выставлен флажок замены тега <pre> перед сохранением содержимого записи:
  $parameters = get_option('cpsh_options');
  if ($parameters['cpsh_presave_replace']==1)
    add_action('content_save_pre', 'cpsh_replace_pre');
}

/* Замена <pre> на <pre class="prettyprint linenums">: */
function cpsh_replace_pre($content) {
  return str_replace('<pre>', '<pre class="prettyprint linenums">', $content);
}

/* Обратный вызов для секции с настройками плагина: */
function cpsh_section_callback() {
  return;
}

/* Обратный вызов для поля-пути до произвольного стиля темизации "Google Code Prettify": */
function cpsh_style_callback() {
  $parameters = get_option('cpsh_options');
	echo '<input type="text" id="cpsh_style-url" name="cpsh_options[cpsh_style_url]" class="regular-text" value="'.
    $parameters['cpsh_style_url']. '" />';
}

/* Обратный вызов для флажка замены <pre> перед показом содержимого и цитаты записи: */
function cpsh_default_style_callback() {
  $parameters = get_option('cpsh_options');
  echo '<input type="checkbox" id="cpsh_default-style" name="cpsh_options[cpsh_default_style]" value="1" class="code" '.
    checked(1, $parameters['cpsh_default_style'], false) . ' /> '.
    __('Automatically replace the tags <code>&lt;pre&gt;</code> to <code>&lt;pre class="prettyprint linenums"&gt;</code>.', 'cpsh').
    '<p class="description">'.
    __('If you check this box, then a replacement will be going on each output post content on the screen.', 'cpsh'). '</p>';
}

/* Обратный вызов для флажка замены <pre> перед сохранением содержимого записи: */
function cpsh_presave_replace_callback() {
  $parameters = get_option('cpsh_options');
  echo '<input type="checkbox" id="cpsh_presave-replace" name="cpsh_options[cpsh_presave_replace]" value="1" class="code" '.
    checked(1, $parameters['cpsh_presave_replace'], false) . ' /> '.
    __('Automatically replace the tags <code>&lt;pre&gt;</code> to <code>&lt;pre class="prettyprint linenums"&gt;</code> before saving post.', 'cpsh');
}

/* Деинсталляция плагина: */
function cpsh_deinstall() {
  delete_option('cpsh_options');
}

?>