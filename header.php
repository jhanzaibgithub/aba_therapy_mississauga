<?php
if (!defined('ABSPATH')) { exit; }
$c = aba_load_content();
$logo_url = aba_asset_url($c, 'logo');
$current_page = aba_get_current_page();
$home_url = aba_page_url('home');

$nav_items = $c['navigation'] ?? [
    ['label' => 'Home', 'slug' => 'home'],
    ['label' => 'About', 'slug' => 'about'],
    ['label' => 'Services', 'slug' => 'services'],
    ['label' => 'Our Approach', 'slug' => 'our-approach'],
    ['label' => 'Resources', 'slug' => 'resources'],
    ['label' => 'Contact', 'slug' => 'contact']
];
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

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
