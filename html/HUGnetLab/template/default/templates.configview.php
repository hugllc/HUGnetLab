<!--  These are our tempaltes -->
        <script type="text/template" id="DeviceConfigViewTitleTemplate">
            Device <%= DeviceID %>:<%= DeviceName %>
        </script>
        <script type="text/template" id="DeviceConfigViewTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="close">Close</button>
                </div>
                <div id="image" style="width: 800px; height: 400px;">
                </div>
                <table style="width: 800px;">
                    <tr>
                        <td style="vertical-align: top;">
                            <%= functions %>
                        </td>
                        <td style="vertical-align: top; width: 25%;">
                            <%= dataChannels %>
                        </td>
                        <td style="vertical-align: top; width: 25%;">
                            <%= controlChannels %>
                        </td>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="ConfigViewDataChannelListTemplate">
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
        <script type="text/template" id="ConfigViewDataChannelEntryTemplate">
                    <td class="center"><%= channel %></td>
                    <td><%= label %> (<%= unitType %>)</td>
                    <td style="white-space: nowrap;"><%= port.replace(new RegExp(',', 'g'), '<br />') %></td>
        </script>
        <script type="text/template" id="ConfigViewControlChannelListTemplate">
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
        <script type="text/template" id="ConfigViewControlChannelEntryTemplate">
                    <td class="center"><%= channel %></td>
                    <td><%= label %></td>
                    <td style="white-space: nowrap;"><%= port.replace(new RegExp(',', 'g'), '<br />') %></td>
        </script>
        <script type="text/template" id="ConfigViewFunctionListTemplate">
                <table id="functionTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th colspan="3">Functions</th>
                    </tr>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody id="fctList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="ConfigViewFunctionEntryTemplate">
                    <tr>
                        <td class="center"><%= id %></td>
                        <td><%= longName %></td>
                    </tr>
        </script>
