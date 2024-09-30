@extends('frontend.app')
@section('content') 
 <!-- Main Wrapper-->
 <main class="wrapper">
            <!-- Page Header -->
            <div class="wptb-page-heading" style="background-image: url({{ asset('frontend/assets/img/background/page-header-bg.jpg') }});">
                <div class="container">
                    <div class="wptb-item--inner">
                        <h2 class="wptb-item--title ">Contact Us</h2>
                        <div class="wptb-breadcrumb-wrap">
                            <ul class="wptb-breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Pages</a></li>
                                <li><span>Contact Us</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Us -->
            <section class="wptb-contact-page-wrapper">
				<div class="container">
                    <div class="wptb-contact-infos">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="wptb-image-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <img src="{{ asset('frontend/assets/img/more/4.jpg') }}" alt="img">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <div class="wptb-item--icon">
                                                <img src="{{ asset('frontend/assets/img/more/mail.png') }}" alt="icon">
                                            </div>
                                            <h4 class="wptb-item--title">Send Us Mail</h4>
                                            <p class="wptb-item--description"> 
                                                <a href="mailto:immgway.care@email.com">immgway.care@email.com</a> <br>
                                                <a href="mailto:info.immigway@email.com">info.immigway@email.com</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="wptb-image-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <img src="{{ asset('frontend/assets/img/more/5.jpg') }}" alt="img">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <div class="wptb-item--icon">
                                                <img src="{{ asset('frontend/assets/img/more/phone.png') }}" alt="icon">
                                            </div>
                                            <h4 class="wptb-item--title">Call Us Anytime</h4>
                                            <p class="wptb-item--description"> 
                                                <a href="tel:+98765432122811">(+987) 654 321 228 11</a> <br>
                                                <a href="tel:+98765432122814">(+987) 654 321 228 14</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="wptb-image-box1 wow fadeInLeft">
                                    <div class="wptb-item--inner">
                                        <div class="wptb-item--image">
                                            <img src="{{ asset('frontend/assets/img/more/6.jpg') }}" alt="img">
                                        </div>
                                        <div class="wptb-item--holder">
                                            <div class="wptb-item--icon">
                                                <img src="{{ asset('frontend/assets/img/more/map-pin.png') }}" alt="icon">
                                            </div>
                                            <h4 class="wptb-item--title">Visit Our Office</h4>
                                            <p class="wptb-item--description"> 28 Street, New York City <br>
                                                Untes States of America</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="location">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.387339261327!2d90.50713057602188!3d23.6978580907902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b6939ae1535f%3A0xf11e79056abaab12!2sChittagong%20Road%20Bus%20Stop!5e0!3m2!1sen!2sbd!4v1727613991614!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
					
					<div class="wptb-contact-form-one">
                        <div class="wptb-form--wrapper">
                            <div class="row">
                                <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1">
                                    <form class="wptb-form" action="https://wpthemebooster.com/demo/themeforest/html/immigway/contact.php" method="post">
                                        <div class="wptb-form--inner">
                                            <div class="wptb-heading">
                                                <div class="wptb-item--inner text-center">
                                                    <h2 class="wptb-item--title"> <span>Drop Us A line</span></h2>
                                                    <p class="wptb-item--description"> Immigway Visa Agency will help you to solve your problem</p>
                                                </div>
                                            </div>
        
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control" placeholder="Name*" required>
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <input type="number" name="phone" class="form-control" placeholder="Phone No">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-control" placeholder="E-mail*" required>
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <div class="form-group">
                                                        <input type="text" name="subject" class="form-control" placeholder="Subject">
                                                    </div>
                                                </div>
        
                                                <div class="col-md-12 col-lg-12 mb-4">
                                                    <div class="form-group">
                                                        <textarea name="message" class="form-control" placeholder="Text"></textarea>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="wptb-item--button text-center">
                                                        <input class="btn" type="submit" value="Contact Us" name="submit">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>					
				</div>
			</section>

            <!-- Newsletter -->
            <div class="wptb-newsletter bg-image" style="background-image: url({{ asset('frontend/assets/img/background/bg-16.jpg') }});">
                <div class="container">
                    <div class="wptb-item--inner">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <h1 class="wptb-item--title wow fadeInLeft">Subscribe To Immigway
                                    For All the offers</h1>
                            </div>
                            <div class="col-md-6">
                                <form class="newsletter-form" method="post">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                    </div>
                                    <button type="submit" class="btn-readmore style-icon">
                                        <span class="btn-readmore--icon"> <i class="bi bi-send"></i> </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @endsection