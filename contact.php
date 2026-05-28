<?php
$page_title   = 'Contact Titus Tuitoek - Perth Property Buyers Agent';
$current_page = 'contact';

/* Show flash message from sendemail.php redirect */
$flash = '';
if (!empty($_GET['message'])) {
    if ($_GET['message'] === 'success') {
        $flash = '<div class="alert-message alert-success" style="display:block;">
                    <strong>Message sent!</strong> Thank you — Titus will be in touch within 2 hours during business hours.
                  </div>';
    } elseif ($_GET['message'] === 'error') {
        $flash = '<div class="alert-message alert-error" style="display:block;">
                    <strong>Something went wrong.</strong> Please try again or call <a href="tel:+61498439115">+61 498 439 115</a>.
                  </div>';
    }
}

include_once 'includes/header.php';
?>

<!-- page-title -->
<section class="page-title centred">
    <div class="outer-container">
        <div class="bg-layer" style="background-image: url(assets/images/tito/custom2.jpg);"></div>
        <div class="large-container">
            <div class="title-box">
                <h2>Let's Find Your Perfect Property</h2>
                <p style="color:#fff; margin-top:15px; font-size:18px;">Connect with Perth's trusted buyers advocate today</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-page-section" style="padding-top:80px; padding-bottom:80px;">
    <div class="auto-container">

        <!-- Tab Navigation -->
        <div class="tab-buttons">
            <div class="tab-btn active" data-tab="contact-form">
                <i class="far fa-envelope" style="margin-right:8px;"></i> Send Message
            </div>
            <div class="tab-btn" data-tab="book-consultation">
                <i class="far fa-calendar-check" style="margin-right:8px;"></i> Book Free Call
            </div>
            <div class="tab-btn" data-tab="office-hours">
                <i class="far fa-clock" style="margin-right:8px;"></i> Office Hours
            </div>
        </div>

        <!-- Contact Form Tab -->
        <div class="custom-tab active" id="contact-form">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="form-inner">
                        <div class="sec-title">
                            <span class="sub-title">Get In Touch</span>
                            <h2>Ready to Secure Your Dream Property?</h2>
                            <p>Fill out the form below and I'll personally respond within 2 hours during business hours</p>
                        </div>

                        <?php echo $flash; ?>

                        <form action="sendemail.php" method="post" class="default-form">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="username" placeholder="Your Full Name *" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="tel" name="phone" placeholder="Your Phone Number *" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="Your Email Address *" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <select name="subject" required>
                                        <option value="" disabled selected>What brings you here today? *</option>
                                        <option value="First Home Buyer">I'm a First Home Buyer</option>
                                        <option value="Property Investor">I'm Looking to Invest</option>
                                        <option value="Upsizing">I'm Upsizing My Home</option>
                                        <option value="Downsizing">I'm Downsizing</option>
                                        <option value="General Inquiry">General Question</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea name="message" placeholder="Tell me about your property goals and budget range..." rows="5" required></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                    <button type="submit">Get My Free Property Consultation</button>
                                </div>
                                <div class="col-lg-12">
                                    <p style="font-size:13px; color:#999; margin-top:10px;">
                                        Your information is 100% secure and will never be shared.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="info-box">
                        <h3 style="margin-bottom:20px; color:#fff;">
                            <i class="far fa-phone-alt" style="margin-right:10px;"></i> Direct Contact
                        </h3>
                        <ul style="list-style:none; padding-left:0;">
                            <li style="margin-bottom:20px; color:#fff;">
                                <strong style="display:block; margin-bottom:8px;">Call or Text:</strong>
                                <a href="tel:+61498439115" style="color:#fff; font-size:20px; font-weight:600;">+61 498 439 115</a>
                            </li>
                            <li style="margin-bottom:20px; color:#fff;">
                                <strong style="display:block; margin-bottom:8px;">Email:</strong>
                                <a href="mailto:titus.buyersagent@gmail.com" style="color:#fff;">titus.buyersagent@gmail.com</a>
                            </li>
                            <li style="margin-bottom:20px; color:#fff;">
                                <strong style="display:block; margin-bottom:8px;">Service Area:</strong>
                                Greater Perth Metropolitan Area
                            </li>
                            <li style="margin-bottom:20px; color:#fff;">
                                <strong style="display:block; margin-bottom:8px;">Response Time:</strong>
                                Under 2 hours (business hours)
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Consultation Tab -->
        <div class="custom-tab" id="book-consultation">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="info-box">
                        <h3 style="color:#fff; margin-bottom:20px;">Free 15-Minute Strategy Call</h3>
                        <p style="color:#fff; margin-bottom:25px; font-size:16px; line-height:26px;">
                            Book a no-obligation discovery call to discuss your property goals. I'll share insider market insights and explain exactly how I can help you secure your ideal property.
                        </p>
                        <div style="background:rgba(255,255,255,.1); padding:20px; border-radius:8px; margin-bottom:25px;">
                            <h4 style="color:#8FA9B5; margin-bottom:15px;">What You'll Get:</h4>
                            <ul style="list-style:none; padding-left:0;">
                                <li style="margin-bottom:12px; color:#fff; padding-left:25px; position:relative;">
                                    <i class="far fa-check-circle" style="color:#8FA9B5; position:absolute; left:0; top:3px;"></i>
                                    Current Perth market insights
                                </li>
                                <li style="margin-bottom:12px; color:#fff; padding-left:25px; position:relative;">
                                    <i class="far fa-check-circle" style="color:#8FA9B5; position:absolute; left:0; top:3px;"></i>
                                    Property search strategy tailored to you
                                </li>
                                <li style="margin-bottom:12px; color:#fff; padding-left:25px; position:relative;">
                                    <i class="far fa-check-circle" style="color:#8FA9B5; position:absolute; left:0; top:3px;"></i>
                                    Estimated savings &amp; ROI projections
                                </li>
                                <li style="margin-bottom:12px; color:#fff; padding-left:25px; position:relative;">
                                    <i class="far fa-check-circle" style="color:#8FA9B5; position:absolute; left:0; top:3px;"></i>
                                    Clear next steps for your journey
                                </li>
                            </ul>
                        </div>
                        <p style="color:#8FA9B5; font-size:14px; font-style:italic;">
                            Most clients who book a call save $50,000+ on their purchase
                        </p>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="calendar-container">
                        <div class="calendar-placeholder">
                            <h3><i class="far fa-calendar-check"></i> Schedule Your Free Call</h3>
                            <p>Fill out the form and I'll contact you within 2 hours to confirm your preferred time</p>
                            <div class="calendar-form">
                                <form action="sendemail.php" method="post">
                                    <input type="hidden" name="subject" value="Free Strategy Call Booking">
                                    <div class="form-group">
                                        <input type="text" name="username" placeholder="Your Full Name *" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Your Email *" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" name="phone" placeholder="Best Contact Number *" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="preferred_day" required>
                                                    <option value="" disabled selected>Preferred Day *</option>
                                                    <option>Monday</option>
                                                    <option>Tuesday</option>
                                                    <option>Wednesday</option>
                                                    <option>Thursday</option>
                                                    <option>Friday</option>
                                                    <option>Saturday</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="preferred_time" required>
                                                    <option value="" disabled selected>Preferred Time *</option>
                                                    <option>9:00 AM</option>
                                                    <option>10:00 AM</option>
                                                    <option>11:00 AM</option>
                                                    <option>12:00 PM</option>
                                                    <option>1:00 PM</option>
                                                    <option>2:00 PM</option>
                                                    <option>3:00 PM</option>
                                                    <option>4:00 PM</option>
                                                    <option>5:00 PM</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <select name="inquiry_type" required>
                                            <option value="" disabled selected>What are you looking for? *</option>
                                            <option>First Home Purchase</option>
                                            <option>Investment Property</option>
                                            <option>Upsizing</option>
                                            <option>Downsizing</option>
                                            <option>Other / Not Sure Yet</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Any specific questions or requirements? (Optional)" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit">Reserve My Free Strategy Call</button>
                                    </div>
                                </form>
                            </div>
                            <div style="text-align:center; margin-top:25px;">
                                <p style="color:#fff; font-size:14px;">
                                    Available Mon–Fri: 8:30 AM – 6:00 PM | Sat: 9:00 AM – 4:00 PM
                                </p>
                                <p style="color:#999; font-size:13px; margin-top:10px;">
                                    Can't find a suitable time? Call directly:
                                    <a href="tel:+61498439115" style="color:#8FA9B5; font-weight:600;">+61 498 439 115</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Office Hours Tab -->
        <div class="custom-tab" id="office-hours">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="service-hours">
                        <h3><i class="far fa-clock"></i> Office Hours &amp; Availability</h3>
                        <ul>
                            <li>
                                <span><strong>Monday – Friday</strong></span>
                                <span style="color:#8FA9B5; font-weight:600;">8:30 AM – 6:00 PM</span>
                            </li>
                            <li>
                                <span><strong>Saturday</strong></span>
                                <span style="color:#8FA9B5; font-weight:600;">9:00 AM – 4:00 PM</span>
                            </li>
                            <li>
                                <span><strong>Sunday</strong></span>
                                <span style="color:#999;">By Appointment Only</span>
                            </li>
                            <li>
                                <span><strong>Public Holidays</strong></span>
                                <span style="color:#999;">Closed</span>
                            </li>
                        </ul>
                        <div style="background:rgba(143,169,181,.2); padding:20px; border-radius:8px; margin-top:25px;">
                            <p style="color:#fff; margin-bottom:15px;">
                                <i class="far fa-info-circle" style="color:#8FA9B5; margin-right:8px;"></i>
                                <strong>Flexible Scheduling Available</strong>
                            </p>
                            <p style="color:#fff; font-size:14px; line-height:24px;">
                                Property inspections don't follow 9–5 schedules, and neither do I. Evening and weekend appointments available by request to fit your busy lifestyle.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="info-box">
                        <h3 style="color:#fff; margin-bottom:20px;">
                            <i class="far fa-map-marked-alt"></i> Service Areas
                        </h3>
                        <p style="color:#fff; margin-bottom:25px;">Comprehensive coverage across Greater Perth Metropolitan Area</p>
                        <div style="display:flex; flex-wrap:wrap; gap:20px;">
                            <div style="flex:1; min-width:180px;">
                                <h4 style="color:#8FA9B5; margin-bottom:12px;">Northern Suburbs</h4>
                                <ul style="list-style:none; padding-left:0; color:#fff; font-size:14px;">
                                    <li style="padding:5px 0;">• Joondalup</li>
                                    <li style="padding:5px 0;">• Hillarys</li>
                                    <li style="padding:5px 0;">• Scarborough</li>
                                    <li style="padding:5px 0;">• Duncraig</li>
                                </ul>
                            </div>
                            <div style="flex:1; min-width:180px;">
                                <h4 style="color:#8FA9B5; margin-bottom:12px;">Southern Suburbs</h4>
                                <ul style="list-style:none; padding-left:0; color:#fff; font-size:14px;">
                                    <li style="padding:5px 0;">• Fremantle</li>
                                    <li style="padding:5px 0;">• Applecross</li>
                                    <li style="padding:5px 0;">• Como</li>
                                    <li style="padding:5px 0;">• Rockingham</li>
                                </ul>
                            </div>
                            <div style="flex:1; min-width:180px;">
                                <h4 style="color:#8FA9B5; margin-bottom:12px;">Eastern Suburbs</h4>
                                <ul style="list-style:none; padding-left:0; color:#fff; font-size:14px;">
                                    <li style="padding:5px 0;">• Midland</li>
                                    <li style="padding:5px 0;">• Guildford</li>
                                    <li style="padding:5px 0;">• Kalamunda</li>
                                    <li style="padding:5px 0;">• Mundaring</li>
                                </ul>
                            </div>
                            <div style="flex:1; min-width:180px;">
                                <h4 style="color:#8FA9B5; margin-bottom:12px;">Western Suburbs</h4>
                                <ul style="list-style:none; padding-left:0; color:#fff; font-size:14px;">
                                    <li style="padding:5px 0;">• Cottesloe</li>
                                    <li style="padding:5px 0;">• Claremont</li>
                                    <li style="padding:5px 0;">• Nedlands</li>
                                    <li style="padding:5px 0;">• Subiaco</li>
                                </ul>
                            </div>
                        </div>
                        <p style="color:#8FA9B5; margin-top:25px; font-size:14px; font-style:italic;">
                            Looking for a suburb not listed? Contact me — I cover all of Greater Perth!
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CTA Section -->
<section style="padding:100px 0; background:linear-gradient(135deg, rgba(50,50,50,.95) 0%, rgba(143,169,181,.85) 100%), url(assets/images/tito/custom3.jpg); background-size:cover; background-position:center; background-attachment:fixed; position:relative;">
    <div class="auto-container" style="position:relative; z-index:1;">
        <div style="max-width:900px; margin:0 auto; text-align:center;">
            <span style="color:#fff; font-size:16px; font-weight:600; letter-spacing:2px; text-transform:uppercase; display:block; margin-bottom:15px;">Ready to Get Started?</span>
            <h2 style="color:#fff; margin-bottom:25px; font-size:48px; line-height:58px; font-weight:700;">
                Let's Secure Your Perfect Property Together
            </h2>
            <p style="color:rgba(255,255,255,.9); margin-bottom:40px; font-size:20px; line-height:32px;">
                Join happy Perth property owners who trusted me to find their dream home or investment
            </p>
            <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap;">
                <a href="tel:+61498439115" class="theme-btn btn-one" style="background:transparent; border:3px solid #fff; padding:17px 37px; text-decoration:none;">
                    <i class="far fa-phone" style="margin-right:10px;"></i>
                    Call Now: +61 498 439 115
                </a>
            </div>
        </div>
    </div>
</section>

<?php
$page_scripts = <<<JS
<script>
$(document).ready(function(){
    $('.tab-btn').on('click', function(){
        var tabId = $(this).data('tab');
        $('.custom-tab').removeClass('active');
        $('.tab-btn').removeClass('active');
        $('#' + tabId).addClass('active');
        $(this).addClass('active');
    });
});
</script>
JS;

include_once 'includes/footer.php';
?>
