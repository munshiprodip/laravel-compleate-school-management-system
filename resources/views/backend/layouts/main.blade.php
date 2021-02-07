<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>EduPro - @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">





  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/dist/css/adminlte.min.css')}}">
  <!-- My customized style -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/assets/customize.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-navy">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notification link -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">3</span>
        </a>
      </li>
      <!-- End notification -->
      <!-- Logout link -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').
          submit();">
          <i class="fas fa-sign-out-alt"></i>
          <span>Signout</span>
        </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
      <!-- End Logout -->


      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('public/backend/assets/images/EduPro.png')}}"
           alt="EduPro" class="brand-image" style="width: 175px;">
      <span class="brand-text font-weight-light" style="visibility: hidden;">EduPro</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('public/backend/dist/img/me.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Admin Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('bloodgroup')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bloodgroup</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('religion')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Religion</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('gender')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Gender</p>
                      </a>
                  </li>
            </ul>
            <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('role')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Role</p>
                      </a>
                  </li>
            </ul>
            <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('permission')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Permission</p>
                      </a>
                  </li>
            </ul>
            <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('user')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>User</p>
                      </a>
                  </li>
            </ul>

          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Academics
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('session')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Session</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('class')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('section')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Section</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('subject')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subjects</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('classroom')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Room</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('classtime')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Time Setup</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('classroutine.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Rutine</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Student Info
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('studentCategory')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Category</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('students.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Student</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('students.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student List</p>
                </a>
              </li>
            </ul>
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Student Attendance</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('promoteStudents')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Promote</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('disabledStudents')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disabled Student</p>
                </a>
              </li>
            </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('parents.index')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Parent's List</p>
                      </a>
                  </li>
              </ul>
          </li>

{{--          <li class="nav-item has-treeview">--}}
{{--            <a href="#" class="nav-link">--}}
{{--              <i class="nav-icon fas fa-copy"></i>--}}
{{--              <p>--}}
{{--                Study Material--}}
{{--                <i class="fas fa-angle-left right"></i>--}}
{{--              </p>--}}
{{--            </a>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Upload Content</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Assignment</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Syllabus</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Other Downloads</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--          </li>--}}



          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('feestypes.index')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Fees Type</p>
                      </a>
                  </li>
              </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('feessetup.index')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Fees Setup</p>
                      </a>
                  </li>
              </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Fees Discount</p>
                      </a>
                  </li>
              </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('fees.collect')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Collect Fees</p>
                      </a>
                  </li>
              </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Search Fees Payment</p>
                      </a>
                  </li>
              </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Search Fees Due</p>
                      </a>
                  </li>
              </ul>
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Chart Of Account</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Bank Account</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Income</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('salary.deduction')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Salary Deduction</p>
                      </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('salary.process')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Salary Process</p>
                      </a>
                  </li>
              </ul>

              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('salary.sheet')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Salary Sheet</p>
                      </a>
                  </li>
              </ul>

{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Profit</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Expense</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Human Resource
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('designation')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Designation</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('department')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Departent</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('staffs.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Staff</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('staffs.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Staff Directory</p>
                </a>
              </li>
            </ul>
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Increments</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Staff Attendance</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav nav-treeview">--}}
{{--              <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                  <i class="far fa-circle nav-icon"></i>--}}
{{--                  <p>Payroll</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Leave
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leave Type</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leave Define</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approve Leave Request</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Leave</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Apply Leave</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Examination
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Grade</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Type</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Setup</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Schedule</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Attendance</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mark Register</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Result</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Home Work
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Homework</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Communication
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notice Board</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send Email/SMS</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Library
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>1</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Inventory
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>1</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Transport
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>1</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>1</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                System Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>1</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Website Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>1</p>
                </a>
              </li>
            </ul>
          </li>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @yield('breadcrumb')
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          @yield('content')
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020-2025 <a href="https://creativeye.net">Creativeye.net</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- overlayScrollbars -->
<script src="{{ asset('public/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('public/backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('public/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{ asset('public/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ asset('public/backend/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('public/backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('public/backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('public/backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{ asset('public/backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('public/backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('public/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>


<script src="{{ asset('public/vendor/sweetalert/sweetalert.all.js')}}"></script>
@include('sweetalert::alert')

<!-- AdminLTE App -->
<script src="{{ asset('public/backend/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/backend/dist/js/demo.js')}}"></script>

@yield('script')


</body>
</html>
