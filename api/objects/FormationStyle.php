<?php
namespace api\objects;

/**
 * TODO: delete getters?
 *
 */
class FormationStyle {
    
    const MAX_STYLES_LOOP = 20;

    private $conn;
    
    private $id;
    private $title;
    private $code;
    private $numLineUps;
    
    public function __construct(\mysqli $mysqli, int $id = -1, string $title = '') {
        $this->conn = $mysqli;
        $this->id = $id !== -1 ? $id : $this->findId($title);
        if ($this->exists()) {
            $this->setProperties();
        } else {
            throw new \Exception('Style does not exist.');
        }
    }
    
    private function exists(): bool {
        if ($stmt = $this->conn->prepare('SELECT id FROM styles WHERE id = ?')) {
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->num_rows;
            $stmt->close();
            return  $numRows === 1;
        }
    }
    
    private function findId(string $title): int {
        if ($stmt = $this->conn->prepare('SELECT id FROM styles WHERE title = ? LIMIT 1')) {
            $stmt->bind_param('s', $title);
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
        if ($stmt = $this->conn->prepare('SELECT title, code, numLineUps FROM styles WHERE id = ? LIMIT 1')) {
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $stmt->bind_result($this->title, $this->code, $this->numLineUps);
            $stmt->fetch();
            $stmt->close();
        }
    }
    
    public function toArray(): array {
        return array('id' => $this->getId(), 'title' => $this->getTitle(), 'code' => $this->getCode(), 'numLineUps' => $this->getNumLineUps());
    }
    
    public function toJSON(): string {
        return json_encode($this->toArray());
    }

    public function getId(): int {
        return $this->id;
    }
    
    public function getTitle(): string {
        return $this->title;
    }
    
    public function getCode(): string {
        return $this->code;
    }
    
    public function getNumLineUps(): int {
        return $this->numLineUps;
    }

    /*
     * $orderBy:
     * 0: id
     * 1: numLineUps
     */
    public static function listOfStyles(\mysqli $mysqli, int $limit = self::MAX_STYLES_LOOP, int $offSet = 0, int $orderBy = 0, string $direction = 'DESC'): array {
        $direction = strtoupper($direction);
        if ($direction !== 'ASC' && $direction !== 'DESC') {
            throw new \Exception('Direction must be ASC or DESC.');
        }
        switch($orderBy) {
            case 0:
                $orderBy = 'id';
                break;
            case 1:
                $orderBy = 'numLineUps';
                break;
            default:
                throw new \Exception('$orderBy must be equal to 0, 1 or 2.');
        }
        $limit = $limit > self::MAX_STYLES_LOOP ? self::MAX_STYLES_LOOP : $limit;
        $offSet = $offSet <= $limit ? $offSet : 0;
        if ($stmt =  $mysqli->prepare('SELECT id FROM styles ORDER BY ' . $orderBy . ' ' . $direction . ' LIMIT ? OFFSET ?')) {
            $stmt->bind_param('ii', $limit, $offSet);
            $stmt->execute();
            $result = $stmt->get_result();
            $styles = array();
            while ($row = $result->fetch_assoc())
            {
                $styles[] = new FormationStyle($mysqli, $row['id']);
            }
            return $styles;
        }
        throw new \Exception('SQL error.');
    }
}

