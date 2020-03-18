<?php

class QueryBuilder
{
    protected $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
    }
    
    public function selectAll($table)
    {
        $statement=$this->pdo->prepare("select * from {$table}");
        
        $statement->execute();
        
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function insert($table,$params)
    {
        $keys=array_keys($params);
        
        
        $sql=sprintf(
            "insert into %s (%s) values (%s)",
            $table,
            implode(', ',$keys),
            ':'.implode(', :',$keys)
        );
        
        try {
            $statement=$this->pdo->prepare($sql);

            $statement->execute($params );
        } catch(PDOException $e) {
            exit("Woops...");
        }
    }
}