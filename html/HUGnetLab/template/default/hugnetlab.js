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
$(function ()
{
    "use strict";

    /**
    * This is the model that stores the devices.
    *
    * @category   JavaScript
    * @package    HUGnetLib
    * @subpackage Tests
    * @author     Scott Price <prices@hugllc.com>
    * @copyright  2012 Hunt Utilities Group, LLC
    * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
    * @version    Release: 0.9.7
    * @link       https://dev.hugllc.com/index.php/Project:HUGnetLib
    */
    window.HUGnetLab = Backbone.View.extend({
        data: {},
        tabs: undefined,
        initialize: function ()
        {
            this.render();
        },
        render: function ()
        {
            this.tabs = $('#tabs').tabs({
                tabTemplate: "<li><a href='#{href}'>#{label}</a></li>",
                cookie: {
                    // store a session cookie
                    expires: 10
                }
            });
            var device = new DevicesView({
                parent: "#tabs-devices",
            });
            this.tabs.tabs("add", '#tabs-devices', 'Device Information');
            $('#tabs-devices').html(device.render().el);
            var tests = new TestsView({
                parent: "#tabs-tests",
            });
            this.tabs.tabs("add", '#tabs-tests', 'Test Definitions');
            $('#tabs-tests').html(tests.render().el);

            var data = {};
            tests.bind(
                "run",
                function (test)
                {
                    this.testTab(test, 'run');
                },
                this
            );
            tests.bind(
                "view",
                function (test)
                {
                    this.testTab(test, 'view');
                },
                this
            )
        },
        testTab: function (test, mode)
        {
            var tag = "#tabs-test" + test.get("id");
            if (this.data[tag] !== undefined) {
                alert('Tab for "' + test.get("name") + '" is already open');
                return;
            }
            this.data[tag] = new DataPointsView({
                parent: tag,
                mode: mode,
                id: test.get("id"),
                data: test.get("fields"),
            });
            this.tabs.tabs("add", tag, 'Test "' + test.get("name") + '"');
            $(tag).html(this.data[tag].render().el);
            this.data[tag].bind(
                'remove',
                function (tab)
                {
                    this.tabs.tabs( "remove", tab );
                    delete this.data[tab];
                },
                this
            );
        }
    });
});

$(document).ready(function(){
    "use strict";
    var iface = new HUGnetLab();
});