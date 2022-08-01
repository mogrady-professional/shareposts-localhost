<?php
	/* 
     *  PDO DATABASE CLASS
   	 *  Connects Database Using PDO
	 *  Creates Prepeared Statements
	 * 	Binds params to values
	 *  Returns rows and results
   */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $databaseHandler;
    private $statement;
    private $error;

    // 1. Make Connection, 2. Make Query, 3. Bind Values, 4. Execute

    // Connect to the database
    public function __construct()
    {
        // Constructor for PDO -> Check PDO Documentation
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->databaseHandler = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Write queries
    // Prepare statement with query
    public function query($sql)
    {
        $this->statement = $this->databaseHandler->prepare($sql);
    }

    // Bind values -> https://www.php.net/manual/en/pdostatement.bindvalue.php
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    // Test if value is integer
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    // Test if value is boolean
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    // Test if value is null
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    // Default is string
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->statement->execute();
    }

    // Get result set as (array of objects)
    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object (single row)
    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount()
    {
        return $this->statement->rowCount();
    }


}