<?php
// Panggil koneksi database
require_once 'koneksi.php';

// Ambil data dari tabel
$query = mysqli_query($conn, "SELECT * FROM lokasi");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Latihan Web GIS - LeafletJS</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        html,
        body,
        #map {
            height: 100%;
            width: 100%;
            margin: 0;
        }
    </style>
</head>

<body>

    <!-- Container Peta -->
    <div id="map"></div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // 1. Inisialisasi Peta (Koordinat Tengah & Level Zoom)
        var map = L.map('map').setView([-7.677567, 110.406899], 12);

        // 2. Basemap Options
        var basemap1 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri'
        });

        var basemap2 = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: 'Map data &copy; Google'
        });

        // Tampilkan basemap utama
        basemap1.addTo(map);

        // 3. Tambah Marker Manual
        var marker1 = L.marker([-7.766715, 110.377460], { draggable: true })
            .addTo(map)
            .bindPopup("<b>Gedung B DIV-SIG UGM</b>");

        var marker2 = L.marker([-7.743168, 110.350276])
            .addTo(map)
            .bindPopup("<b>RS Akademik UGM</b>");

        // 4. Layer Control
        var baseMaps = {
            "Esri Imagery": basemap1,
            "Google Street": basemap2
        };

        var overlayMaps = {
            "Gedung B DIVSIG UGM": marker1,
            "RS Akademik UGM": marker2
        };

        L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);

        // 5. Scale Bar
        L.control.scale({ maxWidth: 150, position: 'bottomright' }).addTo(map);
    </script>
</body>

</html>