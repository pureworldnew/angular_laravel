@if (empty($hideMenu) AND !empty($navPage))
    <nav id="mainNav" class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin">Bokakanot</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <!-- <li class="{{ $navPage == "home" ? 'active' : ''  }}" ><a href="/">{{ trans('mainNav.home') }}</a></li> -->
                    @if (/*Auth::guest()*/Auth::user() && $user_type == 1)
                        <li class="{{ $navPage == "bookings" ? 'active' : ''  }}" ><a href="/admin/bookings">{{ trans('adminNav.bookings') }}</a></li>
                        <li class="{{ $navPage == "picklist" ? 'active' : ''  }}" ><a href="/admin/picklist">{{ trans('adminNav.picklist') }}</a></li>
                        <li class="{{ $navPage == "reports" ? 'active' : ''  }}" ><a href="/admin/reports/gantt">{{ trans('adminNav.reports') }}</a></li>
                     @elseif (/*Auth::guest()*/Auth::user() && $user_type == 6)
                        <li class="{{ $navPage == "bookings" ? 'active' : ''  }}" ><a href="/admin/bookings">{{ trans('adminNav.bookings') }}</a></li>
                        <li class="{{ $navPage == "picklist" ? 'active' : ''  }}" ><a href="/admin/picklist">{{ trans('adminNav.picklist') }}</a></li>
                        <li class="{{ $navPage == "reports" ? 'active' : ''  }}" ><a href="/admin/reports/gantt">{{ trans('adminNav.reports') }}</a></li>
                    @endif

                </ul>
                <ul class="nav navbar-nav navbar-right">

                    @if (Auth::guest() && $mmenutype == "manager")
                    
                    @elseif(Auth::guest())
                         <li class="{{ $navPage == "login" ? 'active' : ''  }}"><a href="{{ url('/login') }}">Login</a></li>
                        <li class="{{ $navPage == "register" ? 'active' : ''  }}"><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ trans('adminNav.resources') }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/admin/resources/products">{{ trans('adminNav.products') }}</a></li>
                                <li><a href="/admin/resources/categories">{{ trans('adminNav.categories') }}</a></li>
                            </ul>
                        </li>
                       @if (/*Auth::guest()*/Auth::user() && $user_type == 1)
                        <li class="{{ $navPage == "settings" ? 'active' : ''  }}" ><a href="/admin/settings">{{ trans('adminNav.settings') }}</a></li>
                        @endif
                        <li class="{{ $navPage == "users" ? 'active' : ''  }}" ><a href="/admin/users">{{ trans('adminNav.users') }}</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                    
                    @if(isset($mann))
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Config::get('languages')[App::getLocale()] }}
                        </a>
                        <ul class="dropdown-menu">
                          {{ Config::get('languages')[App::getLocale()] }}
                            @foreach (Config::get('languages') as $lang => $language)
                                @if ($lang != App::getLocale())
                                    <li>
                                        <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    @endif

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@endif
