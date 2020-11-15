<?php 
extract($_POST);
$art = new Article();
if(isset($save))
{
    $art->setNom($nom);
    $art->setDescription($description);
    $art->setPrix($prix);
    $art ->add($art);
    echo "Records Saved ";
}
?>
<form name="add" method="post" >

<input type="text" name="nom" id="nom" placeholder="Nom..">

<textarea name="description" id="" cols="30" rows="10">

</textarea>
<input type="text" name="prix" id="prix" placeholder="Prix..">
<input type="submit" value="save" name="save"/>
</form>

