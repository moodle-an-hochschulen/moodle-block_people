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

/**
 * If setting is saved, use this callback to update the visibility for all block instances.
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
