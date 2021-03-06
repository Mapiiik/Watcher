<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Log\Log;
use Cake\Mailer\Mailer;
use Cake\Routing\Router;

class RadarInterferencesReportCommand extends Command
{
    // Base Command will load the Users model with this property defined.
    public $modelClass = 'RadarInterferences';
    
    protected function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser->addArgument('names', [
            'help' => 'names of interferences to notify when device match',
            'required' => false,
        ]);
        $parser->addArgument('emails', [
            'help' => 'list of emails for sending the report',
            'required' => false,
        ]);
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
        $names = $args->getArgument('names');
        if (!isset($names))
        {
            $names = env('RADAR_INTERFERENCES_REPORT_NAMES');
        }
        $emails = $args->getArgument('emails');
        if (!isset($emails))
        {
            $emails = env('RADAR_INTERFERENCES_REPORT_EMAILS');
        }

        $radarInterferences = $this->RadarInterferences->find();
        
        $radarInterferences->join([
            'RouterosDeviceInterfaces' => [
                'table' => 'routeros_device_interfaces',
                'type' => 'INNER',
                'conditions' => "RadarInterferences.mac_address = RouterosDeviceInterfaces.mac_address AND to_tsvector(RadarInterferences.name) @@ to_tsquery('" . mb_ereg_replace('\s{1,}', '|', $names) . "')",
            ],
            'RouterosDevices' => [
                'table' => 'routeros_devices',
                'type' => 'INNER',
                'conditions' => 'RouterosDeviceInterfaces.routeros_device_id = RouterosDevices.id',
            ]
        ]);
        
        $radarInterferences->select($this->RadarInterferences);
        $radarInterferences->select(['routeros_device_id' => 'RouterosDevices.id']);
        $radarInterferences->select(['routeros_device_name' => 'RouterosDevices.name']);
        $radarInterferences->select(['routeros_device_interface_id' => 'RouterosDeviceInterfaces.id']);
        $radarInterferences->select(['routeros_device_interface_name' => 'RouterosDeviceInterfaces.name']);
        
        if ($radarInterferences->count() > 0)
        {
            $table[] = ['Name', 'MAC Address', 'SSID', 'Radio Name', 'Signal', 'Device Name', 'Interface Name'];
            foreach ($radarInterferences as $radarInterference)
            {
                $table[] = [$radarInterference['name'], $radarInterference['mac_address'], $radarInterference['ssid'], $radarInterference['radio_name'], (string)$radarInterference['signal'], $radarInterference['routeros_device_name'], $radarInterference['routeros_device_interface_name']];
            }
            $io->helper('Table')->output($table);
            
            $mailer = new Mailer('default');
            $mailer->setFrom([env('EMAIL_TRANSPORT_DEFAULT_SENDER_EMAIL') => env('EMAIL_TRANSPORT_DEFAULT_SENDER_NAME')]);
            
            foreach (explode(" ", $emails) as $email)
            {
                $mailer->addTo($email);
            }
            $mailer->setSubject('The radar interfering devices found');
            
            if ($mailer->deliver("Hello,\n\nthe radar interfering devices (" . $radarInterferences->count() . ") found.\n\nFor more informations go here: " . Router::url(['controller' => 'RadarInterferences', 'action' => 'devices', '_full' => true], true)))
            {
                Log::write('debug', 'The radar interfering devices found and reported.');
                $io->info('The radar interfering devices found and reported.');
            }
            else
            {
                Log::write('warning', 'The radar interfering devices found and but cannot be reported.');
                $io->abort('The radar interfering devices found and but cannot be reported.');
            }
        }
        else
        {
            Log::write('debug', 'No radar interfering devices found.');
            $io->success('No radar interfering devices found.');
        }
    }
}
