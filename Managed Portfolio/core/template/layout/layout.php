<!DOCTYPE html>
<html lang="en-US" class="no-js">
	<head>

		<!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
		<title>Hi ! I'm Antoine Falais</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- ==============================================
		Favicons
		=============================================== -->
		<link rel="shortcut icon" href="<?= WEB_SITE ?>/assets/favicon.ico">
		<link rel="apple-touch-icon" href="<?= WEB_SITE ?>/assets/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?= WEB_SITE ?>/assets/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?= WEB_SITE ?>/assets/apple-touch-icon-114x114.png">
		
		<!-- ==============================================
		CSS
		=============================================== -->    
		<link rel="stylesheet" href="<?= CSS_PATH ?>/bootstrap.min.css">
		<link rel="stylesheet" href="<?= CSS_PATH ?>/font-awesome.css">
		<link rel="stylesheet" href="<?= CSS_PATH ?>/flexslider.css">
		<link rel="stylesheet" href="<?= CSS_PATH ?>/meflat-blue.css">
		
		
		<!-- ==============================================
		Fonts
		=============================================== -->
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,300italic,200,400italic,600,600italic' rel='stylesheet' type='text/css'>
		
		<!-- ==============================================
		JS
		=============================================== -->
			
		<!--[if lt IE 9]>
			<script  src="<?= JS_PATH ?>/respond.min.js"></script>
		<![endif]-->
		
		<script type="text/javascript"  src="<?= JS_PATH ?>/libs/modernizr.min.js"></script>
		
		
	</head>
  
	<body data-spy="scroll" data-target="#main-nav" data-offset="400">
		<!-- ==============================================
		MAIN NAV
		=============================================== -->
		<div id="main-nav" class="navbar navbar-fixed-top">
			<div class="container">
			
				<div class="navbar-header">
				
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-nav">
						<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button>
					
					<!-- ======= LOGO (for small screens)========-->
					<a class="navbar-brand visible-xs scrollto" href="#home"> <?= View::getVariable("title_site") ?></a>
					
				</div>
				
				<div id="site-nav" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="#services" class="scrollto"><?= View::getVariable("c_title") ?></a>
						</li>
                        <li>
                            <a href="#feat-project" class="scrollto"><?= View::getVariable("feat_title") ?></a>
                        </li>
                        <li>
                            <a href="#about" class="scrollto"><?= View::getVariable("about_title") ?></a>
                        </li>
						<li id="logo">
							<a href="#home" class="scrollto">
								<h1>A<span>F</span></h1>
							</a>
						</li>
                        <li>
                            <a href="#skills" class="scrollto"><?= View::getVariable("s_title") ?></a>
                        </li>
						<li>
							<a href="#portfolio" class="scrollto"><?= View::getVariable("p_title") ?></a>
						</li>
						<li>
							<a href="#contact" class="scrollto"><?= View::getVariable("contact_title") ?></a>
						</li>
					</ul>
				</div><!--End navbar-collapse -->
				
			</div><!--End container -->
			
		</div><!--End main-nav -->
		
		<!-- ==============================================
		HEADER
		=============================================== -->
		<header id="home" class="jumbotron bg-image">
		
			<div class="container">
			
				<div class="row">
				
					<div class="col-sm-12 text-col text-center">
					
						<h1><?= View::getVariable("ban_title") ?></h1>
						<p><?= View::getVariable("ban_subtitle") ?></p>
						
					</div>
				
				</div>
			
			</div>
			
		</header><!--End header -->
			
		<!-- ==============================================
		SERVICES
		=============================================== -->
		<section id="services" class="white-bg padding-top-bottom">
		
			<div class="container">
				
				<header class="section-header text-center">
				
					<h1 class="scrollimation scale-in"><?= View::getVariable("c_title") ?></h1>
					<p><?= View::getVariable("c_desc") ?></p>
				
				</header>
			
				<div class="row services">
				
				   <?= $competences ?>
				
				</div>
			
			</div>
		
		</section>
		
		<!-- ==============================================
		FEATURED PROJECT
		=============================================== -->	
		<section id="feat-project" class="gray-bg padding-top">
		
			<div class="container">
			
				<header class="section-header text-center">
				
					<h1 class="scrollimation scale-in"><?= View::getVariable("mp_title"); ?></h1>
					<p><?= View::getVariable("mp_desc") ?></p>
				</header>
				
				<?= $moment ?>
				
			</div>
		
		</section>
		
		
		<!-- ==============================================
		ABOUT
		=============================================== -->	
		<section id="about" class="dark-bg light-typo padding-top-bottom">
            <?= $about; ?>
		</section>
		<!-- ==============================================
		SKILLS
		=============================================== -->	
		<section id="skills" class="white-bg">
		
			<div class="container">
			
				<div class="row skills">
					<h1 class="text-center scrollimation fade-in"> <?= View::getVariable("s_title") ?></h1>
                    <p>
                        <?= View::getVariable("s_desc") ?>
                    </p>
                    <?= $skills; ?>
				</div><!--End row -->
			
			</div>
		
		
		</section>
 		<!-- ==============================================
		PORTFOLIO
		=============================================== -->	
		<section id="portfolio" class="gray-bg padding-top-bottom">
			
			<div class="container">
			
				<header class="section-header text-center">
				
					<h1 class="scrollimation scale-in"><?= View::getVariable("p_title") ?></h1>
					<p>
                        <?= View::getVariable("p_desc") ?>
                    </p>
				
				</header>
				
				<!--==== Portfolio Filters ====-->
				<div id="filter-works">
					<ul>
						<li class="active scrollimation fade-right d1">
							<a href="#" data-filter="*">All</a>
						</li>
                        <?= $types ?>
					</ul>
				</div><!--End portfolio filters -->
				
			</div><!--End portfolio header -->
			
			<div class="container masonry-wrapper scrollimation fade-in">
			
				<div id="projects-container">

                    <?= $projects ?>
										
				</div><!-- End projects --> 
				
			</div><!-- End container --> 
			
			<!-- ==============================================
			PROJECT PREVIEW MODAL (Do not alter this markup)
			=============================================== -->	
			<div id="project-modal" class="modal fade">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<div class="container">

								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

								<h1 id="hdr-title" class="text-center"></h1>
								<div class="row">
									<div class="col-md-8 col-md-offset-2">
										<div class="image-wrapper">
											<img class="img-responsive" src="<?= WEB_SITE ?>/assets/chrome.png" alt="">
											<div class="loader"></div>
											<div class="screen"></div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="modal-body">
							<div class="container">
								<div class="row">
									<div id="project-sidebar" class="col-md-3">
										<h2 id="sdbr-title"></h2>
										<p id="sdbr-category"></p>
										<p id="sdbr-date"></p>
										<p id="sdbr-technology"></p>
										<p id="sdbr-link"><a href="#link" target="_blank"></a></p>
										<p id="sdbr-descr"></p>
									</div>
									<div id="project-content" class="col-md-8 col-md-offset-1">
									</div>
								</div>
								
							</div>
						</div><!-- End modal-body -->
						
					</div><!-- End modal-content -->
					
				</div><!-- End modal-dialog -->
				
			</div><!-- End modal -->
			
		</section>

		<!-- ==============================================
		CONTACT
		=============================================== -->	
		<section id="contact" class="dark-bg light-typo padding-top">
		
			<div class="container">
			
				<header class="section-header text-center">
				
					<h1 class="scrollimation scale-in"> <?= View::getVariable("contact_title") ?></h1>
					<p> <?= View::getVariable("contact_desc") ?></p>
				
				</header>
				
				<form  id="contact-form" class="bl_form text-center" action="<?= Tools::generLinkControllerAction("Contact","send"); ?>" method="post" novalidate>
					<span class="field-wrap scrollimation fade-right">
						<label class="control-label" for="contact-name">Name</label>
						<input id="contact-name" name="contactName" type="text" class="label_better requiredField" data-new-placeholder="Name" placeholder="Name" data-error-empty="*Enter your name">
					</span>
					<span class="field-wrap scrollimation fade-in">
						<label class="control-label" for="contact-mail">Email</label>
						<input id="contact-mail" name="email" type="email" class="label_better requiredField" data-new-placeholder="Email Address" placeholder="Email Address" data-error-empty="*Enter your email" data-error-invalid="x Invalid email address">
					</span>
                    <p style="margin:0"><label for="contact-message">Message</label></p>
						<textarea id="contact-message" name="comments" rows="1" class="requiredField" data-new-placeholder="Message" placeholder="Message" data-error-empty="*Enter your message"></textarea>
					</p>
					
					<p class="text-center"><button  name="submit" type="submit" class="btn btn-meflat icon-left" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent"><i class="fa fa-paper-plane"></i>Send Message</button></p>
					<input type="hidden" name="submitted" id="submitted" value="true" />
					
				</form>
				
			</div>
		
		</section>
		
		<!-- ==============================================
		FOOTER
		=============================================== -->	
		
		<footer id="main-footer" class="dark-bg light-typo">
		
			<div class="container">
			
				<hr>
				
				<div class="row">
				
					<div class="col-sm-6">
						<ul class="social-links">
							<li class="scrollimation fade-right d4"><a target="_blank" href="<?= View::getVariable("link_twitter"); ?>"><i class="fa fa-twitter fa-fw"></i></a></li>
                            <li class="scrollimation fade-right"><a target="_blank" href="<?= View::getVariable("link_linkdin"); ?>"><i class="fa fa-linkedin fa-fw"></i></a></li>
                            <li class="scrollimation fade-right d2"><a target="_blank" href="<?= View::getVariable("link_youtube"); ?>"><i class="fa fa-youtube fa-fw"></i></a></li>
                        </ul>
					</div>
					
					<div class="col-sm-6 text-right">
                        <p>
                            2017 Managed Portfolio v1 by <a target="_blank" href="#"> Antoine Falais</a><br />
                            2014 Me Flat Theme by <a target="_blank" href="http://q-themes.net/">Qthemes</a><br />
                            Imaginer. Créer. <a target="_blank" href="http://cybersoftcreation.fr/">CyberSoftCreation.fr</a><br />
                        </p>
                    </div>
					
				</div>
				
			</div>
			
		</footer>
		
		
		
		<!-- ==============================================
		SCRIPTS
		=============================================== -->	
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script  src="<?= JS_PATH ?>/libs/jquery-1.9.1.min.js">\x3C/script>')</script>
		
		<script  src="<?= JS_PATH ?>/libs/bootstrap.min.js"></script>
		<script src='<?= JS_PATH ?>/jquery.easing.1.3.min.js'></script>
		<script src='<?= JS_PATH ?>/jquery.scrollto.js'></script>
		<script  src="<?= JS_PATH ?>/jquery.fittext.js"></script>
		<script src='<?= JS_PATH ?>/jquery.flexslider.min.js'></script>
		<script src='<?= JS_PATH ?>/jquery.masonry.js'></script>
		<script  src="<?= JS_PATH ?>/waypoints.min.js"></script>
		<script  src="<?= JS_PATH ?>/jquery.label_better.min.js"></script>
		<script  src="<?= JS_PATH ?>/jquery.easypiechart.js"></script>
		<script  src="<?= JS_PATH ?>/contact.js"></script>
		<script  src="<?= JS_PATH ?>/meflat.js"></script>
		
	</body>
	
</html>