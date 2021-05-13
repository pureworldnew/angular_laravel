<style>
    /*#adminNav {
        margin-top: 10px;
    }
    #adminNav ul {
        padding: 0;
        margin-bottom: 40px;

    }
    #adminNav li {
        display:inline;
        background: #5bc0de;
        padding: 1rem;
    }
    #adminNav li.active {
        background-color: #449d44;
    }
    #adminNav li a {
        color: white;
        text-decoration: none;
    }*/
</style>
<div id="adminNav" >
    <ul class="nav nav-pills">
        <li class="{{ $adminPage == "resources" ? 'active' : ''  }}" ><a href="/admin/resources">{{ trans('adminNav.resources') }}</a></li>
        <li class="{{ $adminPage == "bookings" ? 'active' : ''  }}" ><a href="/admin/bookings">{{ trans('adminNav.bookings') }}</a></li>
        <li class="{{ $adminPage == "reports" ? 'active' : ''  }}" ><a href="/admin/reports">{{ trans('adminNav.reports') }}</a></li>
        <li class="{{ $adminPage == "manage" ? 'active' : ''  }}" ><a href="/manage">{{ trans('adminNav.manage') }}</a></li>
        <li class="{{ $adminPage == "settings" ? 'active' : ''  }}" ><a href="/admin/settings">{{ trans('adminNav.settings') }}</a></li>
    </ul>
</div>