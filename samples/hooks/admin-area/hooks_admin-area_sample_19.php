<?php

// EXAMPLE SERVICE CLASS ONLY; NOT VALID FOR PRODUCTION
class MyAuthService
{
    public static function getAdminHash($adminUniqueId)
    {
        $hashes = [
            'admin@localhost.local' => '$2y$10$VKrc/52lKfl1FZWFTsmUpeORk18adQAulXlv634q6wkMseBDGbilO'
        ];

        if (array_key_exists($adminUniqueId, $hashes)) {
            return $hashes[$adminUniqueId];
        }

        return null;
    }
}

add_hook(
    'AuthAdmin',
    0,
    function ($userInput, WHMCS\User\Admin $admin) {
        $adminUniqueId = $admin->email;
        $adminHash = MyAuthService::getAdminHash($adminUniqueId);
        if (!$adminHash) {
            return false;
        }

        return password_verify($userInput, $adminHash);
    }
);