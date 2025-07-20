document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map').setView([10.762622, 106.660172], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let firstPopupOpened = false;

    fetch('php/get_stores.php')
        .then(response => response.json())
        .then(stores => {
            stores.forEach(store => {
                const location = store.address;
                const name = store.name;

                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            const lat = parseFloat(data[0].lat);
                            const lon = parseFloat(data[0].lon);

                            const marker = L.marker([lat, lon])
                                .addTo(map)
                                .bindPopup(`<strong>${name}</strong><br>${location}`);

                            if (!firstPopupOpened) {
                                marker.openPopup();
                                map.setView([lat, lon], 15);
                                firstPopupOpened = true;
                            }
                        } else {
                            console.warn(`Location not found for: ${name}`);
                        }
                    })
                    .catch(error => console.error("Geocoding error:", error));
            });
        })
        .catch(error => console.error('Error fetching store locations:', error));
});