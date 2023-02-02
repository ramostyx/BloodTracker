<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\BloodDonation;
use App\Models\BloodRequest;
use App\Models\BloodStock;
use App\Models\BloodTransferCenter;
use App\Models\Client;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Tanger=User::create([
            'name' => 'Tanger-Tetouan-Al Hoceima Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'email_verified_at' => now(),
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        BloodTransferCenter::create([
            'user_id' => $Tanger->id,
        ]);
        Address::create([
            'addressable_id' => $Tanger->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Tanger',
            'province' => 'Tanger-Tetouan-Al Hoceima',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);

        $Oujda =User::factory()->create([
            'name' => 'Oujda Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            'addressable_id' => $Oujda->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Oujda',
            'province' => 'Oujda',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);
        $Fes =User::factory()->create([
            'name' => 'Fès-Meknès Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            'addressable_id' => $Fes->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Fès',
            'province' => 'Fès-Meknès',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);
        $Rabat =User::create([
            'name' => 'Rabat-Salé-Kénitra Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            'addressable_id' => $Rabat->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Rabat',
            'province' => 'Rabat-Salé-Kénitra',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);
        $Khénifra =User::factory()->create([
            'name' => 'Béni Mellal-Khénifra Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            'addressable_id' => $Khénifra->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Khénifra ',
            'province' => 'Béni Mellal-Khénifra ',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);
        $Casablanca =User::factory()->create([
            'name' => 'Casablanca-Settat Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            'addressable_id' => $Casablanca->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Casablanca',
            'province' => 'Casablanca-Settat',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);
        $Marrakech =User::factory()->create([
            'name' => 'Marrakech-Safi  Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            'addressable_id' => $Marrakech->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Marrakech',
            'province' => 'Marrakech-Safi',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);
        $Drâa =User::create([
            'name' => 'Drâa-Tafilalet Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            'addressable_id' => $Drâa->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Drâa',
            'province' => 'Drâa-Tafilalet',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);

        $Souss =User::factory()->create([
            'name' => 'Souss-Massa Center',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'center',
            'profileImage' => '/storage/profiles/centre_sang.jfif',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Address::create([
            'addressable_id' => $Souss->id,
            'addressable_type' => 'App\Models\User',
            'country' =>'Morroco',
            'city' => 'Souss',
            'province' => 'Souss-Massa',
            'street' => fake()->streetName(),
            'zipCode' => fake()->postcode(),
        ]);
        BloodTransferCenter::create([
            'user_id' => $Oujda->id,
        ]);
        BloodTransferCenter::create([
            'user_id' => $Fes->id,
        ]);
        BloodTransferCenter::create([
            'user_id' => $Rabat->id,
        ]);
        BloodTransferCenter::create([
            'user_id' => $Khénifra->id,
        ]);
        BloodTransferCenter::create([
            'user_id' => $Casablanca->id,
        ]);
        BloodTransferCenter::create([
            'user_id' => $Marrakech->id,
        ]);
        BloodTransferCenter::create([
            'user_id' => $Drâa->id,
        ]);
        BloodTransferCenter::create([
            'user_id' => $Souss->id,
        ]);

        $totalToSeed = 72;
        $seeded = 0;

        while ($seeded < $totalToSeed) {
            try {
                BloodStock::factory()->create();
                $seeded++;
            } catch (\Exception $e) {
                //
            }
        }
//        BloodStock::factory(70)->create();

        Donor::factory(50)->create();
        Client::factory(50)->create();
        BloodDonation::factory(80)->create();
        BloodRequest::factory(80)->create();

        User::create([
            'name' => 'admin',
            'phoneNumber' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

    }
}
