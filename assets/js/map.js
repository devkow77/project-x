function loadGoogleMapsScript(callback) {
  if (window.google?.maps) {
    callback();
    return;
  }

  const apiKey = window.drzewnaMap?.apiKey;
  if (!apiKey) return;

  const script = document.createElement('script');
  script.src = `https://maps.googleapis.com/maps/api/js?key=${encodeURIComponent(apiKey)}&libraries=maps,marker&v=weekly`;
  script.async = true;
  script.defer = true;
  script.onload = callback;
  document.head.appendChild(script);
}

function getMapLocations(mapElement) {
  const defaultLocations = [
    { pos: { lat: 51.938, lng: 15.5084 }, title: 'Drzewna', info: 'Hotel Drzewna - Zielona Góra' },
    { pos: { lat: 51.9392, lng: 15.5035 }, title: 'Kupiecka', info: 'Apartamenty Kupiecka - Zielona Góra' },
  ];

  if (!mapElement?.dataset.locations) {
    return defaultLocations;
  }

  try {
    return JSON.parse(mapElement.dataset.locations);
  } catch (error) {
    console.error('Nieprawidłowe dane lokalizacji mapy:', error);
    return defaultLocations;
  }
}

async function initMap(mapElement) {
  try {
    const { Map } = await google.maps.importLibrary('maps');
    const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary('marker');

    const locations = getMapLocations(mapElement);
    const isParkingMap = Boolean(mapElement.dataset.locations);

    const map = new Map(mapElement, {
      zoom: isParkingMap ? 14 : 15,
      center: locations[0].pos,
      mapId: 'drzewna_map_id_1',
    });

    google.maps.event.trigger(map, 'resize');

    const infoWindow = new google.maps.InfoWindow();

    locations.forEach((loc, index) => {
      const pin = new PinElement(
        isParkingMap
          ? {
              background: '#14532d',
              borderColor: '#14532d',
              glyphText: loc.label ?? String(index + 1),
              glyphColor: '#ffffff',
            }
          : { background: '#ff1100' }
      );

      const marker = new AdvancedMarkerElement({
        map,
        position: loc.pos,
        title: loc.title,
        content: pin.element,
      });

      marker.addListener('click', () => {
        infoWindow.setContent(`<div style="color:black;font-weight:600;">${loc.info}</div>`);
        infoWindow.open(map, marker);
      });
    });

    if (locations.length > 1) {
      const bounds = new google.maps.LatLngBounds();
      locations.forEach((loc) => bounds.extend(loc.pos));
      map.fitBounds(bounds, { top: 48, right: 48, bottom: 48, left: 48 });
    } else {
      map.setCenter(locations[0].pos);
    }
  } catch (error) {
    console.error('Błąd inicjalizacji mapy:', error);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const mapElement = document.getElementById('map');

  if (mapElement) {
    const observer = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          loadGoogleMapsScript(() => initMap(mapElement));
          obs.unobserve(entry.target);
        });
      },
      { rootMargin: '300px' }
    );

    observer.observe(mapElement);
  }

  document.getElementById('focus-name-input')?.addEventListener('click', () => {
    document.getElementById('imie')?.focus();
  });

  const params = new URLSearchParams(window.location.search);
  const btn = document.getElementById('submit-btn');

  if (!btn || !params.has('sent')) return;

  const status = params.get('sent');

  if (status === '1') {
    btn.style.backgroundColor = '#43A047';
    btn.textContent = 'Wysłano pomyślnie!';
  } else {
    btn.style.backgroundColor = '#E53935';
    btn.textContent = 'Błąd, spróbuj ponownie';
  }

  btn.disabled = true;
  btn.classList.remove('cursor-pointer');
  btn.classList.add('cursor-not-allowed');

  const url = new URL(window.location.href);
  url.searchParams.delete('sent');
  window.history.replaceState({}, document.title, url.pathname + url.hash);
});
