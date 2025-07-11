<script>
  const mapa = L.map('mapa').setView([-16.409, -71.537], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(mapa);

  // Geolocalización automática (opcional)
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(pos) {
      const lat = pos.coords.latitude;
      const lon = pos.coords.longitude;
      mapa.setView([lat, lon], 15);
    });
  }

  // Al hacer clic en el mapa, poner marcador y guardar coordenadas
  let marcadorSeleccionado;
  mapa.on('click', function(e) {
    const lat = e.latlng.lat.toFixed(6);
    const lng = e.latlng.lng.toFixed(6);

    document.getElementById("latitud").value = lat;
    document.getElementById("longitud").value = lng;

    if (marcadorSeleccionado) {
      mapa.removeLayer(marcadorSeleccionado);
    }

    marcadorSeleccionado = L.marker([lat, lng]).addTo(mapa)
      .bindPopup("Ubicación seleccionada").openPopup();
  });
</script>
