@extends('layouts.app')

@section('styles')
    {{-- datepeaker --}}
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/pickers/pickadate/pickadate.css">

    {{-- number input --}}
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">

    {{-- slect --}}
    <link rel="stylesheet" type="text/css" href="assets/vendors/css/forms/select/select2.min.css">

    {{-- form validation --}}
    <link rel="stylesheet" type="text/css" href="assets/css/plugins/forms/validation/form-validation.css">


    {{-- form wizard --}}
    <link rel="stylesheet" type="text/css" href="assets/css/plugins/forms/wizard.css">

@endsection

@section('content')
{{-- checkbox --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Checkbox</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                </li>
                                <li class="breadcrumb-item active">Checkbox
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Checkbox start -->
            <section class="basic-checkbox">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Checkboxes</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <label>
                                                    <input type="checkbox" value="" checked>
                                                    Active
                                                </label>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <label>
                                                    <input type="checkbox" value="">
                                                    Inactive
                                                </label>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <label>
                                                    <input type="checkbox" value="" disabled checked>
                                                    Active - disabled
                                                </label>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <label>
                                                    <input type="checkbox" value="" disabled>
                                                    Inactive - disabled
                                                </label>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Checkbox end -->

            <!-- Custom Checkbox start -->
            <section class="custom-checkbox">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Custom Checkboxes</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Add <code>.custom-control .custom-checkbox</code> as a single wrapper &amp; add
                                        <code>.custom-control-label</code> for better output.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked name="customCheck" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">Active</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck2">
                                                    <label class="custom-control-label" for="customCheck2">Inactive</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked name="customCheck" id="customCheck3" disabled>
                                                    <label class="custom-control-label" for="customCheck3">Active - disabled</label>
                                                </div>
                                            </fieldset>

                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" disabled id="customCheck4">
                                                    <label class="custom-control-label" for="customCheck4">Inactive - disabled</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Custom Checkbox end -->

            <!-- Vuexy Checkbox start -->
            <section class="vuexy-checkbox">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vuexy Checkboxes</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>To add a checkBox, we have the <code>.vs-checkbox-con</code> as a wrapper. Also use <code>.vs-checkbox</code> for better output.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Active</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Inactive</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" disabled="disabled" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Active - disabled</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" disabled="disabled" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Inactive - disabled</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Vuexy Checkbox end -->

            <!-- Vuexy Checkbox Color start -->
            <section class="vuexy-checkbox-color">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Color</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>To change the color of the checkBox use the <code>.vs-checkbox-{value}</code> for primary, success, danger, info, warning.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Primary</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-success">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Success</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-danger">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Danger</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-info">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Info</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-warning">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Warning</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Vuexy Checkbox Color end -->

            <!-- Vuexy Checkbox Icon start -->
            <section class="vuexy-checkbox-icon">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Change Icon</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Use <code>.vs-icon</code> to change change the internal icon inside the checkbox.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Primary</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-success">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-message-square"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Success</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-danger">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-x"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Danger</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-info">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-paperclip"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Info</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-warning">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-bold"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Warning</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Vuexy Checkbox icon end -->

            <!-- Vuexy Checkbox Sizes start -->
            <section class="vuexy-checkbox-sizes">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vuexy Checkboxes Sizes</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>To add a checkBox with different sizes, we have the <code>.vs-checkbox-sm</code> and <code>.vs-checkbox-lg</code> for small and large checkboxes respectively. Add it alongwith <code>.vs-checkbox</code> class.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Small</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Default</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" checked value="false">
                                                    <span class="vs-checkbox vs-checkbox-lg">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Large</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Vuexy Checkbox Sizes end -->

        </div>
    </div>
</div>

{{-- datepeaker --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Date &amp; Time Picker</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                </li>
                                <li class="breadcrumb-item active">Date &amp; Time Picker
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Pick-A-Date Picker start -->
            <section id="pick-a-date">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h4>Date Picker</h4>
                                <p class="mb-2">The basic setup requires targetting an <code>input</code> element and invoking the picker.</p>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Default</h5>
                                <p>Use <code>.pickadate</code> class for basic Pick-A-Date Picker.</p>
                                <form>
                                    <input type='text' class="form-control pickadate" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Format Date Picker</h5>
                                <p>Set<code>format</code> attribute for basic change format of date.</p>
                                <form>
                                    <input type='text' class="form-control format-picker" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Min-Max Date Range</h5>
                                <p>Use <code>.pickadate-limits</code> class for min. and max. date range.</p>
                                <form>
                                    <input type='text' class="form-control pickadate-limits" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Translation</h5>
                                <p>Use <code>.pickadate-translations</code> class for language translation.</p>
                                <form>
                                    <input type='text' class="form-control pickadate-translations" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Pick-a-date with short string</h5>
                                <p>Use <code>.pickadate-short-string</code> class for short Month & Week String.</p>
                                <form>
                                    <input type='text' class="form-control pickadate-short-string" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Change First Weekday</h5>
                                <p>Use <code>.pickadate-firstday</code> class to change first weekday to Monday.</p>
                                <form>
                                    <input type='text' class="form-control pickadate-firstday" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Select Month & Year</h5>
                                <p>Use <code>.pickadate-months-year</code> class for display select menus to pick the month & year.</p>
                                <form>
                                    <input type='text' class="form-control pickadate-months-year" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Disabled Dates & Weeks</h5>
                                <p>Use <code>.pickadate-disable</code> class for disabled dates or weeks. (such as all Sun.1th day of week and 1st and 3rd Sat.).</p>
                                <form>
                                    <input type='text' class="form-control pickadate-disable" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Pick-A-Date Picker end -->


            <!-- Pick-A-Time Picker start -->
            <section id="pick-a-time">
                <div class="card">
                    <div class="card-body">
                        <div class="row match-height">
                            <div class="col-12">
                                <h4 class="mb-1">Time Picker</h4>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Default</h5>
                                <p>Use <code>.pickatime</code> class for basic Pick-a-Time Picker.</p>
                                <form>
                                    <input type='text' class="form-control pickatime" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Change Formats</h5>
                                <p>Use <code>.pickatime-format</code> class to change time display formats.</p>
                                <form>
                                    <input type='text' class="form-control pickatime-format" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Format with Label</h5>
                                <p>Use <code>.pickatime-formatlabel</code> class to display time label format.</p>
                                <form>
                                    <input type='text' class="form-control pickatime-formatlabel" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Intervals</h5>
                                <p>Use <code>.pickatime-intervals</code> class to display time in Intervals.</p>
                                <form>
                                    <input type='text' class="form-control pickatime-intervals" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Disable set of Time</h5>
                                <p>Use <code>.pickatime-disable</code> class to disable time hours.</p>
                                <form>
                                    <input type='text' class="form-control pickatime-disable" />
                                </form>
                            </div>
                            <div class="col-md-6 col-12 mb-1">
                                <h5 class="text-bold-500">Minimum and maximum time range</h5>
                                <p>Use <code>.pickatime-min-max</code> class for Start Time & End Time.</p>
                                <form>
                                    <input type='text' class="form-control pickatime-min-max" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Pick-A-Time Picker end -->

        </div>
    </div>
</div>


{{-- input groups --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Input Groups</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Forms</a>
                                </li>
                                <li class="breadcrumb-item active">Input Groups
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Inputs Groups start -->
            <section id="basic-input-groups">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Input Groups</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Add span with <code>.input-group-text</code> class <b>before</b> <code>&lt;input&gt;</code> for input-group-prepend and add span with <code>.input-group-text</code> class <b>after</b> <code>&lt;input&gt;</code> for input-group-append.</p>
                                    <div class="row">
                                        <div class="col-md-4 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">@</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Addon to Left" aria-describedby="basic-addon1">
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Addon To Right" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Addon On Both Side" aria-label="Amount (to the nearest dollar)">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Inputs Groups end -->

            <!-- Inputs Group Checkbox and Radio Buttons end -->
            <section id="input-group-checkbox-radio">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Groups with Checkboxes and Radios</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Input Groups can use with checkboxes and radio buttons also. For it add code for <code>.vs-checkbox-con</code> class and <code>.vs-radio-con</code>.</p>
                                    <div class="row">
                                        <div class="col-sm-6 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <div class="vs-checkbox-con">
                                                                <input type="checkbox" checked value="false">
                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <div class="vs-radio-con">
                                                                <input type="radio" name="vueradio" value="false">
                                                                <span class="vs-radio vs-radio-sm">
                                                                    <span class="vs-radio--border"></span>
                                                                    <span class="vs-radio--circle"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" aria-label="Text input with radio button">
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Inputs Group Checkbox and Radio Buttons end -->

            <!-- Inputs Group Sizes -->
            <section id="input-group-size">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Groups with different sizes</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Add <code>.input-group-{lg/sm}</code> class to <code>.input-group</code> for Large/Small addon/prepend.</p>
                                    <div class="row">
                                        <div class="col-sm-6 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group input-group-lg">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="sizing-addon1">@</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Large Addon" aria-describedby="sizing-addon1">
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="sizing-addon3">@example.com</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Small Addon" aria-describedby="sizing-addon3">
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Inputs Group Sizes end -->

            <!-- Inputs Group with Buttons -->
            <section id="input-group-buttons">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Groups with Buttons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Add span with <code>.input-group-btn</code> class and add button inside <b>before</b> or <b>after</b> <code>&lt;input&gt;</code>.</p>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon2">
                                                    <div class="input-group-append" id="button-addon2">
                                                        <button class="btn btn-primary" type="button">Go</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary" type="button"><i class="feather icon-search"></i></button>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Button on both side" aria-label="Amount">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">Search !</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Inputs Group with Buttons end -->

            <!-- Inputs Group with Dropdown -->
            <section id="input-group-dropdown">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Groups with Dropdown</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Add <code>&lt;button&gt;</code> with <code>.dropdown-toggle</code> class and add dropdown-menu after it to get input group with dropdown.</p>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                            <div role="separator" class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Dropdown on left">
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <fieldset>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                            <div role="separator" class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Dropdown on both side" aria-label="Amount">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                            <div role="separator" class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Inputs Group with Dropdown end -->

        </div>
    </div>
</div>

{{-- form input --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Input</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                </li>
                                <li class="breadcrumb-item active">Input
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Inputs</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="basicInput">Basic Input</label>
                                                <input type="text" class="form-control" id="basicInput" placeholder="Enter email">
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="helpInputTop">Input text with help</label>
                                                <small class="text-muted">eg.<i>someone@example.com</i></small>
                                                <input type="text" class="form-control" id="helpInputTop">
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="disabledInput">Disabled Input</label>
                                                <input type="text" class="form-control" id="disabledInput" disabled>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <label for="helperText">With Helper Text</label>
                                                <input type="text" id="helperText" class="form-control" placeholder="Name">
                                                <p><small class="text-muted">Find helper text here for given textbox.</small></p>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <label for="disabledInput">Readonly Input</label>
                                                <input type="text" class="form-control" id="readonlyInput" readonly="readonly" value="You can't update me :P">
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <label for="disabledInput">Static Text</label>
                                                <p class="form-control-static" id="staticInput">email@pixinvent.com</p>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Inputs end -->

            <!-- Input Style start -->
            <section id="input-style">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Styles</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>To set rounded border to input box, use <code>.round</code> class and
                                                to set square border to input box, use <code>.sqaure</code> class alongwith <code>.form-control</code> class.</p>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <fieldset class="form-group">
                                                <label for="roundText">Rounded Input</label>
                                                <input type="text" id="roundText" class="form-control round" placeholder="Rounded Input">
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <fieldset class="form-group">
                                                <label for="squareText">Square Input</label>
                                                <input type="text" id="squareText" class="form-control square" placeholder="square Input">
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Input Style end -->

            <!-- Floating Label Inputs start -->
            <section id="floating-label-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Floating Label Inputs</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>For Flating Label Inputs, need to use <code>.form-label-group</code> class & add attribute <code>disabled</code> for disabled Floating Label Input.</p>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control" id="floating-label1" placeholder="Label-placeholder">
                                                <label for="floating-label1">Label-placeholder</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control" id="floating-label-disable" placeholder="Label-placeholder" disabled>
                                                <label for="floating-label-disable">Disabled-placeholder</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Floating Label Inputs end -->

            <!-- Basic File Browser start -->
            <section id="input-file-browser">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <label class="card-title">File input</label>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label for="basicInputFile">Simple File Input</label>
                                                <input type="file" class="form-control-file" id="basicInputFile">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <fieldset class="form-group">
                                                <label for="basicInputFile">With Browse button</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic File Browser end -->

            <!-- validations start -->
            <section class="validations" id="validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Validation States</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>You can indicate invalid and valid form fields with <code>.is-invalid</code> and <code>.is-valid</code>. Note that <code>.invalid-feedback</code> is also supported with these classes.</p>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <label for="valid-state">Valid State</label>
                                            <input type="text" class="form-control is-valid" id="valid-state" placeholder="Valid" value="Valid" required>
                                            <div class="valid-feedback">
                                                This is valid state.
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <label for="invalid-state">Invalid State</label>
                                            <input type="text" class="form-control is-invalid" id="invalid-state" placeholder="Invalid" value="Invalid" required>
                                            <div class="invalid-feedback">
                                                This is invalid state.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- validations end -->

            <!-- Tooltip validations start -->
            <section class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input Validation States with Tootltips</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p><code>.{valid/invalid}-feedback</code> classes for <code>.{valid/invalid}-tooltip</code> classes to display validation feedback in a styled tooltip.</p>
                                    <form class="needs-validation" novalidate>
                                        <div class="form-row">
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="validationTooltip01">First name</label>
                                                <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" value="Mark" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="validationTooltip02">Last name</label>
                                                <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="validationTooltip03">City</label>
                                                <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required>
                                                <div class="invalid-tooltip">
                                                    Please provide a valid city.
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Tooltip validations end -->

            <!-- Input with Icons start -->
            <section id="input-with-icons">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Input with Icons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>For Input Box with left side icon, use class <code>.has-icon-left</code> and for use divider between icon and input text box use <code>.input-divider-left</code> or <code>.input-divider-right</code> for left and right divider respectively.</p>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2 mb-1">
                                                Left Icon
                                            </div>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="iconLeft1" placeholder="Icon Left, Default Input">
                                                <div class="form-control-position">
                                                    <i class="feather icon-phone"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2 mb-1">
                                                Right Icon
                                            </div>
                                            <fieldset class="form-group position-relative">
                                                <input type="text" class="form-control" id="iconLeft2" placeholder="Icon Right, Default Input">
                                                <div class="form-control-position">
                                                    <i class="feather icon-file"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2 mb-1">
                                                Left Icon with Divider
                                            </div>
                                            <fieldset class="form-group position-relative has-icon-left input-divider-left">
                                                <input type="text" class="form-control" id="iconLeft3" placeholder="Icon Left, Default Input">
                                                <div class="form-control-position">
                                                    <i class="feather icon-phone"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2 mb-1">
                                                Right Icon with divider
                                            </div>
                                            <fieldset class="form-group position-relative input-divider-right">
                                                <input type="text" class="form-control" id="iconLeft4" placeholder="Icon Right, Default Input">
                                                <div class="form-control-position">
                                                    <i class="feather icon-file"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Floating Label Input with Icons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                Left Icon
                                            </div>
                                            <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="iconLabelLeft" placeholder="Icon Left, Default Input">
                                                <div class="form-control-position">
                                                    <i class="feather icon-phone"></i>
                                                </div>
                                                <label for="iconLabelLeft">Icon Left, Default Input</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                Right Icon
                                            </div>
                                            <fieldset class="form-label-group form-group position-relative">
                                                <input type="text" class="form-control" id="iconLabelRight" placeholder="Icon Right, Default Input">
                                                <div class="form-control-position">
                                                    <i class="feather icon-file"></i>
                                                </div>
                                                <label for="iconLabelRight">Icon Right, Default Input</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                Left Icon with Divider
                                            </div>
                                            <fieldset class="form-label-group form-group position-relative has-icon-left input-divider-left">
                                                <input type="text" class="form-control" id="iconLeftDivider" placeholder="Icon Left, Default Input">
                                                <div class="form-control-position">
                                                    <i class="feather icon-phone"></i>
                                                </div>
                                                <label for="iconLeftDivider">Icon Left, Default Input</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2 mb-2">
                                                Right Icon with divider
                                            </div>
                                            <fieldset class="form-label-group form-group position-relative input-divider-right">
                                                <input type="text" class="form-control" id="iconRightDivider" placeholder="Icon Right, Default Input">
                                                <div class="form-control-position">
                                                    <i class="feather icon-file"></i>
                                                </div>
                                                <label for="iconRightDivider">Icon Right, Default Input</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Input with Icons end -->

            <!-- Input Sizing start -->
            <section id="input-sizing">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Control Sizing Option</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>For different sizes of Input, Use classes like <code>.form-control-lg</code> &amp; <code>.form-control-sm</code> for Large, Small input box.</p>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2 mb-1">
                                                Large
                                            </div>
                                            <input class="form-control form-control-lg" type="text" placeholder="Large Input">
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2 my-2">
                                                Default
                                            </div>
                                            <input class="form-control" type="text" placeholder="Default Input">
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2 my-2">
                                                Small
                                            </div>
                                            <input class="form-control form-control-sm" type="text" placeholder="Small Input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Label Control Sizing Option</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>For different sizes of Input, Use classes like <code>.form-control-lg</code> &amp; <code>.form-control-sm</code> for Large, Small input box.</p>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2 mb-1">
                                                Large
                                            </div>
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control form-control-lg" id="label-large" placeholder="Large Input">
                                                <label for="label-large">Large Input</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2 mb-1">
                                                Default
                                            </div>
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control" id="label-default" placeholder="Default Input">
                                                <label for="label-default">Default Input</label>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2 mb-1">
                                                Small
                                            </div>
                                            <fieldset class="form-label-group">
                                                <input type="text" class="form-control form-control-sm" id="label-small" placeholder="Small Input">
                                                <label for="label-small">Small Input</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Input Sizing end -->

        </div>
    </div>
</div>

{{-- form layout --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Form Layouts</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Forms</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Form Layouts</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Horizontal Form</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>First Name</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" id="first-name" class="form-control" name="fname" placeholder="First Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Email</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="email" id="email-id" class="form-control" name="email-id" placeholder="Email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Mobile</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="number" id="contact-info" class="form-control" name="contact" placeholder="Mobile">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Password</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-8 offset-md-4">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember me</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Horizontal Form with Icons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>First Name</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="text" id="fname-icon" class="form-control" name="fname-icon" placeholder="First Name">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-user"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Email</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="email" id="email-icon" class="form-control" name="email-id-icon" placeholder="Email">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-mail"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Mobile</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="number" id="contact-icon" class="form-control" name="contact-icon" placeholder="Mobile">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-smartphone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Password</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="position-relative has-icon-left">
                                                                <input type="password" id="pass-icon" class="form-control" name="contact-icon" placeholder="Password">
                                                                <div class="form-control-position">
                                                                    <i class="feather icon-lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-8 offset-md-4">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember me</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic Horizontal form layout section end -->

            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vertical Form</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">First Name</label>
                                                        <input type="text" id="first-name-vertical" class="form-control" name="fname" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-vertical">Email</label>
                                                        <input type="email" id="email-id-vertical" class="form-control" name="email-id" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-vertical">Mobile</label>
                                                        <input type="number" id="contact-info-vertical" class="form-control" name="contact" placeholder="Mobile">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-vertical">Password</label>
                                                        <input type="password" id="password-vertical" class="form-control" name="contact" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember me</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vertical Form with Icons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">First Name</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="text" id="first-name-icon" class="form-control" name="fname-icon" placeholder="First Name">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-icon">Email</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="email" id="email-id-icon" class="form-control" name="email-id-icon" placeholder="Email">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-mail"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="contact-info-icon">Mobile</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="number" id="contact-info-icon" class="form-control" name="contact-icon" placeholder="Mobile">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-smartphone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password-icon">Password</label>
                                                        <div class="position-relative has-icon-left">
                                                            <input type="password" id="password-icon" class="form-control" name="contact-icon" placeholder="Password">
                                                            <div class="form-control-position">
                                                                <i class="feather icon-lock"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember me</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic Vertical form layout section end -->

            <!-- // Basic Floating Label Form section start -->
            <section id="floating-label-layouts">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form With Label Placeholder</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="first-name-floating" class="form-control" placeholder="First Name" name="fname-floating">
                                                        <label for="first-name-floating">First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-label-group">
                                                        <input type="email" id="email-id-floating" class="form-control" name="email-id-floating" placeholder="Email">
                                                        <label for="email-id-floating">Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-label-group">
                                                        <input type="number" id="contact-info-floating" class="form-control" name="contact-floating" placeholder="Mobile">
                                                        <label for="contact-info-floating">Mobile</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-label-group">
                                                        <input type="password" id="password-floating" class="form-control" name="contact-floating" placeholder="Password">
                                                        <label for="password-floating">Password</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember me</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form With Label Placeholder with Icons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-label-group position-relative has-icon-left">
                                                        <input type="text" id="first-name-floating-icon" class="form-control" name="fname-floating-icon" placeholder="First Name">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="first-name-floating-icon">First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-label-group position-relative has-icon-left">
                                                        <input type="email" id="email-id-floating-icon" class="form-control" name="email-id-floating-icon" placeholder="Email">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-mail"></i>
                                                        </div>
                                                        <label for="email-id-floating-icon">Email</label>

                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-label-group position-relative has-icon-left">
                                                        <input type="number" id="contact-floating-icon" class="form-control" name="contact-floating-icon" placeholder="Mobile">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-smartphone"></i>
                                                        </div>
                                                        <label for="contact-floating-icon">Mobile</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-label-group position-relative has-icon-left">
                                                        <input type="password" id="password-floating-icon" class="form-control" name="password-floating-icon" placeholder="Password">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="password-floating-icon">Password</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember me</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic Floating Label Form section end -->

            <!-- // Basic multiple Column Form section start -->
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Multiple Column</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="fname-column">
                                                        <label for="first-name-column">First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="lname-column">
                                                        <label for="last-name-column">Last Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="city-column" class="form-control" placeholder="City" name="city-column">
                                                        <label for="city-column">City</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="country-floating" class="form-control" name="country-floating" placeholder="Country">
                                                        <label for="country-floating">Country</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="company-column" class="form-control" name="company-column" placeholder="Company">
                                                        <label for="company-column">Company</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="email" id="email-id-column" class="form-control" name="email-id-column" placeholder="Email">
                                                        <label for="email-id-column">Email</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <fieldset class="checkbox">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember me</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic Floating Label Form section end -->

        </div>
    </div>
</div>

{{-- number input --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Number Input</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                </li>
                                <li class="breadcrumb-item active">Number Input
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Bootstrap TouchSpin Spinners start -->
            <section id="basic-touchspin">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Touchspin</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>Add <code>.touchspin</code> class with input tag to add touchspin input group. Add <code>.disabled-touchspin</code> class and add attribute <code>disabled</code> with <code>input</code> tag to add disabled touchspin input group.</p>
                                        </div>
                                        <div class="d-inline-block mb-1">
                                            <div class="input-group">
                                                <input type="number" class="touchspin" value="50">
                                            </div>
                                        </div>
                                        <div class="d-inline-block mb-1">
                                            <div class="input-group disabled-touchspin">
                                                <input type="number" class="touchspin" value="50" disabled>
                                            </div>
                                        </div>
                                        <div class="d-inline-block mb-1">
                                            <div class="input-group">
                                                <input type="number" class="touchspin-icon" value="50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bootstrap TouchSpin Spinners end -->

            <!-- Bootstrap TouchSpin Spinners Size start -->
            <section id="touchspin-size">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Size</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>Add <code>.input-group-lg</code> and <code>.input-group-sm</code> class for touchspin large and small respectively.</p>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="input-group input-group-lg">
                                                <input type="number" class="touchspin" value="50">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="input-group">
                                                <input type="number" class="touchspin" value="50">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="touchspin" value="50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bootstrap TouchSpin Spinners end -->

            <!-- Bootstrap TouchSpin Spinners Decimal start -->
            <section id="touchspin-decimal">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Decimal</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>Set <code>data-bts-step</code> and <code>data-bts-decimals</code> attributes for decimal type Input Touchspin.</p>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="touchspin" value="50" data-bts-step="0.5" data-bts-decimals="2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bootstrap TouchSpin Spinners Decimal end -->

            <!-- Bootstrap TouchSpin Spinners Min-max start -->
            <section id="touchspin-min-max">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Min - Max</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>Set <code>min</code> and <code>max</code> attributes values for minimum and maximum in page js file.</p>
                                        </div>
                                        <div class="input-group">
                                            <input type="number" class="touchspin-min-max" value="19">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bootstrap TouchSpin Spinners Min - Max end -->

            <!-- Bootstrap TouchSpin Spinners Step start -->
            <section id="touchspin-step">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Step</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>Set <code>step</code> attribute value in page js file.</p>
                                        </div>
                                        <div class="input-group">
                                            <input type="number" class="touchspin-step" value="45">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bootstrap TouchSpin Spinners Min - Max end -->

            <!-- Bootstrap TouchSpin Spinners Colors start -->
            <section id="touchspin-colors">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Colors Variation</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>set <code>data-bts-button-down-class</code> &amp; <code>data-bts-button-up-class</code> attribute and add value as <code>btn btn-{color}</code> for different colors spinner.</p>
                                        </div>
                                        <div class="d-inline-block mb-1">
                                            <div class="input-group">
                                                <input type="text" class="touchspin-color" value="60" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" />
                                            </div>
                                        </div>
                                        <div class="d-inline-block mb-1">
                                            <div class="input-group">
                                                <input type="text" class="touchspin-color" value="60" data-bts-button-down-class="btn btn-success" data-bts-button-up-class="btn btn-success" />
                                            </div>
                                        </div>
                                        <div class="d-inline-block mb-1">
                                            <div class="input-group">
                                                <input type="text" class="touchspin-color" value="60" data-bts-button-down-class="btn btn-warning" data-bts-button-up-class="btn btn-warning" />
                                            </div>
                                        </div>
                                        <div class="d-inline-block mb-1">
                                            <div class="input-group">
                                                <input type="text" class="touchspin-color" value="60" data-bts-button-down-class="btn btn-info" data-bts-button-up-class="btn btn-info" />
                                            </div>
                                        </div>
                                        <div class="d-inline-block mb-1">
                                            <div class="input-group">
                                                <input type="text" class="touchspin-color" value="60" data-bts-button-down-class="btn btn-danger" data-bts-button-up-class="btn btn-danger" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bootstrap TouchSpin Spinners Decimal end -->

        </div>
    </div>
</div>

{{-- radio --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Radio Buttons</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                </li>
                                <li class="breadcrumb-item active">Radio
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Radio Button start -->
            <section class="basic-radio">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Radio Buttons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <label>
                                                    <input type="radio" name="radio" checked>
                                                    Active
                                                </label>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <label>
                                                    <input type="radio" name="radio">
                                                    Inactive
                                                </label>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <label>
                                                    <input type="radio" disabled checked>
                                                    Active - disabled
                                                </label>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <label>
                                                    <input type="radio" disabled>
                                                    Inactive - disabled
                                                </label>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Radio Button end -->

            <!-- Custom Radio Buttons start -->
            <section class="custom-radio">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Custom Radio Buttons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Add <code>.custom-control .custom-radio</code> as a single wrapper &amp; add
                                        <code>.custom-control-label</code> for better output.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="customRadio" id="customRadio1" checked>
                                                    <label class="custom-control-label" for="customRadio1">Active</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="customRadio" id="customRadio2">
                                                    <label class="custom-control-label" for="customRadio2">Inactive</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" checked id="customRadio3" disabled>
                                                    <label class="custom-control-label" for="customRadio3">Active - disabled</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="customRadio4" disabled>
                                                    <label class="custom-control-label" for="customRadio4">Inactive - disabled</label>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Custom Radio Buttons end -->

            <!-- Vuexy Radio Buttons start -->
            <section class="vuexy-radio">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vuexy Radio Buttons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>To add a checkBox, we have the <code>.vs-radio-con</code> as a wrapper. Also use <code>.vs-radio</code> for better output.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="vueradio" checked value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Active</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="vueradio" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Inactive</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" disabled="disabled" checked value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Active - disabled</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" disabled="disabled" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Inactive - disabled</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Vuexy Radio Buttons end -->

            <!-- Vuexy Radio Buttons Color start -->
            <section class="vuexy-radio-color">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Color</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>To change the color of the radio use the <code>.vs-radio-{value}</code> for primary, success, danger, info, warning.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="radiocolor" checked value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Primary (Default)</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con vs-radio-success">
                                                    <input type="radio" name="radiocolor" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Success</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con vs-radio-danger">
                                                    <input type="radio" name="radiocolor" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Danger</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con vs-radio-info">
                                                    <input type="radio" name="radiocolor" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Info</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block">
                                            <fieldset>
                                                <div class="vs-radio-con vs-radio-warning">
                                                    <input type="radio" name="radiocolor" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Warning</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Vuexy Radio Buttons Color end -->

            <!-- Vuexy Radio Buttons Sizes start -->
            <section class="vuexy-radio-size">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vuexy Radio Buttons Sizes</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>To add a radio button with different sizes, we have the <code>.vs-radio-sm</code> and <code>.vs-radio-lg</code> for small and large Radio Buttons respectively. Add it alongwith <code>.vs-radio</code> class.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con vs-radio-primary">
                                                    <input type="radio" name="vueradisize" value="false">
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Small</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con vs-radio-primary">
                                                    <input type="radio" name="vueradisize" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Default</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con vs-radio-primary">
                                                    <input type="radio" name="vueradisize" value="false">
                                                    <span class="vs-radio vs-radio-lg">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Large</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Vuexy Radio Buttons sizes end -->

        </div>
    </div>
</div>

{{-- select --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Select</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                </li>
                                <li class="breadcrumb-item active">Select
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Bootstrap Select start -->
            <section class="bootstrap-select">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Bootstrap Select</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Basic Select
                                            </div>
                                            <p>Use <code>.form-control</code> class for basic select control.</p>
                                            <fieldset class="form-group">
                                                <select class="form-control" id="basicSelect">
                                                    <option>IT</option>
                                                    <option>Blade Runner</option>
                                                    <option>Thor Ragnarok</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Custom Select
                                            </div>
                                            <p>Use <code>.custom-select</code> class for Custom Select control.</p>
                                            <fieldset class="form-group">
                                                <select class="custom-select" id="customSelect">
                                                    <option selected>Open this menu</option>
                                                    <option value="IT">IT</option>
                                                    <option value="Blade Runner">Blade Runner</option>
                                                    <option value="Thor Ragnarok">Thor Ragnarok</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Multiple Select
                                            </div>
                                            <p>Use <code>multiple</code> attribute for Multiple select control.</p>
                                            <fieldset class="form-group">
                                                <select class="form-control" id="countrySelect" multiple="multiple">
                                                    <option selected="selected">Square</option>
                                                    <option>Rectangle</option>
                                                    <option selected="selected">Rombo</option>
                                                    <option>Romboid</option>
                                                    <option>Trapeze</option>
                                                    <option>Triangle</option>
                                                    <option selected="selected">Polygon</option>
                                                    <option>Regular polygon</option>
                                                    <option>Circumference</option>
                                                    <option>Circle</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Disabled Select
                                            </div>
                                            <p>Use <code>disabled</code> attribute for disabled select control.</p>
                                            <fieldset class="form-group">
                                                <select class="form-control" disabled="disabled" id="disabledSelect">
                                                    <option>Green</option>
                                                    <option>Red</option>
                                                    <option>Blue</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Bootstrap Select end -->

            <!-- Basic Select2 start -->
            <section class="basic-select2">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Select2</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <a href="https://select2.org/getting-started/installation" target="_blank">For more information </a>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Basic Select2
                                            </div>
                                            <p>Use <code>.select2</code> class for basic select2 control.</p>
                                            <div class="form-group">
                                                <select class="select2 form-control">
                                                    <option value="square">Square</option>
                                                    <option value="rectangle">Rectangle</option>
                                                    <option value="rombo">Rombo</option>
                                                    <option value="romboid">Romboid</option>
                                                    <option value="trapeze">Trapeze</option>
                                                    <option value="traible">Triangle</option>
                                                    <option value="polygon">Polygon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Single Select with Label
                                            </div>
                                            <p>Use <code>optgroup</code> attribute for basic select2 with Label control.</p>
                                            <div class="form-group">
                                                <select class="select2 form-control">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Select With Icon
                                            </div>
                                            <p>Use data attribute <code>data-icon</code> to add icon name for each options. And use class <code>.select2-icons</code> to set icon with option.</p>
                                            <div class="form-group">
                                                <select data-placeholder="Select a state..." class="select2-icons form-control" id="select2-icons">
                                                    <optgroup label="Services">
                                                        <option value="wordpress2" data-icon="fa fa-wordpress" selected>WordPress</option>
                                                        <option value="codepen" data-icon="fa fa-codepen">Codepen</option>
                                                        <option value="drupal" data-icon="fa fa-drupal">Drupal</option>
                                                        <option value="pinterest2" data-icon="fa fa-css3">CSS3</option>
                                                        <option value="html5" data-icon="fa fa-html5">HTML5</option>
                                                    </optgroup>
                                                    <optgroup label="File types">
                                                        <option value="pdf" data-icon="fa fa-file-pdf-o">PDF</option>
                                                        <option value="word" data-icon="fa fa-file-word-o">Word</option>
                                                        <option value="excel" data-icon="fa fa-file-excel-o">Excel</option>
                                                        <option value="facebook" data-icon="fa fa-facebook-official">Facebook</option>
                                                    </optgroup>
                                                    <optgroup label="Browsers">
                                                        <option value="chrome" data-icon="fa fa-chrome">Chrome</option>
                                                        <option value="firefox" data-icon="fa fa-firefox">Firefox</option>
                                                        <option value="safari" data-icon="fa fa-safari">Safari</option>
                                                        <option value="opera" data-icon="fa fa-opera">Opera</option>
                                                        <option value="IE" data-icon="fa fa-internet-explorer">IE</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Template support
                                            </div>
                                            <p>Select2 supports custom themes using the theme option so you can style Select2 to match the rest of your application. These are using the <code>classic</code> theme, which matches the old look of Select2.</p>
                                            <div class="form-group">
                                                <select class="select2-theme form-control" id="select2-theme">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Select2 end -->

            <!-- Multiple Select2 start -->
            <section class="multiple-select2">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Multiple Select2</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Basic Multiple Select2
                                            </div>
                                            <p>Use <code>.select2</code> class for basic select2 control. Use <code>multiple="multiple"</code> attribute for multiple select box.</p>
                                            <div class="form-group">
                                                <select class="select2 form-control" multiple="multiple">
                                                    <option value="square">Square</option>
                                                    <option value="rectangle" selected>Rectangle</option>
                                                    <option value="rombo">Rombo</option>
                                                    <option value="romboid">Romboid</option>
                                                    <option value="trapeze">Trapeze</option>
                                                    <option value="traible" selected>Triangle</option>
                                                    <option value="polygon">Polygon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Multiple Select with Label
                                            </div>
                                            <p>Use <code>optgroup</code> attribute for multiple select box with Label control.</p>
                                            <div class="form-group">
                                                <select class="select2 form-control" multiple="multiple">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze" selected>Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue" selected>Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Select With Icon
                                            </div>
                                            <p>Use data attribute <code>data-icon</code> to add icon name for each options. And use class <code>.select2-icons</code> to set icon with option.</p>
                                            <div class="form-group">
                                                <select data-placeholder="Select a state..." class="select2-icons form-control" id="multiple-select2-icons" multiple="multiple">
                                                    <optgroup label="Services">
                                                        <option value="wordpress2" data-icon="fa fa-wordpress" selected>WordPress</option>
                                                        <option value="codepen" data-icon="fa fa-codepen">Codepen</option>
                                                        <option value="drupal" data-icon="fa fa-drupal">Drupal</option>
                                                        <option value="pinterest2" data-icon="fa fa-css3">CSS3</option>
                                                        <option value="html5" data-icon="fa fa-html5">HTML5</option>
                                                    </optgroup>
                                                    <optgroup label="File types">
                                                        <option value="pdf" data-icon="fa fa-file-pdf-o">PDF</option>
                                                        <option value="word" data-icon="fa fa-file-word-o">Word</option>
                                                        <option value="excel" data-icon="fa fa-file-excel-o">Excel</option>
                                                        <option value="facebook" data-icon="fa fa-facebook-official">Facebook</option>
                                                    </optgroup>
                                                    <optgroup label="Browsers">
                                                        <option value="chrome" data-icon="fa fa-chrome">Chrome</option>
                                                        <option value="firefox" data-icon="fa fa-firefox">Firefox</option>
                                                        <option value="safari" data-icon="fa fa-safari">Safari</option>
                                                        <option value="opera" data-icon="fa fa-opera">Opera</option>
                                                        <option value="IE" data-icon="fa fa-internet-explorer">IE</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Maximum Select with Label
                                            </div>
                                            <p>Select2 multi-value select boxes can set restrictions regarding the maximum number of options selected. The select below is declared with the <code>multiple</code> attribute with <code>maximumSelectionLength</code> in the select2 options.</p>
                                            <div class="form-group">
                                                <select class="max-length form-control" multiple="multiple" id="max_length">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze" selected>Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Multiple Select2 end -->

            <!-- Select2 Advance Options start -->
            <section class="select2-advance">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Advance Options</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Loading Array Data
                                            </div>
                                            <p>Select2 provides a way to load the data from a local array. You can provide initial selections with array data by providing the option tag for the selected values, similar to how it would be done for a standard select.</p>
                                            <div class="form-group">
                                                <select class="select2-data-array form-control" id="select2-array"></select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Loading Remote Data
                                            </div>
                                            <p>Select2 comes with AJAX support built in, using jQuery's AJAX methods. In this example, we can search for repositories using GitHub's API.</p>
                                            <div class="form-group">
                                                <select class="select2-data-ajax form-control" id="select2-ajax"></select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Customizing How Results Are Matched
                                            </div>
                                            <p>Unlike other dropdowns on this page, this one matches options only if the term appears in the beginning of the string as opposed to anywhere: This custom matcher uses a compatibility module that is only bundled in the full version of Select2. You also have the option of using a more complex matcher.</p>
                                            <div class="form-group">
                                                <select class="select2-customize-result form-control" multiple="multiple" id="select2-customize-result">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Programmatic access
                                            </div>
                                            <p>Select2 supports methods that allow programmatic control of the component.</p>
                                            <div class="form-group">
                                                <select class="select2 js-example-programmatic form-control" id="programmatic-single">
                                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                                        <option value="AK">Alaska</option>
                                                        <option value="HI">Hawaii</option>
                                                    </optgroup>
                                                    <optgroup label="Pacific Time Zone">
                                                        <option value="CA">California</option>
                                                        <option value="NV">Nevada</option>
                                                        <option value="OR">Oregon</option>
                                                        <option value="WA">Washington</option>
                                                    </optgroup>
                                                    <optgroup label="Mountain Time Zone">
                                                        <option value="AZ">Arizona</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="MT">Montana</option>
                                                        <option value="NE">Nebraska</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="WY">Wyoming</option>
                                                    </optgroup>
                                                    <optgroup label="Central Time Zone">
                                                        <option value="AL">Alabama</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="WI">Wisconsin</option>
                                                    </optgroup>
                                                    <optgroup label="Eastern Time Zone">
                                                        <option value="CT">Connecticut</option>
                                                        <option value="DE">Delaware</option>
                                                        <option value="FL">Florida</option>
                                                        <option value="GA">Georgia</option>
                                                        <option value="IN">Indiana</option>
                                                        <option value="ME">Maine</option>
                                                        <option value="MD">Maryland</option>
                                                        <option value="MA">Massachusetts</option>
                                                        <option value="MI">Michigan</option>
                                                        <option value="NH">New Hampshire</option>
                                                        <option value="NJ">New Jersey</option>
                                                        <option value="NY">New York</option>
                                                        <option value="NC">North Carolina</option>
                                                        <option value="OH">Ohio</option>
                                                        <option value="PA">Pennsylvania</option>
                                                        <option value="RI">Rhode Island</option>
                                                        <option value="SC">South Carolina</option>
                                                        <option value="VT">Vermont</option>
                                                        <option value="VA">Virginia</option>
                                                        <option value="WV">West Virginia</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Programmatic control">
                                                <div class="btn-group btn-group-sm" aria-label="Set Select2 option">
                                                    <button class="js-programmatic-set-val btn btn-outline-primary mr-1 mb-1">
                                                        Set "California"
                                                    </button>
                                                </div>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Open and close">
                                                    <button class="js-programmatic-open btn btn-outline-primary mr-1 mb-1">
                                                        Open
                                                    </button>
                                                    <button class="js-programmatic-close btn btn-outline-primary mr-1 mb-1">
                                                        Close
                                                    </button>
                                                </div>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Initialize and destroy">
                                                    <button class="js-programmatic-init btn btn-outline-primary mr-1 mb-1">
                                                        Init
                                                    </button>
                                                    <button class="js-programmatic-destroy btn btn-outline-primary mr-1 mb-1">
                                                        Destroy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Select2 Advance Options end -->

            <!-- Select2 Sizing start -->
            <section class="select2-sizing">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Size</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>For different sizes of select2, Use classes like <code>.select2-size-sm</code> &amp; <code>.select2-size-lg</code> for Large, small &amp; Extra Small Select respectively.</p>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Large
                                            </div>
                                            <div class="form-group">
                                                <select class="select2-size-lg form-control" id="large-select">
                                                    <option value="square">Square</option>
                                                    <option value="rectangle">Rectangle</option>
                                                    <option value="rombo">Rombo</option>
                                                    <option value="romboid">Romboid</option>
                                                    <option value="trapeze">Trapeze</option>
                                                    <option value="traible">Triangle</option>
                                                    <option value="polygon">Polygon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Default
                                            </div>
                                            <div class="form-group">
                                                <select class="select2 form-control" id="default-select">
                                                    <option value="square">Square</option>
                                                    <option value="rectangle">Rectangle</option>
                                                    <option value="rombo">Rombo</option>
                                                    <option value="romboid">Romboid</option>
                                                    <option value="trapeze">Trapeze</option>
                                                    <option value="traible">Triangle</option>
                                                    <option value="polygon">Polygon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Small
                                            </div>
                                            <div class="form-group">
                                                <select class="select2-size-sm form-control" id="small-select">
                                                    <option value="square">Square</option>
                                                    <option value="rectangle">Rectangle</option>
                                                    <option value="rombo">Rombo</option>
                                                    <option value="romboid">Romboid</option>
                                                    <option value="trapeze">Trapeze</option>
                                                    <option value="traible">Triangle</option>
                                                    <option value="polygon">Polygon</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Multi Select Size</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>For different sizes of select2, Use classes like <code>.select2-size-sm</code> &amp; <code>.select2-size-lg</code> for Large, small &amp; Extra Small Select respectively.</p>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Large
                                            </div>
                                            <div class="form-group">
                                                <select class="select2-size-lg form-control" multiple="multiple" id="large-select-multi">
                                                    <option value="square" selected>Square</option>
                                                    <option value="rectangle">Rectangle</option>
                                                    <option value="rombo">Rombo</option>
                                                    <option value="romboid">Romboid</option>
                                                    <option value="trapeze">Trapeze</option>
                                                    <option value="traible">Triangle</option>
                                                    <option value="polygon">Polygon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Default
                                            </div>
                                            <div class="form-group">
                                                <select class="select2 form-control" multiple="multiple" id="default-select-multi">
                                                    <option value="square">Square</option>
                                                    <option value="rectangle">Rectangle</option>
                                                    <option value="rombo">Rombo</option>
                                                    <option value="romboid">Romboid</option>
                                                    <option value="trapeze">Trapeze</option>
                                                    <option value="traible">Triangle</option>
                                                    <option value="polygon" selected>Polygon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Small
                                            </div>
                                            <div class="form-group">
                                                <select class="select2-size-sm form-control" multiple="multiple" id="small-select-multi">
                                                    <option value="square">Square</option>
                                                    <option value="rectangle">Rectangle</option>
                                                    <option value="rombo" selected>Rombo</option>
                                                    <option value="romboid">Romboid</option>
                                                    <option value="trapeze">Trapeze</option>
                                                    <option value="traible">Triangle</option>
                                                    <option value="polygon">Polygon</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Select2 Sizing end -->

            <!-- Select2 Color start -->
            <section class="select2-color">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Color</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Background Color
                                            </div>
                                            <p>Use class <code>.select2-bg</code> with <code>data-bgcolor</code> &amp; <code>data-bgcolor-variation</code> attributes for background color of control.</p>
                                            <div class="form-group">
                                                <select class="select2-bg form-control" id="bg-select" data-bgcolor="success" data-bgcolor-variation="lighten-3" data-text-color="white">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Full Background Color
                                            </div>
                                            <p>Use class <code>.select2-full-bg</code> with <code>data-bgcolor</code> &amp; <code>data-bgcolor-variation</code> attributes for full select2 control background color.</p>
                                            <div class="form-group">
                                                <select class="select2-full-bg form-control" id="full-bg-select" data-bgcolor="info" data-bgcolor-variation="lighten-3" data-text-color="white">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Border Color
                                            </div>
                                            <p>Use class <code>.select2-border</code> with <code>data-border-color</code> &amp; <code>data-border-variation</code> attributes class for Border color of control.</p>
                                            <div class="form-group">
                                                <select class="select2-border border-warning form-control" id="border-select" data-border-color="warning" data-border-variation="darken-2" data-text-color="warning" data-text-variation="darken-3">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Color for Multi Select</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Background Color
                                            </div>
                                            <p>Use class <code>.select2-bg</code> with <code>data-bgcolor</code> &amp; <code>data-bgcolor-variation</code> attributes for background color of control.</p>
                                            <div class="form-group">
                                                <select class="select2-bg form-control" multiple="multiple" id="bg-select-multi" data-bgcolor="success" data-bgcolor-variation="lighten-3" data-text-color="white">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze" selected>Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Full Background Color
                                            </div>
                                            <p>Use class <code>.select2-full-bg</code> with <code>data-bgcolor</code> &amp; <code>data-bgcolor-variation</code> attributes for full select2 control background color.</p>
                                            <div class="form-group">
                                                <select class="select2-full-bg form-control" multiple="multiple" id="full-bg-select-multi" data-bgcolor="info" data-bgcolor-variation="lighten-3" data-text-color="white">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red" selected>Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-bold-600 font-medium-2">
                                                Border Color
                                            </div>
                                            <p>Use class <code>.select2-border</code> with <code>data-border-color</code> &amp; <code>data-border-variation</code> attributes class for Border color of control.</p>
                                            <div class="form-group">
                                                <select class="select2-border border-warning form-control" multiple="multiple" id="border-select-multi" data-border-color="warning" data-border-variation="darken-2" data-text-color="warning" data-text-variation="darken-3">
                                                    <optgroup label="Figures">
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="triangle">Triangle</option>
                                                        <option value="polygon" selected>Polygon</option>
                                                    </optgroup>
                                                    <optgroup label="Colors">
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="blue">Blue</option>
                                                        <option value="purple">Purple</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Select2 Color end -->

        </div>
    </div>
</div>

{{-- switch --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Switch</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                </li>
                                <li class="breadcrumb-item active">Switch
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Switches Starts -->
            <section id="basic-switches">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Switch</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>use class <code>.switch-label</code> to add a label to switch.</p>
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">
                                        </label>
                                        <span class="switch-label">Toggle this switch element</span>
                                    </div>
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                                        <label class="custom-control-label" for="customSwitch2">
                                        </label>
                                        <span class="switch-label">Disabled switch element</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Switches Ends -->

            <!-- Switch Colors Starts -->
            <section id="switch-colors">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Colors</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Use class <code>.custom-switch-#{$color-name}</code> with <code>.custom-switch</code> to change switch's
                                        color</p>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <div class="custom-control custom-switch mr-2 mb-1">
                                            <p class="mb-0">Primary</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                            <label class="custom-control-label" for="customSwitch3"></label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                            <p class="mb-0">Success</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch4">
                                            <label class="custom-control-label" for="customSwitch4"></label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-danger mr-2 mb-1">
                                            <p class="mb-0">Danger</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch5">
                                            <label class="custom-control-label" for="customSwitch5"></label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">
                                            <p class="mb-0">Info</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch6">
                                            <label class="custom-control-label" for="customSwitch6"></label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-warning mr-2 mb-1">
                                            <p class="mb-0">Warning</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch7">
                                            <label class="custom-control-label" for="customSwitch7"></label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-dark mb-1">
                                            <p class="mb-0">Dark</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch8">
                                            <label class="custom-control-label" for="customSwitch8"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Switch Colors Ends -->

            <!-- Switch Text Starts -->
            <section id="switch-text">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Text</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Use class <code>.switch-text-left & .switch-text-right</code> inside of
                                        <code>.custom-control-label</code> to create a switch with text.
                                    </p>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch9">
                                        <label class="custom-control-label" for="customSwitch9">
                                            <span class="switch-text-left">On</span>
                                            <span class="switch-text-right">Off</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Switch Text Ends -->

            <!-- Switch Icons Starts -->
            <section id="switch-icons">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Icons</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Use class <code>.switch-icon-left & .switch-icon-right</code> inside of
                                        <code>.custom-control-label</code> to create a switch with icon.
                                    </p>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <div class="custom-control custom-switch mr-2 mb-1">
                                            <p class="mb-0">Primary</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch10">
                                            <label class="custom-control-label" for="customSwitch10">
                                                <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                                <span class="switch-icon-right"><i class="feather icon-bell"></i></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                            <p class="mb-0">Success</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch11">
                                            <label class="custom-control-label" for="customSwitch11">
                                                <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                                <span class="switch-icon-right"><i class="feather icon-check"></i></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-danger mr-2 mb-1">
                                            <p class="mb-0">Danger</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch12">
                                            <label class="custom-control-label" for="customSwitch12">
                                                <span class="switch-icon-left"><i class="feather icon-x"></i></span>
                                                <span class="switch-icon-right"><i class="feather icon-x"></i></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-info mr-2 mb-1">
                                            <p class="mb-0">Info</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch13">
                                            <label class="custom-control-label" for="customSwitch13">
                                                <span class="switch-icon-left"><i class="feather icon-info"></i></span>
                                                <span class="switch-icon-right"><i class="feather icon-info"></i></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-warning mr-2 mb-1">
                                            <p class="mb-0">Warning</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch14">
                                            <label class="custom-control-label" for="customSwitch14">
                                                <span class="switch-icon-left"><i class="feather icon-alert-triangle"></i></span>
                                                <span class="switch-icon-right"><i class="feather icon-alert-triangle"></i></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-dark mr-2 mb-1">
                                            <p class="mb-0">Dark</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch15">
                                            <label class="custom-control-label" for="customSwitch15">
                                                <span class="switch-icon-left"><i class="feather icon-volume-x"></i></span>
                                                <span class="switch-icon-right"><i class="feather icon-volume-x"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Switch Icons Ends -->

            <!-- Switch Sizes Starts -->
            <section id="switch-sizes">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Sizes
                                </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>use class <code>.switch-{md | lg}</code> with <code>.custom-switch</code> for medium or large size</p>
                                    <div class="d-flex justify-content-start flex-wrap">
                                        <div class="custom-control custom-switch mr-2 mb-1">
                                            <p class="mb-0">Default</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch80">
                                            <label class="custom-control-label" for="customSwitch80">
                                                <span class="switch-text-left">On</span>
                                                <span class="switch-text-right">Off</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-switch custom-switch-danger switch-md mr-2 mb-1">
                                            <p class="mb-0">Medium</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch90">
                                            <label class="custom-control-label" for="customSwitch90">
                                                <span class="switch-text-left">True</span>
                                                <span class="switch-text-right">False</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                            <p class="mb-0">Large</p>
                                            <input type="checkbox" class="custom-control-input" id="customSwitch100">
                                            <label class="custom-control-label" for="customSwitch100">
                                                <span class="switch-text-left">Agree</span>
                                                <span class="switch-text-right">Disagree</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Switch Sizes Ends -->

        </div>
    </div>
</div>

{{-- text-area --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Textarea</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Form Elements</a>
                                </li>
                                <li class="breadcrumb-item active">Textarea
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Textarea start -->
            <section class="basic-textarea">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Default</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>To add a Textarea we have the component <code>textarea</code>.</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <fieldset class="form-group">
                                                <textarea class="form-control" id="basicTextarea" rows="3" placeholder="Textarea"></textarea>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Textarea end -->

            <!-- Floating Label Textarea start -->
            <section class="floating-label-textarea">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Floating Label</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="mb-2">Use <code>.form-label-group</code> to add a Floating Label with Textarea.</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <fieldset class="form-label-group">
                                                <textarea class="form-control" id="label-textarea" rows="3" placeholder="Label in Textarea"></textarea>
                                                <label for="label-textarea">Label in Textarea</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Floating Label Textarea end -->

            <!-- Counter Textarea start -->
            <section class="counter-textarea">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Counter</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="mb-2">There are times when we need the user to only enter a certain number of characters for it, we have the property counter, the value is a number and determines the maximum. Use <code>.char-textarea</code> with <code>&lt;textarea&gt;</code>tag for counting text-length.</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <fieldset class="form-label-group mb-0">
                                                <textarea data-length=20 class="form-control char-textarea" id="textarea-counter" rows="3" placeholder="Counter"></textarea>
                                                <label for="textarea-counter">Counter</label>
                                            </fieldset>
                                            <small class="counter-value float-right"><span class="char-count">0</span> / 20 </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Counter Textarea end -->

        </div>
    </div>
</div>

{{-- form validation --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Form Validation</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Forms</a>
                                </li>
                                <li class="breadcrumb-item active">Form Validation
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Simple Validation start -->
            <section class="simple-validation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Simple Form Validation</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="mt-1">Add <code>novalidate</code> attribute to form tag and <code>required</code> attribute to input tag.</p>
                                    <form class="form-horizontal" novalidate>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="text" name="text" class="form-control" placeholder="First Name" required data-validation-required-message="This First Name field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control" placeholder="Email" required data-validation-required-message="This Email field is required">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Input Validation end -->

            <!-- Multiple Rules Validation start -->
            <section class="multiple-validation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Validating multiple rules</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form-horizontal" novalidate>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control" placeholder="Your Name" required data-validation-required-message="This name field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control" placeholder="Your Email" required data-validation-required-message="The email field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="password" name="password" class="form-control" placeholder="Your Password" required data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="password" name="con-password" class="form-control" placeholder="Confirm Password" required data-validation-match-match="password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Multiple Rule Validation end -->

            <!-- Input Validation start -->
            <section class="input-validation">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Inputs Validation</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form-horizontal" novalidate>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>This field is required</label>
                                                    <div class="controls">
                                                        <input type="text" name="text" class="form-control" data-validation-required-message="This field is required" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Must only consist of numbers</label>
                                                    <div class="controls">
                                                        <input type="text" name="numeric" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder="Enter Numbers only">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Only alphabetic characters</label>
                                                    <div class="controls">
                                                        <input type="text" name="alpha" class="form-control" required data-validation-containsnumber-regex="^[a-zA-Z]+$" data-validation-containsnumber-message="The alpha field may only contain alphabetic characters." placeholder="Enter Character only">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password Input Field</label>
                                                    <div class="controls">
                                                        <input type="password" name="password" class="form-control" data-validation-required-message="This field is required" placeholder="Password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Repeat password must match</label>
                                                    <div class="controls">
                                                        <input type="password" name="password2" data-validation-match-match="password" class="form-control" data-validation-required-message="Repeat password must match" placeholder="Repeat Password">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Must be a valid email</label>
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control" data-validation-required-message="Must be a valid email" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Enter Number between 10 & 20</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" data-validation-regex-regex="([^a-z]*[A-Z]*)*" data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" data-validation-containsnumber-message="Enter Number between 10 & 20" min="10" max="20" required placeholder="Enter Number between 10 & 20">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Must match the specified regular expression : ^([0-9]+)$ - numbers only</label>
                                                    <div class="controls">
                                                        <input type="text" name="text" class="form-control" data-validation-containsnumber-regex="^([0-9]+)$" data-validation-containsnumber-message="The regex field format is invalid." placeholder="Enter specified regular expression" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Length should not be less than the specified length : 3</label>
                                                    <div class="controls">
                                                        <input type="text" name="minChar" class="form-control" data-validation-required-message="The min field must be at least 3 characters." minlength="3" placeholder="Enter minimum 3 characters">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>The digits field must be numeric and exactly contain 3 digits</label>
                                                    <div class="controls">
                                                        <input type="text" name="digit" class="form-control" data-validation-regex-regex="([^a-z]*[A-Z]*)*" data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" data-validation-required-message="The digits field must be numeric and exactly contain 3 digits" maxlength="3" minlength="3" placeholder="Enter Exactly 3 digits">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Only alphabetic characters, numbers, dashes or underscores</label>
                                                    <div class="controls">
                                                        <input type="text" name="reg-exp" class="form-control" data-validation-regex-regex="^[-a-zA-Z_\d]+$" data-validation-regex-message="Must Enter Character, Number, Dash or Uderscore" placeholder="Enter Character, Numbers, Dash, Uderscore" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Must be a valid url</label>
                                                    <div class="controls">
                                                        <input type="text" name="url" class="form-control" data-validation-regex-regex="^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$" data-validation-regex-message="Must be a valid url" placeholder="Enter valid url" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Input Validation end -->

        </div>
    </div>
</div>

{{-- form wizard --}}
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Form Wizard</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Forms</a>
                                </li>
                                <li class="breadcrumb-item active">Form Wizard
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Form wizard with number tabs section start -->
            <section id="number-tabs">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form wizard with number tabs</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Create neat and clean form wizard using <code>.wizard-circle</code> class.</p>
                                    <form action="#" class="number-tab-steps wizard-circle">

                                        <!-- Step 1 -->
                                        <h6>Step 1</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="firstName1">First Name </label>
                                                        <input type="text" class="form-control" id="firstName1">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="lastName1">Last Name</label>
                                                        <input type="text" class="form-control" id="lastName1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="emailAddress1">Email</label>
                                                        <input type="email" class="form-control" id="emailAddress1">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="location1">City</label>
                                                        <select class="custom-select form-control" id="location1" name="location">
                                                            <option value="new-york">New York</option>
                                                            <option value="chicago">Chicago</option>
                                                            <option value="san-francisco">San Francisco</option>
                                                            <option value="boston">Boston</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Step 2 -->
                                        <h6>Step 2</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="proposalTitle1">Proposal Title</label>
                                                        <input type="text" class="form-control" id="proposalTitle1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jobtitle">Job Title</label>
                                                        <input type="text" class="form-control" id="jobtitle">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="shortDescription1">Short Description :</label>
                                                        <textarea name="shortDescription" id="shortDescription1" rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Step 3 -->
                                        <h6>Step 3</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="eventName1">Event Name :</label>
                                                        <input type="text" class="form-control" id="eventName1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventType1">Event Status :</label>
                                                        <select class="custom-select form-control" id="eventType1" data-placeholder="Type to search cities" name="eventType1">
                                                            <option value="Banquet">Planning</option>
                                                            <option value="Fund Raiser">In Process</option>
                                                            <option value="Dinner Party">Finished</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="eventLocation1">Event Location :</label>
                                                        <select class="custom-select form-control" id="eventLocation1" name="location">
                                                            <option value="new-york">New York</option>
                                                            <option value="chicago">Chicago</option>
                                                            <option value="san-francisco">San Francisco</option>
                                                            <option value="boston">Boston</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group d-flex align-items-center pt-md-2">
                                                        <label class="mr-2">Requirements :</label>
                                                        <div class="c-inputs-stacked">
                                                            <div class="d-inline-block mr-2">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="false">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Staffing</span>
                                                                </div>
                                                            </div>
                                                            <div class="d-inline-block">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="false">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Catering</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Form wizard with number tabs section end -->

            <!-- Form wizard with icon tabs section start -->
            <section id="icon-tabs">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form wizard with icon tabs</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Add <code>.icons-tab-steps</code> class to get desired icons in tab.</p>
                                    <form action="#" class="icons-tab-steps wizard-circle">

                                        <!-- Step 1 -->
                                        <h6><i class="step-icon feather icon-home"></i> Step 1</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="firstName11">First Name </label>
                                                        <input type="text" class="form-control" id="firstName11">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="lastName11">Last Name</label>
                                                        <input type="text" class="form-control" id="lastName11">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="emailAddress11">Email</label>
                                                        <input type="email" class="form-control" id="emailAddress11">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="location11">City</label>
                                                        <select class="custom-select form-control" id="location11" name="location">
                                                            <option value="new-york">New York</option>
                                                            <option value="chicago">Chicago</option>
                                                            <option value="san-francisco">San Francisco</option>
                                                            <option value="boston">Boston</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Step 2 -->
                                        <h6><i class="step-icon feather icon-briefcase"></i> Step 2</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="proposalTitle11">Proposal Title</label>
                                                        <input type="text" class="form-control" id="proposalTitle11">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jobtitle11">Job Title</label>
                                                        <input type="text" class="form-control" id="jobtitle11">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="shortDescription11">Short Description :</label>
                                                        <textarea name="shortDescription" id="shortDescription11" rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Step 3 -->
                                        <h6><i class="step-icon feather icon-image"></i> Step 3</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="eventName11">Event Name :</label>
                                                        <input type="text" class="form-control" id="eventName11">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventType11">Event Status :</label>
                                                        <select class="custom-select form-control" id="eventType11" data-placeholder="Type to search cities" name="eventType11">
                                                            <option value="Banquet">Planning</option>
                                                            <option value="Fund Raiser">In Process</option>
                                                            <option value="Dinner Party">Finished</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="eventLocation11">Event Location :</label>
                                                        <select class="custom-select form-control" id="eventLocation11" name="location">
                                                            <option value="new-york">New York</option>
                                                            <option value="chicago">Chicago</option>
                                                            <option value="san-francisco">San Francisco</option>
                                                            <option value="boston">Boston</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group d-flex align-items-center pt-md-2">
                                                        <label class="mr-2">Requirements :</label>
                                                        <div class="c-inputs-stacked">
                                                            <div class="d-inline-block mr-2">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="false">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Staffing</span>
                                                                </div>
                                                            </div>
                                                            <div class="d-inline-block">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="false">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Catering</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Form wizard with icon tabs section end -->

            <!-- Form wizard with step validation section start -->
            <section id="validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Validation Example</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="#" class="steps-validation wizard-circle">
                                        <!-- Step 1 -->
                                        <h6><i class="step-icon feather icon-home"></i> Step 1</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstName3">
                                                            First Name
                                                        </label>
                                                        <input type="text" class="form-control required" id="firstName3" name="firstName">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lastName3">
                                                            Last Name
                                                        </label>
                                                        <input type="text" class="form-control required" id="lastName3" name="lastName">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="emailAddress5">
                                                            Email
                                                        </label>
                                                        <input type="email" class="form-control required" id="emailAddress5" name="emailAddress">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="location">
                                                            City
                                                        </label>
                                                        <select class="custom-select form-control" id="location" name="location">
                                                            <option value="">New York</option>
                                                            <option value="Amsterdam">Chicago</option>
                                                            <option value="Berlin">San Francisco</option>
                                                            <option value="Frankfurt">Boston</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Step 2 -->
                                        <h6><i class="step-icon feather icon-briefcase"></i> Step 2</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="proposalTitle3">
                                                            Proposal Title
                                                        </label>
                                                        <input type="text" class="form-control required" id="proposalTitle3" name="proposalTitle">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jobTitle5">
                                                            Job Title
                                                        </label>
                                                        <input type="text" class="form-control required" id="jobTitle5" name="jobTitle">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="shortDescription3">Short Description</label>
                                                        <textarea name="shortDescription" id="shortDescription3" rows="4" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Step 3 -->
                                        <h6><i class="step-icon feather icon-image"></i> Step 3</h6>
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventName3">
                                                            Event Name
                                                        </label>
                                                        <input type="text" class="form-control required" id="eventName3" name="eventName">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventStatus3">
                                                            Event Status
                                                        </label>
                                                        <select class="custom-select form-control required" id="eventStatus3" name="eventStatus">
                                                            <option value="Planning">Planning</option>
                                                            <option value="In Progress">In Progress</option>
                                                            <option value="Finished">Finished</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventLocation3">
                                                            Event Location
                                                        </label>
                                                        <select class="custom-select form-control required" id="eventLocation3" name="eventStatus">
                                                            <option value="Planning">New York</option>
                                                            <option value="In Progress">Chicago</option>
                                                            <option value="Finished">San Francisco</option>
                                                            <option value="Finished">Boston</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group d-flex align-items-center pt-md-2">
                                                        <label class="mr-2">Requirements :</label>
                                                        <div class="c-inputs-stacked">
                                                            <div class="d-inline-block mr-2">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="false">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Staffing</span>
                                                                </div>
                                                            </div>
                                                            <div class="d-inline-block">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="false">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Catering</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Form wizard with step validation section end -->

        </div>
    </div>
</div>
@endsection


@section('scripts')
{{-- datepeaker --}}
<script src="assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="assets/vendors/js/pickers/pickadate/legacy.js"></script>

<script src="assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>

{{-- form input --}}
<script src="assets/js/scripts/forms/form-tooltip-valid.js"></script>

{{-- number input --}}
<script src="assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
<script src="assets/js/scripts/forms/number-input.js"></script>

{{-- select --}}
<script src="assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="assets/js/scripts/forms/select/form-select2.js"></script>

{{-- form validation --}}
<script src="assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
<script src="assets/js/scripts/forms/validation/form-validation.js"></script>

{{-- form wizard --}}
<script src="assets/vendors/js/extensions/jquery.steps.min.js"></script>
<script src="assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="assets/js/scripts/forms/wizard-steps.js"></script>

@endsection