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
 * @package   tool_dravek
 * @copyright 2018, David <davidmc@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . "/externallib.php");

class tool_dravek_external extends external_api {

    public static function delete_entry_parameters() {
        return new external_function_parameters(
                array('id' => new external_value(PARAM_INT, 'Entry ID to delete', VALUE_REQUIRED),
                        'courseid' => new external_value(PARAM_INT, 'Course ID to check capablity', VALUE_REQUIRED))
        );
    }

    public static function delete_entry($id, $courseid) {
        $context = context_course::instance($courseid);
        require_capability('tool/dravek:edit', $context);
        tool_dravek_db::delete($id);
    }

    public static function delete_entry_returns() {
    }

    public static function reload_template_parameters() {
        return new external_function_parameters(
                array('courseid' => new external_value(PARAM_INT, 'Course ID', VALUE_REQUIRED))
        );
    }

    public static function reload_template($courseid) {
        global $PAGE;
        require_login($courseid);

        $output = $PAGE->get_renderer('tool_dravek');
        $outputpage = new \tool_dravek\output\mypage($courseid);
        return $outputpage->export_for_template($output);
    }

    public static function reload_template_returns() {
        return new external_single_structure(
                array(
                        'table' => new external_value(PARAM_RAW, 'table'),
                        'new_link' => new external_value(PARAM_URL, 'new link'),
                        'new_text' => new external_value(PARAM_NOTAGS, 'new text'),
                        'user_name' => new external_value(PARAM_NOTAGS, 'user name'),
                )
        );
    }
}