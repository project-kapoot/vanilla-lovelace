
# Projet KaPoot - Groupe Lovelace

Site internet pour pouvoir créer et participer à des quiz en ligne avec d'autres joueurs.  
Projet d'apprentissage réalisé dans le cadre d'une réunion d'apprenants sur le Discord Entraide && Motivation.

## Stack technique 

- Javascript
- CSS
- PHP

---

## ⚙️ Conventions de commit avec CaptainHook

Ce projet utilise [Conventional Commits](https://www.conventionalcommits.org/fr/v1.0.0/) pour garantir des messages de commit clairs et automatisables.

### 🔤 Format attendu :
```
<type>(<scope>): <message sans majuscule ni point>
```

### ✅ Exemples valides :
- feat(router): add 404 error page
- fix(profile): handle empty user data
- refactor(core): sanitize path input
- chore: install captainhook and ramsey

### ❌ Exemples refusés :
- Add file
- bugfix commit
- update readme.

---

## 🛠️ Configuration CaptainHook

Les hooks suivants sont actifs via le fichier `captainhook.json` :

- `commit-msg` : valide le message de commit (via Ramsey)
- `prepare-commit-msg` : propose un assistant interactif si tu tapes `git commit` sans `-m`

### 📦 Installation :

```bash
composer install
```

Cette commande installe automatiquement les hooks Git via :
```json
"post-install-cmd": [
  "vendor/bin/captainhook install -sf"
]
```

---

## 🤝 Contribution

Merci de respecter la convention de commit !  
Cela garantit un changelog propre, une meilleure lisibilité, et une automatisation possible.
