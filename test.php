<div id="gestion_publication">
	<table class="table">
	<center><h1>Revirement jurisprudentiel</h1></center>
	<thead>
		<tr>
		<th scope="col">Objet de l'article</th>
		<th scope="col">Date de publication</th>
		<th scope="col">Date de création</th>
		<th scope="col">Sous-domaine</th>
		<th scope="col">Rédacteur</th>
		<th scope="col">Statut</th>
		<th scope="col">Supprimer</th>
	 </tr>
 </thead>
 <tbody>
 <?php
 $req = $db->PREPARE('SELECT * FROM articles WHERE status = 1 OR status = 2');
 $req->execute();
 $articles = $req->fetchAll(PDO::FETCH_ASSOC);

 foreach ($articles as $article) {  ?>
	 <!-- <tr onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $article['id_article'] ?>'">
	-->
	<tr>
	<td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $article['id_article'] ?>'"><?php echo $article['objet'] ?></td>
	<td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $article['id_article'] ?>'"><?php echo $article['release_date'] ?></td>
	<td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $article['id_article'] ?>'"><?php echo $article['publication_date'] ?></td>
	<td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $article['id_article'] ?>'"><?php
	$reqSubDomain = $db->PREPARE('SELECT name FROM sub_domains WHERE id_sub_domain = :id_sub_domain');
	$reqSubDomain->bindParam(':id_sub_domain', $article['id_sub_domain']);
	$reqSubDomain->execute();
	$sub_domain = $reqSubDomain->fetch();
	echo $sub_domain['name'] ?></td>
	<td onclick="window.location.href='administration_alter_avocat.php?id=<?php echo $article['id_article'] ?>'"><?php
	$reqUser = $db->PREPARE('SELECT pseudo FROM users WHERE id_user = :id_user');
	$reqUser->bindParam(':id_user', $article['id_author']);
	$reqUser->execute();
	$user = $reqUser->fetch();
	echo $user['pseudo'] ?></td>
	<td>
	 <?php if ($article['status'] == 1): ?>
		 <a href="change_article_status.php?id_article=<?php echo $article['id_article'] . "&status=" . $article['status']?>">Afficher</a>
	 <?php elseif ($article['status'] == 2): ?>
		 <a href="change_article_status.php?id_article=<?php echo $article['id_article'] . "&status=" . $article['status']?>">Enlever</a>
	 <?php endif; ?>
	 </td>
	 <td><a href='delete_article.php?id_article=<?php echo $article['id_article']?>'>Supprimer</a></td>
 </tr>
	 <?php } ?>
	 </tbody>
	 </table>
 </div>
