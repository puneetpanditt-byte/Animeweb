---
name: Obsidian Protocol
colors:
  surface: '#131314'
  surface-dim: '#131314'
  surface-bright: '#3a393a'
  surface-container-lowest: '#0e0e0f'
  surface-container-low: '#1c1b1c'
  surface-container: '#201f20'
  surface-container-high: '#2a2a2b'
  surface-container-highest: '#353436'
  on-surface: '#e5e2e3'
  on-surface-variant: '#e9bcb9'
  inverse-surface: '#e5e2e3'
  inverse-on-surface: '#313031'
  outline: '#b08784'
  outline-variant: '#5f3e3d'
  surface-tint: '#ffb3af'
  primary: '#ffb3af'
  on-primary: '#68000e'
  primary-container: '#ff5357'
  on-primary-container: '#5c000b'
  inverse-primary: '#bf0024'
  secondary: '#d3fbff'
  on-secondary: '#00363a'
  secondary-container: '#00eefc'
  on-secondary-container: '#00686f'
  tertiary: '#ebb2ff'
  on-tertiary: '#520071'
  tertiary-container: '#ce5dff'
  on-tertiary-container: '#480064'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#ffdad8'
  primary-fixed-dim: '#ffb3af'
  on-primary-fixed: '#410006'
  on-primary-fixed-variant: '#930019'
  secondary-fixed: '#7df4ff'
  secondary-fixed-dim: '#00dbe9'
  on-secondary-fixed: '#002022'
  on-secondary-fixed-variant: '#004f54'
  tertiary-fixed: '#f8d8ff'
  tertiary-fixed-dim: '#ebb2ff'
  on-tertiary-fixed: '#320047'
  on-tertiary-fixed-variant: '#74009f'
  background: '#131314'
  on-background: '#e5e2e3'
  surface-variant: '#353436'
typography:
  display-xl:
    fontFamily: Space Grotesk
    fontSize: 72px
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.04em
  headline-lg:
    fontFamily: Space Grotesk
    fontSize: 48px
    fontWeight: '700'
    lineHeight: '1.2'
  headline-lg-mobile:
    fontFamily: Space Grotesk
    fontSize: 32px
    fontWeight: '700'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Space Grotesk
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-mono:
    fontFamily: Space Mono
    fontSize: 12px
    fontWeight: '500'
    lineHeight: '1.0'
    letterSpacing: 0.1em
spacing:
  base: 4px
  unit-1: 4px
  unit-2: 8px
  unit-4: 16px
  unit-8: 32px
  unit-12: 48px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 64px
  max-width: 1440px
---

## Brand & Style

The design system is engineered to evoke the high-stakes, high-energy atmosphere of a premium cyberpunk anime. It prioritizes a "Cinematic Tech" aesthetic, blending the grit of a dystopian future with the polished, supernatural vibrance of top-tier animation production. 

The target audience is the "digital vanguard"—enthusiasts of high-end streetwear, collectible tech, and niche anime culture who demand an interface that feels like an artifact from their favorite series. The emotional response is one of adrenaline, exclusivity, and technological superiority. 

The visual style is a hybrid of **Glassmorphism** and **High-Contrast Bold**. It utilizes deep obsidian layers to provide a canvas for hyper-vibrant neon accents. Visual interest is maintained through technical "HUD" (Heads-Up Display) elements, including floating particle fields and scanline textures that give the UI a sense of living energy.

## Colors

