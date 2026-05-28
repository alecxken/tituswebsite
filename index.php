<?php
/* Temporary: surface PHP errors until confirmed working */
error_reporting(E_ALL);
ini_set('display_errors', '1');

$page_title   = 'Titus Tuitoek — Perth\'s #1 Property Buyers Advocate';
$current_page = 'home';
require_once 'config/database.php';
$pdo = getDB();

define('TITO_IMG_DEFAULT', TITO_IMG_DEFAULT);

$db_services     = getServices($pdo);
$db_testimonials = getTestimonials($pdo);
$db_listings     = getListings($pdo, true, 3);

/* Hero copy from DB or fallback */
$hero_sub = getSetting('hero_subtitle',
  'Stop searching alone. Perth\'s most trusted buyers advocate secures properties below market value — saving you months and tens of thousands of dollars.');

/* Fallback services */
$fallback_services = array(
  array('icon'=>'far fa-home',        'title'=>'Full Buying Service',    'description'=>'End-to-end acquisition from consultation to settlement — handling everything so you can focus on what matters.'),
  array('icon'=>'far fa-search',      'title'=>'Property Search',        'description'=>'Targeted search with exclusive access to off-market opportunities unavailable to the general public.'),
  array('icon'=>'far fa-handshake',   'title'=>'Expert Negotiation',     'description'=>'We negotiate aggressively on your behalf, leveraging market data to secure the best possible price.'),
  array('icon'=>'far fa-gavel',       'title'=>'Auction Representation', 'description'=>'Strategic bidding by professionals who understand auction dynamics, giving you a real competitive edge.'),
  array('icon'=>'far fa-chart-bar',   'title'=>'Market Analysis',        'description'=>'Accurate valuations and deep market analysis so you never overpay for a Perth property.'),
  array('icon'=>'far fa-shield-alt',  'title'=>'Due Diligence',          'description'=>'Thorough investigation of titles, zoning, and council regulations to protect your investment.'),
  array('icon'=>'far fa-chart-line',  'title'=>'Investment Strategy',    'description'=>'Personalised strategies aligned with your financial goals, focused on high-yield growth corridors.'),
  array('icon'=>'far fa-file-alt',    'title'=>'Settlement Support',     'description'=>'Coordinating with conveyancers and lenders to ensure a smooth, stress-free settlement experience.'),
);
$services = $db_services ?: $fallback_services;

$fallback_testimonials = array(
  array('name'=>'Sarah & James Wilson', 'role'=>'First Home Buyers, Scarborough',  'text'=>'Working with Titus was the best decision we made. His market knowledge and negotiation skills saved us over $45,000 on our dream home. The entire process was smooth and stress-free.', 'rating'=>5),
  array('name'=>'Michael Chen',          'role'=>'Property Investor, Subiaco',     'text'=>'As an interstate investor I was nervous about buying in Perth. Titus made the whole experience seamless — he found me a property with 7% yield I never would have found on my own.',   'rating'=>5),
  array('name'=>'Emily & David Park',    'role'=>'Upsizing Family, Nedlands',      'text'=>'We were outbid at three auctions before Titus stepped in. He secured our dream home $30,000 under asking price. I only wish we had found him sooner!',                                    'rating'=>5),
);
$testimonials = $db_testimonials ?: $fallback_testimonials;

