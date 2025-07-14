<?php

declare(strict_types=1);

namespace abcdef\command\form;

use abcdef\service\QuestService;
use com\formconstructor\form\element\simple\Button;
use com\formconstructor\form\SimpleForm;
use pocketmine\player\Player;

class QuestSettingsForm extends SimpleForm {

    public function __construct(Player $player, QuestService $service) {
        parent::__construct('Quest settings', 'Click the button to continue');
        $this->addButton(new Button('Create new quest', function (Player $player) use ($service): void {
            new CreateQuestForm($player, $service);
        }));
        $this->addButton(new Button('Exit', function (Player $player): void {
            new QuestMenuForm($player);
        }));
        $this->send($player);
    }
}