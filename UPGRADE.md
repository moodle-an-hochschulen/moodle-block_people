Upgrading this plugin
=====================

This is an internal documentation for plugin developers with some notes what has to be considered when updating this plugin to a new Moodle major version.

General
-------

* Generally, this is a quite simple plugin with just one purpose.
* It does not rely on any fluctuating library functions and should remain quite stable between Moodle major versions.
* Thus, the upgrading effort is low.


Upstream changes
----------------

* This plugin does not inherit or copy anything from upstream sources.
* However, the "Reset visibility" setting writes to the core table `block_positions` directly (see `block_people_reset_visibility()` in locallib.php) as core does not provide a bulk API for this. Please check if core has added a bulk API for setting the block visibility or has started to cache or to trigger events for block positions in the meantime. If yes, the function has to be adapted.


Automated tests
---------------

* The plugin has a good coverage with Behat tests which test all of the plugin's user stories.


Manual tests
------------

* There aren't any manual tests needed to upgrade this plugin.


Visual checks
-------------

* It might be advisable to have a look at the output of the block in the GUI as Moodle themes can always change small details in this area.