/* Service accordion rows */
$accordion = array(
  array(
    'title' => 'Full Property Search & Acquisition',
    'lead'  => 'End-to-end property buying service tailored to busy professionals and investors',
    'img'   => TITO_IMG_DEFAULT,
    'feats' => array(
      array('h'=>'Strategy Brief',        'p'=>'Deep-dive discovery to map your goals, budget, and must-haves into a precise buying brief.'),
      array('h'=>'On & Off-Market Access','p'=>'We tap into our agent network to surface properties before they hit public listings.'),
      array('h'=>'Expert Negotiations',   'p'=>'Data-backed negotiation strategy that consistently secures below-market prices.'),
      array('h'=>'Settlement Coordination','p'=>'We coordinate every party — conveyancer, lender, agent — right through to key handover.'),
    ),
  ),
  array(
    'title' => 'Auction Representation & Bidding',
    'lead'  => 'Competitive, strategic auction bidding that removes emotion from the equation',
    'img'   => 'assets/images/tito/custom2.jpg',
    'feats' => array(
      array('h'=>'Pre-Auction Due Diligence','p'=>'Title searches, building reports, and market valuations before auction day.'),
      array('h'=>'Bidding Strategy',        'p'=>'Tailored auction tactics that put psychological pressure on competing bidders.'),
      array('h'=>'Real-Time Decisions',     'p'=>'We represent you on the day — no emotional overbidding, just disciplined strategy.'),
      array('h'=>'Post-Auction Negotiation','p'=>'If passed in, we negotiate hard immediately for the best possible outcome.'),
    ),
  ),
  array(
    'title' => 'Investment Property Strategy',
    'lead'  => 'Build long-term wealth through intelligent Perth property investment',
    'img'   => 'assets/images/tito/custom3.jpg',
    'feats' => array(
      array('h'=>'Portfolio Planning',   'p'=>'Align each acquisition with your long-term wealth and tax strategy.'),
      array('h'=>'Yield Optimisation',   'p'=>'We target high-rental-yield suburbs with strong capital growth potential.'),
      array('h'=>'Risk Assessment',      'p'=>'Full due diligence — zoning, vacancy rates, infrastructure plans, and developer risk.'),
      array('h'=>'Market Timing',        'p'=>'Data-driven entry timing based on Perth suburb cycle analysis.'),
    ),
  ),
  array(
    'title' => 'Due Diligence & Property Evaluation',
    'lead'  => 'Protecting you from costly mistakes with forensic property analysis',
    'img'   => TITO_IMG_DEFAULT,
    'feats' => array(
      array('h'=>'Title & Encumbrance Search','p'=>'Verify ownership and identify any restrictive covenants or caveats.'),
      array('h'=>'Building & Pest Reports',   'p'=>'Independent inspections to uncover hidden defects before you commit.'),
      array('h'=>'Market Valuation',          'p'=>'Independent CMA ensuring you never overpay for any Perth property.'),
      array('h'=>'Council & Zoning Check',    'p'=>'Review development potential, overlays, and future infrastructure plans.'),
    ),
  ),
);

include_once 'includes/header.php';
?>

<!-- ══ HERO CAROUSEL ════════════════════════════════════════════ -->
<section id="hero-section" aria-label="Hero">
  <div class="banner-style-two">
    <div class="large-container">
      <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 slider-block" style="width:100%;max-width:100%;flex:0 0 100%">
          <div class="slider-content">
            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">

              <div class="single-item">
                <figure class="image-box">
                  <img src="assets/images/banner/banner-05.jpg" alt="Perth Property Investment">
                </figure>
                <div class="content-box">
                  <div class="hero-eyebrow">Perth's Trusted Buyers Advocate</div>
                  <h2>WE FIND.<br>WE NEGOTIATE.<br><span>You Win.</span></h2>
                  <ul class="info">
                    <li><i class="far fa-map-marker-alt"></i>PERTH, <span>Western Australia</span></li>
                    <li><i class="icon-20"></i>5+ Years Local Expertise</li>
                  </ul>
                  <div class="hero-cta-group">
                    <a href="contact.php" class="btn-primary">
                      Book Free Strategy Call
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="service.php" class="btn-outline">Our Services</a>
                  </div>
                </div>
              </div>

              <div class="single-item">
                <figure class="image-box">
                  <img src="assets/images/banner/banner-04.jpg" alt="Perth Property Market">
                </figure>
                <div class="content-box">
                  <div class="hero-eyebrow">Expert Property Advocacy</div>
                  <h2>YOUR LOCAL<br><span>BUYERS</span><br>ADVOCATES</h2>
                  <ul class="info">
                    <li><i class="far fa-map-marker-alt"></i>PERTH, <span>Western Australia</span></li>
                    <li><i class="icon-20"></i>Average $45K+ Client Savings</li>
                  </ul>
                  <div class="hero-cta-group">
                    <a href="contact.php" class="btn-primary">
                      Book Free Strategy Call
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="about.php" class="btn-outline">Meet Titus</a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ STATS STRIP ══════════════════════════════════════════════ -->
<section class="stats-strip" aria-label="Key statistics">
  <div class="stats-grid">
    <div class="stat-item" data-aos="fade-up" data-aos-delay="0">
      <span class="stat-number" data-target="5">0</span><span class="stat-suffix">+</span>
      <span class="stat-label">Years in Perth Market</span>
    </div>
    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
      <span class="stat-number" data-target="100">0</span><span class="stat-suffix">+</span>
      <span class="stat-label">Happy Clients</span>
    </div>
    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
      <span class="stat-number" data-target="45">0</span><span class="stat-suffix">K+</span>
      <span class="stat-label">Avg. Client Savings</span>
    </div>
    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
      <span class="stat-number" data-target="95">0</span><span class="stat-suffix">%</span>
      <span class="stat-label">Client Satisfaction</span>
    </div>
  </div>
