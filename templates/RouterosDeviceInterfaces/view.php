<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RouterosDeviceInterface $routerosDeviceInterface
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Routeros Device Interface'), ['action' => 'edit', $routerosDeviceInterface->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Routeros Device Interface'), ['action' => 'delete', $routerosDeviceInterface->id], ['confirm' => __('Are you sure you want to delete # {0}?', $routerosDeviceInterface->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Routeros Device Interfaces'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Routeros Device Interface'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-90">
        <div class="routerosDeviceInterfaces view content">
            <h3><?= h($routerosDeviceInterface->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($routerosDeviceInterface->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Routeros Device') ?></th>
                    <td><?= $routerosDeviceInterface->has('routeros_device') ? $this->Html->link($routerosDeviceInterface->routeros_device->name, ['controller' => 'RouterosDevices', 'action' => 'view', $routerosDeviceInterface->routeros_device->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($routerosDeviceInterface->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Comment') ?></th>
                    <td><?= h($routerosDeviceInterface->comment) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mac Address') ?></th>
                    <td><?= h($routerosDeviceInterface->mac_address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ssid') ?></th>
                    <td><?= h($routerosDeviceInterface->ssid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bssid') ?></th>
                    <td><?= h($routerosDeviceInterface->bssid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Band') ?></th>
                    <td><?= h($routerosDeviceInterface->band) ?></td>
                </tr>
                <tr>
                    <th><?= __('Frequency') ?></th>
                    <td><?= $this->Number->format($routerosDeviceInterface->frequency) ?></td>
                </tr>
                <tr>
                    <th><?= __('Noise Floor') ?></th>
                    <td><?= $this->Number->format($routerosDeviceInterface->noise_floor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client Count') ?></th>
                    <td><?= $this->Number->format($routerosDeviceInterface->client_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Overall Tx Ccq') ?></th>
                    <td><?= $this->Number->format($routerosDeviceInterface->overall_tx_ccq) ?></td>
                </tr>
                <tr>
                    <th><?= __('Interface Index') ?></th>
                    <td><?= $this->Number->format($routerosDeviceInterface->interface_index) ?></td>
                </tr>
                <tr>
                    <th><?= __('Interface Type') ?></th>
                    <td><?= $this->Number->format($routerosDeviceInterface->interface_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Interface Admin Status') ?></th>
                    <td><?= $this->Number->format($routerosDeviceInterface->interface_admin_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Interface Oper Status') ?></th>
                    <td><?= $this->Number->format($routerosDeviceInterface->interface_oper_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($routerosDeviceInterface->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($routerosDeviceInterface->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
