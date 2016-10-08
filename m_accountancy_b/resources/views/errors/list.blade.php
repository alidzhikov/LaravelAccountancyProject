@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif