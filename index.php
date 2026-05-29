<?php
$page_title   = 'Titus Tuitoek — Perth\'s #1 Property Buyers Advocate';
$current_page = 'home';
require_once 'config/database.php';
$pdo = getDB();

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
<!-- ─────────────────────────── PAGE STYLES ─────────────────────────── -->
<style>
/* ── Design tokens (UI/UX Pro Max: Glassmorphism + Trust & Authority) ── */
#pg-home{
  --brand:#6B705C;--brand-l:#9aab88;--brand-d:#4a4f3e;
  --gold:#c9a84c;--gold-l:rgba(201,168,76,.18);
  --n1:#1e3208;--n2:#2a4509;--n3:#385c10;
  --g-bg:rgba(255,255,255,.05);--g-bdr:rgba(255,255,255,.09);
  --g-blur:14px;
  --t1:#ffffff;--t2:rgba(255,255,255,.78);--t3:rgba(255,255,255,.48);
  --bdr1:rgba(255,255,255,.08);--bdr2:rgba(107,112,92,.22);
  --sh:0 8px 36px rgba(0,0,0,.45),0 2px 8px rgba(0,0,0,.25);
  --sh-h:0 20px 56px rgba(0,0,0,.55),0 0 0 1px rgba(107,112,92,.25);
  --r:12px;--r-lg:20px;
  --font:'Quicksand',sans-serif;
  --t:all .25s cubic-bezier(.4,0,.2,1);
}
/* ── Reset inside page ── */
#pg-home,#pg-home *{box-sizing:border-box}
#pg-home h1,#pg-home h2,#pg-home h3,#pg-home h4,#pg-home h5{
  font-family:var(--font)!important;color:var(--t1)!important;
  line-height:1.1;margin:0;
}
#pg-home p{font-family:var(--font);color:var(--t2);line-height:1.8;margin:0}
#pg-home a{text-decoration:none;cursor:pointer}
#pg-home ul{list-style:none;padding:0;margin:0}
#pg-home img{display:block;max-width:100%}
/* ── Layout ── */
.pg-container{max-width:1180px;margin:0 auto;padding:0 48px}
.pg-section{background:var(--n2);padding:100px 0}
.pg-section.dark{background:var(--n1)}
.pg-section.mid{background:var(--n3)}
/* ── Labels / Tags ── */
.pg-label{
  display:inline-flex;align-items:center;gap:10px;
  font-family:var(--font);font-size:10px;font-weight:700;
  letter-spacing:.35em;text-transform:uppercase;color:var(--brand);
  margin-bottom:16px;
}
.pg-label::before,.pg-label::after{
  content:'';display:block;width:20px;height:1px;
  background:var(--brand);opacity:.55;
}
/* ── Headings ── */
.pg-h2{
  font-size:clamp(28px,4vw,48px)!important;font-weight:800!important;
  letter-spacing:.01em;
}
.pg-h2 span{color:var(--brand)!important}
/* ── Buttons ── */
.pg-btn{
  display:inline-flex;align-items:center;justify-content:center;gap:9px;
  font-family:var(--font);font-size:12px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;cursor:pointer;
  border:none;transition:var(--t);
}
.pg-btn-solid{
  padding:15px 34px;background:var(--brand);color:var(--n1)!important;
  border-radius:var(--r);
}
.pg-btn-solid:hover{
  background:var(--brand-l);transform:translateY(-2px);
  box-shadow:0 12px 30px rgba(107,112,92,.45);color:var(--n1)!important;
}
.pg-btn-ghost{
  padding:14px 32px;background:transparent;
  border:1.5px solid rgba(255,255,255,.35);color:var(--t1)!important;
  border-radius:var(--r);
}
.pg-btn-ghost:hover{border-color:var(--brand);color:var(--brand)!important;background:rgba(107,112,92,.06)}
/* ── Glass card ── */
.pg-card{
  background:var(--g-bg);
  border:1px solid var(--g-bdr);
  border-radius:var(--r-lg);
  box-shadow:var(--sh);
  -webkit-backdrop-filter:blur(var(--g-blur));
  backdrop-filter:blur(var(--g-blur));
  transition:var(--t);
}
.pg-card:hover{
  box-shadow:var(--sh-h);
  border-color:var(--bdr2);
  transform:translateY(-5px);
}

