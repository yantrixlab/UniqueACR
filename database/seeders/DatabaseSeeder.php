<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\MediaCategory;
use App\Models\Role;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Testimonial;
use App\Models\User;
use App\Services\PermissionSyncService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionSyncService::class)->syncResourcePermissions();

        $superAdminRole = Role::firstOrCreate(
            ['slug' => 'super_admin'],
            ['name' => 'Super Admin', 'is_system' => true]
        );
        $adminRole = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'is_system' => true]
        );
        $editorRole = Role::firstOrCreate(
            ['slug' => 'editor'],
            ['name' => 'Editor', 'is_system' => true]
        );
        $employeeRole = Role::firstOrCreate(
            ['slug' => 'employee'],
            ['name' => 'Employee', 'is_system' => true]
        );
        Role::firstOrCreate(
            ['slug' => 'customer'],
            ['name' => 'Customer', 'is_system' => true]
        );

        MediaCategory::firstOrCreate(['slug' => 'blog-images'], ['name' => 'Blog Images']);
        MediaCategory::firstOrCreate(['slug' => 'product-images'], ['name' => 'Product Images']);
        MediaCategory::firstOrCreate(['slug' => 'service-images'], ['name' => 'Service Images']);
        MediaCategory::firstOrCreate(['slug' => 'documents'], ['name' => 'Documents']);

        $superAdminRole->permissions()->sync(\App\Models\Permission::query()->pluck('id')->all());
        $adminRole->permissions()->sync(\App\Models\Permission::query()->pluck('id')->all());

        $admin = User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@uniqueacr.com')],
            [
                'name' => env('ADMIN_NAME', 'Super Admin'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin@12345')),
                'role' => 'super_admin',
                'role_id' => $superAdminRole->id,
                'is_active' => true,
            ]
        );

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
