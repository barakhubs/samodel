<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithFileUploads;

class SiteChecker extends Component
{
    use WithFileUploads;
    public bool $scanned = false;
    public $url_to_scan;
    public $resource_id;
    public $scan_date;
    public $positive_scans;
    public $total_scans;
    public array $tool_list;

    public $fail_message;

    public $api_key = '392eadfdd2883917353bc604cbe24fb46d1742c931cce6d4d95b7521ff00df66';

    public function mount()
    {
        $this->url_to_scan = null;
    }

    public function scan()
    {
        $this->validate([
            'url_to_scan' => 'required|url'
        ]);

        if ($this->url_to_scan) {

            $client = new Client();

            try {
                $response = $client->request('GET', 'https://www.virustotal.com/vtapi/v2/url/report?apikey=392eadfdd2883917353bc604cbe24fb46d1742c931cce6d4d95b7521ff00df66&resource='.$this->url_to_scan.'&allinfo=false&scan=0', [
                    'headers' => [
                      'accept' => 'application/json',
                    ],
                  ]);

                $result = json_decode($response->getBody(), true);

                if (isset($result['positives'])) {
                    $this->positive_scans = $result['positives'];
                    $this->total_scans = $result['total'];
                    $this->tool_list = $result['scans'];

                    $this->scanned = true;
                    $this->scan_date = $result['scan_date'];
                    $this->resource_id = $result['scan_id'];
                    $this->scanned = true;
                } else {
                    $this->fail_message = $result['verbose_msg'] ?? 'Unexpected response from the API';
                }
            } catch (\Exception $e) {
                $this->fail_message = 'Error communicating with VirusTotal API: ' . $e->getMessage();
            }
        } else {
            $this->fail_message = 'No url added';
        }
    }

    public function render()
    {
        return view('livewire.site-checker');
    }
}
