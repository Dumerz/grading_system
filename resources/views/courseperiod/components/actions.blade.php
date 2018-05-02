    <div class="col-lg-3 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-sliders-h"></i> Actions
        </div>
        <div class="card-body">
          <a href="{{ route('course_managed', $course->id) }}" >
          <i class="fa fa-eye"></i> 
          {{ __('Show course') }}
          </a>
          <hr/>
          <a href="{{ route('course_managed_period_show', ['course' => $course->id, 'period' => $period->id]) }}" >
          <i class="fa fa-eye"></i> 
          {{ __('Show period') }}
          </a>
          <hr/>
          <a href="{{ route('course_managed_period_add', $course->id) }}" >
          <i class="fa fa-plus"></i> 
          {{ __('Add new period') }}
          </a>
          <hr/>
          <a href="{{ route('course_managed_period_update', ['course' => $course->id, 'period' => $period->id]) }}" >
          <i class="fa fa-edit"></i> 
          {{ __('Update period') }}
          </a>
          <hr/>
          <a class="text-danger" href="{{ route('course_managed_period_delete', ['course' => $course->id, 'period' => $period->id]) }}" >
          <i class="fa fa-times"></i> 
          {{ __('Delete period') }}
          </a>
        </div>
      </div>
    </div>