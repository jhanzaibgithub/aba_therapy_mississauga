<?php
/* Template Name: Our Approach */
if (!defined('ABSPATH')) { exit; }

$c = aba_load_content();
get_header();

$breadcrumbs = [
    ['label' => 'Home', 'href' => aba_page_url('home')],
    ['label' => 'Our Approach', 'href' => '']
];
?>

<?php 
aba_render_page_hero(
    $c['pages']['our_approach']['eyebrow'] ?? 'OUR APPROACH',
    $c['pages']['our_approach']['title'] ?? 'Every child. Unique potential. Limitless possibilities.',
    $c['pages']['our_approach']['subtitle'] ?? 'We focus on building meaningful skills that help children communicate, connect, learn, and thrive in the real world.',
    $breadcrumbs
); 
?>

<!-- PHILOSOPHY & METHODOLOGY SECTION -->
<section class="section">
  <div class="container split-grid">
    <div class="split-copy reveal-slide-left">
      <p class="eyebrow">CLINICAL METHODOLOGY</p>
      <h2>Science meets compassion in every interaction.</h2>
      <span class="scribble" aria-hidden="true"></span>
      <p class="lede">
        Our clinical framework is built upon Modern Applied Behavior Analysis (ABA) enhanced with Naturalistic Developmental Behavioral Interventions (NDBI).
      </p>
      <p>
        We reject outdated, repetitive compliance drills. Instead, our Board Certified Behavior Analysts (BCBAs) craft learning moments that emerge naturally from your child's innate curiosity and interests. Therapy feels like play because when children are joyful and motivated, learning happens faster and lasts a lifetime.
      </p>
      <div class="button-row" style="margin-top: 30px;">
        <?php aba_button('Explore Our Services', aba_page_url('services'), 'primary'); ?>
        <?php aba_button('Book a Free Consultation', aba_page_url('contact'), 'outline'); ?>
      </div>
    </div>

    <div class="split-visual reveal-slide-right">
      <div class="approach-photo-wrap" style="position: relative;">
        <i class="blob blob-purple" aria-hidden="true"></i>
        <i class="blob blob-pink" aria-hidden="true"></i>
        <i class="blob blob-yellow" aria-hidden="true"></i>
        <?php echo aba_picture($c, 'approach_image', 'Therapist smiling with young girl during play therapy session', 'split-photo'); ?>
        <span class="heart-doodle" aria-hidden="true"><?php echo aba_icon('heart'); ?></span>
      </div>
    </div>
  </div>
</section>

<!-- 3 CORE PILLARS SECTION -->
<section class="section soft">
  <div class="container">
    <div class="centered reveal-fade-up">
      <p class="eyebrow">THE FOUNDATION</p>
      <h2>Our Three Core Pillars of Development</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
      <p style="max-width: 680px; margin: 0 auto; color: var(--text-muted); font-size: 15px;">
        We organize therapy around functional life domains that unlock real-world independence and joy.
      </p>
    </div>

    <div class="pillars stagger-children reveal-fade-up" style="margin-top: 40px;">
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
</section>

<!-- BENEFIT STRIP SECTION -->
<section class="section">
  <div class="container">
    <div class="centered reveal-fade-up" style="margin-bottom: 40px;">
      <p class="eyebrow">OUR COMMITMENT</p>
      <h2>The standards that set our care apart.</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
    </div>

    <div class="benefit-strip stagger-children reveal-fade-up">
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
  </div>
</section>

<!-- 4-STEP PROCESS TIMELINE -->
<section class="process section soft" id="process">
  <div class="container">
    <div class="centered reveal-fade-up">
      <p class="eyebrow"><?php echo esc_html($c['how_it_works']['eyebrow']); ?></p>
      <h2><?php echo esc_html($c['how_it_works']['title']); ?></h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
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

<!-- FAMILY FIT COLLABORATION -->
<section class="family-fit section">
  <div class="container family-grid">
    <div class="family-copy reveal-slide-left">
      <p class="eyebrow"><?php echo esc_html($c['family_fit']['eyebrow']); ?></p>
      <h2><?php echo esc_html($c['family_fit']['title']); ?></h2>
      <p><?php echo esc_html($c['family_fit']['description']); ?></p>
      <span class="scribble yellow-line" aria-hidden="true"></span>
      <div style="margin-top: 24px;">
        <a class="button button--primary" href="<?php echo esc_url(aba_page_url('contact')); ?>">
          <span>Schedule an Assessment</span>
          <span aria-hidden="true">→</span>
        </a>
      </div>
    </div>
    <div class="family-visual reveal-slide-right">
      <i class="blob blob-teal" aria-hidden="true"></i>
      <i class="blob blob-orange" aria-hidden="true"></i>
      <span class="dot-field family-dots" aria-hidden="true"></span>
      <?php echo aba_picture($c, 'family_fit_image', 'Child giving high five to therapist during drawing session', 'family-photo'); ?>
    </div>
  </div>
</section>

<?php aba_render_cta_banner(); ?>

<?php get_footer(); ?>
