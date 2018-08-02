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

class tool_dravek_event_entry_added extends advanced_testcase {

    public function test_add_entry() {
        $this->resetAfterTest(true);
        // Create a course.
        $data = new stdClass();
        $course = $this->getDataGenerator()->create_course($data);
        // Trigger an event
        $event = \tool_dravek\event\entry_added::create(
                array('context' => context_course::instance($course->id),
                        'objectid' => $course->id)
        );

        // Trigger and capture the event.
        $sink = $this->redirectEvents();
        $event->trigger();
        $events = $sink->get_events();
        $event = reset($events);
        // Check that the event data is valid.
        $this->assertInstanceOf('\tool_dravek\event\entry_added', $event);
        $this->assertEquals($course->id, $event->objectid);
        $this->assertDebuggingNotCalled();
        $sink->close();
    }
}