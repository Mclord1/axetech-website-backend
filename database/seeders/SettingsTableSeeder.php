<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

class SettingsTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $settings = [
            // Company Settings
            [
                'key' => 'company_name',
                'value' => 'AxeTech Innovations',
                'group' => 'company',
                'type' => 'text',
                'label' => 'Company Name',
                'description' => 'The name of the company',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'company_description',
                'value' => 'Leading provider of innovative technology solutions',
                'group' => 'company',
                'type' => 'textarea',
                'label' => 'Company Description',
                'description' => 'A brief description of the company',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'company_logo',
                'value' => 'logo.png',
                'group' => 'company',
                'type' => 'file',
                'label' => 'Company Logo',
                'description' => 'The company logo image',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Contact Settings
            [
                'key' => 'contact_email',
                'value' => 'contact@axetech.com',
                'group' => 'contact',
                'type' => 'email',
                'label' => 'Contact Email',
                'description' => 'Primary contact email address',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1 234 567 8900',
                'group' => 'contact',
                'type' => 'text',
                'label' => 'Contact Phone',
                'description' => 'Primary contact phone number',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'contact_address',
                'value' => '123 Tech Street, Innovation City, TC 12345',
                'group' => 'contact',
                'type' => 'textarea',
                'label' => 'Contact Address',
                'description' => 'Company physical address',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Social Media Settings
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/axetech',
                'group' => 'social',
                'type' => 'url',
                'label' => 'Facebook URL',
                'description' => 'Facebook page URL',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/axetech',
                'group' => 'social',
                'type' => 'url',
                'label' => 'Twitter URL',
                'description' => 'Twitter profile URL',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/axetech',
                'group' => 'social',
                'type' => 'url',
                'label' => 'LinkedIn URL',
                'description' => 'LinkedIn company page URL',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Contact Form Settings
            [
                'key' => 'contact_form_enabled',
                'value' => 'true',
                'group' => 'contact_form',
                'type' => 'boolean',
                'label' => 'Enable Contact Form',
                'description' => 'Enable or disable the contact form',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'contact_form_recipients',
                'value' => 'support@axetech.com,info@axetech.com',
                'group' => 'contact_form',
                'type' => 'text',
                'label' => 'Contact Form Recipients',
                'description' => 'Email addresses to receive contact form submissions',
                'is_public' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'contact_form_success_message',
                'value' => 'Thank you for contacting us. We will get back to you soon!',
                'group' => 'contact_form',
                'type' => 'text',
                'label' => 'Success Message',
                'description' => 'Message shown after successful form submission',
                'is_public' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->safeRun('settings', $settings);
    }
}
