<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form action="{{ route('field.store') }}" method="POST"> <!-- Zmieniono na field.store -->
        @csrf
        <div id="dynamic-fields">
            @foreach($fields as $field)
                <div class="field-row">
                    <input type="text" name="fields[]" value="{{ $field->value }}">
                    <input type="hidden" name="field_ids[]" value="{{ $field->id }}">
                    <button type="submit" form="{{ 'delete-form-' . $field->id }}">Usuń</button> <!-- Dodane form="..." -->
                </div>
            @endforeach
        </div>
        <button type="button" id="add-field">Dodaj nowe pole</button>
        <button type="submit">Zapisz</button>
    </form>

    @foreach($fields as $field)
        <form id="{{ 'delete-form-' . $field->id }}" action="{{ route('field.destroy', $field->id) }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

<script>
    $('#add-field').click(function() {
        let field = '<div class="field"><input type="text" name="fields[]"><button type="button" class="remove">Usuń</button></div>';
        $('#dynamic-fields').append(field);
    });

    $('body').on('click', '.remove', function() {
        $(this).parent('.field').remove();
    });
</script>
</body>
</html>