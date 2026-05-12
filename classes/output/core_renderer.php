<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * NECTA theme core renderer (Google Fonts in &lt;head&gt;, Design Guide §2).
 *
 * @package   theme_necta
 * @copyright NECTA Digital Learning
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_necta\output;

use html_writer;

defined('MOODLE_INTERNAL') || die();

/**
 * Core renderer extending Boost.
 */
class core_renderer extends \theme_boost\output\core_renderer {

    /**
     * Use admin-uploaded logo when set; otherwise fall back to theme pix/logo (Design Guide §1).
     *
     * @param int|null $maxwidth
     * @param int $maxheight
     * @return \moodle_url|false
     */
    public function get_logo_url($maxwidth = null, $maxheight = 200) {
        $url = parent::get_logo_url($maxwidth, $maxheight);
        if ($url) {
            return $url;
        }
        try {
            return $this->image_url('logo', 'theme');
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Same fallback as {@see get_logo_url()} for compact contexts.
     *
     * @param int $maxwidth
     * @param int $maxheight
     * @return \moodle_url|false
     */
    public function get_compact_logo_url($maxwidth = 300, $maxheight = 300) {
        $url = parent::get_compact_logo_url($maxwidth, $maxheight);
        if ($url) {
            return $url;
        }
        try {
            return $this->image_url('logo', 'theme');
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Prepend Google Fonts (Inter Tight, Fraunces, JetBrains Mono) before standard head output.
     *
     * @return string
     */
    public function standard_head_html() {
        $out = '';
        $out .= html_writer::empty_tag('link', [
            'rel' => 'preconnect',
            'href' => 'https://fonts.googleapis.com',
        ]) . "\n";
        $out .= html_writer::empty_tag('link', [
            'rel' => 'preconnect',
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ]) . "\n";
        $fonturl = 'https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600&family=Fraunces:wght@400;500&family=JetBrains+Mono:wght@400;500&display=swap';
        $out .= html_writer::empty_tag('link', [
            'rel' => 'stylesheet',
            'href' => $fonturl,
        ]) . "\n";

        return $out . parent::standard_head_html();
    }
}
