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

class block_people extends block_base {
    function init() {
        $this->title = get_string('pluginname', 'block_people');
    }

    function get_content() {
        global $COURSE, $CFG, $OUTPUT;

        if($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        // Prepare output
        $this->content->text = '';
        $this->content->footer = '';

        // Get context
        $currentcontext = $this->page->context;

        // Prepare multilang filter
        require_once(dirname(dirname(dirname(__FILE__))).'/filter/multilang/filter.php');
        $filter = new filter_multilang($currentcontext, array());

        // Get teachers ordered by roles
        $CFG->coursecontact = trim($CFG->coursecontact);
        if (!empty($CFG->coursecontact)) {
            $teacherroles = explode(',', $CFG->coursecontact);
            $teachers = get_role_users($teacherroles, $currentcontext, true, 'u.id, u.lastname, u.firstname, u.picture, u.imagealt, r.name AS rolename, r.sortorder', 'r.sortorder, u.lastname, u.firstname ASC');
        }

        // Output teachers
        if (!empty($teachers)) {
            $this->content->text .= html_writer::start_tag('div', array('class' => 'teachers'));

            $currentrolename = '';
            foreach ($teachers as $t) {
                // Write heading and open new list if we get a new bunch of role members
                if ($currentrolename != $t->rolename) {
                    if ($currentrolename != '')
                         $this->content->text .= html_writer::end_tag('ul');
                         $this->content->text .= html_writer::tag('h3', $filter->filter($t->rolename));
                         $this->content->text .= html_writer::start_tag('ul');
                    $currentrolename = $t->rolename;
                }

                // Output teacher
                $this->content->text .= html_writer::start_tag('li');

                    // create user object for picture output
                    $user = new stdClass();
                    $user->id = $t->id;
                    $user->lastname = $t->lastname;
                    $user->firstname = $t->firstname;
                    $user->picture = $t->picture;
                    $user->imagealt = $t->imagealt;

                    $this->content->text .= $OUTPUT->user_picture($user, array('size' => 30, 'link' => true, 'courseid' => $COURSE->id));
                    $this->content->text .= html_writer::start_tag('div', array('class' => 'name'));
                        $this->content->text .= $t->firstname.' '.$t->lastname;
                    $this->content->text .= html_writer::end_tag('div');
                    $this->content->text .= html_writer::start_tag('div', array('class' => 'icons'));
                        if (has_capability('moodle/user:viewdetails', $currentcontext)) {
                            $this->content->text .= html_writer::start_tag('a', array('href' => new moodle_url('/user/view.php', array('id' => $t->id, 'course' => $COURSE->id)), 'title' => get_string('viewprofile', 'core')));
                                $this->content->text .= html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('i/user'), 'class' => 'icon', 'alt' => get_string('viewprofile', 'core')));
                            $this->content->text .= html_writer::end_tag('a');
                        }

                        if ($CFG->messaging && has_capability('moodle/site:sendmessage', $currentcontext)) {
                            $this->content->text .= html_writer::start_tag('a', array('href' => new moodle_url('/message/index.php', array('id' => $t->id)), 'title' => get_string('sendmessageto', 'core_message', $t->firstname.' '.$t->lastname)));
                                $this->content->text .= html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('i/email'), 'class' => 'icon', 'alt' => get_string('sendmessageto', 'core_message', $t->firstname.' '.$t->lastname)));
                            $this->content->text .= html_writer::end_tag('a');
                        }
                    $this->content->text .= html_writer::end_tag('div');
                $this->content->text .= html_writer::end_tag('li');
            }

            $this->content->text .= html_writer::end_tag('ul');
            $this->content->text .= html_writer::end_tag('div');
        }

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

    function applicable_formats() {
        return array('course-view' => true);
    }
}
