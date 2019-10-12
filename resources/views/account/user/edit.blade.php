@extends('layouts.dashboard.app')

@section('content')

    @component('components.layout.dashboard.title')
        User Profile
    @endcomponent

    <div class="bg-white border-transparent rounded shadow m-4 p-4">
        {!! Former::open_vertical_for_files('/account/user')->method('PATCH') !!}
        {!! Former::populate(\Auth::user()) !!}

        {!! Former::text('name','Name') !!}
        {!! Former::text('email','Email Address') !!}
        {!! Former::password('password','Password')->help('Leave blank to keep existing') !!}

        <div class="form-group">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-3/4 mr-4">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>

        {!! Former::close() !!}
    </div>

@endsection
