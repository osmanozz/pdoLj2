<?php
class Database {
    public $pdo;
    private string $userTable = "user";

    public function __construct(String $db="test", String $host="localhost", 
                                String $user="root", String $pass="") {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function insertUser(string $email, String $password) : string | false {
        $stmt = $this->pdo->prepare("INSERT INTO $this->userTable (email, password) values (?, ?)");
        $stmt->execute([$email, $password]);
        return $this->pdo->lastInsertId();
    }
    public function selectAllUsers() : array {
        $stmt = $this->pdo->query("SELECT * FROM $this->userTable");
        $result = $stmt->fetchAll();
        return $result; 
    }
    public function selectOneUser($id) : array {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->userTable WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }
    public function updateUser(string $email, String $password, int $id) {
        $stmt = $this->pdo->prepare("UPDATE $this->userTable SET email = ?, password = ? 
        WHERE id = ?");
        $stmt->execute([$email, $password, $id]);
    }
    public function deleteUser(int $id) {
        $stmt = $this->pdo->prepare("DELETE from $this->userTable WHERE id = ?");
        $stmt->execute([$id]);
    }
    public function aanmelden($naam, $achternaam, $geboortedatum, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO users (naam,achternaam,geboortedatum,email,wachtwoord) values (?,?,?,?,?)");
        $stmt->execute([$naam, $achternaam, $geboortedatum, $email, $password]);
    }
    public function upload($file) {
        $stmt = $this->pdo->prepare("INSERT INTO foto (photo) values (?)");
        $stmt->execute([$file]);
    }
    public function login($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users where email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }
}
?>
