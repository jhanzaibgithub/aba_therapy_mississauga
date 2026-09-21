<?php
/* Template Name: Single Service Detail */
if (!defined('ABSPATH')) { exit; }

$c = aba_load_content();
get_header();

$slug = $_GET['service'] ?? get_query_var('service_slug') ?? 'in-home-therapy';
$slug = sanitize_title($slug);

$all_services = aba_get_all_services();
$service = aba_get_service($slug);

if (!$service) {
    $service = $all_services[0] ?? [];
    $slug = $service['slug'] ?? 'in-home-therapy';
}

// Find previous and next service for bottom navigation
$current_index = 0;
foreach ($all_services as $idx => $s) {
    if ($s['slug'] === $slug) {
        $current_index = $idx;
        break;
    }
}
$prev_service = $all_services[($current_index - 1 + count($all_services)) % count($all_services)];
$next_service = $all_services[($current_index + 1) % count($all_services)];

$image_key = $service['image_key'] ?? 'service_in_home';
$accent = $service['accent'] ?? 'purple';

$breadcrumbs = [
    ['label' => 'Home', 'href' => aba_page_url('home')],
    ['label' => 'Services', 'href' => aba_page_url('services')],
    ['label' => $service['title'], 'href' => '']
];
?>

<!-- SERVICE HERO COMPONENT -->
<section class="page-hero section service-hero">
  <div class="container page-hero-inner">
    <nav class="breadcrumbs reveal-fade-in" aria-label="Breadcrumb">
      <ol>
        <?php foreach ($breadcrumbs as $i => $crumb): ?>
          <li>
            <?php if (!empty($crumb['href']) && $i < count($breadcrumbs) - 1): ?>
              <a href="<?php echo esc_url($crumb['href']); ?>"><?php echo esc_html($crumb['label']); ?></a>
              <span class="crumb-separator" aria-hidden="true">/</span>
            <?php else: ?>
              <span class="crumb-current" aria-current="page"><?php echo esc_html($crumb['label']); ?></span>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </nav>

    <div class="service-hero-grid">
      <div class="service-hero-copy reveal-slide-left">
        <span class="hero-badge">SPECIALIZED SERVICE</span>
        <h1 class="page-hero-title"><?php echo esc_html($service['title']); ?></h1>
        <span class="scribble" aria-hidden="true"></span>
        <p class="page-hero-subtitle"><?php echo esc_html($service['overview']); ?></p>
        
        <div class="button-row" style="margin-top: 30px;">
          <?php aba_button('Book a Free Consultation', aba_page_url('contact'), 'primary'); ?>
          <a class="button button--outline" href="<?php echo esc_url(aba_page_url('services')); ?>">
            <span>← All Services</span>
          </a>
        </div>
      </div>

      <div class="service-hero-visual reveal-slide-right">
        <div class="service-hero-image-wrap">
          <i class="blob blob-<?php echo esc_attr($accent); ?>" aria-hidden="true"></i>
          <?php echo aba_picture($c, $image_key, $service['title'], 'service-hero-img', true); ?>
          <div class="service-floating-badge">
            <span class="icon <?php echo esc_attr($accent); ?>" aria-hidden="true"><?php echo aba_icon($service['icon'] ?? 'people'); ?></span>
            <div>
              <strong>1-on-1 Personalized Care</strong>
              <small>BCBA Supervised</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHAT IS THIS SERVICE SECTION -->
<section class="section">
  <div class="container split-grid">
    <div class="split-copy reveal-slide-left">
      <p class="eyebrow">PROGRAM OVERVIEW</p>
      <h2>What is <?php echo esc_html($service['short_title'] ?? $service['title']); ?>?</h2>
      <span class="scribble" aria-hidden="true"></span>
      <p class="lede">
        <?php echo esc_html($service['what_is_it']); ?>
      </p>

      <?php if (!empty($service['highlight'])): ?>
        <div class="highlight-callout reveal-fade-up">
          <span class="callout-icon" aria-hidden="true">✦</span>
          <p><?php echo esc_html($service['highlight']); ?></p>
        </div>
      <?php endif; ?>
    </div>

    <div class="split-visual reveal-slide-right">
      <div class="who-card">
        <span class="icon <?php echo esc_attr($accent); ?>" aria-hidden="true"><?php echo aba_icon('target'); ?></span>
        <h3>Who Is This Service For?</h3>
        <p><?php echo esc_html($service['who_is_for']); ?></p>
        <hr style="border: 0; border-top: 1px solid var(--border); margin: 20px 0;">
        <div class="who-meta">
          <div>
            <strong>Age Groups:</strong>
            <span>Toddlers, Children &amp; Youth</span>
          </div>
          <div>
            <strong>Funding:</strong>
            <span>Ontario Autism Program (OAP) Eligible</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- KEY BENEFITS SECTION -->
