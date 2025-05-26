@section('title', 'Edit Server')
<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Sub Servers</a></li>
                        <li class="breadcrumb-item"><a href="#">Edit</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-1">Edit Sub Server</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store" class="row">
                        <div class="col-sm-12 mb-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" wire:model.defer="name"
                                placeholder="Enter server name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-12 mb-2">
                            <label for="Serverstatus" class="form-label">Status</label>
                            <select class="form-control" id="Serverstatus" wire:model="status">
                                <option value="" selected>Select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $wire.on('snackbar', (event) => {
            showSnackbar(event.message, event.type);
        });
        $wire.on('redirect', (event) => {
            setTimeout(() => {
                window.location.href = event.url;
            }, 1000);
        });
    </script>
@endscript