<?php

declare(strict_types=1);

namespace abcdef\command\form;

use abcdef\service\QuestService;
use com\formconstructor\form\element\simple\Button;
use com\formconstructor\form\SimpleForm;
use pocketmine\player\Player;

class QuestMenuForm extends SimpleForm {

    public function __construct(Player $player, QuestService $service) {
        parent::__construct('Quests', 'Click the button to continue');
        $this->addButton(new Button('Quest list', function (Player $player) use ($service): void {
            new QuestListForm($player, $service);
        }));
        if ($player->hasPermission('quest-settings.command')) {
            $this->addButton(new Button('Settings', function (Player $player) use ($service): void {
                new QuestSettingsForm($player, $service);
            }));
        }
        $this->send($player);
    }
}