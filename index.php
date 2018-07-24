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

$courseid = required_param('id', PARAM_INT);

require_login($courseid);

 // Check if they have permission to VIEW
$context = context_course::instance($courseid);
require_capability('tool/dravek:view',$context);

$url = new moodle_url('/admin/tool/dravek/index.php', array('id' => $courseid));
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_pagelayout('report');
$PAGE->set_title('Hello to the todo list');
$PAGE->set_heading(get_string('pluginname', 'tool_dravek'));

$PAGE->navbar->add(get_string('plugin'), new moodle_url($url));

$users = $DB->get_record_sql('SELECT count(*) as total FROM {user}');
$total = $users->total;

echo $OUTPUT->header();
echo html_writer::div(get_string('helloworld', 'tool_dravek', ['id' => $courseid]));
echo html_writer::div(get_string('testusers', 'tool_dravek', ['total' => $total]));

 //$userinput = 'no <b>tags</b> allowed in strings';
 //$userinput = '<span class="multilang" lang="en">RIGHT</span><span class="multilang" lang="fr">WRONG</span>';
 // $userinput = 'a" onmouseover=”alert(\'XSS\')" asdf="';
 // $userinput = "3>2";
 //$userinput = "2<3"; // Interesting effect, huh?

 //echo html_writer::div(s($userinput)); // Used when you want to escape the value.
 //echo html_writer::div(format_string($userinput)); // Used for one-line strings, such as forum post subject.
 //echo html_writer::div(format_text($userinput)); // Used for multil-line rich-text contents such as forum post body.

$table = new tool_dravek_tooltable($courseid);
$table->show();

echo $OUTPUT->footer();