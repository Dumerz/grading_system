    <div class="col-lg-4 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-info-circle"></i> User Information
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <td>Full Name</td>
                    <td><a href="{{ route('user_show', $user->id) }}">{{ __(title_case($user->name_full))}}</a></td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td>{{ __(title_case($user->gender))}}</td>
                  </tr>
                  <tr>
                    <td>Age</td>
                    <td>{{ __($user->age)}}</td>
                  </tr>
                  <tr>
                    <td>Usertype</td>
                    <td><a href="{{ route('usertype_show', $user->typeuser->no) }}">{{ __(title_case($user->typeuser->description))}}</a></td>
                  </tr>
                  <tr>
                    <td>Userstatus</td>
                    <td><a href="{{ route('userstatus_show', $user->statususer->no) }}">{{ __(title_case($user->statususer->description))}}</a></td>
                  </tr>
                  <tr>
                    <td>Date Created</td>
                    <td>{{ __($user->created_at->diffForHumans()) }}</td>
                  </tr>
                  <tr>
                    <td>Date Last Modified</td>
                    <td>{{ __($user->updated_at->diffForHumans()) }}</td>
                  </tr>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>