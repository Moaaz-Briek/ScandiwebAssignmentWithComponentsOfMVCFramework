<?php

abstract class DbModel
{
    public string $tableName;

    public function __construct()
    {
        $this->tableName = $this->tableName();
    }

    public abstract function tableName(): string;

    public abstract function attributes(): array;

    public function save()
    {
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $this->tableName (".implode(',', $attributes).")VALUES (".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public function findOne(array $array)
    {
        $attribute = array_keys($array);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attribute));
        //SELECT * FROM $tableName WHERE $sql
        //SELECT * FROM $tableName WHERE sku =:sku
        $statement = self::prepare("SELECT * FROM $this->tableName WHERE $sql");
        foreach ($array as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public function findAll()
    {
        $statement = self::prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function delete(array $ids)
    {
        $ids = implode("','", $ids);
        $query = "DELETE FROM $this->tableName WHERE id IN ('".$ids."')";
        $statement = self::prepare($query);
        $statement->execute();
    }

    public static function prepare($query)
    {
        return Application::$app->Db->connection->prepare($query);
    }
}