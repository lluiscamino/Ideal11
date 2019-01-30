<?php
namespace api\objects;


class Team {
    private $conn;

    private $id;
    private $code;
    private $name;
    private $countryCode;
    private $logo;
    private $shirt;

    public function __construct(\mysqli $mysqli, int $id) {
        $this->conn = $mysqli;
        $this->id = $id;
        if ($this->exists()) {
            $this->setProperties();
        } else {
            throw new \Exception('Team does not exist.');
        }
    }

    private function exists(): bool {
        if ($stmt = $this->conn->prepare('SELECT id FROM teams WHERE id = ?')) {
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->num_rows;
            $stmt->close();
            return $numRows === 1;
        }
        throw new \Exception('SQL error.');
    }

    private function setProperties(): void {
        if ($stmt = $this->conn->prepare('SELECT code, name, country_code, logo, shirt FROM teams WHERE id = ? LIMIT 1')) {
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $stmt->bind_result($this->code, $this->name, $this->countryCode, $this->logo, $this->shirt);
            $stmt->fetch();
            $stmt->close();
        } else {
            throw new \Exception('SQL error.');
        }
    }

    public function toArray(): array {
        return array('id' => $this->id, 'code' => $this->code, 'name' => $this->name, 'countryCode' => $this->countryCode, 'logo' => $this->logo, 'shirt' => $this->shirt);
    }

    public function toJSON(): string {
        return json_encode($this->toArray());
    }

    public function getName(): string {
        return $this->name;
    }

    public static function listOfTeams(\mysqli $mysqli, string $countryCode): array {
        if (strlen($countryCode) !== 2) {
            throw new \Exception('Invalid country code.');
        }
        if ($stmt = $mysqli->prepare('SELECT id, country_code FROM teams WHERE country_code = ?')) {
            $stmt->bind_param('s', $countryCode);
            $stmt->execute();
            $result = $stmt->get_result();
            $teams = array();
            while ($row = $result->fetch_assoc())
            {
                $teams[] = new Team($mysqli, $row['id']);
            }
            return $teams;
        }
        throw new \Exception('SQL error.');
    }
}