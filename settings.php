<?php

return [
    'invoice' => [
        'active_drivers' => [
            'virtual' => [],
            'behpardakht' => [
                'config' => [
                    'terminalId' => '',
                    'username' => '',
                    'password' => '',
                ]
            ],
        ]
    ],
    'sms' => [
        'driver' => 'kavenegar',
        'sender' => '1000596446',
        'api_key' => '4F68793747657139716358636C76546D45787135696F636D497A4156464E5175336D2B357064664F6837493D',
        'patterns' => [
            'new_deposit' => 'new-deposit',
        ],
        'new_order' => [
            'dont_send_full_name' => false
        ]
    ],
];
