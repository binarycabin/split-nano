<!DOCTYPE html>
<html lang="en">

@include('layouts.dashboard.components.head')

<body class="bg-blue-900 font-sans leading-normal tracking-normal mt-12">

<div id="app" class="flex flex-col justify-between min-h-screen" v-cloak>
    @include('layouts.dashboard.components.navbar')
    <div class="flex flex-col md:flex-row">
        @include('layouts.dashboard.components.sidebar')
        <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
            @yield('content')
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
@include('components.notifications.notifications')


<script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('invisible')) {
                    openDropdown.classList.add('invisible');
                }
            }
        }
    }
</script>


</body>

</html>