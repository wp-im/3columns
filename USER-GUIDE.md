# Three Columns 使用手册

Three Columns 是一个坚持固定视觉结构的 WordPress Classic Theme（经典主题）。它不是 Page Builder（页面搭建器）：版式已经由主题确定，使用者主要在 WordPress 后台管理文章、页面、菜单、分类、Widget（小工具）和少量 Customizer（外观自定义器）设置。

## 1. 安装与启用

把 `three-columns` 文件夹上传到 `wp-content/themes/`，或在后台“外观 → 主题 → 添加新主题 → 上传主题”上传 zip，然后启用。主题要求 WordPress 6.3+、PHP 7.4+。

如使用 Classic Editor，可直接启用 Classic Editor 插件。主题自带 `editor-style.css`，后台正文编辑区域会尽量接近前台 680px reading core（阅读核心）的字号、行距和标题比例。

## 2. 菜单：Primary Menu

进入“外观 → 菜单”，建立一个菜单并分配给 **Primary Menu**。这个菜单固定显示在左侧 Navigation Rail（导航轨道）中；移动端打开 Menu 时看到的也是同一菜单。主题不限制菜单层级，但过深层级会增加左栏纵向长度，实际使用仍建议保持简洁。

主题故意不提供自动页面列表 fallback。没有分配 Primary Menu 时，导航区域保持空白，而不会擅自输出所有页面。

## 3. 左右 Sidebar Widgets

进入“外观 → 小工具”。主题注册两个侧栏区域：

- **Left Sidebar**：显示在左侧 Navigation Rail 的 Primary Menu 和搜索框之后。适合放简短说明、分类、归档、社交链接等。
- **Right Sidebar**：显示在右侧 Context Rail（上下文轨道）。普通页面直接显示这些 widgets；Single Post（单篇文章）会先显示 Current Article 和自动目录，再显示 Right Sidebar widgets。

Widget 是内容来源，不负责重新设计版式。主题会把 WordPress 原生 widget markup 映射到既定的细线、字号和间距系统中。

## 4. Footer 的四个 Widget Area

Footer 后台有四个独立区域，但前台仍严格保持原设计的三条轴线，并不是传统的“四等分页脚”。

- **Footer 1**：左轴，位于网站名称下方。
- **Footer 2**：中轴左半。
- **Footer 3**：中轴右半。
- **Footer 4**：右轴。

因此可分别放 About、Navigation、Archive、Follow 等内容，而不会破坏 260 / 760 / 300 的整体几何关系。

## 5. Customizer

进入“外观 → 自定义”。主要设置位于两组中。

### Three Columns Identity

- Header statement：页眉中央的两行说明文字，支持换行。
- Header metadata：页眉右侧的两行元信息，支持换行。
- Accent color 已固定为 `#1467ff`，属于主题视觉规范，不再作为自由 Customizer 选项。若确实需要品牌改色，建议通过 child theme 覆盖 CSS custom property。
- Footer colophon：最底部 copyright / colophon 文字。

Custom Logo 可以使用 WordPress 自带的 Site Identity 设置。Desktop 会在站名旁显示；Mobile 为保持原 HTML 的中央站名结构，会自动隐藏 logo 图形而保留站名。

### Homepage Sources

**Homepage Sources** 用分类决定固定首页各区域的数据来源：Hero、Recent Essays、Recent Reviews、Series、Selected Notes、Selected Publications。不选择分类时，该区域自动使用最近文章作为 fallback。

这些设置只决定“取哪些文章”，不会改变首页 section 的顺序、卡片方向、间距或视觉结构。

## 6. 首页设置与 Sticky Featured

推荐在“设置 → 阅读”中使用一个静态页面作为首页。Three Columns 会保留这个静态 Page 自己的正文、多页内容和 Comments 设置；如果 Page 正文为空，页面外观与既定参考设计完全一致。其后显示固定 publication index：Hero → Featured → Recent Essays → Recent Reviews → Series → Selected Notes → Selected Publications。若选择“您的最新文章”，则首页使用标准 posts index。

**Featured** 区域优先使用 WordPress 的 **Sticky**（置顶）文章。如果没有可用 Sticky 文章，则使用下一篇合适的普通文章。主题会排除已经在前面区域出现的文章，尽量避免 Hero、Featured 与后续区域机械重复。

如果另设“文章页”，首页各 section 的“View all / All essays”等动作链接在没有专用分类来源时会回到该文章页；有专用分类时则链接到相应分类归档。

## 7. Single Post（文章页）

文章页保持参考 HTML 的固定阅读顺序：分类 kicker → 标题 → excerpt/deck → metadata → Featured Image → 正文 → 分类/标签 → Previous/Next → Related Articles。

