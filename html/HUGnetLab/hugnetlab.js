/**
 * hugnet.device.js
 *
 * <pre>
 * HUGnetLib is a user interface for the HUGnet
 * Copyright (C) 2012 Hunt Utilities Group, LLC
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
 * @category   JavaScript
 * @package    HUGnetLib
 * @subpackage Devices
 * @author     Scott Price <prices@hugllc.com>
 * @copyright  2012 Hunt Utilities Group, LLC
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLib
 */
$(document).ready(function(){
    "use strict";

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
    $("#tabs-devices .tablesorter th").trigger('click');
    $('#tabs').tabs({
        cookie: {
            // store cookie for a day, without, it would be a session cookie
            expires: 10
        }
    });
});
