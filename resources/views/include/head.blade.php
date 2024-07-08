<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- assets/favicon icon -->

<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
<title>{{ config('app.name') }} - @yield('title')</title>
<!-- Custom CSS -->

<!-- Custom CSS -->
<link href="{{ asset('assets/dist/css/style.css') }}" rel="stylesheet">



<style>
  .requiredInput {
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
</style>