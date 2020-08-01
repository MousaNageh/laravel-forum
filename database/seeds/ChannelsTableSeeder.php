<?php

use App\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str ; 

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            "name"=>"larave 7" , 
            "slug"=>Str::slug("larave 7")
        ]) ; 
        Channel::create([
            "name"=>"vue js" , 
            "slug"=>Str::slug("vue js")
        ]) ; 
        Channel::create([
            "name"=>"wordpress 8" , 
            "slug"=>Str::slug("wordpress 8")
        ]) ; 
        Channel::create([
            "name"=>"java script" , 
            "slug"=>Str::slug("java script")
        ]) ; 
        Channel::create([
            "name"=>"angular 7" , 
            "slug"=>Str::slug("angular 7")
        ]) ; 
    }
}
