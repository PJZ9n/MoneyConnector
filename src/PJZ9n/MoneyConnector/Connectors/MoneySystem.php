<?php

/**
 * Copyright (c) 2020 PJZ9n.
 *
 * This file is part of MoneyConnector.
 *
 * MoneyConnector is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * MoneyConnector is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MoneyConnector. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace PJZ9n\MoneyConnector\Connectors;

use metowa1227\moneysystem\api\core\API;
use PJZ9n\MoneyConnector\MoneyConnector;
use pocketmine\Player;

/**
 * Class MoneySystem
 * Connector for metowa1227/MoneySystem
 *
 * @package PJZ9n\MoneyConnector\Connectors
 */
class MoneySystem implements MoneyConnector
{
    /** @var API */
    private $parentAPI;
    
    public function __construct()
    {
        $this->parentAPI = API::getInstance();
    }
    
    /**
     * @inheritDoc
     */
    public function getMonetaryUnit(): string
    {
        return $this->parentAPI->getUnit();
    }
    
    /**
     * @inheritDoc
     */
    public function getAllMoney(): array
    {
        return $this->parentAPI->getAll() ?? [];
    }
    
    /**
     * @inheritDoc
     */
    public function myMoney(Player $player): ?int
    {
        return $this->myMoneyByName($player->getName());
    }
    
    /**
     * @inheritDoc
     */
    public function myMoneyByName(string $player): ?int
    {
        $get = $this->parentAPI->get($player);
        if ($get === null) {
            return null;
        }
        return (int)$get;
    }
    
    /**
     * @inheritDoc
     */
    public function setMoney(Player $player, int $amount): int
    {
        return $this->setMoneyByName($player->getName(), $amount);
    }
    
    /**
     * @inheritDoc
     */
    public function setMoneyByName(string $player, int $amount): int
    {
        if ($this->parentAPI->set($player, $amount)) {
            return MoneyConnector::RETURN_SUCCESS;
        } else {
            return MoneyConnector::RETURN_FAILED;
        }
    }
    
    /**
     * @inheritDoc
     */
    public function addMoney(Player $player, int $amount): int
    {
        return $this->addMoneyByName($player->getName(), $amount);
    }
    
    /**
     * @inheritDoc
     */
    public function addMoneyByName(string $player, int $amount): int
    {
        if ($this->parentAPI->increase($player, $amount)) {
            return MoneyConnector::RETURN_SUCCESS;
        } else {
            return MoneyConnector::RETURN_FAILED;
        }
    }
    
    /**
     * @inheritDoc
     */
    public function reduceMoney(Player $player, int $amount): int
    {
        return $this->reduceMoneyByName($player->getName(), $amount);
    }
    
    /**
     * @inheritDoc
     */
    public function reduceMoneyByName(string $player, int $amount): int
    {
        if ($this->parentAPI->reduce($player, $amount)) {
            return MoneyConnector::RETURN_SUCCESS;
        } else {
            return MoneyConnector::RETURN_FAILED;
        }
    }
    
    /**
     * @inheritDoc
     *
     * @return API
     */
    public function getParentAPIInstance(): Object
    {
        return $this->parentAPI;
    }
    
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "MoneySystem";
    }
}