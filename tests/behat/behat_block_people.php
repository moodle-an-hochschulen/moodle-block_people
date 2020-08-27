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
 * Steps definitions for block_people
 *
 * This script is only called from Behat as part of it's integration
 * in Moodle.
 *
 * @package   block_people
 * @category  test
 * @copyright 2020 Kathrin Osswald <kathrin.osswald@uni-ulm.de>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// NOTE: no MOODLE_INTERNAL test here, this file may be required by behat before including /config.php.

/**
 * Steps definitions for block_people
 *
 * This script is only called from Behat as part of it's integration
 * in Moodle.
 *
 * @package   block_people
 * @category  test
 * @copyright 2020 Kathrin Osswald <kathrin.osswald@uni-ulm.de>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_block_people extends behat_base {
    /**
     * Checks, that the specified user is listed in the section with the specified role within the block People.
     *
     * @codingStandardsIgnoreLine
     * @Then /^the user "(?P<username_string>(?:[^"]|\\")*)" should be listed in the section with the role "(?P<rolename_string>(?:[^"]|\\")*)"$/
     *
     * @param string $username
     * @param string $rolename
     */
    public function user_should_be_listed_in_role_section($username, $rolename) {

        $elementxpath = "//section[contains(concat(' ',normalize-space(@class),' '),' block_people ')]";
        $elementxpath .= "//h3[contains(text(),'{$rolename}')]";
        $elementxpath .= "/following-sibling::ul//div[contains(text(),'{$username}')]";

        // Check if the element exists.
        $this->execute("behat_general::should_exist",
                array($elementxpath, "xpath_element"));
    }
}
