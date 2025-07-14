<?php

declare(strict_types=1);

namespace abcdef\command\form;

use abcdef\service\QuestService;
use com\formconstructor\form\element\simple\Button;
use com\formconstructor\form\SimpleForm;
use pocketmine\player\Player;

class QuestListForm extends SimpleForm {

    public function __construct(Player $player, QuestService $service) {
        parent::__construct('Quests', 'Quests list');
        foreach ($service->getAllQuests() as $quest) {
            $data = $service->getQuestInfo((array)$quest['data']);
            $this->addButton(new Button('Name: '. $quest['name']));
        }
        $this->addButton(new Button('Exit', function (Player $player): void {
            new QuestMenuForm($player);
        }));
        $this->send($player);
    }
}