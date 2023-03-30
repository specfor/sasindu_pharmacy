<?php

namespace LogicLeap\SasinduPharmacy\models;

use PDO;

class Suppliers extends DbModel
{
    private const TABLE_NAME = 'suppliers';

    public static function getAllSupplierDetails(): array
    {
        $statement = self::getDataFromTable(['*'], self::TABLE_NAME);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSupplierName(int $supplierId):string
    {
        $statement = self::getDataFromTable(['name'], self::TABLE_NAME, "id=$supplierId");
        return $statement->fetch(PDO::FETCH_ASSOC)['name'];
    }

    public static function getSupplierId(string $supplierName):string
    {
        $statement = self::getDataFromTable(['id'], self::TABLE_NAME, "name=:name",
            [':name'=>$supplierName]);
        return $statement->fetch(PDO::FETCH_ASSOC)['id'];
    }
}