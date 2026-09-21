<?php
/* Template Name: Services Catalog */
if (!defined('ABSPATH')) { exit; }

$c = aba_load_content();
get_header();

$services = aba_get_all_services();
$breadcrumbs = [
    ['label' => 'Home', 'href' => aba_page_url('home')],
    ['label' => 'Our Services', 'href' => '']
];
?>

<?php 
aba_render_page_hero(
    $c['pages']['services']['eyebrow'] ?? 'OUR SERVICES',
    $c['pages']['services']['title'] ?? 'Support that fits your child and your family.',
    $c['pages']['services']['subtitle'] ?? 'Explore our evidence-based therapy services designed to build communication, connection, and independence across every environment.',
    $breadcrumbs
); 
?>

<!-- SERVICES CATALOG GRID SECTION -->
<section class="section">
  <div class="container">
    <div class="centered reveal-fade-up" style="margin-bottom: 50px;">
      <p class="eyebrow">INDIVIDUALIZED CARE</p>
      <h2>Choose a service to explore in detail.</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
      <p style="max-width: 680px; margin: 0 auto; color: var(--text-muted); font-size: 15px;">
        Every child is unique. Click any service card below to view in-depth program details, benefits, step-by-step processes, and parent FAQs.
      </p>
    </div>

    <div class="services-catalog-grid stagger-children reveal-fade-up">
      <?php foreach ($services as $srv): 
        $accent = $srv['accent'] ?? 'purple';
        $slug = $srv['slug'];
        $image_key = $srv['image_key'] ?? 'service_in_home';
      ?>
        <article class="resource-card card-<?php echo esc_attr($accent); ?>" data-tilt>
          <div class="card-spotlight" aria-hidden="true"></div>
          
          <div class="resource-card-media">
            <?php echo aba_picture($c, $image_key, $srv['title'], 'resource-card-img'); ?>
            <div class="resource-card-icon" aria-hidden="true">
              <?php echo aba_icon($srv['icon'] ?? 'people'); ?>
            </div>
          </div>

          <div class="resource-card-body">
            <div class="resource-card-text">
              <h3 class="resource-card-title"><?php echo esc_html($srv['title']); ?></h3>
              <p class="resource-card-desc"><?php echo esc_html($srv['description']); ?></p>
            </div>
            <a class="resource-card-action" href="<?php echo esc_url(aba_service_url($slug)); ?>" aria-label="<?php echo esc_attr('Explore ' . $srv['title']); ?>">
              <span>Explore Program</span>
              <span class="action-arrow" aria-hidden="true">→</span>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- HOW TO CHOOSE THE RIGHT SERVICE -->
<section class="section soft">
  <div class="container split-grid">
    <div class="split-copy reveal-slide-left">
      <p class="eyebrow">GETTING STARTED</p>
      <h2>Not sure where to begin?</h2>
      <span class="scribble" aria-hidden="true"></span>
      <p class="lede">
        Navigating behavioral therapy and funding options can feel overwhelming. You don't have to figure it out alone.
      </p>
      <p>
        During your free initial consultation, our clinical director will listen to your child's story, discuss daily routines, and recommend the ideal combination of services to achieve meaningful, joyful progress.
      </p>
      <div class="button-row" style="margin-top: 25px;">
        <?php aba_button('Book a Free Consultation', aba_page_url('contact'), 'primary'); ?>
        <?php aba_button('Call (905) 123-4567', 'tel:+19051234567', 'outline'); ?>
      </div>
    </div>

    <div class="split-visual reveal-slide-right">
      <div class="consult-card">
        <h3>What Happens Next?</h3>
        <ol class="consult-steps">
          <li>
            <span class="step-num">1</span>
            <div>
              <strong>15-Minute Discovery Call</strong>
              <p>We discuss your child's age, strengths, challenges, and goals.</p>
            </div>
          </li>
          <li>
            <span class="step-num">2</span>
            <div>
              <strong>Clinical Assessment</strong>
              <p>Direct milestone evaluation conducted by our certified BCBA.</p>
            </div>
          </li>
          <li>
            <span class="step-num">3</span>
            <div>
              <strong>Customized Treatment Plan</strong>
              <p>Tailored therapy schedule designed around your family routine.</p>
            </div>
          </li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES FAQ -->
<section class="faq section" id="faq">
  <div class="container">
    <div class="faq-head reveal-slide-left">
      <div>
        <p class="eyebrow">COMMON QUESTIONS</p>
        <h2>Frequently asked questions about our services.</h2>
      </div>
      <a class="view-all-faq" href="<?php echo esc_url(aba_page_url('contact')); ?>">
        <span>Speak With a Therapist</span>
        <span aria-hidden="true">→</span>
      </a>
    </div>

    <div class="faq-grid stagger-children reveal-fade-up">
      <article class="faq-item">
        <h3>
          <button type="button" aria-expanded="false" aria-controls="faq-srv-0">
            <span>Are services covered under the Ontario Autism Program (OAP)?</span>
            <i class="plus-icon" aria-hidden="true"></i>
          </button>
        </h3>
        <div class="faq-answer" id="faq-srv-0" hidden>
          <div>
            <p>Yes, all of our clinical ABA services, assessments, parent coaching, and direct therapy are eligible for Ontario Autism Program (OAP) Core Clinical Services and Childhood Budgets.</p>
          </div>
        </div>
      </article>

      <article class="faq-item">
        <h3>
          <button type="button" aria-expanded="false" aria-controls="faq-srv-1">
            <span>Can we combine multiple services?</span>
            <i class="plus-icon" aria-hidden="true"></i>
          </button>
        </h3>
        <div class="faq-answer" id="faq-srv-1" hidden>
          <div>
            <p>Absolutely. Most families benefit from a blended approach — for example, combining In-Home Therapy with regular Parent Coaching and School Support for consistent results.</p>
          </div>
        </div>
      </article>

      <article class="faq-item">
        <h3>
          <button type="button" aria-expanded="false" aria-controls="faq-srv-2">
            <span>How quickly can therapy start after the initial call?</span>
            <i class="plus-icon" aria-hidden="true"></i>
          </button>
        </h3>
        <div class="faq-answer" id="faq-srv-2" hidden>
          <div>
            <p>We pride ourselves on minimal waitlists. Following your initial discovery call and assessment, therapy sessions typically begin within 1 to 2 weeks.</p>
          </div>
        </div>
      </article>
    </div>
  </div>
</section>

<?php aba_render_cta_banner('Ready to Get Started?', 'Contact us today to design an individualized therapy program for your child.'); ?>

<?php get_footer(); ?>
