<?php

namespace LogicLeap\SasinduPharmacy\models;

use DateTime;
use PDO;

class Payments extends DbModel
{
    public const TABLE_NAME = 'payments';

    public static function getPayments(int    $startingIndex, int $limitItems, string $bankName = '',
                                       string $paymentMethod = '', int $paidToId = -1, string $paidDate = ''): bool|array
    {
        $sql = "SELECT * FROM " . self::TABLE_NAME;
        $filters = [];
        if (!empty($bankName)) {
//            $bankName = "$bankName";
            $filters[] = " bank=:bankName";
        }
        if ($paidToId >= 0) {
            $filters[] = " supplier_id=$paidToId";
        }
        if ($paymentMethod) {
            $filters[] = " method=:paymentMethod";
        }
        if ($paidDate) {
            $filters[] = " payment_date=:paidDate";
            $dateObj = new DateTime($paidDate);
            $paidDate = $dateObj->format('Y-m-d');
            $paidDate = "$paidDate";
        }
        if (!empty($filters)) {
            $sql .= " WHERE" . implode(' AND', $filters);
        }
        $sql .= " ORDER BY id DESC";
        $statement = self::prepare($sql);
        if ($bankName) {
            $statement->bindValue(':bankName', $bankName);
        }
        if ($paymentMethod) {
            $statement->bindValue(':paymentMethod', $paymentMethod);
        }
        if ($paidDate) {
            $statement->bindValue(':paidDate', $paidDate);
        }
        $statement->execute();
        $rows =$statement->rowCount();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $data = array_slice($data, $startingIndex, $limitItems);
        return [
            'data' => $data,
            'number-of-rows' => $rows];
    }

    public static function addPayment(string $method, int $chequeNumber, string $bank, float $amount, string $paymentDate, int $paidToId): bool
    {
        if ($chequeNumber <= 0)
            $chequeNumber = null;
        return self::insertIntoTable(self::TABLE_NAME, [
            'method' => $method,
            'cheque_number' => $chequeNumber,
            'bank' => $bank,
            'amount' => $amount,
            'payment_date' => $paymentDate,
            'supplier_id' => $paidToId
        ]);
    }
}