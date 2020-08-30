<?php

namespace phuongaz\NapThe;

use phuongaz\NapThe\form\{NapTheForm, TopForm};
use phuongaz\NapThe\NapTheCommand;

use pocketmine\plugin\PluginBase;

class NapThe extends PluginBase{

	private static $config;

	public function onEnable() :void{
        $this->saveDefaultConfig();
        self::$config =  yaml_parse_file($this->getDataFolder(). "config.yml");
        $this->getServer()->getCommandMap()->register("napthe", new NapTheCommand());
	}

	public static function getSettingConfig() :array{
		return [
			"merchant_id" => self::$config["merchant_id"],
			"email" => self::$config["email"],
			"secure_code" => self::$config["secure_code"]
		];
	}
}