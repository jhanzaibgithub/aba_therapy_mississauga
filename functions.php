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

// Safely flush rewrite rules & automatically create pages when theme is activated
add_action('after_switch_theme', function(): void {
    aba_setup_pages_and_options(true);
    if (function_exists('flush_rewrite_rules')) {
        flush_rewrite_rules();
    }
});

// Auto-create pages on first admin visit if not yet created, or via button
add_action('admin_init', function(): void {
    if (isset($_GET['aba_create_pages']) && current_user_can('manage_options')) {
        aba_setup_pages_and_options(true);
        wp_safe_redirect(admin_url('edit.php?post_type=page&aba_created=1'));
        exit;
    }

    $installed_ver = get_option('aba_theme_version', '');
    if ($installed_ver !== '1.2.0') {
        aba_setup_pages_and_options(false);
        update_option('aba_theme_version', '1.2.0');
    }
});

// Admin success notice
add_action('admin_notices', function(): void {
    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_GET['aba_created'])) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>ABA Therapy Mississauga:</strong> All website pages have been created and assigned successfully!</p></div>';
    }
});

// Appearance -> Setup Theme Pages & Edit Website Content tools in WordPress Admin
add_action('admin_menu', function(): void {
    add_theme_page(
        'Edit Website Content',
        'Edit Website Content',
        'manage_options',
        'aba-theme-content',
        'aba_render_theme_content_page'
    );

    add_theme_page(
        'Setup Theme Pages',
        'Setup Theme Pages',
        'manage_options',
        'aba-setup-pages',
        function(): void {
            if (isset($_POST['aba_run_setup'])) {
                check_admin_referer('aba_setup_pages_nonce');
                aba_setup_pages_and_options(true);
                echo '<div class="notice notice-success"><p><strong>Success!</strong> All 6 website pages (Home, About Us, Services, Our Approach, Resources, Contact) are created, populated with data, and assigned to custom templates.</p></div>';
            }
            ?>
            <div class="wrap">
                <h1>ABA Therapy Mississauga - Automatic Page Setup</h1>
                <p>This tool automatically creates all 6 website pages in your WordPress <strong>Pages</strong> menu, populates them with their full headings and content, assigns their custom templates, sets Home as the Front Page, and configures clean URLs.</p>
                <form method="post">
                    <?php wp_nonce_field('aba_setup_pages_nonce'); ?>
                    <input type="submit" name="aba_run_setup" class="button button-primary button-large" value="Generate / Update All Website Pages Now">
                </form>
            </div>
            <?php
        }
    );
});

