<?php
$page_title   = 'Titus Tuitoek — Perth\'s #1 Property Buyers Advocate';
$current_page = 'home';
require_once 'config/database.php';
$pdo = getDB();

define('TITO_IMG_DEFAULT', 'assets/images/tito/custom1.jpg');

$db_testimonials = getTestimonials($pdo);
$db_listings     = getListings($pdo, true, 3);

$fallback_testimonials = [
  ['name'=>'Sarah & James Wilson', 'role'=>'First Home Buyers, Scarborough',
   'text'=>'Working with Titus was the best decision we made. His market knowledge saved us over $45,000 on our dream home. Smooth and stress-free from start to finish.', 'rating'=>5],
  ['name'=>'Michael Chen', 'role'=>'Property Investor, Subiaco',
   'text'=>'As an interstate investor I was nervous about buying in Perth. Titus found me a property with 7% yield I never would have found on my own. Incredible service.', 'rating'=>5],
  ['name'=>'Emily & David Park', 'role'=>'Upsizing Family, Nedlands',
   'text'=>'We were outbid at three auctions before Titus stepped in. He secured our dream home $30,000 under asking price. I only wish we found him sooner!', 'rating'=>5],
];
$testimonials = $db_testimonials ?: $fallback_testimonials;

$flash = '';
if (!empty($_GET['message'])) {
  if ($_GET['message'] === 'success') {
    $flash = '<div class="pg-alert pg-alert-ok">Message sent! Titus will be in touch within 2 hours during business hours.</div>';
  } elseif ($_GET['message'] === 'error') {
    $flash = '<div class="pg-alert pg-alert-err">Something went wrong. Please try again or call directly.</div>';
  }
}

include_once 'includes/header.php';
?>
<!-- ──────────────────────── PAGE STYLES ──────────────────────── -->
<style>
/* Design tokens */
#pg-home{
  --brand:#6B705C;--brand-l:#9aab88;--brand-d:#4a4f3e;
  --n1:#1e3208;--n2:#2a4509;--n3:#385c10;
  --g-bg:rgba(0,0,0,.18);--g-bdr:rgba(255,255,255,.08);
  --t1:#fff;--t2:rgba(255,255,255,.78);--t3:rgba(255,255,255,.46);
  --bdr1:rgba(255,255,255,.08);--bdr2:rgba(107,112,92,.28);
  --sh:0 8px 36px rgba(0,0,0,.38),0 2px 8px rgba(0,0,0,.2);
  --sh-h:0 20px 56px rgba(0,0,0,.50),0 0 0 1px rgba(107,112,92,.25);
  --r:12px;--r-lg:20px;
  --font:'Quicksand',sans-serif;
  --t:all .25s cubic-bezier(.4,0,.2,1);
}
#pg-home,#pg-home *{box-sizing:border-box}
#pg-home h1,#pg-home h2,#pg-home h3,#pg-home h4,#pg-home h5{
  font-family:var(--font)!important;color:var(--t1)!important;line-height:1.1;margin:0;
}
#pg-home p{font-family:var(--font);color:var(--t2);line-height:1.8;margin:0}
#pg-home a{text-decoration:none;cursor:pointer}
#pg-home ul{list-style:none;padding:0;margin:0}
#pg-home img{display:block;max-width:100%}

/* Layout */
.pg-container{max-width:1180px;margin:0 auto;padding:0 48px}
.pg-section{background:var(--n2);padding:100px 0}
.pg-section.dark{background:var(--n1)}
.pg-section.mid{background:var(--n3)}

/* Label */
.pg-label{
  display:inline-flex;align-items:center;gap:10px;
  font-family:var(--font);font-size:10px;font-weight:700;
  letter-spacing:.35em;text-transform:uppercase;color:var(--brand);margin-bottom:16px;
}
.pg-label::before,.pg-label::after{
  content:'';display:block;width:20px;height:1px;background:var(--brand);opacity:.55;
}
/* Heading */
.pg-h2{font-size:clamp(28px,4vw,48px)!important;font-weight:800!important;letter-spacing:.01em}
.pg-h2 span{color:var(--brand)!important}

