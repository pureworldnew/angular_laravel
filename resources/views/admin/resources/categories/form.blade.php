    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        {!! Form::label('parentCategory', trans('admin/resources/add.parentCategoryLabel')) !!}
        {!! Form::select('parentCategory', $categories, ( isset($category->parentCategory) ? $category->parentCategory : 0), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">

        {!! Form::label('name', trans('admin/resources/add.titleLabel')) !!}
        {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/categoryForm.categoryTitlePlaceholder'))) !!}

    </div>
    <div class="form-group">
        {!! Form::label(trans('admin/resources/add.descriptionLabel'), trans('admin/resources/add.descriptionLabel')) !!}
        {!! Form::text('description', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/categoryForm.categoryDescriptionPlaceholder'))) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name', trans('admin/resources/add.titleLabelDe')) !!}
        {!! Form::text('name_de', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/categoryForm.categoryTitlePlaceholder'))) !!}

    </div>
    <div class="form-group">
        {!! Form::label(trans('admin/resources/add.descriptionLabelDe'), trans('admin/resources/add.descriptionLabelDe')) !!}
        {!! Form::text('description_de', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/categoryForm.categoryDescriptionPlaceholder'))) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name', trans('admin/resources/add.titleLabelSe')) !!}
        {!! Form::text('name_se', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/categoryForm.categoryTitlePlaceholder'))) !!}

    </div>
    <div class="form-group">
        {!! Form::label(trans('admin/resources/add.descriptionLabelSe'), trans('admin/resources/add.descriptionLabelSe')) !!}
        {!! Form::text('description_se', null, array('class' => 'form-control', 'placeholder' => trans('admin/resources/categoryForm.categoryDescriptionPlaceholder'))) !!}
    </div>

    <div class="form-group imageColum">

        @if(isset($category) AND $category->image <> "")
            <img style="float:left;width:200px;margin: 5px 20px 0 0" src="/images/categories/{{$category->image}}" />

        @endif

            {!! Form::label('image', trans('admin/resources/add.imageLabel')) !!}

            {!! Form::file('image') !!}

    </div>


    {!! Form::submit(trans('admin/resources/add.'.$submitButtonType."Button"), ["class" => 'btn btn-success']) !!}
