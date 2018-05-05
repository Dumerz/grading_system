    <div class="col-lg-3 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-sliders-h"></i> Actions
        </div>
        <div class="card-body">
        @if ($user->id == Auth::user()->id)
          @if($user->usertype == 'USRTYPE003'||$user->usertype == 'USRTYPE002')
            <a href="{{ route('user_profile_update', $user->id) }}" >
            <i class="fa fa-edit"></i> 
            {{ __('Update user information') }}
            </a>
            <hr/>
          @endif
            <a href="{{ route('user_profile_change_password', $user->id) }}" >
            <i class="fa fa-key"></i> 
            {{ __('Change password') }}
            </a>
        @endif
        </div>
      </div>
    </div>