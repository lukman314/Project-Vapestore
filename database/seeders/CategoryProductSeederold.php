<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Pod',        'slug' => 'pod',        'description' => 'Perangkat vape pod compact dan portabel'],
            ['name' => 'Mod',        'slug' => 'mod',        'description' => 'Perangkat vape mod dengan fitur lengkap'],
            ['name' => 'AIO',        'slug' => 'aio',        'description' => 'All-in-One vape kit praktis dan serbaguna'],
            ['name' => 'Liquid',     'slug' => 'liquid',     'description' => 'Cairan vape berbagai rasa'],
            ['name' => 'Atomizer',   'slug' => 'atomizer',   'description' => 'Atomizer RDA, RTA, dan RDTA'],
            ['name' => 'Accessories','slug' => 'accessories','description' => 'Aksesoris dan perlengkapan vape'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $products = [
           // === POD ===
            ['name'=>'Oxva Xlim Pro Kit', 'category_slug'=>'pod', 'price'=>310000, 'purchase_count'=>420, 'rating'=>4.8, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Oxva Xlim Go', 'category_slug'=>'pod', 'price'=>185000, 'purchase_count'=>380, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Oxva Xlim SE 2 Bonus Kit', 'category_slug'=>'pod', 'price'=>240000, 'purchase_count'=>210, 'rating'=>4.8, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Oxva Xlim SQ Pro', 'category_slug'=>'pod', 'price'=>325000, 'purchase_count'=>340, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Uwell Caliburn G3 Pro', 'category_slug'=>'pod', 'price'=>330000, 'purchase_count'=>290, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Vaporesso XROS 4', 'category_slug'=>'pod', 'price'=>330000, 'purchase_count'=>310, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Vaporesso XROS 4 Mini', 'category_slug'=>'pod', 'price'=>260000, 'purchase_count'=>250, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Vaporesso ECO Nano', 'category_slug'=>'pod', 'price'=>115000, 'purchase_count'=>480, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Lost Vape Ursa Nano Pro 2', 'category_slug'=>'pod', 'price'=>275000, 'purchase_count'=>190, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Lost Vape Ursa Pocket', 'category_slug'=>'pod', 'price'=>390000, 'purchase_count'=>110, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Voopoo Argus P2', 'category_slug'=>'pod', 'price'=>315000, 'purchase_count'=>230, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Voopoo Argus G2', 'category_slug'=>'pod', 'price'=>320000, 'purchase_count'=>185, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Uwell Caliburn GK3', 'category_slug'=>'pod', 'price'=>280000, 'purchase_count'=>240, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Rincoe Jellybox V3', 'category_slug'=>'pod', 'price'=>150000, 'purchase_count'=>520, 'rating'=>4.4, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],
            ['name'=>'Nevoks Feelin AX', 'category_slug'=>'pod', 'price'=>250000, 'purchase_count'=>165, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>50],

            // === MOD ===
            ['name'=>'Lost Vape Centaurus M200 Mod', 'category_slug'=>'mod', 'price'=>580000, 'purchase_count'=>150, 'rating'=>4.8, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Geekvape Aegis Legend 3 Mod', 'category_slug'=>'mod', 'price'=>750000, 'purchase_count'=>115, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Voopoo Drag 4 Mod', 'category_slug'=>'mod', 'price'=>550000, 'purchase_count'=>135, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Lost Vape Thelema Solo 100W', 'category_slug'=>'mod', 'price'=>420000, 'purchase_count'=>98, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Hotcig R233 Mod', 'category_slug'=>'mod', 'price'=>480000, 'purchase_count'=>190, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'HexOhm V3 Anodized Mod', 'category_slug'=>'mod', 'price'=>2950000, 'purchase_count'=>45, 'rating'=>4.9, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Dovpo MVP 220W Mod', 'category_slug'=>'mod', 'price'=>380000, 'purchase_count'=>110, 'rating'=>4.4, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Vaporesso Gen 200 Mod', 'category_slug'=>'mod', 'price'=>460000, 'purchase_count'=>125, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Geekvape Max100 Aegis Max 2', 'category_slug'=>'mod', 'price'=>520000, 'purchase_count'=>85, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Lost Vape Centaurus M100 Mod', 'category_slug'=>'mod', 'price'=>470000, 'purchase_count'=>92, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Rincoe Jellybox 228W Mod', 'category_slug'=>'mod', 'price'=>350000, 'purchase_count'=>180, 'rating'=>4.4, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Smoant Charon T50 Mod', 'category_slug'=>'mod', 'price'=>390000, 'purchase_count'=>75, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Thelema Quest 200W Mod', 'category_slug'=>'mod', 'price'=>510000, 'purchase_count'=>110, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Geekvape Aegis Solo 2 S100', 'category_slug'=>'mod', 'price'=>490000, 'purchase_count'=>88, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Vandy Vape Pulse V3 Mod', 'category_slug'=>'mod', 'price'=>850000, 'purchase_count'=>60, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Ambition Mods Converter Mod', 'category_slug'=>'mod', 'price'=>850000, 'purchase_count'=>35, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Steam Crave Hadron Mini Mod', 'category_slug'=>'mod', 'price'=>900000, 'purchase_count'=>28, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'SXMini G Class V2 Mod', 'category_slug'=>'mod', 'price'=>2400000, 'purchase_count'=>15, 'rating'=>4.9, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],

            // === AIO ===
            ['name'=>'DotMod DotAIO V2 Kit', 'category_slug'=>'aio', 'price'=>1250000, 'purchase_count'=>75, 'rating'=>1.9, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Centaurus B80 AIO Kit', 'category_slug'=>'aio', 'price'=>650000, 'purchase_count'=>140, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Vandy Vape Pulse AIO V2', 'category_slug'=>'aio', 'price'=>880000, 'purchase_count'=>92, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'San AIO by Vaperz Cloud', 'category_slug'=>'aio', 'price'=>1450000, 'purchase_count'=>48, 'rating'=>4.8, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Nitrous ZAION AIO Kit', 'category_slug'=>'aio', 'price'=>1150000, 'purchase_count'=>55, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Stubby AIO 21700 Kit', 'category_slug'=>'aio', 'price'=>1850000, 'purchase_count'=>34, 'rating'=>4.9, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Billet Box DNA60 Clone Kit', 'category_slug'=>'aio', 'price'=>1100000, 'purchase_count'=>60, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Rincoe Manto AIO Ultra Kit', 'category_slug'=>'aio', 'price'=>380000, 'purchase_count'=>195, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Kuka AIO Kit by Veepon', 'category_slug'=>'aio', 'price'=>720000, 'purchase_count'=>42, 'rating'=>4.4, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Cthulhu AIO Box Mod Kit', 'category_slug'=>'aio', 'price'=>1350000, 'purchase_count'=>50, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Hastur AIO Atim DNA60', 'category_slug'=>'aio', 'price'=>2100000, 'purchase_count'=>18, 'rating'=>4.4, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Mayday AIO Kit Mechlife', 'category_slug'=>'aio', 'price'=>550000, 'purchase_count'=>85, 'rating'=>4.4, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Pioneer4you IPV V2 AIO', 'category_slug'=>'aio', 'price'=>450000, 'purchase_count'=>40, 'rating'=>4.3, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Aspire Muhs AIO Kit', 'category_slug'=>'aio', 'price'=>490000, 'purchase_count'=>38, 'rating'=>4.4, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Artery Cold Steel AIO', 'category_slug'=>'aio', 'price'=>580000, 'purchase_count'=>52, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Oxva Origin SE AIO', 'category_slug'=>'aio', 'price'=>270000, 'purchase_count'=>160, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Geekvape Aegis Boost Pro AIO', 'category_slug'=>'aio', 'price'=>420000, 'purchase_count'=>115, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],
            ['name'=>'Suorin Trio80 AIO Kit', 'category_slug'=>'aio', 'price'=>350000, 'purchase_count'=>65, 'rating'=>1.2, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>20],

            // === LIQUID ===
            ['name'=>'Exo Mango Freebase 60ml', 'category_slug'=>'liquid', 'price'=>110000, 'purchase_count'=>340, 'rating'=>4.7, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Juta Juice Anggur Merah 60ml', 'category_slug'=>'liquid', 'price'=>100000, 'purchase_count'=>410, 'rating'=>4.6, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Foom Icy Watermelon 30ml', 'category_slug'=>'liquid', 'price'=>85000, 'purchase_count'=>580, 'rating'=>4.8, 'liquid_type'=>'salt', 'nicotine'=>30, 'stock'=>80],
            ['name'=>'Tokyo Lychee Saltnic 30ml', 'category_slug'=>'liquid', 'price'=>115000, 'purchase_count'=>290, 'rating'=>4.6, 'liquid_type'=>'salt', 'nicotine'=>30, 'stock'=>80],
            ['name'=>'Oat Drips V1 Original 100ml', 'category_slug'=>'liquid', 'price'=>135000, 'purchase_count'=>620, 'rating'=>4.8, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Oat Drips V2 Mung Bean 100ml', 'category_slug'=>'liquid', 'price'=>135000, 'purchase_count'=>490, 'rating'=>4.7, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Lunar HexOhm Strawberry 60ml', 'category_slug'=>'liquid', 'price'=>115000, 'purchase_count'=>310, 'rating'=>4.7, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Banana Licious Original 60ml', 'category_slug'=>'liquid', 'price'=>115000, 'purchase_count'=>430, 'rating'=>4.7, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Alacarte Custard Strawberry 60ml', 'category_slug'=>'liquid', 'price'=>115000, 'purchase_count'=>380, 'rating'=>4.7, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Paradewa Apple Zeus Freebase 60ml', 'category_slug'=>'liquid', 'price'=>110000, 'purchase_count'=>315, 'rating'=>4.6, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Blondies Blueberry Cheesecake 100ml', 'category_slug'=>'liquid', 'price'=>145000, 'purchase_count'=>270, 'rating'=>4.6, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'English Breakfast Strawberry Oats 60ml', 'category_slug'=>'liquid', 'price'=>115000, 'purchase_count'=>240, 'rating'=>4.7, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Manhattan Jersey Wood Tobacco 60ml', 'category_slug'=>'liquid', 'price'=>140000, 'purchase_count'=>195, 'rating'=>4.8, 'liquid_type'=>'freebase', 'nicotine'=>6, 'stock'=>80],
            ['name'=>'Foom Ice Blast Saltnic 30ml', 'category_slug'=>'liquid', 'price'=>85000, 'purchase_count'=>640, 'rating'=>4.8, 'liquid_type'=>'salt', 'nicotine'=>30, 'stock'=>80],
            ['name'=>'Foom Apple Bitterlake 30ml', 'category_slug'=>'liquid', 'price'=>85000, 'purchase_count'=>410, 'rating'=>4.6, 'liquid_type'=>'salt', 'nicotine'=>30, 'stock'=>80],
            ['name'=>'Juta Juice Honeydew Saltnic 30ml', 'category_slug'=>'liquid', 'price'=>75000, 'purchase_count'=>380, 'rating'=>4.5, 'liquid_type'=>'salt', 'nicotine'=>30, 'stock'=>80],
            ['name'=>'South Coast Strawberry Macaroon 30ml', 'category_slug'=>'liquid', 'price'=>95000, 'purchase_count'=>290, 'rating'=>4.6, 'liquid_type'=>'salt', 'nicotine'=>30, 'stock'=>80],
            ['name'=>'Grappy Blast Grape Apple 60ml', 'category_slug'=>'liquid', 'price'=>110000, 'purchase_count'=>210, 'rating'=>4.4, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Sub Ohm Blackcurrant Grape 60ml', 'category_slug'=>'liquid', 'price'=>110000, 'purchase_count'=>245, 'rating'=>4.5, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Trix Strawberry Cheesecake 60ml', 'category_slug'=>'liquid', 'price'=>125000, 'purchase_count'=>185, 'rating'=>4.6, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Cupcorn Cheese Milk Original 60ml', 'category_slug'=>'liquid', 'price'=>110000, 'purchase_count'=>320, 'rating'=>4.5, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Berry Popcorn Movie Series 100ml', 'category_slug'=>'liquid', 'price'=>140000, 'purchase_count'=>160, 'rating'=>4.4, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Avara Mango Podang Local 60ml', 'category_slug'=>'liquid', 'price'=>100000, 'purchase_count'=>280, 'rating'=>4.5, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Creme Brulee Golden Series 60ml', 'category_slug'=>'liquid', 'price'=>115000, 'purchase_count'=>190, 'rating'=>4.6, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Dua Apple Shisha Heritage 60ml', 'category_slug'=>'liquid', 'price'=>110000, 'purchase_count'=>215, 'rating'=>4.5, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Ala Mode Vanilla Ice Cream 60ml', 'category_slug'=>'liquid', 'price'=>115000, 'purchase_count'=>230, 'rating'=>4.6, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],
            ['name'=>'Blackwood Premium Tobacco 60ml', 'category_slug'=>'liquid', 'price'=>130000, 'purchase_count'=>110, 'rating'=>4.5, 'liquid_type'=>'freebase', 'nicotine'=>6, 'stock'=>80],
            ['name'=>'Public Distribution Strawberry Milk 100ml', 'category_slug'=>'liquid', 'price'=>145000, 'purchase_count'=>175, 'rating'=>4.6, 'liquid_type'=>'freebase', 'nicotine'=>3, 'stock'=>80],

            // === ATOMIZER ===
            ['name'=>'Hellvape Dead Rabbit V3 RDA', 'category_slug'=>'atomizer', 'price'=>290000, 'purchase_count'=>140, 'rating'=>4.8, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>15],
            ['name'=>'Geekvape Z Subohm Tank 2021', 'category_slug'=>'atomizer', 'price'=>320000, 'purchase_count'=>195, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>15],
            ['name'=>'Wotofo Profile M RTA Mesh', 'category_slug'=>'atomizer', 'price'=>340000, 'purchase_count'=>95, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>15],
            ['name'=>'Vandy Vape Kylin M Pro RTA', 'category_slug'=>'atomizer', 'price'=>380000, 'purchase_count'=>80, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>15],
            ['name'=>'Hellvape Wasp Nano RDA V2', 'category_slug'=>'atomizer', 'price'=>190000, 'purchase_count'=>220, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>15],
            ['name'=>'Dovpo Blotto V1.5 RTA', 'category_slug'=>'atomizer', 'price'=>420000, 'purchase_count'=>75, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>15],
            ['name'=>'QP Design Fatality M25 RTA Remake', 'category_slug'=>'atomizer', 'price'=>680000, 'purchase_count'=>45, 'rating'=>4.9, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>15],
            ['name'=>'Wotofo Recurve V2 RDA Dual Coil', 'category_slug'=>'atomizer', 'price'=>310000, 'purchase_count'=>85, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>15],

            // === ACCESSORIES ===
            ['name'=>'Cotton Bacon Prime by Wick N Vape', 'category_slug'=>'accessories', 'price'=>55000, 'purchase_count'=>840, 'rating'=>4.9, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>100],
            ['name'=>'Sony Murata VTC6A 18650 Battery', 'category_slug'=>'accessories', 'price'=>95000, 'purchase_count'=>460, 'rating'=>4.8, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>100],
            ['name'=>'Molicel P28A 18650 2800mAh Battery', 'category_slug'=>'accessories', 'price'=>110000, 'purchase_count'=>390, 'rating'=>4.8, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>100],
            ['name'=>'Nitecore New i2 Dual Slot Charger', 'category_slug'=>'accessories', 'price'=>185000, 'purchase_count'=>230, 'rating'=>4.7, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>100],
            ['name'=>'Driptip 810 Resin Premium Series', 'category_slug'=>'accessories', 'price'=>45000, 'purchase_count'=>310, 'rating'=>4.5, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>100],
            ['name'=>'Coil Master DIY Toolkit V3 Bag', 'category_slug'=>'accessories', 'price'=>220000, 'purchase_count'=>115, 'rating'=>4.6, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>100],
            ['name'=>'Lanyard Vape Universal Elastic Ring', 'category_slug'=>'accessories', 'price'=>25000, 'purchase_count'=>620, 'rating'=>4.4, 'liquid_type'=>'kosong', 'nicotine'=>0, 'stock'=>100],
        ];

        $categoryMap = Category::pluck('id', 'slug');

        foreach ($products as $p) {
            Product::create([
                'category_id'    => $categoryMap[$p['category_slug']],
                'name'           => $p['name'],
                'price'          => $p['price'],
                'jumlah_pembelian' => $p['purchase_count'],
                'rating'         => $p['rating'],
                'liquid_type'    => $p['liquid_type'],
                'nicotine'       => $p['nicotine'],
                'stock'          => $p['stock'],
                'description'    => null,
                'image'          => null,
                'is_active'      => true,
            ]);
        }
    }
}