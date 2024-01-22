<?php

namespace Database\Seeders;

use App\Core\Domain\Entities\Company\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'Amazon', 'description' => 'An American multinational technology company', 'address' => 'Seattle, Washington, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'AMZN'],
            ['name' => 'Apple', 'description' => 'An American multinational technology company', 'address' => 'Cupertino, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'AAPL'],
            ['name' => 'Microsoft', 'description' => 'An American multinational technology company', 'address' => 'Redmond, Washington, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'MSFT'],
            ['name' => 'Alphabet Inc. (Google)', 'description' => 'An American multinational conglomerate', 'address' => 'Mountain View, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'GOOGL'],
            ['name' => 'Facebook', 'description' => 'An American social media conglomerate', 'address' => 'Menlo Park, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'FB'],
            ['name' => 'Tesla', 'description' => 'An American electric vehicle and clean energy company', 'address' => 'Palo Alto, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'TSLA'],
            ['name' => 'Samsung', 'description' => 'A South Korean multinational conglomerate', 'address' => 'Seoul, South Korea', 'logo' => 'storage/logos/logo.jpg', 'symbol' => '005930'],
            ['name' => 'Intel', 'description' => 'An American multinational semiconductor and technology company', 'address' => 'Santa Clara, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'INTC'],
            ['name' => 'IBM', 'description' => 'An American multinational technology company', 'address' => 'Armonk, New York, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'IBM'],
            ['name' => 'Oracle', 'description' => 'An American multinational computer technology corporation', 'address' => 'Redwood City, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'ORCL'],
            ['name' => 'Sony', 'description' => 'A Japanese multinational conglomerate', 'address' => 'Tokyo, Japan', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'SONY'],
            ['name' => 'NVIDIA', 'description' => 'An American multinational technology company', 'address' => 'Santa Clara, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'NVDA'],
            ['name' => 'Cisco', 'description' => 'An American multinational technology conglomerate', 'address' => 'San Jose, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'CSCO'],
            ['name' => 'Adobe', 'description' => 'An American multinational software company', 'address' => 'San Jose, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'ADBE'],
            ['name' => 'Netflix', 'description' => 'An American subscription-based streaming service', 'address' => 'Los Gatos, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'NFLX'],
            ['name' => 'PayPal', 'description' => 'An American online payments system company', 'address' => 'San Jose, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'PYPL'],
            ['name' => 'Uber', 'description' => 'An American technology company', 'address' => 'San Francisco, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'UBER'],
            ['name' => 'Airbnb', 'description' => 'An American online marketplace and hospitality service', 'address' => 'San Francisco, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'ABNB'],
            ['name' => 'Twitter', 'description' => 'An American microblogging and social networking service', 'address' => 'San Francisco, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'TWTR'],
            ['name' => 'LinkedIn', 'description' => 'An American business and employment-oriented service', 'address' => 'Sunnyvale, California, United States', 'logo' => 'storage/logos/logo.jpg', 'symbol' => 'MSFT'],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
