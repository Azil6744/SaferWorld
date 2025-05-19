<?php

namespace App\Livewire\Admin;

use App\Models\SubServer;
use Livewire\Component;
use App\Models\VpsServer;

class CreateSubSubServer extends Component
{
    public SubServer $subServer;
    public $name;
    public $vps_server;

    protected function rules()
    {
        return [
            'name' => 'required',
            'vps_server' => 'required|exists:vps_servers,id',
        ];
    }

    public function mount(SubServer $subServer)
    {
        $this->subServer = $subServer;
    }

    public function save()
    {
        $this->validate();
        
        $this->subServer->subSubServers()->create([
            'name' => $this->name,
            'vps_server_id' => $this->vps_server,
        ]);
    //    dd($this->subServer);
        $this->dispatch('snackbar', message: 'Sub-Sub Server added successfully!', type: 'success');
        $this->dispatch('redirect', url: route('admin.sub.subServers', $this->subServer));
    }
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-sub-sub-server', [
            'vpsServers' => VpsServer::all(),
        ])

            ->extends('layouts.admin')
            ->section('content');
    }
}
