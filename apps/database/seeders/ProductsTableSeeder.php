<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Medicine::create([
            'code' => 'MTA-18289582',
            'name' => 'Abacavir',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '20000',
            'description' => 'Abacavir adalah obat antivirus untuk mengobati infeksi HIV.',
            'image' => '/images/abacavir.webp',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'DBL8522700810A1',
            'name' => 'Bodrex',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '10000',
            'description' => 'Bodrex adalah obat yang bermanfaat untuk meringankan sakit kepala, sakit gigi, dan menurunkan demam.',
            'image' => '/images/bodrex.jpg',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'KBKI. 3526004003.',
            'name' => 'Cefixime',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '11000',
            'description' => 'Cefixime adalah antibiotik untuk mengobati berbagai infeksi bakteri. ',
            'image' => '/images/cefixime.webp',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'KBKI. 3526003125.',
            'name' => 'Dulcolax',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '11704',
            'description' => 'Dulcolax adalah obat yang bermanfaat untuk mengatasi sembelit atau susah buang air besar. Obat ini juga bisa digunakan untuk membersihkan usus sebelum pemeriksaan medis atau operasi, misalnya pada prosedur kolonoskopi. Dulcolax tersedia dalam bentuk tablet dan supositoria.',
            'image' => '/images/dulcolax.png',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'SD011501011',
            'name' => 'Enervon C',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '7600',
            'description' => 'Enervon C adalah suplemen yang bermanfaat untuk membantu menjaga daya tahan tubuh.',
            'image' => '/images/enervon-c.webp',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'APS-60030-00991',
            'name' => 'Feminax',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '12000',
            'description' => 'Feminax bermanfaat untuk meredakan nyeri haid (dismenore) dan kram perut.',
            'image' => '/images/feminax.jpeg',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'PMC3157487',
            'name' => 'Gingko Biloba',
            'stock' => '100',
            'unit'  => 'botol',
            'price' => '242000',
            'description' => 'Ginkgo biloba adalah obat herbal yang dipercaya dapat menguatkan memori dan mempertajam kemampuan berpikir.',
            'image' => '/images/ginko-biloba.jpg',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'WAE-70063-00511',
            'name' => 'H-Booster',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '23000',
            'description' => 'H-Booster adalah multivitamin yang lengkap dan terdiri dari lima vitamin (vitamin C, E, B3, B5 dan B6) dan dua mineral (zink dan selenium) untuk menunjang daya tahan tubuh pada anak dikala sehat dan mempercepat proses penyembuhan di kala sakit.',
            'image' => '/images/h-boostar.png',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'ZOS-70027-00752',
            'name' => 'Imboost',
            'stock' => '100',
            'unit'  => 'botol',
            'price' => '28000',
            'description' => 'Imboost adalah suplemen yang bermanfaat untuk meningkatkan daya tahan tubuh.',
            'image' => '/images/imboost.jpeg',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => '0006-0078-14',
            'name' => 'Janumet XR',
            'stock' => '24000',
            'unit'  => 'strip',
            'price' => '20000',
            'description' => 'Janumet XR adalah obat untuk menurunkan kadar gula darah pada penderita diabetes mellitus tipe 2.',
            'image' => '/images/janumet.jpeg',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => '0116-4005-08',
            'name' => 'Laktulosa',
            'stock' => '100',
            'unit'  => 'botol',
            'price' => '30000',
            'description' => 'Laktulosa adalah obat untuk mengatasi konstipasi atau sulit buang air besar.',
            'image' => '/images/lactulax.png',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => '3MNX001',
            'name' => 'Komix',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '2000',
            'description' => 'Komix terdiri dari beberapa varian yang bermanfaat untuk meredakan batuk kering, batuk berdahak, panas dalam, hidung tersumbat, dan pilek. ',
            'image' => '/images/komix.png',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'APP-70007-02621',
            'name' => 'Microlax',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '39000',
            'description' => 'Microlax adalah obat pencahar yang bermanfaat untuk mengatasi susah buang air besar atau sembelit.',
            'image' => '/images/microlax.png',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => '0135-0609-01',
            'name' => 'Panadol',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '4000',
            'description' => 'PANADOL FLU & BATUK merupakan obat batuk dan pereda flu dengan kandungan Paracetamol, Phenylephrine HCI, dan Dextromethorphan HBr.',
            'image' => '/images/panadol.jpeg',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'N02BE01',
            'name' => 'Paracetamol',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '5000',
            'description' => 'Parasetamol atau asetaminofen adalah obat analgesik dan antipiretik yang populer dan digunakan untuk meredakan sakit kepala dan nyeri ringan, serta demam.',
            'image' => '/images/paracetamol.webp',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'TOL-70089-00337',
            'name' => 'Konidin',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '5000',
            'description' => 'Konidin OBH ini berfungsi sebagai ekspektoran yang dapat meningkatkan volume dan mengurangi kekentalan sekresi dari trakhea dan bronkhi, sehingga dapat meningkatkan efisiensi refleks batuk dan mempermudah pengeluaran sekresi.',
            'image' => '/images/konidin.jpg',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'DTL 7813003810 A1',
            'name' => 'Paramex',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '4500',
            'description' => 'PARAMEX merupakan obat dengan kandungan Paracetamol, Propyphenazone, Caffeine, Dexchlorpheniramine maleate.',
            'image' => '/images/paramex.webp',
            'expired_date' => '2023-06-29 00:00:00'
        ]);

        \App\Models\Medicine::create([
            'code' => 'MTA-2923123',
            'name' => 'Tolak Angin',
            'stock' => '100',
            'unit'  => 'strip',
            'price' => '2000',
            'description' => 'Kandungan bahan herbal di dalam Tolak Angin Cair relatif aman dan jarang menimbulkan efek samping selama diminum sesuai aturan pakai.',
            'image' => '/images/tolakangin.png',
            'expired_date' => '2023-06-29 00:00:00'
        ]);
    }
}
