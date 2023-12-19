<div>
    <div class="container mt-5">
        <h1 class="mb-4">VirusTotal Scanner</h1>

        <!-- Disclaimer -->
        <div class="mt-4 alert alert-info">
            <strong>Disclaimer:</strong> This tool provides information from VirusTotal and should be used with caution.
            It does not guarantee the safety or maliciousness of a file.
        </div>
        <div class="m-3">
            <span>{{ $fail_message }}</span>
        </div>
        <!-- Bootstrap Form -->
        <form wire:submit.prevent="scan" class="row">
            <div class="mb-3 col-md-9">
                <div class="input-group">
                    <input type="file" class="form-control" wire:model="file_to_scan">

                </div>
                @error('file_to_scan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <span wire:loading wire:target="scan" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Scan File
                </button>
            </div>
        </form>


        <!-- Feedback Section -->
        @if ($scanned)
            <div class="mt-4">
                <h2>Scan Status</h2>
                <p>
                    @if ($positive_scans > 0)
                    <button class="btn btn-danger">
                        File is infected
                    </button>
                    @else
                    <button class="btn btn-success">
                        File is safe
                    </button>
                    @endif
                </p>
                <p>Resource ID: {{ $resource_id }}</p>
                <p>Scan Date: {{ date('d M, Y h:sa', strtotime($scan_date)) }}</p>

                <h2>Scan Results</h2>
                <p>Positive detections: {{ $positive_scans }}/{{ $total_scans }}</p>

                <!-- Display individual antivirus tools feedback -->
                <h3>Scanned Using the following Antivirus Tools</h3>
                <div class="row row-cols-3 row-cols-md-4 g-4">
                    @foreach ($tool_list as $toolName => $toolInfo)
                    <div class="col">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            {{ htmlspecialchars($toolName)}}
                            @if ($toolInfo['result'] == '')
                            <span class="text-success"><i class="fas fa-check"></i></span>
                            @else
                            <span class="text-danger"><i class="fas fa-times"></i></span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <br>
                <p>Total Antivirus Detected: {{ $positive_scans }}</p>
            </div>
        @endif
    </div>

</div>
