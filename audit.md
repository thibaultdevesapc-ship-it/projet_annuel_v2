## 🌐 HTML

### Critère 1 — Structure sémantique

> Utilisez-vous les bonnes balises HTML selon le contenu ? (`<header>`, `<main>`, `<section>`, `<article>`, `<footer>`, `<nav>`…)
> 

Oui

### Critère 2 — Pas de style inline

> Avez-vous évité d'écrire du CSS directement dans les attributs `style="..."` de vos balises HTML ?
> 

Oui

### Critère 3 — Pas de duplication de structure

> Avez-vous des blocs HTML quasi-identiques copiés-collés plusieurs fois ? (ex : cartes, lignes de tableau, formulaires similaires)
> 

Non

### Critère 4 — Attributs `alt` sur les images

> Toutes vos balises `<img>` ont-elles un attribut `alt` qui décrit l'image ?
> 

Oui

> Chaque page ne contient-elle qu'un seul titre principal `<h1>` ? Les niveaux de titres sont-ils respectés (h1 → h2 → h3…) ?
> 

Oui un seul h1

### Critère 6 — Formulaires bien structurés

> Vos formulaires utilisent-ils des `<label>` associés à chaque `<input>` via l'attribut `for` ?
> 

Oui


> Utilisez-vous encore des balises obsolètes comme `<center>`, `<font>`, ou `<b>` à la place de `<strong>` ?
> 

Non

### Critère 8 — Indentation cohérente

> Votre HTML est-il bien indenté ? Peut-on lire la hiérarchie des balises d'un coup d'œil ?
> 

Oui

### Critère 9 — Pas de `<div>` inutiles

> Avez-vous des `<div>` vides ou imbriquées sans raison qui pourraient être remplacées par une balise sémantique ?
> 

Non

### Critère 10 — Fichiers liés correctement

> Vos fichiers CSS et JS sont-ils liés dans le bon ordre ? (`<link>` CSS dans le `<head>`, `<script>` JS avant `</body>`)
>

Oui



















## 🎨 CSS

### Critère 1 — Pas de règles en double

> Avez-vous des propriétés CSS répétées plusieurs fois pour le même effet ? Avez-vous pensé à créer des classes réutilisables ?
> 

Oui pour les input label et select du form

### Critère 2 — Organisation du fichier CSS

> Votre CSS est-il organisé de façon logique ? (global → composants → pages) — et êtes-vous en mesure de retrouver rapidement une règle ?
> 

Oui logique et organisé

### Critère 3 — Variables CSS

> Utilisez-vous des variables CSS (`--couleur-primaire`, `--font-titre`…) pour vos couleurs et polices récurrentes ?
> 

Oui pour couleurs

### Critère 4 — Pas de valeurs magiques

> Avez-vous des valeurs numériques arbitraires dans votre CSS (`margin: 37px`, `top: 13px`…) sans que l'on comprenne pourquoi ce chiffre précis ?
> 

Non

### Critère 5 — Responsive / Media queries

> Votre site s'affiche-t-il correctement sur mobile ? Avez-vous utilisé des media queries pour adapter la mise en page ?
> 

Non - problème

### Critère 6 — Nommage des classes

> Vos classes CSS ont-elles des noms qui décrivent leur rôle ? (`.card`, `.btn-primary`) plutôt que (`.rouge`, `.div2`) ?
> 

Oui

### Critère 7 — Pas d'abus de `!important`

> Avez-vous utilisé `!important` pour forcer des styles ? C'est souvent le signe d'un conflit de spécificité à résoudre proprement.
> 

Non

### Critère 8 — Utilisation de Flexbox ou Grid

> Utilisez-vous `flex` ou `grid` pour vos mises en page plutôt que des `float` ou `position: absolute` un peu partout ?
> 

Oui

### Critère 9 — Cohérence visuelle

> Vos espacements, tailles de police et couleurs sont-ils cohérents sur l'ensemble du site ? Ou chaque page a-t-elle ses propres valeurs "au feeling" ?
> 

Oui

### Critère 10 — Commentaires de section dans le CSS

> Avez-vous ajouté des commentaires pour délimiter les grandes sections de votre fichier CSS ?
>

Oui




















## 🐘 PHP

### Critère 1 — Pas de fonctions dupliquées

> Avez-vous écrit deux fois la même logique ? Si oui, c'est le signe qu'une fonction réutilisable est nécessaire.
> 

Non

### Critère 2 — Utilisation des transactions

> Lorsque vous faites plusieurs requêtes SQL qui dépendent les unes des autres, utilisez-vous des transactions pour garantir la cohérence des données ?
> 

Non

### Critère 3 — Séparation de la logique et de l'affichage

