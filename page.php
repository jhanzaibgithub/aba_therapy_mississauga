<?php
/**
 * The template for displaying all pages
 *
 * @package ABA_Therapy_Mississauga
 */

if (!defined('ABSPATH')) { exit; }

$c = aba_load_content();
get_header();

$eyebrow = get_post_meta(get_the_ID(), '_aba_hero_eyebrow', true) ?: 'ABA THERAPY MISSISSAUGA';
$title = get_post_meta(get_the_ID(), '_aba_hero_title', true) ?: get_the_title();
$subtitle = get_post_meta(get_the_ID(), '_aba_hero_subtitle', true);

aba_render_page_hero(
    $eyebrow,
    $title,
    $subtitle,
    [
        ['label' => 'Home', 'href' => aba_page_url('home')],
        ['label' => get_the_title(), 'href' => '']
    ]
);
?>

<main class="page-content section">
  <div class="container rich-content" style="max-width: 860px; margin: 0 auto; padding: 40px 20px; line-height: 1.8; font-size: 1.1rem;">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
  </div>
</main>

<?php
aba_render_cta_banner();
get_footer();
