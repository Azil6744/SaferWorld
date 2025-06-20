@section('title', 'Reset Password')
<div>
    <div class="wrapper-page">
        <div class="card mb-0">
            <div class="card-body">
                <div class="p-4">
                    <div class="mb-3 text-center">
                        <img src="{{ asset('assets/images/logo-lg.png') }}" width="160px" class="me-4" alt="logo" />
                    </div>
                    <div class="text-center mb-4">
                        <p class="mb-0">Reset your password below</p>
                    </div>
                    @if (session()->has('status'))
                        <x-alert type="info" :message="session('status')" />
                    @endif
                    <div class="form-body">
                        <form class="row g-3" wire:submit.prevent="resetPassword">
                            <input type="hidden" wire:model="token">
                            <input type="hidden" wire:model="email">

                            <div class="col-12 mb-3">
                                <label for="inputNewPassword" class="form-label">New Password</label>
                                <div class="input-group" x-data="{ show: false }">
                                    <input :type="show ? 'text' : 'password'" class="form-control border-end-0"
                                        id="inputNewPassword" wire:model="password" placeholder="Enter New Password">
                                    <a href="javascript:;" class="input-group-text bg-transparent"
                                        @click="show = !show">
                                        <iconify-icon :icon="show ? 'akar-icons:eye' : 'akar-icons:eye-closed'"
                                            width="24" height="24"></iconify-icon>
                                    </a>
                                </div>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group" x-data="{ show: false }">
                                    <input :type="show ? 'text' : 'password'" class="form-control"
                                        id="inputConfirmPassword" wire:model="password_confirmation"
                                        placeholder="Confirm New Password">
                                    <a href="javascript:;" class="input-group-text bg-transparent"
                                        @click="show = !show">
                                        <iconify-icon :icon="show ? 'akar-icons:eye' : 'akar-icons:eye-closed'"
                                            width="24" height="24"></iconify-icon>
                                    </a>
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" wire:click="resetPassword" class="btn btn-light">Reset
                                        Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
