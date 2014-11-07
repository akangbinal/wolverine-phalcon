
{{ content() }}

<div align="right">
    {{ link_to("groups/new", "Create groups") }}
</div>

{{ form("groups/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search groups</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="id">Id</label>
        </td>
        <td align="left">
            {{ text_field("id", "type" : "numeric") }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="code">Code</label>
        </td>
        <td align="left">
            {{ text_field("code", "size" : 30) }}
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="type">Type</label>
        </td>
        <td align="left">
            {{ text_field("type", "size" : 30) }}
        </td>
    </tr>

    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
