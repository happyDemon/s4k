s4k - Sentry for Kohana
===

Sentry can be used for user authentication and authorisation.

This module shows you how you could implement sentry in your Kohana application.

What's included:
- User registration
- User login (with optional remember and login throttler) logout
- Activation
- Reset password
- Groups
- Permissions

*Permissions, however still need to be implemented and tested in S4K*

#Instalation

I'm making use of Goyote's Hint module, you'll have to add this as a repository to your composer.json file in your DOCROOT since he hasn't packaged it for composer.

## composer.json file

```json
{
  "repositories": [
		{
			"type": "package",
			"package": {
				"name": "goyote/hint",
				"type":"kohana-module",
				"version": "1.0",
				"source": {
					"url": "https://github.com/goyote/hint.git",
					"type": "git",
					"reference": "master"
				}
			}
		}
	],
	"require": {
		"cartalyst/sentry": "2.*",
		"ircmaxell/password-compat": "1.0.*",
		"happydemon/s4k": "0.5",
		"goyote/hint": "1.0"
	},
	"minimum-stability": "dev"
}
```

Run ```composer update```

Next up open ```APPATH.bootstrap.php``` and add S4K, elements, arr, txt and hint to your modules (make sure Database and ORM are activated too)

```php
Kohana::modules(array(
  's4k' 	=> MODPATH.'s4k',	// S4K module, examplory implementation of Sentry
  'txt' 	=> MODPATH.'txt',	// Extra text helpers (used by Sentry)
  'arr' 	=> MODPATH.'arr',	// Extra Arr helpers (used for groups)
  'elements' 	=> MODPATH.'elements',	// Navigation element manager
  'hint' 	=> MODPATH.'hint',	// Flash message manager
  'database'	=> MODPATH.'database',	// Database access
  'orm'		=> MODPATH.'orm',	// Object Relationship Mapping
));
```

Right under that we'll put the code to alias some Sentry classes

```php
/**
 * Setup Sentry
 */
class_alias('\Cartalyst\Sentry\Facades\Kohana\Sentry', 'Sentry');
```

Alright, we're nearly up and running, all we need to do is run an SQL dump in phpMyAdmin, you can find 
it under ```DOCROOT/vendor/cartalyst/schema/mysql.sql```

If you run Kohana on your localhost in the dir 'kohana', go and visit ```http://localhost/kohana/S4K``` to see the
running examples.

[![Gittip Badge](http://img.shields.io/gittip/happyDemon.svg)](https://www.gittip.com/happyDemon/ "Gittip donations")
