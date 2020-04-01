<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AccessPoint[]|\Cake\Collection\CollectionInterface $accessPoints
 */
?>
<div class="accessPoints index content">
    <?= $this->Html->link(__('New Access Point'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('List Access Points'), ['action' => 'index'], ['class' => 'button float-right']) ?>
    <h3><?= __('Access Points') ?></h3>
<?php
// Load Google Map Helper
$this->loadHelper('Geo.GoogleMap');
// Map Options
$options = [
    'div' => [
        'id' => 'map',
        'height' => '600px',
    ],
];
$map = $this->GoogleMap->map($options);

// You can echo it now anywhere, it does not matter if you add markers afterwards
echo $map;

$remotePolylines = array();
foreach ($accessPoints as $accessPoint)
{
    // Let's add some markers
    if (is_numeric($accessPoint->gps_y) && is_numeric($accessPoint->gps_x))
    {
        $content = '<b>' . $this->Html->link(__($accessPoint->name), ['action' => 'view', $accessPoint->id]) . '</b>' . '<br />' . '<br />';

        foreach ($accessPoint->routeros_devices as $routerosDevice)
        {
            $content .= $this->Html->link(__($routerosDevice->name), ['controller' => 'RouterosDevices', 'action' => 'view', $routerosDevice->id]) . '<br />';
            
            $content .= '<ul>';
            foreach ($routerosDevice->routeros_device_ips as $routerosDeviceIp)
            {
                if (isset($routerosDeviceIp->RemoteRouterosDevices['access_point_id']) && ($routerosDeviceIp->RemoteRouterosDevices['access_point_id'] <> $accessPoint->id))
                {
                    $remotePolylines[$accessPoint->id][$routerosDeviceIp->RemoteRouterosDevices['access_point_id']]['type'] = 'ip';
                    $content .= '<li>' . $this->Html->link(__($routerosDeviceIp->RemoteRouterosDevices['name']), ['controller' => 'RouterosDevices', 'action' => 'view', $routerosDeviceIp->RemoteRouterosDevices['id']]) . ' (' . $routerosDeviceIp->RemoteRouterosDeviceIps['ip_address'] . ')' . '</li>';
                }
            }
            $content .= '</ul>';
        }
        
        $this->GoogleMap->addMarker(['lat' => $accessPoint->gps_y, 'lng' => $accessPoint->gps_x, 'title' => $accessPoint->name, 'content' => $content, 'icon' => $this->GoogleMap->iconSet('red')]);

        unset($content);
    }
}

foreach ($remotePolylines as $key1 => $value1) foreach ($value1 as $key2 => $value2)
{
    if (is_numeric($accessPoints[$key1]->gps_y) && is_numeric($accessPoints[$key1]->gps_x) && is_numeric($accessPoints[$key2]->gps_y) && is_numeric($accessPoints[$key2]->gps_x))
    {
        $this->GoogleMap->addPolyline(['lat' => $accessPoints[$key1]->gps_y, 'lng' => $accessPoints[$key1]->gps_x], ['lat' => $accessPoints[$key2]->gps_y, 'lng' => $accessPoints[$key2]->gps_x]);
    }
}
unset($remotePolylines);

// Store the final JS in a HtmlHelper script block
$this->GoogleMap->finalize();
?>
</div>
