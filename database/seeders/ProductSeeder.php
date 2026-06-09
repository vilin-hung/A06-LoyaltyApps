<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'America No No Ya',
            'description' => 'Perpaduan espresso premium dan air panas yang menghasilkan rasa ringan namun tetap kaya aroma. 
            Pilihan sempurna bagi pencinta kopi klasik.',
            'price' => '35000',
            'stock' => '20',
            'category' => 'Coffee',
        ]);

        Product::create([
            'name' => 'Kopi PHP',
            'description' => 'Latte dengan sentuhan karamel yang manis di awal dan aftertaste kopi yang lebih kuat di akhir. Cocok untuk mengenang chat yang tidak pernah dibalas.',
            'price' => '25500',
            'stock' => '20',
            'category' => 'Coffee',
        ]);

        Product::create([
            'name' => 'Mocha Sih',
            'description' => 'Perpaduan espresso, susu, dan cokelat premium yang menghasilkan rasa manis dan creamy yang sulit ditolak.',
            'price' => '32000',
            'stock' => '20',
            'category' => 'Coffee',
        ]);

        Product::create([
            'name' => 'Kopi 2 Persen',
            'description' => 'Cold brew dengan karakter kopi yang halus dan menyegarkan. 98% ngantuk, 2% harapan hidup.',
            'price' => '32500',
            'stock' => '20',
            'category' => 'Coffee',
        ]);

        Product::create([
            'name' => 'Espresso Depresso',
            'description' => 'Espresso pekat dengan karakter kuat dan aroma khas yang siap menemani hari-hari penuh deadline.',
            'price' => '25000',
            'stock' => '20',
            'category' => 'Coffee',
        ]);

        Product::create([
            'name' => 'Latte Me Explain',
            'description' => 'Cafe latte dengan tekstur lembut dan keseimbangan sempurna antara espresso dan susu segar.',
            'price' => '45000',
            'stock' => '20',
            'category' => 'Coffee',
        ]);

        Product::create([
            'name' => 'Avocado Coffee',
            'description' => 'Perpaduan alpukat segar dan espresso pilihan yang 
            menghasilkan tekstur creamy dengan cita rasa kopi yang seimbang.',
            'price' => '55000',
            'stock' => '10',
            'category' => 'Coffee',
        ]);

        Product::create([
            'name' => 'Matcha Nunggu Dia',
            'description' => 'Tea blend dengan sentuhan matcha yang lembut dan menyegarkan.',
            'price' => '43000',
            'stock' => '10',
            'category' => 'Tea Blend',
        ]);      
         
        Product::create([
            'name' => 'Teh-nang Aja',
            'description' => 'Campuran teh herbal yang cocok untuk menemani waktu santai.',
            'price' => '29900',
            'stock' => '16',
            'category' => 'Tea Blend',
        ]);  

        Product::create([
            'name' => 'Calm Chamomile',
            'description' => 'Tea blend chamomile dengan aroma bunga yang menenangkan.',
            'price' => '35900',
            'stock' => '6',
            'category' => 'Tea Blend',
        ]);  

        Product::create([
            'name' => 'Lychee Later',
            'description' => 'Tea blend dengan rasa leci yang manis dan aroma yang menyegarkan.',
            'price' => '32900',
            'stock' => '10',
            'category' => 'Tea Blend',
        ]);  

        Product::create([
            'name' => 'Berry Happy',
            'description' => 'Kombinasi teh dan buah beri dengan rasa manis serta sedikit asam yang menyegarkan.',
            'price' => '29900',
            'stock' => '5',
            'category' => 'Tea Blend',
        ]);  

        Product::create([
            'name' => 'Milk Tea Boba',
            'description' => 'Perpaduan teh dan susu creamy yang disajikan dengan boba kenyal, menciptakan rasa manis yang seimbang dan menyenangkan.',
            'price' => '39900',
            'stock' => '5',
            'category' => 'Milk Tea',
        ]);  

        Product::create([
            'name' => 'Thai Tea',
            'description' => 'Teh khas Thailand dengan aroma rempah yang unik dan rasa manis creamy yang kaya.',
            'price' => '35900',
            'stock' => '15',
            'category' => 'Milk Tea',
        ]);  

        Product::create([
            'name' => 'Vanilla Milk Tea',
            'description' => 'Kombinasi teh dan susu dengan tambahan madu alami yang memberikan rasa manis yang hangat.',
            'price' => '30500',
            'stock' => '15',
            'category' => 'Milk Tea',
        ]);  

        Product::create([
            'name' => 'Brown Sugar Milk Tea',
            'description' => 'Milk tea dengan gula aren yang kaya rasa, menghadirkan perpaduan manis dan creamy yang sempurna.',
            'price' => '45900',
            'stock' => '10',
            'category' => 'Milk Tea',
        ]);  

        Product::create([
            'name' => 'Taro Milk Tea',
            'description' => 'Milk tea dengan cita rasa talas yang khas, lembut, dan disukai oleh berbagai kalangan.',
            'price' => '29900',
            'stock' => '5',
            'category' => 'Milk Tea',
        ]);  

        Product::create([
            'name' => 'Choco Loco',
            'description' => 'Minuman cokelat creamy dengan rasa manis yang kaya dan aroma cokelat yang menggugah selera.',
            'price' => '32900',
            'stock' => '10',
            'category' => 'Chocolate',
        ]);  

        Product::create([
            'name' => 'Dark Side Chocolate',
            'description' => 'Cokelat hitam dengan rasa yang lebih intens dan sedikit pahit untuk pencinta dark chocolate.',
            'price' => '40000',
            'stock' => '10',
            'category' => 'Chocolate',
        ]);  

        Product::create([
            'name' => 'Choco Vektor',
            'description' => 'Minuman cokelat hangat dengan cita rasa klasik yang lembut dan kaya, cocok dinikmati kapan saja.',
            'price' => '30900',
            'stock' => '10',
            'category' => 'Chocolate',
        ]);  

        Product::create([
            'name' => 'Classic Hot Chocolate',
            'description' => 'Minuman cokelat hangat dengan cita rasa klasik yang lembut dan kaya, cocok dinikmati kapan saja.',
            'price' => '32900',
            'stock' => '10',
            'category' => 'Chocolate',
        ]);  
    }
}
