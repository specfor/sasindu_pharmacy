<?php

namespace LogicLeap\SasinduPharmacy\models;

use PDO;

class Payments extends DbModel
{
    public const TABLE_NAME = 'payments';

    public static function getPayments(): bool|array
    {
        $statement = self::getDataFromTable(['*'], self::TABLE_NAME, appendToEndSql: "ORDER BY id DESC");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addPayment(string $method, int $chequeNumber, float $amount, string $paymentDate, int $paidToId): bool
    {
        if ($chequeNumber <= 0)
            $chequeNumber = null;
        return self::insertIntoTable(self::TABLE_NAME, [
            'method' => $method,
            'cheque_number' => $chequeNumber,
            'amount' => $amount,
            'payment_date' => $paymentDate,
            'supplier_id' => $paidToId
        ]);
    }
}