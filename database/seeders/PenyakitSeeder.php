<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    public function run(): void
    {
        $penyakits = [
            [
                'kode'        => 'P01',
                'nama'        => 'Dermatitis Atopik',
                'deskripsi'   => 'Dermatitis atopik (eksim) adalah peradangan kulit kronis yang menyebabkan kulit gatal, merah, dan pecah-pecah. Kondisi ini umum pada anak-anak namun bisa terjadi pada semua usia.',
                'penyebab'    => 'Kombinasi faktor genetik dan lingkungan. Kulit yang tidak berfungsi sebagai pelindung yang baik, memungkinkan kelembapan keluar dan kuman masuk. Dipicu oleh alergen, stres, dan keringat.',
                'solusi'      => 'Gunakan pelembap secara teratur, hindari sabun keras, mandi air hangat (bukan panas). Dokter mungkin meresepkan krim kortikosteroid atau inhibitor kalsineurin topikal.',
                'pencegahan'  => 'Jaga kelembapan kulit dengan pelembap rutin. Hindari pemicu seperti deterjen keras, pakaian wol, dan stres berlebih. Gunakan sabun dan produk perawatan yang lembut.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P02',
                'nama'        => 'Psoriasis',
                'deskripsi'   => 'Psoriasis adalah penyakit autoimun yang menyebabkan sel kulit berkembang biak terlalu cepat, membentuk sisik tebal berwarna keperakan dan bercak merah yang terasa gatal dan terkadang menyakitkan.',
                'penyebab'    => 'Sistem imun yang terlalu aktif menyerang sel kulit sehat, mempercepat siklus pertumbuhan sel kulit. Dipicu oleh infeksi, stres, merokok, dan beberapa obat.',
                'solusi'      => 'Krim kortikosteroid topikal, analog vitamin D, retinoid topikal, terapi cahaya (fototerapi), dan untuk kasus parah obat sistemik atau biologis.',
                'pencegahan'  => 'Kelola stres, hindari merokok dan alkohol, jaga kulit tetap lembap, dan hindari cedera kulit yang dapat memicu Koebner phenomenon.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P03',
                'nama'        => 'Acne Vulgaris',
                'deskripsi'   => 'Jerawat adalah kondisi kulit umum yang terjadi ketika folikel rambut tersumbat oleh minyak dan sel kulit mati. Menghasilkan komedo, whitehead, dan papul hingga kista meradang.',
                'penyebab'    => 'Produksi sebum berlebih, bakteri Propionibacterium acnes, perubahan hormonal, dan penumpukan sel kulit mati yang menyumbat pori-pori.',
                'solusi'      => 'Pembersih wajah lembut, benzoil peroksida, asam salisilat topikal, retinoid topikal, atau antibiotik (oral/topikal) untuk kasus sedang hingga berat.',
                'pencegahan'  => 'Cuci muka dua kali sehari dengan pembersih lembut, hindari menyentuh wajah, ganti sarung bantal secara teratur, dan hindari produk yang menyumbat pori-pori.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P04',
                'nama'        => 'Tinea Corporis (Kurap)',
                'deskripsi'   => 'Kurap adalah infeksi jamur superfisial pada kulit yang membentuk cincin merah, bersisik, dan gatal. Meski namanya "kurap", kondisi ini tidak disebabkan oleh cacing.',
                'penyebab'    => 'Infeksi jamur dermatofita (Trichophyton, Microsporum, atau Epidermophyton). Menular melalui kontak langsung dengan orang, hewan, atau permukaan yang terinfeksi.',
                'solusi'      => 'Krim antijamur topikal seperti clotrimazole, miconazole, atau terbinafine selama 2-4 minggu. Kasus berat memerlukan antijamur oral.',
                'pencegahan'  => 'Jaga kulit tetap bersih dan kering, hindari berbagi pakaian/handuk, kenakan alas kaki di tempat umum, dan cuci tangan setelah memegang hewan.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P05',
                'nama'        => 'Urtikaria (Biduran)',
                'deskripsi'   => 'Urtikaria adalah reaksi kulit yang menyebabkan bentol-bentol merah muda atau putih yang gatal dan bengkak di permukaan kulit. Bisa muncul di mana saja dan sering berpindah tempat.',
                'penyebab'    => 'Reaksi alergi terhadap makanan, obat, serangga, atau zat lainnya. Juga dapat dipicu oleh infeksi, stres, suhu ekstrem, atau tanpa sebab jelas (idiopatik).',
                'solusi'      => 'Antihistamin oral (cetirizine, loratadine) untuk meredakan gejala. Kortikosteroid untuk kasus berat. Identifikasi dan hindari pemicu.',
                'pencegahan'  => 'Identifikasi dan hindari alergen pemicu, kelola stres, dan konsultasikan dengan dokter jika sering kambuh.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P06',
                'nama'        => 'Scabies (Kudis)',
                'deskripsi'   => 'Kudis adalah penyakit kulit yang disebabkan oleh tungau kecil Sarcoptes scabiei yang menggali ke dalam kulit dan bertelur, menyebabkan ruam dan rasa gatal yang intens terutama malam hari.',
                'penyebab'    => 'Tungau Sarcoptes scabiei yang menular melalui kontak fisik langsung yang berkepanjangan atau berbagi tempat tidur dan pakaian dengan orang yang terinfeksi.',
                'solusi'      => 'Krim permethrin 5% atau losion benzyl benzoate dioleskan ke seluruh tubuh. Semua anggota keluarga harus diobati serentak. Cuci semua pakaian dan tempat tidur.',
                'pencegahan'  => 'Hindari kontak fisik dekat dengan penderita, jangan berbagi pakaian atau tempat tidur, dan jaga kebersihan diri.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P07',
                'nama'        => 'Rosacea',
                'deskripsi'   => 'Rosacea adalah kondisi kulit kronis yang menyebabkan kemerahan terus-menerus pada wajah, khususnya pipi, hidung, dagu, dan dahi. Dapat muncul pembuluh darah kecil yang terlihat.',
                'penyebab'    => 'Belum diketahui pasti. Kemungkinan kombinasi faktor genetik dan lingkungan. Dipicu oleh paparan sinar matahari, alkohol, makanan pedas, stres, dan suhu ekstrem.',
                'solusi'      => 'Antibiotik topikal (metronidazole), asam azelaic, terapi laser untuk pembuluh darah, dan hindari pemicu. Tidak ada obat, namun gejala bisa dikontrol.',
                'pencegahan'  => 'Gunakan tabir surya setiap hari, hindari pemicu seperti alkohol dan makanan pedas, gunakan produk perawatan kulit yang lembut, dan lindungi kulit dari angin.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P08',
                'nama'        => 'Vitiligo',
                'deskripsi'   => 'Vitiligo adalah kondisi kulit di mana sel-sel yang memproduksi melanin (pigmen kulit) mati atau berhenti berfungsi, menyebabkan bercak kulit kehilangan warnanya (depigmentasi).',
                'penyebab'    => 'Diduga merupakan penyakit autoimun di mana sistem imun menyerang melanosit. Faktor genetik, stres, dan paparan sinar UV juga berperan.',
                'solusi'      => 'Krim kortikosteroid atau inhibitor kalsineurin untuk menghentikan penyebaran. Fototerapi UVB narrowband. Transplantasi kulit untuk kasus tertentu.',
                'pencegahan'  => 'Tidak ada pencegahan pasti. Gunakan tabir surya untuk melindungi kulit yang terkena, kelola stres, dan hindari trauma kulit.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P09',
                'nama'        => 'Herpes Zoster (Cacar Api)',
                'deskripsi'   => 'Herpes zoster adalah infeksi virus yang menyebabkan ruam menyakitkan berupa lepuhan di sekitar satu sisi tubuh atau wajah, mengikuti jalur saraf tertentu.',
                'penyebab'    => 'Reaktivasi virus varicella-zoster (virus yang menyebabkan cacar air) yang dormant di jaringan saraf setelah seseorang sembuh dari cacar air.',
                'solusi'      => 'Obat antivirus (acyclovir, valacyclovir, famciclovir) paling efektif jika dimulai dalam 72 jam ruam muncul. Analgesik untuk nyeri. Kompres dingin untuk mengurangi nyeri.',
                'pencegahan'  => 'Vaksin herpes zoster (Shingrix) sangat dianjurkan untuk orang di atas 50 tahun. Jaga sistem imun tetap kuat.',
                'gambar'      => null,
            ],
            [
                'kode'        => 'P10',
                'nama'        => 'Selulitis',
                'deskripsi'   => 'Selulitis adalah infeksi bakteri pada lapisan kulit dalam dan jaringan di bawah kulit. Muncul sebagai area kulit yang merah, bengkak, panas, dan nyeri yang menyebar dengan cepat.',
                'penyebab'    => 'Bakteri, paling sering Streptococcus atau Staphylococcus, memasuki kulit melalui luka, gigitan serangga, atau area kulit yang rusak.',
                'solusi'      => 'Antibiotik oral atau intravena (untuk kasus berat). Istirahat, elevasi area yang terkena, dan kompres hangat. Segera ke dokter karena bisa menyebar berbahaya.',
                'pencegahan'  => 'Rawat luka dengan baik, jaga kebersihan kulit, kelola kondisi kulit kronis seperti eksim, dan segera tangani infeksi kecil sebelum menyebar.',
                'gambar'      => null,
            ],
        ];

        foreach ($penyakits as $penyakit) {
            Penyakit::create($penyakit);
        }
    }
}
