<?php

settings_errors();
// Get Plugin Version Information
$base_nam       = plugin_dir_path( dirname( __FILE__ ) );
$filpath        = str_replace( "\\", "/", $base_nam );
$plugin_data    = get_plugin_data( $filpath . 'essential-premium-addons-for-elementor.php' );
$plugin_version = $plugin_data['Version'];

?>

<div id="pev-wrap">
    <div id="pev-desc-main">
        <h3 id="pev-title">Essential Premium Addons API Section</h3>
        <p>Essential Premium Addons For Elementor has module basis structure. You can easily activate/deactivate any Essential Premium Addons as your needs anytime. When you updated plugin, you can check this page and activate new
            modules.</p>

        <p>All Essential Premium Addons Activate By Default, You Should Deactivate Essential Premium Addons Which One you like, You may deactivate/activate All Essential Premium Addons By Clicking Enable/Disable Button.</p>
    </div>
    <div class="wfe-logo-img"><span>Version <?php echo $plugin_version; ?></span></div>

    <div class="epa_mapsAPi_wrapper">
        <form method="post" action="options.php">
		    <?php
		    settings_fields( 'epa_api_ogroup' );
		    do_settings_sections( 'epa_api_oname' );
		    submit_button();
		    ?>
        </form>
    </div>
</div>