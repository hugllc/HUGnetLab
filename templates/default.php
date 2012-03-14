<?php
/**
 * Main index
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
 * @subpackage Main
 * @author     Scott Price <prices@hugllc.com>
 * @copyright  2007 Hunt Utilities Group, LLC
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    SVN: $Id$
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLib
 */
if (is_array($taskmenu)) {
    foreach ($taskmenu as $name => $opt) {
        $taskMenuHTML .= printMenu($name, $opt);
    }
}
foreach ($optionmenu as $name => $opt) {
    $optionMenuHTML .= printOptionMenu($name, $opt);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <title>HUGnetLab</title>
       <style>
           <?php include $filedir."/templates/default.css"; ?>
       </style>
    </head>
    <body>
        <div id="header">&nbsp;</div>
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td style="vertical-align: top;" class="left" rowspan="2">
                    <div id="nodename">HUGnetLab</div>
                    <div class="menu">
                        <hr />
                        <?php echo $taskMenuHTML; ?>
                        <hr />
                    </div>
                </td>
                <td class="hmenu" style="height: 1.5em;">
                    <ul class="hmenu">
                       <?php echo $optionMenuHTML;?>
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;" class="body">
                    <div style="min-height: 500px;">
                        <?php echo $body?>
                    </div>
                </td>
            </tr>
        </table>
    </body>
<div class="copyright">
    <div>&copy Copyright 2012 <a href="http://www.hugllc.com">Hunt Utilities Group, LLC</a></div>
    <div>HUGnetLab Version <?php print HUGNETLAB_VERSION; ?></div>
    <div>Page Generated <?php print date('r'); ?> in <?php print round(microtime(true) - $pageStartTime, 4); ?> s</div>
</div>
</html>

<?php
/**
 * Prints out the vertical menu on the left side of the page.
 *
 * @param string $name The name of the menu item
 * @param string $task The task to show
 *
 * @return null
 */
function printMenu($name, $task)
{
    if ($task == "menudivider") return "<hr />";
    $sTask = getTask();
    if (empty($sTask)) $sTask = "home";
    $option = getOption();
    if (trim(strtolower($task)) == $sTask) {
        $class = "active";
    }
    if (!is_null($task)) $task = "&task=".urlencode($task);
    return '<a class="'.$class.'" href="index.php?option='.urlencode($option).$task.'">'.$name.'</a>'."\n";
}

/**
 * Prints out the horizontal menu on the top of the page.
 *
 * @param string $name   The name of the menu item
 * @param string $option The option to show
 *
 * @return null
 */
function printOptionMenu($name, $option=null)
{
    global $forceOption;
    global $filedir;
    if (!is_dir($filedir."/".$option)) return;

    if (empty($forceOption) || (trim(strtolower($forceOption)) == $option)) {
        $sOption = getOption();
        if (trim(strtolower($option)) == $sOption) {
            $class = "active";
        }
        if (!is_null($option)) $option = "?option=".urlencode($option);
        return '<li><a class="'.$class.'" href="index.php'.$option.'">'.$name.'</a></li>'."\n";
    }
}
?>