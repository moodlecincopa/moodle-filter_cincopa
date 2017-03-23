<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Cincopa filter settings
 *
 * @package    filter
 * @subpackage cincopa
 * @copyright  Cincopa LTD <moodle@cincopa.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    
    $description = new lang_string('description', 'filter_cincopa');
    $settings->add(new admin_setting_heading('defaultsettings', '', $description));

    $settings->add(new admin_setting_configmulticheckbox('filter_cincopa/formats',
            get_string('settingformats', 'filter_cincopa'),
            get_string('settingformats_desc', 'filter_cincopa'),
            array(FORMAT_HTML => 1, FORMAT_MARKDOWN => 1, FORMAT_MOODLE => 1), format_text_menu()));
}
