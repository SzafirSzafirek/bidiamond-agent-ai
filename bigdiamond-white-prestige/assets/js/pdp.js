// assets/js/pdp.js — SAFE sticky bar
(function () {
  if (window.bdwpPdpStickyInit) return; // guard przed podwójnym init
  window.bdwpPdpStickyInit = true;

  document.addEventListener('DOMContentLoaded', () => {
    const sticky  = document.getElementById('bdwpPdpSticky');
    const summary = document.getElementById('bdwp-pdp-summary');
    if (!sticky || !summary) return;

    // sentinel przed summary — stabilniejsze niż obserwowanie całego summary
    const sentinel = document.createElement('div');
    sentinel.setAttribute('data-bdwp-sentinel', '');
    summary.parentNode.insertBefore(sentinel, summary);

    let last = null;
    const onChange = (isIntersecting) => {
      if (last === isIntersecting) return; // brak zmian → nic nie rób
      last = isIntersecting;
      // gdy SENTINEL w kadrze → summary jest widoczne → chowamy sticky
      sticky.hidden = isIntersecting;
    };

    const io = new IntersectionObserver((entries) => {
      const entry = entries[0];
      // pauza gdy otwarta galeria/zoom (np. PhotoSwipe)
      const pswpOpen = !!document.querySelector('.pswp--open, .pswp__bg, .zoomImg');
      if (pswpOpen) return;
      // throttle przez rAF
      requestAnimationFrame(() => onChange(entry.isIntersecting));
    }, { rootMargin: '-120px 0px 0px 0px', threshold: 0 });

    io.observe(sentinel);

    // porządek przy wyjściu ze strony
    window.addEventListener('pagehide', () => io.disconnect(), { once: true });
  });
})();