// Admin Panel for Editing All Website Content Under Appearance -> Edit Website Content
function aba_render_theme_content_page(): void {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['aba_save_theme_content'])) {
        check_admin_referer('aba_theme_content_nonce');
        $custom = [
            'site' => [
                'brand_name' => sanitize_text_field($_POST['brand_name'] ?? 'ABA THERAPY'),
                'brand_subtitle' => sanitize_text_field($_POST['brand_subtitle'] ?? 'MISSISSAUGA'),
            ],
            'global_ctas' => [
                'primary' => sanitize_text_field($_POST['cta_primary'] ?? 'Book a Consultation'),
                'secondary' => sanitize_text_field($_POST['cta_secondary'] ?? 'Explore Our Approach'),
                'phone_label' => sanitize_text_field($_POST['phone_label'] ?? '(905) 123-4567'),
                'phone_href' => sanitize_text_field($_POST['phone_href'] ?? 'tel:+19051234567'),
            ],
            'hero' => [
                'eyebrow' => sanitize_text_field($_POST['hero_eyebrow'] ?? ''),
                'title' => sanitize_text_field($_POST['hero_title'] ?? ''),
                'description' => sanitize_textarea_field($_POST['hero_description'] ?? ''),
                'trust_text' => sanitize_text_field($_POST['hero_trust_text'] ?? ''),
            ],
            'footer' => [
                'contact' => [
                    'phone' => sanitize_text_field($_POST['phone_label'] ?? '(905) 123-4567'),
                    'email' => sanitize_email($_POST['contact_email'] ?? 'info@abatherapy-mississauga.ca'),
                    'location' => sanitize_text_field($_POST['contact_location'] ?? 'Mississauga, Ontario'),
                ],
                'brand_description' => sanitize_textarea_field($_POST['footer_brand_desc'] ?? ''),
            ],
        ];

        update_option('aba_theme_custom_content', $custom);
        echo '<div class="notice notice-success is-dismissible"><p><strong>Website content updated successfully!</strong> Changes are live across all pages.</p></div>';
    }

    $c = aba_load_content();
    ?>
    <div class="wrap">
        <h1>Edit Website Content &amp; Headings</h1>
        <p>Edit global headings, phone numbers, emails, and hero copy below without needing Elementor. Everything updates live across the site.</p>
        
        <form method="post" style="max-width: 820px; background: #fff; padding: 25px 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-top: 15px;">
            <?php wp_nonce_field('aba_theme_content_nonce'); ?>
            
            <h2 style="border-bottom: 2px solid #59209b; padding-bottom: 8px; color: #59209b;">📞 Contact Information &amp; Branding</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="phone_label">Phone Number (Display)</label></th>
                    <td><input name="phone_label" type="text" id="phone_label" value="<?php echo esc_attr($c['global_ctas']['phone_label'] ?? '(905) 123-4567'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="phone_href">Phone Number (Clickable Link)</label></th>
                    <td><input name="phone_href" type="text" id="phone_href" value="<?php echo esc_attr($c['global_ctas']['phone_href'] ?? 'tel:+19051234567'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="contact_email">Email Address</label></th>
                    <td><input name="contact_email" type="email" id="contact_email" value="<?php echo esc_attr($c['footer']['contact']['email'] ?? 'info@abatherapy-mississauga.ca'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="contact_location">Office Location</label></th>
                    <td><input name="contact_location" type="text" id="contact_location" value="<?php echo esc_attr($c['footer']['contact']['location'] ?? 'Mississauga, Ontario'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="brand_name">Brand Name</label></th>
                    <td><input name="brand_name" type="text" id="brand_name" value="<?php echo esc_attr($c['site']['brand_name'] ?? 'ABA THERAPY'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="brand_subtitle">Brand Subtitle</label></th>
                    <td><input name="brand_subtitle" type="text" id="brand_subtitle" value="<?php echo esc_attr($c['site']['brand_subtitle'] ?? 'MISSISSAUGA'); ?>" class="regular-text"></td>
                </tr>
            </table>

            <h2 style="border-bottom: 2px solid #59209b; padding-bottom: 8px; color: #59209b; margin-top: 35px;">🏠 Homepage Hero Section</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="hero_eyebrow">Hero Tagline / Eyebrow</label></th>
                    <td><input name="hero_eyebrow" type="text" id="hero_eyebrow" value="<?php echo esc_attr($c['hero']['eyebrow'] ?? ''); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="hero_title">Hero Main Heading</label></th>
                    <td><input name="hero_title" type="text" id="hero_title" value="<?php echo esc_attr($c['hero']['title'] ?? ''); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="hero_description">Hero Description / Paragraph</label></th>
                    <td><textarea name="hero_description" id="hero_description" rows="3" class="large-text"><?php echo esc_textarea($c['hero']['description'] ?? ''); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cta_primary">Primary Button Label</label></th>
                    <td><input name="cta_primary" type="text" id="cta_primary" value="<?php echo esc_attr($c['global_ctas']['primary'] ?? 'Book a Consultation'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="cta_secondary">Secondary Button Label</label></th>
                    <td><input name="cta_secondary" type="text" id="cta_secondary" value="<?php echo esc_attr($c['global_ctas']['secondary'] ?? 'Explore Our Approach'); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="hero_trust_text">Trust Badge Text</label></th>
                    <td><input name="hero_trust_text" type="text" id="hero_trust_text" value="<?php echo esc_attr($c['hero']['trust_text'] ?? ''); ?>" class="large-text"></td>
                </tr>
            </table>

            <p class="submit" style="margin-top: 25px;">
                <input type="submit" name="aba_save_theme_content" id="submit" class="button button-primary button-large" value="Save All Changes">
            </p>
        </form>
    </div>
    <?php
}

