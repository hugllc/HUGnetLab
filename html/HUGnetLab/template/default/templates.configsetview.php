<!--  These are our tempaltes -->
                <script type="text/template" id="DeviceConfigSetViewTitleTemplate">
            Setup Device <%= DeviceID %>:<%= DeviceName %>
        </script>
        <script type="text/template" id="DeviceConfigSetViewTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button name="Execute">Set Config</button>
                </div>
                <div id="image" style="width: 800px; height: 400px; clear: both;">
                </div>
                <div style="clear: both;">
                    <button type="submit" name="Apply">Save</button>
                    <button name="Save">Save & Exit</button>
                    <button class="close">Cancel</button>
                    <button name="NewFunction">New Function</button>
                    <span>Click on a row to edit it</span>
                </div>
                <table style="width: 800px; clear: both;">
                    <tr>
                        <td style="vertical-align: top;">
                            <%= functions %>
                        </td>
                        <td style="vertical-align: top; width: 25%;">
                            <%= dataChannels %><br />
                            <%= controlChannels %>
                        </td>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="ConfigSetViewDataChannelListTemplate">
                <table id="dataChannelTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th colspan="3">Data Channels</th>
                    </tr>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Label</th>
                        <th>Port(s)</th>
                    </tr>
                    </thead>
                    <tbody id="channelList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="ConfigSetViewDataChannelEntryTemplate">
                    <td class="center"><%= channel %></td>
                    <td><%= label %></td>
                    <td style="white-space: nowrap;"><%= port.replace(new RegExp(',', 'g'), '<br />') %></td>
        </script>
        <script type="text/template" id="ConfigSetViewControlChannelListTemplate">
                <table id="controlChannelTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th colspan="3">Control Channels</th>
                    </tr>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Label</th>
                        <th>Port(s)</th>
                    </tr>
                    </thead>
                    <tbody id="channelList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="ConfigSetViewControlChannelEntryTemplate">
                    <td class="center"><%= channel %></td>
                    <td><%= label %></td>
                    <td style="white-space: nowrap;"><%= port.replace(new RegExp(',', 'g'), '<br />') %></td>
        </script>
        <script type="text/template" id="ConfigSetViewFunctionListTemplate">
                <table id="functionTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th colspan="3">Functions</th>
                    </tr>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Type</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody id="fctList">
                    </tbody>
                </table>
                <% print("<sc" + "ript type='text/javascript'>"); %>
                    function togFuncWrite(id) {
                            $('#functionTable .functionread').show(); 
                            $('#functionTable .functionwrite,#functionTable .functionread'+id).hide(); 
                            $('#functionTable .functionwrite'+id).show();
                    }
                <% print("</sc"+"ript>"); %>
        </script>
        <script type="text/template" id="ConfigSetViewFunctionEntryTemplate">
                        <td onClick="togFuncWrite(<%= id %>)" class="center">
                            <%= id %>
                            <input type="hidden" name="id" value="<%= id %>" />
                        </td>
                        <td onClick="togFuncWrite(<%= id %>)" 
                            class="center functionread functionread<%= id %>"
                            >
                            <span id="type"><%= longName %></span>
                        </td>
                        <td onClick="togFuncWrite(<%= id %>)" 
                            class="functionread functionread<%= id %>"
                            >
                            <span id="name"><%= name %></span>
                            <span id="remove" style="display: none;">(Removed on save)</span>
                        </td>
                        <td style="display: none;" class="functionwrite functionwrite<%= id %>" colspan="2">
                            <table>
                                <tr>
                                    <th colspan="2">Basic Setup</th>
                                </tr>
                                <tr>
                                    <th class="right">Remove:</th>
                                    <td>
                                        <input type="checkbox" name="delete" onChange="if (this.checked) { $('.functionread<%= id %> span#remove').show(); } else { $('.functionread<%= id %> span#remove').hide(); };" />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="right">Name:</th>
                                    <td>
                                        <input type="text" name="name" value="<%= name %>" onBlur="$('.functionread<%= id %> span#name').html(this.value);" />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="right">Type:</th>
                                    <td>
                                        <select name="driver" class="driver" onChange="$('.functionread<%= id %> span#type').html(this.value);" >
                                            <% for (key in validIds) { %>
                                                <option value="<%- key %>" <% (key == driver) && print('selected="selected"'); %>>
                                                    <%= validIds[key] %>
                                                </option>
                                            <% } %>
                                        </select>
                                    </td>
                                </tr>
                                <tr><th colspan="2">Extra Parameters</th></tr>
                                <% print(tDefault.ExtraTable(extra, extraDefault, extraDesc, extraValues, extraText, "extra")) %>
                            </table>
                        </td>
        </script>
