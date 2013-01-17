<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php if(isset($title)) echo $title . ' - '; ?>Assignment Wizard	</title>
	<meta name="description" content="The Common Web Design is the new branding for the University of Lincoln's online services">
	<meta name="author" content="Online Services Team; ost@lincoln.ac.uk">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" href="<?php echo $_SERVER['CWD_BASE_URI']; ?>/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo $_SERVER['CWD_BASE_URI']; ?>/icon.png">

	<link rel="stylesheet" href="<?php echo $_SERVER['CWD_BASE_URI']; ?>/cwd.css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet" type="text/css">

	<!--[if (lt IE 9) & (!IEMobile)]>
		<link rel="stylesheet" href="<?php echo $_SERVER['CWD_BASE_URI']; ?>/ie.min.css">
		<script src="<?php echo $_SERVER['CWD_BASE_URI']; ?>/html5shiv.min.js"></script>
	<![endif]-->

	<script src="<?php echo $_SERVER['CWD_BASE_URI']; ?>/plugins.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://github.com/loopj/jquery-tokeninput/raw/master/src/jquery.tokeninput.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/token-input-bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>custom.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/markitup/skins/simple/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>scripts/markitup/sets/default/style.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/markitup/jquery.markitup.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/markitup/sets/default/set.js"></script>
</head>

<body>

	<div id="cwd-wrap">

		<div id="cwd-main">

			<aside class="navbar navbar-inverse navbar-static-top hidden-phone" id="cwd-global-nav">
				<nav class="navbar-inner"></nav>
			</aside>

			<header id="cwd-header">

				<div class="container">

					<hgroup id="cwd-hgroup">

						<h1>Assignment Wizard<small>Alpha</small></h1>
					</hgroup>

					<div class="navbar">
						<div class="navbar-inner">
						<ul class="nav">
							<li><a href="<?php echo site_url(); ?>">Home</a></li>
							<?php if ($this->session->userdata('user_id')) :?>
							<li><a href="<?php echo $_SERVER['BASE_URL']; ?>signin/logout">Logout</a></li>
							<?php else: ?>
							<!--<li><a href="https://sso.lincoln.ac.uk/oauth?response_type=code&client_id=<?php echo $_SERVER['OAUTH_ID']; ?>&redirect_uri=<?php echo $_SERVER['OAUTH_REDIRECT'] ;?>&scope=user.basic,user.contact&state=test">Login</a></li>-->
							<li><a href="landing_page/fake_login">Login</a></li>
							<?php endif;?>
						</ul>
						</div>
					</div>

				</div>

			</header>




			<div class="container">
