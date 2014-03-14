<!--
 * This is the template file
-->
<script type="text/template" id="ImageSVGTemplate">
    <svg
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
    <image
        x="0"
        y="0"
        id="<%= name %>"
        xlink:href="data:<%= imagetype %>;base64,<%= image %>"
        height="<%= height %>"
        width="<%= width %>"
    />

    
    </svg>

</script>

