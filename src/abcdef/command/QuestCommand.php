<?php

declare(strict_types=1);

namespace abcdef\command;

use abcdef\command\form\QuestMenuForm;
use abcdef\service\QuestService;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class QuestCommand extends Command {

    public function __construct(private readonly QuestService $questService) {
        parent::__construct('quest', 'quest menu');
        $this->setPermission('quest.command');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$sender instanceof Player) {
            return true;
        }
        new QuestMenuForm($sender, $this->questService);
        return true;
    }
}