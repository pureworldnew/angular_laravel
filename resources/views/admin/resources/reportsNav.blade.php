<div id="reportsNav" >
    <ul class="nav nav-tabs">
      <li class="{{ $reportType == "gantt" ? 'active' : ''  }}"><a href="/admin/reports/gantt">{{ trans('admin/reports.chartText') }}</a></li>
      <li class="{{ $reportType == "table" ? 'active' : ''  }}"><a href="/admin/reports/table">{{ trans('admin/reports.tableText') }}</a></li>
      <li class="{{ $reportType == "customers" ? 'active' : ''  }}"><a href="/admin/reports/customers">{{ trans('admin/reports.tableCustomersText') }}</a></li>
    </ul>
</div>
<br/><br/>
