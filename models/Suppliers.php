<?php

namespace LogicLeap\SasinduPharmacy\models;

use PDO;

class Suppliers extends DbModel
{
    private const TABLE_NAME = 'suppliers';

    public static function getAllSupplierDetails(int $startingIndex, int $limitItems, string $supplierName = '', int $contactNumber = -1, string $medicalRef = ''): array
    {
        $sql = "SELECT * FROM " . self::TABLE_NAME;
        if ($supplierName || $contactNumber >= 0 || $medicalRef)
            $sql .= " WHERE ";
        $filters = [];
        if ($supplierName) {
            $supplierName = "%$supplierName%";
            $filters[] = "name LIKE :name";
        }
        if ($contactNumber >= 0) {
            $filters[] = "contact_number LIKE '%$contactNumber%'";
        }
        if ($medicalRef) {
            $filters[] = 'medical_ref LIKE :medical_ref';
            $medicalRef = "%$medicalRef%";
        }
        $sql .= implode(" AND ", $filters);
        $statement = self::prepare($sql);
        if ($supplierName)
            $statement->bindValue(':name', $supplierName);
        if ($medicalRef)
            $statement->bindValue(':medical_ref', $medicalRef);
        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $rows = count($data);
        $data = array_slice($data, $startingIndex, $limitItems);
        return [
            'data' => $data,
            'number-of-rows' => $rows];
    }

    public static function getSupplierName(int $supplierId): string
    {
        $statement = self::getDataFromTable(['name'], self::TABLE_NAME, "id=$supplierId");
        return $statement->fetch(PDO::FETCH_ASSOC)['name'];
    }

    public static function getSupplierId(string $supplierName): string
    {
        $statement = self::getDataFromTable(['id'], self::TABLE_NAME, "name=:name",
            [':name' => $supplierName]);
        return $statement->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public static function addSupplier(string $supplierName, string $medicalRef, int $contactNumber): bool
    {
        return self::insertIntoTable(self::TABLE_NAME,
            ['name' => $supplierName, 'medical_ref' => $medicalRef, 'contact_number' => $contactNumber]);
    }

    public static function removeSupplier(int $supplierId): bool
    {
        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id=$supplierId";
        if (self::exec($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateSupplier(int $supplierId, string $supplierName, string $medicalRef, int $contactNumber): bool
    {
        return self::updateTableData(self::TABLE_NAME,
            ['name' => $supplierName, 'medical_ref' => $medicalRef, 'contact_number' => $contactNumber], "id=$supplierId");
    }
}