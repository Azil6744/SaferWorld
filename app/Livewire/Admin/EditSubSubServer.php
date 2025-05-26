<?php

namespace App\Livewire\Admin;

use App\Models\SubServer;
use App\Models\VpsServer;
use Livewire\Component;
use App\Models\Subsubserver;

class EditSubSubServer extends Component
{
    public SubServer $subServer;
    public Subsubserver $subSubServer;
    public $name;
    public $vps_server;

    protected function rules()
    {
        return [
            'name' => 'required',
            'vps_server' => 'required|exists:vps_servers,id',
        ];
    }

    public function mount(SubServer $subServer, Subsubserver $subSubServer)
    {
        $this->subServer = $subServer;
        $this->subSubServer = $subSubServer;

        // Pre-fill fields with existing data
        $this->name = $subSubServer->name;
        $this->vps_server = $subSubServer->vps_server_id;
    }

    public function update()
    {
        $this->validate();
        
        $this->subSubServer->update([
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
        return view('livewire.admin.edit-sub-sub-server', [
            'vpsServers' => VpsServer::all(),
        ])
            ->extends('layouts.admin')
            ->section('content');
    }
}
