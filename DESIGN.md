---
name: Tafsela Luxury
colors:
  surface: '#fff8f5'
  surface-dim: '#e1d8d3'
  surface-bright: '#fff8f5'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#fbf2ec'
  surface-container: '#f6ece6'
  surface-container-high: '#f0e6e1'
  surface-container-highest: '#eae1db'
  on-surface: '#1f1b17'
  on-surface-variant: '#50453b'
  inverse-surface: '#34302c'
  inverse-on-surface: '#f9efe9'
  outline: '#82756a'
  outline-variant: '#d4c4b7'
  surface-tint: '#7c5730'
  primary: '#79542e'
  on-primary: '#ffffff'
  primary-container: '#956c44'
  on-primary-container: '#fffbff'
  inverse-primary: '#eebd8e'
  secondary: '#5f5e5e'
  on-secondary: '#ffffff'
  secondary-container: '#e2dfde'
  on-secondary-container: '#636262'
  tertiary: '#396173'
  on-tertiary: '#ffffff'
  tertiary-container: '#527a8c'
  on-tertiary-container: '#fbfdff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffdcbd'
  primary-fixed-dim: '#eebd8e'
  on-primary-fixed: '#2c1600'
  on-primary-fixed-variant: '#61401b'
  secondary-fixed: '#e5e2e1'
  secondary-fixed-dim: '#c8c6c5'
  on-secondary-fixed: '#1c1b1b'
  on-secondary-fixed-variant: '#474746'
  tertiary-fixed: '#bfe9fe'
  tertiary-fixed-dim: '#a3cce1'
  on-tertiary-fixed: '#001f2a'
  on-tertiary-fixed-variant: '#224c5d'
  background: '#fff8f5'
  on-background: '#1f1b17'
  surface-variant: '#eae1db'
typography:
  display-xl:
    fontFamily: Almarai
    fontSize: 80px
    fontWeight: '800'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Almarai
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
  nav-link:
    fontFamily: IBM Plex Sans Arabic
    fontSize: 12px
    fontWeight: '700'
    letterSpacing: 0.15em
  product-title:
    fontFamily: IBM Plex Sans Arabic
    fontSize: 18px
    fontWeight: '700'
    lineHeight: '1.4'
  price-primary:
    fontFamily: IBM Plex Sans Arabic
    fontSize: 20px
    fontWeight: '700'
  micro-label:
    fontFamily: IBM Plex Sans Arabic
    fontSize: 10px
    fontWeight: '800'
    letterSpacing: 0.3em
spacing:
  container-max: 1280px
  section-padding: 8rem
  gutter-base: 2rem
  stack-sm: 0.5rem
  stack-md: 1.5rem
  stack-lg: 3rem
---

## Brand & Style
The brand identity is rooted in **Modern Minimalism with a Mediterranean Luxury** twist. It targets a sophisticated audience that values "Tafsela" (the detail) in fashion—balancing traditional Arabic hospitality with contemporary European editorial aesthetics. 

The UI evokes a sense of high-end boutique shopping: calm, spacious, and authoritative. It utilizes a "White Space as Luxury" philosophy, where generous margins and high-contrast typography allow product photography to serve as the primary emotional driver. The style is strictly professional and refined, avoiding unnecessary ornamentation in favor of crisp lines and intentional color accents.

## Colors
The palette is built on a foundation of **Earth & Charcoal**. 

- **Primary (#A67C52):** A muted, sophisticated gold/camel tone used for calls to action, highlights, and brand reinforcement. It suggests quality leather and natural fibers.
- **Neutral Charcoal (#1A1A1A):** Used for primary text and high-contrast buttons, providing a grounded, architectural feel.
- **Background Tones:** The system uses a "warm white" (#FDFCFB) and a "neutral beige" (#F7F3F0) to soften the interface compared to a cold, sterile white.
- **Semantic Accents:** Limited use of overlays (95% opacity) for headers to maintain context during scrolling.

## Typography
The system uses a bilingual typographic scale that prioritizes clarity and "editorial" weight. 

- **Display & Headlines:** Use **Almarai** for its geometric, modern Arabic letterforms that mirror the cleanliness of sans-serif Latin faces. Large sizes and heavy weights (Extra Bold) are used to create a strong visual hierarchy.
- **Body & Interface:** **IBM Plex Sans Arabic** (mapped to Work Sans for Latin) provides a technical yet humanistic feel, essential for legibility in product descriptions and navigation.
- **Tracking:** Wide letter-spacing (0.2em to 0.4em) is applied to micro-labels and buttons to create a "luxury label" aesthetic.

## Layout & Spacing
The layout follows a **Fixed Grid with Fluid Sections**. 

- **Margins:** A generous container margin (up to 12% on ultra-wide screens) ensures content remains centered and focused.
- **Rhythm:** Section vertical spacing is aggressive (32px to 128px) to emphasize the "exclusive" nature of the content. 
- **Grids:** Product grids use a standard 12-column logic, typically breaking into 3 or 4 columns on desktop with 48px gutters to give products "room to breathe."
- **RTL Support:** The layout is designed natively for Right-to-Left, with iconography and directional flow mirrored accordingly.

## Elevation & Depth
Depth is achieved through **Surface Stacking** and **Subtle Shadows** rather than heavy gradients.

- **Layer 0 (Base):** Neutral-Beige or Background-Light.
- **Layer 1 (Cards/Floating):** Surface-White with a "Product Card Shadow"—an ultra-diffused, low-opacity shadow (0 20px 40px -15px rgba(0,0,0,0.08)) that only appears or intensifies on hover.
- **Layer 2 (Overlays):** Sticky headers use a 95% opacity blur (backdrop-filter: blur(12px)) to create a sense of glass-like transparency without losing the minimalist structure.
- **Interactions:** Buttons use "Elevation on Hover," shifting from flat to slightly shadowed or changing background colors via 0.4s cubic-bezier transitions.

## Shapes
The shape language is **Strictly Linear**. 

- **Corners:** 0px radius (Sharp) for all primary containers, buttons, input fields, and product images. This reinforces a high-fashion, architectural aesthetic.
- **Exceptions:** Circular shapes (9999px) are reserved exclusively for utility indicators like notification badges, count icons, or social media circles to provide a point of contrast against the rigid grid.

## Components

- **Buttons:** Primary buttons are rectangular, sharp-edged, and use high-contrast color fills (Primary Gold or Charcoal). They feature a `0.3em` letter-spacing and 20px vertical padding.
- **Input Fields:** Minimalist "Underline" or "Boxed-Flat" styles. Search bars use a subtle gray background (#F9FAFB) with no border-radius.
- **Product Cards:** Aspect ratio is strictly `4:5` or `3:4`. Labels (e.g., "New") are placed in the top-right corner as sharp-edged rectangles. Add-to-cart actions should be hidden until hover, sliding up from the bottom.
- **Badges:** Small, rectangular tags with heavy tracking. Background color matches the primary brand gold.
- **Navigation:** Top-level nav is centered, uppercase, with a 2px bottom-border active state. Icons should be "Material Symbols Outlined" with a 1px stroke weight to maintain the light, airy feel.
- **Newsletter Form:** A combination of a flush input and button to create a single cohesive horizontal unit.