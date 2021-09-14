moodle-block_people
===================

Changes
-------

### v3.10-r2

* 2021-02-05 - Make codechecker fully happy
* 2021-02-05 - Move Moodle Plugin CI from Travis CI to Github actions

### v3.10-r1

* 2021-01-09 - Prepare compatibility for Moodle 3.10.
* 2021-01-06 - Change in Moodle release support:
               For the time being, this plugin is maintained for the most recent LTS release of Moodle as well as the most recent major release of Moodle.
               Bugfixes are backported to the LTS release. However, new features and improvements are not necessarily backported to the LTS release.
* 2021-01-06 - Improvement: Declare which major stable version of Moodle this plugin supports (see MDL-59562 for details).

### v3.9-r1

* 2020-07-16 - Prepare compatibility for Moodle 3.9.

### v3.8-r1

* 2020-02-26 - Added Behat tests.
* 2020-02-26 - Merged styles.css files into one file.
* 2020-02-24 - Fixed notice if no roles are selected in the roles setting.
* 2020-02-21 - Added newly added function get_config_for_external().
* 2020-02-12 - Remove hacky workaround for duplicate block title now that block_partipants has been removed from core.
* 2020-02-12 - Prepare compatibility for Moodle 3.8.

### v3.7-r1

* 2019-06-17 - Prepare compatibility for Moodle 3.7.

### v3.6-r1

* 2019-01-16 - Check compatibility for Moodle 3.6, no functionality change.
* 2018-12-05 - Changed travis.yml due to upstream changes.

### v3.5-r3

* 2018-07-25 - Changed CSS font-weight rule due to displaying issues.
* 2018-07-17 - Remove unneeded string from language pack.

### v3.5-r2

* 2018-07-17 - Add the possibility to control if users are listed with multiple roles in the block + respect the global roles sort order when building the teacher list - Credits to David Knuplesch.
* 2018-07-17 - Clean up appearance of teacher list.
* 2018-07-17 - Add the possibility to control the roles to be shown in this block instead of using $CFG->coursecontact.

### v3.5-r1

* 2018-05-29 - Check compatibility for Moodle 3.5, no functionality change.

### v3.4-r2

* 2018-05-16 - Implement Privacy API.

### v3.4-r1

* 2017-12-15 - Used new user picture attribute and removed the user profile quick link because of redundancy.
* 2017-12-13 - Replaced a check for a capability with a new introduced function call.
* 2017-12-12 - Prepare compatibility for Moodle 3.4, no functionality change.

### v3.3-r4

* 2017-12-15 - Fixed a minor bug to restore the functionality of the setting linkparticipantspage.

### v3.3-r3

* 2017-12-08 - Minor string bug fix.

### v3.3-r2

* 2017-12-07 - Added Workaround to travis.yml for fixing Behat tests with TravisCI.
* 2017-12-06 - Fixed further pix-icon displaying bugs.

### v3.3-r1

* 2017-11-23 - Replaced deprecated function $OUTPUT->pix_url() with $OUTPUT->pix_icon().
* 2017-11-23 - Prepare compatibility for Moodle 3.3, no functionality change.
* 2017-11-08 - Updated travis.yml to use newer node version for fixing TravisCI error.

### V3.2-r6

* 2017-10-24 - Improved README.md
* 2017-10-24 - Improved check in settings from string to integer.
* 2017-10-24 - Settings to permit or deny users to be able to hide the block in their courses and to reset the visibility.

### v3.2-r5

* 2017-09-19 - Setting to display link to the participants page within the block.

### v3.2-r4

* 2017-05-29 - Add Travis CI support

### v3.2-r3

* 2017-05-05 - Improve README.md

### v3.2-r2

* 2017-03-28 - Improve the list layout in theme_boost

### v3.2-r1

* 2017-01-12 - Check compatibility for Moodle 3.2, no functionality change
* 2017-01-12 - Move Changelog from README.md to CHANGES.md

### v3.1-r1

* 2016-07-19 - Check compatibility for Moodle 3.1, no functionality change

### Changes before v3.1

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
