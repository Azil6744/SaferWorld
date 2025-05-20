<?php

namespace App\Livewire\Admin;

use App\Models\VpsAccounts;
use App\Models\VpsServer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CheckServerAccount extends Component
{
    public $name, $vpsserverId, $type, $password;
    public VpsServer $vpsserver;
    public VpsAccounts $vpsAccount;
    public $vpsAccountId;
    public $vpsAccountName;
    public $vpsAccountType;
    public $vpsAccountPassword;
    public $vpsAccountStatus;
    public $vpsAccountIpAddress;

    public function getApiResponse($apiType, $params = [])
    { 
        $apiUrl = $this->vpsserver->ip_address . '/' . $apiType;
        $response = Http::post($apiUrl, $params);
        return json_decode($response->body(), true);
    }
    public function mount($vpsserverId)
    {
        $this->vpsserver = VpsServer::find($vpsserverId);
        $this->vpsAccount = VpsAccounts::where('vpsserver_id', $this->vpsserver->id)->first();
        $this->vpsAccountId = $this->vpsAccount->id;
        $this->vpsAccountName = $this->vpsAccount->name;
        $this->vpsAccountType = $this->vpsAccount->type;
        $this->vpsAccountPassword = Hash::make($this->password);
        $this->vpsAccountStatus = $this->getApiResponse('status');
        $this->vpsAccountIpAddress = $this->getApiResponse('ip_address');
    }
        
    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.check-server-account')
            ->extends('layouts.admin')
            ->section('content');
            
    }
}
