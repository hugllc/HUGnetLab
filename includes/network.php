<?php
/**
 * This file contains function that deal with arguments
 *
 * <pre>
 * CoreUI is a user interface for the HUGnet cores.
 * Copyright (C) 2007 Hunt Utilities Group, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * </pre>
 *
 * @category   UI
 * @package    CoreUI
 * @subpackage Includes
 * @author     Scott Price <prices@hugllc.com>
 * @copyright  2007 Hunt Utilities Group, LLC
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    SVN: $Id$
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLib
 */

/**
 * Gets the ip address, netmask and broadcast address
 *
 * The array returned has the following:
 * - <b>inet addr</b> The internet address
 * - <b>mask</b> The netmask
 * - <b>bcast</b> The broadcast address
 *
 * @return array
 */
function getNetInfo()
{
    // I know this works on Linux
    $Info = trim(`/sbin/ifconfig|grep Bcast`);
    $Info = explode("  ", $Info);
    foreach ($Info as $key => $val) {
        if (!empty($val)) {
            $t = explode(":", $val);
            $netInfo[trim($t[0])] = trim($t[1]);
        }
    }
    $netInfo = array_change_key_case($netInfo, CASE_LOWER);
    return $netInfo;
}

/**
 * Gets the ip address, netmask and broadcast address
 *
 * The array returned has the following:
 * - <b>inet addr</b> The internet address
 * - <b>mask</b> The netmask
 * - <b>bcast</b> The broadcast address
 *
 * @return array
 */
function mobileUA()
{
    // Return if mobile is not requested
    if (isset($_REQUEST['m']) && !(bool)$_REQUEST['m']) {
        return false;
    } else if ((bool)$_REQUEST['m']) {
        return true;
    }

    $ua = $_SERVER["HTTP_USER_AGENT"];
    if (stristr($ua, "SymbianOS")) {
        return true;
    }
    if (stristr($ua, "Mobile")) {
        return true;
    }
    return false;
}
?>