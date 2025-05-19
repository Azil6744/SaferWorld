<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\VpsAccounts;
use App\Models\VpsServer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CreateServersAccounts extends Component
{
    public $name, $vpsserverId, $type, $password;
    public VpsServer $vpsserver;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'vpsserverId' => 'required|exists:vps_servers,id',
            'type' => 'required|in:open,wireguard,ikev2',
            'password' => 'required_if:type,open,ikev2|nullable',
        ];
    }
   public function store()
{
    $this->validate();

    $vpsAccount = VpsAccounts::create([
        'name' => $this->name,
        'vpsserver_id' => $this->vpsserverId,
        'type' => $this->type,
        'password' => Hash::make($this->password),
    ]);

    $vpsserver = VpsServer::find($this->vpsserverId);

    // dd($vpsserver);

    switch ($this->type) {
        case 'open':
            Http::withHeaders([
                'Authorization' => 'Bearer ' . env("VPS_ACCOUNTS_API"),
            ])->post("http://{$vpsserver->ip_address}:5000/api/openvpn/clients/{$this->name}", [
                'username' => $this->name,
                'password' => $this->password,
            ]);
            break;

        case 'wireguard':
            Http::withHeaders([
            'Authorization' => 'Bearer ' . env("VPS_ACCOUNTS_API"),
            ])->post("http://{$vpsserver->ip_address}:5000/api/wireguard/clients/{$this->name}", [
            'name' => $this->name,
            ]);
            break;

        case 'ikev2':
            Http::withHeaders([
            'Authorization' => 'Bearer ' . env("VPS_ACCOUNTS_API"),
            ])->post("http://{$vpsserver->ip_address}:5000/api/ikev2/clients/{$this->name}", [
            'user' => $this->name,
            'pass' => $this->password,
            ]);
            break;
    }
    
    $this->dispatch('snackbar', message: 'VPS Account added successfully!', type: 'success');
    $this->dispatch('redirect', url: route('admin.servers.accounts'));
}

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view(
            'livewire.admin.create-servers-accounts',
            [
                'vpsservers' => VpsServer::all(),
            ]
        )
            ->extends('layouts.admin')
            ->section('content');
    }
}
