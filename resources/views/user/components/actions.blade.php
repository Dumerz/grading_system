    <div class="col-lg-3 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-sliders-h"></i> Actions
        </div>
        <div class="card-body">
          <a href="{{ route('user_add') }}" >
          <i class="fa fa-user-plus"></i> 
          {{ __('Add new user') }}
          </a>
        @if($user->usertype != 'USRTYPE003' || $user->id == Auth::user()->id)
          <hr/>
          <a href="{{ route('user_update', $user->id) }}" >
          <i class="fa fa-edit"></i> 
          {{ __('Update user information') }}
          </a>
        @endif
        @if($user->usertype != 'USRTYPE003')
          <hr/>
          <a href="{{ route('user_change_password', $user->id) }}" >
          <i class="fa fa-key"></i> 
          {{ __('Change password') }}
          </a>
        @elseif($user->usertype != 'USRTYPE003' || $user->id == Auth::user()->id)
          <hr/>
          <a href="{{ route('user_change_password', $user->id) }}" >
          <i class="fa fa-key"></i> 
          {{ __('Change password') }}
          </a>
        @endif
        @if($user->usertype != 'USRTYPE003')
          <hr/>
          <a class="text-danger" href="{{ route('user_delete', $user->id) }}" >
          <i class="fa fa-user-times"></i> 
          {{ __('Delete account') }}
          </a>
        @endif
        </div>
      </div>
    </div>