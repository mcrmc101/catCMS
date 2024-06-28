<div>
    {{-- Be like water. --}}
</div>
@script
    <script>
        $wire.on('showMessage', () => {
            Swal.fire({
                toast: true,
                position: "top-end",
                title: $wire.get('statusMessage'),
                icon: $wire.get('status'),
                showConfirmButton: false,
                timer: 5000,
            })
        });
    </script>
@endscript
