<header class="header">
    <div class="container mx-auto">
        <div class="flex justify-between px-2">
            <div class="brand-container self-center">
                <a class="brand text-white inline-block py-4 font-black text-2xl" href="{{ url('/') }}">
                    <?php /*<img src="{{ url('/img/logo-white.png') }}" alt="{{ config('app.name') }}" style="max-height:40px;" />*/ ?>
                    {{ config('app.name') }}
                </a>
            </div>
            <?php /*
            <div class="navbar-toggle-container self-center">
                <button class="btn btn-primary" v-on:click="expandMenu('navigation-main')">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div> */ ?>
            <nav class="nav-primary self-center">
                <div class="top-navigation">
                    @include('components.navigation.navigation-primary')
                </div>
            </nav>
        </div>
    </div>
</header>
