=== Three Columns ===
Requires at least: 6.3
Requires PHP: 7.4
Stable tag: 1.0.9
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A text-first three-column Classic Theme with persistent Navigation, Document, and Context rails.

== Description ==

Three Columns is a WordPress Classic Theme for text-first personal publishing. Its visual system preserves three persistent roles across desktop and mobile: Navigation, Publication/Document, and Context.

The desktop geometry uses a 1440px shell with a 260px left rail, 760px main column, 300px right rail, 30px gutters, and a 680px reading core. Mobile preserves the same relationship through reveal/off-canvas rails rather than collapsing into a generic one-column layout.

The theme uses WordPress-native posts, pages, categories, tags, sticky posts, featured images, menus, comments, search, archives, pagination, Customizer settings, and Widget Areas. It does not create custom post types, SEO metadata, newsletter processing, analytics, sharing services, or other plugin territory.

== Installation ==

1. Upload the `three-columns` folder to `/wp-content/themes/`, or install the ZIP through Appearance > Themes > Add New > Upload Theme.
2. Activate Three Columns.
3. Assign a menu to Primary Navigation.
4. Add Widgets to Left Sidebar, Right Sidebar, and Footer 1-4 as needed.
5. Use Appearance > Customize to edit header identity text, footer colophon, and homepage category sources.
6. For the designed publication homepage, set a static front page under Settings > Reading. If "Your latest posts" is selected, the front page correctly uses the standard posts index.

== Frequently Asked Questions ==

= Can I change the blue accent color? =

The accent is intentionally fixed at `#1467ff` because it is part of the approved visual system and meets the theme's contrast target. A child theme can override the CSS custom property if a site deliberately needs a different palette.

= Where are social sharing buttons? =

Sharing is plugin territory and is deliberately not implemented by the theme. A sharing plugin can add that functionality without tying it to a theme switch.

= Does the theme require a page builder? =

No. The homepage composition is intentionally fixed. Content sources are selected from normal WordPress categories, while sidebars and the footer use native Widget Areas.

== Changelog ==

= 1.0.9 =
* Fixes the mobile header menu disclosure selector so the opened navigation is visible.

= 1.0.8 =
* Fixes a duplicate body-class callback that caused a fatal error after the 1.0.7 masthead update.

= 1.0.7 =
* Adds a flat masthead with desktop primary navigation and a mobile menu disclosure.
* Keeps the existing off-canvas Menu and Context toolbar below the mobile masthead.
* Removes duplicate desktop navigation while preserving the mobile left-rail menu.
* Aligns mobile rail and mask offsets with the masthead plus toolbar height.

= 1.0.6 =
* Aligns the compact 1024–1289px header rule with the centered left/main content axis so its separator does not drift beyond the left rail as the viewport grows.

= 1.0.5 =
* Aligns responsive spacing with the Tatami-derived production specification from 320px through 1440px and prevents the 1260–1439px fixed-grid overflow.
* Keeps the title above the date in Recent Essays and Recent Reviews at every width.
* Keeps the 1024–1289px footer aligned to the page's left/main axis and omits an empty Footer 4 column.
* Enlarges carousel control hit areas and normalizes WordPress content/widget edge spacing.

= 1.0.4 =
* Keeps the reference media proportions visible with category-aware inline SVG placeholders until real featured images are assigned.
* Gives single posts a full-width article hero fallback instead of removing the hero frame when no thumbnail exists.

= 1.0.3 =
* Restores an explicit keyboard focus indicator for search fields.
* Offsets fixed/sticky rails with WordPress Core's admin-bar height token.
* Extends editor styles to the WordPress 7.x iframe Block Editor while preserving Classic Editor support.
* Documents retained editorial utility classes from the approved HTML reference.
* Adds layout-aware `sizes` hints to theme-rendered responsive images.
* Consolidates the remaining duplicate mobile heading rule without changing normal rendering.
* Keeps WordPress.org identity/runtime claims out of release metadata until they can be verified.

= 1.0.2 =
* Preserves the selected static front page content and comments while retaining the fixed publication index.
* Adds a dedicated attachment template and a zero-post homepage empty state.
* Improves off-canvas keyboard and assistive-technology isolation.
* Stops reading-time disclosure on password-protected posts and prevents automatic TOC ID collisions.
* Supports unlimited menu depth and common block-based Widgets.
* Uses the site's localized date format for Notes.
* Consolidates CSS tokens, repeated responsive rules, media rules, and release patches without changing the approved reference layout.

= 1.0.1 =
* Respects both WordPress Front Page Reading Settings modes.
* Adds conditional Core `comment-reply` support for threaded comments.
* Completes translation packaging and WordPress.org release metadata.
* Improves child-theme stylesheet loading, content edge-case styles, long-title wrapping, and mobile colophon behavior.
* Removes built-in social sharing functionality so sharing remains plugin territory.

= 1.0.0 =
* Initial release.


== WordPress.org release gates ==

This package is usable as a normal WordPress theme, but it deliberately does not claim WordPress.org directory submission metadata that cannot be verified in this build environment. Before a WordPress.org submission, add a `Contributors:` line containing the real WordPress.org username of the submitter, then run this exact release on a real WordPress 7.1 runtime with Theme Check and the Theme Unit Test data. Only after that verification should a `Tested up to: 7.1` field be restored.

== Copyright ==

Three Columns WordPress Theme, Copyright 2026 Three Columns Contributors.
Three Columns is distributed under the terms of the GNU General Public License v2 or later.

== Resources ==

Three Columns bundles no third-party fonts, JavaScript libraries, CSS frameworks, stock photography, or icon packs.
The theme screenshot and CSS artwork/placeholder treatments are original theme assets and are distributed under the same GPL-2.0-or-later license as the theme.
