<!--
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
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <title>HUGnetLab on {{host}}</title>
        <link rel="stylesheet" href="HUGnetLab/template/default/default.css" />
        <script src="HUGnetLab/jquery-1.7.1.js" type="text/javascript"></script>
        <script src="HUGnetLab/jquery.cookie.js" type="text/javascript"></script>
        <script src="HUGnetLab/jquery.metadata.js" type="text/javascript"></script>
        <script src="HUGnetLab/jquery.tablesorter.js" type="text/javascript"></script>
        <link rel="stylesheet" href="HUGnetLab/pepper-grinder/jquery.ui.all.css" />
        <script src="HUGnetLab/ui/jquery.ui.core.js" type="text/javascript"></script>
        <script src="HUGnetLab/ui/jquery.ui.widget.js" type="text/javascript"></script>
        <script src="HUGnetLab/ui/jquery.ui.tabs.js" type="text/javascript"></script>
        <script src="HUGnetLab/ui/jquery.ui.button.js" type="text/javascript"></script>
        <script src="HUGnetLab/mustache.js" type="text/javascript"></script>
        <script src="HUGnetLab/hugnet.device.js" type="text/javascript"></script>
        {{header}}
        <script lang="JavaScript">
            $(document).ready(function(){
                var device = new HUGnetDevice(0x1008, "#dev1008");
            });

            $(function(){
                $('#tabs').tabs({
                    cookie: {
                        // store cookie for a day, without, it would be a session cookie
                        expires: 10
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="header"><h1 class="header">HUGnetLab</h1></div>
        <div class="body">
            <div id="tabs">
            <table>
                <tr id="dev1008"></tr>
            </table>
        </div>
        <div class="copyright">
            <div>&copy; Copyright 2012 <a href="http://www.hugllc.com">Hunt Utilities Group, LLC</a></div>
            <div>HUGnetLab Version {{HUGnetLabVersion}}</div>
            <div>Page Generated {{pageDate}} in {{pageTime}} s</div>
        </div>
        {{#debug}}
        <div>
        <h3>Debug Information</h3>
        {{debug}}
        </div>
        {{/debug}}
        {{{templates}}}
    </body>
</html>

<!--
    $menuitems = array();
    $bodyitems = array();
    $index = 1;
    $url = $_SERVER['SCRIPT_NAME']."?option=$option";
    foreach ((array)$taskmenu as $name => $item) {
        $menuitems[$index] = '<li><a href="#tabs-'.$index.'">'.$name.'</a></li>';
        ob_start();
        include $filedir."/".$option."/".$item.".inc.php";
        $bodyitems[$index] = "<div id=\"tabs-".$index."\">\n".ob_get_clean()."\n</div>\n";
        $index++;
    }
    $body  = "<div id=\"tabs\">\n<ul>\n".implode("\n", $menuitems)."\n</ul>\n";
    $body .= implode("\n", $bodyitems)."\n</div>\n";
    $header = "
    <script>
        \$(function(){
            \$('#tabs').tabs({
                cookie: {
                    // store cookie for a day, without, it would be a session cookie
                    expires: 10
                }
            });
        });
    </script>";
-->