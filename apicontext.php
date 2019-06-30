<?php

class APIRamadhan {

    public function getKodeKota($kota) {
        $sumber = 'https://api.banghasan.com/sholat/format/json/kota/nama/'.$kota;
        $konten = file_get_contents($sumber);
        $data = json_decode($konten, true);

        if (count($data) > 1) {   
            for ($a = 0; $a < count($data); $a++) {
                if ($data['kota'][$a]['nama'] == strtoupper($kota)) {
                    $IDKota = $data['kota'][$a]['id'];
                    break;
                }
            }
        }
        else {
            $IDKota = $data['kota'][0]['id'];
        }

        return $IDKota;
    }

    public function getJadwal($id, $kota) {
        $tanggal = date("Y-m-d");
        $sumberJadwal = "https://api.banghasan.com/sholat/format/json/jadwal/kota/$id/tanggal/$tanggal";
        $kontenJadwal = file_get_contents($sumberJadwal);
        $dataJadwal = json_decode($kontenJadwal, true);

        return $dataJadwal;
    }

    public function getRekomendasi($id) {
        $sumber = "rekomendasi/rekomendasi.json";
        $konten = file_get_contents($sumber);
        $data = json_decode($konten, true);

        return $data[$id]['menu'];
    }

}

?>