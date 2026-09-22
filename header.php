<?php
if (!defined('ABSPATH')) { exit; }
$c = aba_load_content();
$logo_url = aba_asset_url($c, 'logo');
$current_page = aba_get_current_page();
$home_url = aba_page_url('home');

$nav_items = $c['navigation'] ?? [
    ['label' => 'Home', 'slug' => 'home'],
    ['label' => 'About Us', 'slug' => 'about'],
    ['label' => 'Services', 'slug' => 'services'],
    ['label' => 'Our Approach', 'slug' => 'our-approach'],
    ['label' => 'Resources', 'slug' => 'resources'],
    ['label' => 'Contact', 'slug' => 'contact']
];

// Determine Current Service (if single service page)
$current_service = null;
if ($current_page === 'service-detail') {
    $service_slug = $_GET['service'] ?? get_query_var('service_slug') ?? '';
    if (!empty($service_slug)) {
        $current_service = aba_get_service($service_slug);
    }
}

// --------------------------------------------------------------------------
// SEO META CONFIGURATION (Optimized for Google Search & Local Mississauga SEO)
// --------------------------------------------------------------------------
$seo_meta = [
    'home' => [
        'title' => 'ABA Therapy Mississauga | Compassionate Autism Care & BCBA Support',
        'desc' => 'Individualized, evidence-based ABA therapy in Mississauga for children with autism and developmental delays. Certified BCBAs, in-home care, and OAP funding support.',
        'keywords' => 'ABA Therapy Mississauga, Autism Therapy Mississauga, BCBA Mississauga, Ontario Autism Program OAP, In-Home ABA, Early Intervention, Speech and Behavior Therapy'
    ],
    'about' => [
        'title' => 'About Us | ABA Therapy Mississauga | Certified BCBA Clinical Team',
        'desc' => 'Meet our dedicated team of Board Certified Behavior Analysts (BCBAs) and therapists in Mississauga providing empathetic, evidence-based therapy tailored to your child.',
        'keywords' => 'About ABA Therapy Mississauga, BCBA supervisor Ontario, pediatric autism team, clinical behavior analysis Mississauga'
    ],
    'services' => [
        'title' => 'Our Services | Individualized ABA & Autism Therapy | Mississauga',
        'desc' => 'Explore flexible ABA therapy services in Mississauga: In-Home Therapy, Parent Coaching, Early Intervention, School & Daycare Support, and Assessments.',
        'keywords' => 'ABA services Mississauga, in-home therapy, parent coaching, early intervention autism, school support, autism assessments Ontario'
    ],
    'our-approach' => [
        'title' => 'Our Approach | Child-Centred & Play-Based ABA Therapy Mississauga',
        'desc' => 'We believe therapy should meet children where they are. Learn about our positive, play-based ABA approach focusing on communication, social skills, and everyday living.',
        'keywords' => 'Play-based ABA therapy, child-centered autism therapy, natural environment training, positive reinforcement, functional communication training'
    ],
    'resources' => [
        'title' => 'Parent Resources & OAP Funding Guide | ABA Therapy Mississauga',
        'desc' => 'Helpful resources for Ontario parents: What to expect in ABA, first consultation checklist, and complete guides to Ontario Autism Program (OAP) funding and DTC.',
        'keywords' => 'Ontario Autism Program funding, OAP forms Mississauga, ABA therapy checklist, Disability Tax Credit autism, SSAH funding Ontario'
    ],
    'contact' => [
        'title' => 'Contact Us | Book a Free Consultation | ABA Therapy Mississauga',
        'desc' => 'Contact ABA Therapy Mississauga today to discuss your child\'s strengths and goals. Call (905) 123-4567 or book a friendly, no-obligation consultation online.',
        'keywords' => 'Contact ABA Therapy Mississauga, book autism consultation, free discovery call, pediatric therapy clinic Mississauga'
    ]
];

if ($current_service) {
    $page_title = esc_html($current_service['title']) . ' | ABA Therapy Mississauga';
    $page_desc = esc_attr($current_service['short_description'] ?? 'Individualized ABA therapy service in Mississauga designed around your child\'s unique needs.');
    $page_keywords = esc_attr($current_service['title'] . ', ABA Therapy Mississauga, autism therapy Ontario, BCBA supervised');
    $canonical_url = aba_service_url($current_service['slug']);
} else {
    $meta_info = $seo_meta[$current_page] ?? $seo_meta['home'];
    $page_title = $meta_info['title'];
    $page_desc = $meta_info['desc'];
    $page_keywords = $meta_info['keywords'];
    $canonical_url = aba_page_url($current_page);
}

