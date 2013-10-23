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
var HUGnetLab = {};
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
    HUGnetLab.view = Backbone.View.extend({
        data: {},
        tabs: undefined,
        devices: {},
        initialize: function (options)
        {
            this.devices = new HUGnet.Devices({
                url: 'index.php'
            });
            this.devices.fetch();
            this.render();
        },
        render: function ()
        {
            var self = this;
            this.tests = new HUGnet.TestSuite({
                el: "#tabs-view",
                id: "tabs-view",
                tests: this.devices,
                url: 'index.php',
                readonly: true,
                filter: {type: "test", Publish: "1"}
            });
        }
    });
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
    HUGnetLab.tests = Backbone.View.extend({
        data: {},
        tabs: undefined,
        initialize: function ()
        {
            if (!HUGnetLab.Devices) {
                HUGnetLab.Devices = new HUGnet.Devices();
                HUGnetLab.Devices.fetch();
            }
            this.render();
        },
        render: function ()
        {
            var self = this;
            this.tests = new HUGnet.TestSuite({
                el: "#tabs-tests",
                id: "tabs-tests",
                tests: HUGnetLab.Devices,
                filter: {type: "test"}
            });
        }
    });
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
    HUGnetLab.devices = Backbone.View.extend({
        data: {},
        tabs: undefined,
        initialize: function ()
        {
            if (!HUGnetLab.Devices) {
                HUGnetLab.Devices = new HUGnet.Devices();
                HUGnetLab.Devices.fetch();
            }
            this.render();
        },
        render: function ()
        {
            var self = this;
            this.tests = new HUGnet.DeviceList({
                el: "#tabs-devices",
                id: "tabs-devices",
                devices: HUGnetLab.Devices,
                filter: {}
            });
        }
    });
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
    HUGnetLab.control = Backbone.View.extend({
        data: {},
        tabs: undefined,
        initialize: function ()
        {
            if (!HUGnetLab.Devices) {
                HUGnetLab.Devices = new HUGnet.Devices();
                HUGnetLab.Devices.fetch();
            }
            this.render();
        },
        render: function ()
        {
            var self = this;
            this.tests = new HUGnet.OutputsList({
                el: "#tabs-outputs",
                id: "tabs-outputs",
                devices: HUGnetLab.Devices,
            });
        }
    });
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
    HUGnetLab.datacollectors = Backbone.View.extend({
        data: {},
        tabs: undefined,
        initialize: function ()
        {
            if (!HUGnetLab.Devices) {
                HUGnetLab.Datacollectors = new HUGnet.Datacollectors();
                HUGnetLab.Datacollectors.fetch();
            }
            this.render();
        },
        render: function ()
        {
            var self = this;
            this.datacollectors = new HUGnet.DatacollectorList({
                el: "#tabs-datacollectors",
                id: "tabs-datacollectors",
                model: HUGnetLab.Datacollectors
            });
            this.datacollectors.render();
        }
    });
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
    HUGnetLab.config = Backbone.View.extend({
        data: {},
        tabs: undefined,
        initialize: function ()
        {
            if (!HUGnetLab.Devices) {
                HUGnetLab.Devices = new HUGnet.Devices();
                HUGnetLab.Devices.fetch();
            }
            this.render();
        },
        render: function ()
        {
            this.config = new HUGnet.Config({
                el: "#tabs-config",
                id: "tabs-config",
                devices: HUGnetLab.Devices,
            });
        }
    });
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
    HUGnetLab.serverconfig = Backbone.View.extend({
        data: {},
        tabs: undefined,
        initialize: function ()
        {
            if (!HUGnetLab.Devices) {
                HUGnetLab.Devices = new HUGnet.Devices();
                HUGnetLab.Devices.fetch();
            }
            this.render();
        },
        render: function ()
        {
            this.config = new HUGnet.ServerConfig({
                el: "#tabs-serverconfig",
                id: "tabs-serverconfig",
                devices: HUGnetLab.Devices,
            });
        }
    });
    /**
     * This function creates a clock showing UTC time.  It puts it in an element
     * with the id 'UTCClock'.
     * 
     * @return none
     */
    HUGnetLab.UTCClock = function()
    {
        function pad(n){return n<10 ? '0'+n : n};
        var d = new Date();
        $("#UTCClock").html(
            d.getUTCFullYear()+'-'
            +pad(d.getUTCMonth()+1)+'-'
            + pad(d.getUTCDate())+' '
            + pad(d.getUTCHours())+':'
            + pad(d.getUTCMinutes())+':'
            + pad(d.getUTCSeconds())
        );
        var t = setTimeout(HUGnetLab.UTCClock, 500);
    }

});
