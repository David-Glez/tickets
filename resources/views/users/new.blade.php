@extends('layouts.home')

@section('content')

<div class = 'flex flex-col'>
    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                Nuevo Usuario
            </div>
            <div class="p-3">
            <form class="w-full" method="POST" action="{{ route('user-create') }}">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-first-name">
                            Nombre(s)
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="text"
                                name = 'names'
                                value="{{ old('names') }}"
                                required 
                                placeholder="Nombre(s)">
                        @error('username')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Apellidos
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="text"
                                name = 'last_name'
                                value="{{ old('last_name') }}"
                                required 
                                placeholder="Apellidos">
                        @error('last_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Departamento
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-state"
                                    name = 'department'
                                    required
                                    >
                                <option value="">Selecciona una opcion</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>>
                            @enderror
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-first-name">
                            Nombre de usuario
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="text"
                                name = 'username'
                                value="{{ old('username') }}"
                                required 
                                placeholder="Nombre de usuario">
                        @error('username')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Email
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="email"
                                name = 'email'
                                value="{{ old('email') }}"
                                required 
                                placeholder="Email">
                        @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Rol
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-state"
                                    name = 'role'
                                    required
                                    >
                                <option value="">Selecciona una opcion</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>>
                            @enderror
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-first-name">
                            Contraseña
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="password"
                                name = 'password'
                                value="{{ old('password') }}"
                                required 
                                placeholder="********">
                        @error('password')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Confirmar Contraseña
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="password_confirm" 
                                type="password"
                                name = 'password_confirmation'
                                value="{{ old('password_confirmation') }}"
                                required 
                                placeholder="********">
                        @error('password-confirm')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Proyecto
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-state"
                                    name = 'empresa'
                                    required
                                    >
                                <option value="">Selecciona una opcion</option>
                                @foreach($bussines as $item)
                                <option value="{{$item->id}}">{{$item->empresa}}</option>
                                @endforeach
                            </select>
                            @error('empresa')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>>
                            @enderror
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                type="submit">
                            Añadir usuario
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection