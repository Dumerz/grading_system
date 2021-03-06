    <div class="col-lg-4 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-info-circle"></i> Course Information
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
              <tbody>
                <tr>
                  <td>Name</td>
                  <td>{{ __($course->name)}}</td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td>{{ __(ucfirst($course->description))}}</td>
                </tr>
                <tr>
                  <td>Evaluator</td>
                  <td><a href="{{ route('user_profile_show', $course->evaluator_user->id ) }}">{{ __(title_case($course->evaluator_user->name_full))}}</a></td>
                </tr>
                <tr>
                  <td>No of Students</td>
                  <td><a href="{{ route('course_managed_period', $course->id ) }}">{{ __($course->total_students) }} {{ __(str_plural('student', $course->total_students)) }}</a></td>
                </tr>
                <tr>
                  <td>No of Periods</td>
                  <td><a href="{{ route('course_managed_period', $course->id ) }}">{{ __($course->total_periods) }} {{ __(str_plural('period', $course->total_periods)) }}</a></td>
                </tr>
                <tr>
                  <td>No of Schemes</td>
                  <td><a href="{{ route('course_managed_period', $course->id ) }}">{{ __($course->total_schemes) }} {{ __(str_plural('scheme', $course->total_schemes)) }}</a></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>{{ __(title_case($course->_status->description))}}</td>
                </tr>
                <tr>
                  <td>Date Created</td>
                  <td>{{ __($course->created_at->diffForHumans()) }}</td>
                </tr>
                <tr>
                  <td>Date Last Modified</td>
                  <td>{{ __($course->updated_at->diffForHumans()) }}</td>
                </tr>
                </tr>
              </tbody>
            </table>
        </div>
        </div>
      </div>
    </div>