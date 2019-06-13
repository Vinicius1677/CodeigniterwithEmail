<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<form action="<?= base_url('curso/uparArquivo')?>" method="POST" enctype="multipart/form-data">
     <input type="text" name="name" placeholder="Informe o nome do arquivo"/>
     <br/>
     <input type="file" name="curriculo">
     <br/>
     <input type="submit" value="Salvar"/>
 </form>
</body>
</html>