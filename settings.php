<?php
// =============================================================
// NECTA Learn — settings.php
// Admin panel: Site Admin → Appearance → NECTA
// Settings: accent, density, layout, darkmode_default, AI FAB stub (Guide §5.8)
// =============================================================
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs('theme_necta', get_string('configtitle', 'theme_necta'));
    $page = new admin_settingpage('theme_necta_general', get_string('generalsettings', 'theme_necta'));

    // ----------------------------------------------------------
    // 1. Accent colour
    // ----------------------------------------------------------
    $name        = 'theme_necta/accent';
    $title       = get_string('accent', 'theme_necta');
    $description = get_string('accent_desc', 'theme_necta');
    $choices = [
        'orange' => get_string('accent_orange', 'theme_necta'),
        'blue'   => get_string('accent_blue',   'theme_necta'),
        'green'  => get_string('accent_green',  'theme_necta'),
        'slate'  => get_string('accent_slate',  'theme_necta'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, 'orange', $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // ----------------------------------------------------------
    // 2. Density
    // ----------------------------------------------------------
    $name        = 'theme_necta/density';
    $title       = get_string('density', 'theme_necta');
    $description = get_string('density_desc', 'theme_necta');
    $choices = [
        'compact' => get_string('density_compact', 'theme_necta'),
        'regular' => get_string('density_regular', 'theme_necta'),
        'comfy'   => get_string('density_comfy',   'theme_necta'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, 'regular', $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // ----------------------------------------------------------
    // 3. Layout
    // ----------------------------------------------------------
    $name        = 'theme_necta/layout';
    $title       = get_string('layout', 'theme_necta');
    $description = get_string('layout_desc', 'theme_necta');
    $choices = [
        'sidebar' => get_string('layout_sidebar', 'theme_necta'),
        'topbar'  => get_string('layout_topbar',  'theme_necta'),
    ];
    $setting = new admin_setting_configselect($name, $title, $description, 'sidebar', $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // ----------------------------------------------------------
    // 4. Dark mode default
    // ----------------------------------------------------------
    $name        = 'theme_necta/darkmode_default';
    $title       = get_string('darkmode_default', 'theme_necta');
    $description = get_string('darkmode_default_desc', 'theme_necta');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // ----------------------------------------------------------
    // 5. AI Study Helper FAB (stub only for v1)
    // ----------------------------------------------------------
    $name = 'theme_necta/ai_fab_enabled';
    $title = get_string('ai_fab_enabled', 'theme_necta');
    $description = get_string('ai_fab_enabled_desc', 'theme_necta');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
