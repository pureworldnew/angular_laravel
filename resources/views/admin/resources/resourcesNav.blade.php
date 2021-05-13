<div id="resourcesNav" >
    <ul class="nav nav-tabs">
        <li class="{{ $resourceType == "categories" ? 'active' : ''  }}" ><a href="/admin/resources/categories">{{ trans('admin/resources/resourcesNav.categories') }}</a></li>
        <li class="{{ $resourceType == "products" ? 'active' : ''  }}" ><a href="/admin/resources/products">{{ trans('admin/resources/resourcesNav.products') }}</a></li>
        <li class="{{ $resourceType == "tagwords" ? 'active' : ''  }}" ><a href="/admin/resources/tagwords">{{ trans('admin/resources/resourcesNav.tagwords') }}</a></li>
    </ul>
</div>
<br/><br/>
