<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        $gejalas = [
            ['kode' => 'G01', 'nama' => 'Kulit terasa gatal'],
            ['kode' => 'G02', 'nama' => 'Kulit kemerahan'],
            ['kode' => 'G03', 'nama' => 'Kulit kering dan bersisik'],
            ['kode' => 'G04', 'nama' => 'Kulit meradang atau bengkak'],
            ['kode' => 'G05', 'nama' => 'Kulit terasa perih atau nyeri'],
            ['kode' => 'G06', 'nama' => 'Muncul bercak keperakan tebal di kulit'],
            ['kode' => 'G07', 'nama' => 'Kulit terasa sangat kering dan pecah-pecah'],
            ['kode' => 'G08', 'nama' => 'Muncul komedo atau whitehead'],
            ['kode' => 'G09', 'nama' => 'Muncul papul atau pustul (jerawat bernanah)'],
            ['kode' => 'G10', 'nama' => 'Kulit berminyak'],
            ['kode' => 'G11', 'nama' => 'Muncul bercak berbentuk cincin dengan tepi bersisik'],
            ['kode' => 'G12', 'nama' => 'Rambut atau kuku ikut terkena jamur'],
            ['kode' => 'G13', 'nama' => 'Muncul bentol-bentol atau biduran'],
            ['kode' => 'G14', 'nama' => 'Bentol berpindah-pindah tempat'],
            ['kode' => 'G15', 'nama' => 'Gatal yang sangat intens terutama malam hari'],
            ['kode' => 'G16', 'nama' => 'Liang atau terowongan kecil di kulit'],
            ['kode' => 'G17', 'nama' => 'Gejala muncul pada beberapa anggota keluarga sekaligus'],
            ['kode' => 'G18', 'nama' => 'Kemerahan permanen pada wajah'],
            ['kode' => 'G19', 'nama' => 'Pembuluh darah kecil terlihat di wajah'],
            ['kode' => 'G20', 'nama' => 'Kulit wajah terasa terbakar atau menyengat'],
            ['kode' => 'G21', 'nama' => 'Muncul bercak putih atau kehilangan pigmen kulit'],
            ['kode' => 'G22', 'nama' => 'Bercak simetris di kedua sisi tubuh'],
            ['kode' => 'G23', 'nama' => 'Rambut pada area terkena ikut memutih'],
            ['kode' => 'G24', 'nama' => 'Muncul lepuhan berisi cairan yang menyakitkan'],
            ['kode' => 'G25', 'nama' => 'Rasa nyeri seperti terbakar atau tertusuk'],
            ['kode' => 'G26', 'nama' => 'Ruam mengikuti jalur saraf (satu sisi tubuh)'],
            ['kode' => 'G27', 'nama' => 'Area kulit terasa panas saat disentuh'],
            ['kode' => 'G28', 'nama' => 'Kulit berwarna merah menyala dan terasa panas'],
            ['kode' => 'G29', 'nama' => 'Batas area infeksi yang tidak tegas dan meluas'],
            ['kode' => 'G30', 'nama' => 'Demam atau menggigil disertai gejala kulit'],
            ['kode' => 'G31', 'nama' => 'Kulit terasa tebal atau seperti kulit kayu'],
            ['kode' => 'G32', 'nama' => 'Gatal lebih parah saat berkeringat'],
            ['kode' => 'G33', 'nama' => 'Muncul bekas luka gelap setelah peradangan'],
            ['kode' => 'G34', 'nama' => 'Kulit di sekitar mata atau mulut ikut terkena'],
            ['kode' => 'G35', 'nama' => 'Gejala memburuk saat stres atau kelelahan'],
        ];

        foreach ($gejalas as $gejala) {
            Gejala::create($gejala);
        }
    }
}
