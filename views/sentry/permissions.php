<h2>Permissions</h2>

<p>
	<a href="http://docs.cartalyst.com/sentry-2/permissions" target="_blank">Full permission documentation</a>.
</p>

<p>
	For the sake of this demo app, I've included a <code>Permissions</code> helper that stores all your permissions in config files.
</p>

<h3>Standard</h3>

<p>
	All permissions are loaded from a config file that's stored in a <i>'permissions'</i> folder (these files act like normal config files
	and can be loaded from your <code>APPATH</code> or any module you have enabled).
</p>
<p>
Here's an example of a Sentry permission file that's used in this module, it's located in <code>MODPATH.s4k/permissions/sentry.php</code>:
</p>
<p>
	<code>return array(<br />
	&nbsp;&nbsp;'groups' => array(<br />
		&nbsp;&nbsp;&nbsp;&nbsp;'add', 'edit', 'delete', <br />
		&nbsp;&nbsp;&nbsp;&nbsp;'permissions' => array(<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'add', 'remove'<br />
		&nbsp;&nbsp;&nbsp;&nbsp;)<br />
		&nbsp;&nbsp;)<br />
	);
	</code>
</p>
<h3>Retrieving all permissions</h3>
<p>
	When calling <code>Permissions::instance()->all()</code> you'll get the previously defined permissions in a '<em>flattened</em>' format:
</p>
<p>
	<code>
		array( <br />
		&nbsp;&nbsp;'sentry.groups.add', <br />
		&nbsp;&nbsp;'sentry.groups.delete', <br />
		&nbsp;&nbsp;'sentry.groups.edit', <br />
		&nbsp;&nbsp;'sentry.groups.permissions.add', <br />
		&nbsp;&nbsp;'sentry.groups.permissions.remove', <br />
		)
	</code>
</p>

<p>
	As you can see the permissions get prefixed with the name of the permission file, after that every key is added until we run into a value (every value gets added prefixed with its parent keys).
</p>

<h3>Splitting up permissions</h3>
<p>
When managing user or group specific permissions you'll want a list that excludes the permissions that a group or user would already have.
</p>
<p>
You do this by passing all the array keys of the user or group's permissions like so: <code>Permissions::instance()->split(array_keys($user->permissions))</code>
</p>
<p>
	Depending on which permissions the user or group would have, the function will output the 'owned' and 'free' ones:
</p>
<p>
	<code>
		array( <br />
		&nbsp;&nbsp;'free' => array(<br />
		&nbsp;&nbsp;&nbsp;&nbsp;'sentry.groups.add', <br />
		&nbsp;&nbsp;&nbsp;&nbsp;'sentry.groups.delete', <br />
		&nbsp;&nbsp;&nbsp;&nbsp;'sentry.groups.edit' <br />
		&nbsp;&nbsp;),<br />
		&nbsp;&nbsp;'excluded' => array(<br />
		&nbsp;&nbsp;&nbsp;&nbsp;'sentry.groups.permissions.add', <br />
		&nbsp;&nbsp;&nbsp;&nbsp;'sentry.groups.permissions.remove', <br />
		&nbsp;&nbsp;)<br />
		)
	</code>
</p>
	<hr />
<p>
	<small><strong>Of course you're not forced to use it, however it does come in handy if you're dealing with a large codebase that's made up of several modules that need their own permissions defined.<br />
		You could also store all your permissions in a database table, but this seemed easier to me, since only developers would be defining the permissions in config files.</small></strong>
</p>

<div id="push"></div>