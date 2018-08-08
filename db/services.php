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

// We defined the web service functions to install.
$functions = array(
        'tool_dravek_delete_entry' => array(
                'classname'   => 'tool_dravek_external',
                'methodname'  => 'delete_entry',
                'description' => 'Deletes an entry',
                'type'        => 'write',
                'ajax'        => 'true',
                'capabilities' => 'tool_dravek:edit'
        ),
        'tool_dravek_reload_template' => array(
                'classname'   => 'tool_dravek_external',
                'methodname'  => 'reload_template',
                'description' => 'Reloads template',
                'type'        => 'read',
                'ajax'        => 'true',
                'capabilities' => 'tool_dravek:view'
        )
);
// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'tool_dravek services' => array(
                'functions' => array ('tool_dravek_delete_entry', 'tool_dravek_reload_template'),
                'restrictedusers' => 0,
                'enabled' => 1,
        )
);