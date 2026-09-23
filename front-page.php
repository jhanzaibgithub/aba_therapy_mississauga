<?php
/* Template Name: Home (Front Page) */
if (!defined('ABSPATH')) { exit; }

$c = aba_load_content();
if (!empty($c['_error'])) {
    aba_render_error($c['_error']);
    return;
}

get_header();

$phone = $c['global_ctas']['phone_href'] ?? 'tel:+19051234567';
$pic = function (string $key, string $alt, string $class = '', bool $eager = false) use ($c) {
    return aba_picture($c, $key, $alt, $class, $eager);
};

$post_id = function_exists('get_the_ID') ? get_the_ID() : 0;
$hero_eyebrow = ($post_id ? get_post_meta($post_id, '_aba_hero_eyebrow', true) : '') ?: ($c['hero']['eyebrow'] ?? '');
$hero_title = ($post_id ? get_post_meta($post_id, '_aba_hero_title', true) : '') ?: ($c['hero']['title'] ?? '');
$hero_desc = ($post_id ? get_post_meta($post_id, '_aba_hero_subtitle', true) : '') ?: ($c['hero']['description'] ?? '');
$hero_trust = ($post_id ? get_post_meta($post_id, '_aba_hero_trust', true) : '') ?: ($c['hero']['trust_text'] ?? '');

$approach_eyebrow = ($post_id ? get_post_meta($post_id, '_aba_approach_eyebrow', true) : '') ?: ($c['approach']['eyebrow'] ?? '');
$approach_title = ($post_id ? get_post_meta($post_id, '_aba_approach_title', true) : '') ?: ($c['approach']['title'] ?? '');
$approach_desc = ($post_id ? get_post_meta($post_id, '_aba_approach_desc', true) : '') ?: ($c['approach']['description'] ?? '');

$services_eyebrow = ($post_id ? get_post_meta($post_id, '_aba_services_eyebrow', true) : '') ?: ($c['services']['eyebrow'] ?? '');
$services_title = ($post_id ? get_post_meta($post_id, '_aba_services_title', true) : '') ?: ($c['services']['title'] ?? '');

