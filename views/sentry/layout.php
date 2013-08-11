<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sentry for Kohana</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
	<link href="http://netdna.bootstrapcdn.com/bootswatch/2.3.2/cosmo/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		html,
		body {
			height: 100%;
			/* The html and body elements cannot have any padding or margin. */
		}
			/* Wrapper for page content to push down footer */
		#wrap {
			min-height: 100%;
			height: auto !important;
			height: 100%;
			/* Negative indent footer by it's height */
			margin: 0 auto -60px;
		}
			/* Set the fixed height of the footer here */
		#push,
		#footer {
			height: 60px;
		}
		#footer {
			background-color: #f5f5f5;
		}
			/* Lastly, apply responsive CSS fixes as necessary */
		@media (max-width: 767px) {
			#footer {
				margin-left: -20px;
				margin-right: -20px;
				padding-left: 20px;
				padding-right: 20px;
			}
		}
		.container {
			width: auto;
			max-width: 60%;
		}
		.container .credit {
			margin: 20px 0;
		}

	</style>

</head>

<body class="preview" id="top">
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="brand" href="#">Sentry for Kohana</a>
				<div class="nav-collapse collapse pull-right">
					<?=Element::factory('sentry')->render('Menu', null, true);?>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<div id="wrap">
		<div id="push"></div>
		<div class="container">
			<?=$hints;?>
			<?=$content;?>
		</div> <!-- /container -->
	</div>

	<div id="footer">
		<div class="container">
			<p class="muted credit"><span class="pull-right"><a href="https://github.com/happyDemon/s4k" target="_blank"><i class="icon-github-alt"></i></a></span> <span class="text-success">S4K</span> project by <a href="https://github.com/happyDemon" target="_blank">happyDemon</a> for <a href="http://kohanaframework.org/" target="_blank">Kohana 3.3</a>.</p>
		</div>
	</div> <!-- /footer -->

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<script src="http://ktt-happydemon.rhcloud.com/cdn/moveSelect.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#permissions').moveSelect({btn_save: $('#group-save')});
			$('#groups').moveSelect({prefix: '#move-group-', btn_save: $('#group-save')});
		});
	</script>
</body>
</html>