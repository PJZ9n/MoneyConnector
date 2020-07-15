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
use MixCoinSystem\MixCoinSystem as PMixCoinSystem;
use pocketmine\Player;
use pocketmine\utils\Config;

/**
 * Class MixCoinSystem
 * Connector for mixpowder/MixCoinSystem
 *
 * @package PJZ9n\MoneyConnector\Connectors
 */
class MixCoinSystem implements MoneyConnector
{
    /** @var PMixCoinSystem */
    private $parentAPI;
    
    public function __construct()
    {
        $this->parentAPI = PMixCoinSystem::getInstance();
    }
    
    /**
     * @inheritDoc
     */
    public function getMonetaryUnit(): string
    {
        return "";//Not supported
    }
    
    /**
     * @inheritDoc
     */
    public function getAllMoney(): array
    {
        /** @var Config $coin */
        $coin = $this->parentAPI->Coin;
        return $coin->getAll();
    }
    
    /**
     * @inheritDoc
     */
    public function myMoney(Player $player): ?int
    {
        return $this->parentAPI->GetCoin($player);
    }
    
    /**
     * @inheritDoc
     */
    public function setMoney(Player $player, int $amount): int
    {
        $this->parentAPI->SetCoin($player, $amount);
        return MoneyConnector::RETURN_SUCCESS;
    }
    
    /**
     * @inheritDoc
     */
    public function addMoney(Player $player, int $amount): int
    {
        $this->parentAPI->PlusCoin($player, $amount);
        return MoneyConnector::RETURN_SUCCESS;
    }
    
    /**
     * @inheritDoc
     */
    public function reduceMoney(Player $player, int $amount): int
    {
        $this->parentAPI->MinusCoin($player, $amount);
        return MoneyConnector::RETURN_SUCCESS;
    }
    
    /**
     * @inheritDoc
     *
     * @return PMixCoinSystem
     */
    public function getParentAPIInstance(): Object
    {
        return $this->parentAPI;
    }
}