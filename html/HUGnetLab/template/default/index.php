<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
            {{title}}{{#host}} on {{host}}{{/host}}
        </title>
        <link rel="stylesheet" href="HUGnetLab/template/default/default.css" />
        <link rel="stylesheet" href="HUGnetLab/template/default/theme.default.css" />
        <link rel="stylesheet" href="HUGnetLab/template/default/jquery.jqplot.css" />
        <link rel="stylesheet" href="HUGnetLab/template/default/pepper-grinder/jquery-ui.css" />
        <script src="/HUGnetLib/contrib.js" type="text/javascript"></script>
        <script src="/HUGnetLib/hugnet.js" type="text/javascript"></script>
        <!-- This default.js must be loaded before hugnetlab.js.  It loads the underscore templates -->
        <script src="HUGnetLab/template/default/default.js" type="text/javascript"></script>
        <script src="HUGnetLab/hugnetlab.js" type="text/javascript"></script>
        {{header}}
    </head>
    <body>
        <header>
            <div id="header">
                <div class="clock"><span class="bold">UTC Time: </span><span id="UTCClock"></span></div>
                <h1 class="header">{{title}}</h1>
            </div>
        </header>
        <section>
        <div class="body">
            <div id="tabs">
                {{#view}}<div id="tabs-view">{{{view}}}</div>{{/view}}
                {{^view}}
                <nav>
                <ul>
                    {{#datacollectors}}<li><a href="#tabs-datacollectors">Data Collectors</a></li>{{/datacollectors}}
                    {{#devices}}<li><a href="#tabs-devices">Devices</a></li>{{/devices}}
                    {{#tests}}<li><a href="#tabs-tests">Tests</a></li>{{/tests}}
                    {{#config}}<li><a href="#tabs-config">Configuration</a></li>{{/config}}
                    {{#serverconfig}}<li><a href="#tabs-serverconfig">Configuration</a></li>{{/serverconfig}}
                </ul>
                </nav>
                {{#datacollectors}}<div id="tabs-datacollectors" class="content">{{{datacollectors}}}</div>{{/datacollectors}}
                {{#devices}}<div id="tabs-devices" class="content">{{{devices}}}</div>{{/devices}}
                {{#tests}}<div id="tabs-tests" class="content">{{{tests}}}</div>{{/tests}}
                {{#config}}<div id="tabs-config" class="content">{{{config}}}</div>{{/config}}
                {{#serverconfig}}<div id="tabs-serverconfig" class="content">{{{serverconfig}}}</div>{{/serverconfig}}
                <script type="text/javascript">
                    var tabs = $('#tabs').tabs({
                        tabTemplate: '<li><a href="#{href}">#{label}</a></li>',
                        cookie: {
                            // store a session cookie
                            expires: 10
                        },
                        // This updates the tables when the tab is selected
                        activate:function(e, ui) {
                            $(ui.newPanel.selector + " .tablesorter").trigger("update");
                        }
                    });
                    /* Set up the popups */
                    $(document).ready(function(){
                        $(document).tooltip();
                        HUGnetLab.UTCClock();
                    });
                </script>
                {{/view}}
            </div>
        </div>
        </section>
        <footer>
        <div class="copyright">
            <span style="float: right; padding: 5px;"><a href="http://www.hugllc.com"><img src="HUGnetLab/template/default/images/PoweredBy.png" alt="Powered by HUGnetLab&#153;" /></a></span>
            <div>&copy; Copyright 2013 <a href="http://www.hugllc.com">Hunt Utilities Group, LLC</a></div>
            <div>HUGnetLab Version {{HUGnetLabVersion}}</div>
            {{#HUGnetLibVersion}}
            <div>API Version {{HUGnetLibVersion}}</div>
            {{/HUGnetLibVersion}}
            <div>Page Generated {{pageDate}} in {{pageTime}} s</div>
        </div>
        {{#debug}}
        <div>
        <h3>Debug Information</h3>
        {{debug}}
        </div>
        {{/debug}}
        </footer>
    </body>
</html>
