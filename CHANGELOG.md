# Changelog

## 1.0.6

- Aligns the compact 1024–1289px header separator with the centered left/main content axis so it does not drift beyond the left rail as the viewport grows.

## 1.0.5

- Aligns responsive spacing with the Tatami-derived production specification from 320px through 1440px.
- Uses proportional full-column tracks from 1290px and exact 1440px tracks at standard desktop, removing the fixed-grid overflow window.
- Smooths the 480–767px shell gutter and keeps the Recent Essays / Recent Reviews title-date order consistent at every width.
- Keeps the 1024–1289px Footer aligned to the left/main page axis and omits an empty Footer 4 column.
- Enlarges carousel control hit areas and normalizes WordPress content/widget edge spacing.

## 1.0.4

- Adds category-aware inline SVG media placeholders derived from the approved reference artwork language.
- Preserves the single-post full-width hero frame when a post has no featured image.

## 1.0.3

- Restored visible keyboard focus for search fields.
- Added WordPress admin-bar offsets for fixed/sticky rails.
- Extended editor styles to the iframe Block Editor.
- Documented retained editorial utility classes.
- Added layout-aware responsive-image `sizes` hints.
- Consolidated the final duplicate mobile CSS rule.
- Removed unverified WordPress.org contributor/runtime claims from package metadata.

## 1.0.2 — 2026-09-15

- Preserves selected static front page content, multipage content, and page comments alongside the fixed publication index.
- Adds a dedicated attachment document template rather than routing media attachments through post-only related/navigation semantics.
- Makes off-canvas rails inaccessible to keyboard and assistive technology while visually hidden and isolates the content canvas while a rail is open.
- Adds a zero-post homepage empty state and removes the Primary Menu depth cap.
- Adds explicit styling for common block-based Widgets.
- Uses the site's localized date format for Notes.
- Prevents reading-time disclosure for password-protected posts.
- Prevents generated table-of-contents IDs from colliding with existing document IDs.
- Consolidates CSS roots, media rules, duplicated compact-header responsive rules, and repeated mobile queries without changing the approved visual geometry.
- Removes unused CSS color tokens while retaining prototype-derived component selectors that are still part of the approved reference system.

## 1.0.1 — 2026-09-15

- Respects both WordPress Front Page Reading Settings modes: latest posts and a static front page.
- Conditionally loads Core `comment-reply` when threaded comments are enabled.
- Completes translation packaging with `languages/three-columns.pot`.
- Adds WordPress.org `readme.txt`, Tested up to 7.1 metadata, copyright, and resource declarations.
- Removes theme-owned social sharing so sharing remains plugin territory.
- Explicitly loads parent CSS before an optional child theme stylesheet.
- Falls back to recent posts if a configured homepage category has been deleted.
- Hides the mobile Context control when the current request has no right-rail content.
- Adds Theme Unit Test edge styles for core state classes, H4-H6, definition lists, address, hr, kbd, sub/sup, and other long-tail markup.
- Hardens long titles/site names and allows the mobile colophon to wrap safely.
- Fixes the visual accent at the approved `#1467ff` rather than exposing an unrestricted color picker.

## 1.0.0 — 2026-09-15

- Initial release of the Three Columns WordPress Classic Theme.
- Reproduces the approved three-column home and single-post visual system.
- Adds one Primary Menu, Left Sidebar, Right Sidebar, and four Footer widget areas.
- Adds fixed editorial homepage with configurable category sources and Sticky-post Featured fallback.
- Adds article context rail, automatic H2/H3 table of contents, Previous/Next navigation, and bounded related posts.
- Adds Classic Editor styling, responsive off-canvas rails, reduced-motion support, native archives/search/404/comments/pagination.
- Adds sanitized Customizer options, bounded queries, enqueued assets, static security checks, and visual-invariant tests.
