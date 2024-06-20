<?php

namespace Database\Seeders;

use App\Models\StaticPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaticPageSeeder extends Seeder
{

    public function run(): void
    {


        StaticPage::insert([

            [

                'title_ar'           => 'منتجات بسعر جملة',
                'title_en'           => 'Products at wholesale price',
                'desc_ar'            => 'اي دروبس ترشدك لأكثر المنتجات مبيعا على شبكة الإنترنت وتقدمها لك بسعر جملة من أول قطعة مما سيزيد من فرصة تحقيق هامش ربح أكبر في البيع',
                'desc_en'            => 'Dropify guides you to the best-selling products on the Internet and offers them to you at a wholesale price from the first piece, which will increase the opportunity to achieve a greater profit margin in the sale',
                'type'               => 'feauture' ,
                'img'                => 'feautures/1.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'تصوير احترافي للمنتجات',
                'title_en'           => 'Professional product photography',
                'desc_ar'            => 'تقدم اي دروبس صور احترافية لجميع المنتجات من مختلف الزوايا وخلفية سادة مريحة للعين حتى يتميز متجرك واعلانك ، و ستزيد الصور الإحترفية فرصك في البيع',
                'desc_en'            => 'Dropify provides professional photos of all products from different angles and with a plain background that is comfortable for the eye so that your store and advertisement stand out. Professional photos will increase your chances of selling.',
                'type'               => 'feauture' ,
                'img'                => 'feautures/2.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'سرعة توصيل وشحن',
                'title_en'           => 'Fast delivery and shipping',
                'desc_ar'            => 'اي دروبس متعاقدة مع أكبر شركات شحن في الأردن عشان نضمن جودة وسرعة ونسب توصيل عالية لطلباتك',
                'desc_en'            => 'Dropify has contracts with the largest shipping companies in Jordan to ensure quality, speed, and high delivery rates for your orders',
                'type'               => 'feauture' ,
                'img'                => 'feautures/3.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'منتجات رابحة',
                'title_en'           => 'اختارت اي دروبس كاتالوج منتجاتها حسب دراسة السوق بعناية على حسب أكثر المنتجات طلبا اونلاين وبهوامش ربح جيدة وسهلنا عليك عملية البحث عن منتجات مطلوبة أونلاين في الأردن.',
                'desc_ar'            => 'Winning products',
                'desc_en'            => 'Dropify chose its product catalog according to carefully studying the market, based on the most in-demand products online, with good profit margins. We have made it easy for you to search for in-demand products online in Jordan.',
                'type'               => 'feauture' ,
                'img'                => 'feautures/4.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'مخازن و تغليف المنتجات',
                'title_en'           => 'Product storage and packaging',
                'desc_ar'            => 'اي دروبس تقدم خدمة مخازن للمنتجات حتى ما تتكلف بإجار للمخزن وعمال وتغليف للمنتجات .',
                'desc_en'            => 'Dropify provides a warehouse service for products, even costing rent for the warehouse, workers, and packaging of the products.',
                'type'               => 'feauture' ,
                'img'                => 'feautures/5.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'تحصيل المبيعات من العميل',
                'title_en'           => 'Collecting sales from the customer',
                'desc_ar'            => 'تقوم اي دروبس بتحصيل المبيعات من عميلك وبإمكانك سحب أرباحك بعدة طرق ( حساب بنكي او محفظتك الالكترونية او عن طريق ويسترن يونيون )',
                'desc_en'            => 'Dropify collects sales from your customer, and you can withdraw your profits in several ways (bank account, electronic wallet, or via Western Union).',
                'type'               => 'feauture' ,
                'img'                => 'feautures/6.png' ,
                'created_at'         => now() ,

            ] ,

            // static ================================

            [

                'title_ar'           => 'المسوقين',
                'title_en'           => 'Marketers',
                'desc_ar'            => '3000',
                'desc_en'            => null,
                'type'               => 'static' ,
                'img'                => 'statics/1.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'المنتجات',
                'title_en'           => 'Products',
                'desc_ar'            => '400',
                'desc_en'            => null,
                'type'               => 'static' ,
                'img'                => 'statics/2.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'الطلبات',
                'title_en'           => 'Orders',
                'desc_ar'            => '10000',
                'desc_en'            => null,
                'type'               => 'static' ,
                'img'                => 'statics/1.png' ,
                'created_at'         => now() ,

            ] ,

            //  ==============================   steps


            [

                'title_ar'           => 'الخطوة الاولى',
                'title_en'           => 'The first step' ,
                'desc_ar'            => 'اختر المنتجات المناسبة لك للتسويق من صفحة كتالوج المنتجات واضفها الى منتجاتي',
                'desc_en'            => 'Choose the products that are suitable for you to market from the product catalog page and add them to My Products',
                'type'               => 'step' ,
                'img'                => 'steps/1.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'الخطوة الثانيه',
                'title_en'           => 'The second step' ,
                'desc_ar'            => 'اعرض صور هذه المنتجات على صفحتك او على متجرك',
                'desc_en'            => 'Display pictures of these products on your page or store',
                'type'               => 'step' ,
                'img'                => 'steps/2.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'الخطوة الثالثه',
                'title_en'           => 'The third step' ,
                'desc_ar'            => 'اطلب المنتجات الي طلبها عميلك من صفحة منتجاتي',
                'desc_en'            => 'Order the products that your customer requested from the My Products page',
                'type'               => 'step' ,
                'img'                => 'steps/3.png' ,
                'created_at'         => now() ,

            ] ,

            [

                'title_ar'           => 'الخطوة الرابعه',
                'title_en'           => 'The fourth step' ,
                'desc_ar'            => 'ادخل الى سلة المشتريات وضيف سعر البيع القطع الي بعتها لعميلك وأضف معلومات شحن عميلك',
                'desc_en'            => 'Enter the shopping cart and add the selling price of the items you sold to your customer and add your customer’s shipping information',
                'type'               => 'step' ,
                'img'                => 'steps/1.png' ,
                'created_at'         => now() ,

            ] ,
        ]);
    }
}
