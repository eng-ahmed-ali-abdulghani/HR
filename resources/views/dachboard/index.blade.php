@extends('dachboard.layouts.app')
{{-- @extends('dachboard.layouts.navbar') --}}

{{-- @section('title')
    Dashboard
@endsection --}}
@section('content')
    <!-- Main content -->
    <div class="report-box-cont mt-5">
        <div class="report-box">
            <!-- small box -->
            <div class="small-box red-blue-bg">
                <div class="inner">
                    {{-- <h3>{{ $posts_count }}</h3> --}}
                    <h3>{{ $users_count }}</h3>
                    <p>Employees</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Show All<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="report-box">
            <!-- small box -->
            <div class="small-box red-blue-bg">
                <div class="inner">

                    {{-- <h3>{{ $report }}<sup style="font-size: 20px">%</sup></h3> --}}
                    <h3>4</h3>
                    <p>Ontime</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer"> Show All <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="report-box">
            <!-- small box -->
            <div class="small-box red-blue-bg">
                <div class="inner">

                    {{-- <h3>{{ $report }}<sup style="font-size: 20px">%</sup></h3> --}}
                    <h3>4</h3>
                    <p>Late</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer"> Show All <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="report-box">
            <!-- small box -->
            <div class="small-box red-blue-bg">
                <div class="inner">

                    {{-- <h3>{{ $report }}<sup style="font-size: 20px">%</sup></h3> --}}
                    <h3>4</h3>
                    <p>Absent</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer"> Show All <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="report-box">
            <!-- small box -->
            <div class="small-box red-blue-bg">
                <div class="inner">
                    {{-- <h3>{{ $users_count }}</h3> --}}
                    <h3>4</h3>
                    <p>Not Signed in</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">Show All <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="report-box">
            <!-- small box -->
            <div class="small-box red-blue-bg">
                <div class="inner">
                    <h3>4</h3>
                    <p>On Leave</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer"> Show All <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="report-box">
            <!-- small box -->
            <div class="small-box red-blue-bg">
                <div class="inner">
                    <h3>4</h3>
                    <p>Day Off/ Holiday</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer"> Show All <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!--./col -->
    </div>
@endsection
