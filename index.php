<?php
require_once(__DIR__ . '/../../../config.php');

$courseid = required_param('id', PARAM_INT);

$url = new moodle_url('/admin/tool/dravek/index.php',array('id'=>$courseid));
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_pagelayout('report');
$PAGE->set_title('Hello to the todo list');
$PAGE->set_heading(get_string('pluginname', 'tool_dravek'));

$PAGE->navbar->add(get_string('plugin'), new moodle_url($url));
//$coursenode = $PAGE->navigation->find($courseid, navigation_node::TYPE_COURSE);
//$thingnode = $coursenode->add('Name of thing', new moodle_url('/a/link/if/you/want/one.php'));
//$thingnode->make_active();


echo $OUTPUT->header();

echo html_writer::span(get_string('helloworld', 'tool_dravek', ['id' => $courseid]));

echo $OUTPUT->footer();