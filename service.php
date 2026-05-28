<?php
$page_title   = 'Titus Tuitoek — Property Buyers Agent Services Perth';
$current_page = 'service';
include_once 'includes/header.php';
?>
<style>
/* Service page — dark theme scoped override */
body{background:#030e1f!important}
.boxed_wrapper{background:#030e1f!important}
.page-title .bg-layer{filter:brightness(.25) saturate(.6)}
.page-title .title-box h2{color:#fff!important;font-family:'Quicksand',sans-serif!important;letter-spacing:.04em}
/* Why choose us */
.about-style-three{background:#071c35!important;padding:100px 0}
.about-style-three .sec-title h2{color:#fff!important}
.about-style-three .sec-title h2 span{color:#9aab88!important}
.about-style-three .sec-title .sub-title{color:#6B705C!important}
.about-style-three .content-box .text p{color:rgba(255,255,255,.72)!important}
.about-style-three .theme-btn{background:#6B705C!important;color:#fff!important}
/* Service cards */
.service-style-two{background:#0d2547!important}
.service-style-two .sec-title h2{color:#fff!important}
.service-style-two .sec-title h2 span{color:#9aab88!important}
.service-style-two .sec-title .sub-title{color:#6B705C!important}
.service-block-one .inner-box{
  background:rgba(255,255,255,.04)!important;
  border:1px solid rgba(107,112,92,.2)!important;
  border-radius:12px!important;transition:all .25s ease!important;
}
.service-block-one .inner-box:hover{
  background:rgba(107,112,92,.1)!important;
  border-color:rgba(107,112,92,.4)!important;
  transform:translateY(-5px)!important;
  box-shadow:0 16px 40px rgba(0,0,0,.4)!important;
}
.service-block-one h4{color:#fff!important}
.service-block-one p{color:rgba(255,255,255,.65)!important}
/* Packages */
.service-section{background:#071c35!important;padding:100px 0}
.service-section .sec-title h2{color:#fff!important}
.service-section .sec-title h2 span{color:#9aab88!important}
.service-section .sec-title .sub-title{color:#6B705C!important}
.package-inner-box{
  background:rgba(255,255,255,.04)!important;
  border:1px solid rgba(107,112,92,.18)!important;
  border-radius:16px!important;
  box-shadow:0 8px 32px rgba(0,0,0,.4)!important;
}
.package-inner-box h4{color:#fff!important}
.check-list li{color:rgba(255,255,255,.78)!important}
.check-list li i{color:#6B705C!important}
.cta-bottom .theme-btn,.package-inner-box .theme-btn{
  background:#6B705C!important;color:#fff!important;border-radius:8px!important;
}
.cta-bottom .theme-btn:hover,.package-inner-box .theme-btn:hover{
  background:#9aab88!important;
}
</style>

<!-- page-title -->
<section class="page-title centred">
    <div class="outer-container">
        <div class="bg-layer" style="background-image: url(assets/images/tito/custom2.jpg);"></div>
        <div class="large-container">
            <div class="title-box">
                <h2>Our Property Buying Services</h2>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="about-style-three">
    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-7.png);"></div>
    <div class="large-container">
        <div class="row clearfix">
            <div class="col-lg-5 col-md-12 col-sm-12 content-column">
                <div class="content-box">
                    <div class="sec-title">
                        <span class="sub-title">Why Choose Us</span>
                        <h2>Expert Property <span>Buying Support <br>in Perth</span></h2>
                    </div>
                    <div class="text">
                        <p>At Titus Tuitoek Buyers Agency, we understand that purchasing property is one of the biggest financial decisions you'll make. Our team of experienced property experts is dedicated to guiding you through every step of the buying process, ensuring you secure the right property at the right price.</p>
                        <p>With deep local knowledge of Perth's real estate market and extensive industry connections, we provide personalised service tailored to your specific needs and budget. Let us take the stress out of property hunting so you can focus on what matters most — finding your perfect home or investment.</p>
                        <a href="about.php" class="theme-btn btn-one">Learn More About Us</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 image-column">
                <div data-animation-box class="image-box">
                    <figure data-animation-text class="overlay-anim-white-bg image image-1" data-animation="overlay-animation">
                        <img src="assets/images/tito/custom3.jpg" alt="Perth Property Inspection">
                    </figure>
                    <figure data-animation-text class="overlay-anim-white-bg image image-2" data-animation="overlay-animation">
                        <img src="assets/images/tito/custom2.jpg" alt="Property Consultation">
                    </figure>
                    <div class="icon-box"><img src="assets/images/icons/icon-8.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="service-style-two centred">
    <div class="bg-layer parallax-bg" data-parallax='{"y": 100}' style="background-image: url(assets/images/tito/custom1.jpg);"></div>
    <div class="large-container">
        <div class="sec-title">
            <span class="sub-title">Our Services</span>
            <h2>Comprehensive <span>Buyers Advocacy</span></h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-2.png" alt="Full Buying Service"></div>
                        <h4>Full Buying Service</h4>
                        <p>End-to-end property acquisition support from initial consultation through to settlement, handling everything for busy professionals and investors.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-3.png" alt="Property Search"></div>
                        <h4>Property Search</h4>
                        <p>Targeted property search based on your specific criteria, with exclusive access to off-market opportunities not available to the general public.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-4.png" alt="Property Evaluation"></div>
                        <h4>Property Evaluation</h4>
                        <p>Comprehensive assessment of property value, condition, and investment potential to ensure you make informed decisions and avoid costly mistakes.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-5.png" alt="Negotiation"></div>
                        <h4>Negotiation &amp; Bidding</h4>
                        <p>Expert negotiation with selling agents or vendors to secure properties at the best possible price, often below market value for instant equity.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-9.png" alt="Auction Representation"></div>
                        <h4>Auction Representation</h4>
                        <p>Strategic auction bidding by experienced professionals who understand auction dynamics, giving you a competitive edge in high-pressure situations.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-10.png" alt="Due Diligence"></div>
                        <h4>Due Diligence</h4>
                        <p>Thorough investigation of property titles, council regulations, zoning, and potential issues to protect your investment and avoid future complications.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-11.png" alt="Investment Strategy"></div>
                        <h4>Investment Strategy</h4>
                        <p>Personalised property investment strategies aligned with your financial goals, focusing on growth areas and properties with strong rental yields.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-12.png" alt="Settlement Support"></div>
                        <h4>Settlement Support</h4>
                        <p>Expert guidance through the final stages of property acquisition, coordinating with conveyancers and lenders to ensure a smooth settlement process.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Packages -->
<section class="service-section service-page centred">
    <div class="large-container">
        <div class="sec-title">
            <span class="sub-title">Service Packages</span>
            <h2>Choose Your <span>Service Level</span></h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box package-inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-2.png" alt="Premium Package"></div>
                        <h4>Premium Package</h4>
                        <ul class="check-list">
                            <li><i class="far fa-check-circle"></i> Full end-to-end buying service</li>
                            <li><i class="far fa-check-circle"></i> Unlimited property inspections</li>
                            <li><i class="far fa-check-circle"></i> Expert auction bidding</li>
                            <li><i class="far fa-check-circle"></i> Comprehensive due diligence</li>
                            <li><i class="far fa-check-circle"></i> Priority access to off-market properties</li>
                            <li><i class="far fa-check-circle"></i> Full settlement coordination</li>
                        </ul>
                        <div class="cta-bottom">
                            <a href="contact.php" class="theme-btn btn-one">Enquire Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="inner-box package-inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-3.png" alt="Standard Package"></div>
                        <h4>Standard Package</h4>
                        <ul class="check-list">
                            <li><i class="far fa-check-circle"></i> Property search and shortlisting</li>
                            <li><i class="far fa-check-circle"></i> Up to 8 property inspections</li>
                            <li><i class="far fa-check-circle"></i> Property evaluation reports</li>
                            <li><i class="far fa-check-circle"></i> Negotiation on your behalf</li>
                            <li><i class="far fa-check-circle"></i> Basic due diligence</li>
                            <li><i class="far fa-check-circle"></i> Settlement guidance</li>
                        </ul>
                        <div class="cta-bottom">
                            <a href="contact.php" class="theme-btn btn-one">Enquire Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                <div class="service-block-one wow slideInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <div class="inner-box package-inner-box">
                        <div class="icon-box"><img src="assets/images/icons/icon-4.png" alt="Auction Package"></div>
                        <h4>Auction Package</h4>
                        <ul class="check-list">
                            <li><i class="far fa-check-circle"></i> Pre-auction property assessment</li>
                            <li><i class="far fa-check-circle"></i> Market value determination</li>
                            <li><i class="far fa-check-circle"></i> Auction bidding strategy</li>
                            <li><i class="far fa-check-circle"></i> Professional auction representation</li>
                            <li><i class="far fa-check-circle"></i> Post-auction negotiation</li>
                            <li><i class="far fa-check-circle"></i> Contract review assistance</li>
                        </ul>
                        <div class="cta-bottom">
                            <a href="contact.php" class="theme-btn btn-one">Enquire Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
