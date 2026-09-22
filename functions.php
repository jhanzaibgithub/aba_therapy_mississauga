<?php
// Fallback stubs for direct access outside WordPress (e.g. direct XAMPP browser preview)
if (!function_exists('add_action')) {
    if (!function_exists('get_template_directory')) {
        function get_template_directory(): string {
            return __DIR__;
        }
    }

    if (!function_exists('get_template_directory_uri')) {
        function get_template_directory_uri(): string {
            $script_name = $_SERVER['SCRIPT_NAME'] ?? '';
            $dir = dirname($script_name);
            return rtrim(str_replace('\\', '/', $dir), '/');
        }
    }

    if (!function_exists('home_url')) {
        function home_url(string $path = ''): string {
            $uri = get_template_directory_uri();
            return $uri . '/' . ltrim($path, '/');
        }
    }

    if (!function_exists('add_theme_support')) {
        function add_theme_support($feature, $options = null): void {}
    }

    if (!function_exists('add_action')) {
        function add_action($hook, $callback): void {}
    }

    if (!function_exists('add_filter')) {
        function add_filter($hook, $callback): void {}
    }

    if (!function_exists('add_rewrite_rule')) {
        function add_rewrite_rule($regex, $query, $after = 'bottom'): void {}
    }

    if (!function_exists('add_rewrite_tag')) {
        function add_rewrite_tag($tag, $regex): void {}
    }

    if (!function_exists('get_query_var')) {
        function get_query_var($var, $default = '') {
            return $_GET[$var] ?? $default;
        }
    }

    if (!function_exists('wp_enqueue_style')) {
        function wp_enqueue_style($handle, $src = '', $deps = [], $ver = false, $media = 'all'): void {}
    }

    if (!function_exists('wp_enqueue_script')) {
        function wp_enqueue_script($handle, $src = '', $deps = [], $ver = false, $in_footer = false): void {}
    }

    if (!function_exists('esc_html')) {
        function esc_html($text): string {
            return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
        }
    }

    if (!function_exists('esc_html__')) {
        function esc_html__($text, $domain = 'default'): string {
            return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
        }
    }

    if (!function_exists('esc_attr')) {
        function esc_attr($text): string {
            return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
        }
    }

    if (!function_exists('esc_url')) {
        function esc_url($url): string {
            return htmlspecialchars((string)$url, ENT_QUOTES, 'UTF-8');
        }
    }

    if (!function_exists('antispambot')) {
        function antispambot($email): string {
            return (string)$email;
        }
    }

    if (!function_exists('current_user_can')) {
        function current_user_can($capability): bool {
            return true;
        }
    }

    if (!function_exists('__')) {
        function __($text, $domain = 'default'): string {
            return (string)$text;
        }
    }

    if (!function_exists('status_header')) {
        function status_header($code): void {
            http_response_code($code);
        }
    }

    if (!function_exists('get_header')) {
        function get_header($name = null): void {
            require_once __DIR__ . '/header.php';
        }
    }

    if (!function_exists('get_footer')) {
        function get_footer($name = null): void {
            require_once __DIR__ . '/footer.php';
        }
    }

    if (!function_exists('language_attributes')) {
        function language_attributes(): void {
            echo 'lang="en-US"';
        }
    }

    if (!function_exists('bloginfo')) {
        function bloginfo($show = ''): void {
            if ($show === 'charset') { echo 'UTF-8'; }
        }
    }

    if (!function_exists('wp_head')) {
        function wp_head(): void {
            $uri = get_template_directory_uri();
            echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
            echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
            echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">' . "\n";
            echo '<link rel="stylesheet" href="' . esc_url($uri . '/assets/css/landing.css') . '">' . "\n";
        }
    }

    if (!function_exists('body_class')) {
        function body_class($class = ''): void {
            $current = aba_get_current_page();
            $classes = 'aba-body page-' . esc_attr($current);
            if ($class) {
                $classes .= ' ' . esc_attr($class);
            }
            echo 'class="' . $classes . '"';
        }
    }

    if (!function_exists('wp_body_open')) {
        function wp_body_open(): void {}
    }

    if (!function_exists('wp_footer')) {
        function wp_footer(): void {
            $uri = get_template_directory_uri();
            echo '<script src="' . esc_url($uri . '/assets/js/landing.js') . '"></script>' . "\n";
        }
    }
}

// Standard Theme Setup & Enqueues inside WordPress
function aba_theme_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['style', 'script']);
}
add_action('after_setup_theme', 'aba_theme_setup');

