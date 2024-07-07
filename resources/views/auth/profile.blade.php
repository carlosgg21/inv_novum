@extends('layouts.app')
@section('title', 'Perfil')
@section('content')




<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Perfil</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <x-breadcrumb route="home" home="Inicio" title="Perfil del usuario"></x-breadcrumb>


        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30">
                    {{-- <img src="../assets/images/users/5.jpg" class="img-circle" width="150" /> --}}
                    <h4 class="card-title m-t-10">
                        {{ auth()->user()->name }}

                    </h4>
                    <h6 class="card-subtitle">
                        {{ auth()->user()->charge->name }}<br>
                        {{ auth()->user()->unit->name }}
                    </h6>
                    {{-- <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                <font class="font-medium">254</font>
                            </a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                                <font class="font-medium">54</font>
                            </a></div>
                    </div> --}}
                </center>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body"> <small class="text-muted">Correo electrónico </small>
                <h6>{{ auth()->user()->email }}</h6>
                {{-- <small class="text-muted p-t-30 db">Phone</small>
                <h6>+91 654 784 547</h6> <small class="text-muted p-t-30 db">Address</small>
                <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6> --}}

                <small class="text-muted p-t-30 db">Roles</small>
                <br />
                @foreach (auth()->user()->roles as $item)
                <h6> {{ $item->name }}</h6><br>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <x-message></x-message>
        <div class="card">
            <div class="card-body">
                <h4>Cambiar contraseña</h4>

                <form class="form-horizontal form-material"
                    action="{{ route('users.change-password',auth()->user()->id) }}" method="POST">
                    @csrf

                    @method('PUT')



                    <div class="form-group">
                        <label class="col-md-12">Usuario</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="{{ auth()->user()->email }}" disabled
                                class="form-control form-control-line">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Nueva contraseña</label>
                        <div class="col-md-12">
                            <input type="password" value="password" name="password" autocomplete="off"
                                autocomplete="nope" class="inputPassword form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Confirmar contraseña</label>
                        <div class="col-md-12">
                            <input type="password" value="password" name="confirm-password" autocomplete="off"
                                autocomplete="nope" class="inputPassword form-control form-control-line">
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="showPass">
                            <label class="form-check-label" for="showPass">
                                Mostrar contraseña
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success btn-sm">Actualizar contraseña</button>
                        </div>
                    </div>



            </div>
        </div>
    </div>
</div>
<!-- ======================================================== -->
<!-- End PAge Content -->


@endsection
@section('js')
<script>
    $(document).ready(function(){
            $('#showPass').click(function(){
            //  alert($(this).is(':checked'));
                // $(this).is(':checked') ? $("input[type='password']").attr('type', 'text') : $("input[type='password']").attr('type', 'password');
                $(this).is(':checked') ? $(".inputPassword").attr('type', 'text') : $(".inputPassword").attr('type', 'password');
            });
        });
</script>
@endsection