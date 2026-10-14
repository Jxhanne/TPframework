from http.server import BaseHTTPRequestHandler, HTTPServer
from urllib.parse import urlparse, parse_qs

from src.request import Request
from src.response import Response
from src.router import Router


# --- tes routes (à toi d'en ajouter) ---
def accueil(request):
    return Response.html('<h1>Accueil</h1><a href="/recettes">Voir les recettes</a>')


def liste(request):
    return Response.html("<h1>Liste des recettes</h1>")


routeur = Router()
routeur.add_route("GET", "/", accueil)
routeur.add_route("GET", "/recettes", liste)


# --- le serveur ---
class Handler(BaseHTTPRequestHandler):
    def traiter(self):
        # 1. paramètres GET : ?q=mot devient {"q": "mot"}
        brut = parse_qs(urlparse(self.path).query)
        query = {}
        for cle in brut:
            query[cle] = brut[cle][0]

        # 2. paramètres POST : on lit le corps de la requête
        taille = int(self.headers.get("Content-Length", 0))
        texte = self.rfile.read(taille).decode("utf-8")
        brut = parse_qs(texte)
        body = {}
        for cle in brut:
            body[cle] = brut[cle][0]

        # 3. on fabrique ta Request et on la donne au routeur
        request = Request(self.command, self.path, query, body)
        response = routeur.resolve(request)

        # 4. on renvoie ta Response au navigateur
        self.send_response(response.status())
        for nom in response.headers():
            self.send_header(nom, response.headers()[nom])
        self.end_headers()
        self.wfile.write(response.body().encode("utf-8"))

    def do_GET(self):
        self.traiter()

    def do_POST(self):
        self.traiter()

    def do_DELETE(self):
        self.traiter()


serveur = HTTPServer(("localhost", 8000), Handler)
print("Serveur sur http://localhost:8000 (Ctrl+C pour arrêter)")
serveur.serve_forever()