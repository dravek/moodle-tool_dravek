<?php
require_once(__DIR__ . '/../../../config.php');
$url = new moodle_url('/admin/tool/dravek/index.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_pagelayout('report');
$PAGE->set_title('Hello to the todo list');
$PAGE->set_heading(get_string('pluginname', 'tool_dravek'));



echo $OUTPUT->header();

echo html_writer::span(get_string('helloworld', 'tool_dravek', ['id' => 1]));

echo $OUTPUT->footer();