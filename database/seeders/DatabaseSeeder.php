<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(['email' => 'admin@uniqueacr.com'], [
            'name' => 'Super Admin',
            'password' => 'Admin@12345',
            'role' => 'super_admin',
        ]);

        $domestic = ServiceCategory::firstOrCreate(['slug' => 'domestic'], ['name' => 'Domestic', 'segment' => 'domestic']);
        $commercial = ServiceCategory::firstOrCreate(['slug' => 'commercial'], ['name' => 'Commercial', 'segment' => 'commercial']);

        Service::firstOrCreate(['slug' => 'split-ac-repair'], ['service_category_id' => $domestic->id, 'name' => 'Split AC Repair', 'service_type' => 'Repair', 'price' => 799, 'description' => 'Fast diagnosis and on-site split AC repair.', 'is_active' => true]);
        Service::firstOrCreate(['slug' => 'vrf-installation'], ['service_category_id' => $commercial->id, 'name' => 'VRV/VRF Installation', 'service_type' => 'Installation', 'price' => 4999, 'description' => 'Commercial VRV/VRF installation service.', 'is_active' => true]);

        $resCat = ProductCategory::firstOrCreate(['slug' => 'residential-ac'], ['name' => 'Residential AC']);
        Product::firstOrCreate(['slug' => 'daikin-1-5-ton-inverter'], ['product_category_id' => $resCat->id, 'name' => 'Daikin 1.5 Ton Inverter AC', 'brand' => 'Daikin', 'price' => 42500, 'stock' => 7, 'description' => 'Energy efficient inverter AC for home use.', 'is_active' => true]);
        Product::firstOrCreate(['slug' => 'voltas-1-ton-window'], ['product_category_id' => $resCat->id, 'name' => 'Voltas 1 Ton Window AC', 'brand' => 'Voltas', 'price' => 28990, 'stock' => 5, 'description' => 'Compact and reliable cooling solution.', 'is_active' => true]);

        BlogPost::firstOrCreate(['slug' => 'best-ac-service-kolkata'], ['author_id' => $admin->id, 'title' => 'How to Choose the Best AC Service in Kolkata', 'content' => 'Look for experience, response time, and transparent pricing when hiring an AC service company.', 'is_published' => true, 'published_at' => now()]);

        Testimonial::firstOrCreate(['name' => 'Arijit Sen'], ['designation' => 'Home Owner', 'rating' => 5, 'message' => 'Quick repair and polite technicians. Highly recommended!', 'is_active' => true]);
    }
}
