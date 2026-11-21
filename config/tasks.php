<?php

return [
    'completion_recipient' => env(
        'TASK_COMPLETION_EMAIL',
        env('MAIL_FROM_ADDRESS', 'admin@example.com')
    ),
];