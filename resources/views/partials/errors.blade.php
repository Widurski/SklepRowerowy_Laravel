@if($errors->any())
    <div class="errors">
        <strong>Popraw następujące błędy:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
