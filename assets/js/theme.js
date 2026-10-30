(() => {
  'use strict';

  const body = document.body;
  const menuButton = document.querySelector('.menu-button');
  const sidebarButton = document.querySelector('.sidebar-button');
  const headerMenuButton = document.querySelector('.header-menu-toggle');
  const maskLeft = document.querySelector('.mask-left');
  const maskRight = document.querySelector('.mask-right');
  const leftRail = document.querySelector('#leftRail');
  const rightRail = document.querySelector('#rightRail');
  const canvasRegions = [...document.querySelectorAll('.site-header, .main-column, .site-footer, .copyright-strip')];
  const savedTabIndexes = new WeakMap();
  let lastTrigger = null;

  const focusables = (container) => container
    ? [...container.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])')]
    : [];
  const managedFocusables = (container) => container
    ? [...container.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]')]
    : [];

  const setInteractiveState = (element, enabled) => {
    if (!element) return;

    if ('inert' in element) element.inert = !enabled;
    if (enabled) element.removeAttribute('aria-hidden');
    else element.setAttribute('aria-hidden', 'true');

    managedFocusables(element).forEach((item) => {
      if (!enabled) {
        if (!savedTabIndexes.has(item)) savedTabIndexes.set(item, item.getAttribute('tabindex'));
        item.setAttribute('tabindex', '-1');
        return;
      }

      if (!savedTabIndexes.has(item)) return;
      const previous = savedTabIndexes.get(item);
      if (previous === null) item.removeAttribute('tabindex');
      else item.setAttribute('tabindex', previous);
      savedTabIndexes.delete(item);
    });
  };

  const syncPanelState = () => {
    const navOpen = body.classList.contains('active-nav');
    const sidebarOpen = body.classList.contains('active-sidebar');
    const width = window.innerWidth;

    menuButton?.setAttribute('aria-expanded', String(navOpen));
    sidebarButton?.setAttribute('aria-expanded', String(sidebarOpen));
    body.classList.toggle('panel-open', navOpen || sidebarOpen);

    if (navOpen) {
      setInteractiveState(leftRail, true);
      setInteractiveState(rightRail, false);
      canvasRegions.forEach((region) => setInteractiveState(region, false));
      return;
    }

    if (sidebarOpen) {
      setInteractiveState(leftRail, false);
      setInteractiveState(rightRail, true);
      canvasRegions.forEach((region) => setInteractiveState(region, false));
      return;
    }

    setInteractiveState(leftRail, width >= 1024);
    setInteractiveState(rightRail, width >= 1260);
    canvasRegions.forEach((region) => setInteractiveState(region, true));
  };

  const closePanels = (restoreFocus = true) => {
    const wasOpen = body.classList.contains('active-nav') || body.classList.contains('active-sidebar');
    body.classList.remove('active-nav', 'active-sidebar');
    if (restoreFocus && wasOpen && lastTrigger) lastTrigger.focus();
    syncPanelState();
  };

  const closeHeaderMenu = (restoreFocus = false) => {
    body.classList.remove('navigation-open');
    headerMenuButton?.setAttribute('aria-expanded', 'false');
    if (restoreFocus) headerMenuButton?.focus();
  };

  const openPanel = (type, trigger, rail) => {
    closeHeaderMenu();
    closePanels(false);
    lastTrigger = trigger;
    body.classList.add(type === 'nav' ? 'active-nav' : 'active-sidebar');
    syncPanelState();
    window.requestAnimationFrame(() => focusables(rail)[0]?.focus());
  };

  menuButton?.addEventListener('click', () => {
    if (body.classList.contains('active-nav')) closePanels();
    else openPanel('nav', menuButton, leftRail);
  });
  sidebarButton?.addEventListener('click', () => {
    if (body.classList.contains('active-sidebar')) closePanels();
    else openPanel('sidebar', sidebarButton, rightRail);
  });
  headerMenuButton?.addEventListener('click', () => {
    const open = !body.classList.contains('navigation-open');
    closePanels(false);
    body.classList.toggle('navigation-open', open);
    headerMenuButton.setAttribute('aria-expanded', String(open));
  });
  maskLeft?.addEventListener('click', () => closePanels());
  maskRight?.addEventListener('click', () => closePanels());
  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    if (body.classList.contains('navigation-open')) {
      closeHeaderMenu(true);
      return;
    }
    closePanels();
  });
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 1290) {
      closeHeaderMenu();
      closePanels(false);
    }
    else if (window.innerWidth >= 1024 && body.classList.contains('active-nav')) closePanels(false);
    else syncPanelState();
  });
  syncPanelState();

  const viewport = document.querySelector('.series-viewport');
  const prev = document.querySelector('[data-series-prev]');
  const next = document.querySelector('[data-series-next]');
  const dots = [...document.querySelectorAll('.series-dot')];
  if (viewport && prev && next) {
    const updateSeries = () => {
      const max = Math.max(0, viewport.scrollWidth - viewport.clientWidth);
      prev.disabled = viewport.scrollLeft <= 4;
      next.disabled = viewport.scrollLeft >= max - 4;
      const page = max ? Math.round((viewport.scrollLeft / max) * Math.max(0, dots.length - 1)) : 0;
      dots.forEach((dot, index) => dot.classList.toggle('is-active', index === page));
    };
    const slide = (direction) => viewport.scrollBy({ left: direction * viewport.clientWidth, behavior: 'smooth' });
    prev.addEventListener('click', () => slide(-1));
    next.addEventListener('click', () => slide(1));
    viewport.addEventListener('scroll', updateSeries, { passive: true });
    window.addEventListener('resize', updateSeries);
    updateSeries();
  }

  const toc = document.querySelector('[data-toc]');
  const article = document.querySelector('.article-body');
  if (toc && article) {
    const headings = [...article.querySelectorAll('h2, h3')];
    if (headings.length) {
      const usedIds = new Set([...document.querySelectorAll('[id]')].map((element) => element.id).filter(Boolean));
      const list = document.createElement('ol');
      list.className = 'toc-list';
      headings.forEach((heading, index) => {
        if (!heading.id) {
          const base = `section-${index + 1}`;
          let candidate = base;
          let suffix = 2;
          while (usedIds.has(candidate) || document.getElementById(candidate)) {
            candidate = `${base}-${suffix}`;
            suffix += 1;
          }
          heading.id = candidate;
          usedIds.add(candidate);
        }
        const item = document.createElement('li');
        const link = document.createElement('a');
        const number = document.createElement('span');
        const label = document.createElement('span');
        number.textContent = String(index + 1).padStart(2, '0');
        label.textContent = heading.textContent.trim();
        link.href = `#${heading.id}`;
        link.append(number, label);
        item.append(link);
        list.append(item);
      });
      toc.append(list);
      toc.hidden = false;
      syncPanelState();
    }
  }
})();
