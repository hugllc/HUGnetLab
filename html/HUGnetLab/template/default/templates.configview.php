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
                <table>
                    <tr>
                        <td style="vertical-align: top;">
                            <%= dataChannels %>
                        </td>
                        <td style="vertical-align: top;">
                            <%= controlChannels %>
                        </td>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="ConfigViewDataChannelListTemplate">
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
        <script type="text/template" id="ConfigViewDataChannelEntryTemplate">
                    <td class="center"><%= channel %></td>
                    <td><%= label %></td>
                    <td><%= port %></td>
        </script>
        <script type="text/template" id="ConfigViewControlChannelListTemplate">
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
        <script type="text/template" id="ConfigViewControlChannelEntryTemplate">
                    <td class="center"><%= channel %></td>
                    <td><%= label %></td>
                    <td><%= port %></td>
        </script>
