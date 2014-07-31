<!--  These are our tempaltes -->
        <script type="text/template" id="AnnotationPropertiesTitleTemplate">
            Annotation for <% print(test.toString(16).toUpperCase()) %>:<%= testcol %>
        </script>
        <script type="text/template" id="AnnotationPropertiesTemplate">
                <form id="annotationForm" method="POST" action="javascript:void(0);">
                <table style="width:100%;">
                    <tr class="even"><th class="right">ID</th><td><% print(test.toString(16).toUpperCase()) %>:<%= testcol %> on <%= sqlUTCDate(testdate * 1000) %></td></tr>
                    <tr class="odd">
                        <th class="right">Your Name</th>
                        <td><input type="text" name="author" value="<%= author %>"/></td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Text</th>
                        <td><textarea type="text" name="text"><%= text %></textarea></td>
                    </tr>
                    <tr class="even">
                        <th class="right">&nbsp;</th>
                        <td>
                            <button name="save" class="save">Save</button>
                            <button name="cancel" class="cancel">Cancel</button>
                        </td>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="AnnotationsTemplate">
                <h2>Annotations</h2>
                <table id="annotationTable" class="tablesorter {sortlist: [[2,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-numeric" width="5%">id</th>
                        <th class="sorter-text">Column</th>
                        <th class="sorter-text">Date</th>
                        <th class="sorter-text">Author</th>
                        <th class="sorter-text">Text</th>
                    </tr>
                    </thead>
                    <tbody id="AnnotationList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="AnnotationEntryTemplate">
                        <td class="center"><%= id %></td>
                        <td><%= testcol %></td>
                        <td><%= sqlUTCDate(testdate * 1000) %></td>
                        <td><%= author %></td>
                        <td><%= text %></td>
        </script>


