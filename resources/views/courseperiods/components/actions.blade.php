    <div class="col-lg-3 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-sliders-h"></i> Actions
        </div>
        <div class="card-body">
          <a href="{{ route('course_add') }}" >
          <i class="fa fa-plus"></i> 
          {{ __('Add new course') }}
          </a>
          <hr/>
          <a href="{{ route('course_update', $course->id) }}" >
          <i class="fa fa-edit"></i> 
          {{ __('Update course') }}
          </a>
          <hr/>
          <a class="text-danger" href="{{ route('course_delete', $course->id) }}" >
          <i class="fa fa-times"></i> 
          {{ __('Delete course') }}
          </a>
        </div>
      </div>
    </div>