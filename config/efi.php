<?php

return [
    'sandbox' => env('EFI_SANDBOX', true),

    'client_id' => env(env('EFI_SANDBOX', true)
        ? 'EFI_SANDBOX_CLIENT_ID'
        : 'EFI_CLIENT_ID'),

    'client_secret' => env(env('EFI_SANDBOX', true)
        ? 'EFI_SANDBOX_CLIENT_SECRET'
        : 'EFI_CLIENT_SECRET'),

    'certificate_p12' => storage_path('app/' . env('EFI_CERT_P12')),
    'pix_key' => env('EFI_PIX_KEY'),
];

