<?php

return [
    'emailVerify' => [
        'subject' => 'Email verification',
        'line1' => 'Click on the button bellow to verify your e-mail address.',
        'title' => 'Verify your email address',
        'action' => 'Verify Email',
        'footerAction' => "if you have problems to click on button \":actionText\", copy and paste the url in your browser:"
    ],
    'resetPassword' => [
        'subject' => 'Password reset Notification',
        'line1' => 'You are receiving this email because we have received a password reset request for your account.',
        'title' => 'Redefine password',
        'action' => 'Redefine password',
        'expireMessage' => 'This message will expire in 60 minutes.',
        'noRequiredMessage' => 'If you have not requested a password reset, no further action is required.',
        'thankfully' => 'Best Regards,'
    ],
];
