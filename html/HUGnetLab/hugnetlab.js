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
                readonly: true
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
                devices: HUGnetLab.Devices,
            });
        }
    });
});
