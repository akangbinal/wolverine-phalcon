
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("groups/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("groups/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Code</th>
            <th>Type</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for group in page.items %}
        <tr>
            <td>{{ group.getId() }}</td>
            <td>{{ group.getCode() }}</td>
            <td>{{ group.getType() }}</td>
            <td>{{ link_to("groups/edit/"~group.getId(), "Edit") }}</td>
            <td>{{ link_to("groups/delete/"~group.getId(), "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("groups/search", "First") }}</td>
                        <td>{{ link_to("groups/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("groups/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("groups/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
