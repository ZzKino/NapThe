<?php

namespace phuongaz\NapThe\form;


use pocketmine\Player;
use pocketmine\Server;

use jojoe77777\FormAPI\CustomForm;
use phuongaz\NapThe\Card;

Class NapTheForm extends CustomForm{

	private $player;
	private $id_card;
	private $name_card;

	private $amount = [10000 => "10.000 VND", 20000 => "20.000 VND", 50000 => "50.000 VND", 100000 => "100.000 VND", 200000 => "200.000 VND", 500000 => "500.000 VND"];
	public function __construct(Player $player, int $id_card, string $name_card){
		$this->id_card = $id_card;
		$this->name_card = $name_card;
		$this->player = $player;
		$Callable = $this->getCallable();
		parent::__construct($Callable);
	}

	public function __init(){
		//$this->addLabel("§f§lLcoin:§e ". Coin::getInstance()->getCoin($this->player)."\n§a§lKhuyến Khích Nạp Thẻ§e Zing");
		$this->addDropDown("§a§lMệnh giá §f(Sai mệnh giá mất thẻ)", array_values($this->amount));
		$this->addInput("§a§lSERI", "(mã seri)");
		$this->addInput("§a§lMã pin", "(mã pin)");
	}

	public function getCallable() :Callable{
		return function(Player $player, ?array $data){
			if(is_null($data)) return;
			$card_value = array_keys($this->amount)[$data[0]];
			if(isset($data[1]) and isset($data[2])){
				$pin = $data[2];
				$seri = $data[1];
			}
			$data_card = ["PIN" => $pin, "SERI" => $seri, "CARD_VALUE" => $card_value, "ID" => $this->id_card, "NAME" => $this->name_card];
			$card = new Card($data_card);
			$card->sendCard($player);
		};
	}
}
