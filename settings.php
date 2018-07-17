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
 * Block "People" - Settings
 *
 * @package    block_people
 * @copyright  2017 Kathrin Osswald, Ulm University <kathrin.osswald@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    global $CFG;
    // Locallib for updatedcallback function.
    require_once($CFG->dirroot.'/blocks/people/locallib.php');

    // Settings title to group role related settings together with a common heading. We don't want a description here.
    $name = 'block_people/rolesheading';
    $title = get_string('setting_rolesheading', 'block_people', null, true);
    $setting = new admin_setting_heading($name, $title, null);
    $settings->add($setting);

    // Setting to configure the roles to be shown within the block.
    $name = 'block_people/roles';
    $title = get_string('setting_roles', 'block_people', null, true);
    $description = get_string('setting_roles_desc', 'block_people', null, true);
    $default = array('editingteacher');
    $settings->add(new admin_setting_pickroles($name, $title, $description, $default));

    // Setting to show multiple roles within the block.
    $name = 'block_people/multipleroles';
    $title = get_string('setting_multipleroles', 'block_people', null, true);
    $description = get_string('setting_multipleroles_desc', 'block_people', null, true);
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, 0));

    // Settings title to group partictpants page related settings together with a common heading. We don't want a description here.
    $name = 'block_people/participantspageheading';
    $title = get_string('setting_participantspageheading', 'block_people', null, true);
    $setting = new admin_setting_heading($name, $title, null);
    $settings->add($setting);

    // Setting to show link to the participants page within the block.
    $name = 'block_people/linkparticipantspage';
    $title = get_string('setting_linkparticipantspage', 'block_people', null, true);
    $description = get_string('setting_linkparticipantspage_desc', 'block_people', null, true);
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, 1));

    // Settings title to group hiding the block related settings together with a common heading. We don't want a description here.
    $name = 'block_people/hideblockheading';
    $title = get_string('setting_hideblockheading', 'block_people', null, true);
    $setting = new admin_setting_heading($name, $title, null);
    $settings->add($setting);

    // Setting to disable the possibility to hide the block.
    $name = 'block_people/hideblock';
    $title = get_string('setting_hideblock', 'block_people', null, true);
    $description = get_string('setting_hideblock_desc', 'block_people', null, true);
    $settings->add(new admin_setting_configcheckbox($name, $title, $description, 1));

    // Setting to make all people blocks visible again.
    $name = 'block_people/resetvisibility';
    $title = get_string('setting_resetvisibility', 'block_people', null, true);
    $description = get_string('setting_resetvisibility_desc', 'block_people', null, true);
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('block_people_reset_visibility');
    $settings->add($setting);
}

