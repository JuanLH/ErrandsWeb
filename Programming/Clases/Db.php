<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set("xdebug.var_display_max_children", -1);
ini_set("xdebug.var_display_max_data", -1);
ini_set("xdebug.var_display_max_depth", -1);
error_reporting(E_ALL);

    class DbPDO{
        private $host;
        private $password;
        private $dbname;
        private $port;
        private $username;
        private $conn;
        private $driverName;

        private $extensions= array("jpeg","png","gif","jpg");
        private $path="uploads/";

        public function __construct($driverName, $host, $port, $username, $password, $dbname) {
                $this->host = $host;
                $this->password = $password;
                $this->dbname = $dbname;
                $this->port = $port;
                $this->username = $username;
                $this->driverName = $driverName;
                $this->connect();
        }

        private function connect() {
            switch($this->driverName) {
                case 'sqlsrv':
                    $dsn = $this->driverName . ":Server=" . $this->host . ";Database=" . $this->dbname;
                    break;
                default:
                    $dsn = $this->driverName.':dbname='.$this->dbname.';host='.$this->host.'; port = '.$this->port.'';
            }

            try {
                $this->conn = new PDO($dsn, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
                return false;
            }

        }

        public function execSelect ($sql){
            return $this->conn->query($sql);
        }

        public function exec ($sql){
            return $this->conn->exec($sql);
        }

        public function closeConn(){
            $this->conn=null;
        }

        public function getConn(){
            return $this->conn;
        }

    }
?>
