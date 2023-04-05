<?php

namespace LogicLeap\SasinduPharmacy\models;

use DateTime;
use DateTimeZone;
use JetBrains\PhpStorm\ArrayShape;
use LogicLeap\SasinduPharmacy\core\Application;
use mysql_xdevapi\Statement;
use PDO;

class Stocks extends DbModel
{
    private const TABLE_NAME = 'medicines';

    /**
     * Get details about items.
     * @param int $startingIndex Starting index of array to return results.
     * @param int $limitItems Number of results to return starting at starting Index.
     * @param string $productName Name of the product to filter results.
     * @param float $productPrice Price of the product to filter results.
     * @param int $productCompanyId Id of the company to filter results.
     * @return array Returns an array of ['data' => data, 'number-of-rows' => no. of rows];
     */
    #[ArrayShape(['data' => "array", 'number-of-rows' => "int"])]
    public static function getItems(int $startingIndex, int $limitItems, string $productName = '', float $productPrice = -1,
                                    int $productCompanyId = -1): array
    {
        $sql = "SELECT * FROM " . self::TABLE_NAME;
        $filters = [];
        if (!empty($productName)) {
            $productName = "%$productName%";
            $filters[] = " name LIKE :productName";
        }
        if ($productCompanyId != -1) {
            $filters[] = " supplier_id LIKE '$productCompanyId%'";
        }
        if ($productPrice != -1) {
            $priceMin = $productPrice - 100;
            $priceMax = $productPrice + 100;
            $filters[] = " retail_price > $priceMin AND retail_price < $priceMax";
        }
        if (!empty($filters)) {
            $sql .= " WHERE" . implode(' AND', $filters);
        }

        $sql .= " ORDER BY id DESC";
        $statement = self::prepare($sql);
        if (!empty($productName))
            $statement->bindValue(':productName', $productName);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $rows = count($data);
        $data = array_slice($data, $startingIndex, $limitItems);
        return [
            'data' => $data,
            'number-of-rows' => $rows];
    }

    public static function addItem(string $productName, int $productAmount, string $buyingDate,
                                   string $expireDate, int $supplierId, float $price): bool
    {
        $params = [
            'name' => $productName,
            'quantity' => $productAmount,
            'buy_date' => $buyingDate,
            'exp_date' => $expireDate,
            'retail_price' => $price,
            'supplier_id' => $supplierId
        ];
        return self::insertIntoTable(self::TABLE_NAME, $params);
    }

    public static function updateItem(int    $productId, string $productName, int $productAmount, string $buyingDate,
                                      string $expireDate, int $supplierId, float $price): bool
    {
        if ($productId === -1)
            return false;
        $params = [
            'name' => $productName,
            'quantity' => $productAmount,
            'buy_date' => $buyingDate,
            'exp_date' => $expireDate,
            'retail_price' => $price,
            'supplier_id' => $supplierId
        ];
        return self::updateTableData(self::TABLE_NAME, $params, "id=$productId");
    }

    public static function deleteItem(int $productId): bool
    {
        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id=$productId";
        return self::exec($sql);
    }

    public static function getExpired(int $startingIndex, int $limitItems, string $productName = "",
                                      int $price = -1, int $supplierId = -1): array
    {
        $dateObj = new DateTime("now", new DateTimeZone('Asia/Colombo'));
        $today = $dateObj->format('Y-m-d');
        $sql = "Select * from " . self::TABLE_NAME . " where exp_date<='$today'";

        $filters = [];
        if (!empty($productName)) {
            $productName = "%$productName%";
            $filters[] = " name LIKE :productName";
        }
        if ($supplierId != -1) {
            $filters[] = " supplier_id LIKE '$supplierId%'";
        }
        if ($price != -1) {
            $priceMin = $price - 100;
            $priceMax = $price + 100;
            $filters[] = " retail_price > $priceMin AND retail_price < $priceMax";
        }
        if (!empty($filters)) {
            $sql .= ' AND ' . implode(' AND', $filters);
        }
        $sql .= " order by exp_date desc";

        $statement = self::prepare($sql);
        if (!empty($productName))
            $statement->bindValue(':productName', $productName);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $rows = count($data);
        $data = array_slice($data, $startingIndex, $limitItems);
        return [
            'data' => $data,
            'number-of-rows' => $rows];
    }

    public static function getSoonExpiring(int $startingIndex, int $limitItems, string $productName = "",
                                           int $price = -1, int $supplierId = -1): array
    {
        $dateObj = new DateTime("now", new DateTimeZone('Asia/Colombo'));
        $today = $dateObj->format('Y-m-d');
        $sql = "Select * from " . self::TABLE_NAME . " where exp_date>'$today'";

        $filters = [];
        if (!empty($productName)) {
            $productName = "%$productName%";
            $filters[] = " name LIKE :productName";
        }
        if ($supplierId != -1) {
            $filters[] = " supplier_id LIKE '$supplierId%'";
        }
        if ($price != -1) {
            $priceMin = $price - 100;
            $priceMax = $price + 100;
            $filters[] = " retail_price > $priceMin AND retail_price < $priceMax";
        }
        if (!empty($filters)) {
            $sql .= ' AND ' . implode(' AND', $filters);
        }
        $sql .= " order by exp_date";

        $statement = self::prepare($sql);
        if (!empty($productName))
            $statement->bindValue(':productName', $productName);
        $statement->execute();
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $rows = count($data);
        $data = array_slice($data, $startingIndex, $limitItems);
        return [
            'data' => $data,
            'number-of-rows' => $rows];
    }

    public static function getNumAbout2ExpireItems(): int
    {
        $dateObj = new DateTime("now", new DateTimeZone('Asia/Colombo'));
        $today = $dateObj->format('Y-m-d');
        $sql = "SELECT id FROM ".self::TABLE_NAME." WHERE exp_date>'$today'";
        $statement = Application::$app->db->pdo->query($sql);
        return $statement->rowCount();
    }

    public static function getStockValue():string{
        $sql = "SELECT quantity, retail_price FROM ".self::TABLE_NAME;
        $statement = Application::$app->db->pdo->query($sql);
        $value = 0;
        for ($i = 0; $i<$statement->rowCount(); $i++){
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $value += $row['quantity'] * $row['retail_price'];
        }
	$value = number_format($value, 2);
        return $value;
    }
}