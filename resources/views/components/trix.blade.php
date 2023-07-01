@php
    $hasError = $name && $errors->has($name);
@endphp

<div wire:ignore>

    {{-- css section --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />

    {{-- label --}}
    @if ($label)
        <x-dynamic-component
            :component="WireUi::component('label')"
            :label="$label"
            :has-error="$hasError"
            :for="$id"
        />
    @endif

    {{-- trix editor section --}}
    <input id="{{ $trixId }}" type="hidden" name="{{ $name }}" value="{{ $value }}">
    <trix-editor wire:ignore input="{{ $trixId }}"></trix-editor>

    {{-- scripts section --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")
        var mimeTypes = ["image/png", "image/jpeg", "image/jpg"];

        addEventListener("trix-blur", function(event) {
            @this.set("{{$name}}", trixEditor.getAttribute("value"))
        });

        addEventListener("trix-file-accept", function(event) {
            if (! mimeTypes.includes(event.file.type) ) {
                // file type not allowed, prevent default upload
                return event.preventDefault();
            }
        });

        addEventListener("trix-attachment-add", function(event){
            uploadTrixImage(event.attachment);
        });

        function uploadTrixImage(attachment){
            // upload with livewire
            @this.upload(
                'photos',
                attachment.file,
                function (uploadedURL) {

                    // We need to create a custom event.
                    // This event will create a pause in thread execution until we get the Response URL from the Trix Component @completeUpload
                    const trixUploadCompletedEvent = `trix-upload-completed:${btoa(uploadedURL)}`;
                    const trixUploadCompletedListener = function(event) {
                        attachment.setAttributes(event.detail);
                        window.removeEventListener(trixUploadCompletedEvent, trixUploadCompletedListener);
                    }

                    window.addEventListener(trixUploadCompletedEvent, trixUploadCompletedListener);

                    // call the Trix Component @completeUpload below
                    @this.call('completeUpload', uploadedURL, trixUploadCompletedEvent);
                },
                function() {},
                function(event){
                    attachment.setUploadProgress(event.detail.progress);
                },
            )
            // complete the upload and get the actual file URL
        }
    </script>
</div>