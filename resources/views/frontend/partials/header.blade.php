<body>    
<!-- Preloader -->
<div id="preloader">
    <div class="preloader-inner">
        <div class="spinner"></div>
        <div class="loading-text">
            <span data-preloader-text="P" class="characters">P</span>
            
            <span data-preloader-text="E" class="characters">E</span>
            
            <span data-preloader-text="N" class="characters">N</span>
            
            <span data-preloader-text="C" class="characters">C</span>
            
            <span data-preloader-text="I" class="characters">I</span>

            <span data-preloader-text="L" class="characters">L</span>           
        </div>
    </div>
</div>

<header class="header">
            <!-- Top Bar -->
            <div class="header-top">
                <div class="container">
                    <div class="d-none d-xl-flex justify-content-between align-items-center flex-wrap">
                        <!-- Left Box -->
                        <div class="left-box d-flex align-items-center">
                            <!-- Social Box -->
                            <div class="social-box">
                                <ul>
                                @foreach($social_items as $item)
                                    <li><a href="{{ $item->link }}" class="{{ $item->icon }}"></a></li>                                   
                                @endforeach
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Right Box -->
                        <div class="right-box d-flex align-items-center">

                            <ul class="info-list">
                                <li><a href="{{ getInfo('email') }}"><span class="icon bi bi-envelope-fill"></span>{{ getInfo('email') }}</a></li>
                                <li><a href="#"><span class="icon bi bi-geo-alt-fill"></span>{{ getInfo('address') }}</a></li>
                            </ul>

                            <!-- Button Box -->
                            <div class="button-box">
                                <a href="tel:+176845399" class="btn active clearfix">
                                
                                    <span><img src="{{ asset('public/frontend/assets/img/icon_chat.png') }}" alt="chat icon"></span>
                                    <span class="btn-wrap">
                                        <span class="text-first">{{ getInfo('contact') }}</span>
                                        <span class="text-second">{{ getInfo('contact') }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lower Bar -->
            <div class="header-inner">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-between">
                        <!-- Left Part -->
                        <div class="header_left_part d-flex align-items-center">
                            <div class="logo">
                                <a href="{{ route('front.home') }}" class="light_logo">                                    
                                    <img src="{{ getImage('settings',getInfo('logo'))}}" alt="" class="img-fluid side_logo">
                                </a>
                            </div>
                        </div>

                        <!-- Right Part -->
                        <div class="header_right_part d-flex align-items-center">
                            <div class="mainnav d-none d-xl-block">
                                <ul class="main-menu">
                                    <li class="menu-item menu-item-has-children"><a href="#">Home</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="index.html">Home One</a></li>
                                            <li class="menu-item"><a href="index-2.html">Home Two</a></li>
                                            <li class="menu-item"><a href="index-3.html">Home Three</a></li>
                                            <li class="menu-item"><a href="index-4.html">Home Four</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children"><a href="#">Pages</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="about.html">About Us</a></li>
                                            <li class="menu-item menu-item-has-children"><a href="#">Country</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="country-list-1.html">Country List One</a></li>
                                                    <li class="menu-item"><a href="country-list-2.html">Country List Two</a></li>
                                                    <li class="menu-item"><a href="country-details.html">Country Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children"><a href="#">Case Studies</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="case.html">Case List</a></li>
                                                    <li class="menu-item"><a href="case-details.html">Case Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item menu-item-has-children"><a href="#">Our Team</a>
                                                <ul class="sub-menu">
                                                    <li class="menu-item"><a href="team-1.html">Team Grid One</a></li>
                                                    <li class="menu-item"><a href="team-2.html">Team Grid Two</a></li>
                                                    <li class="menu-item"><a href="team-details.html">Team Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item"><a href="price-table.html">Pricing</a></li>
                                            <li class="menu-item"><a href="careers.html">Careers</a></li>
                                            <li class="menu-item"><a href="appointments.html">Make Appointment</a></li>
                                            <li class="menu-item"><a href="timeline.html">Timeline</a></li>
                                            <li class="menu-item"><a href="work-process.html">Work Process</a></li>
                                            <li class="menu-item"><a href="partners.html">Partners</a></li>
                                            <li class="menu-item"><a href="faq.html">FAQ's</a></li>
                                            <li class="menu-item"><a href="coming-soon.html">Coming Soon</a></li>
                                            <li class="menu-item"><a href="404.html">404 Error</a></li>
                                            <li class="menu-item"><a href="login.html">Login</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children"><a href="#">Visa</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="visa-list.html">Visa List</a></li>
                                            <li class="menu-item"><a href="tourist-visa.html">Tourist Visa</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children"><a href="#">Services</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="services-1.html">Service One</a></li>
                                            <li class="menu-item"><a href="services-2.html">Service Two</a></li>
                                            <li class="menu-item"><a href="service-details.html">Service Details</a></li>
                                        </ul>
                                    </li>                              
                                    <li class="menu-item menu-item-has-children"><a href="#">Blog</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="blog-grid.html">Blog Grid</a></li>
                                            <li class="menu-item"><a href="blog-list.html">Blog List</a></li>
                                            <li class="menu-item"><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-has-children"><a href="#">Contact</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item"><a href="{{ route('front.contact_us') }}">Contact One</a></li>
                                            <li class="menu-item"><a href="contact-2.html">Contact Two</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <div class="header_search">
                                <form class="search_form" action="https://wpthemebooster.com/demo/themeforest/html/immigway/search.php">
                                    <input type="text" name="search" class="keyword form-control" placeholder="Search..." />
                                    <button type="submit" class="form-control-submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>

                            <button class="aside_open">
                                <img src="{{ asset('public/frontend/assets/img/icon_grid.png') }}" alt="img">
                            </button>

                            <button type="button" class="mr_menu_toggle d-xl-none">
                                <i class="bi bi-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
			</div>
		</header>