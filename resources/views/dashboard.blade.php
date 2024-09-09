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
                navContentPaneEnabled: false
            }
        };

        var reportContainer = document.getElementById('reportContainer-{{ $report['id'] }}');
        var report = powerbi.embed(reportContainer, embedConfiguration);

        var globalFilter = {
            $schema: "http://powerbi.com/product/schema#basic",
            target: {
                table: "{{ Auth::user()->table_name }}",
                column: "{{ Auth::user()->column_name }}"
            },
            operator: "In",
            values: ["{{ Auth::user()->column_value }}"],
            filterType: models.FilterType.BasicFilter
        };

        localStorage.setItem("globalFilter", JSON.stringify(globalFilter));

        function applyGlobalFilter(report) {
            var storedFilter = JSON.parse(localStorage.getItem("globalFilter"));
            if (storedFilter) {
                report.setFilters([storedFilter])
            }
        }

        report.on('loaded', function () {
            applyGlobalFilter(report);
        });

        report.on('pageChanged', function () {
            applyGlobalFilter(report);
        });
    </script>
</x-app-layout>
