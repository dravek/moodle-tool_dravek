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

class tool_dravek_db_tests extends advanced_testcase {

    public function test_insert_and_get() {
        $this->resetAfterTest(true);

        $data = (object)[
            'name' => 'Test Name',
            'completed' => 0,
            'priority' => 0,
            'courseid' => 2
        ];

        $id = tool_dravek_db::insert($data);

        $record = tool_dravek_db::get($id);
        $this->assertEquals('Test Name', $record->name);
        $this->assertEquals('0', $record->completed);
        $this->assertEquals('2', $record->courseid);
    }
}