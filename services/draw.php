<script>
    var map;

    Data = (provinsi) => {
        $.ajax({
            type: "GET",
            url: "services/data.php?provinsi=" + provinsi,
            success: function(res) {

                const result = JSON.parse(res);

                $('#filterProvinsi').empty();

                $('#filterProvinsi').append($('<option>', {
                    value: "",
                    text: ""
                }));

                $.each(result.listProvinsi, function(i, item) {
                    $('#filterProvinsi').append($('<option>', {
                        value: item.name,
                        text: item.name
                    }));
                });

                var data = result.data;
                var nilaiMax = 10

                if (map != undefined) map.remove();

                map = L.map('maps').setView({
                    lat: 0.7893,
                    lon: 113.9213,
                }, 5);

                function getColor(d) {
                    return d < 30000 ? 'green' :
                        d < 50000 ? 'yellow' :
                        d > 50000 ? 'red' :
                        'red';
                }

                function style(feature) {
                    return {
                        weight: 2,
                        opacity: 1,
                        color: 'white',
                        dashArray: '3',
                        fillOpacity: 0.7,
                        fillColor: getColor(parseInt(feature.properties.jumlah_kasus))
                    };
                }

                var legend = L.control({
                    position: "bottomleft"
                });

                legend.onAdd = function(map) {
                    var div = L.DomUtil.create("div", "legend");
                    div.innerHTML += '<i style="background: red"></i><span>Buruk</span><br>';
                    div.innerHTML += '<i style="background: yellow"></i><span>Cukup</span><br>';
                    div.innerHTML += '<i style="background: green"></i><span>Baik</span><br>';
                    return div;
                };

                legend.addTo(map);


                function onEachFeature(feature, layer) {

                    layer.bindPopup(`<h6>${feature.properties.Propinsi}</h6><br>
                                        Jumlah Kasus : ${feature.properties.jumlah_kasus}<br>
                                        Sembuh : ${feature.properties.jumlah_sembuh}<br>
                                        Meninggal : ${feature.properties.jumlah_meninggal}<br>
                                        Dirawat : ${feature.properties.jumlah_dirawat}<br>`);
                }

                L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }).addTo(map);

                var geojson = L.geoJson(data, {
                    style: style,
                    onEachFeature: onEachFeature
                }).addTo(map);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    Data("");

    FilterData = () => {

        const provinsi = $("#filterProvinsi").val();
        Data(provinsi);

    }
</script>