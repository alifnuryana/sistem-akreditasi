<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Major;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolePermissionSeeder::class,
            StandardSeeder::class,
            MajorSeeder::class,
            SubSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@widyatama.ac.id',
        ])->assignRole(['super admin']);

        User::factory()->create([
            'name' => 'Operator',
            'email' => 'operator@widyatama.ac.id'
        ])->assignRole(['operator']);

        User::factory()->create([
            'name' => 'Dekan',
            'email' => 'dekan@widyatama.ac.id',
        ])->assignRole(['dekan']);

        $majorId = Major::first()->id;

        User::factory()->create([
            'name' => 'Kaprodi',
            'email' => 'kaprodi@widyatama.ac.id',
            'major_id' => $majorId,
        ])->assignRole(['kaprodi']);

        User::factory()->create([
            'name' => 'Dosen',
            'email' => 'dosen@widyatama.ac.id',
            'major_id' => $majorId,
        ])->assignRole(['dosen']);

        $majorId2 = Major::find(2);

        User::factory()->create([
            'name' => 'Dosen 2',
            'email' => 'dosen2@widyatama.ac.id',
            'major_id' => $majorId2,
        ])->assignRole(['dosen']);
    }
}
