<?php

namespace App\Livewire\Admin;

use App\Models\Server;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateServer extends Component
{
    use WithFileUploads;

    public $image, $name, $android = false, $ios = false, $macos = false, $windows = false, $longitude, $latitude, $type, $status;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'android' => 'required|boolean',
            'ios' => 'required|boolean',
            'macos' => 'required|boolean',
            'windows' => 'required|boolean',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'type' => 'required|in:company,normal',
            'status' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:20420',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ];
    }

    public function store()
    {
        $this->validate();

         /** @var \App\Models\Server $server **/
        $server = Server::create([
            'name' => $this->name,
            'android' => $this->android,
            'ios' => $this->ios,
            'macos' => $this->macos,
            'windows' => $this->windows,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        if ($this->image) {
            $server->clearMediaCollection('image');
            $server->addMedia($this->image->getRealPath())
                ->usingFileName(time() . '_server_' . $server->id . '.' . $this->image->getClientOriginalExtension())
                ->toMediaCollection('image');
        }

        return redirect()->intended(route('admin.servers'))->with('message', 'Server added successfully.');
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.admin.create-server')
            ->extends('layouts.admin')
            ->section('content');
    }
}
