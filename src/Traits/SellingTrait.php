<?php
/**
 * Laravel IFRS Accounting
 *
 * @author Edward Mungai
 * @copyright Edward Mungai, 2020, Germany
 * @license MIT
 */
namespace App\Traits;

use App\Models\Account;

use App\Exceptions\MainAccount;
use App\Exceptions\LineItemAccount;

trait Selling
{
    /**
     * Validate Selling Transaction Main Account.
     */
    public function save(): void
    {
        if (is_null($this->getAccount()) or $this->getAccount()->account_type != Account::RECEIVABLE) {
            throw new MainAccount(self::PREFIX, Account::RECEIVABLE);
        }

        $this->transaction->save();
    }

    /**
     * Validate Selling Transaction LineItems.
     */
    public function post(): void
    {
        $this->save();

        foreach ($this->getLineItems() as $lineItem) {
            if ($lineItem->account->account_type != Account::OPERATING_REVENUE) {
                throw new LineItemAccount(self::PREFIX, [Account::OPERATING_REVENUE]);
            }
        }

        $this->transaction->post();
    }
}
