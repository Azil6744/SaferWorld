<?php

namespace App\Livewire\Admin;

use App\Models\SubServer;
use App\Models\SubSubServer as SubSubServerModel;
use Livewire\Component;
use Livewire\WithPagination;

class SubSubServer extends Component
{
    use WithPagination;

    public SubServer $subserver;

    public $search = '';
    public $perPage = 5;

    public $statusFilter = '';

    public function mount(SubServer $server)
    {
        // dd($server);
        $this->subserver = $server;
    }
   
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function deleteSubServer($subServerId)
    {
        $subsubServer = SubSubServerModel::findOrFail($subServerId);
        $subsubServer->delete();

        $this->dispatch('sweetAlert', title: 'Deleted!', message: 'Sub Server has been deleted successfully.', type: 'success');
    }

    public function render()
    {
        $subSubServers = $this->subserver->subSubServers()
            ->with('vpsServer:id,name,username,ip_address')
            ->when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
            
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.sub-sub-server', compact('subSubServers'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
