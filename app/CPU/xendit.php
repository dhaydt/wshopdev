<?php

namespace App\CPU;

use Xendit\Xendit as XenditXendit;

class Xendit
{
    public static function getBank()
    {
        XenditXendit::setApiKey(config('xendit.apikey'));

        // $createVA = \Xendit\VirtualAccounts::create($params);
        // var_dump($createVA);
        $bank = \Xendit\VirtualAccounts::getVABanks();

        return $bank;
    }
}
