<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Xendit\Xendit;

class XenditController extends Controller
{
    public function getListVa()
    {
        Xendit::setApiKey(config('xendit.apikey'));

        // $createVA = \Xendit\VirtualAccounts::create($params);
        // var_dump($createVA);
        $getVABank = \Xendit\VirtualAccounts::getVABanks();

        return response()->json([
            'data' => $getVABank,
        ])->setStatusCode('200');
    }

    public function createVa(Request $request)
    {
        Xendit::setApiKey(config('xendit.apikey'));

        $params = ['external_id' => \uniqid(),
            'bank_code' => $request->bank,
            'name' => $request->name,
            ];

        $createVA = \Xendit\VirtualAccounts::create($params);

        return response()->json([
            'data' => $createVA,
        ])->setStatusCode('200');
    }
}
