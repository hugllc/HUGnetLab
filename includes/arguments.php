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
 * Gets the task that is currently shown
 *
 * @return string
 */
function getTask()
{
    return trim(strtolower(getArgs('task')));
}
/**
 * Gets the option that is currently to be shown.
 *
 * @return string
 */
function getOption()
{
    global $forceOption;
    if (empty($forceOption)) {
        $option = trim(strtolower(getArgs('option')));
    } else {
        $option = trim(strtolower($forceOption));
    }
    if (empty($option)) {
        $option = $_SESSION['option'];
    } else {
        $_SESSION['option'] = $option;
    }
    if (empty($option)) $option = "home";
    $option = str_replace("/", "", $option);
    return $option;

}

/**
 * Gets the arguments
 *
 * @return array
 */
function getArgs($val = "")
{
    if (empty($val)) return $_REQUEST;
    return $_REQUEST[$val];

}

?>