</div>

<!-- ══ ABOUT TEASER ═════════════════════════════════════════════ -->
<section class="about-section section-pad" id="about" aria-label="About Titus">
  <div class="about-grid">

    <div class="about-image-wrap rv" data-aos="fade-right">
      <img src="assets/images/tito/titus.jpeg" alt="Titus Tuitoek — Perth Property Buyers Advocate" loading="lazy">
      <div class="about-badge"><strong>5+</strong>Years Perth Market Expertise</div>
    </div>

    <div class="rv d2" data-aos="fade-left">
      <span class="stag">Who We Are</span>
      <h2 class="sec-heading light" style="margin-bottom:20px">Perth's Premier<br><span>Buyers Advocates</span></h2>
      <p style="font-size:15px;color:rgba(255,255,255,.68);line-height:1.85;margin-bottom:12px">
        At Titus Tuitoek Buyers Agent, we specialise in guiding clients through the Perth real estate market — from first-time buyers to seasoned investors. We work exclusively for you, never the seller.
      </p>
      <p style="font-size:15px;color:rgba(255,255,255,.68);line-height:1.85;margin-bottom:24px">
        Our deep understanding of Western Australian property cycles, combined with a relentless approach to negotiation, consistently delivers results that surprise and delight our clients.
      </p>
      <ul class="check-list">
        <li>Save months of stressful searching</li>
        <li>Access exclusive off-market listings</li>
        <li>Expert negotiation — average $45K+ savings</li>
        <li>Full support from search to settlement</li>
      </ul>
      <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:28px">
        <a href="about.php" class="btn-primary">Meet Titus</a>
        <a href="service.php" class="btn-outline">Our Services</a>
      </div>
    </div>

  </div>
</section>

<!-- ══ SERVICES ACCORDION ═══════════════════════════════════════ -->
<section class="services-section section-pad" id="services" aria-label="Services">
  <div class="services-wrap">

    <div class="rv" style="margin-bottom:60px">
      <span class="stag">What We Do</span>
      <h2 class="sec-heading light" style="margin-top:10px;max-width:680px">
        Your aspiration,<br><span>our expertise.</span>
      </h2>
    </div>

    <?php foreach ($accordion as $i => $svc): ?>
    <div class="service-row<?php echo $i === 1 ? ' open' : ''; ?>">
      <button class="service-header" type="button"
              onclick="toggleService(this.closest('.service-row'))"
              onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();toggleService(this.closest('.service-row'))}"
              aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
        <span class="service-num">0<?php echo $i + 1; ?></span>
        <span class="service-title"><?php echo htmlspecialchars($svc['title']); ?></span>
        <div class="service-arrow" aria-hidden="true">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </div>
      </button>
      <div class="service-body">
        <div class="service-body-inner">
          <img class="service-body-img" src="<?php echo htmlspecialchars($svc['img']); ?>" alt="<?php echo htmlspecialchars($svc['title']); ?>" loading="lazy">
          <div>
            <p class="service-body-lead"><?php echo htmlspecialchars($svc['lead']); ?></p>
            <div class="service-features">
              <?php foreach ($svc['feats'] as $f): ?>
              <div class="service-feature">
                <h5><?php echo htmlspecialchars($f['h']); ?></h5>
                <p><?php echo htmlspecialchars($f['p']); ?></p>
              </div>
              <?php endforeach; ?>
            </div>
            <div style="margin-top:28px">
              <a href="contact.php" class="btn-primary" style="font-size:11px;padding:12px 24px">
                Enquire About This Service
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- ══ PROCESS ══════════════════════════════════════════════════ -->
<section class="process-section section-pad" id="process" aria-label="How it works">
  <div class="container-xl">
    <div class="rv" style="text-align:center;margin-bottom:0">
      <span class="stag">The Process</span>
      <h2 class="sec-heading light" style="margin-top:10px">How we help<br><span>you win.</span></h2>
    </div>
    <div class="process-grid">
      <div class="process-card rv d1">
        <span class="process-num">01</span>
        <h4>Discovery Call</h4>
        <p>A free 15-minute no-obligation strategy call to understand your goals, budget, and must-haves. Zero pressure, pure value.</p>
      </div>
      <div class="process-card rv d2">
        <span class="process-num">02</span>
        <h4>Search & Shortlist</h4>
        <p>We scour on-market and off-market listings, inspect properties on your behalf, and present only the best-matched opportunities.</p>
      </div>
      <div class="process-card rv d3">
        <span class="process-num">03</span>
        <h4>Secure & Settle</h4>
        <p>We negotiate aggressively, manage contracts, and coordinate settlement — you simply collect the keys to your new property.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ TESTIMONIALS ═════════════════════════════════════════════ -->
