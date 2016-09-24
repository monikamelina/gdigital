@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Dashboard</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-2 col-sm-2 col-xs-12 profile_left">
                    <div class="profile_img">
                        <div id="crop-avatar">
                            <!-- Current avatar -->
                            <img class="img-responsive avatar-view" src="{{ '/images/profile.jpg' }}" alt="Avatar" title="Change the avatar">
                        </div>
                    </div>
                    <h3>{{Auth::user()->name}}</h3>
                     <ul class="list-unstyled user_data">
                        @if (!empty(Auth::user()->profile->city) || !empty(Auth::user()->profile->state) || !empty(Auth::user()->profile->country))
                            <li><i class="fa fa-map-marker user-profile-icon"></i> {{Auth::user()->profile->fullAddress}}</li>
                        @endif
                        @if (!empty(Auth::user()->profile->ocupation))
                            <li><i class="fa fa-briefcase user-profile-icon"></i> {{Auth::user()->profile->ocupation}}</li>
                        @endif
                        @if (!empty(Auth::user()->profile->website))
                            <li class="m-top-xs"><i class="fa fa-external-link user-profile-icon"></i> 
                            <a href="{{Auth::user()->profile->website}}" target="_blank">{{Auth::user()->profile->website}}</a></li>
                        @endif
                    </ul>
                    <a href="/profile" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                    <br />
                    <!-- start skills -->
                    <h4>Contacts</h4>
                    <ul class="list-unstyled user_data">
                        <li>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$contacts}}"></div>
                            </div>
                        </li>
                    </ul>
                    <!-- end of skills -->
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="profile_title">
                        <div class="col-md-6">
                            <h2>Contacts <small>List</small></h2>
                        </div>
                        <div class="col-md-6">
                            <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;<span>{{ date('F d, Y')}}</span> <b class="caret"></b>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @include('includes._datatable')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes._contactmodal')
@endsection

@push('header.page.level.style')
      <!-- Datatables -->
    <link rel="stylesheet" href="/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" />
    <link rel="stylesheet" href="/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" />
    <link rel="stylesheet" href="/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" />
@endpush

@push('header.page.level.script')
  <script type="text/javascript" src="https://js.pusher.com/3.2/pusher.min.js"></script>
@endpush 
@push('footer.page.level.scripts')
	<!-- Datatables -->
    <script type="text/javascript" src="/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script type="text/javascript" src="/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script type="text/javascript" src="/vendors/jszip/dist/jszip.min.js"></script>
    <script type="text/javascript" src="/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- bootstrap-progressbar -->
    <script type="text/javascript" src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <script type="text/javascript" src="/js/contacts.js"></script>
@endpush