$family_eyebrow = ($post_id ? get_post_meta($post_id, '_aba_family_fit_eyebrow', true) : '') ?: ($c['family_fit']['eyebrow'] ?? '');
$family_title = ($post_id ? get_post_meta($post_id, '_aba_family_fit_title', true) : '') ?: ($c['family_fit']['title'] ?? '');
$family_desc = ($post_id ? get_post_meta($post_id, '_aba_family_fit_desc', true) : '') ?: ($c['family_fit']['description'] ?? '');
?>

  <!-- HERO SECTION -->
  <section class="hero section">
    <div class="container hero-grid">
      <div class="hero-copy reveal-slide-left">
        <p class="eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
        <h1><?php echo esc_html($hero_title); ?></h1>
        <span class="scribble" aria-hidden="true"></span>
        <p class="lede"><?php echo esc_html($hero_desc); ?></p>
        <div class="button-row">
          <?php aba_button($c['global_ctas']['primary'], aba_page_url('contact'), 'primary'); ?>
          <?php aba_button($c['global_ctas']['secondary'], aba_page_url('our-approach'), 'outline'); ?>
        </div>
        <p class="trust">
          <span aria-hidden="true">★</span>
          <span><?php echo esc_html($hero_trust); ?></span>
        </p>
      </div>
      <div class="hero-visual reveal-slide-right">
        <i class="blob blob-purple" aria-hidden="true"></i>
        <i class="blob blob-lime" aria-hidden="true"></i>
        <?php echo $pic('hero_image', 'Therapist helping a young child learn through wooden building blocks', 'hero-photo', true); ?>
        <span class="heart-doodle" aria-hidden="true"><?php echo aba_icon('heart'); ?></span>
        <div class="support-card">
          <span class="icon purple" aria-hidden="true"><?php echo aba_icon('people'); ?></span>
          <strong><?php echo esc_html($c['hero']['support_card']['title']); ?></strong>
        </div>
      </div>
    </div>
  </section>

  <!-- OUR APPROACH PREVIEW SECTION -->
  <section class="approach section soft" id="approach">
    <div class="container approach-grid">
      <div class="approach-photo-wrap reveal-scale">
        <i class="blob blob-purple" aria-hidden="true"></i>
        <i class="blob blob-pink" aria-hidden="true"></i>
        <i class="blob blob-yellow" aria-hidden="true"></i>
        <?php echo $pic('approach_image', 'Young girl smiling during play therapy session with ABA therapist', 'approach-photo'); ?>
        <span class="dot-field" aria-hidden="true"></span>
      </div>
      <div class="approach-copy reveal-slide-right">
        <p class="eyebrow"><?php echo esc_html($approach_eyebrow); ?></p>
        <h2><?php echo esc_html($approach_title); ?></h2>
        <p><?php echo esc_html($approach_desc); ?></p>
        <div style="margin-top: 24px;">
          <a class="service-link" href="<?php echo esc_url(aba_page_url('our-approach')); ?>" style="font-size: 16px; font-weight: 700;">
            <span>Learn More About Our Approach</span>
            <span aria-hidden="true">→</span>
          </a>
        </div>
      </div>
      <div class="pillars stagger-children reveal-fade-up">
        <?php 
        $pi = ['chat', 'people', 'leaf'];
        $p_colors = ['purple', 'teal', 'lime'];
        foreach ($c['approach']['pillars'] as $i => $x): 
        ?>
          <article class="pillar">
            <span class="icon <?php echo $p_colors[$i % 3]; ?>" aria-hidden="true"><?php echo aba_icon($pi[$i % 3]); ?></span>
            <div>
              <span class="number"><?php echo esc_html($x['number']); ?></span>
              <h3><?php echo esc_html($x['title']); ?></h3>
              <p><?php echo esc_html($x['description']); ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Benefit Strip -->
    <div class="container benefit-strip stagger-children reveal-fade-up">
      <?php 
      $bi = ['people', 'heart', 'leaf', 'target'];
      $b_colors = ['purple', 'blue', 'lime', 'orange'];
      foreach ($c['approach']['benefit_strip'] as $i => $x): 
      ?>
        <article>
          <span class="icon <?php echo $b_colors[$i % 4]; ?>" aria-hidden="true"><?php echo aba_icon($bi[$i % 4]); ?></span>
          <div>
            <h3><?php echo esc_html($x['title']); ?></h3>
            <p><?php echo esc_html($x['description']); ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- SERVICES SECTION -->
  <section class="services section" id="services">
    <div class="container services-grid">
      <div class="section-intro reveal-slide-left">
        <p class="eyebrow"><?php echo esc_html($services_eyebrow); ?></p>
        <h2><?php echo esc_html($services_title); ?></h2>
        <span class="scribble" aria-hidden="true"></span>
        <?php aba_button($c['services']['cta'], aba_page_url('services'), 'primary'); ?>
      </div>

      <div class="service-mosaic stagger-children reveal-fade-up">
        <?php 
        $si = ['home', 'people', 'leaf', 'people'];
        $s_colors = ['purple', 'pink', 'lime', 'teal'];
        $sk = ['service_in_home', 'service_parent_coaching', 'service_early_intervention', 'service_school_support'];
        foreach ($c['services']['items'] as $i => $x): 
          $slug = $x['slug'] ?? 'in-home-therapy';
        ?>
          <article class="service-card card-<?php echo $i + 1; ?>">
            <span class="icon <?php echo $s_colors[$i % 4]; ?>" aria-hidden="true"><?php echo aba_icon($si[$i % 4]); ?></span>
            <div class="service-copy">
              <h3><?php echo esc_html($x['title']); ?></h3>
              <p><?php echo esc_html($x['description']); ?></p>
              <a href="<?php echo esc_url(aba_service_url($slug)); ?>" class="service-link" aria-label="<?php echo esc_attr('Learn more about ' . $x['title']); ?>">
                <span><?php echo esc_html($x['link_label']); ?></span>
                <span aria-hidden="true">→</span>
              </a>
            </div>
            <?php echo $pic($sk[$i], $x['title'], 'service-image'); ?>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- FAMILY FIT (BUILT AROUND YOUR CHILD) SECTION -->
  <section class="family-fit">
    <div class="container family-grid">
      <div class="family-copy reveal-slide-left">
        <p class="eyebrow"><?php echo esc_html($family_eyebrow); ?></p>
        <h2><?php echo esc_html($family_title); ?></h2>
        <p><?php echo esc_html($family_desc); ?></p>
        <span class="scribble yellow-line" aria-hidden="true"></span>
        <div style="margin-top: 24px;">
          <a class="service-link" href="<?php echo esc_url(aba_page_url('about')); ?>" style="font-size: 16px; font-weight: 700;">
            <span>Discover Our Mission & Values</span>
            <span aria-hidden="true">→</span>
          </a>
        </div>
      </div>
      <div class="family-visual reveal-slide-right">
        <i class="blob blob-teal" aria-hidden="true"></i>
        <i class="blob blob-orange" aria-hidden="true"></i>
        <span class="dot-field family-dots" aria-hidden="true"></span>
        <?php echo $pic('family_fit_image', 'Child giving high five to therapist during drawing session', 'family-photo'); ?>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS (PROCESS) SECTION -->
  <section class="process section" id="process">
    <div class="container">
      <div class="centered reveal-fade-up">
        <p class="eyebrow"><?php echo esc_html($c['how_it_works']['eyebrow']); ?></p>
        <h2><?php echo esc_html($c['how_it_works']['title']); ?></h2>
      </div>

      <div class="process-line reveal-fade-in" aria-hidden="true">
        <svg viewBox="0 0 1000 90" preserveAspectRatio="none">
          <path d="M0 47 C100 -5, 150 10, 250 48 S400 95, 500 46 S650 -5, 750 47 S900 95, 1000 48" />
        </svg>
      </div>

      <div class="steps stagger-children reveal-fade-up">
        <?php 
        $sti = ['chat', 'clipboard', 'target', 'growth'];
        $st_colors = ['purple', 'blue', 'lime', 'orange'];
        foreach ($c['how_it_works']['steps'] as $i => $x): 
        ?>
          <article class="step-card">
            <span class="step-icon <?php echo $st_colors[$i % 4]; ?>" aria-hidden="true">
              <?php echo aba_icon($sti[$i % 4]); ?>
            </span>
            <span class="number"><?php echo esc_html($x['number']); ?></span>
            <h3><?php echo esc_html($x['title']); ?></h3>
            <p><?php echo esc_html($x['description']); ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- RESOURCES FOR PARENTS SECTION -->
  <section class="resources section soft" id="resources">
    <div class="container resources-grid">
      <div class="section-intro reveal-slide-left">
        <p class="eyebrow"><?php echo esc_html($c['resources']['eyebrow']); ?></p>
        <h2><?php echo esc_html($c['resources']['title']); ?></h2>
        <span class="scribble" aria-hidden="true"></span>
        <?php aba_button($c['resources']['cta'], aba_page_url('resources'), 'outline'); ?>
      </div>

      <div class="resource-cards-wrap stagger-children reveal-fade-up" style="display: contents;">
        <?php 
        $ri = ['book', 'people', 'shield'];
        $r_colors = ['purple', 'teal', 'lime'];
        $rk = ['resource_understanding_aba', 'resource_getting_started', 'resource_funding'];
        foreach ($c['resources']['items'] as $i => $x): 
        ?>
          <article class="resource-card card-<?php echo $r_colors[$i % 3]; ?> reveal-fade-up" data-tilt>
            <div class="card-spotlight" aria-hidden="true"></div>
            
            <div class="resource-card-media">
              <?php echo $pic($rk[$i], $x['title'], 'resource-card-img'); ?>
              <div class="resource-card-icon" aria-hidden="true">
                <?php echo aba_icon($ri[$i % 3]); ?>
              </div>
            </div>

            <div class="resource-card-body">
              <div class="resource-card-text">
                <h3 class="resource-card-title"><?php echo esc_html($x['title']); ?></h3>
                <p class="resource-card-desc"><?php echo esc_html($x['description']); ?></p>
              </div>
              <a class="resource-card-action" href="<?php echo esc_url(aba_page_url('resources')); ?>" aria-label="<?php echo esc_attr('Explore ' . $x['title']); ?>">
                <span>Explore</span>
                <span class="action-arrow" aria-hidden="true">→</span>
              </a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- LOCAL / WHAT FAMILIES SAY SECTION -->
  <section class="local section">
    <div class="container local-grid">
      <div class="local-copy reveal-slide-left">
        <p class="eyebrow"><?php echo esc_html($c['local_area']['eyebrow']); ?></p>
        <h2><?php echo esc_html($c['local_area']['title']); ?></h2>
        <p><?php echo esc_html($c['local_area']['description']); ?></p>
        <ul class="areas">
          <?php foreach ($c['local_area']['areas'] as $i => $area): ?>
            <li>
              <span><?php echo esc_html($area); ?></span>
              <?php if ($i < count($c['local_area']['areas']) - 1): ?>
                <span aria-hidden="true">•</span>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="testimonial-box reveal-scale">
        <blockquote>
          "<?php echo esc_html($c['local_area']['testimonial']['quote']); ?>"
        </blockquote>
      </div>

      <div class="map-wrap reveal-slide-right">
        <iframe
          class="map-frame"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d184852.12480649727!2d-79.79902347317799!3d43.58021703666687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b469fe76b05b7%3A0x3146cbed75231584!2sMississauga%2C%20ON!5e0!3m2!1sen!2sca!4v1710000000000!5m2!1sen!2sca"
          width="100%"
          height="100%"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="ABA Therapy Mississauga Map Location"
          aria-label="Interactive map showing ABA Therapy Mississauga service area">
        </iframe>
        <div class="map-card">
          <span class="pin" aria-hidden="true">📍</span>
          <div>
            <strong><?php echo esc_html($c['local_area']['map_card']['title']); ?></strong>
            <small><?php echo esc_html($c['local_area']['map_card']['description']); ?></small>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ SECTION -->
  <section class="faq section" id="faq">
    <div class="container">
      <div class="faq-head reveal-slide-left">
        <div>
          <p class="eyebrow"><?php echo esc_html($c['faq']['eyebrow']); ?></p>
          <h2><?php echo esc_html($c['faq']['title']); ?></h2>
        </div>
        <a class="view-all-faq" href="<?php echo esc_url(aba_page_url('contact')); ?>">
          <span>Have More Questions? Contact Us</span>
          <span aria-hidden="true">→</span>
        </a>
      </div>

      <div class="faq-grid stagger-children reveal-fade-up">
        <?php foreach ($c['faq']['items'] as $i => $item): ?>
          <article class="faq-item">
            <h3>
              <button type="button" aria-expanded="false" aria-controls="faq-panel-<?php echo $i; ?>">
                <span><?php echo esc_html($item['question']); ?></span>
                <i class="plus-icon" aria-hidden="true"></i>
              </button>
            </h3>
            <div class="faq-answer" id="faq-panel-<?php echo $i; ?>" hidden>
              <div>
                <p><?php echo esc_html($item['answer']); ?></p>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- FINAL CTA SECTION -->
  <?php aba_render_cta_banner(); ?>

<?php get_footer(); ?>