<section class="testimonials-section section-pad" id="testimonials" aria-label="Client testimonials">
  <div class="container-xl">
    <div class="rv" style="text-align:center">
      <span class="stag">Client Stories</span>
      <h2 class="sec-heading light" style="margin-top:10px">What our<br><span>clients say.</span></h2>
    </div>
    <div class="testimonials-grid">
      <?php foreach ($testimonials as $i => $t): ?>
      <div class="testimonial-card rv d<?php echo $i + 1; ?>">
        <span class="t-quote" aria-hidden="true">&ldquo;</span>
        <div class="t-stars" aria-label="<?php echo (int)($t['rating'] ?? 5); ?> out of 5 stars">
          <?php for ($s = 0; $s < (int)($t['rating'] ?? 5); $s++): ?>
          <i class="fas fa-star"></i>
          <?php endfor; ?>
        </div>
        <p class="t-text"><?php echo htmlspecialchars($t['text']); ?></p>
        <div class="t-author">
          <div class="t-avatar" aria-hidden="true">
            <?php if (!empty($t['photo'])): ?>
            <img src="<?php echo htmlspecialchars($t['photo']); ?>" alt="<?php echo htmlspecialchars($t['name']); ?>">
            <?php else: ?>
            <?php echo strtoupper(substr($t['name'], 0, 1)); ?>
            <?php endif; ?>
          </div>
          <div>
            <div class="t-name"><?php echo htmlspecialchars($t['name']); ?></div>
            <div class="t-role"><?php echo htmlspecialchars($t['role'] ?? ''); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if (!empty($db_listings)): ?>
<!-- ══ RECENT WINS ═══════════════════════════════════════════ -->
<section class="listings-section section-pad" id="listings" aria-label="Recent property wins">
  <div class="container-xl">
    <div class="rv" style="text-align:center">
      <span class="stag">Recent Wins</span>
      <h2 class="sec-heading light" style="margin-top:10px">Properties we've<br><span>secured for clients.</span></h2>
    </div>
    <div class="listings-grid" style="margin-top:56px">
      <?php foreach ($db_listings as $i => $lst): ?>
      <article class="listing-card rv d<?php echo $i + 1; ?>">
        <div class="listing-img">
          <img src="<?php echo !empty($lst['image']) ? htmlspecialchars($lst['image']) : TITO_IMG_DEFAULT; ?>"
               alt="<?php echo htmlspecialchars($lst['title']); ?>" loading="lazy">
          <span class="listing-badge <?php echo htmlspecialchars($lst['status']); ?>">
            <?php echo ucwords(str_replace('_', ' ', $lst['status'])); ?>
          </span>
        </div>
        <div class="listing-body">
          <div class="listing-title"><?php echo htmlspecialchars($lst['title']); ?></div>
          <?php if (!empty($lst['suburb'])): ?>
          <div class="listing-suburb"><i class="far fa-map-marker-alt"></i> <?php echo htmlspecialchars($lst['suburb']); ?></div>
          <?php endif; ?>
          <div class="listing-meta">
            <?php if ($lst['bedrooms']): ?><span><i class="far fa-bed"></i> <?php echo (int)$lst['bedrooms']; ?> Bed</span><?php endif; ?>
            <?php if ($lst['bathrooms']): ?><span><i class="far fa-bath"></i> <?php echo (int)$lst['bathrooms']; ?> Bath</span><?php endif; ?>
            <?php if ($lst['car_spaces']): ?><span><i class="far fa-car"></i> <?php echo (int)$lst['car_spaces']; ?></span><?php endif; ?>
          </div>
          <?php if (!empty($lst['price'])): ?>
          <div class="listing-price"><?php echo htmlspecialchars($lst['price']); ?></div>
          <?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══ CTA ══════════════════════════════════════════════════════ -->
<section class="cta-section" aria-label="Call to action">
  <div class="cta-inner rv">
    <span class="stag">Ready to Start?</span>
    <h2 style="margin-top:14px">Let's Secure Your<br><span>Perfect Property Together.</span></h2>
    <p style="margin-top:18px">Join Perth homeowners and investors who trusted Titus to find their dream property — and saved an average of $45,000 in the process.</p>
    <div class="cta-btns" style="margin-top:36px">
      <a href="contact.php" class="btn-primary">
        Book Free Strategy Call
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
      <a href="tel:+61498439115" class="btn-outline">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
        +61 498 439 115
      </a>
    </div>
  </div>
