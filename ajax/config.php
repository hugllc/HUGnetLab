<?php
/**
 * Setup Home
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
 * @subpackage Setup
 * @author     Scott Price <prices@hugllc.com>
 * @copyright  2007 Hunt Utilities Group, LLC
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    SVN: $Id$
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLab
 */


include_once dirname(__FILE__)."/../includes/hugnet.php";
require_once HUGNET_INCLUDE_PATH."/containers/DeviceContainer.php";

$did = hexdec($html->args()->id);

$dev = &$html->system()->device();
$dev->load($did);
$pkt = &$dev->network()->config();

$dev->config()->decode($pkt->reply());
$dev->store(true);

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 4 Apr 1998 05:00:00 GMT');
header('Content-type: application/json');

print $dev->jsonEncode();


?>