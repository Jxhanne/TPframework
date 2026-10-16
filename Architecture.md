# 
## Le cycle de vie d'une requête dans votre framework, de l'arrivée HTTP à la réponse
```mermaid
sequenceDiagram
    actor UI as Utilisateur final
    box Server
        participant Router as Routeur
        participant Controller as Contrôleur
        participant View as Vue
    end
    box Storage
        participant DB as Base de données
    end

    UI->>Router: url + méthode
    Router->>Controller: route trouvée
    Controller->>DB: requête
    DB-->>Controller: données
    Controller->>View: données à afficher
    View-->>UI: réponse HTML
```
## Le rôle de chaque classe et comment elles interagissent
## Comment l'injection de dépendances réduit le couplage
## Les limites de notre implémentation et les améliorations possibles