<?php
/**
 * @package popiplugin
 * @version 1.0.0
 */
/*
 * Plugin Name: POPIA Act Notifier 
 * Plugin URI:  https://popiactplugin.co.za/
 * Description: Simple POPI act  notifier shows viewers that your website is POPIA act compliant. The popia act should be defined in your site's official  T&C policy page . 
 * Version:     1.0.0
 * Author:      Kenneth kaigu
 * Author URI:  https://about.me/kenneth_kaigu
 * Contributors: Heidi Klause
 * License:     GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

function cookies_gdpr_settings_api_init()
{
    // Add the section to reading settings so we can add our
    // fields to it
    add_settings_section(
        'cookies_gdpr_setting_section',
        'Pliki cookies',
        'cookies_gdpr_setting_section_callback_function',
        'general'
    );

    add_settings_field(
        'cookies_gdpr_setting_privacy_policy_link',
        'Adres polityki prywatności',
        'cookies_gdpr_setting_cookies_gdpr_id_callback_function',
        'general',
        'cookies_gdpr_setting_section'
    );

    register_setting('general', 'cookies_gdpr_setting_privacy_policy_link');
}

function cookies_gdpr_enqueue_scripts()
{
    wp_enqueue_script('cookies-gdpr-bar-js', plugins_url('/js/bar.js', __FILE__));
    wp_enqueue_style('cookies-gdpr-bar-css', plugins_url('/css/bar.css', __FILE__));
}

function cookies_gdpr_wp_footer()
{
    $privacyPolicyLink = get_option('cookies_gdpr_setting_privacy_policy_link');

    echo '
    <div id="cookies_gdpr_bar" class="cookies-gdpr-bar" style="display: none">
      <span class="cookies-gdpr-text"> Your privacy is important to us,and that is why we are POPIA compliant to ensure we give you a safe and secure experience on our website.
 <br> 
 By clicking Accept and continuing to use our site, you accept our Privacy Policy and  Terms of Use. </span>
 <br>
      <a class="cookies-gdpr-button cookies-gdpr-accept-button" data-user-action="accept"> Accept & close popup </a>
      
	  <a class="cookies-gdpr-button cookies-gdpr-privacy-policy-button" href="https://www.justice.gov.za/inforeg/about.html" target="_blank" >What is POPIA Act ? </a>
	  
    </div>';
}

function cookies_gdpr_setting_section_callback_function()
{
}

function cookies_gdpr_setting_cookies_gdpr_id_callback_function()
{
    echo '<input name="cookies_gdpr_setting_privacy_policy_link" id="cookies_gdpr_setting_privacy_policy_link" type="text" value="' . get_option('cookies_gdpr_setting_privacy_policy_link') . '" />';
}

add_action('wp_footer', 'cookies_gdpr_wp_footer');
add_action('admin_init', 'cookies_gdpr_settings_api_init');
add_action('wp_enqueue_scripts', 'cookies_gdpr_enqueue_scripts');
