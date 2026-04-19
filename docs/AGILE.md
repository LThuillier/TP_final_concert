# Suivi Agile

## Sprint 1
- Mettre en place l'authentification et les modeles `User`, `Ticket`, `Payment`.
- Creer les pages Inertia de base (`Home`, `Tickets`, `Payments`).

## Sprint 2
- Ajouter la moderation (profanity filter) sur la creation de ticket.
- Ajouter les roles Spatie (`admin`, `client`) et les seeds de base.

## Sprint 3
- Exposer les endpoints API avances:
  - `GET /api/open-tickets`
  - `GET /api/closed-tickets`
  - `GET /api/users/{email}/tickets`
  - `GET /api/stats`

## Sprint 4
- Ajouter les tests fonctionnels (`tickets`, `payments`, `api`).
- Industrialiser avec Docker et Bitbucket Pipelines.
