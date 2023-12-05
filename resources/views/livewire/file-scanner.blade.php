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
        <form wire:submit.prevent="scan">
            <div class="mb-3">
                <label for="file" class="form-label">Choose a file:</label>
            <input type="file" class="form-control" wire:model="file_to_scan">

            @error('file_to_scan') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Scan file</button>
        </form>

        <!-- Feedback Section -->
        @if ($scanned)
            <div class="mt-4">
                <h2>Scan Status</h2>
                <p>Resource ID: {{ $resource_id }}</p>
                <p>Scan Date: [Replace with actual scan date]</p>

                <h2>Scan Results</h2>
                <p>Scan results available. Positive detections: {{ $positive_scans }}/{{ $total_scans }}</p>

                <!-- Display individual antivirus tools feedback -->
                <h3>Antivirus Tools</h3>
                <div class="row row-cols-3 row-cols-md-4 g-4">
                    @foreach ($tool_list as $toolName => $toolInfo)
                    <div class="col">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            {{ htmlspecialchars($toolName)}}
                            @if ($toolInfo['result'] == '')

                            @else
                            <span class="text-success"><i class="fas fa-check"></i></span>
                            @endif


                        </div>
                    </div>
                    @endforeach
                </div>

                <p>Total Antivirus Tools: [Replace with actual total]</p>
                <p>Antivirus Tools Detecting the File: [Replace with actual detected count]</p>
            </div>
        @endif
    </div>

</div>
