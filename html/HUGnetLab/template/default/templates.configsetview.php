<!--  These are our tempaltes -->
                <script type="text/template" id="DeviceConfigSetViewTitleTemplate">
            Setup Device <%= DeviceID %>:<%= DeviceName %>
        </script>
        <script type="text/template" id="DeviceConfigSetViewTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                </div>
                <div id="image" style="width: 800px; height: 400px;">
                </div>
                <div>
                    <button name="NewFunction">New Function</button>
                    <button name="Apply">Save</button>
                    <button name="Save">Save & Exit</button>
                    <button class="close">Cancel</button>
                </div>
                <table style="width: 800px;">
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
                        <td onClick="togFuncWrite(<%= id %>)" class="center"><%= id %></td>
                        <td onClick="togFuncWrite(<%= id %>)" 
                            class="center functionread functionread<%= id %>"
                            >
                            <%= longName %>
                        </td>
                        <td onClick="togFuncWrite(<%= id %>)" 
                            class="functionread functionread<%= id %>"
                            >
                            <%= name %>
                        </td>
                        <td style="display: none;" class="functionwrite functionwrite<%= id %>" colspan="2">
                        Write Here
                        </td>
        </script>
