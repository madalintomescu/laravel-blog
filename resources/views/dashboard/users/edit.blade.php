@extends('layouts.dashboard.base')
@section('pageTitle', 'Edit user')

@section('content')

{{ Breadcrumbs::render('dashboard.users.edit', $user) }}

<div class="container-fluid">

    <h1 class="page-heading mb-4">
        @if (auth()->user()->id === $user->id)
        Edit your profile
        @else
        Edit user profile - {{ $user->name }}
        @endif
    </h1>

    <div class="row">

        <div class="col col-md-3">

            <div class="list-group" id="list-tab" role="tablist">

                {{-- If the user submitted the password change form add active class to password tab --}}
                <a class="list-group-item list-group-item-action fs-14 @unless ($errors->password->any()) active @endunless" id="list-details-list" data-toggle="list" href="#list-details" role="tab" aria-controls="details">Account details</a>

                <a class="list-group-item list-group-item-action fs-14 @if ($errors->password->any()) active @endif" id="list-password-list" data-toggle="list" href="#list-password" role="tab" aria-controls="password">Change password</a>
            </div>

        </div>

        <div class="col-12 col-md-9">

            <div class="tab-content box-shadow rounded border-0 mb-4" id="nav-tabContent">

                {{-- Account details tab --}}
                <div class="tab-pane fade show active" id="list-details" role="tabpanel" aria-labelledby="list-details-list">

                    <div class="row">
                        <div class="col col-lg-6 p-3">

                            <form class="form" action="{{ route('dashboard.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label for="name" class="custom-label">Name</label>

                                    <input type="text" name="name" id="name" class="form-control custom-form-control{{ $errors->details->has('name') ? ' is-invalid' : '' }}" value="{{ $user->name }}" required>

                                    @if ($errors->details->has('name'))
                                    <span class="invalid-message">
                                        <strong>{{ $errors->details->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label for="email" class="custom-label">Email</label>

                                    <input type="email" name="email" id="email" class="form-control custom-form-control{{ $errors->details->has('name') ? ' is-invalid' : '' }}" value="{{ $user->email }}" required>

                                    @if ($errors->details->has('email'))
                                    <span class="invalid-message">
                                        <strong>{{ $errors->details->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label for="avatar" class="custom-label">Profile picture</label>


                                    <div id="image_container">

                                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" id="image_preview" class="img-fluid display-block border mb-2">

                                        <input type="file" name="avatar" id="image_select" class="form-control-file fs-14 @if ($user->avatar !== App\User::DEFAULT_AVATAR) display-none @endif" accept="image/*">

                                        <button type="button" id="remove_image_button" class="btn btn-sm btn-link p-0 @if ($user->avatar === App\User::DEFAULT_AVATAR) display-none @endif">
                                            Remove image
                                        </button>

                                    </div>

                                    @if ($errors->details->has('avatar'))
                                    <span class="invalid-message">
                                        <strong>{{ $errors->details->first('avatar') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                @if (auth()->user()->hasRole('admin'))
                                <div class="form-group">
                                    <label for="roles" class="custom-label">Roles</label>

                                    <select name="roles[]" id="roles" multiple required>

                                        @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            @if ($user->hasRole($role->name)) selected @endif >
                                            {{ $role->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->details->has('roles'))
                                    <span class="invalid-message">
                                        <strong>{{ $errors->details->first('roles') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                @endif

                                <input type="submit" name="change_details" class="btn btn-primary btn-sm" value="Update">
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Password change tab --}}
                <div class="tab-pane fade" id="list-password" role="tabpanel" aria-labelledby="list-password-list">
                    <div class="col col-lg-6 p-3">

                        <form class="form" action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="current_password" class="custom-label">Current password</label>

                                <input type="password" name="current_password" id="current_password" class="form-control custom-form-control{{ $errors->password->has('current_password') ? ' is-invalid' : '' }}" required>

                                @if ($errors->password->has('current_password'))
                                <span class="invalid-message">
                                    <strong>{{ $errors->password->first('current_password') }}</strong>
                                </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="password" class="custom-label">New password</label>

                                <input type="password" name="password" id="password" class="form-control custom-form-control{{ $errors->password->has('password') ? ' is-invalid' : '' }}">

                                @if ($errors->password->has('password'))
                                <span class="invalid-message">
                                    <strong>{{ $errors->password->first('password') }}</strong>
                                </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="custom-label">Confirm password</label>

                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control custom-form-control{{ $errors->password->has('password') ? ' is-invalid' : '' }}">

                                @if ($errors->password->has('password'))
                                <span class="invalid-message">
                                    <strong>{{ $errors->password->first('password') }}</strong>
                                </span>
                                @endif

                            </div>

                            <input type="submit" name="change_password" class="btn btn-sm btn-primary" value="Update">
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $('#roles').select2({
    placeholder: 'Choose roles'
});
</script>

<script>
  document.getElementById('image_select').addEventListener('change', function() {
    // Create the image preview
    var container = document.getElementById('image_container');
    var image = document.getElementById('image_preview');

    var file    = document.getElementById('image_select').files[0];
    var reader  = new FileReader();

    reader.addEventListener("load", function () {
      image.src = reader.result;
  }, false);

    if (file) {
      reader.readAsDataURL(file);
  }

    // Check if a image is chosen
    if (document.getElementById('image_select').files.length === 1) {
      document.getElementById('remove_image_button').classList.remove('display-none');
      document.getElementById('remove_image_button').classList.add('display-block');
      document.getElementById('image_select').classList.remove('display-block');
      document.getElementById('image_select').classList.add('display-none');

      // Remove the 'removed' input if a image is selected
      if (document.getElementById('removed')) {
        var elem = document.getElementById('removed');
        elem.parentNode.removeChild(elem);
    }
}

});

  document.getElementById('remove_image_button').addEventListener('click', function() {
    document.getElementById('image_preview').src = '{{ asset('storage/avatars/'. App\User::DEFAULT_AVATAR) }}';

    document.getElementById('remove_image_button').classList.remove('display-block');
    document.getElementById('remove_image_button').classList.add('display-none');

    document.getElementById('image_select').classList.remove('display-none');
    document.getElementById('image_select').classList.add('display-block');

    document.getElementById('image_select').value = '';

    // Create a hidden input if the image is removed
    // So we can remove the image in controller
    var input = document.createElement("input");
    input.setAttribute('type', 'hidden');
    input.setAttribute('id', 'removed');
    input.setAttribute('name', 'removed');
    document.getElementById('image_container').appendChild(input);

});

</script>
@endpush
@endsection