/* ════════════════════════ HERO ════════════════════════ */
#pg-hero{
  position:relative;overflow:hidden;background:var(--n1);
  min-height:100vh;display:flex;flex-direction:column;
}
/* Owl carousel full-bg approach */
#pg-hero .single-item-carousel{min-height:100vh}
#pg-hero .single-item{
  position:relative;min-height:100vh;
  display:flex!important;align-items:center;
}
#pg-hero .hero-bg-img{
  position:absolute;inset:0;z-index:0;
  background-size:cover;background-position:center;
  filter:brightness(.62) saturate(.92);
  transition:transform 8s ease;
}
#pg-hero .single-item:hover .hero-bg-img{transform:scale(1.04)}
/* Olive-tinted overlay: strong left so text is readable, transparent right so image shows through */
#pg-hero .hero-gradient{
  position:absolute;inset:0;z-index:1;
  background:linear-gradient(
    105deg,
    rgba(30,50,8,.88) 0%,
    rgba(42,69,9,.62) 38%,
    rgba(56,92,16,.30) 65%,
    rgba(56,92,16,.08) 100%
  );
}
#pg-hero .hero-content{
  position:relative;z-index:2;
  max-width:820px;padding:0 48px;
  padding-top:40px;
}
.hero-badge{
  display:inline-flex;align-items:center;gap:10px;
  background:rgba(107,112,92,.12);
  border:1px solid rgba(107,112,92,.28);
  padding:8px 18px;border-radius:50px;
  font-family:var(--font);font-size:10px;font-weight:700;
  letter-spacing:.3em;text-transform:uppercase;color:var(--brand);
  margin-bottom:26px;
}
.hero-badge::before{
  content:'';width:7px;height:7px;border-radius:50%;
  background:var(--brand);animation:pulse-dot 2s infinite;
}
@keyframes pulse-dot{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(1.5)}}
#pg-hero h1{
  font-size:clamp(46px,7.5vw,90px)!important;
  font-weight:800!important;line-height:.95!important;
  letter-spacing:.015em;text-transform:uppercase;
  margin-bottom:22px;
}
#pg-hero h1 em{
  font-style:italic;font-weight:300!important;
  color:var(--brand)!important;display:block;
}
.hero-sub{
  font-size:clamp(15px,1.6vw,18px);color:var(--t2);
  line-height:1.75;max-width:560px;margin-bottom:38px;
}
.hero-ctas{display:flex;gap:14px;flex-wrap:wrap}

/* ── Stats strip (glassmorphism) ── */
.hero-stats{
  position:relative;z-index:10;
  background:rgba(30,50,8,.85);
  -webkit-backdrop-filter:blur(20px);backdrop-filter:blur(20px);
  border-top:1px solid var(--bdr1);
}
.stats-row{
  display:grid;grid-template-columns:repeat(4,1fr);
  max-width:1180px;margin:0 auto;padding:0 48px;
}
.stat-box{
  text-align:center;padding:30px 20px;
  border-right:1px solid var(--bdr1);
}
.stat-box:last-child{border-right:none}
.stat-num{
  font-family:var(--font);font-size:clamp(36px,5vw,60px);
  font-weight:300;color:var(--brand);line-height:1;display:block;
}
.stat-sfx{font-size:clamp(22px,3vw,36px);font-weight:300;color:var(--brand)}
.stat-lbl{
  font-family:var(--font);font-size:10px;font-weight:700;
  letter-spacing:.2em;text-transform:uppercase;color:var(--t3);
  margin-top:8px;display:block;
}

