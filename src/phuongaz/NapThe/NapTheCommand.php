<?php

namespace phuongaz\NapThe;

use pocketmine\command\{Command, CommandSender};
use pocketmine\Player;
use phuongaz\NapThe\form\CardStatusForm;

Class NapTheCommand extends Command{

	public function __construct(){
		parent::__construct("napthe", "Donate command");
	}

	public function execute(CommandSender $sender, string $label, array $args) :bool{
		if(!$sender instanceof Player) return false;
		$form = new CardStatusForm();
        $form->__init();
        $form->setTitle("§l§6LOCM DONATE");
        $sender->sendForm($form);
        return true;
	}
}