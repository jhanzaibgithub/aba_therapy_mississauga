# ABA Therapy Mississauga - WordPress Landing Page Theme

A lightweight, production-ready, custom JSON-driven WordPress landing page theme for **ABA Therapy Mississauga**. Built with pure PHP, vanilla CSS, and vanilla JS, matching the target landing page reference design pixel-for-pixel.

---

## Technical Highlights & Features

- **100% JSON-Driven Content**: All page copy, navigation items, button CTAs, phone numbers, emails, service descriptions, resource links, local service areas, testimonial quotes, FAQ questions/answers, and media asset mappings are stored in `content/aba-therapy-landing-page-content.json`.
- **Zero Page Builder Dependencies**: Lightweight implementation without Elementor, WPBakery, or Divi.
- **Fail-Safe JSON Loader**: Built-in PHP validation (`aba_load_content()`) that safely decodes content, escapes attributes and text, and displays developer-friendly diagnostics if JSON syntax errors occur.
- **Pixel-Perfect Visual Fidelity**: Recreates all organic blob shapes, curved process timeline, asymmetric service card mosaic, family-fit split hero block, resource cards, map card overlay, interactive FAQ accordion, and purple gradient final CTA.
- **Full Responsiveness & Accessibility**: Semantic HTML5, visible focus rings, keyboard-accessible FAQ accordions (`aria-expanded`), hamburger navigation for mobile screens, and `prefers-reduced-motion` support.

---

## Directory & File Overview

```
aba-therapy-mississauga/
├── assets/
│   ├── css/
│   │   └── landing.css         # Custom responsive stylesheet & CSS variables
│   ├── js/
│   │   └── landing.js          # Accordion, mobile nav, & scroll tracking JS
│   ├── logo.svg                # Brand logo vector asset
│   ├── hero-child-therapist.jpg
│   ├── approach-child-therapist.jpg
│   ├── family-fit-child-therapist.jpg
│   ├── service-in-home.jpg
│   ├── service-parent-coaching.jpg
│   ├── service-early-intervention.jpg
│   ├── service-school-support.jpg
│   ├── resource-understanding-aba.jpg
│   ├── resource-getting-started.jpg
│   ├── resource-funding.jpg
│   └── mississauga-map.jpg
├── content/
│   └── aba-therapy-landing-page-content.json   # SINGLE SOURCE OF TRUTH FOR ALL COPY
├── functions.php               # Theme setup, enqueues, JSON loader, & helper renderers
├── header.php                  # HTML head & meta tags
├── footer.php                  # Closing scripts & footer hooks
├── index.php                   # Theme entry wrapper
├── page-aba-therapy.php        # Custom Page Template ("ABA Therapy Landing Page")
├── style.css                   # WordPress Theme Header Metadata
└── README.md                   # Setup & Usage Documentation
```

---

## How to Install & Assign the Template in WordPress

1. **Upload Theme**:
   - Copy the `aba-therapy-mississauga` folder into your WordPress installation at:
     `wp-content/themes/aba-therapy-mississauga/`
2. **Activate Theme**:
   - Go to **WordPress Admin Dashboard → Appearance → Themes**.
   - Locate **ABA Therapy Mississauga** and click **Activate**.
3. **Assign Page Template** (Optional if using custom page):
   - Create or edit a page under **Pages → Add New** (e.g., "Home").
   - Under **Page Attributes → Template**, select **ABA Therapy Landing Page**.
   - Publish the page and set it as the Static Front Page under **Settings → Reading**.

---

## How to Edit Content & Assets

### 1. Updating Copy, Phone Numbers, & Links
All text content lives inside:
`content/aba-therapy-landing-page-content.json`

- **Phone Number**: Edit `"phone_label"` and `"phone_href"` under `"global_ctas"`, `"final_cta"`, and `"footer"`.
- **Navigation Links**: Edit the array under `"navigation"`.
- **FAQ Questions & Answers**: Add or modify items in the `"faq" -> "items"` array.
- **Service & Resource Details**: Update `"services"` or `"resources"` arrays directly.

> **Note**: Changes to the JSON file will immediately reflect on the front-end without editing any PHP or template files.

### 2. Changing Images & Logos
- Place new image files into the `assets/` directory.
- Update the relative path inside `content/aba-therapy-landing-page-content.json` under `"media" -> "assets"`:
  ```json
  "media": {
    "assets": {
      "logo": "assets/logo.svg",
      "hero_image": "assets/hero-child-therapist.jpg",
      "approach_image": "assets/approach-child-therapist.jpg"
    }
  }
  ```

### 3. Customizing Colors & Fonts
Colors and typography are centralized in `assets/css/landing.css` as CSS custom properties:
```css
:root {
  --purple: #59209b;
  --green: #a7ce19;
  --lime: #b8dc22;
  --yellow: #ffc929;
  --orange: #ff9e1b;
  --teal: #09a6ad;
  --blue: #187ab9;
  --pink: #d92d73;
  --text-dark: #251642;
  --text-muted: #625b6c;
  --background: #fffdfa;
  --serif: "Playfair Display", Georgia, serif;
  --sans: "DM Sans", Arial, sans-serif;
}
```

---

## Verification & QA Checklist

- [x] All copy dynamically renders from `content/aba-therapy-landing-page-content.json`.
- [x] Header nav, active state indicator, and mobile hamburger drawer functional.
- [x] Hero grid with organic image blob, purple/lime blobs, heart doodle, and floating support card.
- [x] Our Approach section with photo blobs, 3 numbered pillars, and 4 benefit strip items.
- [x] Asymmetric Services mosaic layout with category icons and photo crops.
- [x] Full-width Family Fit section with purple split background and high-five photo visual.
- [x] Connected curved process line connecting 4 step cards.
- [x] 3 Resource cards with curved corner photo crops.
- [x] Local area section with 6 Mississauga regions, testimonial box with 5 stars, and map visual overlay card.
- [x] 2-column FAQ grid with animated plus icons and accessible drawers (`aria-expanded`).
- [x] Final purple gradient CTA card with star confetti accents.
- [x] Footer with brand block, quick links, services, contact info, and legal bar.
- [x] Zero PHP errors, zero console errors, clean performance, and responsive layout across mobile/desktop.
