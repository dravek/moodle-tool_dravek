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

namespace tool_dravek\output;

use renderable;
use templatable;
use renderer_base;

defined('MOODLE_INTERNAL') || die;

class mypage implements renderable, templatable{

    public $courseid;

    public function __construct($courseid) {
        $this->courseid = $courseid;
    }

    public function export_for_template(renderer_base $output) {
        global $USER;
        $data = array();

        ob_start();

        $table = new \tool_dravek_tooltable($this->courseid);
        $table->show();

        $data['table'] = ob_get_clean();

        $context = \context_course::instance($this->courseid);
        $urledit = new \moodle_url('/admin/tool/dravek/edit.php', array('courseid' => $this->courseid));

        if (has_capability('tool/dravek:edit', $context)) {
            $data['new_link'] = $urledit;
            $data['new_text'] = get_string('new', 'tool_dravek');
        }

        $data['user_name'] = $USER->username;

        return $data;
    }
}