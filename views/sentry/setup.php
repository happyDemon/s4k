<h1>Setup</h1>
	<p>Setting up <span class="text-info">Sentry for Kohana</span> is easy as pie.</p><br />

	<ul class="unstyled">
		<li>
			<h4 class="text-success">Prerequisite</h4>
			<p>If you want to use <span class="text-info">Sentry for Kohana</span> out-of-the-box make sure you have the <code>Database</code> and <code>ORM</code> module installed and configured.</p><br />
		</li>
		<li>
			<h3>1. Composer</h3>
			<p>Let's add our dependencies to <span class="muted">composer.json</span>, we add <span class="text-warning">cartalyst/sentry</span>, <span class="text-warning">ircmaxell/password-compat</span> and <span class="text-warning">happydemon/txt</span></p>
			<p><code>
				{<br />
				&nbsp;&nbsp;"require": {<br />
				&nbsp;&nbsp;&nbsp;&nbsp;	"cartalyst/sentry": "2.0.*",<br />
				&nbsp;&nbsp;&nbsp;&nbsp;	"ircmaxell/password-compat": "1.0.*",<br />
				&nbsp;&nbsp;&nbsp;&nbsp;	"happydemon/txt": "*"<br />
				&nbsp;&nbsp;},<br />
				&nbsp;&nbsp;"minimum-stability": "dev"<br />
				}

			</code></p>
			<p>Next up, we'll install these by running <code>composer update</code></p>
			<p>At this point you should have all the libraries needed to start developing with Sentry.</p>
		</li>
		<li>
			<h3>2. Import Data</h3>
			<p>You can find an <span class="muted">SQL</span> dump in <code>vendor/cartalyst/schema</code>, it's <span class="text-info">Sentry</span>'s database schema, import it in your database.</p>
			<p>(the migration table isn't required and can be deleted since it's clutter)</p>
		</li>
		<li>
			<h3>3. bootstrap.php</h3>
			<p>Lastly we need to alias some classes in <code>APPATH.bootstrap.php</code> to get everything up and running.</p>
			<p>Open up your bootstrap.php, and add these lines of code a the end of the file:</p>
			<p><code>
				class_alias('\Cartalyst\Sentry\Facades\Kohana\Sentry', 'Sentry'); <br />
				class_alias('\Cartalyst\Sentry\Users\Kohana\User', 'Model_User'); <br />
				class_alias('\Cartalyst\Sentry\Throttling\Kohana\Throttle', 'Model_Throttle');<br />
				class_alias('\Cartalyst\Sentry\Groups\Kohana\Group', 'Model_Group');</code></p>
		</li>
	</ul>
	<div id="push"></div>