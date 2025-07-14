<?php

declare(strict_types=1);

namespace abcdef\command\form;

use abcdef\service\QuestService;
use com\formconstructor\form\CustomForm;
use com\formconstructor\form\element\custom\Input;
use com\formconstructor\form\element\custom\Slider;
use com\formconstructor\form\element\ElementType;
use com\formconstructor\form\response\CustomFormResponse;
use pocketmine\player\Player;

class CreateQuestForm extends CustomForm {

    public function __construct(Player $player, QuestService $service) {
        parent::__construct('Create quest');
        $this->addElement(ElementType::INPUT->name, new Input('Quest name:', 'kill 10 creepers'));
        $this->addElement(ElementType::INPUT->name, new Input('Block/Entity id:', 'dirt'));
        $this->addElement(ElementType::SLIDER->name, new Slider('Count:', 1, 500));
        $this->setHandler(function(Player $player, CustomFormResponse $response) use ($service): void {
            $questName = $response->getInput(ElementType::INPUT->name)->getValue();
            $questBlockId = $response->getInput(ElementType::INPUT->name)->getValue();
            $questCount = $response->getInput(ElementType::SLIDER->name)->getValue() ?? 0;
            if ($service->createQuest($questName, [
                'id' => $questBlockId,
                'count' => $questCount,
            ])) {
                $player->sendMessage('The quest was successfully created');
            }
        });
        $this->send($player);;
    }
}