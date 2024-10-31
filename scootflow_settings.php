<?php

if (!defined('ABSPATH')) {
    exit;
}

if (isset($_POST['scootflow_hidden'], $_POST['_wpnonce']) && $_POST['scootflow_hidden'] === 'Y' && wp_verify_nonce($_POST['_wpnonce'], 'update-scootflow-settings')) {

    // Check permissions for current user
    if (!current_user_can('manage_options')) {
        wp_die(__('Je hebt onvoldoende rechten om de Scootflow instellingen voor deze website aan te passen.'));
    }

    // Settings form properties
    $sf_companyId = sanitize_text_field($_POST['sf_companyId']);
    update_option('sf_companyId', $sf_companyId);

    ?>

    <div class="updated"><p><strong><?php _e('Instellingen opgeslagen.', 'scootflow'); ?></strong></p></div>

    <?php
} else {
    // Display (current) settings
    $sf_companyId = esc_html(get_option('sf_companyId'));
}
?>

<div class="wrap">
    <div class="logo" style="padding:20px 0">
        <img src="<?php echo esc_html(plugin_dir_url( __FILE__ ) . 'assets/logo.svg'); ?>" alt="Scootflow logo" style="width:180px"/>
    </div>
    <form name="scootflow" method="post" action="<?php echo esc_html(str_replace('%7E', '~', $_SERVER['REQUEST_URI'])); ?>">
        <input type="hidden" name="scootflow_hidden" value="Y">
        <?php wp_nonce_field('update-scootflow-settings'); ?>
        <?php echo "<h2>" . _e('Instellingen', 'scootflow') . "</h2>"; ?>
        <p>
            Om de widget te activeren moet je jouw unieke bedrijfscode invoeren.
            Je kunt deze vinden in jouw <a target="_blank" href="https://workspace.scootflow.com/">Scootflow workspace</a> onder <b>Instellingen</b> -> <b>Widget</b>.<br/>
            Lukt het niet? Stuur een e-mail naar <a href="mailto:support@scootflow.nl">support@scootflow.nl</a>. We helpen je graag.
        </p>
        <table>
            <tr>
                <td><span><?php _e('Unieke bedrijfscode: ', 'scootflow'); ?></span></td>
                <td><input placeholder="Bijvoorbeeld: afab2592-b254-4b1a-9c15-37bd73e6d33f" type="text" name="sf_companyId" value="<?php echo esc_html($sf_companyId); ?>"
                           size="32"></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Opslaan', 'scootflow') ?>"/>
        </p>
    </form>
</div>
