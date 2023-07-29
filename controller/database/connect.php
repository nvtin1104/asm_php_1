<?php
class DatabaseConnection {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $connection;

    // Constructor to initialize the database connection parameters
    public function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    // Method to establish the database connection
    public function connect() {
        // Connect to MySQL
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Check the connection
        if ($this->connection->connect_errno) {
            die("Không thể kết nối database: " . $this->connection->connect_error);
        }

        // Set the character set to support Unicode
        $this->connection->set_charset("utf8mb4");
    }

    // Method to select the database
    public function selectDatabase() {
        if (!$this->connection->select_db($this->dbname)) {
            die("Không thể chọn database: " . $this->connection->error);
        }
    }

    // Method to get the database connection
    public function getConnection() {
        return $this->connection;
    }
}

// Usage example:
$host = 'localhost'; // Tên server, nếu dùng hosting free thì cần thay đổi
$dbname = 'asm_php_1'; // Tên của Database
$username = 'root'; // Tên sử dụng Database
$password = '1104'; // Mật khẩu của tên sử dụng Database

// Create a new database connection instance
$dbConnection = new DatabaseConnection($host, $dbname, $username, $password);

// Connect to the database
$dbConnection->connect();

// Select the database
$dbConnection->selectDatabase();

// Now you can use the database connection wherever needed
$mysqli = $dbConnection->getConnection();





?>
