<?php

include ("apicontext.php");

$api = new APIRamadhan();

echo "Kode kota : " . $api->getKodeKota("sidoarjo") . "<br />";

$data = $api->getJadwal($api->getKodeKota("sidoarjo"), "sidoarjo");

echo "Tanggal : " . $data['jadwal']['data']['tanggal'];

echo $api->getRekomendasi(5);

?>