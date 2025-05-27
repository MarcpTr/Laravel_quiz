
<h1>Crear Quiz: Historia de Japón</h1>

<form class="d-inline" id="quizForm" method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">

    @csrf
   
  <label>
    Nombre del quiz:
    <input type="text" name="quiz[title]" value="" required>
  </label><br><br>

  <label>
    Descripción:
    <textarea name="quiz[description]" required></textarea>
  </label><br><br>
  <label>
    Imagen del quiz:
    <input type="file" name="quiz[image]" accept="image/*" required>
  </label><br><br>
  <div id="questionsContainer">
  </div>

  <button type="button" onclick="addQuestion()">Agregar Pregunta</button><br><br>
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

<script>
  let questionIndex = 0;

  function addQuestion() {
    const container = document.getElementById('questionsContainer');
    const questionHTML = `
      <fieldset>
        <legend>Pregunta ${questionIndex + 1}</legend>
        <label>
          Texto de la pregunta:
          <input type="text" name="quiz[questions][${questionIndex}][question]" required>
        </label><br><br>
        
        ${[0,1,2,3].map(i => `
          <div class="answer">
            <label>
              Opción ${i + 1}:
              <input type="text" name="quiz[questions][${questionIndex}][answers][${i}][option]" required>
            </label>
            <label>
              ¿Es correcta?
              <input type="radio" name="quiz[questions][${questionIndex}][correct]" value="${i}" required>
            </label>
          </div><br>
        `).join('')}
      </fieldset>
    `;
    container.insertAdjacentHTML('beforeend', questionHTML);
    questionIndex++;
  }

  document.getElementById('quizForm').addEventListener('submit', function (e) {
    const formData = new FormData(this);
    const obj = Object.fromEntries(formData.entries());
    console.log('Formulario enviado. Contenido:', obj);
  });
</script>