<?php
if (!defined('ABSPATH')) { exit; }
$c = aba_load_content();
$logo_url = aba_asset_url($c, 'logo');
$phone = $c['global_ctas']['phone_href'] ?? 'tel:+19051234567';
$home_url = aba_page_url('home');

$quick_links = [
    ['label' => 'About', 'slug' => 'about'],
    ['label' => 'Services', 'slug' => 'services'],
    ['label' => 'Our Approach', 'slug' => 'our-approach'],
    ['label' => 'Resources', 'slug' => 'resources'],
    ['label' => 'Contact', 'slug' => 'contact']
];

$footer_services = $c['footer']['services'] ?? [
    ['title' => 'In-Home Therapy', 'slug' => 'in-home-therapy'],
    ['title' => 'Parent Coaching', 'slug' => 'parent-coaching'],
    ['title' => 'Early Intervention', 'slug' => 'early-intervention'],
    ['title' => 'School & Daycare Support', 'slug' => 'school-support'],
    ['title' => 'Verbal Support', 'slug' => 'verbal-support'],
    ['title' => 'Assessments', 'slug' => 'assessments']
];
?>
</main>

<footer class="site-footer">
  <div class="container footer-grid reveal-fade-up">
    <div class="footer-brand">
      <a class="brand" href="<?php echo esc_url($home_url); ?>" aria-label="<?php echo esc_attr($c['site']['brand_name']); ?> home">
        <?php if ($logo_url): ?>
          <img class="brand-logo" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($c['site']['brand_name']); ?>" width="190" height="42" loading="lazy" decoding="async">
        <?php else: ?>
          <span class="brand-mark">✦</span>
          <span>
            <b><?php echo esc_html($c['site']['brand_name']); ?></b>
            <small><?php echo esc_html($c['site']['brand_subtitle']); ?></small>
          </span>
        <?php endif; ?>
      </a>
      <p><?php echo esc_html($c['footer']['brand_description']); ?></p>
      <div class="socials" aria-label="Social media links">
        <a href="#" aria-label="Facebook"><span>f</span></a>
        <a href="#" aria-label="Instagram"><span>◎</span></a>
        <a href="#" aria-label="LinkedIn"><span>in</span></a>
      </div>
    </div>

    <div class="footer-col">
      <h2>Quick Links</h2>
      <ul>
        <li><a href="<?php echo esc_url($home_url); ?>">Home</a></li>
        <?php foreach ($quick_links as $item): ?>
          <li>
            <a href="<?php echo esc_url(aba_page_url($item['slug'])); ?>">
              <?php echo esc_html($item['label']); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footer-col">
      <h2>Our Services</h2>
      <ul>
        <?php foreach ($footer_services as $srv): 
          $slug = is_array($srv) ? ($srv['slug'] ?? 'services') : aba_sanitize_slug($srv);
          $title = is_array($srv) ? ($srv['title'] ?? '') : $srv;
        ?>
          <li>
            <a href="<?php echo esc_url(aba_service_url($slug)); ?>"><?php echo esc_html($title); ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footer-col">
      <h2>Contact Us</h2>
      <ul class="contact-list">
        <li>📍 <?php echo esc_html($c['footer']['contact']['location']); ?></li>
        <li>☎ <a href="<?php echo esc_url($phone); ?>"><?php echo esc_html($c['footer']['contact']['phone']); ?></a></li>
        <li>✉ <a href="mailto:<?php echo esc_attr(antispambot($c['footer']['contact']['email'])); ?>"><?php echo esc_html(antispambot($c['footer']['contact']['email'])); ?></a></li>
      </ul>
    </div>
  </div>

  <div class="container footer-bottom">
    <p><?php echo esc_html($c['footer']['legal']['copyright']); ?></p>
    <div>
      <a href="<?php echo esc_url(aba_page_url('contact')); ?>"><?php echo esc_html($c['footer']['legal']['privacy']); ?></a>
      <span aria-hidden="true">|</span>
      <a href="<?php echo esc_url(aba_page_url('contact')); ?>"><?php echo esc_html($c['footer']['legal']['terms']); ?></a>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
