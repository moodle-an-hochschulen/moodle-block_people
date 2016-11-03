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
 * @copyright  2013 Alexander Bias, University of Ulm <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'People';
$string['participantslist'] = 'Show participants list';
$string['people:addinstance'] = 'Add a new people block';
$string['people:myaddinstance'] = 'Add a new people block to Dashboard';
$string['people:overrideglobalsettings'] = 'Override global plugin settings';
$string['noparticipantslist'] = 'Viewing the participants list is prohibited in this course';

// Settings.
$string['overridecoursecontact'] = 'Override course contacts';
$string['overridecoursecontact_help'] = 'Override global core setting coursecontact with a different roles list.';
$string['defaultroles'] = 'Default listed roles';
$string['defaultroles_help'] = 'List of roles to be shown by default in the block when course contact override is enabled.';
$string['allowinstanceoverride'] = 'Allow instance override';
$string['allowinstanceoverride_help'] = 'Allow override of default settings in block instances';
$string['overridableroles'] = 'Available roles for instance override';
$string['overridableroles_help'] = 'List of available roles in block instance\'s settings when local override is allowed.';

$string['overridedefaultroles'] = 'Override default roles';
$string['overridedefaultroles_help'] = 'List of available roles in block instance\'s settings when local override is allowed.';
$string['instanceroles'] = 'Overridedefaultroles';
$string['instanceroles_help'] = 'List of available roles in block instance\'s settings when local override is allowed.';

$string['overridenotallowed'] = 'Instance override of default settings is not allowed';
