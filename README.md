# MoneyConnector
 Library for connecting multiple economical APIs.

## Supported APIs
- [x] onebone/EconomyAPI
- [x] mixpowder/MixCoinSystem
- [x] metowa1227/MoneySystem

## Using Plugin
- [PJZ9n/GiveMoney](https://github.com/PJZ9n/GiveMoney)

## How to use
### Preparing to use this library
- Load the
[MoneyConnecterPlugin](https://poggit.pmmp.io/ci/PJZ9n/MoneyConnector/MoneyConnectorPlugin)
plugin on your server.
- Inject
[MoneyConnecter](https://poggit.pmmp.io/ci/PJZ9n/MoneyConnector/MoneyConnector)
Virion into your plugin.
Please refer to
[official documentation](https://github.com/poggit/support/blob/master/virion.md)
for basic usage of Virion.

### Example
```php
<?php

/**
 * @name Example
 * @version 1.0.0
 * @main Example\Example\Main
 * @api 3.0.0
 * @description Every time you login to the server, player will be granted 1000 money.
 */

declare(strict_types=1);

namespace Example\Example;

use PJZ9n\MoneyConnector\Connectors\EconomyAPI;
use PJZ9n\MoneyConnector\Connectors\MixCoinSystem;
use PJZ9n\MoneyConnector\Connectors\MoneySystem;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use PJZ9n\MoneyConnector\MoneyConnector;
use pocketmine\utils\Config;
use RuntimeException;

class Main extends PluginBase implements Listener
{
    /** @var MoneyConnector */
    private $moneyConnector;
    
    public function onEnable(): void
    {
        $settings = new Config($this->getDataFolder() . "settings.yml", Config::YAML, [
            "moneyapi" => "EconomyAPI",
        ]);
        $moneyAPI = $settings->get("moneyapi");
        switch ($moneyAPI) {
            case "EconomyAPI":
                $this->moneyConnector = new EconomyAPI();
                break;
            case "MixCoinSystem":
                $this->moneyConnector = new MixCoinSystem();
                break;
            case "MoneySystem":
                $this->moneyConnector = new MoneySystem();
                break;
            default:
                throw new RuntimeException("API \"{$moneyAPI}\" is not supported");
        }
        
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onPlayerJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        $this->moneyConnector->addMoney($player, 1000);
    }
}
```