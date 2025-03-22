# Mise en place de Sass dans *vanilla-lovelace*

## Objectif
Organiser les fichiers **SCSS** du projets en suivants l'architecture **7-1** en  suivants les bonnes pratiques (`@use` et `@foward`).
Pour en savoir plus sur [l'architecture **7-1**](https://sass-guidelin.es/#architecture).

## Fonctionemment des fichiers `_index.scss`.

Chaque dossier comporte un `_index.scss` qui réexporte les fichiers internes avec [`@foward`](https://sass-lang.com/documentation/at-rules/forward/), elle sert de point d'entré dans un dossier.

### **Exemple** 
`abstracts/_index.scss`

```scss
@forward 'colors';
@forward 'fonts';
@forward 'spacing';
```

## Le Fichier principal `main.scss`
C’est le seul fichier SCSS compilé en **CSS** final. Il permet d'importer tous les autres fichiers **SCSS** non compilé. Pour notre projets on importe les autres fichiers **SCSS** avec [`@use`](https://sass-lang.com/documentation/at-rules/use/).

```scss
@use 'abstracts' as *;
@use 'base' as *;
@use 'components' as *;
@use 'pages' as *;
```

**NB** :  `main.scss` et les `_index.scss` ne sont pas faits pour contenir du code CSS ou SCSS.

- `main.scss` doit uniquement servir à organiser les imports avec `@use` des dossiers principaux.
- `_index.scss` sert uniquement à réexporter les fichiers internes de son dossier avec `@forward`.

## Lien utile

[Documentation **SASS**](https://sass-lang.com/documentation/)