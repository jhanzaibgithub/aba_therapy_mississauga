<?php
/* Template Name: About Us */
if (!defined('ABSPATH')) { exit; }

$c = aba_load_content();
get_header();

$about = $c['pages']['about'] ?? [];
$breadcrumbs = [
    ['label' => 'Home', 'href' => aba_page_url('home')],
    ['label' => 'About Us', 'href' => '']
];
?>

<?php 
aba_render_page_hero(
    $about['eyebrow'] ?? 'ABOUT US',
    $about['title'] ?? 'Empowering children and families through compassionate care.',
    $about['subtitle'] ?? 'We believe every child possesses unique strengths, boundless potential, and the ability to thrive.',
    $breadcrumbs
); 
?>

<!-- ABOUT STORY SPLIT SECTION -->
<section class="section">
  <div class="container split-grid">
    <div class="split-copy reveal-slide-left">
      <p class="eyebrow">OUR STORY &amp; MISSION</p>
      <h2>Rooted in empathy, driven by science.</h2>
      <span class="scribble" aria-hidden="true"></span>
      <p class="lede">
        <?php echo esc_html($about['story']['p1'] ?? 'Founded right here in Mississauga, our clinic was born from a simple belief: behavioral therapy should feel compassionate, joyful, and deeply personal.'); ?>
      </p>
      <p>
        <?php echo esc_html($about['story']['p2'] ?? 'Our multidisciplinary team of Board Certified Behavior Analysts (BCBAs) and dedicated therapists work in close partnership with parents.'); ?>
      </p>
      <div class="button-row" style="margin-top: 30px;">
        <?php aba_button('Explore Our Services', aba_page_url('services'), 'primary'); ?>
        <?php aba_button('Our Clinical Approach', aba_page_url('our-approach'), 'outline'); ?>
      </div>
    </div>

    <div class="split-visual reveal-slide-right">
      <div class="approach-photo-wrap" style="position: relative;">
        <i class="blob blob-purple" aria-hidden="true"></i>
        <i class="blob blob-teal" aria-hidden="true"></i>
        <?php echo aba_picture($c, 'approach_image', 'Therapist smiling with young girl during play-based ABA therapy session', 'split-photo'); ?>
        <span class="heart-doodle" aria-hidden="true"><?php echo aba_icon('heart'); ?></span>
      </div>
    </div>
  </div>
</section>

<!-- CORE VALUES SECTION -->
<section class="section soft">
  <div class="container">
    <div class="centered reveal-fade-up">
      <p class="eyebrow">OUR CORE PRINCIPLES</p>
      <h2>The values that guide every session.</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
    </div>

    <div class="values-grid stagger-children reveal-fade-up">
      <?php 
      $v_icons = ['heart', 'clipboard', 'people', 'growth'];
      $v_accents = ['purple', 'teal', 'lime', 'orange'];
      $values = $about['values'] ?? [];
      foreach ($values as $i => $val): 
      ?>
        <article class="value-card accent-<?php echo $v_accents[$i % 4]; ?>">
          <div class="value-icon <?php echo $v_accents[$i % 4]; ?>" aria-hidden="true">
            <?php echo aba_icon($v_icons[$i % 4]); ?>
          </div>
          <h3><?php echo esc_html($val['title']); ?></h3>
          <p><?php echo esc_html($val['description']); ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CLINICAL EXCELLENCE & BCBA SUPERVISION -->
<section class="section">
  <div class="container split-grid reverse">
    <div class="split-visual reveal-slide-left">
      <div class="approach-photo-wrap" style="position: relative;">
        <i class="blob blob-yellow" aria-hidden="true"></i>
        <i class="blob blob-pink" aria-hidden="true"></i>
        <?php echo aba_picture($c, 'family_fit_image', 'Child drawing and connecting with ABA therapist', 'split-photo'); ?>
      </div>
    </div>

    <div class="split-copy reveal-slide-right">
      <p class="eyebrow">CLINICAL EXCELLENCE</p>
      <h2>Led by certified BCBAs with a family-first heart.</h2>
      <span class="scribble" aria-hidden="true"></span>
      <p>
        Every therapy plan at ABA Therapy Mississauga is formulated, supervised, and updated by Board Certified Behavior Analysts (BCBAs) in strict adherence to the highest clinical guidelines and Ontario Autism Program (OAP) standards.
      </p>
      
      <ul class="check-list" style="margin-top: 20px;">
        <li>
          <span class="check-bullet" aria-hidden="true"><?php echo aba_icon('check'); ?></span>
          <div>
            <strong>100% Individualized Interventions</strong>
            <p>Every child receives a bespoke curriculum tailored to their exact strengths and learning style.</p>
          </div>
        </li>
        <li>
          <span class="check-bullet" aria-hidden="true"><?php echo aba_icon('check'); ?></span>
          <div>
            <strong>Natural Environment Training</strong>
            <p>We teach skills in home, school, and community environments so progress is lasting.</p>
          </div>
        </li>
        <li>
          <span class="check-bullet" aria-hidden="true"><?php echo aba_icon('check'); ?></span>
          <div>
            <strong>Continuous Objective Data</strong>
            <p>We measure milestone progress session-by-session to adapt goals dynamically.</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>

<!-- TESTIMONIAL & COMMUNITY -->
<section class="local section soft">
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
      <div class="stars" aria-label="<?php echo esc_attr($c['local_area']['testimonial']['rating']); ?> out of 5 stars">
        <?php for ($s = 0; $s < (int)$c['local_area']['testimonial']['rating']; $s++): ?>
          <span aria-hidden="true">★</span>
        <?php endfor; ?>
      </div>
      <blockquote>
        "<?php echo esc_html($c['local_area']['testimonial']['quote']); ?>"
      </blockquote>
      <cite><?php echo esc_html($c['local_area']['testimonial']['attribution']); ?></cite>
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
          <strong>ABA Therapy Mississauga</strong>
          <small>Compassionate ABA therapy close to home.</small>
        </div>
      </div>
    </div>
  </div>
</section>

<?php aba_render_cta_banner('Ready to Meet Our Team?', 'Schedule a friendly, no-obligation consultation with our clinical team today.'); ?>

<?php get_footer(); ?>
