<h3>Novo cep/busca</h3>

<form action="{{route('forecast.store')}}" method="POST">
    @csrf()
    <input type="text" name="=cep" placeholder="cep">
    <input type="text" name="=localidade" placeholder="localidade">
    <input type="text" name="=temperatura" placeholder="temperatura">
    <button type="submit">Enviar</button>
</form>