<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('technical')->table('tickets')->insert([
            [
                'subject' => 'Login Issue',
                'message' => 'My app crashes.',
            ],
            [
                'subject' => 'API Error',
                'message' => 'Receiving 500 error on API request.',
            ],
            [
                'subject' => 'UI Bug',
                'message' => 'The submit button does not work on mobile.',
            ],
        ],
        
    );
        DB::connection('billing')->table('tickets')->insert([
            ['subject' => 'billing amount incorect',
            'message' => 'extra charges credited',],
            
            ['subject' => 'Invoice not received', 'message' => 'I made the payment but didn’t get the invoice.'],
            ['subject' => 'Wrong plan charged', 'message' => 'I was charged for the premium plan but I only selected the basic one.'],
            ['subject' => 'Refund not processed', 'message' => 'I canceled my subscription but the refund hasn’t been issued yet.'],
            ['subject' => 'Duplicate payment', 'message' => 'My card was charged twice for the same month.'],
            ['subject' => 'Tax amount issue', 'message' => 'The tax calculation on my bill seems incorrect.'],
            

        ],);
        DB::connection('feedback')->table('tickets')->insert([
            ['subject' => 'Great support experience', 'message' => 'Your support team resolved my issue quickly. Thank you!'],
            ['subject' => 'UI is confusing', 'message' => 'It’s hard to find some options in the dashboard.'],
            ['subject' => 'Search feature', 'message' => 'Search results are not very accurate, please improve.'],
            ['subject' => 'Login issues', 'message' => 'The login page sometimes freezes.'],
            ['subject' => 'Mobile version', 'message' => 'The website isn’t very responsive on smaller screens.'],
        ],);
        DB::connection('general')->table('tickets')->insert([
            ['subject' => 'Partnership inquiry', 'message' => 'Do you offer affiliate or partner programs?'],
            ['subject' => 'Account creation help', 'message' => 'I need help setting up my company profile.'],
            ['subject' => 'Store location update', 'message' => 'How can I update my store address on the platform?'],
            ['subject' => 'Feature request', 'message' => 'It would be great if you added multi-user access.'],
            ['subject' => 'Language support', 'message' => 'Do you support languages other than English?'],
        ],);
    }
}
