Si on utilise l'extended insert

1 Produit
1 Catégorie
1 Product extra fields
1 Categorie extra fields
1 Tag

Pour éviter un accès pendant qu'une ligne est replace.

On peut soit swap des tables, les deux tables sont vérouiller ensemble
RENAME TABLE foo TO foo_old, foo_new To foo; 

Soit à voir si on peut les locks nous même afin de ne pas avoir à utiliser de temporary table

Si on décide de construire à partir d'un objet doctrine ce moteur de requêtage,

Il faut soit ne pas parcourir les relations du tout, soit seulement celle dont le contenu de l'objet lié à changé

Une bonne découpe à la base peut êviter de devoir parcourir des relations.
Ce qui pour une première version peut être pas mal. 

Get ids (create local index) -> Extended insert/Replace produit...
Get ids (create local index) -> Extended insert/Replace produit_relation_with_product...
Get ids (create local index) -> Extended insert/Replace produit_extra_fields...
Get ids (create local index) -> Extended insert/Replace produit_relation_extra_fields...
Get ids (create local index) -> Extended insert/Replace categorie...
Get ids (create local index) -> Extended insert/Replace tag...