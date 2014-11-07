
<?php echo $this->getContent(); ?>

<div align="right">
    <?php echo $this->tag->linkTo(array('groups/new', 'Create groups')); ?>
</div>

<?php echo $this->tag->form(array('groups/search', 'method' => 'post', 'autocomplete' => 'off')); ?>

<div align="center">
    <h1>Search groups</h1>
</div>

<table>
    <tr>
        <td align="right">
            <label for="id">Id</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('id', 'type' => 'numeric')); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="code">Code</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('code', 'size' => 30)); ?>
        </td>
    </tr>
    <tr>
        <td align="right">
            <label for="type">Type</label>
        </td>
        <td align="left">
            <?php echo $this->tag->textField(array('type', 'size' => 30)); ?>
        </td>
    </tr>

    <tr>
        <td></td>
        <td><?php echo $this->tag->submitButton(array('Search')); ?></td>
    </tr>
</table>

</form>