/* ════════════════════════ ABOUT ════════════════════════ */
#pg-about{background:linear-gradient(180deg,var(--n1) 0%,var(--n2) 100%)}
.about-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:72px;
  align-items:center;
}
.about-img-wrap{position:relative}
.about-img-inner{
  position:relative;border-radius:var(--r-lg);overflow:hidden;
  box-shadow:var(--sh);
}
.about-img-inner img{
  width:100%;height:520px;object-fit:cover;object-position:top center;
  transition:transform .6s ease;display:block;
}
.about-img-inner:hover img{transform:scale(1.04)}
.about-img-badge{
  position:absolute;bottom:24px;left:24px;
  background:var(--brand);padding:18px 24px;
  border-radius:var(--r);
  font-family:var(--font);font-size:12px;font-weight:700;
  letter-spacing:.05em;color:var(--n1);line-height:1.4;
}
.about-img-badge strong{font-size:28px;font-weight:800;display:block;line-height:1}
.about-text p{color:var(--t2);font-size:15px;line-height:1.85;margin-bottom:14px}
.about-checks{margin:24px 0;display:flex;flex-direction:column;gap:12px}
.about-check{
  display:flex;align-items:flex-start;gap:12px;
  font-family:var(--font);font-size:14px;font-weight:500;color:var(--t1);
}
.check-icon{
  width:22px;height:22px;background:rgba(107,112,92,.15);
  border:1px solid var(--bdr2);border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;margin-top:1px;
}
.check-icon svg{width:11px;height:11px;stroke:var(--brand)}
.about-ctas{display:flex;gap:12px;flex-wrap:wrap;margin-top:30px}

/* ════════════════════════ SERVICES ════════════════════════ */
#pg-services{background:var(--n2)}
.services-intro{text-align:center;margin-bottom:64px}
.services-intro .pg-sub{
  font-size:15px;color:var(--t2);max-width:520px;
  margin:14px auto 0;line-height:1.7;
}
.services-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:16px;
}
.svc-card{
  padding:32px 26px;border-radius:var(--r-lg);
  background:var(--g-bg);
  border:1px solid var(--bdr1);
  box-shadow:var(--sh);
  transition:var(--t);cursor:default;
}
.svc-card:hover{
  border-color:var(--bdr2);
  background:rgba(107,112,92,.06);
  transform:translateY(-6px);
  box-shadow:var(--sh-h);
}
.svc-icon{
  width:52px;height:52px;
  background:rgba(107,112,92,.1);
  border:1px solid var(--bdr2);
  border-radius:var(--r);
  display:flex;align-items:center;justify-content:center;
  margin-bottom:20px;transition:var(--t);
}
.svc-icon svg{width:22px;height:22px;stroke:var(--brand);fill:none;stroke-width:1.8}
.svc-card:hover .svc-icon{background:var(--brand);border-color:var(--brand)}
.svc-card:hover .svc-icon svg{stroke:var(--n1)}
.svc-card h4{
  font-size:15px!important;font-weight:700!important;
  margin-bottom:10px!important;
}
.svc-card p{font-size:13px;color:var(--t3);line-height:1.7}

/* ════════════════════════ PROCESS ════════════════════════ */
#pg-process{background:var(--n3)}
.process-intro{text-align:center;margin-bottom:64px}
.process-grid{
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:2px;
}
.proc-card{
  padding:52px 36px;border:1px solid var(--bdr1);
  background:rgba(255,255,255,.02);
  transition:var(--t);
}
.proc-card:hover{background:rgba(107,112,92,.05);border-color:var(--bdr2)}
.proc-num{
  font-family:var(--font);font-size:64px;font-weight:200;
  color:rgba(107,112,92,.12);line-height:1;display:block;margin-bottom:20px;
}
.proc-card h4{
  font-size:18px!important;font-weight:700!important;margin-bottom:14px!important;
}
.proc-card p{font-size:14px;color:var(--t2);line-height:1.8}

