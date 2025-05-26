<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use Livewire\Component;
use App\Models\SubServer;
use App\Models\VpsServer;

class EditSubServer extends Component
{
    public Server $server;
    public SubServer $subServer;
    public $name, $status;
    public $vps_server;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ];
    }

    public function mount(Server $server, SubServer $subServer)
    {
        $this->server = $server;
        $this->subServer = $subServer;
        $this->name = $subServer->name;
        $this->status = $subServer->status;
    }

    public function store()
    {
        $this->validate();

        $this->subServer->update([
            'name' => $this->name,
            'status' => $this->status,
        ]);


        $this->dispatch('snackbar', message: 'Sub Server added successfully!', type: 'success');
        // dd($this->server);
        $this->dispatch('redirect', url: route('admin.subServers', ['server' => $this->server]));
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.edit-sub-server', [
            'vpsServers' => VpsServer::all('id', 'name', 'username'),
        ])->extends('layouts.admin')
            ->section('content');
    }
}
