<!--
 * This is the template file
-->
<script type="text/template" id="ImageSVGTemplate">
    <svg
    style="<%= style %>"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:cc="http://creativecommons.org/ns#"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:svg="http://www.w3.org/2000/svg"
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    width="<%= width %>"
    height="<%= height %>"
    id="<%= name %>-svg"
    >
    <defs>
<% _.each(points, function(point, index) { %>
        <filter x="0" y="0" width="1" height="1" id="background<%= index %>">
            <feFlood flood-color="<%= point.background %>"/>
        </filter>
        <text
        style="fill:<%= point.color %>; font-size:<%= point.fontsize %>pt;"
        x="0"
        y="0"
        transform="translate(<%= point.x %>, <%= point.y %>)"
        id="point<%= point.id %>"
        >
            <%= point.pretext %>
            <tspan id="point<%= point.id %>">
                <% if (point.devid != "") { %>
                <%= point.devid %>.<%= point.datachan %>
                <% } %>
            </tspan>
            <%= point.posttext %>
        </text>
<% }); %>
    </defs>
    <image
        x="0"
        y="0"
        id="<%= name %>"
        xlink:href="data:<%= imagetype %>;base64,<%= image %>"
        height="<%= height %>"
        width="<%= width %>"
    />
<% _.each(points, function(point, index) { %>
    <use xlink:href="#point<%= point.id %>" filter="url(#background<%= index %>)"/>
    <use xlink:href="#point<%= point.id %>" />
<% }); %>
    </svg>

</script>

