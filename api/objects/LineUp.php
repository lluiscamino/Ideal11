<?php
namespace api\objects;

/**
 * TODO: Delete getters?
 *
 */
class LineUp {

    const MAX_LINEUPS_LOOP = 500;

    private static $numLineUps;

    private $conn;

    private $id;
    private $author;
    private $team;
    private $style;
    private $code;
    private $likes;
    private $dislikes;
    private $creationDate;
    private $lastModificationDate;

    public function __construct(\mysqli $mysqli, int $id) {
        $this->id = $id;
        $this->conn = $mysqli;
        if ($this->exists()) {
            $this->setProperties();
        } else {
            throw new \Exception('LineUp does not exist.');
        }
    }

    private function exists(): bool {
        if ($stmt = $this->conn->prepare('SELECT id FROM lineups WHERE id = ?')) {
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->num_rows;
            $stmt->close();
            return $numRows === 1;
        }
    }

    private function setProperties(): void {
        if ($stmt = $this->conn->prepare('SELECT author, team, style, code, likes, dislikes, creation_date, last_modification_date FROM lineups WHERE id = ? LIMIT 1')) {
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
            $stmt->bind_result($this->author, $this->team, $this->style, $this->code, $this->likes, $this->dislikes, $this->creationDate, $this->lastModificationDate);
            $stmt->fetch();
            $stmt->close();
        }
    }

    private static function setNumLineUps(\mysqli $mysqli): void {
        $result = $mysqli->query('SELECT id FROM lineups');
        self::$numLineUps = $result->num_rows;
    }

    public function toArray(): array {
        return array('id' => $this->getId(), 'author' => $this->getAuthor(), 'team' => $this->getTeam(), 'style' => $this->getStyle(), 'code' => $this->getCode(), 'likes' => $this->getLikes(), 'dislikes' => $this->getDislikes(), 'creationDate' => $this->getCreationDate(), 'lastModificationDate' => $this->getLastModificationDate());
    }

    public function toJSON(): string {
        return json_encode($this->toArray());
    }

    public function update(int $newTeam, int $newStyle, string $newCode): bool {
        $style = new FormationStyle($this->conn, $newStyle);
        if ($stmt = $this->conn->prepare('UPDATE lineups SET team = ?, style = ?, code = ?, last_modification_date = NOW() WHERE id = ?')) {
            $stmt->bind_param('iisi', $newTeam, $newStyle, $newCode, $this->id);
            return $stmt->execute();
        }
        throw new \Exception('SQL error.');
    }

    public function delete(): bool {
        $user = new User($this->conn, $this->author);
        if ($stmt = $this->conn->prepare('DELETE FROM lineups WHERE id = ?')) {
            $user->decreaseNumLineUps();
            $stmt->bind_param('i', $this->id);
            return $stmt->execute();
        }
        throw new \Exception('SQL error.');
    }

    public function getId(): int {
        return $this->id;
    }

    public function getAuthor(): string {
        $author = new User($this->conn, $this->author);
        return $author->getNickname();
    }

    public function getTeam(): string {
        $team = new Team($this->conn, $this->team);
        return $team->getName();
    }

    public function getStyle(): string {
        $style = new FormationStyle($this->conn, $this->style);
        return $style->getTitle();
    }

    public function getCode(): string {
        return $this->code;
    }

    public function getLikes(): int {
        return $this->likes;
    }

    public function getDislikes(): int {
        return $this->dislikes;
    }

    public function getCreationDate(): string {
        return $this->creationDate;
    }

    public function getLastModificationDate(): string {
        return $this->lastModificationDate;
    }

    public static function getNumLineUps(\mysqli $mysqli): int {
        self::setNumLineUps($mysqli);
        return self::$numLineUps;
    }

    public static function create(\mysqli $mysqli, int $author, int $team, int $style, string $code): int {
        $user = new User($mysqli, $author);
        if ($stmt = $mysqli->prepare('INSERT INTO lineups (author, team, style, code, creation_date) VALUES (?, ?, ?, ?, NOW())')) {
            $user->increaseNumLineUps();
            $stmt->bind_param('iiis', $author, $team, $style, $code);
            if ($stmt->execute()) {
                return $stmt->insert_id;
            }
        }
        throw new \Exception('SQL error.');
    }

    /*
     * $orderBy:
     * 0: id
     * 1: team
     * 2: likes
     */
    public static function listOfLineUps(\mysqli $mysqli, int $limit = self::MAX_LINEUPS_LOOP, int $offSet = 0, int $orderBy = 0, string $direction = 'DESC', string $author = '', int $team, string $style): array {
        $direction = strtoupper($direction);
        if ($direction !== 'ASC' && $direction !== 'DESC') {
            throw new \Exception('Direction must be ASC or DESC.');
        }
        switch($orderBy) {
            case 0:
                $orderBy = 'id';
                break;
            case 1:
                $orderBy = 'team';
                break;
            case 2:
                $orderBy = 'likes';
                break;
            default:
                throw new \Exception('$orderBy must be equal to 0, 1 or 2.');
        }
        $limit = $limit > self::MAX_LINEUPS_LOOP ? self::MAX_LINEUPS_LOOP : $limit;
        $offSet = $offSet <= $limit ? $offSet : 0;
        $conditions = [];
        if ($author !== '') {
            $user = new User($mysqli, -1, $author);
            $conditions[] = 'author = ' . $user->getId();
        }
        if ($team !== 0) {
            $conditions[] = 'team = ' . $team;
        }
        if ($style !== '') {
            $style = new FormationStyle($mysqli, -1, $style);
            $conditions[] = 'style = ' . $style->getId();
        }
        $conditionString = '';
        foreach ($conditions as $i => $condition) {
            $conditionString .= $i == 0 ? 'WHERE ' . $condition : ' AND ' . $condition;
        }

        if ($stmt =  $mysqli->prepare('SELECT id FROM lineups '  . $conditionString . ' ORDER BY ' . $orderBy . ' ' . $direction . ' LIMIT ? OFFSET ?')) {
            $stmt->bind_param('ii', $limit, $offSet);
            $stmt->execute();
            $result = $stmt->get_result();
            $lineUps = array();
            while ($row = $result->fetch_assoc())
            {
                $lineUps[] = new LineUp($mysqli, $row['id']);
            }
            return $lineUps;
        }
        throw new \Exception('SQL error.');
    }
}

