<?php
/* Template Name: Resources for Parents */
if (!defined('ABSPATH')) { exit; }

$c = aba_load_content();
get_header();

$breadcrumbs = [
    ['label' => 'Home', 'href' => aba_page_url('home')],
    ['label' => 'Resources', 'href' => '']
];
?>

<?php 
aba_render_page_hero(
    $c['pages']['resources']['eyebrow'] ?? 'RESOURCES FOR PARENTS',
    $c['pages']['resources']['title'] ?? 'Helpful information for your family.',
    $c['pages']['resources']['subtitle'] ?? 'Access our guides, checklists, and funding resources designed to help Ontario families navigate developmental care with confidence.',
    $breadcrumbs
); 
?>

<!-- 3 RESOURCE CARDS (REFERENCE DESIGN STYLE) -->
<section class="section">
  <div class="container">
    <div class="centered reveal-fade-up" style="margin-bottom: 45px;">
      <p class="eyebrow">ESSENTIAL GUIDES</p>
      <h2>Start here: Core parent resources.</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
    </div>

    <div class="resources-page-grid stagger-children reveal-fade-up">
      <?php 
      $ri = ['book', 'people', 'shield'];
      $r_colors = ['purple', 'teal', 'lime'];
      $rk = ['resource_understanding_aba', 'resource_getting_started', 'resource_funding'];
      foreach ($c['resources']['items'] as $i => $x): 
      ?>
        <article class="resource-card card-<?php echo $r_colors[$i % 3]; ?>" data-tilt>
          <div class="card-spotlight" aria-hidden="true"></div>
          
          <div class="resource-card-media">
            <?php echo aba_picture($c, $rk[$i], $x['title'], 'resource-card-img'); ?>
            <div class="resource-card-icon" aria-hidden="true">
              <?php echo aba_icon($ri[$i % 3]); ?>
            </div>
          </div>

          <div class="resource-card-body">
            <div class="resource-card-text">
              <h3 class="resource-card-title"><?php echo esc_html($x['title']); ?></h3>
              <p class="resource-card-desc"><?php echo esc_html($x['description']); ?></p>
            </div>
            <a class="resource-card-action" href="#guide-<?php echo $i + 1; ?>" aria-label="<?php echo esc_attr('Explore ' . $x['title']); ?>">
              <span>Explore Guide</span>
              <span class="action-arrow" aria-hidden="true">→</span>
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- DETAILED GUIDE 1: UNDERSTANDING ABA -->
<section class="section soft" id="guide-1">
  <div class="container split-grid">
    <div class="split-copy reveal-slide-left">
      <p class="eyebrow">GUIDE 01</p>
      <h2>Understanding ABA: What to Expect</h2>
      <span class="scribble" aria-hidden="true"></span>
      <p class="lede">
        Applied Behavior Analysis (ABA) is a scientifically validated therapeutic approach that focuses on how learning occurs and how human behavior is influenced by the environment.
      </p>
      <p>
        At ABA Therapy Mississauga, we prioritize positive reinforcement, dignity, and active communication. Our therapists build upon your child's natural strengths to foster meaningful independence across routines like morning preparation, peer sharing, and self-advocacy.
      </p>
      <div class="button-row" style="margin-top: 25px;">
        <?php aba_button('Explore In-Home Therapy', aba_service_url('in-home-therapy'), 'primary'); ?>
        <?php aba_button('Our Clinical Approach', aba_page_url('our-approach'), 'outline'); ?>
      </div>
    </div>

    <div class="split-visual reveal-slide-right">
      <div class="guide-box">
        <h3>What ABA Focuses On</h3>
        <ul class="check-list">
          <li>
            <span class="check-bullet" aria-hidden="true"><?php echo aba_icon('check'); ?></span>
            <div>
              <strong>Expressive &amp; Receptive Language</strong>
              <p>Teaching children functional ways to express needs and feelings.</p>
            </div>
          </li>
          <li>
            <span class="check-bullet" aria-hidden="true"><?php echo aba_icon('check'); ?></span>
            <div>
              <strong>Social &amp; Peer Play</strong>
              <p>Turn-taking, reciprocal play, and emotional regulation.</p>
            </div>
          </li>
          <li>
            <span class="check-bullet" aria-hidden="true"><?php echo aba_icon('check'); ?></span>
            <div>
              <strong>Daily Living &amp; Independence</strong>
              <p>Dressing, toileting, mealtime flexibility, and following routines.</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- DETAILED GUIDE 2: GETTING STARTED CHECKLIST -->
