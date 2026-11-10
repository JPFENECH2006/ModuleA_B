<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TicketSeeder extends Seeder {
 public function run(): void {
  DB::table('tickets')->insert([
   ['subject'=>'Password reset email missing','customer_email'=>'alex@example.com','description'=>'No reset email arrived','priority'=>'Medium','status'=>'Open','created_at'=>now(),'updated_at'=>now()],
   ['subject'=>'Payment failed','customer_email'=>'maria@example.com','description'=>'Card rejected at checkout','priority'=>'High','status'=>'In Progress','created_at'=>now(),'updated_at'=>now()],
   ['subject'=>'Update billing details','customer_email'=>'sam@example.com','description'=>'How to change billing address','priority'=>'Low','status'=>'Closed','created_at'=>now(),'updated_at'=>now()],
   ['subject'=>'Cannot access account','customer_email'=>'taylor@example.com','description'=>'Sign-in blocked','priority'=>'High','status'=>'Open','created_at'=>now(),'updated_at'=>now()],
   ['subject'=>'Download invoice','customer_email'=>'lee@example.com','description'=>'Invoice PDF link missing','priority'=>'Low','status'=>'Open','created_at'=>now(),'updated_at'=>now()],
  ]);
 }
}
