<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">

    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="/"><span>Watcher</span> NMS</a>
        </div>
        <div class="top-nav-links">
            <?= $this->AuthLink->link(__('Access Points'), ['controller' => 'AccessPoints', 'action' => 'index', 'plugin' => null], ['class' => 'button']) ?>
            <?= $this->AuthLink->link(__('Power Supplies'), ['controller' => 'PowerSupplies', 'action' => 'index', 'plugin' => null], ['class' => 'button']) ?>
            <?= $this->AuthLink->link(__('Radio Units'), ['controller' => 'RadioUnits', 'action' => 'index', 'plugin' => null], ['class' => 'button']) ?>
            <?= $this->AuthLink->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout', 'plugin' => null], ['class' => 'button button-outline']) ?>
            <br />
            <?php if (in_array($this->name, ['PowerSupplies', 'PowerSupplyTypes'])): ?>
            <?= $this->AuthLink->link(__('Power Supply Types'), ['controller' => 'PowerSupplyTypes', 'action' => 'index', 'plugin' => null], ['class' => 'button button-small']) ?>
            <?= $this->AuthLink->link(__('Manufacturers'), ['controller' => 'Manufacturers', 'action' => 'index', 'plugin' => null], ['class' => 'button button-small']) ?>
            <?php endif; ?>
            <?php if (in_array($this->name, ['RadioUnits', 'RadioUnitTypes', 'RadioUnitBands'])): ?>
            <?= $this->AuthLink->link(__('Radio Unit Types'), ['controller' => 'RadioUnitTypes', 'action' => 'index', 'plugin' => null], ['class' => 'button button-small']) ?>
            <?= $this->AuthLink->link(__('Radio Unit Bands'), ['controller' => 'RadioUnitBands', 'action' => 'index', 'plugin' => null], ['class' => 'button button-small']) ?>
            <?= $this->AuthLink->link(__('Manufacturers'), ['controller' => 'Manufacturers', 'action' => 'index', 'plugin' => null], ['class' => 'button button-small']) ?>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
