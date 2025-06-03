<form class="d-inline" id="quizForm" method="POST" action="{{ route('admin.store.category') }}" enctype="multipart/form-data">

    @csrf

    <label>
        Nombre del quiz:
        <input type="text" name="category[name]" value="" required>
    </label><br><br>
    <label>
        Imagen del quiz:
        <input type="file" name="category[image]" accept="image/*" required>
    </label><br><br>
    <button type="submit">Enviar</button>
    @if ($errors->any())
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
        <strong>Errores encontrados:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</form>