function aba_enqueue_assets(): void {
    $uri = get_template_directory_uri();
    $dir = get_template_directory();

    $css_file = $dir . '/assets/css/landing.css';
    $css_ver = file_exists($css_file) ? (string)filemtime($css_file) : '1.0.0';
    $js_file = $dir . '/assets/js/landing.js';
    $js_ver = file_exists($js_file) ? (string)filemtime($js_file) : '1.0.0';

    wp_enqueue_style('aba-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('aba-landing', $uri . '/assets/css/landing.css', ['aba-fonts'], $css_ver);
    wp_enqueue_script('aba-landing', $uri . '/assets/js/landing.js', [], $js_ver, true);
}
add_action('wp_enqueue_scripts', 'aba_enqueue_assets');

// Safely flush rewrite rules when theme is activated
add_action('after_switch_theme', function(): void {
    if (function_exists('flush_rewrite_rules')) {
        flush_rewrite_rules();
    }
});

// Register clean rewrite rules for single service pages in WordPress
add_action('init', function(): void {
    add_rewrite_rule('^services/([a-zA-Z0-9_-]+)/?$', 'index.php?service_slug=$matches[1]', 'top');
    add_rewrite_tag('%service_slug%', '([^&]+)');
});

add_filter('template_include', function($template) {
    $service_slug = get_query_var('service_slug');
    if (!empty($service_slug)) {
        $file = get_template_directory() . '/single-service.php';
        if (file_exists($file)) {
            return $file;
        }
    }
    return $template;
});

// JSON Content Loader
function aba_load_content(): array {
    static $content = null;
    if (is_array($content)) { return $content; }

    $path = get_template_directory() . '/content/aba-therapy-landing-page-content.json';
    if (!is_readable($path)) {
        return ['_error' => __('Landing-page content file is missing or unreadable.', 'aba-therapy')];
    }

    $raw = file_get_contents($path);
    if ($raw === false) {
        return ['_error' => __('Failed to read landing-page JSON content file.', 'aba-therapy')];
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded) || json_last_error() !== JSON_ERROR_NONE) {
        $message = __('Landing-page JSON is invalid.', 'aba-therapy');
        if (current_user_can('manage_options')) {
            $message .= ' Error: ' . json_last_error_msg();
        }
        return ['_error' => $message];
    }

    $required_keys = [
        'site', 'navigation', 'global_ctas', 'hero', 'approach',
        'services', 'family_fit', 'how_it_works', 'resources',
        'local_area', 'faq', 'final_cta', 'footer', 'media'
    ];

    foreach ($required_keys as $key) {
        if (!array_key_exists($key, $decoded)) {
            return ['_error' => sprintf(__('Landing-page JSON is missing the "%s" section.', 'aba-therapy'), $key)];
        }
    }

    return $content = $decoded;
}

// Media URL Resolver
function aba_asset_url(array $content, string $key): string {
    $relative = $content['media']['assets'][$key] ?? '';
    if (!$relative) { return ''; }
    $clean_relative = ltrim(str_replace('\\', '/', $relative), '/');
    return esc_url(get_template_directory_uri() . '/' . $clean_relative);
}

// Navigation & URL Routing Helpers
function aba_get_current_page(): string {
    if (isset($_GET['service']) && !empty($_GET['service'])) {
        return 'service-detail';
    }
    $wp_service = get_query_var('service_slug');
    if (!empty($wp_service)) {
        return 'service-detail';
    }

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        return aba_sanitize_slug($_GET['page']);
    }

    if (function_exists('is_front_page') && is_front_page()) {
        return 'home';
    }

    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(parse_url($uri, PHP_URL_PATH) ?? '', '/');
    $parts = explode('/', $path);
    $last = end($parts);

    $known_pages = ['about', 'services', 'our-approach', 'resources', 'contact'];
    if (in_array($last, $known_pages, true)) {
        return $last;
    }

    return 'home';
}

function aba_sanitize_slug(string $title): string {
    if (function_exists('sanitize_title')) {
        return sanitize_title($title);
    }
    return strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $title));
}
if (!function_exists('sanitize_title')) {
    function sanitize_title(string $title): string {
        return aba_sanitize_slug($title);
    }
}

function aba_page_url(string $slug): string {
    $slug = trim($slug, '/');
    if ($slug === 'home' || $slug === '' || $slug === '#home') {
        if (defined('ABA_STANDALONE_ROUTER') && ABA_STANDALONE_ROUTER) {
            return 'index.php';
        }
        return home_url('/');
    }

    if (defined('ABA_STANDALONE_ROUTER') && ABA_STANDALONE_ROUTER) {
        return 'index.php?page=' . urlencode($slug);
    }

    return home_url('/' . $slug . '/');
}

function aba_service_url(string $slug): string {
    $slug = trim($slug, '/');
    if (defined('ABA_STANDALONE_ROUTER') && ABA_STANDALONE_ROUTER) {
        return 'index.php?service=' . urlencode($slug);
    }
    return home_url('/services/' . $slug . '/');
}

