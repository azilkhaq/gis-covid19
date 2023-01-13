<?php

$paramProvinsi = $_GET['provinsi'];

$geo = json_decode(file_get_contents('../assets/geo.json'));
$covid = json_decode(file_get_contents('../assets/covid.json'));
$features = $geo->features;

$data = [];
$listProvinsi = [];

foreach($covid->list_data as $rCovid) {

    $array = array(
        "provinsi" => $rCovid->key,
        "jumlah_kasus" => $rCovid->jumlah_kasus,
        "jumlah_sembuh" => $rCovid->jumlah_sembuh,
        "jumlah_meninggal" => $rCovid->jumlah_meninggal,
        "jumlah_dirawat" => $rCovid->jumlah_dirawat,
    );

    array_push($data, $array);

    array_push($listProvinsi, array(
        "name" => $rCovid->key
    ));
}

$filterData = [];

foreach ($features as $index => $feature) {

    $provinsi = strtoupper($feature->properties->Propinsi);

    if ($paramProvinsi != "") {
        if ($paramProvinsi == $provinsi) {
            array_push($filterData, $feature);
        }
    }

    foreach ($data as $struct) {
        if ($provinsi == $struct['provinsi']) {
            $features[$index]->properties->jumlah_kasus = $struct['jumlah_kasus'];
            $features[$index]->properties->jumlah_sembuh = $struct['jumlah_sembuh'];
            $features[$index]->properties->jumlah_meninggal = $struct['jumlah_meninggal'];
            $features[$index]->properties->jumlah_dirawat = $struct['jumlah_dirawat'];
            break;
        }
    }
}

echo json_encode(
    array(
        'data' => empty($paramProvinsi) ? $features : $filterData,
        'listProvinsi' => $listProvinsi
    )
);
