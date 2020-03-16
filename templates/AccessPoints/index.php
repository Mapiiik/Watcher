<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AccessPoint[]|\Cake\Collection\CollectionInterface $accessPoints
 */
?>
<div class="accessPoints index content">
    <?= $this->Html->link(__('New Access Point'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Access Points') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('device_name') ?></th>
                    <th><?= $this->Paginator->sort('gps_x') ?></th>
                    <th><?= $this->Paginator->sort('gps_y') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accessPoints as $accessPoint): ?>
                <tr>
                    <td><?= h($accessPoint->name) ?></td>
                    <td><?= h($accessPoint->device_name) ?></td>
                    <td><?= $this->Number->format($accessPoint->gps_x) ?></td>
                    <td><?= $this->Number->format($accessPoint->gps_y) ?></td>
                    <td><?= h($accessPoint->created) ?></td>
                    <td><?= h($accessPoint->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $accessPoint->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $accessPoint->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accessPoint->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accessPoint->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
