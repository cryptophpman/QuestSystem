<?php

declare(strict_types=1);

namespace abcdef\dto;

readonly class QuestInfoDTO {

    public function __construct(
        public int $id,
        public int $count
    ) {}

    public function toArray(): array {
        return [
            'id' => $this->id,
            'count' => $this->count,
        ];
    }
}