<section class="section soft">
  <div class="container">
    <div class="centered reveal-fade-up">
      <p class="eyebrow">KEY BENEFITS</p>
      <h2>Why families choose this program.</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
    </div>

    <div class="benefit-cards-grid stagger-children reveal-fade-up">
      <?php 
      $b_icons = ['growth', 'heart', 'shield', 'check'];
      $benefits = $service['benefits'] ?? [];
      foreach ($benefits as $i => $ben): 
      ?>
        <article class="benefit-card">
          <div class="benefit-card-icon" aria-hidden="true">
            <?php echo aba_icon($b_icons[$i % 4]); ?>
          </div>
          <h3><?php echo esc_html($ben['title']); ?></h3>
          <p><?php echo esc_html($ben['description']); ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- HOW IT WORKS TIMELINE -->
<section class="section">
  <div class="container">
    <div class="centered reveal-fade-up" style="margin-bottom: 45px;">
      <p class="eyebrow">THE ROADMAP</p>
      <h2>How the therapy journey works.</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
    </div>

    <div class="timeline-steps stagger-children reveal-fade-up">
      <?php 
      $process = $service['process'] ?? [];
      foreach ($process as $i => $step): 
      ?>
        <div class="timeline-step">
          <div class="step-badge">
            <span><?php echo esc_html($step['number']); ?></span>
          </div>
          <div class="step-content">
            <h3><?php echo esc_html($step['title']); ?></h3>
            <p><?php echo esc_html($step['description']); ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SERVICE-SPECIFIC FAQS -->
<?php if (!empty($service['faqs'])): ?>
<section class="faq section soft" id="service-faq">
  <div class="container">
    <div class="faq-head reveal-slide-left">
      <div>
        <p class="eyebrow">QUESTIONS ABOUT THIS SERVICE</p>
        <h2>Frequently asked questions.</h2>
      </div>
      <a class="view-all-faq" href="<?php echo esc_url(aba_page_url('contact')); ?>">
        <span>Ask a Question</span>
        <span aria-hidden="true">→</span>
      </a>
    </div>

    <div class="faq-grid stagger-children reveal-fade-up">
      <?php foreach ($service['faqs'] as $i => $item): ?>
        <article class="faq-item">
          <h3>
            <button type="button" aria-expanded="false" aria-controls="faq-item-<?php echo $i; ?>">
              <span><?php echo esc_html($item['question']); ?></span>
              <i class="plus-icon" aria-hidden="true"></i>
            </button>
          </h3>
          <div class="faq-answer" id="faq-item-<?php echo $i; ?>" hidden>
            <div>
              <p><?php echo esc_html($item['answer']); ?></p>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- BOTTOM SERVICE NAVIGATION -->
<section class="service-nav-wrap section" style="padding-top: 20px; padding-bottom: 40px;">
  <div class="container">
    <div class="service-nav-bar reveal-fade-up">
      <a class="service-nav-prev" href="<?php echo esc_url(aba_service_url($prev_service['slug'])); ?>">
        <span class="nav-arrow" aria-hidden="true">←</span>
        <div>
          <small>Previous Service</small>
          <strong><?php echo esc_html($prev_service['short_title'] ?? $prev_service['title']); ?></strong>
        </div>
      </a>

      <a class="service-nav-all" href="<?php echo esc_url(aba_page_url('services')); ?>" aria-label="View all services">
        <span>All Services</span>
      </a>

      <a class="service-nav-next" href="<?php echo esc_url(aba_service_url($next_service['slug'])); ?>">
        <div>
          <small>Next Service</small>
          <strong><?php echo esc_html($next_service['short_title'] ?? $next_service['title']); ?></strong>
        </div>
        <span class="nav-arrow" aria-hidden="true">→</span>
      </a>
    </div>
  </div>
</section>

<!-- FINAL CTA BANNER -->
<?php 
aba_render_cta_banner(
    'Ready to Start ' . ($service['short_title'] ?? $service['title']) . '?',
    'Connect with our clinical team in Mississauga to schedule your child\'s initial intake and assessment.'
); 
?>

<?php get_footer(); ?>
