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

namespace PJZ9n\MoneyConnector;

use pocketmine\Player;

/**
 * Interface MoneyConnector
 * Basically, it complies with the famous onebone/EconomyAPI.
 *
 * @package PJZ9n\MoneyConnector
 */
interface MoneyConnector
{
    /** @var int */
    public const RETURN_FAILED = -4;
    
    /** @var int */
    public const RETURN_NO_ACCOUNT = -3;
    
    /** @var int */
    public const RETURN_CANCELLED = -2;
    
    /** @var int */
    public const RETURN_NOT_FOUND = -1;
    
    /** @var int */
    public const RETURN_INVALID = 0;
    
    /** @var int */
    public const RETURN_SUCCESS = 1;
    
    /**
     * Get currency unit
     * If the economy API does not support it, an empty string is returned.
     *
     * @return string
     */
    public function getMonetaryUnit(): string;
    
    /**
     * Get money for all players
     * If the economy API does not support it, an empty array is returned.
     * Note: player-name => money
     *
     * @return mixed
     */
    public function getAllMoney(): array;
    
    /**
     * Get player money
     *
     * @return float|null
     */
    public function myMoney(Player $player): ?float;
    
    /**
     * Set player money
     *
     * @param Player $player
     * @param float $amount
     *
     * @return int
     */
    public function setMoney(Player $player, float $amount): int;
    
    /**
     * Add player money
     *
     * @param Player $player
     * @param float $amount
     *
     * @return int
     */
    public function addMoney(Player $player, float $amount): int;
    
    /**
     * Reduce player money
     *
     * @param Player $player
     * @param float $amount
     *
     * @return int
     */
    public function reduceMoney(Player $player, float $amount): int;
    
    /**
     * Get an instance of the parent economy API.
     * WARNING: Unnecessary use of this breaks API compatibility!
     * Not normally used.
     *
     * @return Object
     */
    public function getParentAPIInstance(): Object;
}