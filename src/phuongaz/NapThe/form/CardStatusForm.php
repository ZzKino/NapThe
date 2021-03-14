<?php

namespace phuongaz\NapThe\form;

use pocketmine\Player;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\Internet;

Class CardStatusForm extends SimpleForm{

	/** @var array*/
	private static $status = [];

	public function __construct(){
		$url = Internet::getURL("http://api.napthengay.com/Status.php");
		$result = json_decode($url, true);
		foreach($result as $data){
			$status = $this->parseStatus($data["status"]);
			self::$status[(int)$data["id"]] = ["name" => $data["name"], "id_status" => (int)$data["id"], "status" => $status];			
		}

		$callable = $this->getCallable();
		parent::__construct($callable);
	}

	public function parseStatus(string $data) :string{
		return ((int)$data == 1) ? "§l§aHoạt Động" : "§cBảo trì";
	}

	public function __init() :void {
		foreach(self::$status as $status){
			$this->addButton("§l§f•§0 ".$status["name"]. " §f•\n". "§eTrạng thái: ". $status["status"]);
		}
	}

	public function getCallable() :Callable{
		return function(Player $player, ?int $data){
			if(is_null($data)) return;
			$card = array_keys(self::$status)[$data];
			$form = new NapTheForm($player, $card, self::$status[$card]["name"]);
			$form->__init();
			$form->setTitle("§l§6LOCM DONATE");
			$player->sendForm($form);
		};
	}
}
