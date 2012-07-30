<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	
	<title>White Label - a full featured Admin Skin</title>
	
	<meta name="description" content="">
	
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/style.css') ?>">       
	<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/light/theme.css') ?>" id="themestyle">        

        <!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('/bundles/boomback/css/ie.css') ?>">       
	<![endif]-->
	
	<!-- Apple iOS and Android stuff -->
	<meta name="apple-mobile-web-app-capable" content="no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	
	<!-- Apple iOS and Android stuff - don't remove! -->
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<!-- Use Google CDN for jQuery and jQuery UI -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
	
	<!-- Loading JS Files this way is not recommended! Merge them but keep their order -->
	
	<!-- some basic functions -->
        <?php
	$js = array(
        'js/functions.js',
	'js/plugins.js',
	'js/editor.js',
	'js/calendar.js',
	'js/flot.js',
	'js/elfinder.js',
	'js/datatables.js',
	'js/wl_Alert.js',
	'js/wl_Autocomplete.js',
	'js/wl_Breadcrumb.js',
	'js/wl_Calendar.js',
	'js/wl_Chart.js',
	'js/wl_Color.js',
	'js/wl_Date.js',
	'js/wl_Editor.js',
	'js/wl_File.js',
	'js/wl_Dialog.js',
	'js/wl_Fileexplorer.js',
	'js/wl_Form.js',
	'js/wl_Gallery.js',
	'js/wl_Multiselect.js',
	'js/wl_Number.js',
	'js/wl_Password.js',
	'js/wl_Slider.js',
	'js/wl_Store.js',
	'js/wl_Time.js',
	'js/wl_Valid.js',
	'js/wl_Widget.js',
	'js/config.js',
	'js/script.js');
        foreach($js as $jsUnit):?>
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('/bundles/boomback/'.$jsUnit); ?>"></script>    
        <?php
        endforeach;
        ?>
	
	
</head>
<body>
				<div id="pageoptions">
			<ul>
				<li><a href="login.html">Logout</a></li>
				<li><a href="#" id="wl_config">Configuration</a></li>
				<li><a href="#">Settings</a></li>
			</ul>
			<div>
						<h3>Place for some configs</h3>
						<p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores.</p>
			</div>
		</div>

			<header>
		<div id="logo">
			<a href="">Logo Here</a>
		</div>
		<div id="header">
			<ul id="headernav">
				<li><ul>
					<li><a href="icons.html">Icons</a><span>300+</span></li>
					<li><a href="#">Submenu</a><span>4</span>
						<ul>
							<li><a href="#">Just</a></li>
							<li><a href="#">another</a></li>
							<li><a href="#">Dropdown</a></li>
							<li><a href="#">Menu</a></li>
						</ul>
					</li>
					<li><a href="login.html">Login</a></li>
					<li><a href="wizard.html">Wizard</a><span>Bonus</span></li>
					<li><a href="#">Errorpage</a><span>new</span>
						<ul>
							<li><a href="error-403.html">403</a></li>
							<li><a href="error-404.html">404</a></li>
							<li><a href="error-405.html">405</a></li>
							<li><a href="error-500.html">500</a></li>
							<li><a href="error-503.html">503</a></li>
						</ul>
					</li>
				</ul></li>
			</ul>
			<div id="searchbox">
				<form id="searchform" autocomplete="off">
					<input type="search" name="query" id="search" placeholder="Search">
				</form>
			</div>
			<ul id="searchboxresult">
			</ul>
		</div>
	</header>

				<nav>
			<ul id="nav">
				<li class="i_house"><a href="dashboard.html"><span>Dashboard</span></a></li>
				<li class="i_book"><a><span>Documentation</span></a>
					<ul>
						<li><a href="doc-alert.html"><span>Alert Boxes</span></a></li>
						<li><a href="doc-breadcrumb.html"><span>Breadcrumb</span></a></li>
						<li><a href="doc-calendar.html"><span>Calendar</span></a></li>
						<li><a href="doc-charts.html"><span>Charts</span></a></li>
						<li><a href="doc-dialog.html"><span>Dialog</span></a></li>
						<li><a href="doc-editor.html"><span>Editor</span></a></li>
						<li><a href="doc-file.html"><span>File</span></a></li>
						<li><a href="doc-fileexplorer.html"><span>Fileexplorer</span></a></li>
						<li><a href="doc-form.html"><span>Form</span></a></li>
						<li><a href="doc-gallery.html"><span>Gallery</span></a></li>
						<li><a href="doc-inputfields.html"><span>Inputfields</span></a></li>
						<li><a href="doc-slider.html"><span>Slider</span></a></li>
						<li><a href="doc-store.html"><span>Store</span></a></li>
						<li><a href="doc-widget.html"><span>Widget</span></a></li>
					</ul>
				</li>
				<li class="i_create_write"><a href="form.html"><span>Form</span></a></li>
				<li class="i_graph"><a href="charts.html"><span>Charts</span></a></li>
				<li class="i_images"><a href="gallery.html"><span>Gallery</span></a></li>
				<li class="i_blocks_images"><a href="widgets.html"><span>Widgets</span></a></li>
				<li class="i_breadcrumb"><a href="breadcrumb.html"><span>Breadcrumb</span></a></li>
				<li class="i_file_cabinet"><a href="fileexplorer.html"><span>Fileexplorer</span></a></li>
				<li class="i_calendar_day"><a href="calendar.html"><span>Calendar</span></a></li>
				<li class="i_speech_bubbles_2"><a href="dialogs_and_buttons.html"><span>Dialogs &amp; Buttons</span></a></li>
				<li class="i_table"><a href="datatable.html"><span>Table</span></a></li>
				<li class="i_typo"><a href="typo.html"><span>Typo</span></a></li>
				<li class="i_grid"><a href="grid.html"><span>Grid</span></a></li>
			</ul>
		</nav>
		
			
		
		<section id="content">
                <?php $view['slots']->output('_content') ?>
                </section>
		<footer>Copyright by revaxarts.com 2012</footer>
</body>
</html>