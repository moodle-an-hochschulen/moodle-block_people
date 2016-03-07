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
 * Block "people"
 *
 * @package    block_people
 * @copyright  2013 Alexander Bias, University of Ulm <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_people extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_people').'&nbsp;'; // Non-breaking space is added because otherwise the Moodle CLI installer fails due to a duplicate block title with block_partipants. The space should not have a big visual impact.
    }

    function applicable_formats() {
        return array('course-view' => true, 'site' => true);
    }

    function has_config() {
        return false;
    }

    function instance_allow_multiple() {
        return false;
    }

    function instance_can_be_hidden() {
        return true;
    }

    function get_content() {
        global $COURSE, $CFG, $DB, $OUTPUT, $USER;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        // Prepare output
        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->footer = '';

        // Get context
        $currentcontext = $this->page->context;

        // Get teachers separated by roles
        $CFG->coursecontact = trim($CFG->coursecontact);
        if (!empty($CFG->coursecontact)) {
            $teacherroles = explode(',', $CFG->coursecontact);
            foreach($teacherroles as $tr) {
                $teachers[$tr] = get_role_users($tr, $currentcontext, true, 'u.id, u.lastname, u.firstname, u.firstnamephonetic, u. lastnamephonetic, u.middlename, u.alternatename, u.picture, u.imagealt, u.email', 'u.lastname ASC, u.firstname ASC');
            }
        }

        // Get role names / aliases in course context
        $rolenames = role_get_names($currentcontext, ROLENAME_ALIAS, true);

        // Start teachers list
        $this->content->text .= html_writer::start_tag('div', array('class' => 'teachers'));

        // Check every teacherrole
        foreach ($teachers as $id => $tr) {
            if (count($tr) > 0) {
                // Write heading and open new list
                $this->content->text .= html_writer::tag('h3', $rolenames[$id]);
                $this->content->text .= html_writer::start_tag('ul');

                // Do for every teacher with this role
                foreach ($tr as $t) {
                    // Output teacher
                    $this->content->text .= html_writer::start_tag('li');

                    // create user object for picture output
                    $user = new stdClass();
                    $user->id = $t->id;
                    $user->lastname = $t->lastname;
                    $user->firstname = $t->firstname;
                    $user->lastnamephonetic = $t->lastnamephonetic;
                    $user->firstnamephonetic = $t->firstnamephonetic;
                    $user->middlename = $t->middlename;
                    $user->alternatename = $t->alternatename;
                    $user->picture = $t->picture;
                    $user->imagealt = $t->imagealt;
                    $user->email = $t->email;

                    $this->content->text .= html_writer::start_tag('div', array('class' => 'image'));
                        if (has_capability('moodle/user:viewdetails', $currentcontext)) {
                            $this->content->text .= $OUTPUT->user_picture($user, array('size' => 30, 'link' => true, 'courseid' => $COURSE->id));
                        }
                        else {
                            $this->content->text .= $OUTPUT->user_picture($user, array('size' => 30, 'link' => false, 'courseid' => $COURSE->id));
                        }
                    $this->content->text .= html_writer::end_tag('div');

                    $this->content->text .= html_writer::start_tag('div', array('class' => 'name'));
                        $this->content->text .= fullname($t);
                    $this->content->text .= html_writer::end_tag('div');

                    $this->content->text .= html_writer::start_tag('div', array('class' => 'icons'));
                        if (has_capability('moodle/user:viewdetails', $currentcontext)) {
                            $this->content->text .= html_writer::start_tag('a', array('href' => new moodle_url('/user/view.php', array('id' => $t->id, 'course' => $COURSE->id)), 'title' => get_string('viewprofile', 'core')));
                            $this->content->text .= html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('i/user'), 'class' => 'icon', 'alt' => get_string('viewprofile', 'core')));
                            $this->content->text .= html_writer::end_tag('a');
                        }

                        if ($CFG->messaging && has_capability('moodle/site:sendmessage', $currentcontext) && $t->id != $USER->id) {
                            $this->content->text .= html_writer::start_tag('a', array('href' => new moodle_url('/message/index.php', array('id' => $t->id)), 'title' => get_string('sendmessageto', 'core_message', fullname($t))));
                                $this->content->text .= html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('t/email'), 'class' => 'icon', 'alt' => get_string('sendmessageto', 'core_message', fullname($t))));
                            $this->content->text .= html_writer::end_tag('a');
                        }
                    $this->content->text .= html_writer::end_tag('div');

                    $this->content->text .= html_writer::end_tag('li');
                }

                // End list
                $this->content->text .= html_writer::end_tag('ul');
            }
        }

        // End teachers list
        $this->content->text .= html_writer::end_tag('div');

        // Output participant list
        $this->content->text .= html_writer::start_tag('div', array('class' => 'participants'));
        $this->content->text .= html_writer::tag('h3', get_string('participants'));

        // Only if user is allow to see participants list
        if (has_capability('moodle/course:viewparticipants', $currentcontext)) {
            $this->content->text .= html_writer::start_tag('a', array('href' => new moodle_url('/user/index.php', array('contextid' => $currentcontext->id)), 'title' => get_string('participants')));
            $this->content->text .= html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('i/users'), 'class' => 'icon', 'alt' => get_string('participants')));
            $this->content->text .= get_string('participantslist', 'block_people');
            $this->content->text .= html_writer::end_tag('a');
        }
        else {
            $this->content->text .= html_writer::start_tag('span', array('class' => 'hint'));
            $this->content->text .= get_string('noparticipantslist', 'block_people');
            $this->content->text .= html_writer::end_tag('span');
        }

        $this->content->text .= html_writer::end_tag('div');

        return $this->content;
    }
}
