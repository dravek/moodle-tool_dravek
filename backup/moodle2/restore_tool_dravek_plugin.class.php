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

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/backup/moodle2/restore_tool_plugin.class.php');

class restore_tool_dravek_plugin extends restore_tool_plugin {
    protected $tool_dravek;

    protected function define_course_plugin_structure() {
        $paths = array();
        $paths[] = new restore_path_element('tool_dravek', '/course/tool_dravek');
        return $paths;
    }

    public function process_tool_dravek($data) {
        global $DB;
        $data = (object) $data;
        // Store the old id.
        $oldid = $data->id;
        // Change the values before we insert it.
        $data->courseid = $this->task->get_courseid();
        $data->timecreated = time();
        $data->timemodified = $data->timecreated;
        // Now we can insert the new record.
        $data->id = $DB->insert_record('tool_dravek', $data);
        // Add the array of tools we need to process later.
        $this->tool_dravek[$data->id] = $data;
        // Set up the mapping.
        $this->set_mapping('tool_dravek', $oldid, $data->id);

        $this->add_related_files('tool_dravek', 'comments', null);
    }
}