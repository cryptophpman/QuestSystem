<?php

declare(strict_types=1);

namespace abcdef;

use abcdef\command\QuestCommand;
use abcdef\repository\QuestRepositoryInterface;
use abcdef\repository\SQLQuestRepository;
use abcdef\service\QuestService;
use pocketmine\plugin\PluginBase;

final class QuestSystem extends PluginBase {

    private QuestRepositoryInterface $questRepo;
    private QuestService $questService;

    public function onEnable(): void {
        $this->questRepo = new SQLQuestRepository($this->getDataFolder() .'quests.sql');
        $this->questService = new QuestService($this->questRepo);
        $this->getServer()->getCommandMap()->register('quest', new QuestCommand($this->questService));
    }

    public function getQuestRepo(): QuestRepositoryInterface {
        return $this->questRepo;
    }

    public function getQuestService(): QuestService {
        return $this->questService;
    }
}