
<?php echo $this->getContent(); ?>

<table width="100%">
    <tr>
        <td align="left">
            <?php echo $this->tag->linkTo(array('groups/index', 'Go Back')); ?>
        </td>
        <td align="right">
            <?php echo $this->tag->linkTo(array('groups/new', 'Create ')); ?>
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
    <?php if (isset($page->items)) { ?>
    <?php foreach ($page->items as $group) { ?>
        <tr>
            <td><?php echo $group->getId(); ?></td>
            <td><?php echo $group->getCode(); ?></td>
            <td><?php echo $group->getType(); ?></td>
            <td><?php echo $this->tag->linkTo(array('groups/edit/' . $group->getId(), 'Edit')); ?></td>
            <td><?php echo $this->tag->linkTo(array('groups/delete/' . $group->getId(), 'Delete')); ?></td>
        </tr>
    <?php } ?>
    <?php } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td><?php echo $this->tag->linkTo(array('groups/search', 'First')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('groups/search?page=' . $page->before, 'Previous')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('groups/search?page=' . $page->next, 'Next')); ?></td>
                        <td><?php echo $this->tag->linkTo(array('groups/search?page=' . $page->last, 'Last')); ?></td>
                        <td><?php echo $page->current . '/' . $page->total_pages; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
