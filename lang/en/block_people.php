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
 * Block "people" - Language pack
 *
 * @package    block_people
 * @copyright  2013 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'People';
$string['participantslist'] = 'Show participants list';
$string['people:addinstance'] = 'Add a new people block';
$string['people:myaddinstance'] = 'Add a new people block to Dashboard';
$string['privacy:metadata'] = 'The people plugin provides extended functionality to Moodle users, but does not store any personal data.';
$string['noparticipantslist'] = 'Viewing the participants list is prohibited in this course';

// Settings.
$string['setting_participantspageheading'] = 'Participants page';
$string['setting_linkparticipantspage'] = 'Show link to the participants page';
$string['setting_linkparticipantspage_desc'] = 'By enabling this setting, a link to the participants page of the course will be shown within the block.';
$string['setting_hideblockheading'] = 'Hiding the block';
$string['setting_hideblock'] = 'Hiding the block';
$string['setting_hideblock_desc'] = 'By enabling this setting, the block can be hidden by users.<br/>
Important notice:<br/>
Disabling this setting will entirely remove the showing / hiding the block menu item. This means, that users cannot hide this block anymore, but on the other hand, blocks that are already hidden cannot be shown anymore, too. If you want to enable this feature, consider using the following function to reset the visibility for all "block_people" instances.';
$string['setting_multipleroles'] = 'Show multiple roles';
$string['setting_multipleroles_desc'] = 'This setting allows you to control if users who have more than one of the roles configured above are listed once or multiple times in this block. If this setting is disabled, users will be only listed with the first role they have according to the global role sort order. If this setting is enabled, users will be listed within each of their roles.';
$string['setting_resetvisibility'] = 'Reset visibility';
$string['setting_resetvisibility_desc'] = 'By enabling this checkbox, the visibility of all existing "block_people" instances will be set to visible (again).<br/>
Please note: <br/>
After saving this option, the database operations for resetting the visibility will be triggered and this checkbox will be unticked again. The next enabling and saving of this feature will trigger the database operations for resetting the visibility again. ';
$string['setting_rolesheading'] = 'Roles';
$string['setting_roles'] = 'Show these roles';
$string['setting_roles_desc'] = 'This setting allows you to control which users appear in this block. Users need to have at least one of these roles in a course to be shown in the block.';

// Notifications.
$string['resetvisibilitysuccess'] = 'Success! All "block_people" instances are visible (again). <br/> The setting "Reset visibility" has been reset.';
$string['resetvisibilityerror'] = 'Oops... Something went wrong updating the database tables... <br/> The setting "Reset visibility" has been reset.';
