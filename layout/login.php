<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Login layout for theme_necta.
 *
 * @package   theme_necta
 * @copyright NECTA Digital Learning
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../lib.php');

$nectaclasses = array_filter(preg_split('/\s+/', theme_necta_body_classes($PAGE->theme)));
$nectaclasses[] = 'necta-login';
$bodyattributes = $OUTPUT->body_attributes($nectaclasses);

$logourl = false;
$logourlobj = $OUTPUT->get_logo_url();
if ($logourlobj) {
    $logourl = $logourlobj->out(false);
}

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), 'escape' => false]),
    'sitename_full' => format_string($SITE->fullname, true, ['context' => context_course::instance(SITEID), 'escape' => false]),
    'logourl' => $logourl,
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
];

echo $OUTPUT->render_from_template('theme_necta/login', $templatecontext);
