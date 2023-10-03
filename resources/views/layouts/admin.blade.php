@if (($success = session('success')) || ($error = session('error')))
    <div class="alert alert-{{ $success ? $success['type'] : $error['type'] }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ $success ? $success['title'] : $error['title'] }}</strong> {{ $success ? $success['message'] : $error['message'] }}
    </div>
@endif