$og_image = aba_asset_url($c, 'hero_image');
$phone_number = $c['global_ctas']['phone_label'] ?? '(905) 123-4567';
$phone_clean = '+19051234567';
$email_address = $c['footer']['contact']['email'] ?? 'info@abatherapy-mississauga.ca';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- ======================================================================
       PRIMARY SEO META TAGS (GOOGLE SEARCH OPTIMIZED)
       ====================================================================== -->
  <title><?php echo esc_html($page_title); ?></title>
  <meta name="title" content="<?php echo esc_attr($page_title); ?>">
  <meta name="description" content="<?php echo esc_attr($page_desc); ?>">
  <meta name="keywords" content="<?php echo esc_attr($page_keywords); ?>">
  <meta name="author" content="ABA Therapy Mississauga">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <link rel="canonical" href="<?php echo esc_url($canonical_url); ?>">

  <!-- ======================================================================
       LOCAL & GEOGRAPHIC SEO (MISSISSAUGA & GTA FOCUS)
       ====================================================================== -->
  <meta name="geo.region" content="CA-ON">
  <meta name="geo.placename" content="Mississauga, Ontario">
  <meta name="geo.position" content="43.5890;-79.6441">
  <meta name="ICBM" content="43.5890, -79.6441">

  <!-- ======================================================================
       OPEN GRAPH / SOCIAL SHARING META TAGS
       ====================================================================== -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="ABA Therapy Mississauga">
  <meta property="og:title" content="<?php echo esc_attr($page_title); ?>">
  <meta property="og:description" content="<?php echo esc_attr($page_desc); ?>">
  <meta property="og:url" content="<?php echo esc_url($canonical_url); ?>">
  <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
  <meta property="og:image:secure_url" content="<?php echo esc_url($og_image); ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="ABA Therapy Mississauga Clinical Care">
  <meta property="og:locale" content="en_CA">

  <!-- ======================================================================
       TWITTER CARDS
       ====================================================================== -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo esc_attr($page_title); ?>">
  <meta name="twitter:description" content="<?php echo esc_attr($page_desc); ?>">
  <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">

  <!-- ======================================================================
       GOOGLE RICH SNIPPETS / SCHEMA.ORG JSON-LD STRUCTURED DATA
       ====================================================================== -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": ["MedicalBusiness", "LocalBusiness"],
    "@id": "<?php echo esc_url($home_url); ?>#medicalbusiness",
    "name": "ABA Therapy Mississauga",
    "url": "<?php echo esc_url($home_url); ?>",
    "logo": "<?php echo esc_url($logo_url); ?>",
    "image": "<?php echo esc_url($og_image); ?>",
    "description": "Compassionate, individualized ABA therapy in Mississauga for children with autism and developmental delays. Certified BCBAs, in-home care, and OAP funding support.",
    "telephone": "<?php echo esc_attr($phone_clean); ?>",
    "email": "<?php echo esc_attr($email_address); ?>",
    "priceRange": "$$",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Mississauga",
      "addressRegion": "ON",
      "postalCode": "L5B",
      "addressCountry": "CA"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": 43.5890,
      "longitude": -79.6441
    },
    "areaServed": [
      { "@type": "City", "name": "Mississauga" },
      { "@type": "City", "name": "Brampton" },
      { "@type": "City", "name": "Oakville" },
      { "@type": "City", "name": "Milton" },
      { "@type": "City", "name": "Etobicoke" }
    ],
    "medicalSpecialty": "Pediatrics",
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
        "opens": "08:00",
        "closes": "18:30"
      },
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Saturday"],
        "opens": "09:00",
        "closes": "14:00"
      }
    ]
  }
  </script>

  <!-- Critical Preloader Styles (Low Opacity - Page Always Visible Underneath) -->
  <style id="aba-critical-preloader-css">
    .site-preloader {
      position: fixed;
      inset: 0;
      width: 100vw;
      height: 100vh;
      z-index: 99999999;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 253, 250, 0.62);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      overflow: hidden;
      transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                  visibility 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                  transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .site-preloader.is-loaded {
      opacity: 0;
      visibility: hidden;
      transform: scale(1.02);
      pointer-events: none;
    }
  </style>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ======================================================================
     PREMIUM THERAPY ANIMATED PAGE PRELOADER (ALL PAGES)
     ====================================================================== -->
