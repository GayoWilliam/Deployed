<x-app-layout>
    <div id="reportContainer-{{ $report['id'] }}" class="h-full"></div>
    <script>
        var models = window['powerbi-client'].models;

        var embedConfiguration = {
            type: 'report',
            tokenType: models.TokenType.Aad,
            accessToken: '{{ session('azure_access_token') }}',
            embedUrl: '{{ $report['embedUrl'] }}',
            id: '{{ $report['id'] }}',
            settings: {
                filterPaneEnabled: false,
                navContentPaneEnabled: true
            }
        };

        console.log("Embed Configuration: ", embedConfiguration);

        var reportContainer = document.getElementById('reportContainer-{{ $report['id'] }}');
        var report = powerbi.embed(reportContainer, embedConfiguration);

        report.on('loaded', function() {
            console.log("Report loaded successfully.");
        });

        report.on('error', function(event) {
            var errorMsg = event.detail;
            console.error("Embedding Error: ", errorMsg);
        });
    </script>
</x-app-layout>
