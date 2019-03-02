@if(count($errors) > 0)
    <div class="row">
        <div class="error ml-3">
            <ul style="list-style:none;">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
