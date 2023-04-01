<?php

namespace LogicLeap\SasinduPharmacy\models;

use PDO;

class Payments extends DbModel
{
    public const TABLE_NAME = 'payments';

    public static function getPayments(int $startingIndex, int $limitItems): bool|array
    {
        $statement = self::getDataFromTable(['*'], self::TABLE_NAME, appendToEndSql: "ORDER BY id DESC");
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $rows = count($data);
        $data = array_slice($data, $startingIndex, $limitItems);
        return [
            'data' => $data,
            'number-of-rows' => $rows];
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