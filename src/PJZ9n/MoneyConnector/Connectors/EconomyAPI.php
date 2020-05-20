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

use PJZ9n\MoneyConnector\MoneyConnector;
use pocketmine\Player;
use onebone\economyapi\EconomyAPI as PEconomyAPI;

/**
 * Class EconomyAPI
 * Connector for onebone/EconomyAPI
 *
 * @package PJZ9n\MoneyConnector\Connectors
 */
class EconomyAPI implements MoneyConnector
{
    /** @var PEconomyAPI */
    private $parentAPI;
    
    public function __construct()
    {
        $this->parentAPI = PEconomyAPI::getInstance();
    }
    
    /**
     * @inheritDoc
     */
    public function getMonetaryUnit(): string
    {
        return $this->parentAPI->getMonetaryUnit();
    }
    
    /**
     * @inheritDoc
     */
    public function getAllMoney(): array
    {
        return $this->parentAPI->getAllMoney();
    }
    
    /**
     * @inheritDoc
     */
    public function myMoney(Player $player): ?float
    {
        return $this->parentAPI->myMoney($player);
    }
    
    /**
     * @inheritDoc
     */
    public function setMoney(Player $player, float $amount): int
    {
        return $this->parentAPI->setMoney($player, $amount);
    }
    
    /**
     * @inheritDoc
     */
    public function addMoney(Player $player, float $amount): int
    {
        return $this->parentAPI->addMoney($player, $amount);
    }
    
    /**
     * @inheritDoc
     */
    public function reduceMoney(Player $player, float $amount): int
    {
        return $this->parentAPI->reduceMoney($player, $amount);
    }
    
    /**
     * @inheritDoc
     *
     * @return PEconomyAPI
     */
    public function getParentAPIInstance(): Object
    {
        return $this->parentAPI;
    }
}