function aba_get_all_services(): array {
    $content = aba_load_content();
    return $content['services_catalog'] ?? [];
}

function aba_get_service(string $slug): ?array {
    $services = aba_get_all_services();
    foreach ($services as $service) {
        if ($service['slug'] === $slug) {
            return $service;
        }
    }
    return $services[0] ?? null;
}

// Global UI Component Renderers
function aba_button(string $label, string $href = '#contact', string $style = 'primary'): void {
    printf(
        '<a class="button button--%s" href="%s"><span>%s</span><span aria-hidden="true">→</span></a>',
        esc_attr($style),
        esc_url($href),
        esc_html($label)
    );
}

function aba_render_page_hero(string $eyebrow, string $title, string $subtitle = '', array $breadcrumbs = []): void {
    ?>
    <section class="page-hero section">
      <div class="container page-hero-inner">
        <?php if (!empty($breadcrumbs)): ?>
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
        <?php endif; ?>

        <div class="page-hero-content reveal-fade-up">
          <span class="hero-badge"><?php echo esc_html($eyebrow); ?></span>
          <h1 class="page-hero-title"><?php echo esc_html($title); ?></h1>
          <span class="scribble" aria-hidden="true"></span>
          <?php if (!empty($subtitle)): ?>
            <p class="page-hero-subtitle"><?php echo esc_html($subtitle); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <?php
}

function aba_render_cta_banner(string $title = '', string $description = '', string $primary = '', string $href = ''): void {
    $c = aba_load_content();
    $title = $title ?: ($c['final_cta']['title'] ?? "Ready to take the next step?");
    $desc = $description ?: ($c['final_cta']['description'] ?? "We're here to help your child grow, learn and thrive.");
    $btn_label = $primary ?: ($c['final_cta']['primary'] ?? "Book a Consultation");
    $btn_href = $href ?: aba_page_url('contact');
    $phone = $c['global_ctas']['phone_href'] ?? 'tel:+19051234567';
    ?>
    <section class="final-wrap" id="cta-banner">
      <div class="container final-cta reveal-scale">
        <div class="final-cta-copy">
          <h2><?php echo esc_html($title); ?></h2>
          <p><?php echo esc_html($desc); ?></p>
        </div>
        <div class="button-row">
          <a class="button button--light" href="<?php echo esc_url($btn_href); ?>">
            <span><?php echo esc_html($btn_label); ?></span>
            <span aria-hidden="true">→</span>
          </a>
          <a class="button button--outline-light" href="<?php echo esc_url($phone); ?>">
            <span><?php echo esc_html($c['final_cta']['secondary'] ?? "Call (905) 123-4567"); ?></span>
            <span aria-hidden="true">→</span>
          </a>
        </div>
      </div>
    </section>
    <?php
}

function aba_icon(string $name): string {
    $paths = [
        'people' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'chat' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
        'leaf' => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
        'home' => '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
        'book' => '<path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>',
        'clipboard' => '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>',
        'target' => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
        'growth' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><polyline points="3 8 9 2 15 8 21 2"/>',
        'heart' => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>',
        'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        'check' => '<polyline points="20 6 9 17 4 12"/>'
    ];
    $svg = $paths[$name] ?? $paths['heart'];
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $svg . '</svg>';
}

function aba_placeholder(string $class, string $label): string {
    return sprintf(
        '<div class="media-placeholder %s" role="img" aria-label="%s"><span>%s</span></div>',
        esc_attr($class),
        esc_attr($label),
        aba_icon('heart')
    );
}

function aba_picture(array $content, string $key, string $alt, string $class = '', bool $eager = false): string {
    $relative = $content['media']['assets'][$key] ?? '';
    if (!$relative) {
        return aba_placeholder($class, $alt);
    }
    $clean_relative = ltrim(str_replace('\\', '/', $relative), '/');
    $path = get_template_directory() . '/' . $clean_relative;

    if (!is_readable($path)) {
        return aba_placeholder($class, $alt);
    }

    return sprintf(
        '<img class="%s" src="%s" alt="%s" loading="%s" decoding="async">',
        esc_attr($class),
        aba_asset_url($content, $key),
        esc_attr($alt),
        $eager ? 'eager' : 'lazy'
    );
}

function aba_render_error(string $message): void {
    status_header(500);
    echo '<main class="aba-error container" style="padding: 100px 20px; text-align: center;">';
    echo '<h1>' . esc_html__('Page content unavailable', 'aba-therapy') . '</h1>';
    echo '<p>' . esc_html($message) . '</p>';
    echo '</main>';
}
