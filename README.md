moodle-block_people
===================

Moodle block which displays all teachers of a course with contact quicklinks, as well as a quicklink to the participants list


Requirements
------------

This plugin requires Moodle 3.1+


Changes
-------

* 2016-07-19 - Check compatibility for Moodle 3.1, no functionality change
* 2016-03-07 - Workaround: Add non-breaking space to block title because otherwise the Moodle CLI installer fails due to a duplicate title with block_partipants. The space should not have a big visual impact.
* 2016-02-10 - Change plugin version and release scheme to the scheme promoted by moodle.org, no functionality change
* 2016-01-01 - Check compatibility for Moodle 3.0, no functionality change
* 2015-08-21 - Change My Moodle to Dashboard in language pack
* 2015-08-18 - Check compatibility for Moodle 2.9, no functionality change
* 2015-01-29 - Improve layout and remove link to profile when user does not see profile icons
* 2015-01-29 - Check compatibility for Moodle 2.8, no functionality change
* 2014-08-29 - Update README file
* 2014-06-30 - Drop support for Non-Bootstrap based themes
* 2014-06-30 - Check compatibility for Moodle 2.7, no functionality change
* 2014-01-31 - Check compatibility for Moodle 2.6, no functionality change
* 2013-10-15 - Bugfix: Block didn't respect course members which have multiple roles, now those members are listed with all of their roles
* 2013-07-30 - Transfer Github repository from github.com/abias/... to github.com/moodleuulm/...; Please update your Git paths if necessary
* 2013-07-30 - Check compatibility for Moodle 2.5, no functionality change
* 2013-04-23 - Add required capability for placing block on MyMoodle page
* 2013-03-18 - Fix php strict standards bug, fix small performance issue, Code cleanup according to moodle codechecker
* 2013-02-18 - Check compatibility for Moodle 2.4
* 2012-12-17 - New Feature: Block supports role names which have been renamed in course context
* 2012-11-30 - Bugfix: Block couldn't be added to frontpage, therefore it couldn't be used as sticky block
* 2012-11-27 - Small code cleanup
* 2012-10-10 - German language has been integrated into AMOS and was removed from this plugin. Please update your language packs with http://YOURMOODLEURL/admin/tool/langimport/index.php after installing this plugin version
* 2012-06-25 - Update version.php for Moodle 2.3
* 2012-06-01 - Initial version


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
If you want to use this plugin with a RTL language and it doesn't work as-is, you are free to send me a pull request on
github with modifications.


Copyright
---------

University of Ulm
kiz - Media Department
Team Web & Teaching Support
Alexander Bias

