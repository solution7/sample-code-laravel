<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Country;

class CountryISOImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:country_iso';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will update the country ISO codes for languages dependency';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $countries = Country::all();
      // AIzaSyAPFFAkUuNmG8QyZPjxAPQ4P2wdQVKVNsY  ,AIzaSyChhDKp4qGJoUu9lIip8uAxHv6okQ6qkEs

        $key = 'AIzaSyCEZByQu6NCwWVlIeY_kRs0hkGZNcr7lMc';
        if (count($countries)) {
            foreach ($countries as $country) {
                $check_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($country->name).
                '&language=en&key=' . $key . '&components=country:' . $country->iso;
                $test_result = file_get_contents($check_url);
                $test_result = json_decode($test_result);

                if ($test_result->status == 'OK') {
                    $found = false;
                    foreach ($test_result->results[0]->address_components as $result) {
                        if (in_array('country', $result->types) && in_array('political', $result->types)) {
                            $found = true;
                            $country->name = $result->long_name;
                            $country->iso = $result->short_name;
                            break;
                        }
                    }
                } else {
                    echo "something went wrong";
                }
                $country->save();
            }
        }
        echo 'ISO has been imported!' . PHP_EOL;
        return;
    }
}
