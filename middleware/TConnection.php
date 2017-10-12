<?php

class TConnection {

    private static $_instance;
    private $mysql_connection;

    const MYSQL_DB = 'mysql:host=localhost;dbname=INFORMATION_SCHEMA;charset=UTF8';
    const MYSQL_DB_NAME = 'hotger';
    const MYSQL_USER = 'mysql';
    const MYSQL_PASSWORD = 'mysql';

    private function __construct() {
        $this->mysql_connection = new \PDO(self::MYSQL_DB, self::MYSQL_USER, self::MYSQL_PASSWORD);
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function CHECK_SCHEMA_FOR_EXIST($schema_name = self::MYSQL_DB_NAME) {
        $query = "SHOW DATABASES LIKE '{$schema_name}';";

        foreach ($this->mysql_connection->query($query) as $row) {
            $result[] = $row;
        }

        return $result;
    }

    public function CREATE_SCHEMA($schema_name = self::MYSQL_DB_NAME) {
        $query = "CREATE SCHEMA `{$schema_name}` DEFAULT CHARACTER SET utf8 ;";
        $this->mysql_connection->query($query);

        return true;
    }

    public function CREATE_TABLE($table_name, $schema_name = self::MYSQL_DB_NAME) {
        switch ($table_name) {
            case 'clients':
                $query = "CREATE TABLE `{$schema_name}`.`{$table_name}` (
                            `cid` INT NOT NULL AUTO_INCREMENT,
                            `lname` VARCHAR(45) CHARACTER SET 'utf8' NOT NULL,
                            `fname` VARCHAR(45) CHARACTER SET 'utf8' NULL,
                            `mname` VARCHAR(45) CHARACTER SET 'utf8' NULL,
                            PRIMARY KEY (`cid`),
                            UNIQUE INDEX `cid_UNIQUE` (`cid` ASC))
                          ENGINE = InnoDB
                          DEFAULT CHARACTER SET = utf8;";
                break;

            case 'setup_phone':
                $query = "CREATE TABLE `{$schema_name}`.`{$table_name}` (
                            `id` INT NOT NULL AUTO_INCREMENT,
                            `cid` INT NOT NULL,
                            `phone` BIGINT NOT NULL,
                            `remark` TEXT CHARACTER SET 'utf8' NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE INDEX `id_UNIQUE` (`id` ASC))
                          ENGINE = InnoDB
                          DEFAULT CHARACTER SET = utf8;";
                break;

            default:
                break;
        }

        $this->mysql_connection->query($query);

        return true;
    }

    public function INSERT_DATA_TABLE($table_name, $data, $schema_name = self::MYSQL_DB_NAME) {
        $str_ins = explode("\r\n", $data);

        foreach ($str_ins as $values) {
            $value = explode(",", $values);
            $data_ins = '';
            foreach ($value as $val) {
                $val = trim($val);
                $data_ins .= "'{$val}', ";
            }
            $data_ins = trim($data_ins, ' ,,');

            $query = "INSERT INTO `{$schema_name}`.`{$table_name}` VALUES ({$data_ins});";
            $this->mysql_connection->query($query);
        }

        return true;
    }

    public function FREE_SQL() {
        $query = "  SELECT c.cid
                     ,TRIM( CONCAT( c.lname, ' ', c.fname, ' ', c.mname ) ) AS fio
                     ,sp.phone
                     ,sp.remark
                        FROM hotger.clients c
                                JOIN hotger.setup_phone sp USING(cid)
                    ORDER BY fio;";
        foreach ($this->mysql_connection->query($query) as $row) {
            $result[] = $row;
        }

        return $result;
    }

    public function INSERT_DATA_SQL($data, $schema_name = self::MYSQL_DB_NAME) {
        if (!empty($data['client'])) {
            $query = "INSERT INTO {$schema_name}.clients(lname, fname, mname) VALUES('{$data['client']['lname']}', '{$data['client']['fname']}', '{$data['client']['mname']}');";

            $sth = $this->mysql_connection->prepare($query);

            try {
                $this->mysql_connection->beginTransaction();
                $sth->execute();
                $this->mysql_connection->commit();
//                $cid = $this->mysql_connection->lastInsertId();
            } catch (Exception $e) {
                $this->mysql_connection->rollback();
                print "Error!: " . $e->getMessage() . "</br>";
            }

            unset($data['client']);
            $query = "SELECT MAX(cid) cid FROM {$schema_name}.clients";
            foreach ($this->mysql_connection->query($query) as $row) {
                $data['phone']['cid'] = $row['cid'];
            }

            $this->INSERT_DATA_SQL($data);
        } elseif (!empty($data['phone'])) {
            $query = "INSERT INTO {$schema_name}.setup_phone(cid, phone, remark) VALUES('{$data['phone']['cid']}', '{$data['phone']['phone']}', '{$data['phone']['remark']}');";

            $sth = $this->mysql_connection->prepare($query);

            try {
                $this->mysql_connection->beginTransaction();
                $sth->execute();
                $this->mysql_connection->commit();
            } catch (Exception $e) {
                $this->mysql_connection->rollback();
                print "Error!: " . $e->getMessage() . "</br>";
            }
        }

        return true;
    }

    public function UPDATE_DATA_SQL($data, $table_name, $schema_name = self::MYSQL_DB_NAME) {
        $query = "UPDATE {$schema_name}.{$table_name} set {$data['field']} = '{$data['value']}' WHERE cid = {$data['cid']};";

        $sth = $this->mysql_connection->prepare($query);

        try {
            $this->mysql_connection->beginTransaction();
            $sth->execute();
            $this->mysql_connection->commit();
        } catch (Exception $e) {
            $this->mysql_connection->rollback();
            print "Error!: " . $e->getMessage() . "</br>";
        }

        return true;
    }

}
