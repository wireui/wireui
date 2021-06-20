<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <livewire:styles />
    <wireui:styles />
    <wireui:scripts />
</head>
<body>
    <x-notifications />
    <x-dialog />

    {{ $slot }}

    <livewire:scripts />
    @stack('scripts')
    <script>
        function getElementByXPath(xPath) {
            return document.evaluate(xPath, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue
        }
    </script>
</body>
</html>
