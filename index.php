<?php
/* Temporary: show PHP errors so 500 shows its cause — remove after fix confirmed */
error_reporting(E_ALL);
ini_set('display_errors', '1');

$page_title   = 'Titus Tuitoek — Perth\'s Premier Property Buyers Advocate';
$current_page = 'home';
require_once 'config/database.php';
$pdo = getDB();

/* ── Pull live data; fallback to hardcoded if DB not ready ── */
$db_services      = getServices($pdo);
$db_testimonials  = getTestimonials($pdo);
$db_listings      = getListings($pdo, true, 3); // featured only

$hero_title    = getSetting('hero_title',    "We Find. We Negotiate.\nYou Win.");
$hero_sub      = getSetting('hero_subtitle', 'Stop searching alone. Perth\'s trusted buyers advocate secures properties below market value — saving you months and tens of thousands of dollars.');
$hero_cta1     = getSetting('hero_cta_primary',   'Book Free Strategy Call');
$hero_cta2     = getSetting('hero_cta_secondary',  'Our Services');

$fallback_services = [
    ['icon'=>'far fa-home',        'title'=>'Full Buying Service',    'description'=>'End-to-end acquisition from consultation to settlement. We handle everything for busy professionals.'],
    ['icon'=>'far fa-search',      'title'=>'Property Search',        'description'=>'Targeted search with exclusive access to off-market opportunities unavailable to the general public.'],
    ['icon'=>'far fa-handshake',   'title'=>'Negotiation & Bidding',  'description'=>'Expert negotiation to secure properties at the best possible price — often below market value.'],
    ['icon'=>'far fa-gavel',       'title'=>'Auction Representation', 'description'=>'Strategic bidding by professionals who understand auction dynamics, giving you a competitive edge.'],
    ['icon'=>'far fa-chart-bar',   'title'=>'Market Analysis',        'description'=>'Accurate valuations and thorough market analysis so you never overpay for a property.'],
    ['icon'=>'far fa-shield-alt',  'title'=>'Due Diligence',          'description'=>'Investigation of titles, zoning, council regulations and potential issues to protect your investment.'],
    ['icon'=>'far fa-chart-line',  'title'=>'Investment Strategy',    'description'=>'Personalised strategies aligned with your financial goals focusing on high-yield growth areas.'],
    ['icon'=>'far fa-file-alt',    'title'=>'Settlement Support',     'description'=>'Coordination with conveyancers and lenders to ensure a smooth, stress-free settlement.'],
];
$services    = $db_services    ?: $fallback_services;

$fallback_testimonials = [
    ['name'=>'Sarah & James Wilson', 'role'=>'First Home Buyers, Scarborough',  'text'=>'Working with Titus was the best decision we made. His market knowledge and negotiation skills saved us over $45,000 on our dream home. The entire process was smooth and stress-free.', 'rating'=>5],
    ['name'=>'Michael Chen',          'role'=>'Property Investor, Subiaco',     'text'=>'As an interstate investor I was nervous about buying in Perth. Titus made the whole experience seamless — he found me a property with 7% yield I never would have found on my own.',       'rating'=>5],
    ['name'=>'Emily & David Park',    'role'=>'Upsizing Family, Nedlands',      'text'=>'We were outbid at three auctions before Titus stepped in. He secured our dream home $30,000 under asking price. I only wish we had found him sooner!',                                        'rating'=>5],
];
$testimonials = $db_testimonials ?: $fallback_testimonials;

include_once 'includes/header.php';
?>

<!-- ═══════════════ HERO ═══════════════ -->
<section class="site-hero" aria-label="Hero">
    <div class="hero-bg" style="background-image: url(assets/images/tito/custom2.jpg);"></div>
    <div class="hero-overlay"></div>

    <div class="container hero-inner" data-aos="fade-up" data-aos-duration="900">
        <div class="hero-badge">Perth's Trusted Buyers Advocate</div>
        <h1 class="hero-title">
            <?php
            $parts = explode("\n", $hero_title, 2);
            echo htmlspecialchars($parts[0]);
            if (!empty($parts[1])) {
                echo '<br><span class="accent">' . htmlspecialchars($parts[1]) . '</span>';
            }
            ?>
        </h1>
        <p class="hero-subtitle"><?php echo htmlspecialchars($hero_sub); ?></p>
        <div class="hero-ctas">
            <a href="contact.php" class="btn-brand">
                <i class="far fa-calendar-check"></i>
                <?php echo htmlspecialchars($hero_cta1); ?>
            </a>
            <a href="service.php" class="btn-outline-brand">
                <?php echo htmlspecialchars($hero_cta2); ?>
                <i class="far fa-arrow-right"></i>
            </a>
        </div>
        <div class="hero-scroll" aria-hidden="true">Scroll to explore</div>
    </div>

    <!-- Stats bar -->
    <div class="hero-stats">
        <div class="large-container">
            <div class="stats-grid">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="0">
                    <div><span class="stat-number" data-target="5">0</span><span class="stat-suffix">+</span></div>
                    <div class="stat-label">Years in Perth Market</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <div><span class="stat-number" data-target="100">0</span><span class="stat-suffix">+</span></div>
                    <div class="stat-label">Happy Clients</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div><span class="stat-number" data-target="50">0</span><span class="stat-suffix">K+</span></div>
                    <div class="stat-label">Avg. Client Savings</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <div><span class="stat-number" data-target="95">0</span><span class="stat-suffix">%</span></div>
                    <div class="stat-label">Client Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ ABOUT TEASER ═══════════════ -->
