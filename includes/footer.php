<!-- ═══════════════════ SITE FOOTER ═══════════════════ -->
<style>
/* Footer — scoped so it beats template rules */
#site-footer{
  --fb:#1e3208;--fb2:#2a4509;
  --fg:#6B705C;--fg-l:#9aab88;
  --ft1:#fff;--ft2:rgba(255,255,255,.62);--ft3:rgba(255,255,255,.3);
  --fbr:rgba(255,255,255,.08);
  font-family:'Quicksand',sans-serif!important;
  background:var(--fb)!important;
  border-top:1px solid var(--fbr)!important;
  color:var(--ft2)!important;
}
#site-footer *{box-sizing:border-box}
#site-footer h1,#site-footer h2,#site-footer h3,#site-footer h4,#site-footer h5{
  font-family:'Quicksand',sans-serif!important;color:var(--ft1)!important;
}
#site-footer p{color:var(--ft2)!important;font-family:'Quicksand',sans-serif!important}
#site-footer a{color:var(--ft2)!important;text-decoration:none!important;transition:color .2s!important}
#site-footer a:hover{color:var(--fg)!important}
.ft-wrap{max-width:1180px;margin:0 auto;padding:0 48px}
/* ── Top strip: CTA bar ── */
.ft-cta-bar{
  background:var(--fg);padding:42px 0;
}
.ft-cta-inner{
  display:flex;align-items:center;justify-content:space-between;gap:28px;
  flex-wrap:wrap;
}
.ft-cta-text h3{
  font-size:clamp(20px,2.5vw,28px)!important;font-weight:700!important;
  color:#fff!important;margin-bottom:5px!important;
}
.ft-cta-text p{font-size:14px!important;color:rgba(255,255,255,.8)!important}
.ft-cta-btns{display:flex;gap:12px;flex-shrink:0;flex-wrap:wrap}
.ft-btn-w{
  display:inline-flex;align-items:center;gap:8px;
  padding:13px 26px;background:#fff;color:var(--fg)!important;
  font-family:'Quicksand',sans-serif;font-size:11px;font-weight:700;
  letter-spacing:.1em;text-transform:uppercase;border-radius:8px;
  transition:all .2s ease;border:none;cursor:pointer;
}
.ft-btn-w:hover{background:var(--fb);color:#fff!important;transform:translateY(-2px)}
.ft-btn-o{
  display:inline-flex;align-items:center;gap:8px;
  padding:12px 24px;background:transparent;color:#fff!important;
  font-family:'Quicksand',sans-serif;font-size:11px;font-weight:700;
  letter-spacing:.1em;text-transform:uppercase;border-radius:8px;
  border:1.5px solid rgba(255,255,255,.55);transition:all .2s ease;cursor:pointer;
}
.ft-btn-o:hover{background:rgba(255,255,255,.12);border-color:#fff}
/* ── Main footer body ── */
.ft-body{padding:72px 0 56px}
.ft-grid{
  display:grid;
  grid-template-columns:1.4fr 1fr 1fr 1.3fr;
  gap:52px;
}
/* Brand col */
.ft-brand-col{}
.ft-logo{max-height:46px;width:auto;display:block;margin-bottom:20px;filter:brightness(1.1)}
.ft-tagline{font-size:13px;line-height:1.8;max-width:240px;color:var(--ft2)!important}
/* Social */
.ft-social{display:flex;gap:10px;margin-top:24px}
.ft-soc-a{
  width:38px;height:38px;border-radius:8px;
  background:rgba(255,255,255,.05);border:1px solid var(--fbr);
  display:flex;align-items:center;justify-content:center;
  transition:all .2s ease;color:var(--ft2)!important;
}
.ft-soc-a:hover{background:var(--fg);border-color:var(--fg);color:#fff!important}
.ft-soc-a svg{width:16px;height:16px;fill:currentColor}
/* Nav cols */
.ft-nav-col{}
.ft-col-label{
  font-family:'Quicksand',sans-serif;font-size:10px;font-weight:700;
  letter-spacing:.3em;text-transform:uppercase;color:var(--fg)!important;
  display:block;margin-bottom:20px;
}
.ft-links{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:11px}
.ft-links li a{
  font-size:14px;font-weight:500;color:var(--ft2)!important;
  display:flex;align-items:center;gap:8px;transition:color .2s ease!important;
}
.ft-links li a:hover{color:var(--ft1)!important}
.ft-links li a::before{
  content:'';display:block;width:4px;height:4px;border-radius:50%;
  background:var(--fg);opacity:.55;flex-shrink:0;
}
/* Contact col */
.ft-contact-col{}
.ft-cinfo{display:flex;flex-direction:column;gap:13px}
.ft-ci{display:flex;align-items:flex-start;gap:11px;font-size:13px;color:var(--ft2)!important}
.ft-ci svg{width:15px;height:15px;stroke:var(--fg);flex-shrink:0;margin-top:1px;stroke-width:1.8;fill:none}
.ft-ci a{color:var(--ft2)!important}
.ft-ci a:hover{color:var(--fg)!important}
/* Divider */
.ft-divider{border:none;border-top:1px solid var(--fbr);margin:0}
/* Bottom bar */
.ft-bottom{padding:20px 0}
.ft-bottom-inner{
  display:flex;align-items:center;justify-content:space-between;
  gap:16px;flex-wrap:wrap;
}
.ft-copy{font-size:12px;color:var(--ft3)!important;font-family:'Quicksand',sans-serif}
.ft-copy a{color:var(--ft3)!important}
.ft-copy a:hover{color:var(--fg)!important}
/* Responsive */
@media(max-width:960px){.ft-grid{grid-template-columns:1fr 1fr;gap:40px}}
@media(max-width:640px){
  .ft-grid{grid-template-columns:1fr;gap:32px}
  .ft-wrap{padding:0 20px}
  .ft-cta-inner{flex-direction:column;align-items:flex-start}
  .ft-bottom-inner{flex-direction:column;align-items:flex-start;gap:8px}
}
</style>

<footer id="site-footer" role="contentinfo">

  <!-- CTA strip -->
  <div class="ft-cta-bar">
    <div class="ft-wrap">
      <div class="ft-cta-inner">
        <div class="ft-cta-text">
          <h3>Ready to Find Your Perfect Perth Property?</h3>
          <p>Book a free 15-minute strategy call — zero obligation, pure insight.</p>
        </div>
        <div class="ft-cta-btns">
          <a href="contact.php" class="ft-btn-w">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4M16 2v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/></svg>
            Book Free Call
          </a>
          <a href="tel:+61498439115" class="ft-btn-o">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013 5.18a2 2 0 012-2.18h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L9.91 10.91a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
            +61 498 439 115
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main body -->
  <div class="ft-body">
    <div class="ft-wrap">
      <div class="ft-grid">

        <!-- Brand -->
        <div class="ft-brand-col">
          <a href="index.php">
            <img class="ft-logo" src="assets/images/logo.png" alt="Titus Tuitoek Buyers Agent">
          </a>
          <p class="ft-tagline">Perth's most trusted property buyers advocate. We work exclusively for you — from search to settlement.</p>
          <div class="ft-social" aria-label="Social media links">
            <a href="https://facebook.com/titusbuyersagent" class="ft-soc-a" aria-label="Facebook" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
            </a>
            <a href="https://twitter.com/titusbuyersagent" class="ft-soc-a" aria-label="Twitter / X" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
            </a>
            <a href="https://linkedin.com/in/titustuitoek" class="ft-soc-a" aria-label="LinkedIn" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
            </a>
            <a href="https://instagram.com/titusbuyersagent" class="ft-soc-a" aria-label="Instagram" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="https://youtube.com/@titusbuyersagent" class="ft-soc-a" aria-label="YouTube" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
            </a>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="ft-nav-col">
          <span class="ft-col-label">Company</span>
          <ul class="ft-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Titus</a></li>
            <li><a href="service.php">Our Services</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>

        <!-- Services -->
        <div class="ft-nav-col">
          <span class="ft-col-label">Services</span>
          <ul class="ft-links">
            <li><a href="service.php">Full Buying Service</a></li>
            <li><a href="service.php">Auction Representation</a></li>
            <li><a href="service.php">Investment Strategy</a></li>
            <li><a href="service.php">Due Diligence</a></li>
            <li><a href="contact.php">Book Free Strategy Call</a></li>
          </ul>
        </div>

        <!-- Contact -->
        <div class="ft-contact-col">
          <span class="ft-col-label">Get In Touch</span>
          <div class="ft-cinfo">
            <div class="ft-ci">
              <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013 5.18a2 2 0 012-2.18h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L9.91 10.91a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
              <a href="tel:+61498439115">+61 498 439 115</a>
            </div>
            <div class="ft-ci">
              <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <a href="mailto:titus.buyersagent@gmail.com">titus.buyersagent@gmail.com</a>
            </div>
            <div class="ft-ci">
              <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span>Perth City, Western Australia</span>
            </div>
            <div class="ft-ci">
              <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span>Mon–Fri 8:30AM–6PM<br>Saturday 9:00AM–4PM</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <hr class="ft-divider">

  <!-- Bottom bar -->
  <div class="ft-bottom">
    <div class="ft-wrap">
      <div class="ft-bottom-inner">
        <p class="ft-copy">
          &copy; <?php echo date('Y'); ?> <a href="index.php">Titus Tuitoek</a> — Powered by Leverage Listings. All rights reserved.
        </p>
        <p class="ft-copy">Perth City, Western Australia &middot; Licensed Buyers Advocate</p>
      </div>
    </div>
  </div>

</footer>

<!-- Scroll to top -->
<div class="scroll-to-top">
  <div><div class="scroll-top-inner">
    <div class="scroll-bar"><div class="bar-inner"></div></div>
    <div class="scroll-bar-text">Go To Top</div>
  </div></div>
</div>

</div><!-- /.boxed_wrapper -->

<!-- Scripts -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/validation.js"></script>
<script src="assets/js/jquery.fancybox.js"></script>
<script src="assets/js/appear.js"></script>
<script src="assets/js/scrollbar.js"></script>
<script src="assets/js/nav-tool.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/jquery.lettering.min.js"></script>
<script src="assets/js/jquery.circleType.js"></script>
<script src="assets/js/script.js"></script>

<?php if (isset($page_scripts)) { echo $page_scripts; } ?>

<!-- WhatsApp floating button -->
<style>
.wa-float{
  position:fixed!important;bottom:28px!important;right:28px!important;
  z-index:99999!important;width:58px;height:58px;border-radius:50%;
  background:#25D366;display:flex!important;
  align-items:center;justify-content:center;
  box-shadow:0 6px 24px rgba(37,211,102,.50);
  transition:transform .2s ease,box-shadow .2s ease;
  text-decoration:none!important;
}
.wa-float:hover{transform:scale(1.1)!important;box-shadow:0 10px 36px rgba(37,211,102,.65)!important}
.wa-float svg{width:30px;height:30px;fill:#fff;flex-shrink:0}
.wa-float::before{
  content:'';position:absolute;inset:-7px;border-radius:50%;
  border:2px solid rgba(37,211,102,.3);
  animation:wa-ring 2.4s ease-in-out infinite;
}
@keyframes wa-ring{0%,100%{transform:scale(1);opacity:.3}60%{transform:scale(1.22);opacity:0}}
.wa-float::after{
  content:'Chat on WhatsApp';
  position:absolute;right:70px;
  background:rgba(3,14,31,.95);color:#fff;
  font-family:'Quicksand',sans-serif;font-size:12px;font-weight:600;
  padding:7px 14px;border-radius:8px;white-space:nowrap;
  opacity:0;pointer-events:none;transition:opacity .2s ease;
  border:1px solid rgba(255,255,255,.08);
}
.wa-float:hover::after{opacity:1}
@media(max-width:640px){.wa-float{bottom:20px!important;right:20px!important;width:52px;height:52px}}
</style>
<a href="https://wa.me/61498439115?text=Hi%20Titus%2C%20I%27m%20interested%20in%20your%20Perth%20property%20buying%20services."
   class="wa-float" aria-label="Chat with Titus on WhatsApp"
   target="_blank" rel="noopener noreferrer">
  <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.886 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
  </svg>
</a>

</body>
</html>
