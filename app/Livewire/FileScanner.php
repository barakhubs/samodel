<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileScanner extends Component
{
    use WithFileUploads;
    public bool $scanned = false;
    public $file_to_scan;
    public $resource_id;
    public $scan_date;
    public $positive_scans;
    public $total_scans;
    public array $tool_list;

    public $fail_message;

    public $api_key = '392eadfdd2883917353bc604cbe24fb46d1742c931cce6d4d95b7521ff00df66';

    public function scan()
    {
        $this->validate([
            'file_to_scan' => 'required|max:4096|mimes:png,jpg,docx,doc,zip,exe,msi,ppt,xlxs,pdf', // 2MB Max
        ]);

        if ($this->file_to_scan) {
            $file_path = $this->file_to_scan->getRealPath();

            $client = new Client();

            try {
                $response = $client->post('https://www.virustotal.com/vtapi/v2/file/scan', [
                    'multipart' => [
                        ['name' => 'apikey', 'contents' => $this->api_key],
                        ['name' => 'file', 'contents' => fopen($file_path, 'r')],
                    ],
                ]);

                $result = json_decode($response->getBody(), true);

                if ($result['response_code'] == 1 && isset($result['resource'])) {
                    $this->resource_id = $result['resource'];

                    // Step 2: Retrieve the scan report
                    $response = $client->get(
                        "https://www.virustotal.com/vtapi/v2/file/report",
                        [
                            'query' => [
                                'apikey' => $this->api_key,
                                'resource' => $this->resource_id,
                            ],
                        ]
                    );

                    $report = json_decode($response->getBody(), true);

                    // $this->scan_date = strtotime($report['scan_date']);

                    if (isset($report['positives'])) {
                        $this->positive_scans = $report['positives'];
                        $this->total_scans = $report['total'];
                        $this->tool_list = $report['scans'];

                        $this->scanned = true;
                        $this->scan_date = $report['scan_date'];
                        $this->reset(['file_to_scan']);
                    } else {
                        $this->fail_message = 'No scan results available.';
                    }


                } else {
                    $this->fail_message = $result['verbose_msg'] ?? 'Unexpected response from the API';
                }
            } catch (\Exception $e) {
                $this->fail_message = 'Error communicating with VirusTotal API: ' . $e->getMessage();
            }
        } else {
            $this->fail_message = 'No file selected';
        }
    }

    public function render()
    {
        return view('livewire.file-scanner');
    }
}
