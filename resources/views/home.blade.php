@extends('layouts.app' , ['user' => $user])
@section('content')
    <keep-alive>
        <transition name="slide-in-left">
            <router-view></router-view>
        </transition>
    </keep-alive>
@endsection
