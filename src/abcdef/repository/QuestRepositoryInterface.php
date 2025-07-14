<?php

declare(strict_types=1);

namespace abcdef\repository;

use abcdef\dto\QuestDTO;

interface QuestRepositoryInterface {

    /**
     * @param QuestDTO $quest
     * @return bool
     */
    public function save(QuestDTO $quest): bool;

    /**
     * @param string $quest
     * @return QuestDTO|null
     */
    public function get(string $quest): ?QuestDTO;

    /**
     * @param string $quest
     * @return bool
     */
    public function remove(string $quest): bool;

    /**
     * @return array
     */
    public function getAll(): array;

}