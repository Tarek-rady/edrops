<?php

namespace Database\Seeders;

use App\Models\Terms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{

    public function run(): void
    {


            Terms::insert([
                [

                    'name_ar'            =>'لوحه التحكم',
                    'name_en'            => 'Admin Panel',
                    'desc_ar'            => 'احصائيات تفصيلية عن طلباتك و مبيعاتك الشهرية',
                    'desc_en'            => 'Detailed statistics about your orders and monthly sales',
                    'type'               => 'terms' ,
                    'created_at'         => now() ,
                ] ,
                [

                    'name_ar'            => 'كاتلوج المنتجات',
                    'name_en'            => 'Products catalogue',
                    'desc_ar'            => 'آلاف المنتجات المطلوبة في عدة دول عربية مع كفالة لجميع المنتجات',
                    'desc_en'            => 'Thousands of products required in several Arab countries, with a warranty for all products',
                    'type'               => 'terms' ,
                    'created_at'         => now() ,
                ] ,



                [

                    'name_ar'            => 'منتجاتي',
                    'name_en'            => 'My Prpducts',
                    'desc_ar'            => 'نظم المنتجات التي ترغب بالعمل عليها في مكان واحد',
                    'desc_en'            => 'Organize the products you want to work on in one place',
                    'type'               => 'terms' ,
                    'created_at'         => now() ,
                ] ,
                [

                    'name_ar'            => 'الطلبات',
                    'name_en'            => 'Orders',
                    'desc_ar'            => 'تابع طلباتك لحظة بلحظة من بداية عملية الطلب لغاية الاستلام من قبل عميلك',
                    'desc_en'            => 'Follow your orders moment by moment from the beginning of the ordering process until receipt by your customer',
                    'type'               => 'terms' ,
                    'created_at'         => now() ,
                ] ,

                [

                    'name_ar'            => 'المحفظه الماليه',
                    'name_en'            => 'Financial portfolio',
                    'desc_ar'            => 'استعرض رصيدك المتاح و اجمالي المبالغ المسحوبة، ايضا يمكنك طلب سحب رصيد و متابعة جميع الحركات المالية',
                    'desc_en'            => 'View your available balance and the total amounts withdrawn. You can also request a balance withdrawal and follow up on all financial movements',
                    'type'               => 'terms' ,
                    'created_at'         => now() ,
                ] ,






                [

                    'name_ar'            => 'كيف بدا العمل اليوم ؟',
                    'name_en'            => 'How did work look today?',
                    'desc_ar'            => 'بعد تسجيل حساب جديد مع دروبيفاي تكون قد سجلت تلقائيا في الباقة المجانية, وتصبح كل خدمات اي دروبس متاحة امامك (منتجات _شحن _تغليف _تحصيل)',
                    'desc_en'            => 'After registering a new account with Dropify, you will automatically be registered in the free package, and all Dropify services will become available to you (products _ shipping _ packaging _ collection)',
                    'type'               => 'asks',
                    'created_at'         => now() ,
                ] ,

                [

                    'name_ar'            => 'كيف استلم ارباحي ؟',
                    'name_en'            => 'How do I receive my profits?',
                    'desc_ar'            => 'بإمكانك استلام أرباحك من اي دروبس بعد ٢٤ ساعة من استلام الزبون للطلب عبر واحدة من الطرق التالية ( البنك ، المحافظ الالكترونية ، ويسترن يونيون)',
                    'desc_en'            => 'You can receive your profits from Dropify 24 hours after the customer receives the order via one of the following methods (bank, electronic wallets, Western Union)',
                    'type'               => 'asks' ,
                    'created_at'         => now() ,
                ] ,
                [

                    'name_ar'            => 'هل احتاج الي بطاقه ائتماني للدفع ؟',
                    'name_en'            => 'Do I need a credit card to pay?',
                    'desc_ar'            => 'أنت لا تحتاج لبطاقات الكترونية يمكنك العمل من خلال الباقة المجانية و لكنها ستلزمك إذا أردت العمل من خلال الباقات المدفوعة',
                    'desc_en'            => 'You do not need electronic cards. You can work through the free package, but you will need it if you want to work through the paid packages.',
                    'type'               => 'asks' ,
                    'created_at'         => now() ,
                ] ,





            ]);

    }
}
