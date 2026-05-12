<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Theme functions for NECTA Learn.
 *
 * @package   theme_necta
 * @copyright NECTA Digital Learning
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/theme/boost/lib.php');

/**
 * Main SCSS stack (Boost preset).
 *
 * @param theme_config $theme
 * @return string
 */
function theme_necta_get_main_scss_content($theme) {
    return theme_boost_get_main_scss_content($theme);
}

/**
 * Accent triplet [main, deep, soft] from admin setting (Design Guide §3).
 *
 * @param theme_config $theme
 * @return string[] length 3 hex colours
 */
function theme_necta_get_accent_triplet($theme): array {
    $accent = !empty($theme->settings->accent) ? $theme->settings->accent : 'orange';
    $accents = [
        'orange' => ['#E25C18', '#B84210', '#FFF1E8'],
        'blue' => ['#3D6BE0', '#1F3F8F', '#ECF1FE'],
        'green' => ['#1F8F6B', '#0E5A41', '#E6F4EE'],
        'slate' => ['#3A3A40', '#1A1A1F', '#EFEFF1'],
    ];
    return $accents[$accent] ?? $accents['orange'];
}

/**
 * Pre-SCSS: dynamic Bootstrap primary + theme/pre.scss (imports tokens).
 *
 * @param theme_config $theme
 * @return string
 */
function theme_necta_get_pre_scss($theme) {
    [$main, $deep] = theme_necta_get_accent_triplet($theme);
    $inject = <<<SCSS
\$primary: {$main};
\$link-color: {$main};
\$link-hover-color: {$deep};

SCSS;
    $path = $theme->dir . '/scss/pre.scss';
    return $inject . (is_readable($path) ? file_get_contents($path) : '');
}

/**
 * Extra SCSS: runtime :root accent slots + post.scss (components + layout).
 *
 * @param theme_config $theme
 * @return string
 */
function theme_necta_get_extra_scss($theme) {
    $path = $theme->dir . '/scss/post.scss';
    $post = is_readable($path) ? file_get_contents($path) : '';

    [$main, $deep, $soft] = theme_necta_get_accent_triplet($theme);
    // Appended last so admin accent wins over SCSS defaults (Design Guide §3).
    $accentoverride = <<<CSS
:root {
    --brand-orange: {$main};
    --brand-orange-deep: {$deep};
    --brand-orange-soft: {$soft};
    --brand: var(--brand-orange);
    --brand-deep: var(--brand-orange-deep);
    --brand-soft: var(--brand-orange-soft);
}

CSS;

    return $post . $accentoverride;
}

/**
 * Body classes: density, layout, dark default, optional AI FAB stub.
 *
 * @param theme_config $theme
 * @return string space-separated classes
 */
function theme_necta_body_classes($theme): string {
    $classes = [];
    $density = !empty($theme->settings->density) ? $theme->settings->density : 'regular';
    $classes[] = 'density-' . $density;
    $layout = !empty($theme->settings->layout) ? $theme->settings->layout : 'sidebar';
    $classes[] = 'layout-' . $layout;
    if (!empty($theme->settings->darkmode_default)) {
        $classes[] = 'necta-dark-default';
    }
    return implode(' ', $classes);
}
