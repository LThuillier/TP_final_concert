# API Avancee Tickets

Les endpoints sont proteges par `auth:sanctum`.

## Endpoints
- `GET /api/open-tickets`: tickets avec statut `disponible`.
- `GET /api/closed-tickets`: tickets avec statut different de `disponible`.
- `GET /api/users/{email}/tickets`: tickets d'un utilisateur par email.
- `GET /api/stats`: statistiques globales tickets, paiements, utilisateurs.

## Exemple De Test (curl)
```bash
curl -H "Accept: application/json" \
  -H "Authorization: Bearer <token>" \
  http://localhost:8000/api/open-tickets
```