</section>

<!-- ══ INLINE CONTACT ════════════════════════════════════════════ -->
<section class="contact-section" id="contact" aria-label="Contact form">
  <div class="contact-grid">

    <div class="rv">
      <span class="stag">Get In Touch</span>
      <h2 class="contact-info-left" style="margin:0">
        <span style="font-size:clamp(36px,5vw,58px);font-weight:700;text-transform:uppercase;line-height:1;letter-spacing:.03em;display:block;color:#fff;margin-top:14px">
          Start A<br>Conversation<br><span style="color:#8FA9B5">With Us.</span>
        </span>
      </h2>
      <div class="contact-details" style="margin-top:36px">
        <a href="tel:+61498439115" class="contact-item">
          <div class="c-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
          </div>
          +61 498 439 115
        </a>
        <a href="mailto:titus.buyersagent@gmail.com" class="contact-item">
          <div class="c-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
          </div>
          titus.buyersagent@gmail.com
        </a>
        <div class="contact-item">
          <div class="c-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
          </div>
          Perth City, Western Australia
        </div>
        <div class="contact-item">
          <div class="c-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          Mon–Fri 8:30AM–6PM · Sat 9AM–4PM
        </div>
      </div>
    </div>

    <div class="rv d2">
      <?php
      $flash = '';
      if (!empty($_GET['message'])) {
        if ($_GET['message'] === 'success') {
          $flash = '<div class="alert-box alert-success show">Message sent! Titus will be in touch within 2 hours during business hours.</div>';
        } elseif ($_GET['message'] === 'error') {
          $flash = '<div class="alert-box alert-error show">Something went wrong. Please try again or call directly.</div>';
        }
      }
      echo $flash;
      ?>
      <form action="sendemail.php" method="post" class="contact-form">
        <div class="form-row">
          <input class="form-field" type="text" name="username" placeholder="Your Full Name *" required>
          <input class="form-field" type="tel"  name="phone"    placeholder="Phone Number *"   required>
        </div>
        <input class="form-field" type="email" name="email" placeholder="Email Address *" required>
        <select class="form-field" name="subject" required>
          <option value="" disabled selected>What brings you here? *</option>
          <option value="First Home Buyer">I'm a First Home Buyer</option>
          <option value="Property Investor">I'm Looking to Invest</option>
          <option value="Upsizing">I'm Upsizing</option>
          <option value="Downsizing">I'm Downsizing</option>
          <option value="General Inquiry">General Question</option>
        </select>
        <textarea class="form-field" name="message" placeholder="Tell me about your property goals and budget range..." rows="5" required></textarea>
        <button type="submit" class="form-submit">
          Send Message
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </button>
        <p style="font-size:12px;color:rgba(255,255,255,.35);margin-top:10px">
          Your information is 100% secure and will never be shared.
        </p>
      </form>
    </div>

  </div>
</section>

<?php
$page_scripts = <<<JS
<script src="assets/js/aos.js"></script>
<script>
AOS.init({ once: true, offset: 60, duration: 700 });

/* ── Counter animation ── */
(function () {
  var counters = document.querySelectorAll('.stat-number[data-target]');
  if (!counters.length) return;
  var observer = new IntersectionObserver(function (entries, obs) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return;
      var el = entry.target;
      var target = parseInt(el.dataset.target, 10);
      var step = target / (1600 / 16);
      var cur = 0;
      var timer = setInterval(function () {
        cur += step;
        if (cur >= target) { cur = target; clearInterval(timer); }
        el.textContent = Math.floor(cur);
      }, 16);
      obs.unobserve(el);
    });
  }, { threshold: 0.4 });
  counters.forEach(function (el) { observer.observe(el); });
}());

/* ── Service accordion ── */
function toggleService(row) {
  var isOpen = row.classList.contains('open');
  document.querySelectorAll('.service-row').forEach(function (r) {
    r.classList.remove('open');
    var btn = r.querySelector('.service-header');
    if (btn) { btn.setAttribute('aria-expanded', 'false'); }
  });
  if (!isOpen) {
    row.classList.add('open');
    var btn = row.querySelector('.service-header');
    if (btn) { btn.setAttribute('aria-expanded', 'true'); }
  }
}

/* ── Nav scroll ── */
var nav = document.querySelector('.main-header');
window.addEventListener('scroll', function () {
  if (window.scrollY > 60) {
    nav.classList.add('fixed-header');
  } else {
    nav.classList.remove('fixed-header');
  }
}, { passive: true });
</script>
JS;

include_once 'includes/footer.php';
?>