正文仍由 WordPress 的 `the_content()` 完整输出。主题不修改文章内容本身，只提供 680px reading core、标题、图片、caption、blockquote、列表、表格等表现样式。

右侧的 **On This Page** 不需要手工设置。前端 JavaScript 会读取正文中的 H2/H3 自动生成目录；正文没有合适标题时，该区块保持隐藏。JavaScript 失效时正文仍可正常阅读。

Related Articles 最多读取 3 篇文章，优先使用当前文章的分类，并排除当前文章。

## 8. 图片比例

主题的编辑式列表主要使用两种固定媒体语言：

- 横向图片：推荐 **3:2**。Hero、Featured、Essay/Review、Related 等横图使用这一比例。
- 纵向图片：推荐 **5:8**。Publication cover、右栏 current article 等纵图使用这一比例。

WordPress Featured Image 会使用 core responsive image / `srcset`；主题通过 CSS 做最终裁切。正文中作者自己插入的图片不强制裁成 3:2 或 5:8，而尊重内容原始比例。

## 9. Page、Archive、Search、404 与 Comments

普通 Page 使用同一 680px Document 核心。Attachment（附件）有独立的 document template，会直接显示图片或附件文件、说明和评论，而不会套用普通文章的 Related Articles/reading-time 语义。Archive、Category、Tag、Author、Date、Search 和 posts index 共用同一 entry-list 视觉语言，并使用 WordPress 主查询和原生分页。404 仍处于相同的 Header / Rails / Reading Core 框架中，并提供搜索。Comments 使用 WordPress 原生评论列表、分页和表单。

## 10. Newsletter、SEO 与其他插件功能

Three Columns 不自行处理 Newsletter 提交、不保存表单数据、不创建 CPT、不提供 Analytics，也不取代 SEO plugin。这些属于换主题后仍应存在的功能，应由 plugin 或服务提供。主题可以承载相应 Widget，并保持视觉一致。

同理，SEO plugin 可以继续负责 meta description、Open Graph、sitemap 等；Three Columns 自身负责语义化模板、清楚的 heading hierarchy、archive/search/pagination 以及可理解的内部导航结构。

## 11. Mobile 行为

Mobile 并不是删除两侧栏。较窄屏幕下，左右 rail 保留在 central canvas 两侧，通过 Menu / Context 按钮移动中央页面来 reveal。1024–1259px 时左 rail 常驻、右 Context 仍可 reveal；1260px 以上恢复完整三栏。

打开面板后可以使用遮罩或 Escape 关闭。主题同步 `aria-expanded`；视觉上隐藏的 rail 会同时从键盘与辅助技术的交互顺序中移除，打开某一 rail 时正文 canvas 暂时不可交互，关闭后恢复焦点。主题同时对 reduced-motion 用户减少动画。


## 12. Editorial utility classes（高级编辑样式）

原始 HTML 中有一组视觉语言被有意保留为高级 utility，而不是 Theme runtime 自动生成的组件。它们主要面向 Classic Editor 的 HTML 模式、Custom HTML Widget 或经过编辑人员控制的正文。

- `article-intro`：文章开场/导语区。
- `article-figure`、`article-figure--portrait`：编辑式图文组合，后者适合纵向图片。
- `article-aside`：正文中的旁注或补充信息。
- `single-series-card`：文章内的系列提示卡。
- `rail-note`、`rail-small`：左右 rail 中的说明文字与小型元信息。
- `current-copy`、`current-date`、`context-list`、`topic-cloud`：Context Rail 的高级内容样式。
- `quote`、`newsletter`：适合 Custom HTML Widget 的引用与订阅视觉容器；Theme 只负责表现，不处理订阅业务。
- `footer-eyebrow`、`footer-links`、`footer-social`、`social-row`：Footer/辅助链接的排版 utility。

这些 class 属于 Three Columns 的设计 vocabulary，但不是必须使用的后台配置项。普通使用者无需手工写这些 class；如果使用，建议只用于受控的 HTML 内容，不把站点业务逻辑写进 Theme。

## 13. 推荐的日常操作方式

平时只需要正常发布文章、维护分类、设置 Featured Image、必要时把重要文章设为 Sticky，并在 Homepage Sources 指定各 section 的分类。导航用 Primary Menu，左右辅助内容放 Sidebar widgets，页脚内容分别放 Footer 1–4。不要为了首页版式在正文中手工复制 HTML；视觉结构属于主题，内容属于 WordPress。


## 分享功能

Three Columns 不内置 X、Email、Copy Link 等社交分享逻辑。分享属于 Plugin（插件）职责，使用分享插件可以保证更换主题后功能仍然保留。
