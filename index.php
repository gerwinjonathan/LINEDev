<?php
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/lineclass.php';
include ("apicontext.php");

$bot = new Linebot();
$text = $bot->getMessageText();
$userId = $bot->getUserId();
date_default_timezone_set('Asia/Jakarta');

$query = mysqli_query($conn, "select aksi from ramadhan where perintah= '".substr($text,0,7)."'");

if (mysqli_num_rows($query) > 0 && substr($text, 0, 7) == "/jadwal") {
    while ($has = mysqli_fetch_row($query)) {
        $jawab = $has['0'];
        $api = new APIRamadhan();
        $kota = substr($text, 8);
        $kodeKota = $api->getKodeKota($kota);
        $data = $api->getJadwal($kodeKota, $kota);
        
        $jawab .= "\n" . "Tanggal : " . $data['jadwal']['data']['tanggal'] . "\n";
        $jawab .= "Kota : " . strtoupper($kota) . "\n";
        $jawab .= "===========WAKTU===========" . "\n";
        $jawab .= "Imsak   : " . $data['jadwal']['data']['imsak'] . "\n";
        $jawab .= "Subuh   : " . $data['jadwal']['data']['subuh'] . "\n";
        $jawab .= "Terbit  : " . $data['jadwal']['data']['terbit'] . "\n";
        $jawab .= "Dhuha   : " . $data['jadwal']['data']['dhuha'] . "\n";
        $jawab .= "Dzuhur  : " . $data['jadwal']['data']['dzuhur'] . "\n";
        $jawab .= "Ashar   : " . $data['jadwal']['data']['ashar'] . "\n";
        $jawab .= "Maghrib : " . $data['jadwal']['data']['maghrib'] . "\n";
        $jawab .= "Isya    : " . $data['jadwal']['data']['isya'] . "\n";

        $jawab .= "Data diambil : " . date('d-m-Y H:i:s');
    }
}
else if (mysqli_num_rows($query) > 0 && substr($text,0,7) == "/rekom") {
    while ($has = mysqli_fetch_row($query)) {
        $jawab = $has['0'];
        $api = new APIRamadhan();
        $random = rand(1,35);

        $rekomendasi = $api->getRekomendasi($random);
        $jawab .= "\n" . date('d-m-Y');
        $jawab .= "\n" . $rekomendasi . "\n";
    }
}
else {
        $jawab = "Maaf, kata kunci tidak ditemukan.";
}
$bot->Reply($jawab);

?>