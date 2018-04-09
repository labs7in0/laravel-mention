<?php

return [
    // Model that will be mentioned.
    'model' => App\User::class,

    // The column that will be used to search the model by the parser.
    'column' => 'name',

    // Match the front mentioned info
    'regex' => '/(\S*)\@([^\r\n\s]*)/i',

    // The route used to generate the user link.
    'route' => 'profile',

    // Output format, can be "bbcode", "html" or "markdown".
    'format' => 'markdown',

    // Notification class to use when the model is mentioned.
    // Leave null to disable notification.
    'notification' => App\Notifications\MentionNotification::class,
];
