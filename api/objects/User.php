<?php
namespace api\objects;

require ROOT . '/api/vendor/autoload.php';

use mysql_xdevapi\Exception;
use ZxcvbnPhp\Zxcvbn;

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
    
    public function __construct(\mysqli $mysqli, int $id = -1, string $nickname = '', string $email = '') {
        $this->conn = $mysqli;
        $this->id = $id !== -1 ? $id : $this->findId($nickname, $email);
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
    
    private function findId(string $nickname = '', string $email = ''): int {
        $key = $nickname !== '' ? 'nickname' :  'email';
        $value = $nickname !== '' ? $nickname : $email;
        if ($stmt = $this->conn->prepare('SELECT id FROM users WHERE ' . $key . ' = ? LIMIT 1')) {
            $stmt->bind_param('s', $value);
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

    public static function login(\mysqli $mysqli, string $emailOrNickname, string $password): string {
        if ($stmt = $mysqli->prepare('SELECT nickname, password FROM users WHERE nickname = ? OR email = ?')) {
            $stmt->bind_param('ss', $emailOrNickname, $emailOrNickname);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows === 0) {
                throw new \Exception('Incorrect credentials');;
            }
            $stmt->bind_result($nickname, $realPassword);
            $stmt->fetch();
            $stmt->close();
            if (password_verify($password, $realPassword)) {
                return $nickname;
            }
        }
        throw new \Exception('Incorrect credentials');
    }

    public static function create(\mysqli $mysqli, string $email, string $password, string $passwordAgain, string $nickname): string {
        $zxcvbn = new \ZxcvbnPhp\Zxcvbn();
        if ($password !== $passwordAgain) {
            throw new \Exception('Passwords do not match.');
        }
        if ($zxcvbn->passwordStrength($password)['score'] < 2) {
            throw new \Exception('Password is not secure.');
        }
        if (strlen($nickname) > 20) {
            throw new \Exception('Nickname is not valid.');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email is not valid.');
        }
        $validNickname = true;
        $validEmail = true;
        try {
            $userByNickname = new User($mysqli, -1, $nickname, '');
            $validNickname = false;
        } catch (\Exception $e) {}
        finally {
            if (!$validNickname) {
                throw new \Exception('Nickname already chosen.');
            }
            try {
                $userByEmail = new User($mysqli, -1, '', $email);
                $validEmail = false;
            } catch(\Exception $e) {}
            finally {
                if (!$validEmail) {
                    throw new \Exception('Email already chosen.');
                }
                $password = password_hash($password, PASSWORD_DEFAULT);
                unset($passwordAgain);
                if ($stmt = $mysqli->prepare('INSERT INTO users (nickname, email, password, register_date, last_login) VALUES (?, ?, ?, NOW(), NOW())')) {
                    $stmt->bind_param('sss', $nickname, $email, $password);
                    if ($stmt->execute()) {
                        $user = new User($mysqli, $stmt->insert_id);
                        return $user->getNickname();
                    }
                }
                throw new \Exception('SQL error.');
            }
        }
    }
}