/* Buttons */
.pg-btn{
  display:inline-flex;align-items:center;justify-content:center;gap:9px;
  font-family:var(--font);font-size:12px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;cursor:pointer;border:none;transition:var(--t);
}
.pg-btn-solid{
  padding:15px 34px;background:var(--brand);color:var(--n1)!important;border-radius:var(--r);
}
.pg-btn-solid:hover{
  background:var(--brand-l);transform:translateY(-2px);
  box-shadow:0 12px 30px rgba(107,112,92,.45);color:var(--n1)!important;
}
.pg-btn-ghost{
  padding:14px 32px;background:transparent;border:1.5px solid rgba(255,255,255,.38);
  color:var(--t1)!important;border-radius:var(--r);
}
.pg-btn-ghost:hover{border-color:var(--brand);color:var(--brand)!important;background:rgba(107,112,92,.08)}

/* ══ ABOUT ══ */
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:72px;align-items:center}
.about-img-wrap{position:relative}
.about-img-inner{border-radius:var(--r-lg);overflow:hidden;box-shadow:var(--sh)}
.about-img-inner img{width:100%;height:520px;object-fit:cover;object-position:top center;transition:transform .6s ease;display:block}
.about-img-inner:hover img{transform:scale(1.04)}
.about-badge{
  position:absolute;bottom:24px;left:24px;background:var(--brand);
  padding:18px 24px;border-radius:var(--r);
  font-family:var(--font);font-size:12px;font-weight:700;letter-spacing:.05em;color:var(--n1);line-height:1.4;
}
.about-badge strong{font-size:28px;font-weight:800;display:block;line-height:1}
.about-checks{margin:24px 0;display:flex;flex-direction:column;gap:12px}
.about-check{
  display:flex;align-items:flex-start;gap:12px;
  font-family:var(--font);font-size:14px;font-weight:500;color:var(--t1);
}
.check-icon{
  width:22px;height:22px;background:rgba(107,112,92,.15);border:1px solid var(--bdr2);
  border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;
}
.check-icon svg{width:11px;height:11px;stroke:var(--brand)}

/* ══ SERVICES ══ */
.services-intro{text-align:center;margin-bottom:60px}
.services-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.svc-card{
  padding:32px 24px;border-radius:var(--r-lg);
  background:var(--g-bg);border:1px solid var(--bdr1);
  box-shadow:var(--sh);transition:var(--t);cursor:default;
}
.svc-card:hover{
  border-color:var(--bdr2);background:rgba(107,112,92,.1);
  transform:translateY(-6px);box-shadow:var(--sh-h);
}
.svc-icon{
  width:50px;height:50px;background:rgba(107,112,92,.12);
  border:1px solid var(--bdr2);border-radius:var(--r);
  display:flex;align-items:center;justify-content:center;
  margin-bottom:18px;transition:var(--t);
}
.svc-icon svg{width:22px;height:22px;stroke:var(--brand);fill:none;stroke-width:1.8}
.svc-card:hover .svc-icon{background:var(--brand);border-color:var(--brand)}
.svc-card:hover .svc-icon svg{stroke:var(--n1)}
.svc-card h4{font-size:15px!important;font-weight:700!important;margin-bottom:10px!important}
.svc-card p{font-size:13px;color:var(--t3);line-height:1.7;margin:0}

/* ══ PROCESS ══ */
.process-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2px;margin-top:56px}
.proc-card{
  padding:52px 36px;border:1px solid var(--bdr1);
  background:rgba(0,0,0,.1);transition:var(--t);
}
.proc-card:hover{background:rgba(107,112,92,.08);border-color:var(--bdr2)}
.proc-num{
  font-family:var(--font);font-size:60px;font-weight:200;
  color:rgba(107,112,92,.18);line-height:1;display:block;margin-bottom:20px;
}
.proc-card h4{font-size:18px!important;font-weight:700!important;margin-bottom:14px!important}
.proc-card p{font-size:14px;color:var(--t2);line-height:1.8}

