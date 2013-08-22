s4k - Sentry for Kohana
===

User authentication and authorisation.


#Instalation
At the moment of writing this my pull request has not yet been included into Sentry's codebase,
so installing it through composer will be a bit different.

##Your project's composer.json file

```json
{
  "repositories": [
		{
			"type": "package",
			"package": {
				"name": "happydemon/s4k",
				"type":"kohana-module",
				"version": "0.1",
				"source": {
					"url": "https://github.com/happyDemon/s4k.git",
					"type": "git",
					"reference": "master"
				}
			}
		},
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
		"cartalyst/sentry": "2.0.*",
		"ircmaxell/password-compat": "1.0.*",
  		"happydemon/elements": "1.4",
  		"happydemon/txt": "1.*",
		"happydemon/s4k": "*",
		"happydemon/arr": "1.*"
		"goyote/hint": "1.0"
	},
	"minimum-stability": "dev"
}
```

Run ```composer update```

Next up open ```APPATH.bootstrap.php``` and add S4K, elements and txt to your modules (make sure Database and ORM are activated too)

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

**NOTE: in the previous codebase you also aliassed the models, this isn't necessary anymore since they're
now incuded in this module**

Allright, we're nearly up and running, all we need to do is run an SQL dump in phpMyAdmin, you can find 
it under ```DOCROOT/vendor/cartalyst/schema/mysql.sql```

If you run Kohana on your localhost in the dir 'kohana', go and visit ```http://localhost/kohana/S4K``` to see the
running examples.
