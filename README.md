# Three Columns

Three Columns is a **WordPress Classic Theme** for text-first personal publishing. Its visual system is built around three persistent roles: Navigation, Publication/Document, and Context. The desktop geometry follows a 1440px shell with 260px left rail, 760px main column, 300px right rail, 30px gutters, and a 680px reading core. Mobile keeps the same spatial relationship through reveal/off-canvas rails rather than collapsing the site into a generic one-column theme.

## Requirements

- WordPress 6.3 or later.
- PHP 7.4 or later.
- Classic Editor is supported; the theme includes an editor stylesheet for the reading column.
- No front-end framework, webfont, jQuery, or build step is required.

## WordPress-native structure

The theme remains a presentation layer for WordPress-managed content. It registers one Primary Menu, a Left Sidebar, a Right Sidebar, and four footer widgets areas. Header identity settings, footer colophon, and homepage category sources are configured through the Customizer. The flat masthead currently renders the site name and WordPress primary menu; the legacy statement/meta settings remain stored for compatibility but are intentionally not displayed in the compact masthead. The fixed accent `#1467ff` is part of the approved visual source of truth rather than a free-form theme option. Posts, pages, categories, tags, sticky posts, featured images, comments, search, archives, and pagination use WordPress core data and APIs.

The fixed homepage composition is intentionally not a page builder. Its visual order remains Hero → Featured → Recent Essays → Recent Reviews → Series → Selected Notes → Selected Publications. Administrators choose category sources for the content sections; when no category is chosen, bounded recent-post queries provide fallback content. Featured prefers a WordPress Sticky post.

## Theme boundaries

Functionality that should survive a theme switch belongs in a **plugin**, not in Three Columns. Newsletter delivery, form processing, analytics, custom post types, SEO metadata, social sharing, external APIs, and business logic are therefore deliberately outside the theme. Sharing belongs in a plugin so it survives a theme switch. The theme can visually style compatible widget/plugin output without owning that data.

## Visual and engineering principles

The approved HTML references are the visual source of truth. Their core CSS geometry, typography, rules, responsive behavior, 3:2 landscape media and 5:8 portrait media are preserved. Theme integration adds only the styles required for native WordPress markup. Assets are enqueued through WordPress; stored settings are sanitized and rendered output is escaped. Custom queries are bounded and reset after use.

## License

Three Columns is licensed under the GNU General Public License, version 2 or later (**GPL-2.0-or-later**). See `LICENSE`.

For setup and daily use, see `USER-GUIDE.md`.


## Reading Settings

When **Your latest posts** is selected under Settings → Reading, the front page uses the standard posts index. The designed publication homepage is used when a **static front page** is selected.

## Release compatibility

Version 1.0.9 targets WordPress 7.1 compatibility and PHP 7.4+, but this build does not claim a WordPress 7.1 runtime verification because the current build environment cannot start WordPress with a database. Parent CSS is loaded explicitly so a child theme can add a small stylesheet without replacing the Three Columns base visual system.


### WordPress.org contributor metadata

`readme.txt` deliberately omits the WordPress.org-only `Contributors:` and `Tested up to:` fields until they can be truthfully supplied. Before directory submission, add the actual WordPress.org username that will own the theme and restore `Tested up to: 7.1` only after this exact build passes a real WordPress 7.1 runtime, Theme Check, and Theme Unit Test run.
