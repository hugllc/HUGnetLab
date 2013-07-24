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

    $.ajax({
        url: 'HUGnetLab/template/default/templates.php',
        method: 'GET',
        async: false,
        contentType: 'text',
        success: function (data) {
            $('body').append('<div>' + data + '</div>');
        }
    });
});
var tDefault = {};
$(function ()
{
    "use strict";

    tDefault.iopOtherTables = function (valid, name, fixed)
    {
        fixed = (fixed != undefined) ? fixed : false;
        var etext = "";
        if (!fixed) {
            etext += '<select id="'+name+'" name="'+name+'" >';
            etext += '<option value="" selected="selected">Select Table</option>';
            for (var q in valid)
            {
                etext += '<option value="'+q.replace('&', '&amp;')+'"';
                etext += '>'+valid[q]+'</option>';
            }
            etext += '</select>';
        }
        return etext;
    };

    tDefault.iopTableTable = function (params, name, fixed)
    {
        fixed = (fixed != undefined) ? fixed : false;
        var etext = "";
        for (key in params) {
            var efield = name+'['+key+']';
            var evalue = params[key]['value'];
            var valid  = params[key]['valid'];
            var size   = params[key]['size']
            if (!isNaN(size) && (size < 0)) {
                continue;
            }
            etext += '<tr>';
            etext += '<th'+HUGnet.viewHelpers.showInfo(params[key]['longDesc'], key)+' class="right">'+params[key]['desc']+'</th><td>';
            if (!isNaN(size) && (size > 0) && !fixed) {
                etext += '<input type="text" id="'+name+'" name="'+efield+'" '
                    + 'value="' + evalue + '" size="'+(size+2)+'" maxlength="'+size+'"/>';
            } else if ((typeof valid === 'object')){
                if (fixed) {
                    etext += valid[evalue];
                } else {
                    etext += '<select id="'+name+'" name="'+efield+'" >';
                    for (var q in valid)
                    {
                        etext += '<option value="'+q.replace('&', '&amp;')+'"';
                        if (q == evalue) {
                            etext += ' selected="selected" ';
                        }
                        etext += '>'+valid[q]+'</option>';
                    }
                    etext += '</select>';
                }
            } else {
                etext += evalue;
            }
            etext += '</td></tr>';
        }
        return etext;
    };
    tDefault.ExtraTable = function (extra, eDefault, desc, values, text, name)
    {
        var etext = "";
        for (key in eDefault) {
            var efield = name+'['+key+']';
            var evalue;
            if ((extra == undefined)
                || (extra[key] == undefined)
            ) {
                evalue = eDefault[key];
            } else {
                evalue = extra[key];
            }
            var type = values[key];
            if (!isNaN(type) && (type < 0)) {
                continue;
            }
            etext += '<tr>';
            etext += '<th'+HUGnet.viewHelpers.showInfo(desc, key)+' class="right">'+text[key]+'</th><td>';
            if ((parseFloat(type) == parseInt(type)) && !isNaN(type) && (type > 0)) {
                etext += '<input type="text" id="'+name+'" name="'+efield+'" '
                    + 'value="' + evalue + '" size="'+(type+2)
                    +'" maxlength="'+type+'"/>';
            } else if (typeof type === 'object') {
                etext += '<select id="'+name+'" name="'+efield+'" >';
                for (var q in type)
                {
                    etext += '<option value="'+q.replace('&', '&amp;')+'"';
                    if (q == evalue) {
                        etext += ' selected="selected" ';
                    }
                    etext += '>'+type[q]+'</option>';
                }
                etext += '</select>';
            } else {
                etext += evalue;
            }
            etext += '</td></tr>';
        }
        return etext;
    };
});