/* ════════════════════════ TESTIMONIALS ════════════════════════ */
#pg-testimonials{background:linear-gradient(180deg,var(--n2) 0%,var(--n1) 100%)}
.testi-intro{text-align:center;margin-bottom:60px}
.testi-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.testi-card{
  padding:36px;border-radius:var(--r-lg);
  background:var(--g-bg);border:1px solid var(--bdr1);
  box-shadow:var(--sh);transition:var(--t);
}
.testi-card:hover{border-color:var(--bdr2);transform:translateY(-4px);box-shadow:var(--sh-h)}
.testi-quote{
  font-family:Georgia,serif;font-size:56px;line-height:1;
  color:var(--brand);opacity:.35;display:block;margin-bottom:14px;
}
.testi-stars{display:flex;gap:3px;margin-bottom:16px}
.testi-stars svg{width:14px;height:14px;fill:#f59e0b;stroke:none}
.testi-text{
  font-size:14px;color:var(--t2);line-height:1.8;
  font-style:italic;margin-bottom:26px;
}
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

/* ════════════════════════ LISTINGS ════════════════════════ */
#pg-listings{background:var(--n2)}
.listings-intro{text-align:center;margin-bottom:60px}
.listings-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px}
.lst-card{
  border-radius:var(--r-lg);overflow:hidden;
  background:var(--n3);box-shadow:var(--sh);
  border:1px solid var(--bdr1);transition:var(--t);
}
.lst-card:hover{transform:translateY(-6px);box-shadow:var(--sh-h);border-color:var(--bdr2)}
.lst-img{position:relative;height:210px;overflow:hidden}
.lst-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease;display:block}
.lst-card:hover .lst-img img{transform:scale(1.07)}
.lst-badge{
  position:absolute;top:14px;left:14px;
  font-family:var(--font);font-size:10px;font-weight:700;
  letter-spacing:.08em;text-transform:uppercase;
  padding:5px 13px;border-radius:50px;
}
.lst-badge.available{background:#22c55e;color:#fff}
.lst-badge.sold{background:#ef4444;color:#fff}
.lst-badge.under_offer{background:#f59e0b;color:var(--n1)}
.lst-body{padding:22px}
.lst-title{font-family:var(--font);font-size:16px;font-weight:700;color:var(--t1);margin-bottom:5px}
.lst-suburb{font-size:11px;color:var(--brand);letter-spacing:.05em;margin-bottom:12px;display:flex;align-items:center;gap:5px}
.lst-suburb svg{width:11px;height:11px;stroke:var(--brand);flex-shrink:0}
.lst-meta{display:flex;gap:14px;margin-bottom:14px}
.lst-meta span{font-size:12px;color:var(--t3);display:flex;align-items:center;gap:5px}
.lst-meta svg{width:12px;height:12px;stroke:var(--t3)}
.lst-price{font-family:var(--font);font-size:20px;font-weight:700;color:var(--brand)}

/* ════════════════════════ CTA ════════════════════════ */
#pg-cta{
  position:relative;overflow:hidden;padding:110px 0;
  background:var(--n1);
}
#pg-cta .cta-bg{
  position:absolute;inset:0;
  background-image:url(assets/images/tito/custom2.jpg);
  background-size:cover;background-position:center;
  filter:brightness(.22) saturate(.6);
}
#pg-cta .cta-overlay{
  position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(30,50,8,.9) 0%,rgba(7,28,53,.8) 100%);
}
#pg-cta .cta-glow{
  position:absolute;top:-100px;right:-100px;
  width:500px;height:500px;border-radius:50%;
  background:radial-gradient(circle,rgba(107,112,92,.06) 0%,transparent 70%);
}
#pg-cta .cta-inner{
  position:relative;z-index:1;text-align:center;
  max-width:860px;margin:0 auto;padding:0 48px;
}
#pg-cta h2{
  font-size:clamp(32px,5vw,58px)!important;
  font-weight:800!important;letter-spacing:.02em;text-transform:uppercase;
  margin-bottom:20px!important;
}
#pg-cta h2 span{color:var(--brand)!important}
#pg-cta .cta-sub{
  font-size:16px;color:var(--t2);line-height:1.75;
  max-width:580px;margin:0 auto 40px;
}
.cta-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap}

