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

class tool_dravek_db {

    /**
     * get record
     * @param $id
     * @return mixed
     * @throws dml_exception
     */
    public static function get($id) {
        global $DB;

        return $DB->get_record('tool_dravek', ['id' => $id], '*', MUST_EXIST);
    }

    /**
     * update record
     * @param $data
     * @throws dml_exception
     */
    public static function update($data) {
        global $DB;

        $DB->update_record('tool_dravek', [
                'id' => $data->id,
                'name' => $data->name,
                'completed' => $data->completed,
                'timemodified' => time()
        ], false);
    }

    /**
     * insert record
     * @param $data
     * @return bool|int
     * @throws dml_exception
     */
    public static function insert($data) {
        global $DB;

        return $DB->insert_record('tool_dravek', [
                'courseid' => $data->courseid,
                'name' => $data->name,
                'completed' => $data->completed,
                'timecreated' => time(),
                'timemodified' => time()
        ], true);
    }

    /**
     * delete record
     * @param $id
     * @throws dml_exception
     */
    public static function delete($id) {
        global $DB;

        $DB->delete_records('tool_dravek', ['id' => $id]);
    }
}