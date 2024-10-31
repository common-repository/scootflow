<?php
/*
Plugin Name: Scootflow
Plugin URI: https://wordpress.org/plugins/scootflow
Description: Officiele <a href="https://www.scootflow.com">Scootflow</a> plugin. Voeg de Scootflow widget toe aan je website.
Author: Scootflow B.V.
Author URI: https://www.scootflow.com
Version: 1.0.2
*/

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_menu', 'scootflow_widget_actions');
add_action('wp_footer', 'scootflow_attach_widget');

function scootflow_settings()
{
    include('scootflow_settings.php');
}

function scootflow_widget_actions()
{
    add_options_page("Scootflow", "Scootflow", "manage_options", "Scootflow", "scootflow_settings");
}

function scootflow_attach_widget()
{
    if (get_option('sf_companyId')) {
        wp_enqueue_style('injector-css', 'https://injector.scootflow.com/index.css');
        wp_enqueue_script('injector-js', 'https://injector.scootflow.com/index.js', [], null, true);
        echo scootflow_widget_script();
    }
}

function scootflow_widget_script()
{
    return '<script>
             document.addEventListener(\'DOMContentLoaded\', function () {
                 window.Scootflow.initWidget(\'' . get_option('sf_companyId') . '\')
             });
            </script>' . PHP_EOL;
}
