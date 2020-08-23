<aside class="sidebar">
    <div class="scroll-sidebar">

        @if(session()->get('theme-layout') != 'fix-header')
        <div class="user-profile">
            <div class="dropdown user-pro-body ">
                <div class="profile-image">
                    @if(auth()->user()->profile->pic == null)
                    <img src="{{asset('storage/uploads/users/no_avatar.jpg')}}" alt="user-img" class="img-circle">
                    @else
                    <img src="{{asset('storage/uploads/users/'.auth()->user()->profile->pic)}}" alt="user-img" class="img-circle">
                    @endif


                    @if(auth()->user()->hasRole('user'))
                    <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="badge badge-danger">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated flipInY">
                        <li><a href="{{url('profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                        {{--<li><a href="javascript:void(0);"><i class="fa fa-inbox"></i> Inbox</a></li>--}}
                        <li role="separator" class="divider"></li>
                        <li><a href="{{'trainer-account-settings'}}"><i class="fa fa-cog"></i> Account Settings</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                    @endif
                </div>
                <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);"> {{auth()->user()->name}}</a></p>
            </div>
        </div>
        @endif
        <nav class="sidebar-nav">
            <ul id="side-menu">
                <li>
                    <a class="active waves-effect" href="{{url('/')}}" aria-expanded="false">
                        <i class="icon-screen-desktop fa-fw"></i> 
                        <span class="hide-menu"> Dashboard </span>
                    </a>
                </li>
                @if(auth()->user()->isAdmin() == true)
                <li class="two-column">
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-notebook fa-fw"></i> <span class="hide-menu">Courses</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('courses')}}">View Courses</a></li>
                        <li><a href="{{url('create_courses')}}">Add Course</a></li>
                    </ul>
                </li>
                <li class="two-column">
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-user fa-fw"></i> <span class="hide-menu">Trainers</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('trainers')}}">View Trainers</a></li>
                        <li><a href="{{url('create_trainer')}}">Add Trainer</a></li>
                    </ul>
                </li>
                <li class="two-column">
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-location-pin fa-fw"></i> <span class="hide-menu">Venues</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('venues')}}">View Venues</a></li>
                        <li><a href="{{url('create_venue')}}">Add Venue</a></li>
                    </ul>
                </li>
                <li class="two-column">
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-people fa-fw"></i> <span class="hide-menu">Customers</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('customers')}}">View Customers</a></li>
                        <li><a href="{{url('create_customer')}}">Add Customer</a></li>
                    </ul>
                </li>

                <li class="two-column">
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-folder-alt fa-fw"></i> <span class="hide-menu">Bookings</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('bookings')}}">View Bookings</a></li>
                        <li><a href="{{url('create_booking')}}">Add booking</a></li>
                    </ul>
                </li>
                <li class="two-column">
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-envelope fa-fw"></i> <span class="hide-menu"> Email</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('trainers_email')}}">Trainer</a></li>
                        <li><a href="{{url('customers_email')}}">Customer</a></li>
                        <li><a href="{{url('venues_email')}}">Venue</a></li>
                    </ul>
                </li>
                 @endif

                @if(auth()->user()->hasRole('user'))
                 <li class="two-column">
                    <a class="waves-effect" href="javascript:void(0);" aria-expanded="false"><i
                            class="icon-notebook fa-fw"></i> <span class="hide-menu">Schedule</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{url('schedule')}}">View Schedule</a></li>
                        <li><a href="{{url('add-schedule')}}">Add Schedule</a></li>
                    </ul>
                </li>
                <li>
                    <a class="waves-effect" href="{{url('requested-bookings')}}" aria-expanded="false">
                        <i class="fa fa-folder-open fa-fw"></i> 
                        <span class="hide-menu">Requested Bookings</span>
                    </a>
                </li>

                <li>
                    <a class="waves-effect" href="{{url('current-bookings')}}" aria-expanded="false">
                        <i class="fa fa-folder-open-o fa-fw"></i> 
                        <span class="hide-menu">Current Bookings</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect" href="{{url('complete-bookings')}}" aria-expanded="false">
                        <i class="fa fa-folder fa-fw"></i> 
                        <span class="hide-menu">Complete Bookings</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect" href="{{ url('trainer-account-settings') }}">
                        <i class="fa fa-gear fa-fw"></i>
                        <span class="hide-menu"> Account Settigs</span>
                    </a>
                </li> 
                @endif
            </ul>
        </nav>
    </div>
</aside>