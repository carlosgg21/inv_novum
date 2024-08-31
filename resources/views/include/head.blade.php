<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- assets/favicon icon -->

<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
<title>{{ config('app.name') }} - @yield('title')</title>
<!-- Custom CSS -->

<!-- Custom CSS -->
<link href="{{ asset('assets/dist/css/style.css') }}" rel="stylesheet">



<style>
  .required-field {
    color: red;
  }


  .btn-info-t {
    color: #fff;
    background-color: #078264;
    border-color: #078264;
  }

  .btn-info-t:hover {
    color: #fff;
    background-color: #078264;
    border-color: #078264;


  }

  input[type='radio']:hover {
    cursor: pointer !important;
  }


  ul.list-icons {
    margin: 0px;
    padding: 0px;
  }

  ul.list-icons li {
    list-style: none;
    line-height: 30px;
    margin: 5px 0;
    transition: 0.2s ease-in;
  }

  ul.list-icons li a {
    color: #212529;
  }

  ul.list-icons li a:hover {
    color: #fb9678;
  }

  ul.list-icons li i {
    font-size: 13px;
    padding-right: 8px;
  }


  input[type="checkbox"] {
    cursor: pointer;
  }
  .badge-denied{
    background-color: #B80000 !important;
    color: white;
  }



  /* Quitar los spinners de los campos de tipo number */
  input[type="number"] {
  -moz-appearance: textfield; /* Firefox */
  }
  
  input[type="number"]::-webkit-inner-spin-button,
  input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none; /* Chrome, Safari, Edge */
  margin: 0; /* Eliminar margen */
  }
  
  /* Hacer que los inputs tengan esquinas cuadradas */
  .form-control,
  .custom-select {
  border-radius: 0 !important; /* Establecer radio de borde a 0 para esquinas cuadradas */
  }
  .select2-selection{
    border-radius: 0 !important; /* Establecer radio de borde a 0 para esquinas cuadradas */
  }

  .column-separator {
  border-bottom: 2px solid #00C292; /* Línea azul a la derecha */

  }
</style>