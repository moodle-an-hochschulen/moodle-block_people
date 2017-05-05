moodle-block_people
===================

Moodle block which displays all teachers of a course with contact quicklinks, as well as a quicklink to the participants list


Requirements
------------

This plugin requires Moodle 3.2+


Motivation for this plugin
--------------------------

The block_people plugin displays a list of the course's teachers grouped by roles. The block shows the teacher's avatar, a quicklink to his/her profile and a quicklink to send him/her a message with the moodle message system. Furthermore, there is a quicklink to the participants list of the course.


Installation
------------

Install the plugin like any other plugin to folder
/blocks/people

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


Usage & Settings
----------------

After installing the plugin, it can be directly used by users and can be added to course overview pages.

The plugin has neither a settings page nor settings in config.php. Nevertheless, there are some Moodle settings it responds to:

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


Block placement
---------------

block_people is used ideally as sticky block and appears on all of your course pages at the same position

See http://docs.moodle.org/en/Block_settings#Making_a_block_sticky_throughout_the_whole_site for details about sticky blocks


Theme support
-------------

This plugin should work with all Bootstrap based Moodle themes.
It has been developed on and tested with Moodle Core's Clean and Boost themes.


Plugin repositories
-------------------

This plugin is published and regularly updated in the Moodle plugins repository:
http://moodle.org/plugins/view/block_people

The latest development version can be found on Github:
https://github.com/moodleuulm/moodle-block_people


Bug and problem reports / Support requests
------------------------------------------

This plugin is carefully developed and thoroughly tested, but bugs and problems can always appear.

Please report bugs and problems on Github:
https://github.com/moodleuulm/moodle-block_people/issues

We will do our best to solve your problems, but please note that due to limited resources we can't always provide per-case support.


Feature proposals
-----------------

Due to limited resources, the functionality of this plugin is primarily implemented for our own local needs and published as-is to the community. We are aware that members of the community will have other needs and would love to see them solved by this plugin.

Please issue feature proposals on Github:
https://github.com/moodleuulm/moodle-block_people/issues

Please create pull requests on Github:
https://github.com/moodleuulm/moodle-block_people/pulls

We are always interested to read about your feature proposals or even get a pull request from you, but please accept that we can handle your issues only as feature _proposals_ and not as feature _requests_.


Moodle release support
----------------------

Due to limited resources, this plugin is only maintained for the most recent major release of Moodle. However, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that this plugin still works with a new major relase - please let us know on Github.

If you are running a legacy version of Moodle, but want or need to run the latest version of this plugin, you can get the latest version of the plugin, remove the line starting with $plugin->requires from version.php and use this latest plugin version then on your legacy Moodle. However, please note that you will run this setup completely at your own risk. We can't support this approach in any way and there is a undeniable risk for erratic behavior.


Translating this plugin
-----------------------

This Moodle plugin is shipped with an english language pack only. All translations into other languages must be managed through AMOS (https://lang.moodle.org) by what they will become part of Moodle's official language pack.

As the plugin creator, we manage the translation into german for our own local needs on AMOS. Please contribute your translation into all other languages in AMOS where they will be reviewed by the official language pack maintainers for Moodle.


Right-to-left support
---------------------

This plugin has not been tested with Moodle's support for right-to-left (RTL) languages.
If you want to use this plugin with a RTL language and it doesn't work as-is, you are free to send us a pull request on Github with modifications.


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
