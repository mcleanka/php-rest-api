<?php
    namespace Controller;
    
    use \PDO as PDO;
    use \PDOException as Exception;

    class Database {
        private $user = db_user;
        private $pass = db_pass;
        private $name = db_name;

        private $params = [];
        
        public $row = [];
        public $sqlObj = null;
        public $feedback = false;
        
        public static function load() : object {
            return new self;
        }

        public function db() : object {
            $user = $this->user;
            $pass = $this->pass;
            $name = $this->name;
            
            $db = new PDO("mysql:host=127.0.0.1;dbname=$name;charste=utf8", $user, $pass);

            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        }

        public function bind(array $params) : object {
            $this->params = $params;

            return $this;
        }

        public function query(string $qry) : object {
            $db = $this->db();
            $this->sqlObj = $db->prepare($qry);

            $this->feedback = $this->sqlObj->execute($this->params??null);

            return $this;
        }

        public function single() : object {
            $row = $this->sqlObj->fetch(PDO::FETCH_ASSOC);
            $this->row = json_decode(json_encode($row));
            return $this;
        }

        public function schema() : bool {
            $sql = 'create schema phprest;';
            $sql .= 'CREATE TABLE `phprest`.`categories` (
                `id` INT(11) NOT NULL,
                `name` VARCHAR(45) NOT NULL,
                `create_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                PRIMARY KEY (`id`));';
                
            $sql .= 'CREATE TABLE `phprest`.`posts` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `category_id` INT(11) NULL,
                `title` VARCHAR(45) NULL,
                `body` TEXT NULL,
                `author` VARCHAR(45) NULL,
                `create_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
                PRIMARY KEY (`id`));';
            
            // categories
            $sql .= "INSERT INTO `phprest`.`categories` (`id`, `name`) VALUES ('1', 'Technology');
            INSERT INTO `phprest`.`categories` (`id`, `name`) VALUES ('2', 'Gaming');
            INSERT INTO `phprest`.`categories` (`id`, `name`) VALUES ('3', 'Education');
            INSERT INTO `phprest`.`categories` (`id`, `name`) VALUES ('4', 'Auto');";
            
            // posts
            $sql .= "INSERT INTO `phprest`.`posts` (`id`, `category_id`, `title`, `body`, `author`) VALUES ('1', '1', 'Technology Post One', 'Duis aute irure dolor in reprehenderit in voluptate velit esse\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Mclean Kasambala');
            INSERT INTO `phprest`.`posts` (`id`, `category_id`, `title`, `body`, `author`) VALUES ('2', '2', 'Gaming Post One', 'Ut enim ad minim veniam,\n    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\n    consequat.', 'Mclean Kasambala');
            INSERT INTO `phprest`.`posts` (`id`, `category_id`, `title`, `body`, `author`) VALUES ('3', '1', 'Technology Post Two', 'Duis aute irure dolor in reprehenderit in voluptate velit esse\n    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\n    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Chigo Kaunda');
            INSERT INTO `phprest`.`posts` (`id`, `category_id`, `title`, `body`, `author`) VALUES ('4', '4', 'Technology Post Three', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\n    tempor incididunt ut labore et dolore magna aliqua.', 'Mclean Kasambala');
            ";

            return $this->query($sql)->feedback; 
        }
    }