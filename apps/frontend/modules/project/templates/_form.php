<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form
    action="<?php echo url_for('project/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>"
    method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put"/>
    <?php endif; ?>
    <table>
        <tfoot>
        <tr>
            <td colspan="2">
                <button class="btn btn-primary" type="submit">Save / Snapshot</button>
                &nbsp;<?php echo link_to('<button class="btn btn btn-danger">Cancel</button>', 'project/index', array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
                <?php if (!$form->getObject()->isNew()): ?>
                &nbsp;<?php echo link_to('<button class="btn btn btn-danger">Delete</button>', 'project/delete?id=' . $form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
                <?php endif; ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php echo $form ?>
        </tbody>
    </table>
</form>
