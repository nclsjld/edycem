Symfony 4 Starter Kit
===

## Requirements

PHP 7.2

## Install

### Symfony

`composer install`

`yarn install`

Créer la base de données :

`php bin/console doctrine:database:create`

Mettre a jour la base de données :

`php bin/console do:mi:mi`

Créer un super admin : 

`php bin/console fos:user:create user mail@domain.fr password --super-admin`

### Assets

Pour compiler les assets : 

`npm run watch` ou `npm run dev`

```
Tous les fichiers CSS et Javascript se trouvent dans le dossier "assets" situé à la racine
Toutes les images se trouvent dans le dossier "public" situé à la racine
```

## Configuration

La configuration de base de EasyAdminBundle a été étendue pour permettre une gestion plus fine des actions par rôles. Voir [ici](https://github.com/WandiParis/documentation/blob/master/symfony/06-easy-admin-bundle-acl.md#config).

## Ajout de fonctionnalités : Export .csv
  
Pour exporter une table, il existe 2 méthodes :  
  
**Méthode 1 :**  
- Se rendre sur app/config/admin/entities/"entity_name".yml  
-     Ajouter :
	     easy_admin:
	        entities:
	           EntityName:
	              export:
  

Cette méthode permet de récupérer tous les champs de l'affichage d'une liste pour les exporter sans traitement supplémentaire.  
  
Dans le cas où vous souhaitez personnaliser les champs à exporter, utiliser la méthode 2.  
  
**Méthode 2 :**  
- Se rendre sur app/config/admin/entities/"entity_name".yml  
-     Ajouter :
	     easy_admin:
	        entities:
	           EntityName:
	              export:
	                 fields:
- Saisissez ensuite les champs à afficher à la manière d'[EasyAdminBundle](https://symfony.com/doc/master/bundles/EasyAdminBundle/book/edit-new-configuration.html#customize-the-form-fields)

Vous pouvez entre autre ajouter un rôle spécifique à l'export, mettre les informations "property", "label", "type".
Pour le type "association" / "collection", il y a donc la possibilité de mettre type: number pour afficher le total d'enregistrement de la collection ou le type: collection. Pour ce dernier, vous pouvez ajouter le séparateur que vous souhaitez de la manière suivante :
                          
    easy_admin:
       entities:
          EntityName:
             export:
                fields:
                   - { property: 'laCollection', label: 'La collection', type: 'collection', type_options: { separator: ' - ' } }

De cette manière, le séparateur de chaque élément de la collection sera " - ".

## Ajout de fonctionnalités : API
   
 Pour rendre une entité accessible via une API, il faut :
 - Ajouter le nom de l'entité au fichier '/config/api.yaml' de la façon suivante : 
 
 ```
 api:
   entities:
     - { name: Post, showAll: posts, showOne: post }
 ```
 - Il est également possible de cibler les champs à afficher en ajoutant sur l'entité voulue :
 ```
 Dans les imports : use JMS\Serializer\Annotation as Serializer;
 Dans les annotations de l'entité : @Serializer\ExclusionPolicy("ALL")
 Dans les annotations du champ voulue : @Serializer\Expose
 
 ```
 
 Pour en voir plus sur les annotations : http://jmsyst.com/libs/serializer/master/reference/annotations
