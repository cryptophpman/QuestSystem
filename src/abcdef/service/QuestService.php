<?php

declare(strict_types=1);

namespace abcdef\service;

use abcdef\dto\QuestDTO;
use abcdef\dto\QuestInfoDTO;
use abcdef\repository\QuestRepositoryInterface;

readonly class QuestService {

    public function __construct(
        private QuestRepositoryInterface $repository,
    ) {}

    /**
     * @param string $name
     * @param array|null $data
     * @param int $reward
     * @return bool
     */
    public function createQuest(string $name, ?array $data = null, int $reward = 0): bool {
        return $this->repository->save(new QuestDTO(
            name: $name,
            data: $data,
            reward: $reward
        ));
    }

    public function getQuestInfo(array $data): ?QuestInfoDTO {
        if (!isset($data['id']) && !isset($data['name'])) {
            throw new \LogicException('Отсутствуют параметры id и(или) count');
        }
        return new QuestInfoDTO(
            id: (int) $data['id'],
            count: (int) $data['count'],
        );
    }

    public function getAllQuests(): ?array {
        return $this->repository->getAll();
    }
}