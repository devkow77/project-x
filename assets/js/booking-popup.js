
document.addEventListener('click', function (event) {
  const button = event.target.closest('.open-booking-engine');

  if (!button) return;

  event.preventDefault();

  const popup = document.getElementById('booking-popup');
  const iframe = document.getElementById('booking-popup-frame');

  if (!popup || !iframe) return;

  const pageLang = document.documentElement.lang || 'pl';
  const bookingLang = pageLang.split('-')[0].toLowerCase();

  const baseUrl =
    'https://be.guestsage.com/' +
    bookingLang +
    '/ebc0d25d-07bc-487c-87d5-ae18b86fd11a/apartments';

  const roomTypeId = button.getAttribute('data-room-type-id');

  const arrivalDate = new Date();
  const departureDate = new Date();
  departureDate.setDate(arrivalDate.getDate() + 1);

  function formatDate(date) {
    return date.toISOString().split('T')[0];
  }

  let url =
    baseUrl +
    '?arrivalDate=' +
    formatDate(arrivalDate) +
    '&departureDate=' +
    formatDate(departureDate) +
    '&personsCount=2';

  if (roomTypeId) {
    url += '&featuredRoomTypeId=' + encodeURIComponent(roomTypeId);
  }

  iframe.src = url;

  popup.classList.add('is-active');
  popup.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';
});

document.addEventListener('DOMContentLoaded', function () {
  const popup = document.getElementById('booking-popup');
  const iframe = document.getElementById('booking-popup-frame');
  const closeBtn = document.getElementById('booking-popup-close');

  if (!popup || !iframe) return;

  function closePopup() {
    popup.classList.remove('is-active');
    popup.setAttribute('aria-hidden', 'true');
    iframe.src = '';
    document.body.style.overflow = '';
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', closePopup);
  }

  const overlay = popup.querySelector('.booking-popup__overlay');
  if (overlay) {
    overlay.addEventListener('click', closePopup);
  }
});
