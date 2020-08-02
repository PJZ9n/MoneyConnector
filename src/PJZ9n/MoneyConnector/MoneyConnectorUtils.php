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

use metowa1227\moneysystem\api\core\API;
use MixCoinSystem\MixCoinSystem as PMixCoinSystem;
use onebone\economyapi\EconomyAPI as PEconomyAPI;
use PJZ9n\MoneyConnector\Connectors\EconomyAPI;
use PJZ9n\MoneyConnector\Connectors\MixCoinSystem;
use PJZ9n\MoneyConnector\Connectors\MoneySystem;

abstract class MoneyConnectorUtils
{
    /**
     * Finds and returns a Connector from the string. Returns null if not found.
     *
     * @param string $name
     *
     * @return MoneyConnector|null
     */
    public static function getConnectorByName(string $name): ?MoneyConnector
    {
        $name = strtolower($name);
        switch ($name) {
            case "economyapi":
                return new EconomyAPI();
                break;
            case "mixcoinsystem":
                return new MixCoinSystem();
                break;
            case "moneysystem":
                return new MoneySystem();
                break;
        }
        return null;
    }
    
    /**
     * Returns the corresponding connector from the detected API. Returns null if not found.
     *
     * @return MoneyConnector|null
     */
    public static function getConnectorByDetect(): ?MoneyConnector
    {
        if (class_exists(PEconomyAPI::class)) {
            return new EconomyAPI();
        }
        if (class_exists(PMixCoinSystem::class)) {
            return new MixCoinSystem();
        }
        if (class_exists(API::class)) {
            return new MoneySystem();
        }
        return null;
    }
    
    /**
     * Returns the result of whether the API supported by MoneyConnector exists.
     *
     * @return bool
     */
    public static function isExistsSupportedAPI(): bool
    {
        return self::getConnectorByDetect() instanceof MoneyConnector;
    }
}
