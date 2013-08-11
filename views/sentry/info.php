<h1>Info</h1>

	<h3>What this module does not do</h3>
	<p>
		This module was created to show you an example of how you could integrate Sentry into your own Kohana application.
	</p>
	<p>
		However, there are a few areas in this module that are lacking when it's normal to send out information through mail.
	</p>
	<p>
		Therefore no user activation code is sent when registering, or a confirmation code when resetting your password, it will just be displayed.
	</p>
	<p><small>These parts have been marked with <code>@todo</code> in the code.</small></p>
	<p>
		Next to that, other parts have also been marked with <code>@todo</code> where it would make sense to take a different approach when you're not in a development environment.
	</p>

	<h3><span class="text-info">Sentry</span> config file</h3>

		<p>
			Next to handling features implemented in this <span class="text-success">S4K</span> module it also offers you some options for initiating <span class="text-info">Sentry</span>.
		</p>
		<p>
			All the <span class="muted">Throttle</span> features are specific to this module, <span class="text-info">Sentry</span> itself requires options for:

		</p>
<ul class="unstyled">
	<li> <i class="icon-circle-blank"></i> A session driver (<a target="_blank" href="http://kohanaframework.org/3.3/guide/kohana/sessions#session-adapters">more info</a>)</li>
	<li> <i class="icon-circle-blank"></i> A session key identifier</li>
	<li> <i class="icon-circle-blank"></i> A cookie key identifier</li>
	<li> <i class="icon-circle-blank"></i> A hasher:
		<ul class="unstyled">
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-minus"></i> Bcrypt</li>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-minus"></i> Native</li>
			<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-minus"></i> Sha256</li>
		</ul>
	</li>
</ul>
	<div id="push"></div>