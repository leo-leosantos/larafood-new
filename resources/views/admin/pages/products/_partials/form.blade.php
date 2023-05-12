@include('admin.includes.alerts')

<div class="form-group">
    <label for="">Titulo</label>
    <input type="text" name="title" class="form-control" placeholder="Nome:" value="{{ $product->title ?? old('title') }}">
</div>

<div class="form-group">
    <label for="">Preço</label>

    <input type="number" name="price" class="form-control" placeholder="Preço:"  min="0.00" value="{{ $product->price ?? old('price') }}">

</div>



<div class="form-group">
    <label for="">Descrição</label>

    <textarea name="description"  cols="30" rows="10" class="form-control">
        {{ $product->description ?? old('description') }}
    </textarea>
</div>

<div class="form-group">
    <label for="">* Imagem</label>
    <input type="file" name="image" class="form-control">
</div>