<div id="site-preloader" class="site-preloader" role="status" aria-live="polite" aria-label="Loading ABA Therapy Mississauga">
  <div class="preloader-backdrop"></div>
  <div class="preloader-content">
    <!-- Concentric Calming Therapy Aura Rings -->
    <div class="preloader-aura" aria-hidden="true">
      <div class="aura-ring ring-1"></div>
      <div class="aura-ring ring-2"></div>
      <div class="aura-ring ring-3"></div>
    </div>

    <!-- Glowing Brand Emblem & Logo Container -->
    <div class="preloader-logo-wrap">
      <div class="preloader-logo-card">
        <?php if ($logo_url): ?>
          <img class="preloader-logo-img" 
               src="<?php echo esc_url($logo_url); ?>" 
               alt="<?php echo esc_attr($c['site']['brand_name'] . ' ' . $c['site']['brand_subtitle']); ?>" 
               width="220" 
               height="48">
        <?php else: ?>
          <div class="preloader-fallback-brand">
            <span class="brand-mark">✦</span>
            <b><?php echo esc_html($c['site']['brand_name']); ?></b>
            <small><?php echo esc_html($c['site']['brand_subtitle']); ?></small>
          </div>
        <?php endif; ?>
        <div class="preloader-shimmer" aria-hidden="true"></div>
      </div>
    </div>

    <!-- Calming Therapy Indicator & Smooth Progress Track -->
    <div class="preloader-progress-wrap" aria-hidden="true">
      <div class="preloader-progress-bar">
        <div class="preloader-progress-fill"></div>
      </div>
      <div class="preloader-pulse-dots">
        <span class="p-dot"></span>
        <span class="p-dot"></span>
        <span class="p-dot"></span>
      </div>
    </div>

    <!-- Warm Therapeutic Reassurance Message -->
    <p class="preloader-text">Nurturing Growth &amp; Possibility</p>
  </div>
</div>
<script>
  (function() {
    var pl = document.getElementById('site-preloader');
    if (!pl) return;
    var dismissed = false;
    function hideLoader() {
      if (dismissed) return;
      dismissed = true;
      setTimeout(function() {
        pl.classList.add('is-loaded');
        if (document.body) { document.body.classList.add('page-is-loaded'); }
        setTimeout(function() {
          if (pl && pl.parentNode) {
            pl.style.display = 'none';
          }
        }, 550);
      }, 350);
    }
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
      hideLoader();
    } else {
      document.addEventListener('DOMContentLoaded', hideLoader);
      window.addEventListener('load', hideLoader);
      setTimeout(hideLoader, 750);
    }
  })();
</script>
<noscript>
  <style>
    #site-preloader { display: none !important; }
  </style>
</noscript>

<div class="scroll-progress-bar" id="scroll-progress" aria-hidden="true"></div>
<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" id="site-header">
  <div class="container header-inner">
    <a class="brand" href="<?php echo esc_url($home_url); ?>" aria-label="<?php echo esc_attr($c['site']['brand_name']); ?> home">
      <?php if ($logo_url): ?>
        <img class="brand-logo" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($c['site']['brand_name'] . ' ' . $c['site']['brand_subtitle']); ?>" width="210" height="46">
      <?php else: ?>
        <span class="brand-mark">✦</span>
        <span>
          <b><?php echo esc_html($c['site']['brand_name']); ?></b>
          <small><?php echo esc_html($c['site']['brand_subtitle']); ?></small>
        </span>
      <?php endif; ?>
    </a>

    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Toggle navigation menu">
      <span></span><span></span><span></span>
    </button>

    <nav id="site-nav" class="site-nav" aria-label="Primary Navigation">
      <ul>
        <?php foreach ($nav_items as $item): 
          $is_active = ($current_page === $item['slug']) ? 'is-active' : '';
        ?>
          <li>
            <a class="<?php echo esc_attr($is_active); ?>" href="<?php echo esc_url(aba_page_url($item['slug'])); ?>">
              <?php echo esc_html($item['label']); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div class="header-cta-wrap">
      <?php aba_button($c['global_ctas']['primary'], aba_page_url('contact'), 'primary'); ?>
    </div>
  </div>
</header>

<main id="main">
