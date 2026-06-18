document.addEventListener('DOMContentLoaded', () => {
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach((item) => {
    const button = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer');
    const answerContent = answer?.querySelector('div');
    if (!button || !answer || !answerContent) return;

    button.addEventListener('click', () => {
      faqItems.forEach((otherItem) => {
        if (otherItem === item) return;
        const otherButton = otherItem.querySelector('.faq-question');
        const otherAnswer = otherItem.querySelector('.faq-answer');
        if (!otherButton || !otherAnswer) return;
        otherAnswer.style.maxHeight = '0px';
        otherButton.setAttribute('aria-expanded', 'false');
      });

      const isExpanded = button.getAttribute('aria-expanded') === 'true';
      answer.style.maxHeight = isExpanded ? '0px' : `${answerContent.scrollHeight}px`;
      button.setAttribute('aria-expanded', String(!isExpanded));
    });
  });

  const turnusyContainer = document.getElementById('turnusy-container');
  const turnusyImage = document.getElementById('turnusy-image');
  const turnusyTitle = document.getElementById('turnusy-title');
  const turnusyDescription = document.getElementById('turnusy-description');
  const turnusyPrevBtn = document.getElementById('turnusy-prev');
  const turnusyNextBtn = document.getElementById('turnusy-next');

  if (turnusyContainer) {
    let slides = [];
    try {
      slides = JSON.parse(turnusyContainer.dataset.slides || '[]');
    } catch {
      slides = [];
    }

    let turnusyIndex = 0;

    const updateTurnusy = () => {
      const current = slides[turnusyIndex];
      if (!current) return;
      if (turnusyImage && current.image) turnusyImage.innerHTML = current.image;
      if (turnusyTitle) turnusyTitle.textContent = current.title;
      if (turnusyDescription) turnusyDescription.textContent = current.description;
    };

    turnusyPrevBtn?.addEventListener('click', () => {
      turnusyIndex = (turnusyIndex - 1 + slides.length) % slides.length;
      updateTurnusy();
    });

    turnusyNextBtn?.addEventListener('click', () => {
      turnusyIndex = (turnusyIndex + 1) % slides.length;
      updateTurnusy();
    });
  }

  const reviewsSlider = document.getElementById('reviews-slider');
  const reviewsPrevBtn = document.getElementById('reviews-slider-prev');
  const reviewsNextBtn = document.getElementById('reviews-slider-next');

  if (reviewsSlider && reviewsPrevBtn && reviewsNextBtn) {
    const firstItem = reviewsSlider.querySelector('article');
    if (!firstItem) return;

    const getStepWidth = () => {
      const gap = parseInt(window.getComputedStyle(reviewsSlider).columnGap, 10) || 24;
      return firstItem.offsetWidth + gap;
    };

    let reviewIndex = 0;
    const totalItems = reviewsSlider.children.length;

    const updateReviewSlider = () => {
      reviewsSlider.style.transition = 'transform 300ms ease-out';
      reviewsSlider.style.transform = `translateX(-${reviewIndex * getStepWidth()}px)`;
    };

    const getVisibleCards = () => {
      if (window.innerWidth >= 1024) return 3;
      if (window.innerWidth >= 640) return 2;
      return 1;
    };

    reviewsNextBtn.addEventListener('click', () => {
      const visibleCards = getVisibleCards();
      reviewIndex = reviewIndex < totalItems - visibleCards ? reviewIndex + 1 : 0;
      updateReviewSlider();
    });

    reviewsPrevBtn.addEventListener('click', () => {
      reviewIndex = reviewIndex > 0 ? reviewIndex - 1 : totalItems - 1;
      updateReviewSlider();
    });

    window.addEventListener('resize', updateReviewSlider);
  }
});
