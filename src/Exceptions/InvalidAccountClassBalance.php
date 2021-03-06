<?php
/**
 * Eloquent IFRS Accounting
 *
 * @author    Edward Mungai
 * @copyright Edward Mungai, 2020, Germany
 * @license   MIT
 */
namespace IFRS\Exceptions;

class InvalidAccountClassBalance extends IFRSException
{
    /**
     * Wrong Account Class Balance Exception
     *
     * @param string $message
     * @param int    $code
     */
    public function __construct(string $message = null, int $code = null)
    {
        parent::__construct(_("Income Statement Accounts cannot have Opening Balances ").$message, $code);
    }
}
