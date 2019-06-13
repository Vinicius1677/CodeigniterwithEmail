<?= isset($msg)?$msg:"";?>

<form action="<?=base_url('curso/salvar')?>" method="post" enctype="multipart/form-data">
      Nome: <input type="text" name="nome"/><br/>
      Descricao: <input type="text" name="descricao"/><br/>
      <input name="imagem" type="file"/>
      <button type="submit">Enviar</button>
</form>