<section class="section" id="guide-2">
  <div class="container split-grid reverse">
    <div class="split-visual reveal-slide-left">
      <div class="checklist-card">
        <h3>First Consultation Checklist</h3>
        <ol class="consult-steps">
          <li>
            <span class="step-num">✓</span>
            <div>
              <strong>Previous Assessments</strong>
              <p>Gather any past speech, psychological, or pediatric reports.</p>
            </div>
          </li>
          <li>
            <span class="step-num">✓</span>
            <div>
              <strong>Top 3 Family Priorities</strong>
              <p>Identify which daily routines you most want to improve.</p>
            </div>
          </li>
          <li>
            <span class="step-num">✓</span>
            <div>
              <strong>OAP Funding Letter</strong>
              <p>Have your Ontario Autism Program documentation ready if applicable.</p>
            </div>
          </li>
        </ol>
      </div>
    </div>

    <div class="split-copy reveal-slide-right">
      <p class="eyebrow">GUIDE 02</p>
      <h2>Getting Started: Step-by-Step</h2>
      <span class="scribble" aria-hidden="true"></span>
      <p class="lede">
        Taking the first step into therapy should feel reassuring and clear. We walk beside you through intake, assessment, and goal-setting.
      </p>
      <p>
        During your free discovery call, we answer all your questions about therapy formats, therapist credentials, scheduling options, and how we coordinate with your child's daycare or school.
      </p>
      <div class="button-row" style="margin-top: 25px;">
        <?php aba_button('Book Your Free Intake', aba_page_url('contact'), 'primary'); ?>
        <?php aba_button('Call (905) 123-4567', 'tel:+19051234567', 'outline'); ?>
      </div>
    </div>
  </div>
</section>

<!-- DETAILED GUIDE 3: FUNDING & SUPPORT BREAKDOWN -->
<section class="section soft" id="guide-3">
  <div class="container">
    <div class="centered reveal-fade-up">
      <p class="eyebrow">GUIDE 03</p>
      <h2>Ontario Autism Funding &amp; Support Options</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
      <p style="max-width: 680px; margin: 0 auto; color: var(--text-muted); font-size: 15px;">
        Several provincial and federal programs can offset or fully cover the costs of ABA therapy and assessments in Ontario.
      </p>
    </div>

    <div class="funding-cards-grid stagger-children reveal-fade-up" style="margin-top: 40px;">
      <article class="funding-card">
        <span class="funding-badge">Provincial</span>
        <h3>Ontario Autism Program (OAP)</h3>
        <p>
          Eligible children receive funding through Core Clinical Services, Childhood Budgets, or Foundational Family Services. All our BCBA-supervised therapy and assessments qualify for direct OAP reimbursement.
        </p>
      </article>

      <article class="funding-card">
        <span class="funding-badge">Ministry</span>
        <h3>Special Services at Home (SSAH)</h3>
        <p>
          Funded by the Ontario Ministry of Children, Community and Social Services to help families with children with developmental disabilities pay for respite and personal development support.
        </p>
      </article>

      <article class="funding-card">
        <span class="funding-badge">Federal</span>
        <h3>Disability Tax Credit (DTC)</h3>
        <p>
          A non-refundable tax credit that helps reduce income tax for families supporting a child with severe and prolonged developmental challenges, unlocking substantial annual savings.
        </p>
      </article>
    </div>
  </div>
</section>

<!-- PARENT FAQS ACCORDION -->
<section class="faq section" id="faq">
  <div class="container">
    <div class="faq-head reveal-slide-left">
      <div>
        <p class="eyebrow">COMMON PARENT CONCERNS</p>
        <h2>Frequently asked parent questions.</h2>
      </div>
      <a class="view-all-faq" href="<?php echo esc_url(aba_page_url('contact')); ?>">
        <span>Need Help? Contact Us</span>
        <span aria-hidden="true">→</span>
      </a>
    </div>

    <div class="faq-grid stagger-children reveal-fade-up">
      <?php foreach ($c['faq']['items'] as $i => $item): ?>
        <article class="faq-item">
          <h3>
            <button type="button" aria-expanded="false" aria-controls="faq-res-<?php echo $i; ?>">
              <span><?php echo esc_html($item['question']); ?></span>
              <i class="plus-icon" aria-hidden="true"></i>
            </button>
          </h3>
          <div class="faq-answer" id="faq-res-<?php echo $i; ?>" hidden>
            <div>
              <p><?php echo esc_html($item['answer']); ?></p>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php aba_render_cta_banner('Have Questions About Funding or Getting Started?', 'Our knowledgeable team in Mississauga is happy to guide you through OAP forms and program options.'); ?>

<?php get_footer(); ?>