<section class="about-teaser section-pad">
    <div class="large-container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800">
                <div class="img-wrap">
                    <img src="assets/images/tito/titus.jpeg" alt="Titus Tuitoek — Perth Buyers Agent" loading="lazy">
                    <div class="img-badge">
                        <span>5+</span>
                        Years of Perth Market Expertise
                    </div>
                </div>
            </div>
            <div class="col-lg-6 content-side" data-aos="fade-left" data-aos-duration="800">
                <span class="sec-label">Who We Are</span>
                <h2 class="sec-heading">Perth's Premier <span>Property Buyers</span> Advocates</h2>
                <p style="color:#6c8795; font-size:16px; line-height:1.8; margin-bottom:10px;">At Titus Tuitoek Buyers Agent, we specialise in guiding clients through the Perth real estate market — from first-time buyers to seasoned investors. We work exclusively for you, never the seller.</p>
                <ul class="check-list">
                    <li><i class="far fa-check-circle"></i> Save months of stressful searching</li>
                    <li><i class="far fa-check-circle"></i> Access exclusive off-market listings</li>
                    <li><i class="far fa-check-circle"></i> Expert negotiation — average $45K+ savings</li>
                    <li><i class="far fa-check-circle"></i> End-to-end support from search to settlement</li>
                </ul>
                <a href="about.php" class="btn-brand" style="margin-top:10px;">
                    <i class="far fa-user"></i> Meet Titus
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ SERVICES ═══════════════ -->
<section class="services-section section-pad">
    <div class="large-container">
        <div class="text-center" data-aos="fade-up">
            <span class="sec-label">What We Do</span>
            <h2 class="sec-heading light">Comprehensive <span>Buyers Advocacy</span></h2>
            <p class="sec-sub light">From your first property search to settlement day, we're by your side at every step.</p>
        </div>
        <div class="row g-4">
            <?php foreach (array_slice($services, 0, 8) as $i => $svc): ?>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($i % 4) * 80; ?>">
                <div class="service-card">
                    <div class="icon">
                        <i class="<?php echo htmlspecialchars($svc['icon'] ?? 'far fa-star'); ?>"></i>
                    </div>
                    <h4><?php echo htmlspecialchars($svc['title']); ?></h4>
                    <p><?php echo htmlspecialchars($svc['description']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center" style="margin-top:50px;" data-aos="fade-up">
            <a href="service.php" class="btn-brand">
                View All Services <i class="far fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════ HOW IT WORKS ═══════════════ -->
<section class="process-section section-pad">
    <div class="large-container">
        <div class="text-center" data-aos="fade-up">
            <span class="sec-label">The Process</span>
            <h2 class="sec-heading">How We <span>Help You Win</span></h2>
            <p class="sec-sub">A proven three-step process to secure your perfect Perth property.</p>
        </div>
        <div class="process-steps">
            <div class="process-step" data-aos="fade-up" data-aos-delay="0">
                <div class="step-number">1</div>
                <h4>Discovery Call</h4>
                <p>A free 15-minute strategy session to understand your goals, budget, and must-haves — at zero obligation.</p>
            </div>
            <div class="process-step" data-aos="fade-up" data-aos-delay="150">
                <div class="step-number">2</div>
                <h4>Search & Shortlist</h4>
                <p>We scour on-market and off-market listings, inspect properties on your behalf, and present only the best matches.</p>
            </div>
            <div class="process-step" data-aos="fade-up" data-aos-delay="300">
                <div class="step-number">3</div>
                <h4>Secure & Settle</h4>
                <p>We negotiate aggressively, handle contracts, and coordinate settlement — you just collect the keys.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════ TESTIMONIALS ═══════════════ -->
<section class="testimonials-section section-pad">
    <div class="large-container">
        <div class="text-center" data-aos="fade-up">
            <span class="sec-label">Client Stories</span>
            <h2 class="sec-heading light">What Our <span>Clients Say</span></h2>
        </div>
        <div class="row g-4" style="margin-top:20px;">
            <?php foreach ($testimonials as $i => $t): ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">
                <div class="testimonial-card">
                    <span class="quote-icon" aria-hidden="true">"</span>
                    <div class="stars" aria-label="<?php echo (int)($t['rating'] ?? 5); ?> out of 5 stars">
                        <?php for ($s = 0; $s < (int)($t['rating'] ?? 5); $s++): ?>
                        <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="text"><?php echo htmlspecialchars($t['text']); ?></p>
                    <div class="author">
                        <?php if (!empty($t['photo'])): ?>
                        <img src="<?php echo htmlspecialchars($t['photo']); ?>" alt="<?php echo htmlspecialchars($t['name']); ?>" loading="lazy">
                        <?php else: ?>
                        <div class="avatar-placeholder" aria-hidden="true">
                            <?php echo strtoupper(substr($t['name'], 0, 1)); ?>
                        </div>
                        <?php endif; ?>
                        <div>
                            <h5><?php echo htmlspecialchars($t['name']); ?></h5>
                            <span><?php echo htmlspecialchars($t['role'] ?? ''); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php if (!empty($db_listings)): ?>
<!-- ═══════════════ RECENT WINS ═══════════════ -->
<section class="listings-section section-pad">
    <div class="large-container">
        <div class="text-center" data-aos="fade-up">
            <span class="sec-label">Recent Wins</span>
            <h2 class="sec-heading">Properties We've <span>Secured for Clients</span></h2>
        </div>
        <div class="row g-4" style="margin-top:20px;">
            <?php foreach ($db_listings as $i => $listing): ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">
                <article class="listing-card">
                    <div class="img-wrap">
                        <?php if (!empty($listing['image'])): ?>
                        <img src="<?php echo htmlspecialchars($listing['image']); ?>" alt="<?php echo htmlspecialchars($listing['title']); ?>" loading="lazy">
                        <?php else: ?>
                        <img src="assets/images/tito/custom1.jpg" alt="<?php echo htmlspecialchars($listing['title']); ?>" loading="lazy">
                        <?php endif; ?>
                        <span class="status-badge <?php echo htmlspecialchars($listing['status']); ?>">
                            <?php echo ucwords(str_replace('_', ' ', $listing['status'])); ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <h4><?php echo htmlspecialchars($listing['title']); ?></h4>
                        <p class="suburb"><i class="far fa-map-marker-alt"></i> <?php echo htmlspecialchars($listing['suburb'] ?? ''); ?></p>
                        <div class="features">
                            <?php if ($listing['bedrooms']): ?><span><i class="far fa-bed"></i> <?php echo (int)$listing['bedrooms']; ?> Bed</span><?php endif; ?>
                            <?php if ($listing['bathrooms']): ?><span><i class="far fa-bath"></i> <?php echo (int)$listing['bathrooms']; ?> Bath</span><?php endif; ?>
                            <?php if ($listing['car_spaces']): ?><span><i class="far fa-car"></i> <?php echo (int)$listing['car_spaces']; ?></span><?php endif; ?>
                        </div>
                        <?php if (!empty($listing['price'])): ?>
                        <div class="price"><?php echo htmlspecialchars($listing['price']); ?></div>
                        <?php endif; ?>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ═══════════════ CTA BANNER ═══════════════ -->
<section class="cta-banner" aria-label="Call to action">
    <div class="large-container">
        <div class="content" data-aos="fade-up">
            <span class="sec-label" style="color:var(--brand-light);">Ready to Get Started?</span>
            <h2>Let's Secure Your Perfect<br>Perth Property Together</h2>
            <p>Join Perth homeowners and investors who trusted Titus to find their dream property — and saved an average of $45,000 in the process.</p>
            <div class="cta-btn-group">
                <a href="contact.php" class="btn-brand">
                    <i class="far fa-calendar-check"></i> Book Free Strategy Call
                </a>
                <a href="tel:+61498439115" class="btn-outline-brand">
                    <i class="far fa-phone"></i> Call +61 498 439 115
                </a>
            </div>
        </div>
    </div>
</section>

<?php
$page_scripts = <<<JS
<script src="assets/js/aos.js"></script>
<script>
AOS.init({ once: true, offset: 80, duration: 700 });

/* Counter animation */
function animateCounters() {
    document.querySelectorAll('.stat-number[data-target]').forEach(function(el) {
        var target = parseInt(el.dataset.target, 10);
        var duration = 1800;
        var step = target / (duration / 16);
        var current = 0;
        var timer = setInterval(function() {
            current += step;
            if (current >= target) { current = target; clearInterval(timer); }
            el.textContent = Math.floor(current);
        }, 16);
    });
}

/* Fire counters once hero stats enter viewport */
var statsEl = document.querySelector('.hero-stats');
if (statsEl && 'IntersectionObserver' in window) {
    new IntersectionObserver(function(entries, obs) {
        if (entries[0].isIntersecting) { animateCounters(); obs.disconnect(); }
    }, { threshold: 0.3 }).observe(statsEl);
} else {
    animateCounters();
}
</script>
JS;

include_once 'includes/footer.php';
?>
