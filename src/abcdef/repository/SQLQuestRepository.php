<?php

declare(strict_types=1);

namespace abcdef\repository;

use abcdef\dto\QuestDTO;

use const SQLITE3_ASSOC;

class SQLQuestRepository implements QuestRepositoryInterface {

    /** @var \SQLite3 */
    private \SQLite3 $database;

    public function __construct(string $file) {
        $this->database = new \SQLite3($file);
        $this->initDataBase();
    }

    private function initDataBase(): void {
        $this->database->exec("CREATE TABLE IF NOT EXISTS quests (
            name TEXT NOT NULL,
            data TEXT NOT NULL,
            reward INTEGER NOT NULL DEFAULT 0
        );");
    }

    public function save(QuestDTO $quest): bool {
        $stmt = $this->database->prepare("INSERT INTO quests (name, data, reward) VALUES (:name, :data, :reward)");
        $stmt->bindValue(':name', $quest->name);
        $stmt->bindValue(':data', $quest->data);
        $stmt->bindValue(':reward', $quest->reward);
        return $stmt->execute();
    }

    public function get(string $quest): ?QuestDTO {
        $stmt = $this->database->prepare("SELECT * FROM quests WHERE name = :name");
        $stmt->bindValue(':name', $quest);
        $result = $stmt->execute();
        return $result->fetchArray(SQLITE3_ASSOC)[$quest] ?? null;
    }

    public function remove(string $quest): bool {
        $stmt = $this->database->prepare("DELETE FROM quests WHERE name = :name");
        $stmt->bindValue(':name', $quest);
        return $stmt->execute();
    }

    public function getAll(): array {
        $result = $this->database->query("SELECT * FROM quests");
        return $result->fetchArray(SQLITE3_ASSOC);
    }
}