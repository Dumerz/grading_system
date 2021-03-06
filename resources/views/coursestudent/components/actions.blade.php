    <div class="col-lg-3 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-sliders-h"></i> Actions
        </div>
        <div class="card-body">
          <a href="{{ route('course_managed_add') }}" >
          <i class="fa fa-plus"></i> 
          {{ __('Add Course') }}
          </a>
          <hr/>
          <a href="{{ route('course_managed_update', $course->id) }}" >
          <i class="fa fa-edit"></i> 
          {{ __('Update Course') }}
          </a>
          <hr/>
          <a class="text-danger" href="{{ route('course_managed_delete', $course->id) }}" >
          <i class="fa fa-times"></i> 
          {{ __('Delete course') }}
          </a>
        </div>
      </div>
    </div>