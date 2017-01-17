moodle-block_people
===================

Moodle block which displays all teachers of a course with contact quicklinks, as well as a quicklink to the participants list


Requirements
------------

This plugin requires Moodle 3.2+


Installation
------------

Install the plugin like any other plugin to folder
/blocks/people

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


Placement
---------

block_people is used ideally as sticky block and appears on all of your course pages at the same position

See http://docs.moodle.org/en/Block_settings#Making_a_block_sticky_throughout_the_whole_site for details about sticky blocks


Usage
-----

The block_people plugin displays a list of the course's teachers grouped by roles. The block shows the teacher's avatar, a quicklink to his/her profile and a quicklink to send him/her a message with the moodle message system. Furthermore, there is a quicklink to the participants list of the course.


Themes
------

block_people should work with all Bootstrap based Moodle themes.


Settings
--------

block_people has neither a settings page nor settings in config.php. Nevertheless, there are some Moodle settings it responds to:

### 1. List of teachers

block_people gets the list of teacher roles from $CFG->coursecontact. With this Moodle core setting, you can define which roles are displayed in block_people's list of teachers.

### 2. Quicklink for teachers

block_people only shows a quicklink to the teacher's profile if the user has the capability moodle/user:viewdetails
See http://docs.moodle.org/en/Capabilities/moodle/user:viewdetails for details on this capability

block_people only shows a quicklink to the message system if the user has the capability moodle/site:sendmessage and if the Moodle message system is turnes on ($CFG->messaging)
See http://docs.moodle.org/en/Capabilities/moodle/site:sendmessage for details on this capability and http://docs.moodle.org/en/Messaging for details on the messaging system

### 3. Participants List

block_people only shows the link to the participants list if the user has the capability moodle/course:viewparticipants.
See http://docs.moodle.org/en/Capabilities/moodle/course:viewparticipants for details on this capability

### 4. Roles sort order

block_people shows teacher role groups in the order defined in /admin/roles/manage.php. Please visit this settings page if you want to modify the sort order


Further information
-------------------

block_people is found in the Moodle Plugins repository: http://moodle.org/plugins/view/block_people

Report a bug or suggest an improvement: https://github.com/moodleuulm/moodle-block_people/issues


Moodle release support
----------------------

Due to limited resources, block_people is only maintained for the most recent major release of Moodle. However, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that block_people still works with a new major relase - please let us know on https://github.com/moodleuulm/moodle-block_people/issues


Right-to-left support
---------------------

This plugin has not been tested with Moodle's support for right-to-left (RTL) languages.
If you want to use this plugin with a RTL language and it doesn't work as-is, you are free to send us a pull request on
github with modifications.


PHP7 Support
------------

Since Moodle 3.0, Moodle core basically supports PHP7.
Please note that PHP7 support is on our roadmap for this plugin, but it has not yet been thoroughly tested for PHP7 support and we are still running it in production on PHP5.
If you encounter any success or failure with this plugin and PHP7, please let us know.


Copyright
---------

Ulm University
kiz - Media Department
Team Web & Teaching Support
Alexander Bias

