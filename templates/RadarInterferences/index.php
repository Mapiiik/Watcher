<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RadarInterference[]|\Cake\Collection\CollectionInterface $radarInterferences
 */
?>
<div class="radarInterferences index content">
    <?= $this->Html->link(__('New Radar Interference'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('Devices That Interfere'), ['action' => 'devices'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('Update Online'), ['action' => 'updateOnline'], ['class' => 'button float-right']) ?>
    <h3><?= __('Radar Interferences') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('mac_address') ?></th>
                    <th><?= $this->Paginator->sort('ssid') ?></th>
                    <th><?= $this->Paginator->sort('signal') ?></th>
                    <th><?= $this->Paginator->sort('radio_name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($radarInterferences as $radarInterference): ?>
                <tr>
                    <td><?= h($radarInterference->name) ?></td>
                    <td><?= h($radarInterference->mac_address) ?></td>
                    <td><?= h($radarInterference->ssid) ?></td>
                    <td><?= $this->Number->format($radarInterference->signal) ?></td>
                    <td><?= h($radarInterference->radio_name) ?></td>
                    <td><?= h($radarInterference->created) ?></td>
                    <td><?= h($radarInterference->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $radarInterference->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $radarInterference->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $radarInterference->id], ['confirm' => __('Are you sure you want to delete # {0}?', $radarInterference->id)]) ?>
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
