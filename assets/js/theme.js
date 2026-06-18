document.addEventListener('DOMContentLoaded', () => {
  const nav = document.getElementById('navbar');
  const header = document.getElementById('header');
  const logo = document.getElementById('nav-logo');
  const lines = ['hamburger-line-1', 'hamburger-line-2', 'hamburger-line-3']
    .map((id) => document.getElementById(id))
    .filter(Boolean);

  if (nav) {
    const setLineColor = (color) => {
      const add = color === 'white' ? 'bg-white' : 'bg-black';
      const remove = color === 'white' ? 'bg-black' : 'bg-white';
      lines.forEach((line) => {
        line.classList.remove(remove);
        line.classList.add(add);
      });
    };

    const handleScroll = () => {
      const scrollY = window.scrollY;

      if (header) {
        const scrolledPast = scrollY > header.offsetHeight - nav.offsetHeight;

        if (scrolledPast) {
          nav.classList.remove('text-white');
          nav.classList.add('bg-[#FAFAFA]', 'text-black');
          if (logo?.dataset.logoBlack) logo.src = logo.dataset.logoBlack;
          setLineColor('black');
        } else {
          nav.classList.remove('bg-[#FAFAFA]', 'text-black');
          nav.classList.add('text-white');
          if (logo?.dataset.logoWhite) logo.src = logo.dataset.logoWhite;
          setLineColor('white');
        }
      } else if (scrollY > 0) {
        nav.classList.remove('bg-white/2');
        nav.classList.add('bg-[#FAFAFA]');
      } else {
        nav.classList.remove('bg-[#FAFAFA]');
        nav.classList.add('bg-white/2');
      }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  const btn = document.getElementById('hamburger-btn');
  const menu = document.getElementById('mobile-menu');

  if (!btn || !menu) return;

  btn.addEventListener('click', () => {
    const expanded = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', String(!expanded));
    menu.classList.toggle('opacity-0');
    menu.classList.toggle('pointer-events-none');
    if (logo) logo.classList.toggle('opacity-0');
    document.body.style.overflow = expanded ? '' : 'hidden';
  });

  menu.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
      if (btn.getAttribute('aria-expanded') === 'true') btn.click();
    });
  });
});
