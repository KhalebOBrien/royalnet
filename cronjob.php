<?php

use App\Services\Helpers;
use App\Services\User;
use App\Services\Transaction;

require_once 'app/Services/Helpers.php';
require_once 'app/Services/User.php';
require_once 'app/Services/Transaction.php';

$user = new User();
$tranx = new Transaction();

// get all active members (not super/admin, approved, not suspended) with their package commission
$credibles = $user->fetchCreditableUsers();
if (!empty($credibles)) { // proceed if credibles exists
    foreach ($credibles as $member) {
        // calculate new balance
        $newBalance = intval($member['wallet_balance']) + intval($member['package_commission']);
        // update member wallet with new balance
        $tranx->addDailyCommissionToUserWallet($member['id'], intval($member['package_commission']), $newBalance);
    }
}

?>