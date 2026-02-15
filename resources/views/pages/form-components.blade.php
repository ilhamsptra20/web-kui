@extends('layouts.app')

@section('title', 'Form Components')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Form Component</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form>
                @csrf
                {{-- Case 1: Floating Label dengan Icon (Sesuai revisi lu) --}}
                <x-form.input 
                    name="phone" 
                    label="Phone Number" 
                    icon="phone" 
                    floating 
                />

                {{-- Case 2: Floating Label dengan Icon + Garis Divider --}}
                <x-form.input 
                    name="email" 
                    label="Email" 
                    icon="mail" 
                    floating 
                    divider
                />

                {{-- Case 3: Label Biasa (Standard) --}}
                <x-form.input 
                    name="address" 
                    label="Home Address" 
                    placeholder="Jl. Merdeka No. 1" 
                />

                {{-- Input Floating Label --}}
                <x-form.input name="email" label="Email Address" floating />

                {{-- Select2 --}}
                <x-form.select name="role" label="Pilih Role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </x-form.select>

                {{-- Datepicker --}}
                <x-form.datepicker name="birthday" label="Tanggal Lahir" />

                {{-- Switch --}}
                <x-form.switch name="switch1" label="Toggle this switch element" />
                <x-form.switch name="switch3" label="Success Color" color="success" checked />
                <x-form.switch name="switch9" on="On" off="Off" />
                <x-form.switch name="switch10" icon="check" iconRight="bell" color="primary" />
                    {{-- Large Size --}}
                <x-form.switch name="switch100" size="lg" on="Agree" off="Disagree" label="Large Switch" color="success" />

                {{-- Medium Size --}}
                <x-form.switch name="switch90" size="md" on="True" off="False" label="Medium Switch" color="danger" />

                {{-- Checkbox --}}
                <x-form.check name="agree" label="Saya setuju" color="danger" />

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection


