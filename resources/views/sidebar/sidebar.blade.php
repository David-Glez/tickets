<aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
    <ul class="list-reset flex flex-col">
        <li class=" w-full h-full py-3 px-2 border-b border-light-border bg-white">
            <a href="{{ url('/home') }}"
                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-tachometer-alt float-left mx-2"></i>
                Inicio
                <span><i class="fas fa-angle-right float-right"></i></span>
            </a>
        </li>
        @can('logs.show')
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{route('activity')}}"
                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-clipboard-list float-left mx-2"></i>
                Actividad
            </a>
        </li>
        @endcan
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{route('index-ticket')}}"
                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fab fa-wpforms float-left mx-2"></i>
                Tickets
                <span><i class="fa fa-angle-right float-right"></i></span>
            </a>
            <ul class="list-reset -mx-2 bg-white-medium-dark">
                @can('ticket.create')
                <li class="border-t mt-2 border-light-border w-full h-full px-2 py-3">
                    <a href="{{route('new-ticket')}}"
                        class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                        Añadir ticket
                        <span><i class="fa fa-angle-right float-right"></i></span>
                    </a>
                </li>
                @endcan
                @can('ticket.show')
                <li class="border-t mt-2 border-light-border w-full h-full px-2 py-3">
                    <a href="{{route('my-tickets')}}"
                        class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                        Tickets Solicitados
                        <span><i class="fa fa-angle-right float-right"></i></span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @can('user.show')
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{route('index-user')}}"
                class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                <i class="fas fa-grip-horizontal float-left mx-2"></i>
                Usuarios
                <span><i class="fa fa-angle-right float-right"></i></span>
            </a>
            <ul class="list-reset -mx-2 bg-white-medium-dark">
                @can('user.create')
                <li class="border-t mt-2 border-light-border w-full h-full px-2 py-3">
                    <a href="{{route('new-user')}}"
                        class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline">
                        Añadir usuario
                        <span><i class="fa fa-angle-right float-right"></i></span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
    </ul>

</aside>