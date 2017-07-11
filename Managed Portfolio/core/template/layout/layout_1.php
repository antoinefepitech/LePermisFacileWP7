<!DOCTYPE html>
<html lang="en-US" class="no-js">
	<head>

		<!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
		<title>Me Flat | Flat Personal Portfolio</title>
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
					<a class="navbar-brand visible-xs scrollto" href="#home">Jd</a>
					
				</div>
				
				<div id="site-nav" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="#services" class="scrollto">What I Do</a>
						</li>
						<li>
							<a href="#about" class="scrollto">About Me</a>
						</li>
						<li id="logo">
							<a href="#home" class="scrollto">
								<h1>J<span>D</span></h1>
							</a>
						</li>
						<li>
							<a href="#portfolio" class="scrollto">My Works</a>
						</li>
						<li>
							<a href="#contact" class="scrollto">Contact Me</a>
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
					
						<h1>Hi, I am John Doe</h1>
						<p>a visual and interaction designer</p>
						
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
				
					<h1 class="scrollimation scale-in">What I Do</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/> Aenean purus felis, condimentum et tempor in, commodo id nibh. Fusce a lacus arcu.</p>
				
				</header>
			
				<div class="row services">
				
					<div class="col-md-3 col-sm-6 item scrollimation fade-up">
					
						<div class="icon">
							<img class="img-responsive img-center" src="assets/service1.png" alt="" />
						</div>
						
						<h2>Web &amp; App Design</h2>
						<p>Donec quam velit, aliquam at tempor quis, blandit quis nisi. Proin orci enim, dictum vel leo eu, blandit vulputate turpis.</p>
					
					</div>
					
					<div class="col-md-3 col-sm-6 item scrollimation fade-up d1">
					
						<div class="icon">
							<img class="img-responsive img-center" src="assets/service2.png" alt="" />
						</div>
						
						<h2>Web Development</h2>
						<p>Donec quam velit, aliquam at tempor quis, blandit quis nisi. Proin orci enim, dictum vel leo eu, blandit vulputate turpis.</p>
					
					</div>
					
					<div class="col-md-3 col-sm-6 item scrollimation fade-up d2">
					
						<div class="icon">
							<img class="img-responsive img-center" src="assets/service3.png" alt="" />
						</div>
						
						<h2>SEO Content</h2>
						<p>Donec quam velit, aliquam at tempor quis, blandit quis nisi. Proin orci enim, dictum vel leo eu, blandit vulputate turpis.</p>
					
					</div>
					
					<div class="col-md-3 col-sm-6 item scrollimation fade-up d3">
					
						<div class="icon">
							<img class="img-responsive img-center" src="assets/service4.png" alt="" />
						</div>
						
						<h2>Mail Campaigns</h2>
						<p>Donec quam velit, aliquam at tempor quis, blandit quis nisi. Proin orci enim, dictum vel leo eu, blandit vulputate turpis.</p>
					
					</div>
				
				</div>
			
			</div>
		
		</section>
		
		<!-- ==============================================
		FEATURED PROJECT
		=============================================== -->	
		<section id="feat-project" class="gray-bg padding-top">
		
			<div class="container">
			
				<header class="section-header text-center">
				
					<h1 class="scrollimation scale-in">Featured Project</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/> Aenean purus felis, condimentum et tempor in, commodo id nibh. Fusce a lacus arcu.</p>
				
				</header>
				
				<div class="scrollimation fade-up">
					<img class="img-responsive img-center" src="assets/chrome-top.png" alt="" />
					
					<div class="img-wrapper">
						
						<img class="img-responsive img-center" src="assets/placeholder-800x500.jpg" alt="" />
						
						<p class="text-center on-hover"><a class="btn btn-meflat icon-right" href="#external">Visit Website<i class="fa fa-arrow-right"></i></a></p>
					
					</div>
				</div>
				
			</div>
		
		</section>
		
		
		<!-- ==============================================
		ABOUT
		=============================================== -->	
		<section id="about" class="dark-bg light-typo padding-top-bottom">
		
			<div class="container">
			
				<header class="section-header text-center">
				
					<h1 class="scrollimation scale-in">About Me</h1>
				
				</header>
				
				<div class="row">
				
					<div class="col-sm-8 col-sm-offset-2">
					
						<img class="img-responsive img-center img-circle scrollimation fade-left" src="assets/about.jpg" alt="" />
				
						<p class="text-center scrollimation fade-in">Cras convallis nunc vitae massa convallis fermentum. Fusce feugiat, sem at congue rutrum, nisl mauris facilisis tellus, vel interdum nulla enim at purus. Integer metus justo, pellentesque ac bibendum a, dapibus sed nisl. Donec vitae suscipit lacus. Vivamus lacinia nisi eget erat luctus, id mollis nunc molestie. </p>
					
					</div>
					
				</div>
					
				
				
				<p class="text-center"><a class="btn btn-meflat scrollto white icon-left" href="#contact"><i class="fa fa-arrow-down"></i>Hire Me</a></p>
				
			</div>
		
		</section>
		<!-- ==============================================
		SKILLS
		=============================================== -->	
		<section id="skills" class="white-bg">
		
			<div class="container">
			
				<div class="row skills">
					
					<h1 class="text-center scrollimation fade-in">I Got the Skills</h1>
					
					<div class="col-sm-6 col-md-3 text-center">
						<span class="chart" data-percent="80"><span class="percent">80</span></span>
						<h2 class="text-center">Web Design</h2>
					</div>
					<div class="col-sm-6 col-md-3 text-center">
						<span class="chart" data-percent="70"><span class="percent">70</span></span>
						<h2 class="text-center">HTML / CSS</h2>
					</div>
					<div class="col-sm-6 col-md-3 text-center">
						<span class="chart" data-percent="60"><span class="percent">60</span></span>
						<h2 class="text-center">Graphic Design</h2>
					</div>
					<div class="col-sm-6 col-md-3 text-center">
						<span class="chart" data-percent="90"><span class="percent">90</span></span>
						<h2 class="text-center">UI / UX</h2>
					</div>
					
				</div><!--End row -->
			
			</div>
		
		
		</section>
 		<!-- ==============================================
		PORTFOLIO
		=============================================== -->	
		<section id="portfolio" class="gray-bg padding-top-bottom">
			
			<div class="container">
			
				<header class="section-header text-center">
				
					<h1 class="scrollimation scale-in">My Works</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/> Aenean purus felis, condimentum et tempor in, commodo id nibh. Fusce a lacus arcu.</p>
				
				</header>
				
				<!--==== Portfolio Filters ====-->
				<div id="filter-works">
					<ul>
						<li class="active scrollimation fade-right d1">
							<a href="#" data-filter="*">All</a>
						</li>
						<li class="scrollimation fade-right">
							<a href="#" data-filter=".web-design">Web Design</a>
						</li>
						<li class="scrollimation fade-left">
							<a href="#" data-filter=".icons">Icons</a>
						</li>
						<li class="scrollimation fade-left d1">
							<a href="#" data-filter=".ui-kits">UI Kits</a>
						</li>
					</ul>
				</div><!--End portfolio filters -->
				
			</div><!--End portfolio header -->
			
			<div class="container masonry-wrapper scrollimation fade-in">
			
				<div id="projects-container">
				
					<!-- ==============================================
					SINGLE PROJECT ITEM
					=============================================== -->	
					<article class="project-item web-design">
						
						<img class="img-responsive project-image" src="assets/placeholder-320x210.jpg"  alt=""><!--Project thumb -->
						
						<div class="hover-mask">
							<h2 class="project-title">Project Title</h2><!--Project Title -->
							<p>Subtitle</p><!--Project Subtitle -->
						</div>
						
						<!--==== Project Preview HTML ====-->
						
						<div class="sr-only project-description" 
							data-category="Category" 
							data-date="Date" 
							data-client="Client" 
							data-link="www.example.com,http://www.google.com" 
							data-descr="A small description goes here." 
							data-images="assets/placeholder-750x430.jpg,assets/placeholder-750x430.jpg"
						>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							<p>Nam eget urna pellentesque nisl ultrices dapibus. Mauris accumsan vehicula nisl, sed tempus mauris facilisis eu. Donec a iaculis nisi, quis malesuada justo. Pellentesque ut enim sit amet ipsum dignissim egestas. Morbi tincidunt rhoncus urna eget placerat.</p>
							<p class="text-right"><a class="btn btn-meflat icon-right" href="#external-link">Visit Website<i class="fa fa-arrow-right"></i></a></p>
						</div>
						
					</article>
					<!-- ==============================================
					END PROJECT ITEM
					=============================================== -->						
					
					<article class="project-item icons">
						
						<img class="img-responsive project-image" src="assets/placeholder-320x210.jpg"  alt=""><!--Project thumb -->
						
						<div class="hover-mask">
							<h2 class="project-title">Project Title</h2><!--Project Title -->
							<p>Subtitle</p><!--Project Subtitle -->
						</div>
						
						<!--==== Project Preview HTML ====-->
						
						<div class="sr-only project-description" 
							data-category="Category" 
							data-date="Date" 
							data-client="Client" 
							data-link="www.example.com,http://www.google.com" 
							data-descr="A small description goes here." 
							data-images="assets/placeholder-750x430.jpg,assets/placeholder-750x430.jpg"
						>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							<p>Nam eget urna pellentesque nisl ultrices dapibus. Mauris accumsan vehicula nisl, sed tempus mauris facilisis eu. Donec a iaculis nisi, quis malesuada justo. Pellentesque ut enim sit amet ipsum dignissim egestas. Morbi tincidunt rhoncus urna eget placerat.</p>
							<p class="text-right"><a class="btn btn-meflat icon-right" href="#external-link">Visit Website<i class="fa fa-arrow-right"></i></a></p>
						</div>
						
					</article><!--End Project Item -->

					<article class="project-item web-design">
						
						<img class="img-responsive project-image" src="assets/placeholder-320x210.jpg"  alt=""><!--Project thumb -->
						
						<div class="hover-mask">
							<h2 class="project-title">Project Title</h2><!--Project Title -->
							<p>Subtitle</p><!--Project Subtitle -->
						</div>
						
						<!--==== Project Preview HTML ====-->
						
						<div class="sr-only project-description" 
							data-category="Category" 
							data-date="Date" 
							data-client="Client" 
							data-link="www.example.com,http://www.google.com" 
							data-descr="A small description goes here." 
							data-images="assets/placeholder-750x430.jpg,assets/placeholder-750x430.jpg"
						>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							<p>Nam eget urna pellentesque nisl ultrices dapibus. Mauris accumsan vehicula nisl, sed tempus mauris facilisis eu. Donec a iaculis nisi, quis malesuada justo. Pellentesque ut enim sit amet ipsum dignissim egestas. Morbi tincidunt rhoncus urna eget placerat.</p>
							<p class="text-right"><a class="btn btn-meflat icon-right" href="#external-link">Visit Website<i class="fa fa-arrow-right"></i></a></p>
						</div>
						
					</article><!--End Project Item -->

					<article class="project-item icons">
						
						<img class="img-responsive project-image" src="assets/placeholder-320x210.jpg"  alt=""><!--Project thumb -->
						
						<div class="hover-mask">
							<h2 class="project-title">Project Title</h2><!--Project Title -->
							<p>Subtitle</p><!--Project Subtitle -->
						</div>
						
						<!--==== Project Preview HTML ====-->
						
						<div class="sr-only project-description" 
							data-category="Category" 
							data-date="Date" 
							data-client="Client" 
							data-link="www.example.com,http://www.google.com" 
							data-descr="A small description goes here." 
							data-images="assets/placeholder-750x430.jpg,assets/placeholder-750x430.jpg"
						>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							<p>Nam eget urna pellentesque nisl ultrices dapibus. Mauris accumsan vehicula nisl, sed tempus mauris facilisis eu. Donec a iaculis nisi, quis malesuada justo. Pellentesque ut enim sit amet ipsum dignissim egestas. Morbi tincidunt rhoncus urna eget placerat.</p>
							<p class="text-right"><a class="btn btn-meflat icon-right" href="#external-link">Visit Website<i class="fa fa-arrow-right"></i></a></p>
						</div>
						
					</article><!--End Project Item -->

					<article class="project-item ui-kits">
						
						<img class="img-responsive project-image" src="assets/placeholder-320x210.jpg"  alt=""><!--Project thumb -->
						
						<div class="hover-mask">
							<h2 class="project-title">Project Title</h2><!--Project Title -->
							<p>Subtitle</p><!--Project Subtitle -->
						</div>
						
						<!--==== Project Preview HTML ====-->
						
						<div class="sr-only project-description" 
							data-category="Category" 
							data-date="Date" 
							data-client="Client" 
							data-link="www.example.com,http://www.google.com" 
							data-descr="A small description goes here." 
							data-images="assets/placeholder-750x430.jpg,assets/placeholder-750x430.jpg"
						>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							<p>Nam eget urna pellentesque nisl ultrices dapibus. Mauris accumsan vehicula nisl, sed tempus mauris facilisis eu. Donec a iaculis nisi, quis malesuada justo. Pellentesque ut enim sit amet ipsum dignissim egestas. Morbi tincidunt rhoncus urna eget placerat.</p>
							<p class="text-right"><a class="btn btn-meflat icon-right" href="#external-link">Visit Website<i class="fa fa-arrow-right"></i></a></p>
						</div>
						
					</article><!--End Project Item -->

					<article class="project-item ui-kits">
						
						<img class="img-responsive project-image" src="assets/placeholder-320x210.jpg"  alt=""><!--Project thumb -->
						
						<div class="hover-mask">
							<h2 class="project-title">Project Title</h2><!--Project Title -->
							<p>Subtitle</p><!--Project Subtitle -->
						</div>
						
						<!--==== Project Preview HTML ====-->
						
						<div class="sr-only project-description" 
							data-category="Category" 
							data-date="Date" 
							data-client="Client" 
							data-link="www.example.com,http://www.google.com" 
							data-descr="A small description goes here." 
							data-images="assets/placeholder-750x430.jpg,assets/placeholder-750x430.jpg"
						>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl dapibus eu.</p>
							<p>Nam eget urna pellentesque nisl ultrices dapibus. Mauris accumsan vehicula nisl, sed tempus mauris facilisis eu. Donec a iaculis nisi, quis malesuada justo. Pellentesque ut enim sit amet ipsum dignissim egestas. Morbi tincidunt rhoncus urna eget placerat.</p>
							<p class="text-right"><a class="btn btn-meflat icon-right" href="#external-link">Visit Website<i class="fa fa-arrow-right"></i></a></p>
						</div>
						
					</article><!--End Project Item -->
						
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
											<img class="img-responsive" src="assets/chrome.png" alt="">
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
										<p id="sdbr-client"></p>
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
		DRIBBLE 
		=============================================== -->	
		<section id="dribbble">
			<h1 class="dribbble-button"><a href="#" target="_blank">My Dribbble Shots</a></h1>
				<div class="row">
					<div class="col-md-2 col-sm-4 col-xs-6">
						<a href="#link" target="_blank"><img class="img-responsive" src="assets/placeholder-375x250.jpg"  alt=""></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<a href="#link" target="_blank"><img class="img-responsive" src="assets/placeholder-375x250.jpg"  alt=""></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<a href="#link" target="_blank"><img class="img-responsive" src="assets/placeholder-375x250.jpg"  alt=""></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<a href="#link" target="_blank"><img class="img-responsive" src="assets/placeholder-375x250.jpg"  alt=""></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<a href="#link" target="_blank"><img class="img-responsive" src="assets/placeholder-375x250.jpg"  alt=""></a>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<a href="#link" target="_blank"><img class="img-responsive" src="assets/placeholder-375x250.jpg"  alt=""></a>
					</div>
				</div>
		</section>
		<!-- ==============================================
		CONTACT
		=============================================== -->	
		<section id="contact" class="dark-bg light-typo padding-top">
		
			<div class="container">
			
				<header class="section-header text-center">
				
					<h1 class="scrollimation scale-in">Drop Me a Line</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/> Aenean purus felis, condimentum et tempor in, commodo id nibh. Fusce a lacus arcu.</p>
				
				</header>
				
				<form  id="contact-form" class="bl_form text-center" action="contact.php" method="post" novalidate>
					<span class="field-wrap scrollimation fade-right">
						<label class="control-label" for="contact-name">Name</label>
						<input id="contact-name" name="contactName" type="text" class="label_better requiredField" data-new-placeholder="Name" placeholder="Name" data-error-empty="*Enter your name">
					</span>
					<span class="field-wrap scrollimation fade-in">
						<label class="control-label" for="contact-mail">Email</label>
						<input id="contact-mail" name="email" type="email" class="label_better requiredField" data-new-placeholder="Email Address" placeholder="Email Address" data-error-empty="*Enter your email" data-error-invalid="x Invalid email address">
					</span>
					<span class="field-wrap scrollimation fade-left">
						<label class="control-label" for="contact-message">Message</label>
						<textarea id="contact-message" name="comments" rows="1" class="label_better requiredField" data-new-placeholder="Message" placeholder="Message" data-error-empty="*Enter your message"></textarea>
					</span>
					
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
							<li class="scrollimation fade-right d4"><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
							<li class="scrollimation fade-right d3"><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
							<li class="scrollimation fade-right d2"><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
							<li class="scrollimation fade-right d1"><a href="#link"><i class="fa fa-dribbble fa-fw"></i></a></li>
							<li class="scrollimation fade-right"><a href="#link"><i class="fa fa-linkedin fa-fw"></i></a></li>
						</ul>
					</div>
					
					<div class="col-sm-6 text-right">
						<p>&copy;2014 Me Flat Theme by <a href="http://q-themes.net/">Qthemes</a></p>
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