=== Code Prettify Syntax Highlighter ===
Contributors: TrueFalse
Donate link: http://www.sooource.net
Tags: code, CSS, highlighter, html, javascript, php, sourcecode, syntax, xhtml
Requires at least: 3.5
Tested up to: 3.5
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Highlighting the code in the post with JavaScript library «google-code-prettify».

== Description ==

English:

This plugin to select blocks of code takes advantage of JavaScript-library 'google-code-prettify'. If it is for his work simply insert frame &lt;pre&gt; tag with class 'prettyprint'.

*** Tip: In order to optimize the use of resources, try to use only one option - 'Automatically replace the tags &lt;pre&gt; to &lt;pre class="prettyprint linenums"&gt; before saving post.'

Russian:

Данный плагин для выделения блоков кода использует возможности JavaScript-библиотеки 'google-code-prettify'. При это для его работы достаточно просто обрамлять вставки тегом &lt;pre&gt; с классом 'prettyprint'.

***Совет: в целях оптимизации потребления ресурсов старайтесь использовать только 1 флажок - 'Автоматически заменять &lt;pre&gt; на &lt;pre class="prettyprint linenums"&gt; перед сохранением записи.'


== Installation ==

1. Unzip files.
2. Upload 'cpsh' to the '/wp-content/plugins/' directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to your 'Writing'.
5. Go to your 'Highlighting code with «google-code-prettify»'.

== Frequently Asked Questions ==

- Syntax highlighting is not working?

Try disabling JQuery in your theme. Or comment the 33rd line of code plugin: wp_enqueue_script ('jquery');

- How do I block a themed code?

Specify the path to an arbitrary CSS file in the plugin settings. Examples of these, see the catalog 'http://example.com/wordpress/wp-content/plugins/cpsh/google-code-prettify/prettify.css'.

== Screenshots ==

1. This frontend.
2. This administration page.
2. This post editing page.

== Changelog ==

= 1.0 =
* The first version of the plugin.

== Upgrade Notice ==

= 1.0 =
Tested in WordPress 3.5.
