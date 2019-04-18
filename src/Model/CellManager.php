<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class CellManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'cell';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $cell
     * @return int
     */
    public function insert(array $cell): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`x`,`y`,`map_id`) VALUES (:x, :y, :map_id)");
        $statement->bindValue('x', $cell['x'], \PDO::PARAM_INT);
        $statement->bindValue('y', $cell['y'], \PDO::PARAM_INT);
        $statement->bindValue('map_id', $cell['map_id'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $cell
     * @return bool
     */
    public function update(array $cell):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $cell['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $cell['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * @return bool
     */
    public function deleteAll():bool
    {
        $statement = $this->pdo->prepare("TRUNCATE $this->table");
        $statement->execute();

        return $statement->execute();
    }
}