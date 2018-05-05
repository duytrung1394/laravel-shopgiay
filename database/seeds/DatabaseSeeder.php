<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(NumberSeeder::class);
       
    }
}
class ProductSeeder extends Seeder 
{
     public function run()
    {
        DB::table('product')->insert([
            ['name'=>'NIKE AIR FOAMPOSITE PRO',"slug_name"=>'NIKE AIR FOAMPOSITE PRO',"meta_name"=>"NIKE AIR FOAMPOSITE PRO","image_product"=>'anh3.jpg',"description"=>"giày nhẹ thoáng mát","detail"=>"chất liệu vải cavans kết hợp da","unit_price"=>2500000,"new"=>1,"cate_id"=>1,"brand_id"=>1],
            ['name'=>'NIKE LUNAR FORCE 1 DUCKBOOT',"slug_name"=>'NIKE LUNAR FORCE 1 DUCKBOOT',"meta_name"=>"NIKE LUNAR FORCE 1 DUCKBOOT","image_product"=>'anh4.jpg',"description"=>"giày nhẹ thoáng mát","detail"=>"chất liệu vải cavans kết hợp da","unit_price"=>2500000,"new"=>1,"cate_id"=>1,"brand_id"=>1]
        ]);
    }
}
class SizeSeeder extends Seeder
{
    public function run()
    {
        DB::table('size')->insert([
            ['name'=>"35"],['name'=>"36"],['name'=>"37"],['name'=>"38"],["name"=>"39"],["name"=>"40"],
            ["name"=>"41"]
        ]);
    }
}
class ProductPropertiesSeeder extends Seeder
{
	public function run()
	{
		DB::table('product_properties')->insert([
			['product_id'=>1,"size_id"=>1,"quantity"=>10],
			['product_id'=>1,"size_id"=>2,"quantity"=>13],
			['product_id'=>1,"size_id"=>3,"quantity"=>13],
			['product_id'=>2,"size_id"=>4,"quantity"=>12],
			['product_id'=>2,"size_id"=>3,"quantity"=>34],
		]);
	}
}
class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('category')->insert([
            ['name'=>"Giày Nam","slug_name"=>"giay-nam","parent_id"=>0],
            ['name'=>"Giày Nữ","slug_name"=>"giay-nam","parent_id"=>0],
            ['name'=>"Thể thao","slug_name"=>"the-thao","parent_id"=>1],
            ['name'=>"Boot","slug_name"=>"boot","parent_id"=>1]
        ]);
    }
}
class NumberSeeder extends Seeder
{
    public function run()
    {
        DB::table('number')->insert([
            ['so'=>0], ['so'=>1], ['so'=>2], ['so' =>3], ['so'=>4], ['so'=>5], ['so'=>6], ['so'=>7],
            ['so'=>8], ['so'=>9] 
        ]);
    }
}