<?php

namespace status;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\CallbackTask;
use pocketmine\scheduler\Task;
use pocketmine\plugin\PluginManager;
use pocketmine\event\Listener;

class main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->EconomyAPI = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this, "statustask"]), 20);
		date_default_timezone_set('Asia/Tokyo');
	}
	public function statustask(){
		$players = Server::getInstance()->getOnlinePlayers();
		foreach ($players as $player){
		$x = floor($player->getX());
		$y = floor($player->getY());
		$z = floor($player->getZ());
		$money = $this->EconomyAPI->myMoney($player->getName());
		$date = date("Y/m/d");
		$time = date("H:i:s");
		$name = $player->getName();
		$k = str_repeat(" ",60);
			$player->sendTip("\n\n\n§l§o§f".$k."名前§a:§6$".$name."\n§f".$k."所持金§a:§6$".$money."\n§f".$k."日付§a:§6".$date."\n§f".$k."時間§a:§6".$time."§6\n§f".$k."座標§a:§6".$x.",".$y.",".$z."");
		}
	}
}