The palette is anchored in **Obsidian Black (#0A0A0B)** to provide maximum depth and cinematic contrast. This dark void allows the neon accents to "bleed" light into the UI through glows and gradients.

- **Electric Red (#FF0033):** The primary action color, used for critical CTAs and high-energy states. It represents power and urgency.
- **Cyan Glow (#00F0FF):** Used for data visualization, technical details, and secondary interactive elements. It provides a cool, digital balance to the heat of the red.
- **Cyber Purple (#BC00FF):** An editorial accent used for rare product tiers, badges, and high-fidelity transitions.

The "Glow" variables are critical for border-radius illumination and drop shadows, ensuring the UI feels like a light-emitting display rather than a flat surface.

## Typography

This design system uses a strategic hierarchy to balance high-energy display with e-commerce utility:

1.  **Space Grotesk (Headlines):** A futuristic, geometric sans-serif that captures a technical, avant-garde spirit. It should be used for large headings and price displays.
2.  **Inter (Body):** Selected for its exceptional legibility at small sizes. All product descriptions, checkout flows, and long-form text utilize Inter to reduce cognitive load during transactions.
3.  **Space Mono (Labels/Technical):** Used for SKU numbers, metadata, and "system status" messages. This reinforces the futuristic HUD aesthetic.

Headlines should occasionally use `italic` or `uppercase` styling to mimic the dynamic motion lines found in anime action sequences.

## Layout & Spacing

The design system employs a **12-column fluid grid** for desktop and a **4-column grid** for mobile. The spacing rhythm is strictly based on a **4px base unit** to maintain a sharp, technical alignment reminiscent of blueprints.

- **Desktop:** 64px side margins with 24px gutters. Large, cinematic product photography should often break the grid or span full-bleed to increase the "high-energy" feel.
- **Mobile:** 16px side margins with 16px gutters. Elements are stacked vertically, utilizing height to showcase immersive product imagery.
- **Containers:** Content is housed in "Glassmorphism" panels. These panels use internal padding of `unit-8` (32px) to ensure breathing room against vibrant neon borders.

## Elevation & Depth

In this design system, depth is achieved through **light emission** rather than traditional physical shadows.

1.  **Backdrop Layers:** The primary background is a solid `#050505`.
2.  **Glassmorphism (Tier 1):** Primary containers use a semi-transparent `#121214` with a 20px background blur. Borders are 1px thick with a 30% opacity of the primary accent color.
3.  **Active Elevation (Tier 2):** When an element is focused or hovered, it emits a "Neon Glow." This is achieved using a multi-layered box-shadow with the primary color, creating a bloom effect that simulates light hitting a camera lens.
4.  **Floating Particles:** Backgrounds should feature subtle, slow-moving particles (CSS or JS-driven) to create an atmospheric sense of "ash" or "digital dust," adding a layer of depth behind the UI.

## Shapes

To maintain a "Cyberpunk" and "Sharp" aesthetic, the design system utilizes **0px roundedness (Sharp corners)** for all primary interactive elements.

- **Buttons & Inputs:** Must have 90-degree angles. To add a "tech" detail, primary buttons should feature a **diagonal clipped corner** (4px bevel) on the top-right and bottom-left.
- **Cards:** Sharp corners with 1px neon stroke.
- **Iconography:** Icons should be stroke-based, with sharp terminals and geometric construction. Avoid rounded corners in icon sets; prioritize angularity.

## Components

### Buttons
Primary buttons are solid `#FF0033` with white text. They feature a high-intensity red glow on hover. Secondary buttons are transparent with a 1px `#00F0FF` border and a subtle scanline pattern overlay.

### Input Fields
Fields are dark, semi-transparent rectangles with a bottom-only border of `#00F0FF`. On focus, the border expands to a full frame with a glowing effect. Labels use the `label-mono` typography.

### Cards (Product)
Cards utilize the glassmorphism style. The product image is the focal point, often featuring a slight "zoom" animation on hover. Prices are displayed in `Space Grotesk` with a subtle outer glow in the primary color.

### Chips & Badges
Small, sharp rectangles with a solid background of `#BC00FF` for "Rare" or "Limited" items. Text is always uppercase `Space Mono`.

### Progress Bars / HUD Elements
Loading states and health-bar-style progress indicators use "stepped" segments rather than a continuous line, reinforcing the retro-futuristic digital feel.