/* ════════════════════════ CONTACT ════════════════════════ */
#pg-contact{background:var(--n2)}
.contact-grid{
  display:grid;grid-template-columns:1fr 1.1fr;
  gap:80px;align-items:start;
}
.contact-left h2{
  font-size:clamp(34px,4.5vw,54px)!important;
  font-weight:800!important;text-transform:uppercase;
  line-height:1;letter-spacing:.02em;margin-bottom:36px!important;
}
.contact-left h2 span{color:var(--brand)!important}
.contact-details{display:flex;flex-direction:column;gap:16px}
.c-item{
  display:flex;align-items:center;gap:14px;
  font-family:var(--font);font-size:14px;color:var(--t2);
  text-decoration:none;transition:var(--t);cursor:pointer;
}
.c-item:hover{color:var(--t1)}
.c-icon{
  width:42px;height:42px;flex-shrink:0;
  border:1px solid var(--bdr2);border-radius:var(--r);
  display:flex;align-items:center;justify-content:center;
  background:rgba(107,112,92,.06);
}
.c-icon svg{width:16px;height:16px;stroke:var(--brand);fill:none;stroke-width:1.8}
/* Form */
.pg-form{display:flex;flex-direction:column;gap:12px}
.pg-form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.pg-input{
  width:100%;padding:13px 17px;
  background:rgba(255,255,255,.04);
  border:1px solid var(--bdr1);
  border-radius:var(--r);
  color:var(--t1)!important;
  font-family:var(--font);font-size:14px;
  outline:none;transition:var(--t);
}
.pg-input::placeholder{color:var(--t3)!important}
.pg-input:focus{border-color:var(--bdr2);background:rgba(255,255,255,.06)}
textarea.pg-input{min-height:120px;resize:vertical}
select.pg-input{
  -webkit-appearance:none;appearance:none;cursor:pointer;
  background-image:url("data:image/svg+xml;utf8,<svg fill='%238FA9B5' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
  background-repeat:no-repeat;background-position:right 14px center;
}
select.pg-input option{background:var(--n1);color:#fff}
.pg-submit{
  padding:15px 32px;background:var(--brand);
  color:var(--n1)!important;border:none;cursor:pointer;
  border-radius:var(--r);
  font-family:var(--font);font-size:12px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;
  display:inline-flex;align-items:center;gap:9px;
  transition:var(--t);align-self:flex-start;
}
.pg-submit:hover{background:var(--brand-l);transform:translateY(-2px);box-shadow:0 10px 28px rgba(107,112,92,.4)}
.pg-submit:active{transform:translateY(0)}
.pg-fine{font-size:11px;color:var(--t3);margin-top:6px}
/* Alerts */
.pg-alert{
  padding:14px 18px;border-radius:var(--r);
  font-family:var(--font);font-size:13px;font-weight:600;margin-bottom:14px;
}
.pg-alert-ok{background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.3);color:#86efac}
.pg-alert-err{background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#fca5a5}

/* ════════════════════════ RESPONSIVE ════════════════════════ */
@media(max-width:1100px){
  .services-grid{grid-template-columns:repeat(2,1fr)}
  .about-grid{grid-template-columns:1fr 1fr;gap:48px}
  .testi-grid{grid-template-columns:1fr 1fr}
  .testi-grid .testi-card:nth-child(3){grid-column:span 2}
}
@media(max-width:900px){
  #pg-hero .hero-content{padding:0 32px;padding-top:30px}
  .stats-row{grid-template-columns:repeat(2,1fr)}
  .stat-box:nth-child(2){border-right:none}
  .stat-box:nth-child(3){border-top:1px solid var(--bdr1)}
  .stat-box:nth-child(4){border-top:1px solid var(--bdr1)}
  .pg-container{padding:0 28px}
  .about-grid{grid-template-columns:1fr;gap:40px}
  .about-img-inner img{height:380px}
  .services-grid{grid-template-columns:repeat(2,1fr)}
  .process-grid{grid-template-columns:1fr}
  .testi-grid{grid-template-columns:1fr}
  .testi-grid .testi-card:nth-child(3){grid-column:auto}
  .listings-grid{grid-template-columns:1fr 1fr}
  .contact-grid{grid-template-columns:1fr;gap:48px}
  .pg-section{padding:72px 0}
}
@media(max-width:640px){
  #pg-hero h1{font-size:clamp(38px,10vw,54px)!important}
  #pg-hero .hero-content{padding:0 20px;padding-top:20px}
  .stats-row{grid-template-columns:1fr 1fr;padding:0 20px}
  .pg-container{padding:0 20px}
  .hero-ctas{flex-direction:column}
  .hero-ctas .pg-btn{justify-content:center}
  .about-img-badge{display:none}
  .services-grid{grid-template-columns:1fr}
  .listings-grid{grid-template-columns:1fr}
  .pg-form-row{grid-template-columns:1fr}
  .cta-btns{flex-direction:column;align-items:center}
  #pg-cta .cta-inner{padding:0 20px}
  .proc-card{padding:36px 24px}
  .proc-num{font-size:48px}
  @media(prefers-reduced-motion:reduce){
    #pg-hero .hero-bg-img{transition:none}
    .pg-card:hover,.svc-card:hover,.lst-card:hover,.testi-card:hover{transform:none}
  }
}
/* Scroll reveal */
.rv{opacity:0;transform:translateY(24px);transition:opacity .65s ease,transform .65s ease}
.rv.vis{opacity:1;transform:translateY(0)}
.rv.d1{transition-delay:.1s}.rv.d2{transition-delay:.2s}
.rv.d3{transition-delay:.3s}.rv.d4{transition-delay:.4s}
</style>

<div id="pg-home">

<!-- ══════════════════════ HERO CAROUSEL ══════════════════════ -->
<section id="pg-hero" aria-label="Hero">
  <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">

    <div class="single-item">
      <div class="hero-bg-img" style="background-image:url(assets/images/banner/banner-05.jpg)"></div>
      <div class="hero-gradient"></div>
      <div class="hero-content">
        <div class="hero-badge">Perth's #1 Buyers Advocate</div>
        <h1>We Find.<br>We Negotiate.<br><em>You Win.</em></h1>
        <p class="hero-sub">Stop searching alone. Perth's most trusted buyers advocate secures properties below market value — saving you months and tens of thousands of dollars.</p>
        <div class="hero-ctas">
          <a href="contact.php" class="pg-btn pg-btn-solid">
            Book Free Strategy Call
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
          <a href="service.php" class="pg-btn pg-btn-ghost">Our Services</a>
        </div>
      </div>
    </div>

    <div class="single-item">
      <div class="hero-bg-img" style="background-image:url(assets/images/banner/banner-04.jpg)"></div>
      <div class="hero-gradient"></div>
      <div class="hero-content">
        <div class="hero-badge">Average $45K+ Client Savings</div>
        <h1>Your Local<br>Perth<br><em>Buyers Advocate.</em></h1>
        <p class="hero-sub">From your first home to your next investment — we work exclusively for you, never the seller. Expert negotiation, off-market access, total support.</p>
        <div class="hero-ctas">
          <a href="contact.php" class="pg-btn pg-btn-solid">
            Book Free Strategy Call
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </a>
          <a href="about.php" class="pg-btn pg-btn-ghost">Meet Titus</a>
        </div>
      </div>
    </div>

  </div>

  <!-- Stats strip -->
  <div class="hero-stats">
    <div class="stats-row">
      <div class="stat-box">
        <span class="stat-num" data-target="5">0</span><span class="stat-sfx">+</span>
        <span class="stat-lbl">Years in Perth Market</span>
      </div>
      <div class="stat-box">
        <span class="stat-num" data-target="100">0</span><span class="stat-sfx">+</span>
        <span class="stat-lbl">Happy Clients</span>
      </div>
      <div class="stat-box">
        <span class="stat-num" data-target="45">0</span><span class="stat-sfx">K+</span>
        <span class="stat-lbl">Avg. Client Savings</span>
      </div>
      <div class="stat-box">
        <span class="stat-num" data-target="95">0</span><span class="stat-sfx">%</span>
        <span class="stat-lbl">Client Satisfaction</span>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════ ABOUT ══════════════════════ -->
<section id="pg-about" class="pg-section dark" aria-label="About Titus">
  <div class="pg-container">
    <div class="about-grid">

      <div class="about-img-wrap rv">
        <div class="about-img-inner">
          <img src="assets/images/tito/titus.jpeg" alt="Titus Tuitoek — Perth Property Buyers Advocate" loading="lazy">
        </div>
        <div class="about-img-badge">
          <strong>5+</strong>
          Years Perth<br>Market Expertise
        </div>
      </div>

      <div class="about-text rv d2">
        <div class="pg-label">Who We Are</div>
        <h2 class="pg-h2" style="margin-bottom:20px">Perth's Premier<br><span>Buyers Advocates</span></h2>
        <p>At Titus Tuitoek Buyers Agent, we specialise in guiding clients through the Perth real estate market — from first-time buyers to seasoned investors. We work exclusively for you, never the seller.</p>
        <p style="margin-top:12px">Our deep understanding of Western Australian property cycles, combined with relentless negotiation, consistently delivers results that surprise and delight our clients.</p>
        <ul class="about-checks">
          <?php foreach(['Save months of stressful searching','Access exclusive off-market listings','Expert negotiation — average $45K+ savings','Full support from search to settlement'] as $c): ?>
          <li class="about-check">
            <div class="check-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <?php echo $c; ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="about-ctas">
          <a href="about.php" class="pg-btn pg-btn-solid">Meet Titus</a>
          <a href="service.php" class="pg-btn pg-btn-ghost">Our Services</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════════════ SERVICES ══════════════════════ -->
<section id="pg-services" class="pg-section" aria-label="Services">
  <div class="pg-container">
    <div class="services-intro rv">
      <div class="pg-label">What We Do</div>
      <h2 class="pg-h2">Your Aspiration,<br><span>Our Expertise.</span></h2>
      <p class="pg-sub">From your first search to settlement day, we handle every detail so you don't have to.</p>
    </div>
    <div class="services-grid">
      <?php
      $svcs = [
        ['Full Buying Service','End-to-end acquisition from initial consultation through to settlement — handling everything for busy professionals.',
         '<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
        ['Property Search','Targeted search with exclusive access to off-market opportunities unavailable to the general public.',
         '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>'],
        ['Expert Negotiation','Data-backed negotiation strategy that consistently secures below-market prices, giving you instant equity.',
         '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>'],
        ['Auction Representation','Strategic bidding by professionals who understand auction dynamics — removing emotion from the equation.',
         '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>'],
        ['Market Analysis','Accurate valuations and deep analysis so you never overpay for any Perth property in any suburb.',
         '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>'],
        ['Due Diligence','Forensic investigation of titles, zoning, council regulations and building reports to protect your investment.',
         '<path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>'],
        ['Investment Strategy','Personalised strategies aligned with your financial goals, focused on high-yield Perth growth corridors.',
         '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>'],
        ['Settlement Support','Coordinating with conveyancers and lenders to ensure a smooth, stress-free settlement every time.',
         '<path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>'],
      ];
      foreach($svcs as $i => $s): ?>
      <div class="svc-card rv <?php echo 'd'.($i%4+1); ?>">
        <div class="svc-icon">
          <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><?php echo $s[2]; ?></svg>
        </div>
        <h4><?php echo $s[0]; ?></h4>
        <p><?php echo $s[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:48px" class="rv">
      <a href="service.php" class="pg-btn pg-btn-solid">
        View All Services
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════ PROCESS ══════════════════════ -->
<section id="pg-process" class="pg-section mid" aria-label="How it works">
  <div class="pg-container">
    <div class="process-intro rv">
      <div class="pg-label">The Process</div>
      <h2 class="pg-h2">How We Help<br><span>You Win.</span></h2>
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

<!-- ══════════════════════ TESTIMONIALS ══════════════════════ -->
<section id="pg-testimonials" class="pg-section" aria-label="Client testimonials">
  <div class="pg-container">
    <div class="testi-intro rv">
      <div class="pg-label">Client Stories</div>
      <h2 class="pg-h2">What Our<br><span>Clients Say.</span></h2>
    </div>
    <div class="testi-grid">
      <?php foreach($testimonials as $i => $t): ?>
      <div class="testi-card rv d<?php echo $i+1; ?>">
        <span class="testi-quote" aria-hidden="true">&ldquo;</span>
        <div class="testi-stars" aria-label="<?php echo (int)($t['rating']??5); ?> stars">
          <?php for($s=0;$s<(int)($t['rating']??5);$s++): ?>
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          <?php endfor; ?>
        </div>
        <p class="testi-text"><?php echo htmlspecialchars($t['text']); ?></p>
        <div class="testi-author">
          <div class="testi-avatar" aria-hidden="true">
            <?php if(!empty($t['photo'])): ?>
            <img src="<?php echo htmlspecialchars($t['photo']); ?>" alt="">
            <?php else: echo strtoupper(substr($t['name'],0,1)); ?>
            <?php endif; ?>
          </div>
          <div>
            <div class="testi-name"><?php echo htmlspecialchars($t['name']); ?></div>
            <div class="testi-role"><?php echo htmlspecialchars($t['role']??''); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if(!empty($db_listings)): ?>
<!-- ══════════════════════ LISTINGS ══════════════════════ -->
<section id="pg-listings" class="pg-section dark" aria-label="Recent property wins">
  <div class="pg-container">
    <div class="listings-intro rv">
      <div class="pg-label">Recent Wins</div>
      <h2 class="pg-h2">Properties We've<br><span>Secured for Clients.</span></h2>
    </div>
    <div class="listings-grid">
      <?php foreach($db_listings as $i => $lst): ?>
      <article class="lst-card rv d<?php echo $i+1; ?>">
        <div class="lst-img">
          <img src="<?php echo !empty($lst['image'])?htmlspecialchars($lst['image']):'assets/images/tito/custom1.jpg'; ?>"
               alt="<?php echo htmlspecialchars($lst['title']); ?>" loading="lazy">
          <span class="lst-badge <?php echo htmlspecialchars($lst['status']); ?>">
            <?php echo ucwords(str_replace('_',' ',$lst['status'])); ?>
          </span>
        </div>
        <div class="lst-body">
          <div class="lst-title"><?php echo htmlspecialchars($lst['title']); ?></div>
          <?php if(!empty($lst['suburb'])): ?>
          <div class="lst-suburb">
            <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?php echo htmlspecialchars($lst['suburb']); ?>
          </div>
          <?php endif; ?>
          <div class="lst-meta">
            <?php if($lst['bedrooms']): ?><span><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M2 9V19H22V9"/><path d="M2 19V9A4 4 0 0115 9"/></svg><?php echo (int)$lst['bedrooms']; ?> Bed</span><?php endif; ?>
            <?php if($lst['bathrooms']): ?><span><svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M9 6L9 2"/><path d="M3 20h18"/><path d="M3 12h18v4a4 4 0 01-4 4H7a4 4 0 01-4-4v-4z"/></svg><?php echo (int)$lst['bathrooms']; ?> Bath</span><?php endif; ?>
          </div>
          <?php if(!empty($lst['price'])): ?><div class="lst-price"><?php echo htmlspecialchars($lst['price']); ?></div><?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════ CTA ══════════════════════ -->
<section id="pg-cta" aria-label="Call to action">
  <div class="cta-bg"></div>
  <div class="cta-overlay"></div>
  <div class="cta-glow"></div>
  <div class="cta-inner rv">
    <div class="pg-label" style="justify-content:center">Ready to Start?</div>
    <h2 style="margin-top:14px">Let's Secure Your<br><span>Perfect Property Together.</span></h2>
    <p class="cta-sub" style="margin-top:16px">Join Perth homeowners and investors who trusted Titus to find their dream property — and saved an average of $45,000 in the process.</p>
    <div class="cta-btns">
      <a href="contact.php" class="pg-btn pg-btn-solid">
        Book Free Strategy Call
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
      <a href="tel:+61498439115" class="pg-btn pg-btn-ghost">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013 5.18a2 2 0 012-2.18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L9.91 10.91a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        +61 498 439 115
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════ CONTACT ══════════════════════ -->
<section id="pg-contact" class="pg-section" aria-label="Contact form">
  <div class="pg-container">
    <div class="contact-grid">

      <div class="rv">
        <div class="pg-label">Get In Touch</div>
        <h2 class="contact-left">
          <span style="display:block;margin-top:12px">Start A<br>Conversation<br><span>With Us.</span></span>
        </h2>
        <div class="contact-details" style="margin-top:34px">
          <a href="tel:+61498439115" class="c-item">
            <div class="c-icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013 5.18a2 2 0 012-2.18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L9.91 10.91a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg></div>
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
            <input class="pg-input" type="text"  name="username" placeholder="Your Full Name *" required>
            <input class="pg-input" type="tel"   name="phone"    placeholder="Phone Number *"   required>
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
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
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

/* Scroll-reveal (IntersectionObserver) */
(function(){
  var io = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if(e.isIntersecting){e.target.classList.add('vis');io.unobserve(e.target);}
    });
  },{threshold:.1});
  document.querySelectorAll('#pg-home .rv').forEach(function(el){io.observe(el);});
}());

/* Counter animation on stats strip */
(function(){
  var els = document.querySelectorAll('#pg-hero .stat-num[data-target]');
  if(!els.length) return;
  var io = new IntersectionObserver(function(entries,obs){
    entries.forEach(function(e){
      if(!e.isIntersecting) return;
      var el = e.target, target = parseInt(el.dataset.target,10);
      var step = target/(1400/16), cur = 0;
      var t = setInterval(function(){
        cur+=step;
        if(cur>=target){cur=target;clearInterval(t);}
        el.textContent = Math.floor(cur);
      },16);
      obs.unobserve(el);
    });
  },{threshold:.4});
  els.forEach(function(el){io.observe(el);});
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
