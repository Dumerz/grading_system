    <div class="col-lg-3 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-sliders-h"></i> Actions
        </div>
        <div class="card-body">
          <a href="{{ route('course_managed_period_item_add', ['course' => $item->course, 'period' => $item->period]) }}" >
          <i class="fa fa-plus"></i> 
          {{ __('Add new item') }}
          </a>
          <hr/>
          <a href="{{ route('course_managed_period_item_update', ['course' => $item->course, 'period' => $item->period, 'item' => $item->id]) }}" >
          <i class="fa fa-edit"></i> 
          {{ __('Update period') }}
          </a>
          <hr/>
          <a class="text-danger" href="{{ route('course_managed_period_item_delete', ['course' => $item->course, 'period' => $item->period, 'item' => $item->id]) }}" >
          <i class="fa fa-times"></i> 
          {{ __('Delete period') }}
          </a>
        </div>
      </div>
    </div>