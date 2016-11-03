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
 * People block edit form.
 *
 * @package    block_people
 * @copyright  2016 Giorgio Riva, University of Milano-Bicocca <giorgio.riva@unimib.it>
 * @copyright  2013 Alexander Bias, University of Ulm <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/blocks/people/lib.php');

class block_people_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        $context = context_course::instance($this->page->course->id);

        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
        // Show instance settings only if override is allowed.
        if (can_override_roles($context)) {
            // Override default roles.
            $mform->addElement('advcheckbox', 'config_overridedefaultroles', '',
                get_string('overridedefaultroles', 'block_people'));
            $mform->setDefault('config_overridedefaultroles', false);
            $mform->addHelpButton('config_overridedefaultroles', 'overridedefaultroles', 'block_people');
            // Overridable roles.
            $availableroles = block_people_get_instance_overridable_roles($context);
            $select = $mform->addElement('select', 'config_instanceroles',
                get_string('instanceroles', 'block_people'), $availableroles);
            $select->setMultiple(true);
            $mform->setDefault('config_instanceroles', explode(',', get_config('block_people', 'defaultroles')));
            $mform->addHelpButton('config_instanceroles', 'instanceroles', 'block_people');
            $mform->disabledIf('config_instanceroles', 'config_overridedefaultroles');
        } else {
            $mform->addElement('static', 'overridenotallowed', '', get_string('overridenotallowed', 'block_people'));
        }
    }
}