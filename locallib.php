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
 * Block "people" - Local library
 *
 * @package    block_people
 * @copyright  2017 Kathrin Osswald, Ulm University <kathrin.osswald@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

define('BLOCK_PEOPLE_SHOW_NOTHING', 0);
define('BLOCK_PEOPLE_SHOW_COURSE_CONTACT', 1);
define('BLOCK_PEOPLE_SHOW_DEFAULT_ROLES', 2);
define('BLOCK_PEOPLE_SHOW_INSTANCE_ROLES', 3);

/**
 * If setting is saved, use this callback to update the visibility for all block instances.
 * @throws coding_exception
 * @throws dml_exception
 */
function block_people_reset_visibility() {
    global $DB;
    if (get_config('block_people', 'resetvisibility') == 1) {
        // SQL-Statement to update the visibility of all block_people instances to visible (=1).
        $sql = "UPDATE {block_positions} bp
            SET visible = 1
            WHERE bp.blockinstanceid IN (SELECT id
                                        FROM {block_instances} bi
                                        WHERE bi.blockname = 'people')";
        if ($DB->execute($sql) == true) {
            \core\notification::info(get_string('resetvisibilitysuccess', 'block_people'));
        } else {
            \core\notification::error(get_string('resetvisibilityerror', 'block_people'));
        }
        // Reset the checkbox.
        set_config('resetvisibility', 0, 'block_people');
    }
}

/**
 * Get the list of assignable roles in course context
 *
 * @param null $context
 * @return array
 * @throws dml_exception
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
 * @throws dml_exception
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
 * If setting is saved, use this callback to remove from instances' configdata any role no more overridable.
 * @throws dml_exception
 */
function block_people_reset_instance_overridable_roles() {
    global $DB;

    if (get_config('block_people', 'overridableroles') != null) {
        $overridableroles = explode(",", get_config('block_people', 'overridableroles'));
        $blockistances = $DB->get_records('block_instances', array('blockname' => 'people'));
        foreach ($blockistances as $blockinstance) {
            // Block configdata is saved serialized and encoded in base64, so we need to decode and unserialize.
            $blockconfig = unserialize(base64_decode($blockinstance->configdata));
            // Update configdata filtering roles no more overridable.
            $blockconfig->instanceroles = array_filter($blockconfig->instanceroles, function($role) use ($overridableroles) {
                if (in_array($role, $overridableroles)) {
                    return true;
                }
                return false;
            });
            // Update configdata.
            $DB->set_field('block_instances', 'configdata', base64_encode(serialize($blockconfig)),
                array('id' => $blockinstance->id));
        }
    }
}

/**
 * Check if current user can override roles
 *
 * @param $context
 * @return bool
 * @throws coding_exception
 * @throws dml_exception
 */
function block_people_can_override_roles($context) {
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
 * @throws dml_exception
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
 * @throws dml_exception
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
            $roles = explode(',', get_config('block_people', 'roles'));
            break;
        }
        case BLOCK_PEOPLE_SHOW_INSTANCE_ROLES: {
            // Get default roles that can't be overridden.
            $defaultroles = explode(',', get_config('block_people', 'roles'));
            $overridableroles = explode(',', get_config('block_people', 'overridableroles'));
            $defaultrolenotoverridable = array_diff($defaultroles, $overridableroles);
            // Merge not overridable default roles with instance defined roles.
            $roles = array_unique(array_merge($defaultrolenotoverridable, $instance->config->instanceroles));
            break;
        }
    }

    return $roles;
}

