# Mediatekformation

## Dépôt d'origine

Ce projet est basé sur l'application initiale disponible ici :  
--> https://github.com/CNED-SLAM/mediatekformation

Le dépôt d'origine contient une description complète du front office initial.

---

## Présentation

Ce projet correspond à une amélioration de l'application **mediatekformation**, développée avec Symfony 6.4.

L'application permet d'accéder à des vidéos d’auto-formation organisées en playlists, mais le travail réalisé a consisté à corriger, compléter et étendre les fonctionnalités existantes.

<img width="2142" height="1317" alt="Screenshot 2026-04-01 170446" src="https://github.com/user-attachments/assets/3e7f87c7-c079-440d-9cf8-5d3169fe0c61" />

---

## Fonctionnalités ajoutées

### Nettoyage du code

Le code existant a été corrigé en suivant les recommandations de SonarLint :

- suppression des variables inutilisées  
- amélioration du nommage  
- simplification de certaines méthodes  
- amélioration globale de la lisibilité  

---

### Ajout d'une fonctionnalité

Ajout du **nombre de formations par playlist** :

<img width="2129" height="1031" alt="Screenshot 2026-04-01 170829" src="https://github.com/user-attachments/assets/e46b1af4-f38b-4b0b-a012-2cc8d1b0b4db" />

- affichage dans la page des playlists  
- affichage dans le détail d’une playlist  
- ajout du tri croissant / décroissant  

Modifications principales :
- requêtes dans les Repository (COUNT)
- adaptation des templates Twig

---

### Back office

Un back office complet a été développé afin de gérer les données de l’application.

#### Gestion des formations
- ajout
- modification
- suppression

#### Gestion des playlists
- ajout
- modification
- suppression

#### Gestion des catégories
- ajout
- suppression

Développements réalisés :
- création de contrôleurs Symfony dédiés  
- création de formulaires (FormType)  
- gestion des entités avec Doctrine  
- création de vues Twig pour l’administration

<img width="2144" height="832" alt="Screenshot 2026-04-01 170508" src="https://github.com/user-attachments/assets/dd6d810f-93f2-414e-93da-d1b1a8df0689" />
<img width="2145" height="893" alt="Screenshot 2026-04-01 170525" src="https://github.com/user-attachments/assets/532cd860-cdf1-478f-9211-4a030237c2d8" />

---

### Authentification

Un système d’authentification a été mis en place :

- accès sécurisé au back office  
- restriction des routes  
- gestion des utilisateurs  

---

### Tests

Mise en place de plusieurs types de tests :

- tests unitaires  
- tests d’intégration  
- tests fonctionnels  
- tests de compatibilité navigateurs  

---

### Déploiement

L’application a été déployée sur alwaysdata :

--> https://mediatekformation-test.alwaysdata.net

---

### Sauvegarde de la base de données

Mise en place d’un script de sauvegarde automatique :

- sauvegarde quotidienne  
- export SQL avec `mysqldump`  

---

### Déploiement continu

Mise en place d’un déploiement continu avec GitHub Actions :

- déclenchement à chaque push  
- connexion sécurisée via SSH  
- transfert automatique des fichiers  
- mise à jour du site sans intervention manuelle  

---

## Installation en local

### Prérequis

- PHP 8  
- Composer  
- MySQL  
- WampServer (ou équivalent)  
- Git  

---

### Étapes

1. Cloner le projet :

'git clone https://github.com/Denismelikhov/mediatekformation'

2. Installer les dépendances :

'composer install' en se placant dans le dossier du projet

3. Créer la base de données :

Nom : mediatekformation

4. Importer le fichier :

mediatekformation.sql dans phpmyadmin

5. Lancer l'application :

--> http://localhost/mediatekformation/public/index.php

Et pour accéder au back office : --> 
http://localhost/mediatekformation/public/index.php/admin
