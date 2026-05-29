<?php
$page_title   = 'About Titus Tuitoek — Perth Property Buyers Agent';
$current_page = 'about';
include_once 'includes/header.php';
?>
<style>
/* About page — dark theme scoped override */
body{background:#1e3208!important}
.boxed_wrapper{background:#1e3208!important}
.about-hero{background-size:cover;background-position:center}
.about-hero::before{background:linear-gradient(135deg,rgba(3,14,31,.9) 0%,rgba(3,14,31,.65) 100%)}
.about-hero h1,.about-hero p{color:#fff!important}
.about-hero .theme-btn{background:#6B705C!important;color:#fff!important}
.about-company{background:#2a4509!important;padding:100px 0}
.about-company .sec-title h2,.about-company .sec-title h2 span,.sec-title h2 span{color:#9aab88!important}
.about-company .sec-title .sub-title{color:#6B705C!important}
.about-company .text p,.about-company .text ul li{color:rgba(255,255,255,.75)!important}
.about-company .image-box::before{background:#6B705C!important}
.about-values{background:#385c10!important}
.about-values .value-item h4{color:#fff!important}
.about-values .value-item p{color:rgba(255,255,255,.65)!important}
.about-values .value-item .icon{background:#6B705C!important;color:#fff!important}
.about-values .value-item:hover{background:rgba(107,112,92,.12)!important}
.about-titus{background:#1e3208!important}
.about-titus .content-column .text p{color:rgba(255,255,255,.72)!important}
.about-titus .content-column .text p.highlight{border-left:3px solid #6B705C!important;color:#fff!important}
.about-titus .signature h5{color:#fff!important}
.about-titus .signature span{color:#6B705C!important}
.about-titus .sec-title h2,.about-titus .sec-title h2 span{color:#9aab88!important}
.about-titus .sec-title .sub-title{color:#6B705C!important}
.about-cta{background-image:url(assets/images/tito/custom2.jpg)!important}
.about-cta::before{background:rgba(3,14,31,.78)!important}
.about-cta h2{color:#fff!important}
.about-cta p{color:rgba(255,255,255,.75)!important}
.about-cta .theme-btn{background:#6B705C!important;color:#fff!important}
/* Approach section */
.about-company[style]{background:#2a4509!important}
.about-company[style] h4,.about-company[style] p{color:#fff!important}
.about-company[style] p{color:rgba(255,255,255,.7)!important}
.about-company[style] .sec-title h2 span{color:#9aab88!important}
/* page title override */
.page-title .title-box h2{color:#fff!important;font-family:'Quicksand',sans-serif!important}
</style>

<!-- Hero -->
<section class="about-hero" style="background-image: url(assets/images/tito/custom2.jpg);">
    <div class="container">
        <div class="content fadeInUp">
            <h1>About Us</h1>
            <p>At Titus Tuitoek Buyers Agent, we're transforming the property buying experience in Perth, one client at a time.</p>
            <a href="#about-company" class="theme-btn btn-one">Our Story</a>
        </div>
    </div>
</section>

<!-- Who We Are -->
<section id="about-company" class="about-company">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 text-column fadeInLeft">
                <div class="sec-title">
                    <span class="sub-title">Who We Are</span>
                    <h2>Perth's Premier <span>Property Buyers <br>Advocates</span></h2>
                </div>
                <div class="text" style="color:#fff;">
                    <p>At Titus Tuitoek Buyers Agent, we specialise in guiding clients through the Perth real estate market with personalised services tailored to every buyer — from first-time purchasers to families seeking their next home.</p>
                    <p>Whether you're bidding at auction, negotiating a private sale, or engaging our full-service buying support, our expertise is focused on giving you the best chance of securing the right property.</p>
                    <p>With our deep understanding of the Western Australian property landscape, we navigate the complexities of the market so you don't have to. Our approach combines local market knowledge with strong negotiation skills to ensure you achieve the best possible outcome.</p>
                    <div class="btn-box">
                        <a href="service.php" class="theme-btn btn-one">Our Services</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 image-column fadeInRight">
                <div class="image-box">
                    <img src="assets/images/tito/custom1.jpg" alt="Perth Property Market">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="about-values">
    <div class="container">
        <div class="sec-title centred fadeInUp">
            <span class="sub-title">Our Core Values</span>
            <h2>The Principles That <span>Guide Us</span></h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 fadeInUp">
                <div class="value-item">
                    <div class="icon"><i class="far fa-handshake"></i></div>
                    <h4>Integrity</h4>
                    <p>We operate with complete transparency and honesty, ensuring our clients' interests are always our highest priority.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 fadeInUp" data-wow-delay="200ms">
                <div class="value-item">
                    <div class="icon"><i class="far fa-lightbulb"></i></div>
                    <h4>Expertise</h4>
                    <p>Our deep understanding of Perth's property market allows us to make informed decisions and provide valuable insights.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 fadeInUp" data-wow-delay="400ms">
                <div class="value-item">
                    <div class="icon"><i class="far fa-comments"></i></div>
                    <h4>Communication</h4>
                    <p>We maintain clear, consistent communication throughout the entire buying process, keeping you informed at every step.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 fadeInUp" data-wow-delay="600ms">
                <div class="value-item">
                    <div class="icon"><i class="far fa-chart-bar"></i></div>
                    <h4>Results</h4>
                    <p>We're driven by achieving exceptional outcomes for our clients, measuring our success by your satisfaction.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Meet Titus -->
<section class="about-titus">
    <div class="pattern-layer"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 image-column fadeInLeft">
                <div class="image-box">
                    <img src="assets/images/tito/titus.jpeg" alt="Titus Tuitoek - Property Buyers Agent Perth">
                </div>
            </div>
            <div class="col-lg-7 content-column fadeInRight">
                <div class="inner-column">
                    <div class="sec-title">
                        <span class="sub-title">Meet Titus</span>
                        <h2>The Story <span>Behind the Advocate</span></h2>
                    </div>
                    <div class="text">
                        <p>I didn't start in real estate. I started with a love for architecture. There was something about clean, timeless design that just got me — the kind of homes that didn't scream for attention, but quietly stood the test of time. I went to uni with big dreams of becoming an architect… but life, as it tends to do, threw a few curveballs. I had to press pause.</p>
                        <p class="highlight">But here's where everything shifted.</p>
                        <p>I started watching friends — good people, hardworking people — lose their shot at owning a home. Not because they didn't deserve it. Not because they didn't try. But because the game was stacked against them — full of traps, bad advice, and missed opportunities.</p>
                        <p>Meanwhile, I could see what was possible. I saw the plays others missed. I saw homes that sat on the market too long. I saw buyers overpaying by tens of thousands. I knew someone had to step in.</p>
                        <p>So I did.</p>
                        <p>That's how I became a buyer's agent — not for the title, not for the commission, but because I couldn't sit back and watch people get burned by a system they didn't understand. Helping everyday people turn the dream of homeownership into a reality? That's been the most fulfilling part of all this.</p>
                    </div>
                    <div class="signature" style="margin-top:40px;">
                        <h5>Titus Tuitoek</h5>
                        <span>Founder &amp; Principal Buyers Agent</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Approach -->
<section class="about-company" style="padding-top:120px; padding-bottom:90px;">
    <div class="container">
        <div class="sec-title centred">
            <span class="sub-title">Our Approach</span>
            <h2>How We <span>Help You Win</span></h2>
        </div>
        <div class="row" style="margin-top:50px;">
            <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:30px;">
                <div class="value-item" style="background:#323232; border-radius:10px; padding:40px 30px; height:100%;">
                    <div class="icon" style="background:#8FA9B5; width:80px; height:80px; line-height:80px; border-radius:50%; text-align:center; margin:0 auto 20px; font-size:30px; color:#fff;">
                        <i class="far fa-search"></i>
                    </div>
                    <h4 style="color:#fff; text-align:center; margin-bottom:15px;">1. Discovery</h4>
                    <p style="color:#999; text-align:center;">We start with a deep dive into your needs, budget, and lifestyle preferences to build a crystal-clear brief.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:30px;">
                <div class="value-item" style="background:#323232; border-radius:10px; padding:40px 30px; height:100%;">
                    <div class="icon" style="background:#8FA9B5; width:80px; height:80px; line-height:80px; border-radius:50%; text-align:center; margin:0 auto 20px; font-size:30px; color:#fff;">
                        <i class="far fa-home"></i>
                    </div>
                    <h4 style="color:#fff; text-align:center; margin-bottom:15px;">2. Search &amp; Shortlist</h4>
                    <p style="color:#999; text-align:center;">We scour on-market and off-market opportunities to present only properties that truly match your criteria.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:30px;">
                <div class="value-item" style="background:#323232; border-radius:10px; padding:40px 30px; height:100%;">
                    <div class="icon" style="background:#8FA9B5; width:80px; height:80px; line-height:80px; border-radius:50%; text-align:center; margin:0 auto 20px; font-size:30px; color:#fff;">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <h4 style="color:#fff; text-align:center; margin-bottom:15px;">3. Due Diligence</h4>
                    <p style="color:#999; text-align:center;">We dig deep into every property — inspections, title searches, zoning, and market value — so no surprises later.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:30px;">
                <div class="value-item" style="background:#323232; border-radius:10px; padding:40px 30px; height:100%;">
                    <div class="icon" style="background:#8FA9B5; width:80px; height:80px; line-height:80px; border-radius:50%; text-align:center; margin:0 auto 20px; font-size:30px; color:#fff;">
                        <i class="far fa-handshake"></i>
                    </div>
                    <h4 style="color:#fff; text-align:center; margin-bottom:15px;">4. Negotiation</h4>
                    <p style="color:#999; text-align:center;">We negotiate hard on your behalf, using market data and experience to secure the best possible price and terms.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:30px;">
                <div class="value-item" style="background:#323232; border-radius:10px; padding:40px 30px; height:100%;">
                    <div class="icon" style="background:#8FA9B5; width:80px; height:80px; line-height:80px; border-radius:50%; text-align:center; margin:0 auto 20px; font-size:30px; color:#fff;">
                        <i class="far fa-gavel"></i>
                    </div>
                    <h4 style="color:#fff; text-align:center; margin-bottom:15px;">5. Auction &amp; Contracts</h4>
                    <p style="color:#999; text-align:center;">Whether auction or private treaty, we manage the entire process — from bidding strategy to contract review.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom:30px;">
                <div class="value-item" style="background:#323232; border-radius:10px; padding:40px 30px; height:100%;">
                    <div class="icon" style="background:#8FA9B5; width:80px; height:80px; line-height:80px; border-radius:50%; text-align:center; margin:0 auto 20px; font-size:30px; color:#fff;">
                        <i class="far fa-key"></i>
                    </div>
                    <h4 style="color:#fff; text-align:center; margin-bottom:15px;">6. Settlement</h4>
                    <p style="color:#999; text-align:center;">We coordinate with your conveyancer, lender and all parties to ensure a smooth, stress-free settlement.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="about-cta">
    <div class="container">
        <div class="content">
            <h2>Ready to Find Your Perfect Property?</h2>
            <p>Let's start the conversation. A free 15-minute strategy call could save you months of searching and tens of thousands of dollars.</p>
            <a href="contact.php" class="theme-btn btn-one">Book a Free Strategy Call</a>
            <a href="service.php" class="theme-btn btn-one" style="margin-left:15px;">View Our Services</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
