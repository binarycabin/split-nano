<!--Nav-->
<nav class="bg-blue-600 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

    <div class="flex flex-wrap items-center">
        <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
            <a class="brand text-white inline-block py-2 px-2 font-black text-2xl" href="{{ url('/dashboard') }}">
                <img src="{{ url('/img/logo.svg') }}" alt="{{ config('app.name') }}" style="max-height:40px; height:16px;" />
            </a>
        </div>

        <?php /*@component('layouts.dashboard.mock.header-search')*/ ?>

        <div class="flex ml-auto w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
            <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                <li class="md:flex-1 md:flex-none md:mr-3 ml-auto md:ml-0 self-end">
                    <div class="relative inline-block">
                        <button onclick="toggleDD('myDropdown')" class="drop-button text-white focus:outline-none"> <span class="pr-2"><i class="em em-robot_face"></i></span> Hi, {{ \Auth::user()->name }} <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg></button>
                        <div id="myDropdown" style="min-width:190px;" class="dropdownlist absolute bg-blue-900 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                            <a href="{{ url('/dashboard') }}" class="p-2 hover:bg-blue-800 text-white text-sm no-underline hover:no-underline block">
                                <i class="fas fa-tachometer-alt fa-fw"></i> Dashboard
                            </a>
                            <a href="{{ url('/account/user') }}" class="p-2 hover:bg-blue-800 text-white text-sm no-underline hover:no-underline block">
                                <i class="fa fa-user fa-fw"></i> Update Profile
                            </a>
                            <div class="border border-blue-800"></div>
                            <a href="javascript:document.getElementById('logout-form').submit();" class="p-2 hover:bg-blue-800 text-white text-sm no-underline hover:no-underline block">
                                <i class="fas fa-sign-out-alt fa-fw"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  class="hidden">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</nav>