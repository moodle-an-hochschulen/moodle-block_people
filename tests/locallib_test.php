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

namespace block_people;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/blocks/people/locallib.php');

/**
 * Block "people" - Unit tests for the locallib functions.
 *
 * @package    block_people
 * @copyright  2026 Alexander Bias <bias@alexanderbias.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class locallib_test extends \advanced_testcase {
    /**
     * Tests that resetting the visibility shows all hidden People blocks again, but leaves other blocks untouched.
     * @covers ::block_people_reset_visibility
     */
    public function test_reset_visibility(): void {
        global $DB;
        $this->resetAfterTest();

        $course1 = $this->getDataGenerator()->create_course();
        $course2 = $this->getDataGenerator()->create_course();
        $people1 = $this->hide_block_in_course('people', $course1);
        $people2 = $this->hide_block_in_course('people', $course2);
        $otherblock = $this->hide_block_in_course('html', $course1);

        // As long as the checkbox is not ticked, nothing is changed.
        set_config('resetvisibility', 0, 'block_people');
        block_people_reset_visibility();
        $this->assertEquals(0, $DB->count_records_select('block_positions', 'visible = 1'));

        // If the checkbox is ticked, all People blocks are shown again and the checkbox is reset.
        set_config('resetvisibility', 1, 'block_people');
        block_people_reset_visibility();
        $this->assertEquals(1, $DB->get_field('block_positions', 'visible', ['blockinstanceid' => $people1->id]));
        $this->assertEquals(1, $DB->get_field('block_positions', 'visible', ['blockinstanceid' => $people2->id]));
        $this->assertEquals(0, $DB->get_field('block_positions', 'visible', ['blockinstanceid' => $otherblock->id]));
        $this->assertEquals(0, get_config('block_people', 'resetvisibility'));
    }

    /**
     * Helper function to add a block to a course and hide it on the course page.
     *
     * @param string $blockname The name of the block.
     * @param \stdClass $course The course.
     * @return \stdClass The block instance record.
     */
    private function hide_block_in_course(string $blockname, \stdClass $course): \stdClass {
        global $DB;

        $coursecontext = \context_course::instance($course->id);
        $instance = $this->getDataGenerator()->create_block($blockname, ['parentcontextid' => $coursecontext->id]);
        $DB->insert_record('block_positions', [
            'blockinstanceid' => $instance->id,
            'contextid' => $coursecontext->id,
            'pagetype' => 'course-view-' . $course->format,
            'subpage' => '',
            'visible' => 0,
            'region' => $instance->defaultregion,
            'weight' => $instance->defaultweight,
        ]);

        return $instance;
    }
}
