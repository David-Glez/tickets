@extends('layouts.home')

@section('content')

<div class = 'flex flex-col'>
    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
        <div class="mb-2 border-solid border-gray-300 rounded border shadow-sm w-full">
            <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                Nuevo Ticket
            </div>
            <div class="p-3">
            <form class="w-full" method="POST" action="{{route('ticket-create')}}" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-first-name">
                            Titulo
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="text"
                                name = 'titulo'
                                value="{{ old('titulo') }}"
                                required 
                                placeholder="Titulo">
                        @error('titulo')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Prioridad
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-state"
                                    name = 'priority'
                                    required
                                    >
                                <option value="">Selecciona una opcion</option>
                                @foreach($priority as $priorit)
                                <option value="{{$priorit->id}}">{{$priorit->name}}</option>
                                @endforeach
                            </select>
                            @error('priority')
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
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Proyecto
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                    id="grid-state"
                                    name = 'project'
                                    required
                                    >
                                <option value="">Selecciona una opcion</option>
                                @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->empresa}}</option>
                                @endforeach
                            </select>
                            @error('projects')
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
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-light mb-1"
                                for="grid-first-name">
                            Evidencia
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="file"
                                name = 'evidencia'
                                placeholder="Titulo">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1">
                            Asignar a
                        </label>
                        <div>
                            <select id="usuarios"required x-cloak>
                                @foreach($users as $usuario)
                                    <option value="{{$usuario->id}}" >
                                        {{$usuario->name}}
                                    </option>
                                    
                                @endforeach
                            </select>
                            <div x-data="dropdown()" x-init="loadOptions()" class="w-full md:w-1/2 flex flex-col items-center  mx-auto">
                            <input name="usuarios" type="hidden" x-bind:value="selectedValues()">
  <div class="inline-block relative w-64">
    <div class="flex flex-col items-center relative">
      <div x-on:click="open" class="w-full">
        <div class="my-2 p-1 flex border border-gray-200 bg-white rounded">
          <div class="flex flex-auto flex-wrap">
            <template x-for="(option,index) in selected" :key="options[option].value">
              <div class="flex justify-center items-center m-1 font-medium py-1 px-1 bg-white rounded bg-gray-100 border">
                <div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option] x-text="options[option].text"></div>
                <div class="flex flex-auto flex-row-reverse">
                  <div x-on:click.stop="remove(index,option)">
                    <svg class="fill-current h-4 w-4 " role="button" viewBox="0 0 20 20">
                      <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                           c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                           l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                           C14.817,13.62,14.817,14.38,14.348,14.849z" />
                    </svg>

                  </div>
                </div>
              </div>
            </template>
            <div x-show="selected.length == 0" class="flex-1">
              <input placeholder="Select a option" class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800" x-bind:value="selectedValues()">
            </div>
          </div>
          <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

            <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
              <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
	c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
	L17.418,6.109z" />
              </svg>

            </button>
            <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
              <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
	c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
	" />
              </svg>

            </button>
          </div>
        </div>
      </div>
      <div class="w-full px-4">
        <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
          <div class="flex flex-col w-full overflow-y-auto ">
            <template x-for="(option,index) in options" :key="option" class="overflow-auto">
              <div class=" w-full border-gray-100 rounded-t border-b hover:bg-gray-100" @click="select(index,$event)">
                <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                  <div class="w-full items-center flex justify-between">
                    <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                    <div x-show="option.selected">
                      <svg class="svg-icon" viewBox="0 0 20 20">
                        <path fill="none" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
							C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
							L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                            @error('users')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>>
                            @enderror
                            
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            Fecha de entrega
                        </label>
                        <div class="relative">
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="date"
                                min="{{date('Y-m-d')}}"
                                name = 'date_expired'
                                required 
                                placeholder="Fecha">
                            @error('date_expired')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>>
                            @enderror
                            
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-state">
                            hora de entrega
                        </label>
                        <div class="relative">
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white-500"
                                id="grid-first-name" 
                                type="time"
                                min="{{Now()}}"
                                name = 'hour_expired'
                                required 
                                placeholder="hora">
                            @error('hour_expired')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>>
                            @enderror
                            
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1"
                                for="grid-password">
                            Descripcion
                        </label>
                        <textarea class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="grid-password"
                                name = 'description'></textarea>
                        
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                type="submit">
                            Solicitar
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function dropdown() {
    return {
        options: [],
        selected: [],
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
        select(index, event) {

            if (!this.options[index].selected) {

                this.options[index].selected = true;
                this.options[index].element = event.target;
                this.selected.push(index);

            } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false
            }
        },
        remove(index, option) {
            this.options[option].selected = false;
            this.selected.splice(index, 1);


        },
        loadOptions() {
            const options = document.getElementById('usuarios').options;
            for (let i = 0; i < options.length; i++) {
                this.options.push({
                    value: options[i].value,
                    text: options[i].innerText,
                    selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                });
            }


        },
        selectedValues(){
            return this.selected.map((option)=>{
                return this.options[option].value;
            })
        }
    }
}
    
    
</script>

@endsection
