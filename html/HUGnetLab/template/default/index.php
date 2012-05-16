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
        <script src="/HUGnetLib/contrib/jquery.min.js" type="text/javascript"></script>
        <script src="/HUGnetLib/contrib/jquery.cookie.js" type="text/javascript"></script>
        <script src="/HUGnetLib/contrib/jquery.metadata.js" type="text/javascript"></script>
        <script src="/HUGnetLib/contrib/jquery.tablesorter.js" type="text/javascript"></script>
        <link rel="stylesheet" href="/HUGnetLib/contrib/css/pepper-grinder/jquery-ui.css" />
        <script src="/HUGnetLib/contrib/jquery-ui.min.js" type="text/javascript"></script>
        <script src="/HUGnetLib/contrib/json2.js" type="text/javascript"></script>
        <script src="/HUGnetLib/contrib/underscore-min.js" type="text/javascript"></script>
        <script src="/HUGnetLib/contrib/backbone.js" type="text/javascript"></script>
        <script src="/HUGnetLib/contrib/mustache.js" type="text/javascript"></script>
        <script src="/HUGnetLib/hugnet.js" type="text/javascript"></script>
        {{header}}
        <script lang="JavaScript">
            $(document).ready(function(){
                var tabs = $('#tabs').tabs({
                    tabTemplate: "<li><a href='#{href}'>#{label}</a></li>",
                });
                var device = new DevicesView({
                    parent: "#tabs-devices",
                    index: 0,
                });
                $("#tabs-devices").html(device.render().el);
                var data = {};
                var index = 1;
                for (; index < 3; index++) {
                    var tag = "#tabs-test" + index;
                    data[index] = new DataPointsView({
                        parent: tag,
                        id: index,
                        data: [
                            { device: 0x1008, field: "Date",      name: "Date",         class: "" },
                            { device: 0x1008, field: "DataIndex", name: "Index",        class: "center" },
                            { device: 0x1008, field: "172.4",     name: "AC Field 4",   class: "center" },
                            { device: 0xAC,   field: "172.0",     name: "AC Field 1",   class: "center" },
                            { device: 0x1008, field: "4104.4",    name: "1008 Field 2", class: "center" }
                        ],
                    });
                    tabs.tabs("add", tag, "Test " + index, index);
                    $(tag).html(data[index].render().el);
                    data[index].bind(
                        'remove',
                        function ()
                        {
                            tabs.tabs( "remove", this.parent );
                        },
                        data[index]
                    );
                }
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
                <ul>
                    <li><a href="#tabs-devices">Devices</a>
                </ul>
                <div id="tabs-home">
                </div>
                <div id="tabs-devices">
                </div>
            </div>
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
        <?php require dirname(__FILE__)."/templates.devices.php"; ?>
        <?php require dirname(__FILE__)."/templates.data.php"; ?>
    </body>
</html>
