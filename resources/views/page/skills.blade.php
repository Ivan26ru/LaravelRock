@extends('layouts.my-app')

@section("page.title", 'Skills')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Developers this Exclusive project Ivan</h1>

                <ul class="list-group">
                    @foreach($mySkills as $skill)
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" checked value="" id="{{$skill}}">
                            <label class="form-check-label stretched-link" for="{{$skill}}">{{$skill}}</label>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
@endsection
