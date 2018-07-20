<?php

defined('MOODLE_INTERNAL') || die;

function tool_dravek_extend_navigation_course($navigation, $course, $context)
{
    global $PAGE;
    $courseid = $PAGE->course->id;

    $navigation->add(
        get_string('pluginname', 'tool_dravek'),
        new moodle_url('/admin/tool/dravek/index.php?', array('id'=>$courseid)),
        navigation_node::TYPE_SETTING,
        get_string('pluginname', 'tool_dravek'),
        'todolist');
}