/* ══ TESTIMONIALS ══ */
.testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:52px}
.testi-card{
  padding:36px;border-radius:var(--r-lg);
  background:var(--g-bg);border:1px solid var(--bdr1);
  box-shadow:var(--sh);transition:var(--t);
}
.testi-card:hover{border-color:var(--bdr2);transform:translateY(-4px);box-shadow:var(--sh-h)}
.testi-quote{
  font-family:Georgia,serif;font-size:52px;line-height:1;
  color:var(--brand);opacity:.4;display:block;margin-bottom:12px;
}
.testi-stars{display:flex;gap:3px;margin-bottom:14px}
.testi-stars svg{width:13px;height:13px;fill:#f59e0b;stroke:none}
.testi-text{font-size:14px;color:var(--t2);line-height:1.8;font-style:italic;margin-bottom:24px}
.testi-author{display:flex;align-items:center;gap:14px}
.testi-avatar{
  width:46px;height:46px;border-radius:50%;
  background:linear-gradient(135deg,var(--brand-d),var(--brand));
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font);font-size:18px;font-weight:700;color:var(--n1);
  flex-shrink:0;overflow:hidden;
}
.testi-avatar img{width:100%;height:100%;object-fit:cover}
.testi-name{font-family:var(--font);font-size:14px;font-weight:700;color:var(--t1);margin-bottom:3px}
.testi-role{font-family:var(--font);font-size:11px;color:var(--brand);letter-spacing:.04em}

