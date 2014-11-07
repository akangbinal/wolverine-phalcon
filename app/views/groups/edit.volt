{{ content() }}
{{ form("groups/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("groups", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    </tr>
</table>

<div align="center">
    <h1>Edit groups</h1>
</div>

<table>
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
        <td>{{ hidden_field("id") }}</td>
        <td>{{ submit_button("Save") }}</td>
    </tr>
</table>

</form>
