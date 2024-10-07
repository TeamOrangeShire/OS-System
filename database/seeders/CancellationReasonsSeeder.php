<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CancellationReasons;

class CancellationReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            ['Unexpected Maintenance', 'The reserved office space requires urgent maintenance, making it temporarily unavailable.'],
            ['Safety or Security Concerns', 'A safety issue has been identified, and the office space must be closed for security reasons.'],
            ['Violation of House Rules', 'The reservation has been canceled due to a violation of our house rules.'],
            ['Health Concerns', 'A health risk has been detected, requiring the office space to be closed for sanitation.'],
            ['Payment Issues', 'The reservation has been canceled due to an issue with the payment for the booking.'],
            ['Space Reallocation', 'The reserved office space has been reassigned due to an urgent internal requirement.'],
            ['Misrepresentation of Use', 'The reservation has been canceled due to a discrepancy between the stated use and our terms of service.   '],
            ['Emergency Situation', 'An emergency such as a fire alarm or local evacuation requires the office space to be closed.'],
            ['Damage to Office Space', 'The office space has sustained damage during a previous use or event, making it unusable for subsequent reservations.'],
            ['Changes in Business Operations', 'Adjustments in our business operations have affected the availability of the reserved space.'],
        ];

        foreach($reasons as $reason){
            $cancel = new CancellationReasons();

            $cancel->reason_header = $reason[0];
            $cancel->reason_message = $reason[1];
            $cancel->save();
        }
    }
}
