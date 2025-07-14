<?php

declare(strict_types=1);

namespace abcdef\dto;

readonly class QuestDTO {

    public function __construct(
        public string $name,
        public ?array $data = null,
        public int $reward = 0,
    ) {}

    /**
     * @return array
     */
    public function toArray(): array {
        return [
            'name' => $this->name,
            'data' => $this->data,
            'reward' => $this->reward,
        ];
    }
}