<?php

namespace App\Core\Database;

use Aura\SqlQuery\QueryFactory;

use App\Core\App;

use PDO;

class QueryBuilder
{
    protected $pdo;
    protected $query_factory;
    
    public function __construct(PDO $pdo,QueryFactory $query_factory)
    {
        $this->pdo=$pdo;
        $this->query_factory=$query_factory;
    }

    public function selectAll($table,$fetch)
    {
        $select=$this->query_factory->newSelect();

        $select->cols(['*']);

        $select->from($table);
        
        $statement=$this->pdo->prepare($select->getStatement());

        $statement->execute();

        return $statement->fetchAll($fetch);
    }

    public function insert($table,$params)
    {
        $insert=$this->query_factory->newInsert();
        
        $insert->into($table)
               ->cols($params);

        try {
            $statement=$this->pdo->prepare($insert->getStatement());

            $statement->execute($insert->getBindValues());
            
            $name=$insert->getLastInsertIdName('id');
            
            return $this->pdo->lastInsertId($name);
        } catch(PDOException $e) {
            exit("Woops...");
        }
    }

    public function selectByAttributes($table,$attributes,$fetch)
    {
        $select=$this->query_factory->newSelect();

        $select->cols(['*']);

        $select->from($table);

        $bind_values=[];
        foreach($attributes as $column=>$value) {
            $select->where("{$column} = :{$column}");
            $bind_values[$column]=$value;
        }

        $select->bindValues($bind_values);

        $statement=$this->pdo->prepare($select->getStatement());

        $statement->execute($select->getBindValues());

        return $statement->fetchAll($fetch);
    }
    
    public function selectByPK($table,$pk,$fetch)
    {
        $result=$this->selectByAttributes($table,$pk,$fetch);

        return count($result) ? array_shift($result) : null;
    }
}