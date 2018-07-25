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
require_once($CFG->libdir . '/formslib.php');

class tool_dravek_toolform extends moodleform {

    public function definition() {

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('text', 'name', get_string('name', 'tool_dravek'));
        $mform->setType('name',PARAM_NOTAGS);

        $mform->addElement('advcheckbox', 'completed', get_string('completed', 'tool_dravek'), '', array('group' => 1), array(0, 1));

        $mform->addElement('hidden', 'courseid');
        $mform->setType('courseid',PARAM_INT);

        if (!empty($this->_customdata['id'])) {

            $mform->addElement('hidden', 'id');
            $mform->setType('id',PARAM_INT);

            $this->add_action_buttons(true, get_string('modify', 'tool_dravek'));
        }else{
            $this->add_action_buttons(true, get_string('add', 'tool_dravek'));
        }
    }

    // Perform some extra moodle validation
    function validation($data, $files) {
        global $DB;

        $errors= array();

        if (!empty($this->_customdata['id'])) {
            if( $DB->record_exists_select('tool_dravek', 'name = ? AND courseid = ? AND id <> ?', array($data['name'], $data['courseid'], $data['id']) )) {
                $errors['name'] = get_string('formcheckname', 'tool_dravek');
            }
        } else {
            if( $DB->record_exists_select('tool_dravek', 'name = ? AND courseid = ?', array($data['name'], $data['courseid']) )) {
                $errors['name'] = get_string('formcheckname', 'tool_dravek');
            }
        }

        return $errors;
    }
}