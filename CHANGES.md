moodle-block_people
===================

Changes
-------

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
