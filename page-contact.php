<?php
/* Template Name: Contact Us */
if (!defined('ABSPATH')) { exit; }

$c = aba_load_content();
get_header();

$contact = $c['pages']['contact'] ?? [];
$phone = $c['global_ctas']['phone_href'] ?? 'tel:+19051234567';
$phone_display = $c['global_ctas']['phone_label'] ?? '(905) 123-4567';
$email = $c['footer']['contact']['email'] ?? 'info@aba-therapy-mississauga.ca';

$breadcrumbs = [
    ['label' => 'Home', 'href' => aba_page_url('home')],
    ['label' => 'Contact Us', 'href' => '']
];
?>

<?php 
aba_render_page_hero(
    $contact['eyebrow'] ?? "LET'S CONNECT",
    $contact['title'] ?? "Begin your child's journey with confidence.",
    $contact['subtitle'] ?? "Reach out today to schedule a free, no-obligation consultation with our clinical team in Mississauga.",
    $breadcrumbs
); 
?>

<!-- CONTACT SPLIT SECTION -->
<section class="section">
  <div class="container contact-split-grid">
    <!-- LEFT: CONTACT DETAILS & CLINIC INFO -->
    <div class="contact-info-col reveal-slide-left">
      <p class="eyebrow">DIRECT CONTACT</p>
      <h2>We're here to answer every question.</h2>
      <span class="scribble" aria-hidden="true"></span>
      <p class="lede">
        Whether you are newly exploring ABA therapy, transferring from another provider, or preparing your OAP funding application, our friendly clinical team is here to support you.
      </p>

      <div class="contact-card-list">
        <div class="contact-info-card">
          <span class="icon purple" aria-hidden="true">📍</span>
          <div>
            <strong>Location &amp; Service Coverage</strong>
            <p>Mississauga, Ontario</p>
            <small style="color: var(--text-muted); display: block; margin-top: 4px;">Serving Peel Region (Mississauga, Brampton) &amp; Halton Region (Oakville, Milton, Etobicoke)</small>
          </div>
        </div>

        <div class="contact-info-card">
          <span class="icon teal" aria-hidden="true">☎</span>
          <div>
            <strong>Telephone</strong>
            <p><a href="<?php echo esc_url($phone); ?>" style="color: var(--purple-dark); font-weight: 700; text-decoration: none;"><?php echo esc_html($phone_display); ?></a></p>
            <small style="color: var(--text-muted); display: block; margin-top: 4px;">Direct line to our intake coordination team</small>
          </div>
        </div>

        <div class="contact-info-card">
          <span class="icon lime" aria-hidden="true">✉</span>
          <div>
            <strong>Email Address</strong>
            <p><a href="mailto:<?php echo esc_attr(antispambot($email)); ?>" style="color: var(--purple-dark); font-weight: 700; text-decoration: none;"><?php echo esc_html(antispambot($email)); ?></a></p>
            <small style="color: var(--text-muted); display: block; margin-top: 4px;">Prompt response within 24 business hours</small>
          </div>
        </div>

        <div class="contact-info-card">
          <span class="icon orange" aria-hidden="true">⏰</span>
          <div>
            <strong>Hours of Operation</strong>
            <p>Monday – Friday: 8:00 AM – 6:30 PM</p>
            <p>Saturday: 9:00 AM – 2:00 PM</p>
          </div>
        </div>
      </div>

      <!-- REASSURANCE BADGES -->
      <div class="reassurance-box reveal-fade-up">
        <span class="badge-icon" aria-hidden="true">✓</span>
        <div>
          <strong>Zero Long Waitlists</strong>
          <p>Initial intake calls scheduled within 48 hours of contact.</p>
        </div>
      </div>
    </div>

    <!-- RIGHT: INTERACTIVE CONSULTATION FORM -->
    <div class="contact-form-col reveal-slide-right">
      <div class="consult-form-wrap">
        <div class="form-header">
          <h3>Request a Free Consultation</h3>
          <p>Fill out the short form below and our clinical coordinator will reach out promptly.</p>
        </div>

        <form class="consult-form" id="consultation-form" action="#contact-success" method="POST">
          <div class="form-row">
            <div class="form-group">
              <label for="parent_name">Parent / Guardian Name *</label>
              <input type="text" id="parent_name" name="parent_name" required placeholder="e.g. Sarah Jenkins">
            </div>
            <div class="form-group">
              <label for="phone_number">Phone Number *</label>
              <input type="tel" id="phone_number" name="phone_number" required placeholder="(905) 555-0123">
            </div>
          </div>

          <div class="form-group">
            <label for="email_address">Email Address *</label>
            <input type="email" id="email_address" name="email_address" required placeholder="you@example.com">
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="child_age">Child's Age Range</label>
              <select id="child_age" name="child_age">
                <option value="">Select age range...</option>
                <option value="18m-3y">18 months – 3 years (Early Intervention)</option>
                <option value="4y-6y">4 – 6 years (Preschool / Kindergarten)</option>
                <option value="7y-10y">7 – 10 years (Elementary School)</option>
                <option value="11y-14y">11 – 14 years (Middle School)</option>
                <option value="15y+">15+ years (Youth / Transition)</option>
              </select>
            </div>

            <div class="form-group">
              <label for="service_interest">Service of Interest</label>
              <select id="service_interest" name="service_interest">
                <option value="in-home-therapy">In-Home ABA Therapy</option>
                <option value="parent-coaching">Parent Coaching &amp; Training</option>
                <option value="early-intervention">Early Intervention ABA</option>
                <option value="school-support">School &amp; Daycare Support</option>
                <option value="verbal-support">Verbal &amp; Communication Support</option>
                <option value="assessments">Comprehensive Assessment (VB-MAPP / FBA)</option>
                <option value="not-sure">Not sure yet / General inquiry</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="message_text">How can we help your child? (Optional)</label>
            <textarea id="message_text" name="message_text" rows="4" placeholder="Tell us about your child's strengths, communication style, or goals..."></textarea>
          </div>

          <button type="submit" class="button button--primary form-submit-btn">
            <span>Submit Consultation Request</span>
            <span aria-hidden="true">→</span>
          </button>

          <p class="form-privacy-note">
            <span aria-hidden="true">🔒</span>
            Your personal information is strictly confidential and protected under Canadian privacy (PHIPA) guidelines.
          </p>

          <div class="form-feedback" id="form-feedback" hidden></div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- LOCATION MAP SECTION -->
<section class="section soft" style="padding-top: 40px;">
  <div class="container">
    <div class="centered reveal-fade-up" style="margin-bottom: 35px;">
      <p class="eyebrow">OUR SERVICE REGION</p>
      <h2>Proudly serving Mississauga and nearby communities.</h2>
      <span class="scribble" aria-hidden="true" style="margin-inline: auto;"></span>
    </div>

    <div class="map-wrap reveal-fade-up" style="height: 420px; border-radius: 28px; box-shadow: 0 15px 40px rgba(54, 28, 75, 0.08);">
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
          <small>In-home, school &amp; community therapy close to home.</small>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
