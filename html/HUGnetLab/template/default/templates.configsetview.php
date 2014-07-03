<!--  These are our tempaltes -->
                <script type="text/template" id="DeviceConfigSetViewTitleTemplate">
            Setup Device <%= DeviceID %>:<%= DeviceName %>
        </script>
        <script type="text/template" id="DeviceConfigSetViewTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="close">Close</button>
                </div>
                <div id="image" style="width: 800px; height: 400px;">
                </div>
                <table>
                    <tr>
                        <td style="vertical-align: top;">
                            <%= functions %>
                        </td>
                        <td style="vertical-align: top;">
                            <%= dataChannels %><br />
                            <%= controlChannels %>
                        </td>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="ConfigSetViewDataChannelListTemplate">
                <table id="dataChannelTable">
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
                    <td><%= port %></td>
        </script>
        <script type="text/template" id="ConfigSetViewControlChannelListTemplate">
                <table id="controlChannelTable">
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
                    <td><%= port %></td>
        </script>
        <script type="text/template" id="ConfigSetViewFunctionListTemplate">
                <table id="functionTable">
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
        <script type="text/template" id="ConfigSetViewFunctionEntryTemplate">
                    <td class="center"><%= id %></td>
                    <td><%= longName %></td>
        </script>
