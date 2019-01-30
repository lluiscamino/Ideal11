<?php
namespace api\objects;

class User {

    private $conn;
    
    private $id;
    private $nickname;
    private $email;
    private $registerDate;
    private $lastLogin;
    private $numLineUps;
    private $avatar;
    private $vip;
    
    public function __construct(\mysqli $mysqli, int $id = -1, string $nickname = '') {
        $this->conn = $mysqli;
        $this->id = $id !== -1 ? $id : $this->findId($nickname);
        if ($this->exists()) {
            $this->setProperties();
        } else {
            throw new \Exception('User does not exist.');
        }
    }
    
    private function exists(): bool {
        if ($stmt = $this->conn->prepare('SELECT id FROM users WHERE id = ?')) {
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->num_rows;
            $stmt->close();
            return $numRows === 1;
        }
    }
    
    private function findId(string $nickname): int {
        if ($stmt = $this->conn->prepare('SELECT id FROM users WHERE nickname = ? LIMIT 1')) {
            $stmt->bind_param('s', $nickname);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows === 0) {
                return -1;
            }
            $stmt->bind_result($id);
            $stmt->fetch();
            $stmt->close();
            return $id;
        }
    }
    
    private function setProperties(): void {
        if ($stmt = $this->conn->prepare('SELECT nickname, email, register_date, last_login, num_lineups, avatar, vip FROM users WHERE id = ? LIMIT 1')) {
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $stmt->bind_result($this->nickname, $this->email, $this->registerDate, $this->lastLogin, $this->numLineUps, $this->avatar, $this->vip);
            $stmt->fetch();
            $stmt->close();
        }
    }
    
    public function toArray(): array {
        return array('nickname' => $this->nickname, 'email' => $this->email, 'registerDate' => $this->registerDate, 'lastLogin' => $this->lastLogin, 'numLineups' => $this->numLineUps, 'avatar' => $this->avatar, 'vip' => (bool) $this->vip);
    }
    
    public function toJSON(): string {
        return json_encode($this->toArray());
    }
    
    public function increaseNumLineUps(): bool {
        if ($stmt = $this->conn->prepare('UPDATE users SET num_lineups = ? WHERE id = ?')) {
            $this->numLineUps++;
            $stmt->bind_param('ii', $this->numLineUps, $this->id);
            return $stmt->execute();
        }
        throw new \Exception('SQL error.');
    }
    
    public function decreaseNumLineUps(): bool {
        if (($stmt = $this->conn->prepare('UPDATE users SET num_lineups = ? WHERE id = ?')) && ($this->numLineUps > 0)) {
            $this->numLineUps--;
            $stmt->bind_param('ii', $this->numLineUps, $this->id);
            return $stmt->execute();
        }
        throw new \Exception('SQL error.');
    }

    public function getId(): int {
        return $this->id;
    }
    
    public function getNickname(): string {
        return $this->nickname;
    }
}

