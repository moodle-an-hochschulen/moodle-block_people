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
 * People block lib.
 *
 * @package    block_people
 * @copyright  2016 Giorgio Riva, University of Milano-Bicocca <giorgio.riva@unimib.it>
 * @copyright  2013 Alexander Bias, University of Ulm <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

define('BLOCK_PEOPLE_SHOW_NOTHING', 0);
define('BLOCK_PEOPLE_SHOW_COURSE_CONTACT', 1);
define('BLOCK_PEOPLE_SHOW_DEFAULT_ROLES', 2);
define('BLOCK_PEOPLE_SHOW_INSTANCE_ROLES', 3);

/**
 * Get the list of assignable roles in course context
 *
 * @param null $context
 * @return array
 */
function block_people_get_course_assignable_roles($context = null) {
    global $DB;
    // Get roles assignables in course context.
    $courseroles = get_roles_for_contextlevels(CONTEXT_COURSE);
    $courseroles = $DB->get_records_list('role', 'id', $courseroles, 'sortorder ASC');
    // Get localized role names.
    $assignableroles = role_fix_names($courseroles, $context, ROLENAME_ALIAS, true);

    return $assignableroles;
}

/**
 * Get the list of available roles for instance override
 *
 * @param null $context
 * @return array
 */
function block_people_get_instance_overridable_roles($context = null) {
    // Get the available roles from global config.
    $availableroles = array_flip(explode(',', get_config('block_people', 'overridableroles')));
    // Get the assignable roles.
    $roles = block_people_get_course_assignable_roles($context);

    $availableroles = array_intersect_key($roles, $availableroles);

    return $availableroles;
}

/**
 * Check if current user can override roles
 *
 * @param $context
 * @return bool
 */
function can_override_roles($context) {
    // Override core setting is disables, so noone can override roles.
    if (!get_config('block_people', 'overridecoursecontact')) {
        return false;
    }
    // Override core setting is enabled but instance override is not allowed, so noone can override roles.
    if (get_config('block_people', 'overridecoursecontact') &&
            !get_config('block_people', 'allowinstanceoverride')) {
        return false;
    }
    // Override core setting is enabled and instance override is allowed,
    // so only users with overrideglobalsettings capability can override global settings.
    if (get_config('block_people', 'overridecoursecontact') &&
            get_config('block_people', 'allowinstanceoverride') &&
            has_capability('block/people:overrideglobalsettings', $context)) {
        return true;
    }
    // Default return.
    return false;
}

/**
 * According to settings, get the type of visualization to use
 *
 * @param block_people $instance Current block instance
 * @return int Type of visualization
 */
function block_people_get_roles_visualization(block_people $instance) {
    // Get settings.
    $overridecoursecontact = get_config('block_people', 'overridecoursecontact');
    $allowinstanceoverride = get_config('block_people', 'allowinstanceoverride');
    $instanceoverride = isset($instance->config->overridedefaultroles) ? $instance->config->overridedefaultroles : false;
    // If overridecoursecontact is false then we use course contact as roles.
    if (!$overridecoursecontact) {
        return BLOCK_PEOPLE_SHOW_COURSE_CONTACT;
    }
    // If overridecoursecontact and instance override is not allowed, we use default.
    if ($overridecoursecontact && !$allowinstanceoverride) {
        return BLOCK_PEOPLE_SHOW_DEFAULT_ROLES;
    }
    // If overridecoursecontact and instance override is not allowed, we use default.
    if ($overridecoursecontact && $allowinstanceoverride && !$instanceoverride) {
        return BLOCK_PEOPLE_SHOW_DEFAULT_ROLES;
    }
    // If all is active, we use instance roles.
    if ($overridecoursecontact && $allowinstanceoverride && $instanceoverride) {
        return BLOCK_PEOPLE_SHOW_INSTANCE_ROLES;
    }
    // If code reach this line, something is wrong and then nothing is shown.
    return BLOCK_PEOPLE_SHOW_NOTHING;
}

/**
 * Get roles to be shown in che current instance, according to type of visualization
 *
 * @param block_people $instance
 * @param $visualization
 * @return array
 */
function block_people_get_roles_to_be_shown(block_people $instance, $visualization) {
    global $CFG;
    $roles = array();

    switch ($visualization) {
        case BLOCK_PEOPLE_SHOW_COURSE_CONTACT: {
            $roles = explode(',', $CFG->coursecontact);
            break;
        }
        case BLOCK_PEOPLE_SHOW_DEFAULT_ROLES: {
            $roles = explode(',', get_config('block_people', 'defaultroles'));
            break;
        }
        case BLOCK_PEOPLE_SHOW_INSTANCE_ROLES: {
            // Get default roles that can't be overridden.
            $defaultroles = explode(',', get_config('block_people', 'defaultroles'));
            $overridableroles = explode(',', get_config('block_people', 'instanceavailableroles'));
            $defaultrolenotoverridable = array_diff($defaultroles, $overridableroles);
            // Merge not ovverridable default roles with instance defined roles.
            $roles = array_merge($defaultrolenotoverridable, $instance->config->instanceroles);
            break;
        }
    }

    return $roles;
}

