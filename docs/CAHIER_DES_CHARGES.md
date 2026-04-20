# Cahier Des Charges (Synthese)

## Objectif
Developper une application Laravel de gestion de billets de concert avec paiement.

## Utilisateurs Cibles
- `client`: consulte et achete des billets, consulte ses paiements.
- `admin`: supervision des utilisateurs, tickets et statistiques API.

## Fonctionnalites Principales
- Authentification (register, login, verification email).
- CRUD partiel des tickets (liste, creation).
- Gestion des paiements (liste, creation).
- Filtre de moderation sur les billets (profanity filter).
- Roles et permissions via Spatie.
- API avancee sur la gestion des tickets.

## Contraintes Techniques
- Backend: Laravel + Eloquent.
- Frontend: Vue 3 + Inertia.
- Base relationnelle: MySQL.
- Base NoSQL: MongoDB (configuration fournie).
- Conteneurisation: Docker.
- CI/CD: Bitbucket Pipelines.
