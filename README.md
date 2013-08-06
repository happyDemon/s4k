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
				"name": "cartalyst/sentry",
				"version": "2.0.0",
				"source": {
					"url": "https://github.com/happyDemon/sentry.git",
					"type": "git",
					"reference": "master"
				},
				"autoload": {
					"classmap": [
						"src/Cartalyst/Sentry/Groups/Exceptions.php",
						"src/Cartalyst/Sentry/Throttling/Exceptions.php",
						"src/Cartalyst/Sentry/Users/Exceptions.php",
						"src/migrations"
					],
					"psr-0": {
						"Cartalyst\\Sentry": "src/"
					}
				}
			}
		},
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
		}
	],
	"require": {
		"cartalyst/sentry": "2.0.0",
		"ircmaxell/password-compat": "1.0.*",
  	"happydemon/elements": "*",
  	"happydemon/txt": "*",
		"happydemon/s4k": "*"
	},
	"minimum-stability": "dev"
}
```

Run ```composer update```

Next up open ```APPATH.bootstrap.php``` and add S4K, elements and txt to your modules (make sure Database and ORM are activated too)

```php
Kohana::modules(array(
  's4k' => MODPATH.'s4k',		// S4K module, examplory implementation of Sentry
  'txt' => MODPATH.'txt',		// Extra text helpers (used by Sentry)
  'elements' => MODPATH.'elements',	// Navigation element manager
  'database'   => MODPATH.'database',	// Database access
  'orm'        => MODPATH.'orm',	// Object Relationship Mapping
));
```

Right under that we'll put the code to alias some Sentry classes

```php
/**
 * Setup Sentry
 */
class_alias('\Cartalyst\Sentry\Facades\Kohana\Sentry', 'Sentry');
class_alias('\Cartalyst\Sentry\Users\Kohana\User', 'Model_User');
class_alias('\Cartalyst\Sentry\Throttling\Kohana\Throttle', 'Model_Throttle');
class_alias('\Cartalyst\Sentry\Groups\Kohana\Group', 'Model_Group');
```

Allright, we're nearly up and running, all we need to do is run an SQL dump in phpMyAdmin, you can find 
it under ```DOCROOT/vendor/cartalyst/schema/mysql.sql```

If you run Kohana on your localhost in the dir 'kohana', go and visit ```http://localhost/kohana/sentry``` to see the
running examples.
