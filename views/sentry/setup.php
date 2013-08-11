<h1>Setup</h1>
	<p>Setting up <span class="text-info">Sentry for Kohana</span> is easy as pie.<br />
	<small>This is when you don't want to make use of the <span class="text-success">S4K</span> module.</small></p><br />

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
			<h3>3. Models</h3>
			<p>
				You'll need to either extend or alias the models that come with <span class="text-info">Sentry</span> to make sure they play nice with <em>Kohana</em>'s <code>ORM</code>
			</p>
			<h4>Extend</h4>
			<p>
				Just create 3 model files as your normally would, but instead of extending <code>ORM</code> we'll do it like this:
			</p>
			<p>
				<code>
					class Model_Group extends \Cartalyst\Sentry\Groups\Kohana\Group {}
				</code><br />
				<code>
					class Model_User extends \Cartalyst\Sentry\Users\Kohana\User {}
				</code><br />
				<code>
					class Model_Throttle extends \Cartalyst\Sentry\Throttling\Kohana\Throttle {}
				</code><br />
			</p>
			<h4>Alias</h4>
			<p>
				Or you could alias the classes to an ORM-friendly way:
			</p>
			<p>
				<code>
					class_alias('\Cartalyst\Sentry\Groups\Kohana\Group', 'Model_Group');<br />
					class_alias('\Cartalyst\Sentry\Users\Kohana\User', 'Model_User');<br />
					class_alias('\Cartalyst\Sentry\Throttling\Kohana\Throttle', 'Model_Throttle');<br />
				</code>
			</p>
		</li>
		<li>
			<h3>4. bootstrap.php</h3>
			<p>We need to alias the <span class="text-info">Sentry</span> class in <code>APPATH.bootstrap.php</code> as a handy shortcut.</p>
			<p>Open up your bootstrap.php, and add this line of code a the end of the file:</p>
			<p><code>
				class_alias('\Cartalyst\Sentry\Facades\Kohana\Sentry', 'Sentry');
				</code>
			</p>
		</li>
	</ul>
	<div id="push"></div>