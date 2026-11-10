<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EventSeeder extends Seeder {
 public function run(): void {
  DB::table('events')->insert([
   ['title'=>'Tech Summit 2026','venue'=>'Valletta Conference Centre','event_date'=>'2026-12-02','category'=>'Conference','capacity'=>150,'status'=>'Upcoming','description'=>'Technology conference','created_at'=>now(),'updated_at'=>now()],
   ['title'=>'Web Development Workshop','venue'=>'MCAST Paola','event_date'=>'2026-11-20','category'=>'Workshop','capacity'=>25,'status'=>'Upcoming','description'=>'Hands-on Laravel session','created_at'=>now(),'updated_at'=>now()],
   ['title'=>'Summer Music Night','venue'=>'Ta Qali','event_date'=>'2026-08-15','category'=>'Concert','capacity'=>500,'status'=>'Completed','description'=>null,'created_at'=>now(),'updated_at'=>now()],
   ['title'=>'Business Leadership Forum','venue'=>'Sliema','event_date'=>'2026-12-11','category'=>'Conference','capacity'=>85,'status'=>'Cancelled','description'=>'Annual forum','created_at'=>now(),'updated_at'=>now()],
   ['title'=>'Design Fundamentals','venue'=>'Gozo Innovation Hub','event_date'=>'2026-11-28','category'=>'Workshop','capacity'=>18,'status'=>'Upcoming','description'=>'Introduction to UI design','created_at'=>now(),'updated_at'=>now()],
  ]);
 }
}
