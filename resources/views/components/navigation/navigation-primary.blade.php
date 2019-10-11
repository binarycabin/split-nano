@if(\Auth::user())
    <a href="{{ url('/dashboard') }}" class="px-4 no-underline py-4 inline-block font-bold text-blue-200 hover:text-white" >Dashboard</a>
    <a href="javascript:document.getElementById('logout-form').submit();" class="px-4 no-underline py-4 inline-block font-bold text-blue-200 hover:text-white" >Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST"
          class="hidden">
        {{ csrf_field() }}
    </form>
@else

    <a href="{{ url('/login') }}" class="px-4 no-underline py-4 inline-block font-bold text-blue-200 hover:text-white @if(request()->is('login*')) active @endif " >Login</a>
    <a href="{{ url('/register') }}" class="ml-4 no-underline btn bg-blue-700 shadow inline-block px-6 py-3 text-white rounded-full font-bold hover:text-blue-600 hover:bg-white">Create an Account</a>

 @endif
