Checklist
=========
A simple application for tracking the completion of a daily checklist. Built with AngularJS, using PHP/MySQL as a backend.

Features
--------
* Add tasks, specifying what days and day part those tasks should be completed.
* Track which employee completed which task.

Todo
----
1. Admin area to review previous calls.

2. Cleaner integration with its sister apps, Timeclock and Callbacks

License
-------
[![Creative Commons by-sa](http://i.creativecommons.org/l/by-sa/3.0/us/88x31.png)](http://creativecommons.org/licenses/by-sa/3.0/us/deed.en_US)

Checklist by [Sean Ryan](http://designingsean.com) is licensed under a [Creative Commons Attribution-ShareAlike 3.0 United States License](http://creativecommons.org/licenses/by-sa/3.0/us/deed.en_US).

Required Libraries
------------------
jQuery 1.8.3

AngularJS 1.0.8

MomentJS 2.3.1

Meekro 2.1

Database Structure
------------------
User table:

	CREATE TABLE `users` (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `name` varchar(20) NOT NULL DEFAULT '',
	  `active` tinyint(1) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

Tasks table:

	CREATE TABLE `tasks` (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `type` varchar(40) NOT NULL DEFAULT '',
	  `mon` tinyint(1) NOT NULL DEFAULT '0',
	  `tue` tinyint(1) NOT NULL DEFAULT '0',
	  `wed` tinyint(1) NOT NULL DEFAULT '0',
	  `thu` tinyint(1) NOT NULL DEFAULT '0',
	  `fri` tinyint(1) NOT NULL DEFAULT '0',
	  `sat` tinyint(1) NOT NULL DEFAULT '0',
	  `sun` tinyint(1) NOT NULL DEFAULT '0',
	  `open` tinyint(1) NOT NULL DEFAULT '0',
	  `midday` tinyint(1) NOT NULL DEFAULT '0',
	  `close` tinyint(1) NOT NULL DEFAULT '0',
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

Checklist table:

	CREATE TABLE `checklist` (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `dutyId` int(11) NOT NULL,
	  `userId` int(11) NOT NULL,
	  `completed` datetime NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

Misc
----
db.config.php file omitted for obvious reasons. Format is below:

	DB::$user = 'DBUSER';
	DB::$password = 'DBPASS';
	DB::$dbName = 'DBNAME';