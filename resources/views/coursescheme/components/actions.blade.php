    <div class="col-lg-3 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-sliders-h"></i> Actions
        </div>
        <div class="card-body">
          <a href="{{ route('course_managed_show', $course->id) }}" >
          <i class="fa fa-eye"></i> 
          {{ __('Show course') }}
          </a>
          <hr/>
          <a href="{{ route('course_managed_scheme', ['course' => $course->id]) }}" >
          <i class="fa fa-eye"></i> 
          {{ __('Show schemes') }}
          </a>
          <hr/>
          <a href="{{ route('course_managed_scheme_add', $course->id) }}" >
          <i class="fa fa-plus"></i> 
          {{ __('Add new scheme') }}
          </a>
          <hr/>
          <a href="{{ route('course_managed_scheme_update', ['course' => $course->id, 'scheme' => $scheme->id]) }}" >
          <i class="fa fa-edit"></i> 
          {{ __('Update scheme') }}
          </a>
          <hr/>
          <a class="text-danger" href="{{ route('course_managed_scheme_delete', ['course' => $course->id, 'scheme' => $scheme->id]) }}" >
          <i class="fa fa-times"></i> 
          {{ __('Delete scheme') }}
          </a>
        </div>
      </div>
    </div>