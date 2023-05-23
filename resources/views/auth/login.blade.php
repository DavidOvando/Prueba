@php
$container = 'container-fluid';
@endphp


@extends('layouts/blankLayout')
@section('title', 'Login')

@section('vendor-script')
@endsection

@section('page-script')
@endsection





<!DOCTYPE html>
<html lang="en">
<div class="row">
    <div class="col-lg-12 mb-4 order-0 card text-center">
        <div class="card-body" id="app">
            <div class="row row-bordered g-0">
                <div class="col-md-12">
                    <div class="container col-md-4 text-center">
                        <div class="authentication-wrapper authentication-basic container-p-y">
                            <div class="authentication-inner">
                            <div class="card">
                                <div class="card-body">
                                <div class="app-brand justify-content-center">
                                    <a href="{{url('/')}}" class="app-brand-link gap-2">
                                    <span class="app-brand-logo demo"><i class='bx bx-movie-play bx-flip-horizontal bx-tada bx-lg' ></i></span>
                                    <span class="app-brand-text  text-body fw-bolder">Actor</span>
                                    </a>
                                </div>
                                <h4 class="mb-2">Bienvenido</h4>
                                <p class="mb-4">Por favor ingresa tu correo y contraseña para empezar</p>
                                    <div id="app">
                                        <login-index></login-index>
                                    </div>
                                </div>
                            </div>
                            </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</html>