// Register Meta Box in WordPress Admin -> Pages -> Edit Page
add_action('add_meta_boxes', function(): void {
    add_meta_box(
        'aba_page_headings_box',
        '⭐ Page Headings & Banner Content (ABA Therapy Theme)',
        'aba_render_page_headings_metabox',
        'page',
        'normal',
        'high'
    );
});

function aba_render_page_headings_metabox($post): void {
    wp_nonce_field('aba_save_page_meta_nonce', 'aba_page_meta_nonce');
    $c = aba_load_content();
    $slug = $post->post_name ?: '';

    $eyebrow = get_post_meta($post->ID, '_aba_hero_eyebrow', true);
    $title = get_post_meta($post->ID, '_aba_hero_title', true);
    $subtitle = get_post_meta($post->ID, '_aba_hero_subtitle', true);

    if ($slug === 'home' || $slug === '') {
        $eyebrow = $eyebrow !== '' ? $eyebrow : ($c['hero']['eyebrow'] ?? '');
        $title = $title !== '' ? $title : ($c['hero']['title'] ?? '');
        $subtitle = $subtitle !== '' ? $subtitle : ($c['hero']['description'] ?? '');
        $trust_text = get_post_meta($post->ID, '_aba_hero_trust', true);
        $trust_text = $trust_text !== '' ? $trust_text : ($c['hero']['trust_text'] ?? '');
    } elseif (isset($c['pages'][$slug])) {
        $eyebrow = $eyebrow !== '' ? $eyebrow : ($c['pages'][$slug]['eyebrow'] ?? '');
        $title = $title !== '' ? $title : ($c['pages'][$slug]['title'] ?? '');
        $subtitle = $subtitle !== '' ? $subtitle : ($c['pages'][$slug]['subtitle'] ?? '');
    }
    ?>
    <div style="padding: 10px 0;">
        <p style="font-size: 13px; color: #444; margin-bottom: 15px; background: #f0f6fc; padding: 10px 14px; border-left: 4px solid #59209b; border-radius: 4px;">
            ✏️ <strong>Live Visual Headings &amp; Banners:</strong> Edit the main hero banner headings and text for this page below. When you click <strong>Update</strong>, these headings will update immediately on the website without needing Elementor.
        </p>
        
        <p>
            <label for="aba_hero_eyebrow" style="font-weight: 600; display: block; margin-bottom: 5px;">Hero Tagline / Eyebrow (Small Top Text):</label>
            <input type="text" id="aba_hero_eyebrow" name="aba_hero_eyebrow" value="<?php echo esc_attr($eyebrow); ?>" class="widefat" style="padding: 8px 10px;">
        </p>

        <p>
            <label for="aba_hero_title" style="font-weight: 600; display: block; margin-bottom: 5px;">Main Heading Title (H1):</label>
            <input type="text" id="aba_hero_title" name="aba_hero_title" value="<?php echo esc_attr($title); ?>" class="widefat" style="padding: 8px 10px; font-size: 15px; font-weight: bold;">
        </p>

        <p>
            <label for="aba_hero_subtitle" style="font-weight: 600; display: block; margin-bottom: 5px;">Subtitle / Description Paragraph:</label>
            <textarea id="aba_hero_subtitle" name="aba_hero_subtitle" rows="3" class="widefat" style="padding: 8px 10px;"><?php echo esc_textarea($subtitle); ?></textarea>
        </p>

        <?php if ($slug === 'home' || $slug === ''): ?>
            <p>
                <label for="aba_hero_trust" style="font-weight: 600; display: block; margin-bottom: 5px;">Trust Badge Text (Under Buttons):</label>
                <input type="text" id="aba_hero_trust" name="aba_hero_trust" value="<?php echo esc_attr($trust_text ?? ''); ?>" class="widefat" style="padding: 8px 10px;">
            </p>
        <?php endif; ?>

        <?php if ($slug === 'contact'): 
            $phone = get_post_meta($post->ID, '_aba_contact_phone', true) ?: ($c['global_ctas']['phone_label'] ?? '(905) 123-4567');
            $email = get_post_meta($post->ID, '_aba_contact_email', true) ?: ($c['footer']['contact']['email'] ?? 'info@aba-therapy-mississauga.ca');
            $address = get_post_meta($post->ID, '_aba_contact_address', true) ?: 'Mississauga, Ontario (Serving Peel & Halton Regions)';
            $hours = get_post_meta($post->ID, '_aba_contact_hours', true) ?: 'Monday – Friday: 8:00 AM – 6:30 PM | Saturday: 9:00 AM – 2:00 PM';
        ?>
            <div style="margin-top: 25px; padding-top: 20px; border-top: 2px dashed #ddd;">
                <h3 style="margin-top: 0; color: #59209b;">📞 Direct Contact Details for Contact Page</h3>
                <p>
                    <label for="aba_contact_phone" style="font-weight: 600; display: block; margin-bottom: 5px;">Phone Number (Display):</label>
                    <input type="text" id="aba_contact_phone" name="aba_contact_phone" value="<?php echo esc_attr($phone); ?>" class="widefat" style="padding: 8px 10px;">
                </p>
                <p>
                    <label for="aba_contact_email" style="font-weight: 600; display: block; margin-bottom: 5px;">Email Address:</label>
                    <input type="email" id="aba_contact_email" name="aba_contact_email" value="<?php echo esc_attr($email); ?>" class="widefat" style="padding: 8px 10px;">
                </p>
                <p>
                    <label for="aba_contact_address" style="font-weight: 600; display: block; margin-bottom: 5px;">Location / Service Area:</label>
                    <input type="text" id="aba_contact_address" name="aba_contact_address" value="<?php echo esc_attr($address); ?>" class="widefat" style="padding: 8px 10px;">
                </p>
                <p>
                    <label for="aba_contact_hours" style="font-weight: 600; display: block; margin-bottom: 5px;">Office Hours:</label>
                    <input type="text" id="aba_contact_hours" name="aba_contact_hours" value="<?php echo esc_attr($hours); ?>" class="widefat" style="padding: 8px 10px;">
                </p>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

add_action('save_post_page', function($post_id): void {
    if (!isset($_POST['aba_page_meta_nonce']) || !wp_verify_nonce($_POST['aba_page_meta_nonce'], 'aba_save_page_meta_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    if (isset($_POST['aba_hero_eyebrow'])) {
        update_post_meta($post_id, '_aba_hero_eyebrow', sanitize_text_field($_POST['aba_hero_eyebrow']));
    }
    if (isset($_POST['aba_hero_title'])) {
        update_post_meta($post_id, '_aba_hero_title', sanitize_text_field($_POST['aba_hero_title']));
    }
    if (isset($_POST['aba_hero_subtitle'])) {
        update_post_meta($post_id, '_aba_hero_subtitle', sanitize_textarea_field($_POST['aba_hero_subtitle']));
    }
    if (isset($_POST['aba_hero_trust'])) {
        update_post_meta($post_id, '_aba_hero_trust', sanitize_text_field($_POST['aba_hero_trust']));
    }
    if (isset($_POST['aba_contact_phone'])) {
        update_post_meta($post_id, '_aba_contact_phone', sanitize_text_field($_POST['aba_contact_phone']));
    }
    if (isset($_POST['aba_contact_email'])) {
        update_post_meta($post_id, '_aba_contact_email', sanitize_email($_POST['aba_contact_email']));
    }
    if (isset($_POST['aba_contact_address'])) {
        update_post_meta($post_id, '_aba_contact_address', sanitize_text_field($_POST['aba_contact_address']));
    }
    if (isset($_POST['aba_contact_hours'])) {
        update_post_meta($post_id, '_aba_contact_hours', sanitize_text_field($_POST['aba_contact_hours']));
    }
});

/**
 * Automatically create all website pages and configure front page, permalinks & content in WordPress
 */
function aba_setup_pages_and_options(bool $force = false): void {
    if (!function_exists('wp_insert_post')) {
        return;
    }

    $c = aba_load_content();

    $pages = [
        'home' => [
            'title'    => 'Home',
            'slug'     => 'home',
            'template' => 'front-page.php',
            'meta'     => [
                '_aba_hero_eyebrow' => $c['hero']['eyebrow'] ?? 'COMPASSIONATE. PERSONALIZED. PURPOSEFUL.',
                '_aba_hero_title'   => $c['hero']['title'] ?? 'Helping children grow with confidence.',
                '_aba_hero_subtitle'=> $c['hero']['description'] ?? 'Individualized ABA therapy designed around your child, your family, and everyday life.',
                '_aba_btn_primary'  => $c['global_ctas']['primary'] ?? 'Book a Consultation',
                '_aba_btn_secondary'=> $c['global_ctas']['secondary'] ?? 'Explore Our Approach',
                '_aba_trust_text'   => $c['hero']['trust_text'] ?? 'Trusted by families across Mississauga and surrounding communities.',
            ],
            'content'  => "<h1>Helping children grow with confidence.</h1>\n\n<p>Individualized ABA therapy designed around your child, your family, and everyday life.</p>\n\n<h2>Compassionate, In-Home & Clinical ABA Therapy in Mississauga</h2>\n\n<p>Our evidence-based programs are customized for children with autism and developmental delays. We focus on communication, daily living skills, and joyful social interactions.</p>",
        ],
        'about' => [
            'title'    => 'About Us',
            'slug'     => 'about',
            'template' => 'page-about.php',
            'meta'     => [
                '_aba_hero_eyebrow'  => $c['pages']['about']['eyebrow'] ?? 'ABOUT ABA THERAPY MISSISSAUGA',
                '_aba_hero_title'    => $c['pages']['about']['title'] ?? 'Empowering children and families through compassionate care.',
                '_aba_hero_subtitle' => $c['pages']['about']['subtitle'] ?? 'We believe every child possesses unique strengths, boundless potential, and the ability to thrive when surrounded by understanding and evidence-based support.',
            ],
            'content'  => "<h1>Empowering children and families through compassionate care.</h1>\n\n<p>We believe every child possesses unique strengths, boundless potential, and the ability to thrive when surrounded by understanding and evidence-based support.</p>\n\n<h2>Our Story & Mission</h2>\n\n<p>Founded right here in Mississauga, our clinic was born from a simple belief: behavioral therapy should feel compassionate, joyful, and deeply personal. We recognized that families often faced impersonal, clinical environments that didn't reflect the warmth of real family life.</p>\n\n<p>Our multidisciplinary team of Board Certified Behavior Analysts (BCBAs) and dedicated therapists work in close partnership with parents. By integrating therapy into home, school, and community environments, we ensure that every skill your child learns is meaningful, functional, and enduring.</p>",
        ],
        'services' => [
            'title'    => 'Our Services',
            'slug'     => 'services',
            'template' => 'page-services.php',
            'meta'     => [
                '_aba_hero_eyebrow'  => $c['pages']['services']['eyebrow'] ?? 'COMPREHENSIVE SERVICES',
                '_aba_hero_title'    => $c['pages']['services']['title'] ?? 'Evidence-based support tailored to your child\'s world.',
                '_aba_hero_subtitle' => $c['pages']['services']['subtitle'] ?? 'Explore our full range of ABA therapy services designed to support communication, social connection, and daily living skills across every environment.',
            ],
            'content'  => "<h1>Evidence-based support tailored to your child's world.</h1>\n\n<p>Explore our full range of ABA therapy services designed to support communication, social connection, and daily living skills across every environment.</p>\n\n<h2>Our Clinical Services</h2>\n\n<ul>\n<li><strong>In-Home Therapy:</strong> One-on-one sessions in your home environment.</li>\n<li><strong>Parent Coaching:</strong> Empowering parents with evidence-based strategies.</li>\n<li><strong>Early Intervention:</strong> Intensive, play-based support for toddlers and preschoolers.</li>\n<li><strong>School & Daycare Support:</strong> Assisting successful transitions into group settings.</li>\n<li><strong>Verbal Support:</strong> Functional communication and speech-language integration.</li>\n<li><strong>Assessments:</strong> Comprehensive VB-MAPP, ABLLS-R, and functional behavior assessments.</li>\n</ul>",
        ],
        'our-approach' => [
            'title'    => 'Our Approach',
            'slug'     => 'our-approach',
            'template' => 'page-our-approach.php',
            'meta'     => [
                '_aba_hero_eyebrow'  => $c['pages']['our_approach']['eyebrow'] ?? 'OUR CLINICAL PHILOSOPHY',
                '_aba_hero_title'    => $c['pages']['our_approach']['title'] ?? 'Every child. Unique potential. Limitless possibilities.',
                '_aba_hero_subtitle' => $c['pages']['our_approach']['subtitle'] ?? 'Discover our child-centered, naturalistic methodology that turns science into everyday smiles and life-changing milestones.',
            ],
            'content'  => "<h1>Every child. Unique potential. Limitless possibilities.</h1>\n\n<p>Discover our child-centered, naturalistic methodology that turns science into everyday smiles and life-changing milestones.</p>\n\n<h2>Core Clinical Pillars</h2>\n\n<ul>\n<li><strong>Communication:</strong> Building expressive and receptive skills for everyday life.</li>\n<li><strong>Social Skills:</strong> Connecting, sharing, and building positive relationships.</li>\n<li><strong>Daily Living Skills:</strong> Supporting independence in routines and self-care.</li>\n</ul>",
        ],
        'resources' => [
            'title'    => 'Parent Resources',
            'slug'     => 'resources',
            'template' => 'page-resources.php',
            'meta'     => [
                '_aba_hero_eyebrow'  => $c['pages']['resources']['eyebrow'] ?? 'PARENT RESOURCE HUB',
                '_aba_hero_title'    => $c['pages']['resources']['title'] ?? 'Helpful information, guides & support for your family.',
                '_aba_hero_subtitle' => $c['pages']['resources']['subtitle'] ?? 'Access our curated checklists, funding guides, and expert articles designed to help Ontario families navigate autism and developmental care.',
            ],
            'content'  => "<h1>Helpful information, guides & support for your family.</h1>\n\n<p>Access our curated checklists, funding guides, and expert articles designed to help Ontario families navigate autism and developmental care.</p>\n\n<h2>Ontario Autism Program (OAP) & Funding Support</h2>\n\n<p>We assist families with OAP Childhood Budgets, Core Clinical Services, Special Services at Home (SSAH), and Disability Tax Credit (DTC) documentation.</p>",
        ],
        'contact' => [
            'title'    => 'Contact Us',
            'slug'     => 'contact',
            'template' => 'page-contact.php',
            'meta'     => [
                '_aba_hero_eyebrow'   => $c['pages']['contact']['eyebrow'] ?? 'LET\'S CONNECT',
                '_aba_hero_title'     => $c['pages']['contact']['title'] ?? 'Begin your child\'s journey with confidence.',
                '_aba_hero_subtitle'  => $c['pages']['contact']['subtitle'] ?? 'Reach out today to schedule a free, no-obligation consultation with our clinical team in Mississauga.',
                '_aba_contact_phone'  => $c['global_ctas']['phone_label'] ?? '(905) 123-4567',
                '_aba_contact_email'  => $c['footer']['contact']['email'] ?? 'info@aba-therapy-mississauga.ca',
                '_aba_contact_address'=> 'Mississauga, Ontario (Serving Peel & Halton Regions)',
                '_aba_contact_hours'  => 'Monday – Friday: 8:00 AM – 6:30 PM | Saturday: 9:00 AM – 2:00 PM',
            ],
            'content'  => "<h1>Begin your child's journey with confidence.</h1>\n\n<p>Reach out today to schedule a free, no-obligation consultation with our clinical team in Mississauga.</p>\n\n<h2>Office Information</h2>\n\n<p><strong>Phone:</strong> (905) 123-4567<br><strong>Email:</strong> info@aba-therapy-mississauga.ca<br><strong>Location:</strong> Mississauga, Ontario (Serving Peel & Halton Regions)<br><strong>Hours:</strong> Monday – Friday: 8:00 AM – 6:30 PM | Saturday: 9:00 AM – 2:00 PM</p>",
        ],
    ];

    $home_id = 0;

    foreach ($pages as $key => $p) {
        $existing = null;
        if (function_exists('get_page_by_path')) {
            $existing = get_page_by_path($p['slug']);
        }
        if (!$existing && function_exists('get_posts')) {
            $found = get_posts([
                'post_type'   => 'page',
                'name'        => $p['slug'],
                'post_status' => 'any',
                'numberposts' => 1,
            ]);
            if (!empty($found)) {
                $existing = $found[0];
            }
        }

        if (!$existing) {
            $page_id = wp_insert_post([
                'post_title'     => $p['title'],
                'post_name'      => $p['slug'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'post_content'   => $p['content'],
            ]);
            if ($page_id && !is_wp_error($page_id)) {
                if (!empty($p['template'])) {
                    update_post_meta($page_id, '_wp_page_template', $p['template']);
                }
                if (!empty($p['meta'])) {
                    foreach ($p['meta'] as $m_key => $m_val) {
                        update_post_meta($page_id, $m_key, $m_val);
                    }
                }
                if ($key === 'home') {
                    $home_id = $page_id;
                }
            }
        } else {
            $page_id = $existing->ID;
            if ($force || empty($existing->post_content)) {
                wp_update_post([
                    'ID'           => $page_id,
                    'post_content' => $p['content'],
                ]);
            }
            if (!empty($p['template'])) {
                update_post_meta($page_id, '_wp_page_template', $p['template']);
            }
            if (!empty($p['meta'])) {
                foreach ($p['meta'] as $m_key => $m_val) {
                    if ($force || !get_post_meta($page_id, $m_key, true)) {
                        update_post_meta($page_id, $m_key, $m_val);
                    }
                }
            }
            if ($key === 'home') {
                $home_id = $page_id;
            }
        }
    }

    // Assign Static Front Page to Home
    if ($home_id > 0) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    // Ensure clean permalinks (Post name /%postname%/)
    if (get_option('permalink_structure') !== '/%postname%/') {
        global $wp_rewrite;
        if (is_object($wp_rewrite)) {
            $wp_rewrite->set_permalink_structure('/%postname%/');
        } else {
            update_option('permalink_structure', '/%postname%/');
        }
    }

    if (function_exists('flush_rewrite_rules')) {
        flush_rewrite_rules();
    }

    update_option('aba_pages_auto_created', '1');
}

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

// JSON Content Loader (with Live WordPress Admin Customizations)
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

    // Merge any custom content saved from WordPress Admin Theme Options
    if (function_exists('get_option')) {
        $custom_content = get_option('aba_theme_custom_content');
        if (is_array($custom_content) && !empty($custom_content)) {
            $decoded = array_replace_recursive($decoded, $custom_content);
        }
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
    if (function_exists('get_the_ID') && get_the_ID()) {
        $meta_eyebrow = get_post_meta(get_the_ID(), '_aba_hero_eyebrow', true);
        $meta_title = get_post_meta(get_the_ID(), '_aba_hero_title', true);
        $meta_sub = get_post_meta(get_the_ID(), '_aba_hero_subtitle', true);
        if ($meta_eyebrow !== '' && $meta_eyebrow !== false) {
            $eyebrow = $meta_eyebrow;
        }
        if ($meta_title !== '' && $meta_title !== false) {
            $title = $meta_title;
        }
        if ($meta_sub !== '' && $meta_sub !== false) {
            $subtitle = $meta_sub;
        }
    }
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
