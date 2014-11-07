
<?php echo $this->tag->form(array('groups/create', 'method' => 'post')); ?>

<table width="100%">
    <tr>
        <td align="left"><?php echo $this->tag->linkTo(array('groups', 'Go Back')); ?></td>
        <td align="right"><?php echo $this->tag->submitButton(array('Save')); ?></td>
    </tr>
</table>

<?php echo $this->getContent(); ?>

<div align="center">
    <h1>Create groups</h1>
</div>

<table>
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
        <td><?php echo $this->tag->submitButton(array('Save')); ?></td>
    </tr>
</table>

</form>
