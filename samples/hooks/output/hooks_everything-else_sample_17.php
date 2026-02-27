<?php

add_hook('NotificationPreSend', 1, function($vars) {

    $eventType = $vars['eventType'];
    $eventName = $vars['eventName'];
    $rule = $vars['rule'];
    $hookParameters = $vars['hookParameters'];
    $notification = $vars['notification'];

    // Perform additional conditional logic and throw the AbortNotification
    // exception to prevent the notification from sending.
    if ($eventType == 'Invoice'
        && $eventName == 'created'
        && (isset($hookParameters['invoiceid'])
            && $hookParameters['invoiceid'] > 1000)
    ) {
        throw new \WHMCS\Notification\Exception\AbortNotification();
    }

    // If allowing the notification to continue, you can manipulate the $notification
    // object using the interface, WHMCS\Notification\Contracts\NotificationInterface.
    $notification->setTitle('Override notification title');
    $notification->setMessage('Override notification message body');

});