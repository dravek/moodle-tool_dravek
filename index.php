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

require_once(__DIR__ . '/../../../config.php');

global $DB;

if ($deleteid = optional_param('delete', null, PARAM_INT)) {
    require_sesskey();
    $record = tool_dravek_db::get($deleteid);
    require_login(get_course($record->courseid));
    require_capability('tool/dravek:edit', context_course::instance($record->courseid));
    tool_dravek_db::delete($deleteid);
    redirect(new moodle_url('/admin/tool/dravek/index.php', ['id' => $record->courseid]));
}

$courseid = required_param('id', PARAM_INT);

require_login($courseid);

// $PAGE->requires->js_call_amd('tool_dravek/form', 'init', array('confirmdelete' => get_string('confirmdelete', 'tool_dravek')));

 // Check if they have permission to VIEW.
$context = context_course::instance($courseid);
require_capability('tool/dravek:view', $context);

$url = new moodle_url('/admin/tool/dravek/index.php', array('id' => $courseid));

$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_pagelayout('report');
$PAGE->set_title('Hello to the todo list');
$PAGE->set_heading(get_string('pluginname', 'tool_dravek'));
$PAGE->navbar->add(get_string('home'), new moodle_url($url));

$output = $PAGE->get_renderer('tool_dravek');
$outputpage = new \tool_dravek\output\mypage($courseid);

echo $output->header();
echo $output->render($outputpage);
echo $output->footer();