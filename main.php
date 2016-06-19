<?php
/*
Plugin Name: Aimportimagefrom bd to wp
Plugin URI: http://страница_с_описанием_плагина_и_его_обновлений
Description: Краткое описание плагина.
Version: Номер версии плагина, например: 1.0
Author: Sam
Author URI: http://страница_автора_плагина
*/
   


   /*  Copyright ГОД  ИМЯ_АВТОРА_ПЛАГИНА  (email: E-MAIL_АВТОРА)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!defined('WP_CONTENT_URL'))
	define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if(!defined('WP_CONTENT_DIR'))
	define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if(!defined('WP_PLUGIN_URL'))
	define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
if(!defined('WP_PLUGIN_DIR'))
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');

// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages');

// action function for above hook
function mt_add_pages() {
    // Add a new submenu under Options:
    add_options_page('Test Options', 'Test Options', 8, 'testoptions', 'mt_options_page');

    // Add a new submenu under Manage:
    add_management_page('Test Manage', 'Test Manage', 8, 'testmanage', 'mt_manage_page');

    // Add a new top-level menu (ill-advised):
    add_menu_page('Test Toplevel', 'Test Toplevel', 8, __FILE__, 'mt_toplevel_page');

    // Add a submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'Test Sublevel', 'Test Sublevel', 8, 'sub-page', 'mt_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page(__FILE__, 'Test Sublevel 2', 'Test Sublevel 2', 8, 'sub-page2', 'mt_sublevel_page2');
}

// mt_options_page() displays the page content for the Test Options submenu
/*function mt_options_page() {
    echo "<h2>Test Options</h2>";
}*/

// mt_manage_page() displays the page content for the Test Manage submenu
function mt_manage_page() {
    echo "<h2>Test Manage</h2>";
}

// mt_toplevel_page() displays the page content for the custom Test Toplevel menu
function mt_toplevel_page() {
    echo "<h2>Test Toplevel</h2>";

}

// mt_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function mt_sublevel_page() {
    echo "<h2>Test Sublevel</h2>";
      include_once 'pages/t.php';

      
}

// mt_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function mt_sublevel_page2() {
    echo "<h2>Test Sublevel 2</h2>";
    include_once 'pages/t2.php';
}
?>