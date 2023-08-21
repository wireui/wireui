<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <livewire:styles />
    <wireui:styles />
    <wireui:scripts />

    @if(! config('livewire.using_new_version'))
        <script src="//unpkg.com/alpinejs" defer></script>
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <x-notifications />
    <x-dialog />

    {!! $slot !!}

    @if(! config('livewire.using_new_version'))
        <livewire:scripts />
    @endif

    @stack('scripts')
    <script>
        function getElementByXPath(xPath) {
            return document.evaluate(xPath, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue
        }

        document.addEventListener('livewire:initialized', function () {
            window.livewire = {
                emit: window.Livewire.dispatch
            }
        })
    </script>
</body>
</html>