> Votre PHP "métier" (requêtes, calculs) est-il mélangé directement dans vos fichiers HTML ? Ou avez-vous commencé à séparer ces responsabilités ?
> 

Certains sont mélangés et d'autres séparés pour optimiser

### Critère 4 — Requêtes préparées

> Utilisez-vous des requêtes préparées (`prepare` + `execute`) pour toutes les requêtes qui utilisent des données venant de l'utilisateur ?
> 

Oui

### Critère 5 — Gestion des erreurs

> Vos opérations sensibles sont-elles entourées de `try/catch` ? Affichez-vous un message d'erreur compréhensible plutôt qu'une page blanche ?
> 

Oui

### Critère 6— Validation des données reçues

> Vérifiez-vous que les données envoyées via un formulaire sont bien présentes et du bon type avant de les utiliser (`isset`, `empty`, `filter_var`…) ?
> 

Oui isset

### Critère 7 — Utilisation de `include` / `require`

> Avez-vous factorisé vos éléments communs (header, footer, connexion BDD) dans des fichiers séparés inclus avec `include` ou `require` ?
> 

Oui

### Critère 8 — Nommage cohérent des variables et fonctions

> Vos variables et fonctions PHP ont-elles des noms clairs ? (`$userId`, `getUserById()`) plutôt que (`$u`, `$x`, `getData()`) ?
> 

Oui

### Critère 10 — Pas d'affichage d'erreurs en production

> Avez-vous désactivé l'affichage des erreurs PHP côté utilisateur sur votre version déployée ? Les erreurs techniques ne doivent pas être visibles par l'utilisateur final.
>

Les erreurs techniques sont notées : erreur de connexion































## ⚡ JavaScript

### Critère 1 — Réutilisation des fonctions

> Avez-vous écrit des blocs de code JS très similaires à plusieurs endroits ? Si oui, pouvez-vous les regrouper dans une fonction commune ?
> 

Non

### Critère 2 — Organisation du code JS

> Votre JavaScript est-il dans un seul gros bloc ? Avez-vous pensé à regrouper les fonctions par thème, ou à utiliser des commentaires pour s'y retrouver ?
> 

C'est ordonné mais court

### Critère 3 — Pas de `console.log` oubliés

> Avez-vous pensé à supprimer (ou commenter) vos `console.log` de debug avant de livrer ?
> 

Pas de console.log

### Critère 4 — `const` et `let` plutôt que `var`

> Utilisez-vous `const` pour les valeurs fixes et `let` pour celles qui évoluent ? Avez-vous encore des `var` dans votre code ?
> 

Oui utilisation de const, pas de let et de var

### Critère 5 — Cache des sélections DOM

> Stockez-vous vos sélections `querySelector` dans des variables pour ne les faire qu'une fois, plutôt que de les répéter à chaque appel ?
> 

Oui

### Critère 6 — Gestion des événements propre

> Utilisez-vous `addEventListener` ? Ou avez-vous encore des `onclick="..."` directement dans votre HTML ?
> 

Oui

### Critère 7 — Pas de code JS dans les fichiers HTML

> Votre JavaScript est-il dans un fichier `.js` séparé ? Ou avez-vous de gros blocs `<script>` directement dans vos pages HTML ?
> 

Oui séparé

### Critère 8 — Nommage clair des fonctions et variables

> Vos fonctions JS décrivent-elles clairement leur action ? (`afficherMenu()`, `calculerTotal()`) plutôt que (`f1()`, `truc()`) ?
> 

Oui

### Critère 9 — Gestion basique des erreurs sur les `fetch`

> Lorsque vous faites une requête `fetch`, gérez-vous les cas d'erreur (réseau KO, réponse non-OK) ?
> 

Non pas de fetch

### Critère 10 — Commentaires sur le code complexe

> Avez-vous commenté les parties de votre JS qui ne sont pas immédiatement compréhensibles ? Un collègue pourrait-il reprendre votre code sans vous poser de questions ?
>

Oui

































# Restitution orale — Ce qu'on attend de vous

**Durée : 5 minutes par groupe**

Vous présenterez :

1. **Les point fort** de votre code actuel (ce que vous faites déjà bien)

Tout fonctionne et est sécurisé, le php est mis en place, le HTML aussi, presque fini.

2. **Les problèmes** identifiés dans l'audit

Manque de CSS : mise en place du responsive, de la grid pour l'historique et du graphique de dépenses.

3. **Le plan de tâches** que vous allez mettre en place

- faire la grid de l'historique
- faire le graphique des dépenses
- faire le responsive

4. **Qui fait quoi** dans l'équipe pour corriger

- nassim : grid et graphique
- thibault : responsive