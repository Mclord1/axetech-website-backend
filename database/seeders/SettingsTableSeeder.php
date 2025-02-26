<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Company Information
            [
                'key' => 'company_name',
                'value' => 'AxeTech Innovations',
                'group' => 'company',
                'type' => 'text',
                'label' => 'Company Name',
                'description' => 'The name of the company',
                'is_public' => true,
            ],
            [
                'key' => 'company_tagline',
                'value' => 'Innovative Software Solutions',
                'group' => 'company',
                'type' => 'text',
                'label' => 'Company Tagline',
                'description' => 'A short description of the company',
                'is_public' => true,
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'contact@axetech.io',
                'group' => 'contact',
                'type' => 'email',
                'label' => 'Contact Email',
                'description' => 'Primary contact email address',
                'is_public' => true,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1234567890',
                'group' => 'contact',
                'type' => 'tel',
                'label' => 'Contact Phone',
                'description' => 'Primary contact phone number',
                'is_public' => true,
            ],
            [
                'key' => 'contact_address',
                'value' => '123 Tech Street, Innovation City, TC 12345',
                'group' => 'contact',
                'type' => 'textarea',
                'label' => 'Office Address',
                'description' => 'Physical office address',
                'is_public' => true,
            ],

            // Social Media Links
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/axetech',
                'group' => 'social',
                'type' => 'url',
                'label' => 'LinkedIn Profile',
                'description' => 'Company LinkedIn profile URL',
                'is_public' => true,
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/axetech',
                'group' => 'social',
                'type' => 'url',
                'label' => 'Twitter Profile',
                'description' => 'Company Twitter profile URL',
                'is_public' => true,
            ],
            [
                'key' => 'social_github',
                'value' => 'https://github.com/axetech',
                'group' => 'social',
                'type' => 'url',
                'label' => 'GitHub Profile',
                'description' => 'Company GitHub profile URL',
                'is_public' => true,
            ],

            // Business Hours
            [
                'key' => 'business_hours',
                'value' => 'Monday - Friday: 9:00 AM - 6:00 PM EST',
                'group' => 'contact',
                'type' => 'text',
                'label' => 'Business Hours',
                'description' => 'Company operating hours',
                'is_public' => true,
            ],

            // Contact Form Settings
            [
                'key' => 'contact_form_recipients',
                'value' => 'admin@axetech.io,support@axetech.io',
                'group' => 'contact',
                'type' => 'text',
                'label' => 'Contact Form Recipients',
                'description' => 'Email addresses that receive contact form submissions',
                'is_public' => false,
            ],
            [
                'key' => 'contact_form_subjects',
                'value' => json_encode([
                    'General Inquiry',
                    'Project Discussion',
                    'Partnership Opportunity',
                    'Career Information',
                    'Support Request'
                ]),
                'group' => 'contact',
                'type' => 'select',
                'label' => 'Contact Form Subjects',
                'description' => 'Available subjects for the contact form',
                'options' => json_encode([
                    'General Inquiry',
                    'Project Discussion',
                    'Partnership Opportunity',
                    'Career Information',
                    'Support Request'
                ]),
                'is_public' => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
