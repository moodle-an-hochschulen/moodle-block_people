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
 * People block settings.
 *
 * @package    block_people
 * @copyright  2016 Giorgio Riva, University of Milano-Bicocca <giorgio.riva@unimib.it>
 * @copyright  2013 Alexander Bias, University of Ulm <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/blocks/people/lib.php');

if ($ADMIN->fulltree) {

    // Override global course contact setting (Site Administration -> Appearance -> Courses -> coursecontact).
    $name = 'block_people/overridecoursecontact';
    $title = get_string('overridecoursecontact', 'block_people');
    $description = get_string('overridecoursecontact_help', 'block_people');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settings->add($setting);

    // Default selected roles.
    $name = 'block_people/defaultroles';
    $title = get_string('defaultroles', 'block_people');
    $description = get_string('defaultroles_help', 'block_people');
    $roles = block_people_get_course_assignable_roles();
    $default = explode(',', $CFG->coursecontact);
    $setting = new admin_setting_configmultiselect($name, $title, $description, $default, $roles);
    $settings->add($setting);

    // Allow instance override of default selected roles.
    $name = 'block_people/allowinstanceoverride';
    $title = get_string('allowinstanceoverride', 'block_people');
    $description = get_string('allowinstanceoverride_help', 'block_people');
    $default = false;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settings->add($setting);

    // Overridable roles.
    $name = 'block_people/overridableroles';
    $title = get_string('overridableroles', 'block_people');
    $description = get_string('overridableroles_help', 'block_people');
    $roles = block_people_get_course_assignable_roles();
    $default = explode(',', $CFG->coursecontact);
    $setting = new admin_setting_configmultiselect($name, $title, $description, $default, $roles);
    $settings->add($setting);

}

