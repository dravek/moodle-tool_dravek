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

global $CFG;

require_once(__DIR__ . '/../../../../config.php');
require_once($CFG->libdir . '/tablelib.php');

/**
 * Class tool_dravek_tooltable
 */
class tool_dravek_tooltable extends table_sql {

    /**
     * tool_dravek_tooltable constructor.
     *
     * @param $courseid
     * @throws coding_exception
     */
    public function __construct($courseid) {
        GLOBAL $PAGE;

        $tablecolumns = array('id', 'courseid', 'name', 'description', 'completed', 'priority', 'timecreated', 'timemodified', 'action');
        $tableheaders = array(
                get_string('id', 'tool_dravek'),
                get_string('courseid', 'tool_dravek'),
                get_string('name', 'tool_dravek'),
                get_string('description', 'tool_dravek'),
                get_string('completed', 'tool_dravek'),
                get_string('priority', 'tool_dravek'),
                get_string('timecreated', 'tool_dravek'),
                get_string('timemodified', 'tool_dravek'),
                get_string('action', 'tool_dravek')
        );

        parent::__construct('uniqueid');
        $this->set_attribute('id', 'tool_dravek_table');

        $this->define_columns($tablecolumns);
        $this->define_headers($tableheaders);
        $this->define_baseurl($PAGE->url);
        $this->setup();
        $this->set_sql('*', "{tool_dravek}", 'courseid = ?', [$courseid]);
    }

    /**
     * col_completed
     * @param $row
     * @return string
     * @throws coding_exception
     */
    protected function col_completed($row) {
        if ($row->completed) {
            return get_string('yes', 'tool_dravek');
        } else {
            return get_string('no', 'tool_dravek');
        }
    }


    /**
     * col_timecreated
     * @param $row
     * @return string
     */
    protected function col_timecreated($row) {
        return userdate($row->timecreated);
    }


    /**
     * col_timemodified
     * @param $row
     * @return string
     */
    protected function col_timemodified($row) {
        return userdate($row->timemodified);
    }


    /**
     * col_name
     * @param $row
     * @return string
     */
    protected function col_name($row) {
        return format_string($row->name);
    }


    /**
     * @param $row
     * @return string
     * @throws coding_exception
     * @throws moodle_exception
     */
    protected function col_action($row) {
        $url = new moodle_url('/admin/tool/dravek/edit.php', array('id' => $row->id));
        $urldelete = new moodle_url('/admin/tool/dravek/index.php', array('delete' => $row->id, 'sesskey' => sesskey()));

        return html_writer::link($url, get_string('edit', 'tool_dravek'), ['title' => get_string('editentrytitle', 'tool_dravek', format_string($row->name))]) .' '. html_writer::link($urldelete, get_string('delete', 'tool_dravek'));
    }


    /**
     * col_timecreated
     * @param $row
     * @return string
     */
    protected function col_description($row) {

        $context = context_course::instance($row->courseid);

        return file_rewrite_pluginfile_urls($row->description, 'pluginfile.php',
                $context->id, 'tool_dravek', 'comments', $row->id);
    }

    /**
     * show
     */
    public function show() {
        $this->out(20, false);
    }
}