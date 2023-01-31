<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Request;
use App\Models\BloodDonation;
use App\Models\BloodStock;
use App\Models\BloodRequest;
use App\Models\BloodTransferCenter;
use App\Models\Client;
use App\Models\Donor;
use App\Models\DonorCampaign;
use App\Models\Campaign;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(10)->create();
        BloodTransferCenter::factory(7)->create();
//        User::factory(40)->create();
////
//        for($i=0; $i<10;$i++){
//            BloodTransferCenter::factory()->create();
//        }
        $totalToSeed = 80; // number of records to seed
        $seeded = 0; // number of records already seeded

        while ($seeded < $totalToSeed) {
            try {
                BloodStock::factory()->create();
                $seeded++;
            } catch (\Exception $e) {
                // exception occurred, do nothing and try again
            }
        }
//        BloodStock::factory(70)->create();

        Donor::factory(50)->create();
        Client::factory(50)->create();
        BloodDonation::factory(80)->create();
        BloodRequest::factory(80)->create();
    }

}