/* ══ LISTINGS ══ */
.listings-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:52px}
.lst-card{border-radius:var(--r-lg);overflow:hidden;background:rgba(0,0,0,.15);box-shadow:var(--sh);border:1px solid var(--bdr1);transition:var(--t)}
.lst-card:hover{transform:translateY(-6px);box-shadow:var(--sh-h);border-color:var(--bdr2)}
.lst-img{position:relative;height:210px;overflow:hidden}
.lst-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease;display:block}
.lst-card:hover .lst-img img{transform:scale(1.07)}
.lst-badge{
  position:absolute;top:14px;left:14px;
  font-family:var(--font);font-size:10px;font-weight:700;
  letter-spacing:.08em;text-transform:uppercase;padding:5px 13px;border-radius:50px;
}
.lst-badge.available{background:#22c55e;color:#fff}
.lst-badge.sold{background:#ef4444;color:#fff}
.lst-badge.under_offer{background:#f59e0b;color:var(--n1)}
.lst-body{padding:22px}
.lst-title{font-family:var(--font);font-size:16px;font-weight:700;color:var(--t1);margin-bottom:5px}
.lst-suburb{font-size:11px;color:var(--brand);letter-spacing:.05em;margin-bottom:12px;display:flex;align-items:center;gap:5px}
.lst-suburb svg{width:11px;height:11px;stroke:var(--brand);flex-shrink:0}
.lst-meta{display:flex;gap:14px;margin-bottom:12px}
.lst-meta span{font-size:12px;color:var(--t3);display:flex;align-items:center;gap:5px}
.lst-meta svg{width:12px;height:12px;stroke:var(--t3)}
.lst-price{font-family:var(--font);font-size:20px;font-weight:700;color:var(--brand)}

/* ══ CTA ══ */
#pg-cta{position:relative;overflow:hidden;padding:110px 0;background:var(--n1)}
#pg-cta .cta-bg{position:absolute;inset:0;background-image:url(assets/images/tito/custom2.jpg);background-size:cover;background-position:center;filter:brightness(.2) saturate(.6)}
#pg-cta .cta-overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(30,50,8,.88) 0%,rgba(42,69,9,.75) 100%)}
#pg-cta .cta-inner{position:relative;z-index:1;text-align:center;max-width:860px;margin:0 auto;padding:0 48px}
#pg-cta h2{font-size:clamp(30px,5vw,54px)!important;font-weight:800!important;text-transform:uppercase;letter-spacing:.02em;margin-bottom:18px!important}
#pg-cta h2 span{color:var(--brand)!important}
#pg-cta .cta-sub{font-size:16px;color:var(--t2);line-height:1.75;max-width:580px;margin:0 auto 38px}
.cta-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}

/* ══ CONTACT ══ */
#pg-contact{background:var(--n2);padding:100px 0}
.contact-grid{display:grid;grid-template-columns:1fr 1.1fr;gap:80px;align-items:start}
.contact-left h2{font-size:clamp(34px,4.5vw,54px)!important;font-weight:800!important;text-transform:uppercase;line-height:1;letter-spacing:.02em;margin-bottom:32px!important}
.contact-left h2 span{color:var(--brand)!important}
.contact-details{display:flex;flex-direction:column;gap:15px}
.c-item{display:flex;align-items:center;gap:14px;font-family:var(--font);font-size:14px;color:var(--t2);text-decoration:none;transition:var(--t)}
.c-item:hover{color:var(--t1)}
.c-icon{width:42px;height:42px;flex-shrink:0;border:1px solid var(--bdr2);border-radius:var(--r);display:flex;align-items:center;justify-content:center;background:rgba(107,112,92,.08)}
.c-icon svg{width:16px;height:16px;stroke:var(--brand);fill:none;stroke-width:1.8}
/* Form */
.pg-form{display:flex;flex-direction:column;gap:12px}
.pg-form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.pg-input{
  width:100%;padding:13px 17px;background:rgba(0,0,0,.15);
  border:1px solid var(--bdr1);border-radius:var(--r);
  color:var(--t1)!important;font-family:var(--font);font-size:14px;
  outline:none;transition:var(--t);
}
.pg-input::placeholder{color:var(--t3)!important}
.pg-input:focus{border-color:var(--bdr2);background:rgba(0,0,0,.22)}
textarea.pg-input{min-height:118px;resize:vertical}
select.pg-input{
  -webkit-appearance:none;appearance:none;cursor:pointer;
  background-image:url("data:image/svg+xml;utf8,<svg fill='%236B705C' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
  background-repeat:no-repeat;background-position:right 14px center;
}
select.pg-input option{background:var(--n1);color:#fff}
.pg-submit{
  padding:15px 32px;background:var(--brand);color:var(--n1)!important;
  border:none;cursor:pointer;border-radius:var(--r);
  font-family:var(--font);font-size:12px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;
  display:inline-flex;align-items:center;gap:9px;
  transition:var(--t);align-self:flex-start;
}
.pg-submit:hover{background:var(--brand-l);transform:translateY(-2px);box-shadow:0 10px 28px rgba(107,112,92,.4)}
.pg-fine{font-size:11px;color:var(--t3);margin-top:6px}
/* Alerts */
.pg-alert{padding:14px 18px;border-radius:var(--r);font-family:var(--font);font-size:13px;font-weight:600;margin-bottom:14px}
.pg-alert-ok{background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.3);color:#86efac}
.pg-alert-err{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#fca5a5}

/* Scroll reveal */
.rv{opacity:0;transform:translateY(24px);transition:opacity .65s ease,transform .65s ease}
.rv.vis{opacity:1;transform:translateY(0)}
.rv.d1{transition-delay:.1s}.rv.d2{transition-delay:.2s}
.rv.d3{transition-delay:.32s}.rv.d4{transition-delay:.44s}

/* ══ Responsive ══ */
@media(max-width:1100px){
  .services-grid{grid-template-columns:repeat(2,1fr)}
  .about-grid{gap:44px}
  .testi-grid{grid-template-columns:1fr 1fr}
  .testi-grid .testi-card:nth-child(3){grid-column:span 2}
}
@media(max-width:900px){
  .pg-container{padding:0 28px}
  .about-grid{grid-template-columns:1fr;gap:36px}
  .about-img-inner img{height:360px}
  .about-badge{display:none}
  .services-grid{grid-template-columns:1fr 1fr}
  .process-grid{grid-template-columns:1fr}
  .testi-grid{grid-template-columns:1fr}
  .testi-grid .testi-card:nth-child(3){grid-column:auto}
  .listings-grid{grid-template-columns:1fr 1fr}
  .contact-grid{grid-template-columns:1fr;gap:44px}
  .pg-section{padding:72px 0}
}
@media(max-width:640px){
  .pg-container{padding:0 20px}
  .about-img-inner img{height:280px}
  .services-grid{grid-template-columns:1fr}
  .listings-grid{grid-template-columns:1fr}
  .pg-form-row{grid-template-columns:1fr}
  .cta-btns{flex-direction:column;align-items:center}
  #pg-cta .cta-inner{padding:0 20px}
  .proc-card{padding:36px 22px}
  @media(prefers-reduced-motion:reduce){
    .rv,.svc-card:hover,.testi-card:hover,.lst-card:hover{transform:none;transition:none}
  }
}
</style>

<div id="pg-home">

<!-- ══ CAROUSEL (original template split: property + Titus) ══ -->
<section class="banner-style-two" aria-label="Hero">
  <div class="large-container">
    <div class="row clearfix">

      <!-- Left: property image slider -->
      <div class="col-lg-8 col-md-12 col-sm-12 slider-block">
        <div class="slider-content">
          <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">

            <div class="single-item">
              <figure class="image-box">
                <img src="assets/images/banner/banner-05.jpg" alt="Perth property interior">
              </figure>
              <div class="content-box">
                <div class="icon-box"><img src="assets/images/icons/icon-6.png" alt=""></div>
                <h2>LOOKING TO BUY <span>IN PERTH?</span></h2>
                <ul class="info clearfix">
                  <li><i class="far fa-map-marker-alt"></i>PERTH, <span>Western Australia</span></li>
                  <li><i class="icon-20"></i>Local Expertise</li>
                </ul>
              </div>
            </div>

            <div class="single-item">
              <figure class="image-box">
                <img src="assets/images/banner/banner-04.jpg" alt="Perth home exterior">
              </figure>
              <div class="content-box">
                <div class="icon-box"><img src="assets/images/icons/icon-6.png" alt=""></div>
                <h2>YOUR LOCAL <span>BUYERS ADVOCATES</span></h2>
                <ul class="info clearfix">
                  <li><i class="far fa-map-marker-alt"></i>PERTH, <span>Western Australia</span></li>
                  <li><i class="icon-20"></i>Market Knowledge</li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Right: Titus photo -->
      <div class="col-lg-4 col-md-12 col-sm-12 image-column">
        <div class="image-inner">
          <figure class="image">
            <img src="assets/images/tito/titus.jpeg" alt="Titus Tuitoek — Perth Buyers Advocate">
          </figure>
          <div class="text">
            <h6>EXPERT GUIDANCE</h6>
            <p>Making property buying a breeze</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══ WHAT WE DO — straight after carousel ══ -->
<section id="pg-services" class="pg-section" aria-label="What We Do">
  <div class="pg-container">
    <div class="services-intro rv">
      <div class="pg-label">What We Do</div>
      <h2 class="pg-h2" style="margin-top:10px">
        Your Aspiration,<br><span>Our Expertise.</span>
      </h2>
      <p style="font-size:15px;color:rgba(255,255,255,.68);max-width:520px;margin:14px auto 0;line-height:1.75">
        From your first search to settlement day, we handle every detail so you don't have to.
      </p>
    </div>
    <div class="services-grid">
      <?php
      $svcs = [
        ['Full Buying Service','End-to-end acquisition from consultation to settlement — handling everything for busy professionals.',
         '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
        ['Property Search','Targeted search with exclusive access to off-market opportunities unavailable to the general public.',
         '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>'],
        ['Expert Negotiation','Data-backed negotiation that consistently secures below-market prices, giving you instant equity.',
         '<path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>'],
        ['Auction Representation','Strategic bidding by professionals who understand auction dynamics — removing emotion from the equation.',
         '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>'],
        ['Market Analysis','Accurate valuations and deep analysis so you never overpay for any Perth property.',
         '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>'],
        ['Due Diligence','Forensic investigation of titles, zoning, council regulations and building reports to protect your investment.',
         '<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>'],
        ['Investment Strategy','Personalised strategies aligned with your financial goals, focused on high-yield Perth growth corridors.',
         '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>'],
        ['Settlement Support','Coordinating with conveyancers and lenders to ensure a smooth, stress-free settlement every time.',
         '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>'],
      ];
      foreach ($svcs as $i => $s): ?>
      <div class="svc-card rv d<?php echo ($i % 4) + 1; ?>">
        <div class="svc-icon">
          <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><?php echo $s[2]; ?></svg>
        </div>
        <h4><?php echo $s[0]; ?></h4>
        <p><?php echo $s[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:44px" class="rv">
      <a href="service.php" class="pg-btn pg-btn-solid">
        View All Services
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ══ ABOUT ══ -->
<section class="pg-section dark" id="pg-about" aria-label="About Titus">
  <div class="pg-container">
    <div class="about-grid">
      <div class="about-img-wrap rv">
        <div class="about-img-inner">
          <img src="assets/images/tito/titus.jpeg" alt="Titus Tuitoek — Perth Property Buyers Advocate" loading="lazy">
        </div>
        <div class="about-badge"><strong>5+</strong>Years Perth Market Expertise</div>
      </div>
      <div class="rv d2">
        <div class="pg-label">Who We Are</div>
        <h2 class="pg-h2" style="margin-bottom:18px">Perth's Premier<br><span>Buyers Advocates</span></h2>
        <p style="font-size:15px;color:rgba(255,255,255,.72);margin-bottom:12px">At Titus Tuitoek Buyers Agent, we specialise in guiding clients through the Perth real estate market — from first-time buyers to seasoned investors. We work exclusively for you, never the seller.</p>
        <p style="font-size:15px;color:rgba(255,255,255,.72)">Our deep understanding of Western Australian property cycles, combined with relentless negotiation, consistently delivers results that surprise and delight our clients.</p>
        <ul class="about-checks">
          <?php foreach(['Save months of stressful searching','Access exclusive off-market listings','Expert negotiation — average $45K+ savings','Full support from search to settlement'] as $c): ?>
          <li class="about-check">
            <div class="check-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div><?php echo $c; ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:26px">
          <a href="about.php" class="pg-btn pg-btn-solid">Meet Titus</a>
          <a href="service.php" class="pg-btn pg-btn-ghost">Our Services</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ PROCESS ══ -->
<section class="pg-section mid" id="pg-process" aria-label="How it works">
  <div class="pg-container">
    <div class="rv" style="text-align:center">
      <div class="pg-label">The Process</div>
      <h2 class="pg-h2" style="margin-top:10px">How We Help<br><span>You Win.</span></h2>
    </div>
    <div class="process-grid">
      <div class="proc-card rv d1">
        <span class="proc-num">01</span>
        <h4>Discovery Call</h4>
        <p>A free 15-minute no-obligation strategy call to understand your goals, budget, and must-haves. Zero pressure — pure value and insight from day one.</p>
      </div>
      <div class="proc-card rv d2">
        <span class="proc-num">02</span>
        <h4>Search & Shortlist</h4>
        <p>We scour on-market and off-market listings, inspect properties on your behalf, and present only the best-matched opportunities with full analysis.</p>
      </div>
      <div class="proc-card rv d3">
        <span class="proc-num">03</span>
        <h4>Secure & Settle</h4>
        <p>We negotiate aggressively, manage all contracts, and coordinate your full settlement — you simply collect the keys to your perfect Perth property.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ TESTIMONIALS ══ -->
<section class="pg-section" id="pg-testimonials" aria-label="Client testimonials">
  <div class="pg-container">
    <div class="rv" style="text-align:center">
      <div class="pg-label">Client Stories</div>
      <h2 class="pg-h2" style="margin-top:10px">What Our<br><span>Clients Say.</span></h2>
    </div>
    <div class="testi-grid">
      <?php foreach ($testimonials as $i => $t): ?>
      <div class="testi-card rv d<?php echo $i + 1; ?>">
        <span class="testi-quote" aria-hidden="true">&ldquo;</span>
        <div class="testi-stars" aria-label="<?php echo (int)($t['rating'] ?? 5); ?> stars">
          <?php for ($s = 0; $s < (int)($t['rating'] ?? 5); $s++): ?>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <?php endfor; ?>
        </div>
        <p class="testi-text"><?php echo htmlspecialchars($t['text']); ?></p>
        <div class="testi-author">
          <div class="testi-avatar" aria-hidden="true">
            <?php if (!empty($t['photo'])): ?>
            <img src="<?php echo htmlspecialchars($t['photo']); ?>" alt="">
            <?php else: echo strtoupper(substr($t['name'], 0, 1)); ?>
            <?php endif; ?>
          </div>
          <div>
            <div class="testi-name"><?php echo htmlspecialchars($t['name']); ?></div>
            <div class="testi-role"><?php echo htmlspecialchars($t['role'] ?? ''); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if (!empty($db_listings)): ?>
<!-- ══ LISTINGS ══ -->
<section class="pg-section dark" id="pg-listings" aria-label="Recent property wins">
  <div class="pg-container">
    <div class="rv" style="text-align:center">
      <div class="pg-label">Recent Wins</div>
      <h2 class="pg-h2" style="margin-top:10px">Properties We've<br><span>Secured for Clients.</span></h2>
    </div>
    <div class="listings-grid">
      <?php foreach ($db_listings as $i => $lst): ?>
      <article class="lst-card rv d<?php echo $i + 1; ?>">
        <div class="lst-img">
          <img src="<?php echo !empty($lst['image']) ? htmlspecialchars($lst['image']) : TITO_IMG_DEFAULT; ?>"
               alt="<?php echo htmlspecialchars($lst['title']); ?>" loading="lazy">
          <span class="lst-badge <?php echo htmlspecialchars($lst['status']); ?>">
            <?php echo ucwords(str_replace('_', ' ', $lst['status'])); ?>
          </span>
        </div>
        <div class="lst-body">
          <div class="lst-title"><?php echo htmlspecialchars($lst['title']); ?></div>
          <?php if (!empty($lst['suburb'])): ?>
          <div class="lst-suburb">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo htmlspecialchars($lst['suburb']); ?>
          </div>
          <?php endif; ?>
          <div class="lst-meta">
            <?php if ($lst['bedrooms']): ?><span><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg><?php echo (int)$lst['bedrooms']; ?> Bed</span><?php endif; ?>
            <?php if ($lst['bathrooms']): ?><span><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M9 6L9 2M3 20h18M3 12h18v4a4 4 0 01-4 4H7a4 4 0 01-4-4v-4z"/></svg><?php echo (int)$lst['bathrooms']; ?> Bath</span><?php endif; ?>
          </div>
          <?php if (!empty($lst['price'])): ?><div class="lst-price"><?php echo htmlspecialchars($lst['price']); ?></div><?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══ CTA ══ -->
<section id="pg-cta" aria-label="Call to action">
  <div class="cta-bg"></div>
  <div class="cta-overlay"></div>
  <div class="cta-inner rv">
    <div class="pg-label" style="justify-content:center">Ready to Start?</div>
    <h2 style="margin-top:14px">Let's Secure Your<br><span>Perfect Property Together.</span></h2>
    <p class="cta-sub" style="margin-top:14px">Join Perth homeowners and investors who trusted Titus to find their dream property — and saved an average of $45,000 in the process.</p>
    <div class="cta-btns" style="margin-top:34px">
      <a href="contact.php" class="pg-btn pg-btn-solid">
        Book Free Strategy Call
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
      <a href="tel:+61498439115" class="pg-btn pg-btn-ghost">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013 5.18a2 2 0 012-2.18h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L9.91 10.91a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
        +61 498 439 115
      </a>
    </div>
  </div>
</section>

<!-- ══ CONTACT ══ -->
<section id="pg-contact" aria-label="Contact form">
  <div class="pg-container">
    <div class="contact-grid">
      <div class="rv">
        <div class="pg-label">Get In Touch</div>
        <h2 class="contact-left" style="margin-top:12px">
          Start A<br>Conversation<br><span style="color:#6B705C">With Us.</span>
        </h2>
        <div class="contact-details" style="margin-top:32px">
          <a href="tel:+61498439115" class="c-item">
            <div class="c-icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013 5.18a2 2 0 012-2.18h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L9.91 10.91a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg></div>
            +61 498 439 115
          </a>
          <a href="mailto:titus.buyersagent@gmail.com" class="c-item">
            <div class="c-icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            titus.buyersagent@gmail.com
          </a>
          <div class="c-item">
            <div class="c-icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            Perth City, Western Australia
          </div>
          <div class="c-item">
            <div class="c-icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
            Mon–Fri 8:30AM–6PM · Sat 9AM–4PM
          </div>
        </div>
      </div>
      <div class="rv d2">
        <?php echo $flash; ?>
        <form action="sendemail.php" method="post" class="pg-form">
          <div class="pg-form-row">
            <input class="pg-input" type="text"  name="username" placeholder="Your Full Name *"  required>
            <input class="pg-input" type="tel"   name="phone"    placeholder="Phone Number *"    required>
          </div>
          <input class="pg-input" type="email" name="email" placeholder="Email Address *" required>
          <select class="pg-input" name="subject" required>
            <option value="" disabled selected>What brings you here? *</option>
            <option value="First Home Buyer">I'm a First Home Buyer</option>
            <option value="Property Investor">I'm Looking to Invest</option>
            <option value="Upsizing">I'm Upsizing</option>
            <option value="Downsizing">I'm Downsizing</option>
            <option value="General Inquiry">General Question</option>
          </select>
          <textarea class="pg-input" name="message" placeholder="Tell me about your property goals and budget range..." rows="5" required></textarea>
          <button type="submit" class="pg-submit">
            Send Message
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
          </button>
          <p class="pg-fine">Your information is 100% secure and will never be shared.</p>
        </form>
      </div>
    </div>
  </div>
</section>

</div><!-- /#pg-home -->

<?php
$page_scripts = <<<JS
<script src="assets/js/aos.js"></script>
<script>
AOS.init({once:true,offset:60,duration:700});

/* Scroll reveal */
(function(){
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if(e.isIntersecting){e.target.classList.add('vis');io.unobserve(e.target);}
    });
  },{threshold:.1});
  document.querySelectorAll('#pg-home .rv').forEach(function(el){io.observe(el);});
}());

/* Sticky nav */
(function(){
  var nav = document.querySelector('.main-header');
  if(!nav) return;
  window.addEventListener('scroll',function(){
    nav.classList.toggle('fixed-header', window.scrollY>60);
  },{passive:true});
}());
</script>
JS;

include_once 'includes/footer.php';
?>
