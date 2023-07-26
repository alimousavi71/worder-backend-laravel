<div class="form-group">
    <label for="{{ $identify }}" class="form-label">{{ $title }}</label>
    <select class="form-control" name="{{ $identify }}" id="{{ $identify }}" {{ $attributes }}>
        @if ($items->isNotEmpty())
            @foreach ($items as $item)
                <option @if($item->{$key} == $old) selected="selected" @endif value="{{ $item->{$key} }}">{{ $item->{$value} }}</option>
            @endforeach
        @endif
    </select>
</div>
