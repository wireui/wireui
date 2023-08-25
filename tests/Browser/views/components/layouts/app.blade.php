<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <livewire:styles />
    <wireui:styles />
    <wireui:scripts />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <x-dialog />
    <x-notifications />

    {!! $slot !!}

    <livewire:scripts />
    @stack('scripts')
    <script>
        function getElementByXPath(xPath) {
            return document.evaluate(xPath, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue
        }
    </script>
</body>
</html>
